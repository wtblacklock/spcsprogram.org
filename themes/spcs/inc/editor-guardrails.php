<?php
/**
 * Editor guardrails.
 *
 * The site will be maintained by people who are experts in suicide prevention,
 * not in web design or in safe-messaging-compliant HTML. These guardrails keep
 * the two risks in check: drifting off-brand, and publishing language that
 * contradicts what the program itself teaches.
 *
 * @package SPCS
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Phrases the program's own Safe Messaging curriculum tells facilitators to
 * avoid, mapped to the wording it teaches instead.
 *
 * @return array<string, string>
 */
function spcs_unsafe_phrases(): array {
	return array(
		'committed suicide'    => __( '“died by suicide” or “suicide death”', 'spcs' ),
		'commit suicide'       => __( '“die by suicide”', 'spcs' ),
		'commits suicide'      => __( '“dies by suicide”', 'spcs' ),
		'successful suicide'   => __( '“suicide death”', 'spcs' ),
		'unsuccessful suicide' => __( '“suicide attempt”', 'spcs' ),
		'failed suicide'       => __( '“suicide attempt”', 'spcs' ),
		'failed attempt'       => __( '“suicide attempt”', 'spcs' ),
	);
}

/**
 * Warn an editor when a post contains language the program teaches against.
 *
 * This is a notice, never a block on publishing: there are legitimate reasons
 * to quote unsafe language (for example, when explaining why it is unsafe).
 * The decision stays with the person, but they cannot make it unknowingly.
 */
function spcs_flag_unsafe_language(): void {
	$screen = get_current_screen();

	if ( ! $screen || 'post' !== $screen->base ) {
		return;
	}

	$post = get_post();

	if ( ! $post instanceof WP_Post ) {
		return;
	}

	$haystack = strtolower( wp_strip_all_tags( $post->post_content . ' ' . $post->post_title ) );
	$found    = array();

	foreach ( spcs_unsafe_phrases() as $phrase => $preferred ) {
		if ( str_contains( $haystack, $phrase ) ) {
			$found[ $phrase ] = $preferred;
		}
	}

	if ( ! $found ) {
		return;
	}

	echo '<div class="notice notice-warning"><p><strong>';
	esc_html_e( 'Safe messaging check', 'spcs' );
	echo '</strong></p><ul style="list-style:disc;margin-left:1.5em">';

	foreach ( $found as $phrase => $preferred ) {
		printf(
			'<li>%s</li>',
			sprintf(
				/* translators: 1: the discouraged phrase, 2: the preferred wording. */
				esc_html__( 'This page contains “%1$s”. The SPCS curriculum teaches %2$s instead.', 'spcs' ),
				esc_html( $phrase ),
				esc_html( $preferred )
			)
		);
	}

	echo '</ul><p>';
	esc_html_e( 'If the phrase is quoted deliberately, no change is needed.', 'spcs' );
	echo '</p></div>';
}
add_action( 'admin_notices', 'spcs_flag_unsafe_language' );

/**
 * Point editors at the safe messaging guidance from inside the editor.
 */
function spcs_editor_help_tab(): void {
	$screen = get_current_screen();

	if ( ! $screen ) {
		return;
	}

	$screen->add_help_tab(
		array(
			'id'      => 'spcs-safe-messaging',
			'title'   => __( 'Safe messaging', 'spcs' ),
			'content' =>
				'<h3>' . esc_html__( 'Writing about suicide on this site', 'spcs' ) . '</h3>' .
				'<ul style="list-style:disc;margin-left:1.5em">' .
				'<li>' . esc_html__( 'Write “died by suicide”, never “committed suicide”. Nothing frames it as a crime or a sin.', 'spcs' ) . '</li>' .
				'<li>' . esc_html__( 'Never describe method or means.', 'spcs' ) . '</li>' .
				'<li>' . esc_html__( 'Put a help resource next to any statistic about risk.', 'spcs' ) . '</li>' .
				'<li>' . esc_html__( 'Avoid language that presents suicide as inexplicable, romantic, or inevitable.', 'spcs' ) . '</li>' .
				'<li>' . esc_html__( 'Use person-first language: “a person living with schizophrenia”, not “a schizophrenic”.', 'spcs' ) . '</li>' .
				'</ul>' .
				'<p>' . esc_html__( 'The 988 Lifeline appears automatically at the top and bottom of every page — you do not need to add it by hand.', 'spcs' ) . '</p>',
		)
	);
}
add_action( 'current_screen', 'spcs_editor_help_tab' );

/**
 * Narrow the editor's formatting options to the design system.
 *
 * Custom colour pickers and arbitrary font sizes are the two settings that most
 * reliably pull a designed site out of shape. Both are already disabled in
 * theme.json; this removes the remaining core UI that can reintroduce them.
 */
function spcs_restrict_editor_settings( array $settings ): array {
	$settings['disableCustomColors']          = true;
	$settings['disableCustomFontSizes']       = true;
	$settings['disableCustomGradients']       = true;
	$settings['disableCustomSpacingSizes']    = true;
	$settings['enableCustomLineHeight']       = false;

	return $settings;
}
add_filter( 'block_editor_settings_all', 'spcs_restrict_editor_settings' );
