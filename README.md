# spcsprogram.org

Custom WordPress block theme and companion plugin for the **Suicide Prevention for College Student
(SPCS) Gatekeepers Program**.

The site's job is to turn visitors into Certified Instructors: individuals and campus staff who take
the certification course themselves, plus a path for groups who want a team training booked for them.
Its audience is the person who will actually deliver the training — a Resident Advisor, a Peer Health
Educator, a counselling-centre staffer — not an institution evaluating a vendor.

---

## Getting it running

Requires PHP 8+ and Node 20+. No Docker, no MySQL — WordPress runs on PHP's built-in server against
SQLite, and everything it downloads lands in a gitignored `.wp/`.

```bash
npm install && npm run build && npm run wp:start
```

That serves <http://localhost:8765> with admin / admin at `/wp-admin`. `npm run wp:stop` stops it;
`npm run wp:reset` deletes `.wp/` and starts clean.

On a fresh database, activate the theme and plugin, then use the **Create the missing pages** button
in the admin notice to scaffold all nine pages from their patterns.

### Scripts

| Command | Does |
|---|---|
| `npm run build` | Copies fonts, compiles CSS and JS into `themes/spcs/build/` |
| `npm run wp:start` / `wp:stop` / `wp:reset` | Local WordPress |
| `node tools/shot.mjs / 1440 home 7000` | Full-page screenshot into `.wp/shots/` |
| `node tools/contrast.mjs` | Audits every colour pair in the design system; exits non-zero on failure |
| `tools/responsive-check.js` | Paste into a browser console to find overflow and small tap targets |

`themes/spcs/build/` is committed on purpose — the theme folder can be zipped and uploaded to a
managed host without running a build there.

---

## Layout of the repo

```
themes/spcs/            The theme. Presentation only.
  theme.json            Design tokens — colour, type scale, spacing. Single source of truth.
  src/css/              Authored CSS, compiled to build/main.css
  src/js/motion.js      Navigation, FAQ disclosure, reveals, counters
  patterns/             16 block patterns; pages are assembled from these
  parts/, templates/    Block template parts and templates
  inc/                  Setup, asset loading, navigation, editor guardrails

plugins/spcs-core/      The content. Survives a theme change.
  inc/post-types.php    Studies, outcomes, testimonials, FAQs, partners
  inc/meta.php          Field definitions   inc/admin-fields.php  their admin UI
  inc/render.php        Blocks that render those lists
  inc/demo-form.php     The team-training inquiry form, storage and notifications
  inc/schema.php        JSON-LD   inc/seed.php  starter content   inc/pages.php  page scaffolding
```

**Why two packages.** Studies, testimonials, FAQs, partners and training inquiries are *content*. Putting
their registration in the theme would delete them from the admin the moment anyone switched themes.
Anything that would still be true under a different design lives in the plugin.

---

## Decisions worth knowing before you change something

**Design tokens live in `theme.json`, not in CSS.** WordPress turns them into CSS custom properties
*and* into the Site Editor's colour and type pickers, so an editor can only pick things that are on
brand. `src/css/base.css` aliases them to shorter names.

**Never give a font-size or colour preset a slug containing a digit.** WordPress kebab-cases them:
a slug of `h2` becomes `--wp--preset--font-size--h-2`, so every rule referencing
`--wp--preset--font-size--h2` silently falls back and headings render at body size. The scale is
therefore named `micro`, `small`, `base`, `lead`, `title-sm`, `title`, `headline`, `display`,
`statistic`.

**Semantic CSS classes, not utility classes.** Block markup is stored in the database. A utility
class saved into post content can lose its styles when a build re-scans only the theme files, and
the failure is invisible until someone looks at the page. Component classes cannot drift that way.

**No animation library.** Reveals use IntersectionObserver and the Web Animations API — 1.3KB
gzipped. GSAP with ScrollTrigger was the original plan and cost 46KB gzipped for the same six
effects, which is not a reasonable thing to send to a student on a bad connection.

**Colour has three functional variants that are not the brand colour.** `--coral-ink`, `--sky-deep`
and `--field-border` exist because the brand coral and sky do not reach 4.5:1 as small text, and the
hairline grey does not reach 3:1 as an input border. Use the brand colours for rules and fills; use
these when the thing carries meaning. `node tools/contrast.mjs` enforces it.

**The header, footer and crisis bar are rendered by PHP, not assembled from blocks.** They must be
identical on every page and must not be editable into a state that removes the crisis resources or
breaks keyboard navigation. Their text is filterable — see `spcs_nav_items` and
`spcs_crisis_resources` in `themes/spcs/inc/nav.php`.

---

## Before launch

- [ ] Replace the stock photography in `themes/spcs/assets/img/` (Pexels campus shots plus the
      newer Unsplash `about-training-*` and `instructor-workshop-*` images) with real photographs.
      All current images are correctly licensed but they are stock.
- [ ] Confirm SPRC's usage terms for the Best Practices Registry badge.
- [ ] Check whether SAMHSA requires a funding-disclaimer line.
- [ ] Wire up the real destinations for the three placeholder links on `/become-an-instructor/`
      ("Register Now" ×2) and `/store/` ("Shop Glad You're Here") once the live-training schedule,
      self-paced checkout and Printify pop-up store exist. They currently point at `#`.
- [ ] Build the Newsroom feed and the Instructor Login portal — both are placeholder pages for now.
- [ ] Refresh the outcome figures — "900+ students across six institutions" is from the 2023 manual.
- [ ] Have counsel review `/privacy/`.
- [ ] Set the training-inquiry notification address (`spcs_demo_notification_email` filter or the
      site admin email) and confirm the host actually delivers `wp_mail`.
- [ ] Decide whether Clover's existing SPCS page 301s here or stays as a stub.

---

## Verification performed

Run against the local install after the September 2026 content/nav rework; see the session notes for
the commands. The a11y and JSON-LD sweep below predates that rework and should be re-run before launch
— the page set, nav and form copy all changed since it was last done in full.

- All 9 pages plus the 404 return 200 and produce no PHP notices (spot-checked this session).
- 36/36 colour pairs pass `tools/contrast.mjs` (re-run this session, still passing).
- **axe-core, WCAG 2.2 AA: 0 violations** — last full run predates the content rework; re-run before launch.
- Demo/training-inquiry form: validation, honeypot, timing trap, rate limit, nonce rejection, storage
  and both emails — logic unchanged, copy relabelled; re-test the emails' new wording before launch.
- JSON-LD (`EducationalOccupationalProgram`, `FAQPage`, `ScholarlyArticle`) updated to point at
  `/about/` instead of the retired `/the-program/` and `/evidence/` pages — re-validate before launch.
- Reduced-motion rendering last verified by capturing with `--force-prefers-reduced-motion`; re-check
  the new testimonial carousel and pricing band under that flag.
- No discouraged phrasing on any current page.
