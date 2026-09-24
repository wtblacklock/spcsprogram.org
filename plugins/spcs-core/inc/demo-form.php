<?php
/**
 * Demo request form.
 *
 * Implemented here rather than through a forms plugin. The site has exactly one
 * form and it never changes shape, so a plugin would add a dependency, an
 * upgrade path and a settings screen to maintain in exchange for a drag-and-drop
 * builder nobody will use. Submissions are stored as a private post type, which
 * means the standard WordPress list table, search and export all work already.
 *
 * Protections: a nonce, a honeypot, a minimum completion time, and a per-IP rate
 * limit. No third-party CAPTCHA, so nothing about a visitor leaves the server.
 *
 * @package SPCS_Core
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const SPCS_LEAD_POST_TYPE = 'spcs_lead';

/**
 * Register the submissions post type.
 */
function spcs_core_register_lead_type(): void {
	register_post_type(
		SPCS_LEAD_POST_TYPE,
		array(
			'labels'              => array(
				'name'          => __( 'Team training inquiries', 'spcs-core' ),
				'singular_name' => __( 'Team training inquiry', 'spcs-core' ),
				'menu_name'     => __( 'Training inquiries', 'spcs-core' ),
				'not_found'     => __( 'No training inquiries yet', 'spcs-core' ),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => false,
			'menu_icon'           => 'dashicons-email-alt',
			'menu_position'       => 27,
			'supports'            => array( 'title' ),
			'capability_type'     => 'post',
			'capabilities'        => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'        => true,
			'exclude_from_search' => true,
		)
	);
}
add_action( 'init', 'spcs_core_register_lead_type' );

/**
 * The form's fields.
 *
 * @return array<string, array{label: string, type: string, required: bool, hint?: string, options?: array<int, string>}>
 */
function spcs_core_demo_fields(): array {
	return array(
		'first_name'  => array(
			'label'    => __( 'First name', 'spcs-core' ),
			'type'     => 'text',
			'required' => true,
		),
		'last_name'   => array(
			'label'    => __( 'Last name', 'spcs-core' ),
			'type'     => 'text',
			'required' => true,
		),
		'email'       => array(
			'label'    => __( 'Work email', 'spcs-core' ),
			'type'     => 'email',
			'required' => true,
		),
		'institution' => array(
			'label'    => __( 'Organization or campus', 'spcs-core' ),
			'type'     => 'text',
			'required' => true,
		),
		'role'        => array(
			'label'    => __( 'Your role', 'spcs-core' ),
			'type'     => 'text',
			'required' => false,
			'hint'     => __( 'For example: Resident Advisor, Director of Counseling Services.', 'spcs-core' ),
		),
		'timeline'    => array(
			'label'    => __( 'When are you hoping to train your team?', 'spcs-core' ),
			'type'     => 'select',
			'required' => false,
			'options'  => array(
				'',
				'This term',
				'Next term',
				'Next academic year',
				'Still exploring',
			),
		),
		'message'     => array(
			'label'    => __( 'Anything you want us to know', 'spcs-core' ),
			'type'     => 'textarea',
			'required' => false,
		),
	);
}

/**
 * Render the form.
 *
 * @return string
 */
function spcs_core_render_demo_form(): string {
	$errors = array();
	$values = array();
	$sent   = false;

	// Populated by the handler below via a transient keyed to the visitor.
	$state = spcs_core_form_state();

	if ( $state ) {
		$errors = $state['errors'] ?? array();
		$values = $state['values'] ?? array();
		$sent   = ! empty( $state['sent'] );
	}

	ob_start();

	if ( $sent ) {
		?>
		<div class="spcs-form__success" role="status">
			<h2><?php esc_html_e( 'Thank you — that reached us.', 'spcs-core' ); ?></h2>
			<p><?php esc_html_e( 'Someone from the team will be in touch within two working days. If it is urgent, say so in a reply to the confirmation email and we will move faster.', 'spcs-core' ); ?></p>
		</div>
		<?php
		return (string) ob_get_clean();
	}

	?>
	<form class="spcs-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
		<input type="hidden" name="action" value="spcs_demo_request">
		<input type="hidden" name="spcs_started" value="<?php echo esc_attr( (string) time() ); ?>">
		<?php wp_nonce_field( 'spcs_demo_request', 'spcs_demo_nonce' ); ?>

		<?php if ( $errors ) : ?>
			<div class="spcs-form__errors" role="alert" tabindex="-1">
				<p><strong><?php esc_html_e( 'That did not send. Please check the following:', 'spcs-core' ); ?></strong></p>
				<ul>
					<?php foreach ( $errors as $error ) : ?>
						<li><?php echo esc_html( $error ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<div class="spcs-form__row">
			<?php
			spcs_core_render_field( 'first_name', $values, $errors );
			spcs_core_render_field( 'last_name', $values, $errors );
			?>
		</div>

		<?php
		spcs_core_render_field( 'email', $values, $errors );
		spcs_core_render_field( 'institution', $values, $errors );
		?>

		<?php
		// Not paired into a row: "Your role" and the timeline question have very
		// different label lengths, and a wrapping label pushed the shorter field's
		// input out of alignment with the one next to it.
		spcs_core_render_field( 'role', $values, $errors );
		spcs_core_render_field( 'timeline', $values, $errors );
		?>

		<?php spcs_core_render_field( 'message', $values, $errors ); ?>

		<div class="spcs-hp" aria-hidden="true">
			<label for="spcs-website"><?php esc_html_e( 'Leave this field empty', 'spcs-core' ); ?></label>
			<input type="text" id="spcs-website" name="spcs_website" tabindex="-1" autocomplete="off">
		</div>

		<button type="submit"><?php esc_html_e( 'Send request', 'spcs-core' ); ?></button>

		<p class="spcs-form__privacy">
			<?php
			printf(
				/* translators: %s: link to the privacy page. */
				esc_html__( 'We use what you send here to reply to you about the program, and for nothing else. See our %s.', 'spcs-core' ),
				'<a href="' . esc_url( home_url( '/privacy/' ) ) . '">' . esc_html__( 'privacy notice', 'spcs-core' ) . '</a>'
			);
			?>
		</p>
	</form>
	<?php

	return (string) ob_get_clean();
}

/**
 * Render one field.
 *
 * @param string                $key    Field key.
 * @param array<string, string> $values Submitted values.
 * @param array<int, string>    $errors Error messages.
 */
function spcs_core_render_field( string $key, array $values, array $errors ): void {
	$fields = spcs_core_demo_fields();
	$field  = $fields[ $key ] ?? null;

	if ( ! $field ) {
		return;
	}

	$id      = 'spcs-' . str_replace( '_', '-', $key );
	$value   = $values[ $key ] ?? '';
	$hint_id = $field['hint'] ?? false ? $id . '-hint' : '';
	$invalid = false;

	foreach ( $errors as $error ) {
		if ( str_contains( strtolower( $error ), strtolower( $field['label'] ) ) ) {
			$invalid = true;
		}
	}

	echo '<div class="spcs-field">';

	printf(
		'<label class="spcs-field__label" for="%1$s">%2$s%3$s</label>',
		esc_attr( $id ),
		esc_html( $field['label'] ),
		$field['required']
			? '<span class="spcs-field__required" aria-hidden="true">*</span><span class="screen-reader-text"> ' . esc_html__( '(required)', 'spcs-core' ) . '</span>'
			: ''
	);

	$attrs = sprintf(
		'id="%s" name="%s" %s %s %s',
		esc_attr( $id ),
		esc_attr( $key ),
		$field['required'] ? 'required aria-required="true"' : '',
		$invalid ? 'aria-invalid="true"' : '',
		$hint_id ? 'aria-describedby="' . esc_attr( $hint_id ) . '"' : ''
	);

	if ( 'textarea' === $field['type'] ) {
		printf( '<textarea %s rows="5">%s</textarea>', $attrs, esc_textarea( $value ) ); // phpcs:ignore WordPress.Security.EscapeOutput
	} elseif ( 'select' === $field['type'] ) {
		printf( '<select %s>', $attrs ); // phpcs:ignore WordPress.Security.EscapeOutput
		foreach ( $field['options'] as $option ) {
			printf(
				'<option value="%1$s" %2$s>%3$s</option>',
				esc_attr( $option ),
				selected( $value, $option, false ),
				'' === $option ? esc_html__( 'Select one', 'spcs-core' ) : esc_html( $option )
			);
		}
		echo '</select>';
	} else {
		printf(
			'<input type="%s" %s value="%s" autocomplete="%s">',
			esc_attr( 'email' === $field['type'] ? 'email' : 'text' ),
			$attrs, // phpcs:ignore WordPress.Security.EscapeOutput
			esc_attr( $value ),
			esc_attr( spcs_core_autocomplete_for( $key ) )
		);
	}

	if ( ! empty( $field['hint'] ) ) {
		printf(
			'<span class="spcs-field__hint" id="%s">%s</span>',
			esc_attr( $hint_id ),
			esc_html( $field['hint'] )
		);
	}

	echo '</div>';
}

/**
 * Map a field to an autocomplete token so browsers can fill it.
 *
 * @param string $key Field key.
 * @return string
 */
function spcs_core_autocomplete_for( string $key ): string {
	return array(
		'first_name'  => 'given-name',
		'last_name'   => 'family-name',
		'email'       => 'email',
		'institution' => 'organization',
		'role'        => 'organization-title',
	)[ $key ] ?? 'off';
}

/**
 * Per-visitor form state, used to repopulate after a failed submission.
 *
 * Stored in a short transient keyed to a cookie rather than in the session, so
 * it survives the redirect without holding the response open.
 *
 * @return array<string, mixed>|null
 */
function spcs_core_form_state(): ?array {
	$key = isset( $_GET['spcs_form'] ) ? sanitize_key( wp_unslash( $_GET['spcs_form'] ) ) : '';

	if ( ! $key ) {
		return null;
	}

	$state = get_transient( 'spcs_form_' . $key );
	delete_transient( 'spcs_form_' . $key );

	return is_array( $state ) ? $state : null;
}

/**
 * Handle a submission.
 */
function spcs_core_handle_demo_request(): void {
	$referer  = wp_get_referer() ?: home_url( '/become-an-instructor/' );
	$state_id = wp_generate_password( 12, false );

	$redirect = static function ( array $state ) use ( $referer, $state_id ): void {
		set_transient( 'spcs_form_' . $state_id, $state, 5 * MINUTE_IN_SECONDS );
		wp_safe_redirect( add_query_arg( 'spcs_form', $state_id, $referer ) . '#connect' );
		exit;
	};

	$nonce = isset( $_POST['spcs_demo_nonce'] )
		? sanitize_text_field( wp_unslash( $_POST['spcs_demo_nonce'] ) )
		: '';

	if ( ! wp_verify_nonce( $nonce, 'spcs_demo_request' ) ) {
		$redirect( array( 'errors' => array( __( 'Your session expired. Please try again.', 'spcs-core' ) ) ) );
	}

	// Honeypot: only a bot fills a field that is hidden and labelled "leave empty".
	if ( ! empty( $_POST['spcs_website'] ) ) {
		$redirect( array( 'sent' => true ) );
	}

	// Anything completed in under three seconds was not typed by a person.
	$started = isset( $_POST['spcs_started'] ) ? (int) $_POST['spcs_started'] : 0;

	if ( $started && ( time() - $started ) < 3 ) {
		$redirect( array( 'sent' => true ) );
	}

	if ( spcs_core_is_rate_limited() ) {
		$redirect(
			array(
				'errors' => array( __( 'That is several requests from one place in a short time. Please wait a few minutes and try again.', 'spcs-core' ) ),
			)
		);
	}

	$values = array();
	$errors = array();

	foreach ( spcs_core_demo_fields() as $key => $field ) {
		$raw = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : '';

		$value = 'textarea' === $field['type']
			? sanitize_textarea_field( $raw )
			: sanitize_text_field( $raw );

		$values[ $key ] = $value;

		if ( $field['required'] && '' === $value ) {
			/* translators: %s: field label. */
			$errors[] = sprintf( __( '%s is required.', 'spcs-core' ), $field['label'] );
			continue;
		}

		/*
		 * Validate the address before sanitising it. sanitize_email() returns an
		 * empty string for anything malformed, so sanitising first would turn a
		 * typo into a "this field is required" message and leave the person
		 * staring at a box they know they filled in.
		 */
		if ( 'email' === $field['type'] && '' !== $value ) {
			if ( ! is_email( $value ) ) {
				/* translators: %s: field label. */
				$errors[] = sprintf( __( '%s does not look like an email address.', 'spcs-core' ), $field['label'] );
				continue;
			}

			$values[ $key ] = sanitize_email( $value );
		}
	}

	if ( $errors ) {
		$redirect(
			array(
				'errors' => $errors,
				'values' => $values,
			)
		);
	}

	spcs_core_store_lead( $values );
	spcs_core_notify_team( $values );
	spcs_core_confirm_to_sender( $values );

	$redirect( array( 'sent' => true ) );
}
add_action( 'admin_post_nopriv_spcs_demo_request', 'spcs_core_handle_demo_request' );
add_action( 'admin_post_spcs_demo_request', 'spcs_core_handle_demo_request' );

/**
 * Simple per-IP rate limit: five submissions an hour.
 *
 * The address is hashed rather than stored, so the limiter never keeps a record
 * of who visited.
 *
 * @return bool
 */
function spcs_core_is_rate_limited(): bool {
	$address = isset( $_SERVER['REMOTE_ADDR'] )
		? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) )
		: '';

	if ( '' === $address ) {
		return false;
	}

	$key   = 'spcs_rl_' . md5( $address . wp_salt() );
	$count = (int) get_transient( $key );

	if ( $count >= 5 ) {
		return true;
	}

	set_transient( $key, $count + 1, HOUR_IN_SECONDS );

	return false;
}

