<?php
/**
 * Router for PHP's built-in server.
 *
 * The built-in server has no rewrite engine, so pretty permalinks 404 without
 * this: serve real files as-is, hand everything else to WordPress.
 *
 * @package SPCS
 */

$path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$file = __DIR__ . '/../.wp/wordpress' . $path;

// Serve existing static files directly.
if ( $path !== '/' && file_exists( $file ) && ! is_dir( $file ) ) {
	return false;
}

// Directory requests fall through to their index.php (wp-admin, etc).
if ( is_dir( $file ) && file_exists( rtrim( $file, '/' ) . '/index.php' ) ) {
	$_SERVER['SCRIPT_NAME'] = rtrim( $path, '/' ) . '/index.php';
	require rtrim( $file, '/' ) . '/index.php';
	return true;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/../.wp/wordpress/index.php';
