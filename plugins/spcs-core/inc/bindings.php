<?php
/**
 * Block Bindings source for SPCS meta.
 *
 * Lets an ordinary paragraph or heading in a pattern pull its text from a
 * custom field, so structured content can appear inside hand-designed layouts
 * without a shortcode or a page builder.
 *
 * Usage inside a pattern:
 *   <!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"spcs/field",
 *        "args":{"key":"spcs_finding"}}}}} -->
 *
 * @package SPCS_Core
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the binding source.
 *
 * Guarded because the API landed in WordPress 6.5; on anything older the site
 * still works, the bound blocks simply render their fallback text.
 */
function spcs_core_register_bindings(): void {
	if ( ! function_exists( 'register_block_bindings_source' ) ) {
		return;
	}

	register_block_bindings_source(
		'spcs/field',
		array(
			'label'              => __( 'SPCS field', 'spcs-core' ),
			'get_value_callback' => 'spcs_core_binding_value',
			'uses_context'       => array( 'postId', 'postType' ),
		)
	);
}
add_action( 'init', 'spcs_core_register_bindings' );

/**
 * Resolve a bound value.
 *
 * @param array<string, mixed> $source_args Arguments from the block markup.
 * @param WP_Block             $block       The block instance.
 * @return string|null
 */
function spcs_core_binding_value( array $source_args, WP_Block $block ): ?string {
	$key = isset( $source_args['key'] ) ? (string) $source_args['key'] : '';

	if ( '' === $key ) {
		return null;
	}

	$post_id = $block->context['postId'] ?? get_the_ID();

	if ( ! $post_id ) {
		return null;
	}

	// Only expose keys this plugin registered — never arbitrary post meta.
	$allowed = array();

	foreach ( spcs_core_fields() as $fields ) {
		$allowed = array_merge( $allowed, array_keys( $fields ) );
	}

	if ( ! in_array( $key, $allowed, true ) ) {
		return null;
	}

	$value = get_post_meta( (int) $post_id, $key, true );

	return '' === $value ? null : (string) $value;
}
