<?php
/**
 * Title: Hero — institutional promise
 * Slug: spcs/hero-institutional
 * Categories: spcs-openers
 * Description: The home page opener. A single claim, one primary action, and a full-bleed photograph with the colour block anchored into it.
 * Keywords: hero, opener, home
 * Viewport Width: 1400
 *
 * @package SPCS
 */

$img = esc_url( get_template_directory_uri() . '/assets/img' );
?>
<!-- wp:group {"metadata":{"name":"Hero"},"className":"spcs-section spcs-hero","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-hero">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:group {"className":"spcs-grid","layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-grid">
			<!-- wp:group {"className":"col-1-7","layout":{"type":"default"}} -->
			<div class="wp-block-group col-1-7">
				<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
				<p class="spcs-eyebrow"><?php esc_html_e( 'Suicide prevention for college students', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":1,"className":"spcs-hero__headline"} -->
				<h1 class="wp-block-heading spcs-hero__headline"><?php esc_html_e( 'More than 1 in 10 college students experience thoughts of suicide each year.', 'spcs' ); ?></h1>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"spcs-lead spcs-hero__standfirst"} -->
				<p class="spcs-lead spcs-hero__standfirst"><?php esc_html_e( 'Empower and support students by providing suicide prevention programming designed for them.', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"className":"spcs-hero__actions","layout":{"type":"flex","flexWrap":"wrap"}} -->
				<div class="wp-block-group spcs-hero__actions">
					<!-- wp:buttons -->
					<div class="wp-block-buttons">
						<!-- wp:button -->
						<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/become-an-instructor/"><?php esc_html_e( 'Become an Instructor', 'spcs' ); ?></a></div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->

					<!-- wp:paragraph -->
					<p><a class="spcs-textlink" href="#gatekeeper"><?php esc_html_e( 'What is a gatekeeper?', 'spcs' ); ?></a></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"col-8-5","layout":{"type":"default"}} -->
			<div class="wp-block-group col-8-5">
				<!-- wp:html -->
				<div class="spcs-hero__portrait">
					<picture>
						<source
							type="image/webp"
							srcset="<?php echo $img; ?>/peer-support-1200.webp 1200w, <?php echo $img; ?>/peer-support-2000.webp 2000w"
							sizes="(min-width: 64em) 30vw, 60vw"
						>
						<img
							src="<?php echo $img; ?>/peer-support-1200.jpg"
							srcset="<?php echo $img; ?>/peer-support-1200.jpg 1200w, <?php echo $img; ?>/peer-support-2000.jpg 2000w"
							sizes="(min-width: 64em) 30vw, 60vw"
							width="1200"
							height="900"
							alt="<?php esc_attr_e( 'A student resting a hand on a friend’s shoulder outdoors, both quiet and present.', 'spcs' ); ?>"
							fetchpriority="high"
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

	<!-- wp:group {"className":"spcs-panel spcs-bleed","metadata":{"name":"Hero image with colour block"},"layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-panel spcs-bleed" style="margin-top:clamp(3rem,6vw,5rem)">
		<!-- wp:group {"className":"spcs-panel__media","layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-panel__media">
			<!-- wp:html -->
			<picture>
				<source
					type="image/webp"
					srcset="<?php echo $img; ?>/campus-quad-1200.webp 1200w, <?php echo $img; ?>/campus-quad-2000.webp 2000w"
					sizes="(min-width: 64em) 75vw, 100vw"
				>
				<img
					src="<?php echo $img; ?>/campus-quad-2000.jpg"
					srcset="<?php echo $img; ?>/campus-quad-1200.jpg 1200w, <?php echo $img; ?>/campus-quad-2000.jpg 2000w"
					sizes="(min-width: 64em) 75vw, 100vw"
					width="2000"
					height="1125"
					alt="<?php esc_attr_e( 'Students sitting together on a campus lawn, talking and working.', 'spcs' ); ?>"
					fetchpriority="high"
					decoding="async"
				>
			</picture>
			<!-- /wp:html -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"spcs-panel__block is-dark","layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-panel__block is-dark">
			<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
			<p class="spcs-eyebrow"><?php esc_html_e( 'Nationally recognised', 'spcs' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"fontSize":"lead"} -->
			<p class="has-lead-font-size"><?php esc_html_e( 'Accepted into the Suicide Prevention Resource Center’s Best Practices Registry in 2023 — the only listed program developed specifically for college students.', 'spcs' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
