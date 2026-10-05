<?php
/**
 * Title: Closing call to action
 * Slug: spcs/cta-closing
 * Categories: spcs-conversion
 * Description: The purple closing panel. One ask, one alternative for people who are not ready to talk yet.
 * Keywords: cta, demo, contact, closing
 * Viewport Width: 1400
 *
 * @package SPCS
 */

$img = esc_url( get_template_directory_uri() . '/assets/img' );
?>
<!-- wp:group {"metadata":{"name":"Closing call to action"},"className":"spcs-section spcs-section--chapter is-dark","backgroundColor":"purple","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-section--chapter is-dark has-purple-background-color has-background">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:group {"className":"spcs-grid","layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-grid">
			<!-- wp:group {"className":"col-1-7","layout":{"type":"default"}} -->
			<div class="wp-block-group col-1-7">
				<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
				<p class="spcs-eyebrow"><?php esc_html_e( 'Next step', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"fontSize":"headline"} -->
				<h2 class="wp-block-heading has-headline-font-size"><?php esc_html_e( 'Become a Certified Instructor for $549', 'spcs' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"spcs-lead"} -->
				<p class="spcs-lead"><?php esc_html_e( 'Join the national network of instructors bringing SPCS to their campuses- attend a live training, schedule one for your whole team, or get certified at home.', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"className":"spcs-hero__actions","layout":{"type":"flex","flexWrap":"wrap"}} -->
				<div class="wp-block-group spcs-hero__actions">
					<!-- wp:buttons -->
					<div class="wp-block-buttons">
						<!-- wp:button {"backgroundColor":"white","textColor":"purple"} -->
						<div class="wp-block-button"><a class="wp-block-button__link has-purple-color has-white-background-color has-text-color has-background wp-element-button" href="/become-an-instructor/"><?php esc_html_e( 'Become an Instructor', 'spcs' ); ?></a></div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->

					<!-- wp:paragraph -->
					<p><a class="spcs-textlink" href="/about/"><?php esc_html_e( 'Read about the program instead', 'spcs' ); ?></a></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:paragraph {"className":"spcs-review-note"} -->
				<p class="spcs-review-note"><?php esc_html_e( 'Note — “Next step” and the “Read about the program” link are ours. The paragraph is your wording.', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"col-8-5","layout":{"type":"default"}} -->
			<div class="wp-block-group col-8-5">
				<!-- wp:html -->
				<div class="spcs-cta__photo">
					<picture>
						<source
							type="image/webp"
							srcset="<?php echo $img; ?>/two-students-1200.webp 1200w, <?php echo $img; ?>/two-students-2000.webp 2000w"
							sizes="(min-width: 64em) 30vw, 60vw"
						>
						<img
							src="<?php echo $img; ?>/two-students-1200.jpg"
							srcset="<?php echo $img; ?>/two-students-1200.jpg 1200w, <?php echo $img; ?>/two-students-2000.jpg 2000w"
							sizes="(min-width: 64em) 30vw, 60vw"
							width="1200"
							height="900"
							alt="<?php esc_attr_e( 'Two students talking together outdoors, one listening closely.', 'spcs' ); ?>"
							loading="lazy"
							decoding="async"
						>
					</picture>
				</div>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
