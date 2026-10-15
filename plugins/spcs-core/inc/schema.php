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
		'url'         => 'https://clovered.org',
		'description' => __( 'Developer of the Suicide Prevention for College Students (SPCS) program.', 'spcs-core' ),
	);

	$graph[] = $organization;

	$graph[] = array(
		'@type'       => 'WebSite',
		'@id'         => home_url( '/#website' ),
		'url'         => home_url( '/' ),
		'name'          => __( 'Suicide Prevention for College Students (SPCS)', 'spcs-core' ),
		'alternateName' => 'SPCS',
		'publisher'     => array( '@id' => home_url( '/#organization' ) ),
		'inLanguage'  => 'en-US',
	);

	if ( is_front_page() ) {
		$graph[] = spcs_core_program_schema();
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
		'name'                => 'Suicide Prevention for College Students (SPCS)',
		'description'         => __( 'Live training delivered to groups of students by Certified Instructors, virtually or in-person. Equips students with the knowledge and confidence to recognize signs of suicide risk in peers and connect them with help.', 'spcs-core' ),
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
			__( 'Using safe and respectful language', 'spcs-core' ),
			__( 'College suicide statistics', 'spcs-core' ),
			__( 'Common myths and misconceptions', 'spcs-core' ),
			__( 'Suicide risk factors and warning signs', 'spcs-core' ),
			__( 'Conducting a basic suicide risk assessment with peers', 'spcs-core' ),
			__( 'Using a decision tree to determine the best course of action', 'spcs-core' ),
			__( 'Connecting peers to support', 'spcs-core' ),
		),
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
