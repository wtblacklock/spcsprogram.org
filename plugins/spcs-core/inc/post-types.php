<?php
/**
 * Custom post types.
 *
 * Only structured, repeating content gets a post type. Prose pages stay as
 * ordinary pages built from patterns — a post type for every section would make
 * the site harder to edit, not easier.
 *
 * @package SPCS_Core
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Definitions for every SPCS post type.
 *
 * @return array<string, array<string, mixed>>
 */
function spcs_core_post_type_args(): array {
	return array(
		'spcs_study'       => array(
			'singular'     => __( 'Study', 'spcs-core' ),
			'plural'       => __( 'Studies', 'spcs-core' ),
			'menu_icon'    => 'dashicons-book-alt',
			'public'       => true,
			'has_archive'  => false,
			'rewrite'      => array( 'slug' => 'research' ),
			'supports'     => array( 'title', 'editor', 'page-attributes', 'custom-fields' ),
		),
		'spcs_outcome'     => array(
			'singular'     => __( 'Outcome', 'spcs-core' ),
			'plural'       => __( 'Outcomes', 'spcs-core' ),
			'menu_icon'    => 'dashicons-chart-bar',
			'public'       => false,
			'has_archive'  => false,
			'rewrite'      => false,
			'supports'     => array( 'title', 'page-attributes', 'custom-fields' ),
		),
		'spcs_testimonial' => array(
			'singular'     => __( 'Testimonial', 'spcs-core' ),
			'plural'       => __( 'Testimonials', 'spcs-core' ),
			'menu_icon'    => 'dashicons-format-quote',
			'public'       => false,
			'has_archive'  => false,
			'rewrite'      => false,
			'supports'     => array( 'title', 'editor', 'page-attributes', 'custom-fields' ),
		),
		'spcs_faq'         => array(
			'singular'     => __( 'FAQ', 'spcs-core' ),
			'plural'       => __( 'FAQs', 'spcs-core' ),
			'menu_icon'    => 'dashicons-editor-help',
			'public'       => false,
			'has_archive'  => false,
			'rewrite'      => false,
			'supports'     => array( 'title', 'editor', 'page-attributes', 'custom-fields' ),
		),
		'spcs_partner'     => array(
			'singular'     => __( 'Partner', 'spcs-core' ),
			'plural'       => __( 'Partners', 'spcs-core' ),
			'menu_icon'    => 'dashicons-groups',
			'public'       => false,
			'has_archive'  => false,
			'rewrite'      => false,
			'supports'     => array( 'title', 'thumbnail', 'page-attributes', 'custom-fields' ),
		),
	);
}

/**
 * Register the post types.
 */
function spcs_core_register_post_types(): void {
	foreach ( spcs_core_post_type_args() as $slug => $config ) {
		$singular = $config['singular'];
		$plural   = $config['plural'];

		register_post_type(
			$slug,
			array(
				'labels'              => array(
					'name'               => $plural,
					'singular_name'      => $singular,
					/* translators: %s: singular post type name. */
					'add_new_item'       => sprintf( __( 'Add %s', 'spcs-core' ), $singular ),
					/* translators: %s: singular post type name. */
					'edit_item'          => sprintf( __( 'Edit %s', 'spcs-core' ), $singular ),
					/* translators: %s: plural post type name. */
					'all_items'          => $plural,
					/* translators: %s: plural post type name. */
					'search_items'       => sprintf( __( 'Search %s', 'spcs-core' ), $plural ),
					/* translators: %s: plural post type name. */
					'not_found'          => sprintf( __( 'No %s yet', 'spcs-core' ), strtolower( $plural ) ),
					'menu_name'          => $plural,
				),
				'public'              => $config['public'],
				'publicly_queryable'  => $config['public'],
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_rest'        => true,
				'menu_icon'           => $config['menu_icon'],
				'menu_position'       => 26,
				'has_archive'         => $config['has_archive'],
				'rewrite'             => $config['rewrite'],
				'supports'            => $config['supports'],
				'capability_type'     => 'post',
				'exclude_from_search' => ! $config['public'],
				'hierarchical'        => false,
			)
		);
	}
}
add_action( 'init', 'spcs_core_register_post_types' );

/**
 * Order these post types by menu_order in the admin.
 *
 * The order studies and outcomes appear in is an editorial decision — the
 * strongest evidence goes first — so drag-to-reorder needs to be the default
 * rather than reverse-chronological.
 *
 * @param WP_Query $query The query.
 */
function spcs_core_admin_ordering( WP_Query $query ): void {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	$post_type = $query->get( 'post_type' );

	if ( is_string( $post_type ) && array_key_exists( $post_type, spcs_core_post_type_args() ) ) {
		$query->set( 'orderby', 'menu_order title' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'spcs_core_admin_ordering' );
