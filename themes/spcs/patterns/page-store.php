<?php
/**
 * Title: Page — Store
 * Slug: spcs/page-store
 * Categories: spcs-editorial, pages
 * Block Types: core/post-content
 * Description: Placeholder for the Glad You're Here swag store. Replace the button link once the Printify pop-up store is live.
 * Keywords: store, shop, printify, swag, glad you're here
 * Viewport Width: 1400
 *
 * @package SPCS
 */

$img = esc_url( get_template_directory_uri() . '/assets/img' );
?>
<!-- wp:group {"metadata":{"name":"Opener"},"className":"spcs-section spcs-hero","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-hero">
	<!-- wp:group {"className":"spcs-shell spcs-shell--narrow","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell spcs-shell--narrow">
		<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
		<p class="spcs-eyebrow"><?php esc_html_e( 'Store', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:html -->
		<div class="spcs-store__intro">
			<picture class="spcs-store__mark">
				<source type="image/webp" srcset="<?php echo $img; ?>/glad-youre-here-logo-480.webp">
				<img
					src="<?php echo $img; ?>/glad-youre-here-logo-480.png"
					width="140"
					height="140"
					loading="eager"
					decoding="async"
					alt="<?php esc_attr_e( 'Glad You’re Here', 'spcs' ); ?>"
				>
			</picture>
			<h1 class="wp-block-heading has-headline-font-size"><?php esc_html_e( 'Glad You’re Here — our suicide-prevention-awareness gear.', 'spcs' ); ?></h1>
		</div>
		<!-- /wp:html -->

		<!-- wp:paragraph {"className":"spcs-lead"} -->
		<p class="spcs-lead"><?php esc_html_e( 'Shirts, stickers and more, carrying a message worth wearing. Our shop is being set up now — check back soon, or follow the link below once it opens.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button">
				<a class="wp-block-button__link wp-element-button" href="#" rel="nofollow"><?php esc_html_e( 'Shop Glad You’re Here', 'spcs' ); ?></a>
				<!-- Point this at the Printify pop-up store once it is published. -->
			</div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'Certified Instructors get a discount on everything here.', 'spcs' ); ?> <a class="spcs-textlink" href="/become-an-instructor/"><?php esc_html_e( 'Become an Instructor', 'spcs' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