/**
 * Store the submission.
 *
 * @param array<string, string> $values Field values.
 * @return int
 */
function spcs_core_store_lead( array $values ): int {
	$title = trim( $values['institution'] . ' — ' . $values['first_name'] . ' ' . $values['last_name'], ' —' );

	$post_id = wp_insert_post(
		array(
			'post_type'   => SPCS_LEAD_POST_TYPE,
			'post_status' => 'publish',
			'post_title'  => $title ?: __( 'Team training inquiry', 'spcs-core' ),
		)
	);

	if ( is_wp_error( $post_id ) ) {
		return 0;
	}

	foreach ( $values as $key => $value ) {
		update_post_meta( $post_id, 'lead_' . $key, $value );
	}

	return $post_id;
}

/**
 * Email the team.
 *
 * @param array<string, string> $values Field values.
 */
function spcs_core_notify_team( array $values ): void {
	$to = (string) apply_filters( 'spcs_demo_notification_email', get_option( 'admin_email' ) );

	$lines = array();

	foreach ( spcs_core_demo_fields() as $key => $field ) {
		if ( '' === ( $values[ $key ] ?? '' ) ) {
			continue;
		}

		$lines[] = $field['label'] . ': ' . $values[ $key ];
	}

	wp_mail(
		$to,
		sprintf(
			/* translators: %s: institution name. */
			__( 'SPCS team training inquiry — %s', 'spcs-core' ),
			$values['institution']
		),
		implode( "\n", $lines ),
		array( 'Reply-To: ' . $values['first_name'] . ' ' . $values['last_name'] . ' <' . $values['email'] . '>' )
	);
}

