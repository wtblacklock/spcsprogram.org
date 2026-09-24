/**
 * Full-page screenshots for design review.
 *
 * Uses the installed Chrome in headless mode. `--force-prefers-reduced-motion`
 * matters: it makes the capture deterministic (the entry animations are skipped
 * entirely rather than caught mid-flight) *and* it doubles as a check that the
 * reduced-motion path renders the complete page.
 *
 * CAVEAT: headless Chrome enforces a minimum window width (around 500px on
 * macOS). Ask for 390 and you get a 390px-wide *image* of a page that was laid
 * out wider, so text appears clipped and media queries look broken when they are
 * not. Do not judge mobile from these captures — verify small screens by
 * measuring element rectangles in a real browser viewport instead.
 *
 * Usage: node tools/shot.mjs <path> [width] [outputName] [height]
 *   node tools/shot.mjs / 1440 home 7000
 *   node tools/shot.mjs /evidence/ 1024 evidence-tablet 5000
 */
import { execFileSync } from 'node:child_process';
import { mkdirSync } from 'node:fs';
import { dirname, resolve, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const outDir = join(root, '.wp', 'shots');
const CHROME = '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome';

const path = process.argv[2] || '/';
const width = process.argv[3] || '1440';
const name = process.argv[4] || 'shot';

mkdirSync(outDir, { recursive: true });

const out = join(outDir, `${name}.png`);

execFileSync(
	CHROME,
	[
		'--headless=new',
		'--disable-gpu',
		'--hide-scrollbars',
		'--force-prefers-reduced-motion',
		'--virtual-time-budget=6000',
		// Headless captures exactly the window, so the window has to be the page.
		`--window-size=${width},${process.argv[5] || 8000}`,
		'--screenshot=' + out,
		`http://localhost:${process.env.SPCS_PORT || 8765}${path}`,
	],
	{ stdio: ['ignore', 'ignore', 'ignore'] }
);

console.log(out);
