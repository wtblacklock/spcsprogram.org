/**
 * spcsprogram.org — motion and interaction.
 *
 * No animation library. The motion budget here is six effects: a hero stagger,
 * section fades on scroll, and one counter. GSAP with ScrollTrigger costs about
 * 46KB gzipped to deliver that; IntersectionObserver and the Web Animations API
 * are built into every browser this site supports and cost nothing. On a
 * suicide-prevention site that students may open on a bad connection, 46KB of
 * JavaScript for six fades is not a defensible trade.
 *
 * Every animation is gated on prefers-reduced-motion. When reduced motion is
 * requested nothing here sets a transform, and the pre-animation state in CSS
 * never applies, so the page renders as static HTML.
 */

const reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' );

const EASE = 'cubic-bezier(0.16, 0.84, 0.44, 1)';

/* ── Navigation ───────────────────────────────────────────────────────── */

function initNav() {
	const toggle = document.querySelector( '.spcs-nav__toggle' );
	const nav = document.querySelector( '.spcs-nav' );

	if ( ! toggle || ! nav ) return;

	const setOpen = ( open ) => {
		toggle.setAttribute( 'aria-expanded', String( open ) );
		nav.dataset.open = String( open );
		document.body.style.overflow = open ? 'hidden' : '';
	};

	setOpen( false );

	toggle.addEventListener( 'click', () => {
		setOpen( toggle.getAttribute( 'aria-expanded' ) !== 'true' );
	} );

	// Escape closes the panel and returns focus to the control that opened it.
	document.addEventListener( 'keydown', ( event ) => {
		if ( event.key === 'Escape' && toggle.getAttribute( 'aria-expanded' ) === 'true' ) {
			setOpen( false );
			toggle.focus();
		}
	} );

	// Following a link inside the panel should not leave the body scroll locked.
	nav.addEventListener( 'click', ( event ) => {
		if ( event.target.closest( 'a' ) ) setOpen( false );
	} );

	// Reset state when the viewport grows past the mobile breakpoint.
	window.matchMedia( '(min-width: 64em)' ).addEventListener( 'change', ( event ) => {
		if ( event.matches ) setOpen( false );
	} );
}

/* ── FAQ disclosure ───────────────────────────────────────────────────── */

function initFaq() {
	document.querySelectorAll( '.spcs-faq__question' ).forEach( ( button ) => {
		const answer = document.getElementById( button.getAttribute( 'aria-controls' ) );

		if ( ! answer ) return;

		button.addEventListener( 'click', () => {
			const open = button.getAttribute( 'aria-expanded' ) === 'true';
			button.setAttribute( 'aria-expanded', String( ! open ) );
			answer.hidden = open;
		} );
	} );
}

/*
 * The student-quote marquee (`.spcs-quote-marquee`) scrolls continuously,
 * pauses on hover/focus, and switches off under reduced motion — all in CSS
 * (see components.css). There is nothing for JS to do here.
 */

/* ── Reveals ──────────────────────────────────────────────────────────── */

/**
 * Fade and lift an element into place, then clear the inline state so nothing
 * is left holding a transform.
 *
 * @param {Element} element Target.
 * @param {number}  delay   Milliseconds to wait before starting.
 */
function reveal( element, delay = 0 ) {
	const animation = element.animate(
		[
			{ opacity: 0, transform: 'translateY(14px)' },
			{ opacity: 1, transform: 'none' },
		],
		{ duration: 650, delay, easing: EASE, fill: 'both' }
	);

	animation.finished
		.then( () => {
			animation.cancel();
			element.style.opacity = '1';
		} )
		.catch( () => {
			// A cancelled animation is not an error worth surfacing.
		} );
}

function initHero() {
	const targets = [ '.spcs-hero__headline', '.spcs-hero__standfirst' ]
		.map( ( selector ) => document.querySelector( selector ) )
		.filter( Boolean );

	targets.forEach( ( element, index ) => reveal( element, 60 + index * 100 ) );

	/*
	 * `.spcs-hero__actions` is reused on every purple CTA band, not just the
	 * homepage hero — reveal every instance, not just the first one a plain
	 * querySelector would find, or later bands stay stuck at opacity:0.
	 */
	document.querySelectorAll( '.spcs-hero__actions' ).forEach( ( element ) => reveal( element, 260 ) );
}

