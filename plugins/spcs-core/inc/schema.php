<?php
/**
 * JSON-LD structured data.
 *
 * Emitted from the same content the pages render, so the markup can never drift
 * away from what a visitor actually sees — which is both a correctness point and
 * a Google structured-data policy requirement.
 *
 * @package SPCS_Core
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output structured data in the head.
 */
function spcs_core_print_schema(): void {
	$graph = array();

	$organization = array(
		'@type'       => 'EducationalOrganization',
		'@id'         => home_url( '/#organization' ),
		'name'        => 'Clover Educational Consulting Group',
		'url'         => home_url( '/' ),
		'sameAs'      => array( 'https://clovered.org' ),
		'description' => __( 'Developer of the Suicide Prevention for College Student (SPCS) Gatekeepers Program.', 'spcs-core' ),
	);

	$graph[] = $organization;

	$graph[] = array(
		'@type'       => 'WebSite',
		'@id'         => home_url( '/#website' ),
		'url'         => home_url( '/' ),
		'name'        => get_bloginfo( 'name' ),
		'publisher'   => array( '@id' => home_url( '/#organization' ) ),
		'inLanguage'  => 'en-US',
	);

	if ( is_front_page() ) {
		$graph[] = spcs_core_program_schema();
	}

	if ( is_page( 'faq' ) ) {
		$faq = spcs_core_faq_schema();

		if ( $faq ) {
			$graph[] = $faq;
		}
	}

	if ( is_page( 'about' ) ) {
		foreach ( spcs_core_study_schema() as $study ) {
			$graph[] = $study;
		}
	}

	if ( ! $graph ) {
		return;
	}

	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode(
			array(
				'@context' => 'https://schema.org',
				'@graph'   => $graph,
			),
			JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
		)
	);
}
add_action( 'wp_head', 'spcs_core_print_schema', 20 );

/**
 * The program itself.
 *
 * @return array<string, mixed>
 */
function spcs_core_program_schema(): array {
	return array(
		'@type'               => 'EducationalOccupationalProgram',
		'@id'                 => home_url( '/#program' ),
		'name'                => 'Suicide Prevention for College Student (SPCS) Gatekeepers',
		'description'         => __( 'A 90-minute, evidence-based gatekeeper training designed specifically for college students, delivered in person or virtually by a trained campus facilitator.', 'spcs-core' ),
		'url'                 => home_url( '/about/' ),
		'provider'            => array( '@id' => home_url( '/#organization' ) ),
		'educationalProgramMode' => array( 'onsite', 'online' ),
		'timeToComplete'      => 'PT90M',
		'audience'            => array(
			'@type'                 => 'EducationalAudience',
			'educationalRole'       => 'student',
			'audienceType'          => 'College and university students',
		),
		'teaches'             => array(
			__( 'Recognising warning signs of suicide risk in peers', 'spcs-core' ),
			__( 'Conducting a basic suicide risk assessment', 'spcs-core' ),
			__( 'Referring peers to campus, local and national resources', 'spcs-core' ),
			__( 'Safe messaging about suicide', 'spcs-core' ),
		),
	);
}

/**
 * FAQ page markup built from the FAQ post type.
 *
 * @return array<string, mixed>|null
 */
function spcs_core_faq_schema(): ?array {
	$faqs = spcs_core_get_entries( 'spcs_faq', -1 );

	if ( ! $faqs ) {
		return null;
	}

	$entities = array();

	foreach ( $faqs as $faq ) {
		$entities[] = array(
			'@type'          => 'Question',
			'name'           => get_the_title( $faq ),
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => wp_strip_all_tags( $faq->post_content ),
			),
		);
	}

	return array(
		'@type'      => 'FAQPage',
		'@id'        => home_url( '/faq/#faq' ),
		'mainEntity' => $entities,
	);
}

/**
 * Scholarly article markup for each published study.
 *
 * @return array<int, array<string, mixed>>
 */
function spcs_core_study_schema(): array {
	$out = array();

	foreach ( spcs_core_get_entries( 'spcs_study', -1 ) as $study ) {
		$entry = array(
			'@type'    => 'ScholarlyArticle',
			'headline' => get_the_title( $study ),
		);

		$authors = spcs_core_field( $study->ID, 'spcs_authors' );
		$year    = spcs_core_field( $study->ID, 'spcs_year' );
		$journal = spcs_core_field( $study->ID, 'spcs_journal' );
		$url     = spcs_core_field( $study->ID, 'spcs_url' );

		if ( $authors ) {
			$entry['author'] = array( '@type' => 'Person', 'name' => $authors );
		}

		if ( $year ) {
			$entry['datePublished'] = $year;
		}

		if ( $journal ) {
			$entry['isPartOf'] = array( '@type' => 'Periodical', 'name' => $journal );
		}

		if ( $url ) {
			$entry['url'] = $url;
		}

		$out[] = $entry;
	}

	return $out;
}
