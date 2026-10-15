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

	if ( is_page( 'become-an-instructor' ) ) {
		$graph[] = spcs_core_course_schema();
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
 * The Certified Instructor course, as approved by Dr. DeHay (2026-10-15).
 *
 * @return array<string, mixed>
 */
function spcs_core_course_schema(): array {
	$url = home_url( '/become-an-instructor/' );

	return array(
		'@type'                       => 'Course',
		'@id'                         => $url . '#course',
		'name'                        => __( 'SPCS Certified Instructor Course', 'spcs-core' ),
		'description'                 => __( 'Certifies instructors to deliver Suicide Prevention for College Students (SPCS), a Best Practice gatekeeper training designed for college campuses.', 'spcs-core' ),
		'url'                         => $url,
		'provider'                    => array( '@id' => home_url( '/#organization' ) ),
		'inLanguage'                  => 'en-US',
		'educationalCredentialAwarded' => __( 'SPCS Certified Instructor (3 year certification)', 'spcs-core' ),
		'numberOfCredits'             => array(
			'@type' => 'StructuredValue',
			'name'  => __( 'Continuing Education credits', 'spcs-core' ),
			'value' => 3,
		),
		'offers'                      => array(
			array(
				'@type'         => 'Offer',
				'name'          => __( 'SPCS Certified Instructor Course', 'spcs-core' ),
				'category'      => 'Paid',
				'price'         => 549,
				'priceCurrency' => 'USD',
				'url'           => $url,
			),
			array(
				'@type'         => 'Offer',
				'name'          => __( 'Optional APA-approved CE credits for licensed mental health professionals', 'spcs-core' ),
				'category'      => 'Paid',
				'price'         => 90,
				'priceCurrency' => 'USD',
				'url'           => $url,
			),
		),
		'hasCourseInstance'           => array(
			array(
				'@type'       => 'CourseInstance',
				'name'        => __( 'Live virtual training', 'spcs-core' ),
				'courseMode'  => 'online',
				'description' => __( 'Live open-enrollment training hosted by Clover’s expert trainers, joined by individuals from across the country.', 'spcs-core' ),
			),
			array(
				'@type'          => 'CourseInstance',
				'name'           => __( 'Self-paced online training', 'spcs-core' ),
				'courseMode'     => 'online',
				'courseWorkload' => 'PT3H',
				'description'    => __( 'Immediate access to self-paced online training; become a Certified Instructor within 2-3 hours.', 'spcs-core' ),
			),
			array(
				'@type'       => 'CourseInstance',
				'name'        => __( 'Training for your team', 'spcs-core' ),
				'courseMode'  => 'blended',
				'description' => __( 'Live training for a team of 5-30 individuals, hosted virtually or on your campus.', 'spcs-core' ),
			),
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
