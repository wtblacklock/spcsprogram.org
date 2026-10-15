<?php
/**
 * Page descriptions and social-sharing tags.
 *
 * Descriptions reuse the program's own wording from the site spec wherever a
 * page has some.
 *
 * @package SPCS
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Description for the current page.
 */
function spcs_page_description(): string {
	$descriptions = array(
		'home'                 => __( 'Empower and support students by providing suicide prevention programming designed for them. SPCS is the ONLY Best Practice gatekeeper training specifically designed for college campuses.', 'spcs' ),
		'about'                => __( 'Approved by the Suicide Prevention Resource Center as a Best Practice in Suicide Prevention. Live training delivered to groups of students by Certified Instructors, virtually or in-person.', 'spcs' ),
		'become-an-instructor' => __( 'Suicide Prevention for College Students (SPCS) is delivered on college campuses by Certified Instructors. Become a Certified Instructor for $549.', 'spcs' ),
		'instructor-login'     => __( 'Certified Instructors can sign in through Clover Educational Consulting Group to access the manual, slides, handouts, and other SPCS resources.', 'spcs' ),
		'store'                => __( 'Glad You’re Here: our suicide-prevention-awareness gear.', 'spcs' ),
		'newsroom'             => __( 'New research and news in college suicide prevention.', 'spcs' ),
	);

	if ( is_front_page() ) {
		return $descriptions['home'];
	}

	$slug = is_page() ? (string) get_post_field( 'post_name', get_queried_object_id() ) : '';

	return $descriptions[ $slug ] ?? $descriptions['home'];
}

/**
 * Print the description and Open Graph / Twitter tags.
 */
function spcs_print_meta(): void {
	$description = spcs_page_description();
	$title       = wp_get_document_title();
	$url         = is_front_page() ? home_url( '/' ) : get_permalink();
	$image       = SPCS_THEME_URI . '/assets/img/campus-quad-1200.jpg';

	$tags = array(
		array( 'name', 'description', $description ),
		array( 'property', 'og:type', 'website' ),
		array( 'property', 'og:site_name', 'SPCS' ),
		array( 'property', 'og:title', $title ),
		array( 'property', 'og:description', $description ),
		array( 'property', 'og:url', (string) $url ),
		array( 'property', 'og:image', $image ),
		array( 'name', 'twitter:card', 'summary_large_image' ),
	);

	if ( is_front_page() ) {
		// Bing Webmaster Tools ownership verification.
		$tags[] = array( 'name', 'msvalidate.01', '62980D40F87492380BD6FC68C4BB2361' );
	}

	foreach ( $tags as list( $attr, $key, $value ) ) {
		printf( '<meta %s="%s" content="%s">' . "\n", esc_attr( $attr ), esc_attr( $key ), esc_attr( $value ) );
	}
}
add_action( 'wp_head', 'spcs_print_meta', 4 );

/**
 * Titles read "About SPCS – Suicide Prevention for College Students (SPCS)", and
 * the home page is just the program's full name.
 *
 * @param array<string, string> $parts Title parts.
 * @return array<string, string>
 */
function spcs_title_parts( array $parts ): array {
	$name = __( 'Suicide Prevention for College Students (SPCS)', 'spcs' );

	if ( is_front_page() ) {
		return array( 'title' => $name );
	}

	$parts['site'] = $name;
	unset( $parts['tagline'] );

	return $parts;
}
add_filter( 'document_title_parts', 'spcs_title_parts' );
