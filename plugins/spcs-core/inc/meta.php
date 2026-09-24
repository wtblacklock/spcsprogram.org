<?php
/**
 * Post meta registration.
 *
 * Registered through the core meta API with `show_in_rest`, which gives us the
 * block editor sidebar, REST access and the Block Bindings API without pulling
 * in a commercial custom-fields plugin.
 *
 * @package SPCS_Core
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Field definitions, keyed by post type.
 *
 * @return array<string, array<string, array{type: string, label: string, description?: string}>>
 */
function spcs_core_fields(): array {
	return array(
		'spcs_study'       => array(
			'spcs_authors' => array(
				'type'  => 'string',
				'label' => __( 'Authors', 'spcs-core' ),
			),
			'spcs_year'    => array(
				'type'  => 'string',
				'label' => __( 'Year', 'spcs-core' ),
			),
			'spcs_journal' => array(
				'type'  => 'string',
				'label' => __( 'Journal', 'spcs-core' ),
			),
			'spcs_locator' => array(
				'type'        => 'string',
				'label'       => __( 'Volume, issue and pages', 'spcs-core' ),
				'description' => __( 'For example: 45(1), 41–47.', 'spcs-core' ),
			),
			'spcs_url'     => array(
				'type'  => 'string',
				'label' => __( 'DOI or link', 'spcs-core' ),
			),
			'spcs_finding' => array(
				'type'        => 'string',
				'label'       => __( 'Key finding', 'spcs-core' ),
				'description' => __( 'One plain sentence a non-researcher can act on.', 'spcs-core' ),
			),
		),
		'spcs_outcome'     => array(
			'spcs_value'  => array(
				'type'        => 'string',
				'label'       => __( 'Value', 'spcs-core' ),
				'description' => __( 'Include the symbol, e.g. 45% or 900+.', 'spcs-core' ),
			),
			'spcs_label'  => array(
				'type'  => 'string',
				'label' => __( 'Label', 'spcs-core' ),
			),
			'spcs_source' => array(
				'type'        => 'string',
				'label'       => __( 'Source', 'spcs-core' ),
				'description' => __( 'Required. Every number on this site is attributable.', 'spcs-core' ),
			),
		),
		'spcs_testimonial' => array(
			'spcs_attribution' => array(
				'type'        => 'string',
				'label'       => __( 'Attribution', 'spcs-core' ),
				'description' => __( 'Role only, never a name — participants are anonymous.', 'spcs-core' ),
			),
			'spcs_campus'      => array(
				'type'  => 'string',
				'label' => __( 'Campus', 'spcs-core' ),
			),
			'spcs_consent'     => array(
				'type'        => 'boolean',
				'label'       => __( 'Cleared for public use', 'spcs-core' ),
				'description' => __( 'Only quotes with this ticked are rendered on the site.', 'spcs-core' ),
			),
		),
		'spcs_faq'         => array(
			'spcs_faq_group' => array(
				'type'        => 'string',
				'label'       => __( 'Group', 'spcs-core' ),
				'description' => __( 'For example: Delivery, Evidence, Cost, Data.', 'spcs-core' ),
			),
		),
		'spcs_partner'     => array(
			'spcs_partner_url'  => array(
				'type'  => 'string',
				'label' => __( 'Website', 'spcs-core' ),
			),
			'spcs_partner_type' => array(
				'type'        => 'string',
				'label'       => __( 'Type', 'spcs-core' ),
				'description' => __( 'funder, campus or accreditor', 'spcs-core' ),
			),
		),
	);
}

/**
 * Register every field.
 */
function spcs_core_register_meta(): void {
	foreach ( spcs_core_fields() as $post_type => $fields ) {
		foreach ( $fields as $key => $field ) {
			register_post_meta(
				$post_type,
				$key,
				array(
					'type'              => $field['type'],
					'description'       => $field['description'] ?? $field['label'],
					'single'            => true,
					'default'           => 'boolean' === $field['type'] ? false : '',
					'show_in_rest'      => true,
					'sanitize_callback' => 'boolean' === $field['type']
						? 'rest_sanitize_boolean'
						: 'sanitize_text_field',
					'auth_callback'     => static function (): bool {
						return current_user_can( 'edit_posts' );
					},
				)
			);
		}
	}
}
add_action( 'init', 'spcs_core_register_meta' );

/**
 * Read a field with its default applied.
 *
 * @param int    $post_id Post ID.
 * @param string $key     Meta key.
 * @return string
 */
function spcs_core_field( int $post_id, string $key ): string {
	return (string) get_post_meta( $post_id, $key, true );
}
