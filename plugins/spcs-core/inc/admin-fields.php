<?php
/**
 * Admin UI for the registered meta.
 *
 * Plain meta boxes rather than a fields framework. They render inside the block
 * editor, they are one file to maintain, and they carry no licence.
 *
 * @package SPCS_Core
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add a details box to each SPCS post type.
 */
function spcs_core_add_meta_boxes(): void {
	foreach ( spcs_core_fields() as $post_type => $fields ) {
		add_meta_box(
			'spcs-details',
			__( 'Details', 'spcs-core' ),
			'spcs_core_render_meta_box',
			$post_type,
			'normal',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'spcs_core_add_meta_boxes' );

/**
 * Render the details box.
 *
 * @param WP_Post $post Current post.
 */
function spcs_core_render_meta_box( WP_Post $post ): void {
	$fields = spcs_core_fields()[ $post->post_type ] ?? array();

	if ( ! $fields ) {
		return;
	}

	wp_nonce_field( 'spcs_core_save_meta', 'spcs_core_nonce' );

	echo '<div style="display:grid;gap:1rem;padding:0.5rem 0">';

	foreach ( $fields as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		$id    = esc_attr( $key );

		echo '<div>';
		printf(
			'<label for="%1$s" style="display:block;font-weight:600;margin-bottom:.25rem">%2$s</label>',
			esc_attr( $id ),
			esc_html( $field['label'] )
		);

		if ( 'boolean' === $field['type'] ) {
			printf(
				'<label><input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s> %3$s</label>',
				esc_attr( $id ),
				checked( (bool) $value, true, false ),
				esc_html__( 'Yes', 'spcs-core' )
			);
		} elseif ( 'spcs_finding' === $key || 'spcs_label' === $key ) {
			printf(
				'<textarea id="%1$s" name="%1$s" rows="2" class="widefat">%2$s</textarea>',
				esc_attr( $id ),
				esc_textarea( (string) $value )
			);
		} else {
			printf(
				'<input type="text" id="%1$s" name="%1$s" value="%2$s" class="widefat">',
				esc_attr( $id ),
				esc_attr( (string) $value )
			);
		}

		if ( ! empty( $field['description'] ) ) {
			printf(
				'<p class="description" style="margin:.25rem 0 0">%s</p>',
				esc_html( $field['description'] )
			);
		}

		echo '</div>';
	}

	echo '</div>';
}

/**
 * Persist the details box.
 *
 * @param int     $post_id Post ID.
 * @param WP_Post $post    Post object.
 */
function spcs_core_save_meta( int $post_id, WP_Post $post ): void {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	$fields = spcs_core_fields()[ $post->post_type ] ?? array();

	if ( ! $fields ) {
		return;
	}

	$nonce = isset( $_POST['spcs_core_nonce'] )
		? sanitize_text_field( wp_unslash( $_POST['spcs_core_nonce'] ) )
		: '';

	if ( ! wp_verify_nonce( $nonce, 'spcs_core_save_meta' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( $fields as $key => $field ) {
		if ( 'boolean' === $field['type'] ) {
			update_post_meta( $post_id, $key, isset( $_POST[ $key ] ) );
			continue;
		}

		$value = isset( $_POST[ $key ] )
			? sanitize_text_field( wp_unslash( $_POST[ $key ] ) )
			: '';

		update_post_meta( $post_id, $key, $value );
	}
}
add_action( 'save_post', 'spcs_core_save_meta', 10, 2 );

/**
 * Show the fields that matter in the admin list tables.
 */
function spcs_core_admin_columns(): void {
	$columns = array(
		'spcs_study'       => array(
			'spcs_year'    => __( 'Year', 'spcs-core' ),
			'spcs_journal' => __( 'Journal', 'spcs-core' ),
		),
		'spcs_outcome'     => array(
			'spcs_value'  => __( 'Value', 'spcs-core' ),
			'spcs_source' => __( 'Source', 'spcs-core' ),
		),
		'spcs_testimonial' => array(
			'spcs_attribution' => __( 'Attribution', 'spcs-core' ),
			'spcs_consent'     => __( 'Cleared', 'spcs-core' ),
		),
		'spcs_faq'         => array(
			'spcs_faq_group' => __( 'Group', 'spcs-core' ),
		),
		'spcs_partner'     => array(
			'spcs_partner_type' => __( 'Type', 'spcs-core' ),
		),
	);

	foreach ( $columns as $post_type => $definitions ) {
		add_filter(
			"manage_{$post_type}_posts_columns",
			static function ( array $existing ) use ( $definitions ): array {
				$date = $existing['date'] ?? null;
				unset( $existing['date'] );

				foreach ( $definitions as $key => $label ) {
					$existing[ $key ] = $label;
				}

				if ( $date ) {
					$existing['date'] = $date;
				}

				return $existing;
			}
		);

		add_action(
			"manage_{$post_type}_posts_custom_column",
			static function ( string $column, int $post_id ) use ( $definitions ): void {
				if ( ! array_key_exists( $column, $definitions ) ) {
					return;
				}

				$value = get_post_meta( $post_id, $column, true );

				if ( 'spcs_consent' === $column ) {
					echo $value ? '✓' : '—';
					return;
				}

				echo esc_html( (string) $value );
			},
			10,
			2
		);
	}
}
add_action( 'admin_init', 'spcs_core_admin_columns' );
