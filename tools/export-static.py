#!/usr/bin/env python3
"""Export the local WordPress site (npm run wp:start) to a static folder for Vercel.

    python3 tools/export-static.py            # live site  -> dist/live   (review notes removed)
    python3 tools/export-static.py --review   # review copy -> dist/review (notes kept, not indexed)

Each output folder keeps its own .vercel link between runs, so deploy with
`vercel deploy dist/live --prod` (see `npm run deploy`).
"""
import datetime
import hashlib
import json
import os
import re
import shutil
import sys
import urllib.error
import urllib.request
from urllib.parse import urljoin, urlparse

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
BASE = "http://localhost:8765"
SITE = "https://spcsprogram.org"
PAGES = ["/", "/about/", "/become-an-instructor/", "/store/", "/newsroom/", "/instructor-login/"]

REVIEW = "--review" in sys.argv
OUT = os.path.join(ROOT, "dist", "review" if REVIEW else "live")

ANALYTICS = (
    '<script defer src="/_vercel/insights/script.js"></script>\n'
    '<script defer src="/_vercel/speed-insights/script.js"></script>\n'
)


def fetch(url):
    try:
        with urllib.request.urlopen(url) as r:
            return r.status, r.read()
    except urllib.error.HTTPError as e:
        return e.code, e.read()


def local_path(path):
    path = urlparse(path).path
    if path.endswith("/"):
        path += "index.html"
    return os.path.join(OUT, path.lstrip("/"))


def save(path, data):
    p = local_path(path)
    os.makedirs(os.path.dirname(p), exist_ok=True)
    with open(p, "wb") as f:
        f.write(data)


URL_RE = re.compile(r'(?:https?:)?//localhost:8765(/[^"\'\s)>,]*)|(?:src|href)="(/wp-[^"]+)"')
CSS_URL_RE = re.compile(r'url\(\s*["\']?([^"\')]+)["\']?\s*\)')
NOTE_RE = re.compile(r'\s*<p class="spcs-review-note[^"]*"[^>]*>.*?</p>', re.S)
ABSOLUTE_RE = re.compile(
    r'(<link rel="canonical" href="|<meta property="og:(?:url|image)" content=")' + re.escape(BASE)
)


def transform_page(html):
    # URLs that must stay absolute for search engines and link previews.
    html = ABSOLUTE_RE.sub(lambda m: m.group(1) + SITE, html)
    html = re.sub(
        r'(<script type="application/ld\+json">.*?</script>)',
        lambda m: m.group(1).replace(BASE, SITE),
        html,
        flags=re.S,
    )
    html = html.replace(BASE, "")

    # The form posts to the serverless function instead of WordPress.
    html = html.replace('action="/wp-admin/admin-post.php"', 'action="/api/contact/"')
    html = re.sub(r'<input type="hidden" (?:id="spcs_demo_nonce" )?name="(?:spcs_demo_nonce|_wp_http_referer|spcs_started)"[^>]*>', "", html)

    if REVIEW:
        html = html.replace("</head>", '<meta name="robots" content="noindex, nofollow">\n</head>', 1)
    else:
        html = NOTE_RE.sub("", html)
        html = html.replace("</head>", ANALYTICS + "</head>", 1)
    return html


def update_lastmod(rendered):
    """Date each page by when its main content last changed, tracked in deploy/lastmod.json."""
    path = os.path.join(ROOT, "deploy", "lastmod.json")
    try:
        manifest = json.load(open(path))
    except FileNotFoundError:
        manifest = {}
    today = datetime.date.today().isoformat()
    changed = []
    for page, html in rendered.items():
        main = re.search(r"<main.*?</main>", html, re.S)
        content = re.sub(r"\?ver=[^\"' ]+", "", main.group(0) if main else html)
        digest = hashlib.sha256(content.encode()).hexdigest()
        if manifest.get(page, {}).get("hash") != digest:
            manifest[page] = {"hash": digest, "date": today}
            changed.append(page)
    with open(path, "w") as f:
        json.dump(manifest, f, indent=2)
        f.write("\n")
    return manifest, changed


def main():
    keep = os.path.join(OUT, ".vercel")
    saved = OUT + "-vercel.bak"
    if os.path.isdir(keep):
        shutil.rmtree(saved, ignore_errors=True)
        shutil.move(keep, saved)
    shutil.rmtree(OUT, ignore_errors=True)
    os.makedirs(OUT)
    if os.path.isdir(saved):
        shutil.move(saved, keep)

    assets, done = set(), set()

    def collect(text):
        for m in URL_RE.finditer(text):
            a = (m.group(1) or m.group(2)).split("#")[0].replace("&#038;", "&").replace("&amp;", "&")
            if a.startswith(("/wp-content/", "/wp-includes/")):
                assets.add(a)

    rendered = {}
    for page in PAGES:
        status, body = fetch(BASE + page)
        if status != 200:
            sys.exit(f"{page} returned {status}. Is `npm run wp:start` running?")
        text = body.decode("utf-8")
        collect(text)
        rendered[page] = transform_page(text)
        save(page, rendered[page].encode())

    _, body = fetch(BASE + "/this-page-does-not-exist/")
    text = body.decode("utf-8")
    collect(text)
    save("/404.html", transform_page(text).encode())

    while assets - done:
        a = (assets - done).pop()
        done.add(a)
        path = a.split("?")[0]
        status, body = fetch(BASE + a)
        if status != 200:
            print("skip", a, status)
            continue
        if path.endswith(".css"):
            text = body.decode("utf-8", "replace")
            for u in CSS_URL_RE.findall(text):
                if u.startswith("data:"):
                    continue
                absu = urlparse(urljoin(BASE + path, u)).path
                if absu.startswith(("/wp-content/", "/wp-includes/")):
                    assets.add(absu)
            body = text.replace(BASE, "").encode()
        save(path, body)

    # Deploy-only files: Vercel config and the form function.
    deploy = os.path.join(ROOT, "deploy")
    shutil.copy(os.path.join(deploy, "vercel.json"), os.path.join(OUT, "vercel.json"))
    shutil.copytree(os.path.join(deploy, "api"), os.path.join(OUT, "api"))

    if REVIEW:
        robots = "User-agent: *\nDisallow: /\n"
    else:
        robots = f"User-agent: *\nAllow: /\n\nSitemap: {SITE}/sitemap.xml\n"
        lastmod, changed = update_lastmod(rendered)
        with open(os.path.join(OUT, ".changed.json"), "w") as f:
            json.dump([SITE + p for p in changed], f)
        key = open(os.path.join(deploy, "indexnow-key.txt")).read().strip()
        with open(os.path.join(OUT, f"{key}.txt"), "w") as f:
            f.write(key)
        urls = "".join(f"  <url><loc>{SITE}{p}</loc><lastmod>{lastmod[p]['date']}</lastmod></url>\n" for p in PAGES)
        with open(os.path.join(OUT, "sitemap.xml"), "w") as f:
            f.write('<?xml version="1.0" encoding="UTF-8"?>\n'
                    '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n'
                    f"{urls}</urlset>\n")
    with open(os.path.join(OUT, "robots.txt"), "w") as f:
        f.write(robots)

    print(f"{'review' if REVIEW else 'live'}: {len(PAGES)} pages, {len(done)} assets -> {os.path.relpath(OUT, ROOT)}")


if __name__ == "__main__":
    main()
