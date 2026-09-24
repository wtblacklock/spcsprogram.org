<?php
/**
 * Starter content.
 *
 * Seeds the studies, outcomes, testimonials and FAQs that already exist in the
 * program's published materials, so a fresh install is immediately real rather
 * than full of placeholder text. Runs once, only when the relevant post type is
 * completely empty, so it can never overwrite edited content.
 *
 * Every figure below is traceable to either the SPCS Training Manual or the
 * program page on cloveredconsulting.com. Figures carry their source with them
 * — see the `spcs_source` field — because a number on this site without an
 * attribution is a liability.
 *
 * @package SPCS_Core
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Seed data.
 *
 * @return array<string, array<int, array<string, mixed>>>
 */
function spcs_core_seed_data(): array {
	return array(
		'spcs_study'       => array(
			array(
				'title' => 'Evaluating the Gatekeeper Training Outcome Package (GTOP)',
				'meta'  => array(
					'spcs_authors' => 'Ross, S.G., Pazienza, R., Rosa, J. D., & Lipowski',
					'spcs_year'    => '2025',
					'spcs_journal' => '[Manuscript under review]. <a href="https://clovered.org" target="_blank" rel="noopener noreferrer">Clover Educational Consulting Group</a>',
					'spcs_locator' => '',
					'spcs_finding' => 'Ongoing work validating the measurement package used to evaluate gatekeeper training outcomes.',
				),
			),
			array(
				'title' => 'The Suicide Prevention for College Students (SPCS) Gatekeepers Program: Comparing in-person and online training outcomes',
				'meta'  => array(
					'spcs_authors' => 'Ross, S. G., Pazienza, R., & Rosa, J. D.',
					'spcs_year'    => '2024',
					'spcs_journal' => 'Journal of American College Health',
					'spcs_locator' => '1–4.',
					'spcs_finding' => 'Virtual delivery produced outcomes comparable to in-person delivery — so scheduling constraints do not have to cost you effectiveness.',
				),
			),
			array(
				'title' => 'The Suicide Prevention for College Student (SPCS) gatekeepers program: A 3-year review of the evidence',
				'meta'  => array(
					'spcs_authors' => 'Ross, S. G., Pazienza, R., & Rosa, J. D.',
					'spcs_year'    => '2024',
					'spcs_journal' => 'Crisis: The Journal of Crisis Intervention and Suicide Prevention',
					'spcs_locator' => '45(1), 41–47.',
					'spcs_finding' => 'Three years of data across multiple institutions show sustained gains in suicide prevention knowledge and self-efficacy, and reduced stigmatizing beliefs.',
				),
			),
			array(
				'title' => 'The suicide prevention for college student gatekeepers program: A pilot study',
				'meta'  => array(
					'spcs_authors' => 'Ross, S. G., DeHay, T., & Deiling, M.',
					'spcs_year'    => '2021',
					'spcs_journal' => 'Crisis: The Journal of Crisis Intervention and Suicide Prevention',
					'spcs_locator' => '42(1), 48–55.',
					'spcs_finding' => 'The original pilot (n = 65) found higher self-reported prevention competence, fewer stigmatizing beliefs, and increased knowledge about suicide.',
				),
			),
		),
		'spcs_outcome'     => array(
			array(
				'title' => 'Supported a peer within 12 weeks',
				'meta'  => array(
					'spcs_value'  => '45%',
					'spcs_label'  => 'of participants had supported at least one person experiencing a mental health concern within 12 weeks of training.',
					'spcs_source' => 'Ross et al., 2023 — 12-week follow-up data.',
				),
			),
			array(
				'title' => 'Students trained',
				'meta'  => array(
					'spcs_value'  => '900+',
					'spcs_label'  => 'college students trained across six institutions, and counting.',
					'spcs_source' => 'SPCS Gatekeepers Training Manual, 2023.',
				),
			),
			array(
				'title' => 'SAMHSA grants',
				'meta'  => array(
					'spcs_value'  => '3',
					'spcs_label'  => 'federal Mental Health Awareness Training grants funded dissemination in North Carolina, Texas and Minnesota.',
					'spcs_source' => 'SAMHSA Mental Health Awareness Training (MHAT) grants.',
				),
			),
		),
		'spcs_testimonial' => array(
			array(
				'title'   => 'Strategies and resources',
				'content' => 'I have a few friends who are struggling right now and I wasn’t sure how to help them. This gave me strategies and resources I needed to help them.',
				'meta'    => array(
					'spcs_attribution' => 'Student participant',
					'spcs_consent'     => true,
				),
			),
			array(
				'title'   => 'Everyone should receive this training',
				'content' => 'I think EVERYONE should receive this training.',
				'meta'    => array(
					'spcs_attribution' => 'Student participant',
					'spcs_consent'     => true,
				),
			),
			array(
				'title'   => 'Empowered to help',
				'content' => 'I feel empowered that I have the ability to help in a crisis.',
				'meta'    => array(
					'spcs_attribution' => 'Student participant',
					'spcs_consent'     => true,
				),
			),
			array(
				'title'   => 'Information that could save a life',
				'content' => 'The course provided me with information that could save a life.',
				'meta'    => array(
					'spcs_attribution' => 'Student participant',
					'spcs_consent'     => true,
				),
			),
			array(
				'title'   => 'Better prepared',
				'content' => 'As a college student, I have encountered many students who have shown signs that they were suicidal. I now feel more equipped to handle those situations.',
				'meta'    => array(
					'spcs_attribution' => 'Student participant',
					'spcs_consent'     => true,
				),
			),
			array(
				'title'   => 'Peers knowing how to help',
				'content' => 'This training is so important. In an environment where many people our age are feeling suicidal or need help, it helps to have peers know how to help or where to go.',
				'meta'    => array(
					'spcs_attribution' => 'Student participant',
					'spcs_consent'     => true,
				),
			),
			array(
				'title'   => 'Feeling better prepared',
				'content' => 'I already had experience with people who were suicidal, but now I feel better prepared. I wish more people understood how big of a problem this is.',
				'meta'    => array(
					'spcs_attribution' => 'Student participant',
					'spcs_consent'     => true,
				),
			),
			array(
				'title'   => 'How to approach hard conversations',
				'content' => 'The prevention program really resonated with me on how to properly approach uncomfortable, but sometimes necessary, conversations.',
				'meta'    => array(
					'spcs_attribution' => 'Student participant',
					'spcs_consent'     => true,
				),
			),
		),
		'spcs_faq'         => array(
			array(
				'title'   => 'How long does the training take?',
				'content' => 'Ninety minutes of instruction, plus time before for consent and the pre-training questionnaire and time after for the post-training questionnaire. Facilitators stay available afterward for questions. Most campuses schedule roughly a two-hour block to be safe.',
				'meta'    => array( 'spcs_faq_group' => 'Delivery' ),
			),
			array(
				'title'   => 'Who is allowed to facilitate it?',
				'content' => 'A licensed mental health professional is recommended because of the sensitivity of the material. Non-licensed campus personnel may facilitate if they are familiar with campus resources and referral processes and are prepared to support participants. Facilitators complete instructor training and prepare the material before delivering it. We also encourage co-facilitation with a student peer — the slide deck includes talking points written for student co-facilitators.',
				'meta'    => array( 'spcs_faq_group' => 'Delivery' ),
			),
			array(
				'title'   => 'Can it be delivered online?',
				'content' => 'Yes. Published research comparing in-person and virtual delivery found comparable outcomes. The manual includes specific guidance for virtual delivery, including breakout-room practice, chat monitoring and opt-out procedures for role play.',
				'meta'    => array( 'spcs_faq_group' => 'Delivery' ),
			),
			array(
				'title'   => 'What makes this different from other gatekeeper trainings?',
				'content' => 'It was built for college students specifically. SPCS is the only Best Practice gatekeeper training in the SPRC Best Practices Registry that was designed for — and has evidence in — this population. Every scenario, discussion prompt and role play is set in campus life.',
				'meta'    => array( 'spcs_faq_group' => 'Evidence' ),
			),
			array(
				'title'   => 'What evidence is there that it works?',
				'content' => 'Four peer-reviewed publications, including a pilot study and a three-year review of the evidence, both in <em>Crisis</em>, and a comparison of in-person and online delivery in the <em>Journal of American College Health</em>. Participants show gains in knowledge and self-efficacy and reductions in stigmatizing beliefs, sustained at twelve-week follow-up.',
				'meta'    => array( 'spcs_faq_group' => 'Evidence' ),
			),
			array(
				'title'   => 'What data will we get back?',
				'content' => 'Sites using the Clover data service receive a unique QR code for participants and access to a dashboard showing the number and demographics of students trained, average ratings on outcome variables, twelve-week follow-up data on skill use, and participant comments. Sites that prefer to keep data in-house can run the same questionnaires themselves using the instruments in the manual.',
				'meta'    => array( 'spcs_faq_group' => 'Data' ),
			),
			array(
				'title'   => 'Is student data anonymous?',
				'content' => 'Yes. All data collected for the program is anonymous and student names are not collected. Students read and agree to an informed consent document before completing the pre-training questionnaire.',
				'meta'    => array( 'spcs_faq_group' => 'Data' ),
			),
			array(
				'title'   => 'What do we need to have in place to run it?',
				'content' => 'A facilitator familiar with campus resources and referral processes; a classroom or an online platform; printed or electronic handouts; a way to collect pre- and post-training questionnaires; and someone on call who can provide support to a student during the session if needed. A student co-facilitator is optional and recommended.',
				'meta'    => array( 'spcs_faq_group' => 'Implementation' ),
			),
			array(
				'title'   => 'How many students should be in one session?',
				'content' => 'No more than thirty. Smaller groups have better engagement and discussion, which matters for material this sensitive.',
				'meta'    => array( 'spcs_faq_group' => 'Implementation' ),
			),
			array(
				'title'   => 'Can we use the program for our own research?',
				'content' => 'Yes, with IRB approval from your institution. Please tell us if you do, so program-related research can be tracked. Sites that opt in to the Clover data service can also allow their data to contribute to ongoing efficacy research.',
				'meta'    => array( 'spcs_faq_group' => 'Evidence' ),
			),
		),
	);
}

/**
 * Insert the starter content.
 *
 * Idempotent: a post type that already has any entry is skipped entirely.
 */
function spcs_core_seed(): void {
	foreach ( spcs_core_seed_data() as $post_type => $entries ) {
		$existing = get_posts(
			array(
				'post_type'   => $post_type,
				'post_status' => 'any',
				'numberposts' => 1,
				'fields'      => 'ids',
			)
		);

		if ( $existing ) {
			continue;
		}

		foreach ( $entries as $index => $entry ) {
			$post_id = wp_insert_post(
				array(
					'post_type'    => $post_type,
					'post_status'  => 'publish',
					'post_title'   => $entry['title'],
					'post_content' => $entry['content'] ?? '',
					'menu_order'   => $index,
				)
			);

			if ( is_wp_error( $post_id ) ) {
				continue;
			}

			foreach ( $entry['meta'] ?? array() as $key => $value ) {
				update_post_meta( $post_id, $key, $value );
			}
		}
	}
}