/**
 * Send the enquirer a confirmation.
 *
 * @param array<string, string> $values Field values.
 */
function spcs_core_confirm_to_sender( array $values ): void {
	$body = sprintf(
		/* translators: %s: first name. */
		__( "Hello %s,\n\nThank you for your interest in bringing the Suicide Prevention for College Student (SPCS) Gatekeepers Program to your team. Someone from our training team will reply within two working days.\n\nIf you are looking for support right now, the 988 Suicide and Crisis Lifeline is available 24/7 — call or text 988.\n\nClover Educational Consulting Group\nspcsprogram.org", 'spcs-core' ),
		$values['first_name']
	);

	wp_mail(
		$values['email'],
		__( 'We received your SPCS team training inquiry', 'spcs-core' ),
		$body
	);
}

/**
 * Show the submitted details in the admin list.
 */
function spcs_core_lead_columns(): void {
	add_filter(
		'manage_' . SPCS_LEAD_POST_TYPE . '_posts_columns',
		static function ( array $columns ): array {
			return array(
				'cb'          => $columns['cb'] ?? '',
				'title'       => __( 'Institution and contact', 'spcs-core' ),
				'lead_email'  => __( 'Email', 'spcs-core' ),
				'lead_role'   => __( 'Role', 'spcs-core' ),
				'lead_timeline' => __( 'Timeline', 'spcs-core' ),
				'date'        => __( 'Received', 'spcs-core' ),
			);
		}
	);

	add_action(
		'manage_' . SPCS_LEAD_POST_TYPE . '_posts_custom_column',
		static function ( string $column, int $post_id ): void {
			if ( ! str_starts_with( $column, 'lead_' ) ) {
				return;
			}

			$value = (string) get_post_meta( $post_id, $column, true );

			if ( 'lead_email' === $column && $value ) {
				printf( '<a href="mailto:%1$s">%1$s</a>', esc_attr( $value ) );
				return;
			}

			echo esc_html( $value );
		},
		10,
		2
	);
}
add_action( 'admin_init', 'spcs_core_lead_columns' );

