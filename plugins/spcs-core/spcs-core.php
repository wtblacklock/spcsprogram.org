<?php
/**
 * Plugin Name:       SPCS Core
 * Plugin URI:        https://spcsprogram.org
 * Description:       Content types, fields and structured data for the SPCS Gatekeepers Program. Kept in a plugin rather than the theme so studies, testimonials, FAQs and partners survive a theme change.
 * Version:           1.0.0
 * Requires at least: 6.5
 * Requires PHP:      8.0
 * Author:            Clover Educational Consulting Group
 * Author URI:        https://clovered.org
 * License:           GPL-2.0-or-later
 * Text Domain:       spcs-core
 *
 * @package SPCS_Core
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SPCS_CORE_VERSION', '1.0.0' );
define( 'SPCS_CORE_DIR', plugin_dir_path( __FILE__ ) );

require_once SPCS_CORE_DIR . 'inc/post-types.php';
require_once SPCS_CORE_DIR . 'inc/meta.php';
require_once SPCS_CORE_DIR . 'inc/admin-fields.php';
require_once SPCS_CORE_DIR . 'inc/bindings.php';
require_once SPCS_CORE_DIR . 'inc/schema.php';
require_once SPCS_CORE_DIR . 'inc/render.php';
require_once SPCS_CORE_DIR . 'inc/seed.php';
require_once SPCS_CORE_DIR . 'inc/pages.php';
require_once SPCS_CORE_DIR . 'inc/demo-form.php';

/**
 * Flush rewrite rules once on activation so the custom archives resolve.
 */
function spcs_core_activate(): void {
	spcs_core_register_post_types();
	spcs_core_register_meta();
	spcs_core_seed();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'spcs_core_activate' );

/**
 * Clean up rewrite rules on deactivation.
 */
function spcs_core_deactivate(): void {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'spcs_core_deactivate' );
