/**
 * Contrast audit over the design tokens.
 *
 * axe's colour-contrast rule resolves an element's background by hit-testing
 * the viewport, so on a long page it reports the body colour for anything
 * scrolled out of view and produces false failures. This checks the pairs the
 * design system actually uses, which is deterministic and does not depend on
 * where the page happens to be scrolled.
 *
 * Usage: node tools/contrast.mjs
 */

const T = {
	plum: '#34234C',
	purple: '#673391',
	purpleDeep: '#4A2069',
	purpleWash: '#F2EDF6',
	coral: '#F0526A',
	sky: '#2CB3E7',
	blush: '#F59395',
	paper: '#FBFAF8',
	stone: '#E4DFDB',
	quiet: '#6B6472',
	white: '#FFFFFF',
	error: '#B3103A',
	fieldBorder: '#8B8391',
	skyDeep: '#1B87B4',
	coralInk: '#C62A48',
	errorBg: '#FDF2F4',
};

const srgb = (hex) =>
	[1, 3, 5].map((i) => {
		const c = parseInt(hex.slice(i, i + 2), 16) / 255;
		return c <= 0.03928 ? c / 12.92 : ((c + 0.055) / 1.055) ** 2.4;
	});

const luminance = (hex) => {
	const [r, g, b] = srgb(hex);
	return 0.2126 * r + 0.7152 * g + 0.0722 * b;
};

/** Flatten a translucent foreground onto its background. */
const blend = (hex, alpha, bgHex) => {
	const px = (h, i) => parseInt(h.slice(i, i + 2), 16);
	const mix = (i) => Math.round(px(hex, i) * alpha + px(bgHex, i) * (1 - alpha));
	return (
		'#' +
		[1, 3, 5]
			.map((i) => mix(i).toString(16).padStart(2, '0'))
			.join('')
			.toUpperCase()
	);
};

const ratio = (a, b) => {
	const [l1, l2] = [luminance(a), luminance(b)].sort((x, y) => y - x);
	return (l1 + 0.05) / (l2 + 0.05);
};

/**
 * Every foreground/background pair the stylesheets put on screen.
 * `large` marks text at >=24px, or >=18.66px bold, where AA is 3:1.
 */
const pairs = [
	['Body text', T.plum, T.paper],
	['Headings', T.plum, T.paper],
	['Links', T.purple, T.paper],
	['Link hover', T.purpleDeep, T.paper],
	['Quiet text (eyebrow, source, hints)', T.quiet, T.paper],
	['Statistic value', T.purple, T.paper, true],
	['Citation finding', T.purple, T.paper],
	['Text link', T.purple, T.paper],
	['Button label', T.white, T.purple],
	['Button label on hover', T.white, T.purpleDeep],
	['Inverse button label', T.purple, T.white],
	['Crisis bar text', T.plum, T.purpleWash],
	['Crisis bar link', T.purpleDeep, T.purpleWash],
	['Footer body', T.white, T.plum],
	['Footer section label (60% white)', blend(T.white, 0.6, T.plum), T.plum],
	['Footer legal line (66% white)', blend(T.white, 0.66, T.plum), T.plum],
	['Dark panel body', T.white, T.purple],
	['Dark panel eyebrow (72% white)', blend(T.white, 0.72, T.purple), T.purple],
	['Dark panel source (66% white)', blend(T.white, 0.66, T.purple), T.purple],
	['Plum panel body', T.white, T.plum],
	['Facts label on plum (78% white)', blend(T.white, 0.78, T.plum), T.plum],
	['Facts label on paper', T.quiet, T.paper],
	['Facts value on plum', T.white, T.plum],
	['Outcomes band on plum', T.white, T.plum],
	['Form error text', T.error, T.errorBg],
	['Form error on paper', T.error, T.paper],
	['Hero standfirst (86% plum)', blend(T.plum, 0.86, T.paper), T.paper],
	['Timeline body (86% plum)', blend(T.plum, 0.86, T.paper), T.paper],
	// Non-text, 3:1 applies (WCAG 1.4.11).
	['Focus ring on paper', T.purple, T.paper, true],
	['Phase top rule', T.plum, T.paper, true],
	['Coral accent rule (non-text)', T.coral, T.paper, true],
	['Phase number / step label (12-13px)', T.coralInk, T.paper],
	['Required-field asterisk', T.coralInk, T.paper],
	['Phase bullet', T.skyDeep, T.paper, true],
	['Input border', T.fieldBorder, T.white, true],
	['Input border on paper', T.fieldBorder, T.paper, true],
];

let failures = 0;

console.log('\n  Pair                                        ratio   need   result');
console.log('  ' + '─'.repeat(68));

for (const [name, fg, bg, large] of pairs) {
	const r = ratio(fg, bg);
	const need = large ? 3 : 4.5;
	const ok = r >= need;
	if (!ok) failures++;
	console.log(
		`  ${name.padEnd(42)} ${r.toFixed(2).padStart(5)}  ${String(need).padStart(4)}   ${ok ? 'pass' : 'FAIL'}`
	);
}

console.log('  ' + '─'.repeat(68));
console.log(`  ${pairs.length - failures}/${pairs.length} pass\n`);

process.exit(failures ? 1 : 0);
