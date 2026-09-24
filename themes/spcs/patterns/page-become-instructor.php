<?php
/**
 * Title: Page — Become an Instructor
 * Slug: spcs/page-become-instructor
 * Categories: spcs-conversion, pages
 * Block Types: core/post-content
 * Description: Eligibility, what's included, the three certification paths and pricing, plus the team-training inquiry form.
 * Keywords: instructor, certification, register, pricing, ce credits
 * Viewport Width: 1400
 *
 * @package SPCS
 */

$img = esc_url( get_template_directory_uri() . '/assets/img' );
?>
<!-- wp:group {"metadata":{"name":"Opener"},"className":"spcs-section spcs-hero","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-hero">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:group {"className":"spcs-grid","layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-grid">
			<!-- wp:group {"className":"col-1-7","layout":{"type":"default"}} -->
			<div class="wp-block-group col-1-7">
				<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
				<p class="spcs-eyebrow"><?php esc_html_e( 'Become an Instructor', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":1,"fontSize":"headline"} -->
				<h1 class="wp-block-heading has-headline-font-size"><?php esc_html_e( 'Bring SPCS Gatekeepers to your campus yourself.', 'spcs' ); ?></h1>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"spcs-review-note"} -->
				<p class="spcs-review-note"><?php esc_html_e( 'EDITORIAL NOTE — Dr. DeHay: this headline isn\'t in the site spec, which starts this page straight from "Suicide Prevention for College Students (SPCS) is delivered on college campuses by Certified Instructors." We wrote a headline because the page needed one, and framed it around self-service — "yourself" — since that\'s the whole pitch of becoming an instructor rather than requesting a demo. Flag if you\'d rather it say something else.', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons {"className":"spcs-hero__actions"} -->
				<div class="wp-block-buttons spcs-hero__actions">
					<!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#connect"><?php esc_html_e( 'Skip to the form', 'spcs' ); ?></a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"col-9-4","layout":{"type":"default"}} -->
			<div class="wp-block-group col-9-4 spcs-opener-intro">
				<!-- wp:paragraph -->
				<p><?php esc_html_e( 'Suicide Prevention for College Students (SPCS) is delivered on college campuses by Certified Instructors', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Eligibility"},"className":"spcs-section","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:group {"className":"spcs-grid","layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-grid">
			<!-- wp:group {"className":"col-1-5 spcs-sticky","layout":{"type":"default"}} -->
			<div class="wp-block-group col-1-5 spcs-sticky">
				<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
				<p class="spcs-eyebrow"><?php esc_html_e( 'Eligibility', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'Certified Instructors must:', 'spcs' ); ?></h2>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"col-7-6 spcs-prose","layout":{"type":"default"}} -->
			<div class="wp-block-group col-7-6 spcs-prose">
				<!-- wp:list -->
				<ul class="wp-block-list">
					<li><?php esc_html_e( 'Be familiar with campus and local mental health resources in their community', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'Be at least 18 years old', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'Be in a professional role on campus OR be a college student in a supervised peer support role (e.g. Resident Advisor, Peer Health Educator)', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'Successfully complete the certification course', 'spcs' ); ?></li>
				</ul>
				<!-- /wp:list -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"What's included"},"className":"spcs-section","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:group {"className":"spcs-grid","layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-grid">
			<!-- wp:group {"className":"col-1-5 spcs-sticky","layout":{"type":"default"}} -->
			<div class="wp-block-group col-1-5 spcs-sticky">
				<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
				<p class="spcs-eyebrow"><?php esc_html_e( 'What’s included', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'Everything you need to run it.', 'spcs' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"spcs-review-note"} -->
				<p class="spcs-review-note"><?php esc_html_e( 'EDITORIAL NOTE — Dr. DeHay: the spec just labels this list "What\'s included" — the sentence heading is ours, added to give the list a point (that this is a complete kit, not a partial one) rather than just a label. Every item below it is straight from the spec.', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"col-7-6 spcs-prose","layout":{"type":"default"}} -->
			<div class="wp-block-group col-7-6 spcs-prose">
				<!-- wp:list -->
				<ul class="wp-block-list">
					<li><?php esc_html_e( '3 year Certification', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'SPCS Instructor Manual (both hardcopy and digital)', 'spcs' ); ?></li>
					<li>
						<?php esc_html_e( 'Downloadable teaching materials', 'spcs' ); ?>
						<!-- wp:list {"ordered":false} -->
						<ul class="wp-block-list">
							<li><?php esc_html_e( 'Powerpoint slides', 'spcs' ); ?></li>
							<li><?php esc_html_e( 'Training handouts', 'spcs' ); ?></li>
							<li><?php esc_html_e( 'Personalized QR codes for collecting pre/post training surveys', 'spcs' ); ?></li>
						</ul>
						<!-- /wp:list -->
					</li>
					<li><?php esc_html_e( 'Aggregate Training Outcomes report prepared annually by Clover so you can see your training impact', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'Digital “Certified Instructor” badge', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'Access to consultation from Clover to support your SPCS training', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'Discounts on swag to promote suicide prevention awareness on your campus', 'spcs' ); ?></li>
				</ul>
				<!-- /wp:list -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Certification paths"},"className":"spcs-section spcs-section--chapter is-dark","backgroundColor":"purple","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-section--chapter is-dark has-purple-background-color has-background">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:group {"className":"spcs-grid","layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-grid">
			<!-- wp:group {"className":"col-1-6","layout":{"type":"default"}} -->
			<div class="wp-block-group col-1-6">
				<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
				<p class="spcs-eyebrow"><?php esc_html_e( 'Pricing', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"fontSize":"title"} -->
				<h2 class="wp-block-heading has-title-font-size"><?php esc_html_e( 'Become a Certified Instructor for $549', 'spcs' ); ?></h2>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:html -->
		<div class="spcs-phases" style="margin-top:var(--wp--preset--spacing--50)">
			<div class="spcs-phase" data-reveal>
				<span class="spcs-phase__number"><?php esc_html_e( 'Option one', 'spcs' ); ?></span>
				<h3 class="spcs-phase__title"><?php esc_html_e( 'Attend a live virtual training', 'spcs' ); ?></h3>
				<p><?php esc_html_e( 'Review our schedule of live open-enrollment trainings, hosted by Clover’s expert trainers, and join other individuals from across the country in becoming certified.', 'spcs' ); ?></p>
				<p style="margin-top:var(--wp--preset--spacing--30)">
					<a class="spcs-textlink" href="https://clovered.org/spcs-instructor-training/" target="_blank" rel="noopener noreferrer">
						<?php esc_html_e( 'Register Now', 'spcs' ); ?>
						<span class="screen-reader-text"> (<?php esc_html_e( 'opens in a new tab', 'spcs' ); ?>)</span>
					</a>
					<!-- clovered.org has no dedicated live-cohort schedule yet — this points at the
					     general instructor training page. Swap it for a real schedule link once one exists. -->
				</p>
			</div>

			<div class="spcs-phase" data-reveal>
				<span class="spcs-phase__number"><?php esc_html_e( 'Option two', 'spcs' ); ?></span>
				<h3 class="spcs-phase__title"><?php esc_html_e( 'Become certified at home', 'spcs' ); ?></h3>
				<p><?php esc_html_e( 'Gain immediate access to our self-paced, online training, and become a Certified Instructor within 2-3 hours.', 'spcs' ); ?></p>
				<p style="margin-top:var(--wp--preset--spacing--30)">
					<a class="spcs-textlink" href="https://clovered.org/product/instructor-training-suicide-prevention-for-college-student-gatekeepers/" target="_blank" rel="noopener noreferrer">
						<?php esc_html_e( 'Register Now', 'spcs' ); ?>
						<span class="screen-reader-text"> (<?php esc_html_e( 'opens in a new tab', 'spcs' ); ?>)</span>
					</a>
				</p>
			</div>

			<div class="spcs-phase" data-reveal>
				<span class="spcs-phase__number"><?php esc_html_e( 'Option three', 'spcs' ); ?></span>
				<h3 class="spcs-phase__title"><?php esc_html_e( 'Schedule a training for your team', 'spcs' ); ?></h3>
				<p><?php esc_html_e( 'Our expert trainers will provide live training for your team of 5-30 individuals. We can host the training virtually or can come to your campus. Reach out to us to discuss the best option for your group and to receive a quote.', 'spcs' ); ?></p>
				<p style="margin-top:var(--wp--preset--spacing--30)"><a class="spcs-textlink" href="#connect"><?php esc_html_e( 'Connect With Us', 'spcs' ); ?></a></p>
			</div>
		</div>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"What a session looks like"},"className":"spcs-section","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:html -->
		<div class="spcs-panel spcs-panel--right" data-reveal>
			<div class="spcs-panel__media">
				<picture>
					<source type="image/webp" srcset="<?php echo $img; ?>/about-training-1200.webp 1200w, <?php echo $img; ?>/about-training-2000.webp 2000w" sizes="(min-width: 64em) 62vw, 100vw">
					<img src="<?php echo $img; ?>/about-training-1200.jpg" srcset="<?php echo $img; ?>/about-training-1200.jpg 1200w, <?php echo $img; ?>/about-training-2000.jpg 2000w" sizes="(min-width: 64em) 62vw, 100vw" width="1200" height="900" loading="lazy" decoding="async" alt="<?php esc_attr_e( 'A student on their way to deliver a session, course materials in hand.', 'spcs' ); ?>">
				</picture>
			</div>
			<div class="spcs-panel__block is-dark">
				<p class="spcs-eyebrow"><?php esc_html_e( 'Continuing education', 'spcs' ); ?></p>
				<h2><?php esc_html_e( 'Eligible for 3 CE credits.', 'spcs' ); ?></h2>
				<p><?php esc_html_e( 'The SPCS Certified Instructor Course is eligible for Continuing Education (3 CE credits). APA-approved CE credits are available to licensed mental health professionals for an additional, optional fee of $90.', 'spcs' ); ?></p>
			</div>
		</div>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Connect with us"},"className":"spcs-section","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section" id="connect">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:group {"className":"spcs-grid","layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-grid">
			<!-- wp:group {"className":"col-1-7","layout":{"type":"default"}} -->
			<div class="wp-block-group col-1-7">
				<!-- wp:spcs/demo-form /-->

				<!-- wp:group {"className":"spcs-crisis-callout","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
				<div class="wp-block-group spcs-crisis-callout" style="margin-top:var(--wp--preset--spacing--50)">
					<!-- wp:paragraph -->
					<p>
						<?php
						printf(
							/* translators: 1: "call 988" link, 2: "text 988" link. */
							esc_html__( 'This form is not monitored for emergencies. If you or someone you know needs help right now, %1$s or %2$s to reach the Suicide & Crisis Lifeline, any time.', 'spcs' ),
							'<a href="tel:988">' . esc_html__( 'call 988', 'spcs' ) . '</a>',
							'<a href="sms:988">' . esc_html__( 'text 988', 'spcs' ) . '</a>'
						);
						?>
					</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"col-9-4","layout":{"type":"default"}} -->
			<div class="wp-block-group col-9-4">
				<!-- wp:heading {"level":2,"fontSize":"title-sm"} -->
				<h2 class="wp-block-heading has-title-sm-font-size"><?php esc_html_e( 'What happens next', 'spcs' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:html -->
				<ol class="spcs-timeline">
					<li class="spcs-timeline__item">
						<h3 class="spcs-timeline__title"><?php esc_html_e( 'We reply within two working days', 'spcs' ); ?></h3>
						<p class="spcs-timeline__body"><?php esc_html_e( 'From a person on the program team, not an automated sequence.', 'spcs' ); ?></p>
					</li>
					<li class="spcs-timeline__item">
						<h3 class="spcs-timeline__title"><?php esc_html_e( 'A short call, if you want one', 'spcs' ); ?></h3>
						<p class="spcs-timeline__body"><?php esc_html_e( 'Twenty to thirty minutes on your group, your facilitators and scheduling.', 'spcs' ); ?></p>
					</li>
					<li class="spcs-timeline__item">
						<h3 class="spcs-timeline__title"><?php esc_html_e( 'A quote to circulate', 'spcs' ); ?></h3>
						<p class="spcs-timeline__body"><?php esc_html_e( 'Pricing for your group size, in a form you can forward to whoever signs off.', 'spcs' ); ?></p>
					</li>
				</ol>
				<!-- /wp:html -->

				<!-- wp:paragraph {"className":"spcs-review-note","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
				<p class="spcs-review-note" style="margin-top:var(--wp--preset--spacing--30)"><?php esc_html_e( 'EDITORIAL NOTE — Dr. DeHay: this "What happens next" timeline isn\'t in the site spec. We added it because a team-training inquiry form is a bigger ask than a newsletter signup — someone filling it out wants to know what happens to their information and when they\'ll hear back, and a page that leaves that unanswered reads as riskier to fill out. Please confirm the two-working-days, twenty-to-thirty-minute-call and quote steps are actually accurate to how this works today.', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
