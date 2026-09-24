/**
 * Copies the two variable font files we actually use out of node_modules and
 * into the theme, so the theme directory is self-contained and deployable
 * without a node_modules folder on the server.
 *
 * We deliberately self-host rather than linking Google Fonts: higher-ed IT
 * reviewers flag third-party font CDNs during privacy review.
 */
import { copyFile, mkdir } from 'node:fs/promises';
import { dirname, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const dest = resolve(root, 'themes/spcs/assets/fonts');

/**
 * Fraunces "soft" subset carries the wght + SOFT axes (62KB) — we need SOFT to
 * take the edge off the serif. The "full" file adds opsz + WONK for twice the
 * weight and we use neither.
 */
const files = [
  [
    'node_modules/@fontsource-variable/fraunces/files/fraunces-latin-soft-normal.woff2',
    'fraunces-var.woff2',
  ],
  [
    'node_modules/@fontsource-variable/instrument-sans/files/instrument-sans-latin-wght-normal.woff2',
    'instrument-sans-var.woff2',
  ],
];

await mkdir(dest, { recursive: true });

for (const [from, to] of files) {
  await copyFile(resolve(root, from), resolve(dest, to));
  console.log(`fonts: ${to}`);
}
