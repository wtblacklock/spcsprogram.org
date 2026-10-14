// Team-training inquiry form handler (Vercel serverless function).
//
// The public site is a static export of the WordPress build, so the form posts
// here instead of to WordPress. Mail goes out through Resend.
//
// Environment variables (set in the Vercel project):
//   RESEND_API_KEY  Resend API key
//   CONTACT_TO      where inquiries are delivered
//   CONTACT_FROM    verified sender, e.g. "SPCS <hello@spcsprogram.org>"

const { teamEmail, confirmationEmail } = require('./_email.js');

const FIELDS = [
	['first_name', 'First name', true],
	['last_name', 'Last name', true],
	['email', 'Work email', true],
	['institution', 'Organization or campus', true],
	['role', 'Your role', false],
	['timeline', 'When are you hoping to train your team?', false],
	['message', 'Anything you want us to know', false],
];

const RETURN_PATH = '/become-an-instructor/';
const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

function back(res, status) {
	res.statusCode = 303;
	res.setHeader('Location', `${RETURN_PATH}?form=${status}#connect`);
	res.end();
}

async function send(apiKey, payload) {
	const response = await fetch('https://api.resend.com/emails', {
		method: 'POST',
		headers: {
			Authorization: `Bearer ${apiKey}`,
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(payload),
	});

	if (!response.ok) {
		throw new Error(`Resend ${response.status}: ${await response.text()}`);
	}
}

module.exports = async (req, res) => {
	if (req.method !== 'POST') {
		res.statusCode = 405;
		res.setHeader('Allow', 'POST');
		res.end();
		return;
	}

	const body = req.body && typeof req.body === 'object' ? req.body : {};

	// Honeypot: bots fill every field. Pretend it worked and send nothing.
	if (String(body.spcs_website || '').trim() !== '') {
		back(res, 'sent');
		return;
	}

	const values = {};
	for (const [key, , required] of FIELDS) {
		const limit = key === 'message' ? 5000 : 200;
		values[key] = String(body[key] || '').trim().slice(0, limit);
		if (required && !values[key]) {
			back(res, 'error');
			return;
		}
	}

	if (!EMAIL_RE.test(values.email)) {
		back(res, 'error');
		return;
	}

	const { RESEND_API_KEY, CONTACT_TO, CONTACT_FROM } = process.env;
	if (!RESEND_API_KEY || !CONTACT_TO || !CONTACT_FROM) {
		console.error('[contact] missing env', {
			apiKey: !!RESEND_API_KEY,
			to: !!CONTACT_TO,
			from: !!CONTACT_FROM,
		});
		back(res, 'error');
		return;
	}

	const oneLine = (s) => s.replace(/[\r\n]+/g, ' ');
	const lines = FIELDS.filter(([key]) => values[key]).map(([key, label]) => `${label}: ${values[key]}`);

	try {
		await send(RESEND_API_KEY, {
			from: CONTACT_FROM,
			to: CONTACT_TO.split(',').map((s) => s.trim()),
			reply_to: values.email,
			subject: `SPCS team training inquiry: ${oneLine(values.institution)}`,
			text: lines.join('\n'),
			html: teamEmail(values, FIELDS),
		});
	} catch (err) {
		console.error('[contact] team email failed', err);
		back(res, 'error');
		return;
	}

	try {
		await send(RESEND_API_KEY, {
			from: CONTACT_FROM,
			to: values.email,
			reply_to: CONTACT_TO.split(',').map((s) => s.trim()),
			subject: 'We received your SPCS team training inquiry',
			text:
				`Hello ${oneLine(values.first_name)},\n\n` +
				'Thank you for your interest in bringing Suicide Prevention for College Students (SPCS) to your team. Someone from our training team will reply within two working days.\n\n' +
				'If anything is urgent, just reply to this email and we will move faster.\n\n' +
				'If you are looking for support right now, the 988 Suicide and Crisis Lifeline is available 24/7. Call or text 988.\n\n' +
				'Clover Educational Consulting Group\nspcsprogram.org',
			html: confirmationEmail(values),
		});
	} catch (err) {
		// The inquiry already reached the team; a failed courtesy copy shouldn't show an error.
		console.error('[contact] confirmation email failed', err);
	}

	back(res, 'sent');
};
