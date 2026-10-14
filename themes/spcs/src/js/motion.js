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

	const label = toggle.querySelector( '.spcs-nav__label' );
	const closedText = label ? label.textContent : '';

	const setOpen = ( open ) => {
		toggle.setAttribute( 'aria-expanded', String( open ) );
		nav.dataset.open = String( open );
		document.body.style.overflow = open ? 'hidden' : '';
		if ( label ) label.textContent = open ? label.dataset.openLabel : closedText;
	};

	// A tap anywhere outside the open panel closes it.
	document.addEventListener( 'click', ( event ) => {
		if ( toggle.getAttribute( 'aria-expanded' ) !== 'true' ) return;
		if ( nav.contains( event.target ) || toggle.contains( event.target ) ) return;
		setOpen( false );
	} );

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

/* ── Student quote carousel ───────────────────────────────────────────── */

const QUOTE_INTERVAL = 8000;

/*
 * Enhances the scroll-snap quote track with arrows, a counter, a pause button
 * and a slow auto-advance. Auto-advance pauses while the carousel is hovered,
 * touched, focused or off screen, stops for good once someone navigates it
 * themselves, and never starts under reduced motion.
 */
function initQuotes() {
	document.querySelectorAll( '[data-quotes]' ).forEach( ( root ) => {
		const track = root.querySelector( '.spcs-quotes__track' );
		const controls = root.querySelector( '.spcs-quotes__controls' );
		const count = root.querySelector( '.spcs-quotes__count' );
		const pause = root.querySelector( '.spcs-quotes__pause' );
		const slides = Array.from( track.children );

		if ( ! controls || slides.length < 2 ) return;

		controls.hidden = false;

		let playing = ! reduceMotion.matches;
		let held = false;
		let visible = false;

		const current = () => {
			const left = track.scrollLeft;
			let best = 0;
			slides.forEach( ( slide, index ) => {
				if ( Math.abs( slide.offsetLeft - left ) < Math.abs( slides[ best ].offsetLeft - left ) ) best = index;
			} );
			return best;
		};

		const atEnd = () => track.scrollLeft >= track.scrollWidth - track.clientWidth - 4;

		const go = ( step ) => {
			let target = current() + step;
			if ( step > 0 && atEnd() ) target = 0;
			if ( target < 0 ) target = slides.length - 1;
			track.scrollTo( { left: slides[ target ].offsetLeft, behavior: reduceMotion.matches ? 'auto' : 'smooth' } );
		};

		const setPlaying = ( value ) => {
			playing = value;
			pause.setAttribute( 'aria-pressed', String( ! value ) );
			pause.textContent = value ? pause.dataset.pauseLabel : pause.dataset.playLabel;
		};

		const tick = () => {
			if ( playing && ! held && visible ) go( 1 );
		};

		const updateCount = () => {
			const index = atEnd() ? slides.length - 1 : current();
			count.textContent = `${ index + 1 } / ${ slides.length }`;
		};

		let frame = 0;
		track.addEventListener( 'scroll', () => {
			cancelAnimationFrame( frame );
			frame = requestAnimationFrame( updateCount );
		} );

		controls.querySelectorAll( '[data-step]' ).forEach( ( button ) => {
			button.addEventListener( 'click', () => {
				setPlaying( false );
				go( Number( button.dataset.step ) );
			} );
		} );

		pause.addEventListener( 'click', () => setPlaying( ! playing ) );

		// Someone swiping or dragging is reading; don't pull the quote away from them.
		track.addEventListener( 'pointerdown', () => setPlaying( false ) );
		track.addEventListener( 'wheel', ( event ) => {
			if ( Math.abs( event.deltaX ) > Math.abs( event.deltaY ) ) setPlaying( false );
		}, { passive: true } );

		root.addEventListener( 'mouseenter', () => ( held = true ) );
		root.addEventListener( 'mouseleave', () => ( held = false ) );
		root.addEventListener( 'focusin', () => ( held = true ) );
		root.addEventListener( 'focusout', () => ( held = root.matches( ':focus-within' ) ) );

		new IntersectionObserver( ( entries ) => {
			visible = entries[ 0 ].isIntersecting;
		}, { threshold: 0.5 } ).observe( track );

		setPlaying( playing );
		window.setInterval( tick, QUOTE_INTERVAL );
		reduceMotion.addEventListener( 'change', ( event ) => {
			if ( event.matches ) setPlaying( false );
		} );
	} );
}

/* ── Reveals ──────────────────────────────────────────────────────────── */

/**
 * Fade and lift an element into place, then clear the inline state so nothing
 * is left holding a transform.
 *
 * @param {Element} element Target.
 * @param {number}  delay   Milliseconds to wait before starting.
 */
function reveal( element, delay = 0 ) {
	const from = element.dataset.reveal === 'left' ? 'translateX(-48px)' : 'translateY(14px)';
	const animation = element.animate(
		[
			{ opacity: 0, transform: from },
			{ opacity: 1, transform: 'none' },
		],
		{ duration: element.dataset.reveal === 'left' ? 900 : 650, delay, easing: EASE, fill: 'both' }
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

/* ── Form result (static site) ────────────────────────────────────────── */

/*
 * On the static site the form posts to /api/contact, which redirects back with
 * ?form=sent or ?form=error. Show the matching message in place of the form.
 */
function initFormStatus() {
	const status = new URLSearchParams( window.location.search ).get( 'form' );
	const form = document.querySelector( '.spcs-form' );

	if ( ! status || ! form ) return;

	const box = document.createElement( 'div' );
	box.tabIndex = -1;

	if ( status === 'sent' ) {
		box.className = 'spcs-form__success';
		box.setAttribute( 'role', 'status' );
		box.innerHTML =
			'<h2>Thank you. That reached us.</h2>' +
			'<p>Someone from the team will be in touch within five working days. If it is urgent, say so in a reply to the confirmation email and we will move faster.</p>';
		form.replaceWith( box );
	} else {
		box.className = 'spcs-form__errors';
		box.setAttribute( 'role', 'alert' );
		box.innerHTML =
			'<p><strong>That did not send.</strong></p>' +
			'<p>Please check that your name, a valid work email and your organization are filled in, then try again.</p>';
		form.prepend( box );
	}

	box.focus();
}

function init() {
	initNav();
	initFaq();
	initFormStatus();
	initQuotes();

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
