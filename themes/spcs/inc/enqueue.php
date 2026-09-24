<?php
/**
 * Asset loading.
 *
 * @package SPCS
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Version string based on file mtime so cache busting is automatic in dev
 * and stable in production.
 *
 * @param string $relative_path Path relative to the theme root.
 * @return string
 */
function spcs_asset_version( string $relative_path ): string {
	$file = SPCS_THEME_DIR . '/' . ltrim( $relative_path, '/' );

	return file_exists( $file ) ? (string) filemtime( $file ) : SPCS_THEME_VERSION;
}

/**
 * Enqueue front-end styles and scripts.
 */
function spcs_enqueue_assets(): void {
	wp_enqueue_style(
		'spcs-main',
		SPCS_THEME_URI . '/build/main.css',
		array(),
		spcs_asset_version( 'build/main.css' )
	);

	wp_enqueue_script(
		'spcs-motion',
		SPCS_THEME_URI . '/build/motion.js',
		array(),
		spcs_asset_version( 'build/motion.js' ),
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	/*
	 * WordPress only prints a core block's stylesheet on pages whose *post
	 * content* actually contains that block. The header's "Become an
	 * Instructor" button is rendered in PHP, not in post content, so on the
	 * one page with no button block anywhere in its content (Newsroom) core
	 * never enqueues the button block's base styles — the header button
	 * silently loses its padding and collapses, shrinking the whole header.
	 * Force it to always load.
	 */
	wp_enqueue_style( 'wp-block-button' );
}
add_action( 'wp_enqueue_scripts', 'spcs_enqueue_assets' );

/**
 * Preload the two variable fonts.
 *
 * Both are used above the fold — Fraunces in the headline, Instrument Sans in
 * the navigation — so preloading removes a visible reflow.
 */
function spcs_preload_fonts(): void {
	$fonts = array( 'fraunces-var.woff2', 'instrument-sans-var.woff2' );

	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( SPCS_THEME_URI . '/assets/fonts/' . $font )
		);
	}
}
add_action( 'wp_head', 'spcs_preload_fonts', 1 );

/**
 * Mark the document as script-enabled before first paint.
 *
 * The reveal animations hide their elements via a `.js` ancestor selector. If
 * that class were added by the deferred bundle instead, content would flash in
 * and then disappear. Gating on the reduced-motion query here means a visitor
 * who asked for less motion never gets the hidden state at all.
 */
function spcs_js_flag(): void {
	?>
	<script>
		if ( ! window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
			document.documentElement.classList.add( 'js' );
		}
	</script>
	<?php
}
add_action( 'wp_head', 'spcs_js_flag', 2 );

/**
 * Drop the core block library's duotone and global-styles SVG filter block
 * that ships on every page but is never referenced by this theme.
 */
function spcs_remove_unused_svg_filters(): void {
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	remove_action( 'in_admin_header', 'wp_global_styles_render_svg_filters' );
}
add_action( 'init', 'spcs_remove_unused_svg_filters' );