function initReveals() {
	const items = document.querySelectorAll( '[data-reveal]' );

	if ( ! items.length ) return;

	const observer = new IntersectionObserver(
		( entries ) => {
			entries.forEach( ( entry ) => {
				if ( ! entry.isIntersecting ) return;
				observer.unobserve( entry.target );
				reveal( entry.target );
			} );
		},
		// Start slightly before the element reaches the fold.
		{ rootMargin: '0px 0px -12% 0px', threshold: 0 }
	);

	items.forEach( ( item ) => observer.observe( item ) );
}

/* ── Statistic counters ───────────────────────────────────────────────── */

/**
 * Counts up to the value already in the markup.
 *
 * The final text is the source of truth: it is parsed, animated towards, and
 * then written back verbatim. If this never runs, the correct figure is already
 * on screen.
 */
function initCounters() {
	const counters = document.querySelectorAll( '[data-count]' );

	if ( ! counters.length ) return;

	const observer = new IntersectionObserver(
		( entries ) => {
			entries.forEach( ( entry ) => {
				if ( ! entry.isIntersecting ) return;

				observer.unobserve( entry.target );
				countUp( entry.target );
			} );
		},
		{ rootMargin: '0px 0px -15% 0px', threshold: 0 }
	);

	counters.forEach( ( counter ) => observer.observe( counter ) );
}

/**
 * @param {Element} element Element whose text ends at the target number.
 */
function countUp( element ) {
	const finalText = element.textContent.trim();
	const firstDigit = finalText.search( /[0-9]/ );

	if ( firstDigit === -1 ) return;

	const target = parseFloat( finalText.slice( firstDigit ).replace( /[^0-9.]/g, '' ) );

	if ( Number.isNaN( target ) ) return;

	const prefix = finalText.slice( 0, firstDigit );
	const suffix = finalText.slice( firstDigit ).replace( /^[0-9.,]+/, '' );
	const decimals = ( String( target ).split( '.' )[ 1 ] || '' ).length;
	const duration = 1400;
	const start = performance.now();

	const step = ( now ) => {
		const elapsed = Math.min( ( now - start ) / duration, 1 );
		// easeOutCubic — fast at first, settling into the final figure.
		const eased = 1 - Math.pow( 1 - elapsed, 3 );
		const value = target * eased;

		element.textContent =
			prefix +
			value.toLocaleString( 'en-US', {
				minimumFractionDigits: decimals,
				maximumFractionDigits: decimals,
			} ) +
			suffix;

		if ( elapsed < 1 ) {
			requestAnimationFrame( step );
		} else {
			element.textContent = finalText;
		}
	};

	requestAnimationFrame( step );
}

/* ── Boot ─────────────────────────────────────────────────────────────── */

/**
 * Last resort: drop the `js` class so the CSS pre-animation state stops
 * applying and everything becomes visible.
 */
function revealEverything() {
	document.documentElement.classList.remove( 'js' );
}

function init() {
	initNav();
	initFaq();

	// The `js` class is set by an inline script in <head> so the pre-animation
	// state applies before first paint; it is absent under reduced motion.
	if ( reduceMotion.matches || ! document.documentElement.classList.contains( 'js' ) ) {
		return;
	}

	try {
		initHero();
		initReveals();
		initCounters();
	} catch ( error ) {
		revealEverything();
		// Surfacing this beats a silently blank page.
		console.error( 'SPCS motion failed; content revealed without animation.', error );
	}
}

if ( document.readyState === 'loading' ) {
	document.addEventListener( 'DOMContentLoaded', init );
} else {
	init();
}

/*
 * Belt and braces: if anything above never ran — a bundle that failed to parse,
 * an extension that blocked it — the page must not stay hidden.
 */
window.addEventListener( 'load', () => {
	window.setTimeout( () => {
		const hero = document.querySelector( '.spcs-hero__headline' );

		if ( hero && window.getComputedStyle( hero ).opacity === '0' ) {
			revealEverything();
		}
	}, 1200 );
} );
