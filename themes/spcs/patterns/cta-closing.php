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
				<p class="spcs-lead"><?php esc_html_e( 'Join the people already bringing SPCS Gatekeepers to their campuses — attend a live training, get certified at home, or schedule one for your whole team.', 'spcs' ); ?></p>
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

				<!-- wp:group {"className":"spcs-crisis-callout","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
				<div class="wp-block-group spcs-crisis-callout" style="margin-top:var(--wp--preset--spacing--50)">
					<!-- wp:paragraph -->
					<p>
						<?php
						printf(
							/* translators: 1: "call or text 988" link, 2: 988lifeline.org link. */
							esc_html__( 'If you or someone you know needs support now, %1$s or go to %2$s. 988 is free and available 24/7. You will be connected with a skilled counselor who can help.', 'spcs' ),
							'<a href="tel:988">' . esc_html__( 'call or text 988', 'spcs' ) . '</a>',
							'<a href="https://988lifeline.org/" target="_blank" rel="noopener noreferrer">988Lifeline.org<span class="screen-reader-text"> ' . esc_html__( '(opens in a new tab)', 'spcs' ) . '</span></a>'
						);
						?>
					</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:paragraph {"className":"spcs-review-note","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
				<p class="spcs-review-note" style="margin-top:var(--wp--preset--spacing--30)"><?php esc_html_e( 'EDITORIAL NOTE — Dr. DeHay: this closing "Next step" band isn\'t in the site spec either. We added it because a page that only explains the problem and never asks for anything tends to lose the reader — this is the one clear, unmissable point where someone ready to act can actually do something, right before they\'d otherwise leave. Flag if you\'d rather it end on something softer.', 'spcs' ); ?></p>
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
