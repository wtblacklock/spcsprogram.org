<?php
/**
 * SPCS theme bootstrap.
 *
 * Content structure (post types, meta, schema) deliberately lives in the
 * spcs-core plugin instead, so switching themes never destroys content.
 *
 * @package SPCS
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SPCS_THEME_VERSION', '1.0.0' );
define( 'SPCS_THEME_DIR', get_template_directory() );
define( 'SPCS_THEME_URI', get_template_directory_uri() );

require_once SPCS_THEME_DIR . '/inc/setup.php';
require_once SPCS_THEME_DIR . '/inc/enqueue.php';
require_once SPCS_THEME_DIR . '/inc/patterns.php';
require_once SPCS_THEME_DIR . '/inc/blocks.php';
require_once SPCS_THEME_DIR . '/inc/editor-guardrails.php';
require_once SPCS_THEME_DIR . '/inc/nav.php';
