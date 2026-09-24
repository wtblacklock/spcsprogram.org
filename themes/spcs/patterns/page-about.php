<?php
/**
 * Title: Page — About SPCS
 * Slug: spcs/page-about
 * Categories: spcs-editorial, pages
 * Block Types: core/post-content
 * Description: What the program is, how the 90 minutes runs, the research behind it, and who built it.
 * Keywords: about, program, evidence, three-phase, clover, authors
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
				<p class="spcs-eyebrow"><?php esc_html_e( 'About SPCS', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":1,"fontSize":"headline"} -->
				<h1 class="wp-block-heading has-headline-font-size"><?php esc_html_e( 'Approved by the Suicide Prevention Resource Center as a Best Practice in Suicide Prevention', 'spcs' ); ?></h1>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"col-9-4","layout":{"type":"default"}} -->
			<div class="wp-block-group col-9-4 spcs-opener-intro">
				<!-- wp:paragraph -->
				<p><strong><?php esc_html_e( 'Suicide Prevention for College Students (SPCS)', 'spcs' ); ?></strong></p>
				<!-- /wp:paragraph -->

				<!-- wp:list -->
				<ul class="wp-block-list">
					<li><?php esc_html_e( 'Live training delivered to groups of students by Certified Instructors, virtually or in-person', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'Only 90 minutes- easy to incorporate into a class period or campus activity', 'spcs' ); ?></li>
					<li>
						<?php
						printf(
							/* translators: %s: link to Clover Educational Consulting Group. */
							esc_html__( 'Evidence-based and research-based- developed for use on college campuses by experts at %s', 'spcs' ),
							'<a href="https://clovered.org" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Clover Educational Consulting Group', 'spcs' ) . '</a>'
						);
						?>
					</li>
					<li><?php esc_html_e( 'Equips students with the knowledge and confidence to recognize signs of suicide risk in peers and connect them with help', 'spcs' ); ?></li>
				</ul>
				<!-- /wp:list -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:html -->
		<div class="spcs-credibility" style="margin-top:var(--wp--preset--spacing--40)" data-reveal>
			<picture>
				<source type="image/webp" srcset="<?php echo $img; ?>/sprc-badge-340.webp">
				<img
					class="spcs-credibility__badge"
					src="<?php echo $img; ?>/sprc-badge-340.png"
					width="340"
					height="342"
					loading="lazy"
					decoding="async"
					alt="<?php esc_attr_e( 'Suicide Prevention Resource Center Approved Program — Best Practices Registry', 'spcs' ); ?>"
				>
			</picture>
			<p class="spcs-credibility__claim">
				<?php esc_html_e( 'Approved by the Suicide Prevention Resource Center as a Best Practice in Suicide Prevention', 'spcs' ); ?>
			</p>
		</div>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"spcs/three-phase-model"} /-->

<!-- wp:group {"metadata":{"name":"Research support"},"className":"spcs-section","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section" id="research">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:group {"className":"spcs-grid","layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-grid">
			<!-- wp:group {"className":"col-1-4 spcs-sticky","layout":{"type":"default"},"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} -->
			<div class="wp-block-group col-1-4 spcs-sticky" style="grid-column:1 / span 4">
				<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
				<p class="spcs-eyebrow"><?php esc_html_e( 'Research Support for SPCS', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'Peer-reviewed, and still being reviewed.', 'spcs' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p><?php esc_html_e( 'Every claim on this site traces back to one of these.', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"spcs-review-note"} -->
				<p class="spcs-review-note"><?php esc_html_e( 'EDITORIAL NOTE — Dr. DeHay: the headline "Peer-reviewed, and still being reviewed." isn\'t in the site spec — we wrote it to introduce the citations below in one line, signalling that the evidence base is real but still growing (the GTOP study is still under review). Flag if you\'d rather this say something else.', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"col-6-7","layout":{"type":"default"}} -->
			<div class="wp-block-group col-6-7">
				<!-- wp:spcs/studies -->
				<!-- /wp:spcs/studies -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Training in session"},"className":"spcs-section","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:html -->
		<div class="spcs-panel" data-reveal>
			<div class="spcs-panel__media">
				<picture>
					<source type="image/webp" srcset="<?php echo $img; ?>/instructor-workshop-1200.webp 1200w, <?php echo $img; ?>/instructor-workshop-2000.webp 2000w" sizes="(min-width: 64em) 62vw, 100vw">
					<img src="<?php echo $img; ?>/instructor-workshop-1200.jpg" srcset="<?php echo $img; ?>/instructor-workshop-1200.jpg 1200w, <?php echo $img; ?>/instructor-workshop-2000.jpg 2000w" sizes="(min-width: 64em) 62vw, 100vw" width="1200" height="900" loading="lazy" decoding="async" alt="<?php esc_attr_e( 'A facilitator leading a training session for a seated group of students.', 'spcs' ); ?>">
				</picture>
			</div>
			<div class="spcs-panel__block is-dark">
				<p class="spcs-eyebrow"><?php esc_html_e( 'The SPCS difference', 'spcs' ); ?></p>
				<h2><?php esc_html_e( 'Built for college students. Nothing about it is generic.', 'spcs' ); ?></h2>
				<p><?php esc_html_e( 'SPCS is the only Best Practice gatekeeper training designed specifically for colleges. Every fact, example, discussion prompt, and role-play activity is tailored to college students and campus life, making the training highly relevant, engaging, and impactful.', 'spcs' ); ?></p>
			</div>
		</div>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"spcs/cta-closing"} /-->
