# Editing spcsprogram.org

Written for whoever maintains the site day to day. No code required for anything on this page.

---

## The rule that matters most

**Everything on this site follows safe messaging practice** — the same guidance the SPCS curriculum
teaches facilitators. It is not a style preference. A suicide prevention program whose own website
contradicts its training loses credibility with exactly the people it is trying to reach.

| Write this | Not this |
|---|---|
| died by suicide, suicide death | committed suicide |
| suicide attempt | successful / failed / unsuccessful suicide |
| a person living with schizophrenia | a schizophrenic |
| a person who is struggling | crazy, psycho |

Also:

- **Never describe method or means.** Not in a story, not in a statistic, not in a caption.
- **Put a help resource next to any statistic about risk.** A number without a way out is harmful.
- **Do not present suicide as inexplicable, romantic or inevitable.**
- **No graphic imagery.**

If you save a page containing discouraged wording, WordPress shows a warning at the top of the
editor telling you which phrase it found and what the curriculum uses instead. It never blocks you
from publishing — there are legitimate reasons to quote unsafe language, such as the panel on the
Program page that quotes it in order to teach against it.

The 988 Lifeline appears automatically at the top and bottom of every page. You never need to add it.

---

## Adding and editing pages

Pages are built from **patterns** — pre-designed sections. In the editor, click **+**, choose
**Patterns**, and pick one of the SPCS categories:

| Category | Contains |
|---|---|
| SPCS — page openers | The hero, and the standard opener for interior pages |
| SPCS — evidence & credibility | The badge strip, outcome statistics, the citation list |
| SPCS — program content | The three-phase model, the implementation timeline |
| SPCS — editorial blocks | Text-and-image arrangements, pull quotes, colour-block panels |
| SPCS — calls to action | The closing demo prompt |

Insert a pattern and edit the words directly. Everything is real, editable blocks — there is nothing
locked inside them.

**Use one page opener per page, at the top.** It carries the `<h1>`, and a page needs exactly one.

### What you cannot edit from the editor

The header, the footer and the crisis resources bar are rendered by the theme so they stay identical
and accessible everywhere. Changing their links or wording is a small code change — ask a developer
for `themes/spcs/inc/nav.php`.

---

## Adding content that appears in several places

Some content lives in its own section of the admin so it can be reused and stays consistent. Adding
an entry makes it appear everywhere that type is shown, in the order you set with **Order**.

### Studies → the Evidence page

Add the title, authors, year, journal, volume/pages, a link or DOI, and a **key finding**.

The key finding is the important field. Write one plain sentence a non-researcher can act on —
"Virtual delivery produced outcomes comparable to in-person delivery", not a restatement of the
abstract. It is what a vice president actually reads.

### Outcomes → the statistics band

A value (`45%`, `900+`), a label, and a **source**. The source is required by convention: every
number on this site must be attributable. If you cannot cite it, do not publish it.

### Testimonials → student voices

The quote goes in the main content area. Set the attribution to a **role, never a name** —
participants are anonymous.

Tick **Cleared for public use**. Quotes without it are not displayed. An unticked box is treated as
"no", not as "not decided yet", so a quote can never reach the site by accident.

### FAQs → the FAQ page

A question as the title, the answer as content, and a **group**: `Delivery`, `Evidence`,
`Implementation` or `Data`. The group decides which section of the page it lands in — a typo in the
group name means the question will not appear anywhere.

FAQs are also published as structured data, so they can appear directly in search results.

### Partners → the credibility strip

Upload the logo as the featured image, add the website, and set the type to `funder`, `campus` or
`accreditor`. Logos display in grey and come to full colour on hover.

---

## Photography

Replace an image by clicking it and choosing **Replace**.

What works here: real students, real campuses, ordinary moments — someone listening to a friend,
people walking between buildings. Documentary, not staged.

What does not: models in a studio, anyone pointing at a laptop, stock photography of a "concerned
conversation". It reads as false immediately, and on this subject that costs you trust.

**Always write alt text** describing what is in the photograph. Screen reader users and search
engines both depend on it, and university accessibility reviewers check.

---

## Demo requests

Submissions appear under **Demo requests** in the admin, and a notification email goes to the team
inbox. The person who submitted gets an automatic confirmation.

Nothing is deleted automatically. Delete old requests periodically — the privacy notice says you
keep them only while an enquiry is active.

The form is protected by a hidden field, a timing check and a rate limit. There is no CAPTCHA, on
purpose: CAPTCHAs send visitor data to a third party and are a barrier for disabled users.

---

## Things worth not doing

- **Do not add new colours.** The palette is deliberately narrow, and every combination in it has
  been checked for contrast. The picker only offers approved colours for this reason.
- **Do not make text smaller** to fit more in. Cut words instead.
- **Do not add a section of three identical boxes with icons.** The layout deliberately avoids it —
  it is the single strongest signal that a site was assembled from a template.
- **Do not add tracking scripts** without asking. The site currently loads nothing from a third
  party, including fonts, and that is a claim the privacy notice makes.
- **Do not put a number on the site without its source.**
