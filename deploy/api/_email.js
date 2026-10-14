// Branded HTML for the inquiry emails. Table layout and inline styles, because
// that is what email clients reliably render. The underscore keeps Vercel from
// treating this file as its own endpoint.

const SITE = 'https://spcsprogram.org';
const MARK = `${SITE}/wp-content/themes/spcs/assets/img/apple-touch-icon.png`;

const C = {
	plum: '#34234C',
	purple: '#673391',
	wash: '#F2EDF6',
	coral: '#F0526A',
	paper: '#FBFAF8',
	quiet: '#6B6472',
	rule: '#E4DFDB',
};

const FONT = "-apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif";
const SERIF = "Georgia, 'Times New Roman', serif";

function esc(s) {
	return String(s)
		.replace(/&/g, '&amp;')
		.replace(/</g, '&lt;')
		.replace(/>/g, '&gt;')
		.replace(/"/g, '&quot;')
		.replace(/'/g, '&#39;');
}

function layout({ preheader, eyebrow, heading, body, footer = true }) {
	return `<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>${esc(heading)}</title></head>
<body style="margin:0;padding:0;background:${C.wash};">
<div style="display:none;max-height:0;overflow:hidden;opacity:0;">${esc(preheader)}</div>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:${C.wash};">
<tr><td align="center" style="padding:32px 16px;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;">
	<tr><td style="background:${C.plum};padding:24px 32px;border-radius:12px 12px 0 0;">
		<table role="presentation" cellpadding="0" cellspacing="0"><tr>
			<td style="padding-right:14px;vertical-align:middle;"><img src="${MARK}" width="44" height="44" alt="" style="display:block;border-radius:10px;"></td>
			<td style="vertical-align:middle;font-family:${SERIF};color:#ffffff;">
				<div style="font-size:22px;font-weight:bold;line-height:1.1;">SPCS</div>
				<div style="font-family:${FONT};font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:#D9CCE6;padding-top:3px;">Suicide Prevention for College Students</div>
			</td>
		</tr></table>
	</td></tr>
	<tr><td style="height:4px;background:${C.coral};font-size:0;line-height:0;">&nbsp;</td></tr>
	<tr><td style="background:#ffffff;padding:32px;font-family:${FONT};color:${C.plum};${footer ? '' : 'border-radius:0 0 12px 12px;'}">
		${eyebrow ? `<div style="font-size:12px;letter-spacing:1.5px;text-transform:uppercase;color:${C.purple};font-weight:bold;">${esc(eyebrow)}</div>` : ''}
		<h1 style="margin:8px 0 20px;font-family:${SERIF};font-size:26px;line-height:1.25;color:${C.plum};font-weight:normal;">${esc(heading)}</h1>
		${body}
	</td></tr>
	${footer ? `<tr><td style="background:${C.paper};padding:20px 32px;border-radius:0 0 12px 12px;font-family:${FONT};font-size:12px;line-height:1.6;color:${C.quiet};border-top:1px solid ${C.rule};">
		If you or someone you know needs support now, call or text <a href="tel:988" style="color:${C.purple};font-weight:bold;">988</a> or go to <a href="https://988lifeline.org/" style="color:${C.purple};">988Lifeline.org</a>.<br>
		Clover Educational Consulting Group &middot; <a href="${SITE}" style="color:${C.purple};">spcsprogram.org</a>
	</td></tr>` : ''}
</table>
</td></tr>
</table>
</body>
</html>`;
}

function teamEmail(values, fields) {
	const name = `${values.first_name} ${values.last_name}`.trim();
	const rows = fields
		.filter(([key]) => values[key])
		.map(
			([key, label]) => `<tr>
				<td style="padding:10px 0;border-bottom:1px solid ${C.rule};font-size:12px;letter-spacing:1px;text-transform:uppercase;color:${C.quiet};vertical-align:top;width:38%;">${esc(label)}</td>
				<td style="padding:10px 0 10px 12px;border-bottom:1px solid ${C.rule};font-size:15px;line-height:1.5;color:${C.plum};vertical-align:top;white-space:pre-wrap;">${key === 'email' ? `<a href="mailto:${esc(values.email)}" style="color:${C.purple};">${esc(values.email)}</a>` : esc(values[key])}</td>
			</tr>`
		)
		.join('');

	const body = `
		<p style="margin:0 0 20px;font-size:15px;line-height:1.6;">${esc(name)} from <strong>${esc(values.institution)}</strong> wants to talk about training their team.</p>
		<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-top:1px solid ${C.rule};">${rows}</table>
		<table role="presentation" cellpadding="0" cellspacing="0" style="margin-top:28px;"><tr>
			<td style="background:${C.purple};border-radius:999px;">
				<a href="mailto:${esc(values.email)}?subject=${encodeURIComponent('Re: SPCS team training')}" style="display:inline-block;padding:13px 26px;font-size:15px;font-weight:bold;color:#ffffff;text-decoration:none;">Reply to ${esc(values.first_name)}</a>
			</td>
		</tr></table>`;

	return layout({
		preheader: `${name}, ${values.institution}`,
		eyebrow: 'New team training inquiry',
		heading: values.institution,
		body,
	});
}

function confirmationEmail(values) {
	const body = `
		<p style="margin:0 0 16px;font-size:16px;line-height:1.6;">Thank you for your interest in bringing Suicide Prevention for College Students (SPCS) to your campus. Someone from our training team will reply within five working days.</p>
		<p style="margin:24px 0 0;font-size:16px;line-height:1.6;">Warmly,<br><br>The SPCS Team<br><a href="${SITE}" style="color:${C.purple};">spcsprogram.org</a></p>`;

	return layout({
		preheader: 'Someone from our training team will reply within five working days.',
		heading: `Hello ${values.first_name},`,
		body,
		footer: false,
	});
}

module.exports = { teamEmail, confirmationEmail };
