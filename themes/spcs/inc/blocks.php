<?php
/**
 * Dynamic blocks used inside template parts.
 *
 * The header, footer and crisis bar are rendered by PHP rather than assembled
 * from core blocks. They must be byte-identical on every page and must not be
 * editable into a state that breaks keyboard navigation or removes the crisis
 * resources. Their text still passes through filters and translation, so they
 * stay maintainable without touching layout.
 *
 * @package SPCS
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Blocks this theme provides, mapped to their render callbacks.
 *
 * @return array<string, callable>
 */
function spcs_dynamic_blocks(): array {
	return array(
		'spcs/site-header' => 'spcs_render_header',
		'spcs/site-footer' => 'spcs_render_footer',
		'spcs/crisis-bar'  => 'spcs_render_crisis_bar',
	);
}

/**
 * Register the dynamic blocks.
 */
function spcs_register_blocks(): void {
	foreach ( spcs_dynamic_blocks() as $name => $callback ) {
		register_block_type(
			$name,
			array(
				'api_version'     => 3,
				'render_callback' => static function () use ( $callback ): string {
					ob_start();
					call_user_func( $callback );

					return (string) ob_get_clean();
				},
				'supports'        => array(
					'html'      => false,
					'reusable'  => false,
					'inserter'  => false,
					'lock'      => false,
					'multiple'  => false,
				),
			)
		);
	}
}
add_action( 'init', 'spcs_register_blocks' );

/**
 * Register the editor-side counterparts.
 *
 * Without a client-side registration these blocks render as "your site doesn't
 * include support for this block" inside the Site Editor. This script pairs
 * each one with a server-rendered preview so an editor sees the real header and
 * footer while working.
 */
function spcs_register_editor_blocks(): void {
	wp_enqueue_script(
		'spcs-editor-blocks',
		SPCS_THEME_URI . '/assets/js/editor-blocks.js',
		array( 'wp-blocks', 'wp-element', 'wp-server-side-render', 'wp-i18n' ),
		spcs_asset_version( 'assets/js/editor-blocks.js' ),
		true
	);

	wp_localize_script(
		'spcs-editor-blocks',
		'spcsEditorBlocks',
		array_keys( spcs_dynamic_blocks() )
	);
}
add_action( 'enqueue_block_editor_assets', 'spcs_register_editor_blocks' );
