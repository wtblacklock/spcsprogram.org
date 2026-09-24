<?php
/**
 * Theme supports and general setup.
 *
 * @package SPCS
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme supports.
 */
function spcs_setup(): void {
	load_theme_textdomain( 'spcs', SPCS_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	// Compiled editor stylesheet, so patterns look right inside the Site Editor.
	add_editor_style( 'build/editor.css' );

	/*
	 * Image sizes tuned to the layout devices rather than to arbitrary
	 * defaults: the panel media slot and the 4:5 portrait on the About page.
	 */
	add_image_size( 'spcs-panel', 1600, 1100, true );
	add_image_size( 'spcs-portrait', 720, 900, true );
	add_image_size( 'spcs-hero', 2400, 1200, true );
}
add_action( 'after_setup_theme', 'spcs_setup' );

/**
 * Trim WordPress' default head output that this site has no use for.
 */
function spcs_clean_head(): void {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
}
add_action( 'init', 'spcs_clean_head' );

/**
 * Remove WordPress' own skip link.
 *
 * The theme renders one as the first element in the body, pointing at the real
 * <main id="main">. Leaving core's in place gives a screen reader user two
 * "skip to content" links in a row aimed at different targets, which is worse
 * than having none.
 */
function spcs_remove_core_skip_link(): void {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_block_template_skip_link' );
	remove_action( 'wp_footer', 'the_block_template_skip_link' );
}
add_action( 'init', 'spcs_remove_core_skip_link' );

/**
 * Remove the core emoji script and its DNS prefetch.
 *
 * Beyond the weight, it fires an external request that a university privacy
 * review will flag.
 */
function spcs_disable_emojis(): void {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'spcs_disable_emojis' );
