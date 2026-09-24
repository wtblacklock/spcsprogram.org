/**
 * Responsive audit, run by pasting into a real browser console (or the MCP
 * javascript tool) at each viewport width.
 *
 * Measures element rectangles rather than reading a screenshot, because
 * headless Chrome will not lay a page out below roughly 500px and produces
 * misleading captures at phone widths.
 *
 * Reports anything extending past the viewport, with body overflow temporarily
 * unclipped so masked overflow is caught rather than hidden.
 */
( function spcsResponsiveCheck() {
	const body = document.body;
	const previous = body.style.overflowX;

	// overflow-x: clip hides real overflow from scrollWidth; lift it to measure.
	body.style.overflowX = 'visible';
	void body.offsetWidth;

	const viewport = document.documentElement.clientWidth;

	const offenders = Array.from( document.querySelectorAll( 'body *' ) )
		.map( ( el ) => ( { el, rect: el.getBoundingClientRect() } ) )
		// The closed off-canvas menu legitimately sits outside the viewport.
		.filter( ( o ) => o.rect.right > viewport + 1 && ! o.el.closest( '.spcs-nav' ) )
		.map( ( o ) => ( {
			tag: o.el.tagName,
			cls: String( o.el.className ).slice( 0, 45 ),
			right: Math.round( o.rect.right ),
			overhang: Math.round( o.rect.right - viewport ),
		} ) );

	// Tap targets: WCAG 2.2 AA asks for 24x24 CSS px on pointer inputs.
	const smallTargets = Array.from(
		document.querySelectorAll( 'a, button, input, select, textarea, summary' )
	)
		.map( ( el ) => ( { el, rect: el.getBoundingClientRect() } ) )
		.filter(
			( o ) =>
				o.rect.width > 0 &&
				o.rect.height > 0 &&
				( o.rect.width < 24 || o.rect.height < 24 ) &&
				! o.el.closest( '.spcs-nav[data-open="false"]' )
		)
		.map( ( o ) => ( {
			text: ( o.el.textContent || o.el.name || '' ).trim().slice( 0, 30 ),
			size: `${ Math.round( o.rect.width ) }x${ Math.round( o.rect.height ) }`,
		} ) );

	body.style.overflowX = previous;

	return JSON.stringify(
		{
			viewport,
			horizontalOverflow: offenders.length > 0,
			offenders: offenders.slice( 0, 8 ),
			smallTapTargets: smallTargets.slice( 0, 8 ),
		},
		null,
		1
	);
} )();
