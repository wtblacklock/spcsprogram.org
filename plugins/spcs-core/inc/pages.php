<?php
/**
 * Page scaffolding.
 *
 * Creates the site's pages and fills each one with the expanded markup of its
 * patterns.
 *
 * Expanding the patterns matters: a page could instead store a one-line
 * `wp:pattern` reference, but then an editor opening the page sees a single
 * locked block and has to "detach" it before changing a word. Writing the real
 * block markup into the page means everything on it is editable from day one,
 * which is the entire point of building this in WordPress.
 *
 * @package SPCS_Core
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pages to create, in menu order.
 *
 * @return array<string, array{title: string, patterns: array<int, string>, front?: bool}>
 */
function spcs_core_pages(): array {
	return array(
		'home'                 => array(
			'title'    => __( 'Home', 'spcs-core' ),
			'front'    => true,
			'patterns' => array(
				'spcs/hero-institutional',
				'spcs/credibility-strip',
				'spcs/what-is-a-gatekeeper',
				'spcs/three-phase-model',
				'spcs/outcomes-band',
				'spcs/voices',
				'spcs/cta-closing',
			),
		),
		'about'                => array(
			'title'    => __( 'About SPCS', 'spcs-core' ),
			'patterns' => array( 'spcs/page-about' ),
		),
		'become-an-instructor' => array(
			'title'    => __( 'Become an Instructor', 'spcs-core' ),
			'patterns' => array( 'spcs/page-become-instructor' ),
		),
		'store'                => array(
			'title'    => __( 'Store', 'spcs-core' ),
			'patterns' => array( 'spcs/page-store' ),
		),
		'newsroom'             => array(
			'title'    => __( 'Newsroom', 'spcs-core' ),
			'patterns' => array( 'spcs/page-newsroom' ),
		),
		'instructor-login'     => array(
			'title'    => __( 'Instructor Login', 'spcs-core' ),
			'patterns' => array( 'spcs/page-instructor-login' ),
		),
		'faq'                  => array(
			'title'    => __( 'FAQ', 'spcs-core' ),
			'patterns' => array( 'spcs/page-faq' ),
		),
		'privacy'              => array(
			'title'    => __( 'Privacy', 'spcs-core' ),
			'patterns' => array( 'spcs/page-privacy' ),
		),
		'accessibility'        => array(
			'title'    => __( 'Accessibility', 'spcs-core' ),
			'patterns' => array( 'spcs/page-accessibility' ),
		),
	);
}

/**
 * Resolve a registered pattern to its block markup.
 *
 * @param string $slug Pattern slug.
 * @return string
 */
function spcs_core_pattern_markup( string $slug ): string {
	if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
		return '';
	}

	$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( $slug );

	if ( ! $pattern || empty( $pattern['content'] ) ) {
		return '';
	}

	return (string) $pattern['content'];
}

/**
 * Create any missing pages.
 *
 * Existing pages are left completely alone, so re-running this can never
 * overwrite edited copy.
 *
 * @return array<int, string> Slugs of pages that were created.
 */
function spcs_core_scaffold_pages(): array {
	$created = array();
	$order   = 0;

	foreach ( spcs_core_pages() as $slug => $config ) {
		++$order;

		$existing = get_page_by_path( $slug );

		if ( $existing instanceof WP_Post ) {
			continue;
		}

		$content = '';

		foreach ( $config['patterns'] as $pattern_slug ) {
			$markup = spcs_core_pattern_markup( $pattern_slug );

			if ( '' === $markup ) {
				continue;
			}

			$content .= $markup . "\n\n";
		}

		$page_id = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => $config['title'],
				'post_name'    => $slug,
				'post_content' => trim( $content ),
				'menu_order'   => $order,
			)
		);

		if ( is_wp_error( $page_id ) ) {
			continue;
		}

		$created[] = $slug;

		if ( ! empty( $config['front'] ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $page_id );
		}
	}

	return $created;
}

/**
 * Offer the scaffold from the admin rather than running it silently.
 *
 * Patterns are registered by the theme, which is not guaranteed to be loaded at
 * plugin-activation time — and creating a dozen pages is not something that
 * should happen without someone asking for it.
 */
function spcs_core_scaffold_notice(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$screen = get_current_screen();

	if ( ! $screen || ! in_array( $screen->id, array( 'dashboard', 'edit-page' ), true ) ) {
		return;
	}

	$missing = array_filter(
		array_keys( spcs_core_pages() ),
		static function ( string $slug ): bool {
			return ! get_page_by_path( $slug ) instanceof WP_Post;
		}
	);

	if ( ! $missing ) {
		return;
	}

	$url = wp_nonce_url(
		add_query_arg( 'spcs_scaffold', '1', admin_url( 'edit.php?post_type=page' ) ),
		'spcs_scaffold'
	);

	printf(
		'<div class="notice notice-info"><p>%s</p><p><a class="button button-primary" href="%s">%s</a></p></div>',
		esc_html(
			sprintf(
				/* translators: %d: number of pages. */
				_n(
					'%d SPCS page has not been created yet.',
					'%d SPCS pages have not been created yet.',
					count( $missing ),
					'spcs-core'
				),
				count( $missing )
			)
		),
		esc_url( $url ),
		esc_html__( 'Create the missing pages', 'spcs-core' )
	);
}
add_action( 'admin_notices', 'spcs_core_scaffold_notice' );

/**
 * Handle the scaffold request.
 */
function spcs_core_handle_scaffold(): void {
	if ( ! isset( $_GET['spcs_scaffold'] ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$nonce = isset( $_GET['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) : '';

	if ( ! wp_verify_nonce( $nonce, 'spcs_scaffold' ) ) {
		return;
	}

	$created = spcs_core_scaffold_pages();

	wp_safe_redirect(
		add_query_arg(
			'spcs_created',
			count( $created ),
			admin_url( 'edit.php?post_type=page' )
		)
	);
	exit;
}
add_action( 'admin_init', 'spcs_core_handle_scaffold' );