/**
 * Show the full submission when a request is opened.
 */
function spcs_core_lead_meta_box(): void {
	add_meta_box(
		'spcs-lead-detail',
		__( 'Submission', 'spcs-core' ),
		static function ( WP_Post $post ): void {
			echo '<dl>';

			foreach ( spcs_core_demo_fields() as $key => $field ) {
				$value = (string) get_post_meta( $post->ID, 'lead_' . $key, true );

				if ( '' === $value ) {
					continue;
				}

				printf(
					'<dt style="font-weight:600;margin-top:.75rem">%s</dt><dd style="margin:.25rem 0 0">%s</dd>',
					esc_html( $field['label'] ),
					nl2br( esc_html( $value ) )
				);
			}

			echo '</dl>';
		},
		SPCS_LEAD_POST_TYPE,
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'spcs_core_lead_meta_box' );

/**
 * Register the form block.
 */
function spcs_core_register_form_block(): void {
	register_block_type(
		'spcs/demo-form',
		array(
			'api_version'     => 3,
			'title'           => __( 'Demo request form', 'spcs-core' ),
			'category'        => 'theme',
			'render_callback' => 'spcs_core_render_demo_form',
			'supports'        => array( 'html' => false, 'multiple' => false ),
		)
	);
}
add_action( 'init', 'spcs_core_register_form_block' );
