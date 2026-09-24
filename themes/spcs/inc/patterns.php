<?php
/**
 * Block pattern categories.
 *
 * The patterns themselves live in /patterns and are registered automatically by
 * WordPress from their file headers. This file only declares the categories, so
 * the inserter groups them the way an editor thinks about the site.
 *
 * @package SPCS
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register pattern categories.
 */
function spcs_register_pattern_categories(): void {
	$categories = array(
		'spcs-openers'    => array(
			'label'       => __( 'SPCS — page openers', 'spcs' ),
			'description' => __( 'Hero and section-opening layouts. Use one per page, at the top.', 'spcs' ),
		),
		'spcs-evidence'   => array(
			'label'       => __( 'SPCS — evidence & credibility', 'spcs' ),
			'description' => __( 'Statistics, citations, the SPRC badge and partner logos.', 'spcs' ),
		),
		'spcs-program'    => array(
			'label'       => __( 'SPCS — program content', 'spcs' ),
			'description' => __( 'The three-phase model, implementation timeline and related explainers.', 'spcs' ),
		),
		'spcs-editorial'  => array(
			'label'       => __( 'SPCS — editorial blocks', 'spcs' ),
			'description' => __( 'Text and image arrangements, pull quotes and color-block panels.', 'spcs' ),
		),
		'spcs-conversion' => array(
			'label'       => __( 'SPCS — calls to action', 'spcs' ),
			'description' => __( 'Demo requests and closing prompts.', 'spcs' ),
		),
	);

	foreach ( $categories as $slug => $args ) {
		register_block_pattern_category( $slug, $args );
	}
}
add_action( 'init', 'spcs_register_pattern_categories' );

/**
 * Remove the remote pattern directory.
 *
 * Core's bundled patterns are generic and would let an editor drop a
 * card-grid section into a carefully art-directed page. Keeping the inserter to
 * this theme's patterns is the main thing that stops the site drifting back
 * toward a template look after handoff.
 */
function spcs_disable_remote_patterns(): void {
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'spcs_disable_remote_patterns', 20 );

add_filter( 'should_load_remote_block_patterns', '__return_false' );
