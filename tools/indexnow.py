#!/usr/bin/env python3
"""Tell IndexNow search engines (Bing, Yandex, and the AI tools built on them)
which pages changed in the last live export. Run after deploying dist/live."""
import json
import os
import urllib.request

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
HOST = "spcsprogram.org"

key = open(os.path.join(ROOT, "deploy", "indexnow-key.txt")).read().strip()
urls = json.load(open(os.path.join(ROOT, "dist", "live", ".changed.json")))

if not urls:
    print("IndexNow: no page content changed, nothing to submit.")
else:
    body = json.dumps({
        "host": HOST,
        "key": key,
        "keyLocation": f"https://{HOST}/{key}.txt",
        "urlList": urls,
    }).encode()
    req = urllib.request.Request(
        "https://api.indexnow.org/indexnow",
        data=body,
        headers={"Content-Type": "application/json; charset=utf-8"},
    )
    with urllib.request.urlopen(req) as res:
        print(f"IndexNow: submitted {len(urls)} URL(s), status {res.status}")
