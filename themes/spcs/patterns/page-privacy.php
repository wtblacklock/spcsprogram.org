<?php
/**
 * Title: Page — Privacy
 * Slug: spcs/page-privacy
 * Categories: spcs-editorial, pages
 * Block Types: core/post-content
 * Description: Plain-language privacy notice. Review with counsel before launch.
 * Keywords: privacy, data, legal
 * Viewport Width: 1400
 *
 * @package SPCS
 */

?>
<!-- wp:group {"metadata":{"name":"Opener"},"className":"spcs-section spcs-hero","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-hero">
	<!-- wp:group {"className":"spcs-shell spcs-shell--narrow","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell spcs-shell--narrow">
		<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
		<p class="spcs-eyebrow"><?php esc_html_e( 'Privacy', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"fontSize":"headline"} -->
		<h1 class="wp-block-heading has-headline-font-size"><?php esc_html_e( 'What this website collects, and what it does not.', 'spcs' ); ?></h1>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Notice"},"className":"spcs-section","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section">
	<!-- wp:group {"className":"spcs-shell spcs-shell--narrow spcs-prose","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell spcs-shell--narrow spcs-prose">
		<!-- wp:paragraph -->
		<p><strong><?php esc_html_e( 'This page is a starting draft. Have it reviewed by counsel before the site goes live.', 'spcs' ); ?></strong></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Information you give us', 'spcs' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'If you complete the team training inquiry form we collect your name, email address, organisation, role, indicated timeline and anything you write in the message field. We use it to reply to you about the program. We do not sell it, rent it, or use it for advertising.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Information collected automatically', 'spcs' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'Our web host keeps standard server logs. When you submit the form we briefly store a one-way hash of your IP address to limit automated abuse; the address itself is never stored. This site does not use advertising cookies or third-party tracking scripts, and fonts are served from our own server rather than a font network.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Training data is separate from this website', 'spcs' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'Questionnaire data collected during the training program itself is anonymous — student names are not collected — and is handled under the program’s own consent process, not through this website.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'How long we keep things', 'spcs' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'Training inquiries are kept while the enquiry is active and for a reasonable period afterwards. Write to us and we will delete yours.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Contact', 'spcs' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>
			<?php
			printf(
				/* translators: %s: link to the contact form. */
				esc_html__( 'Questions about this notice, or requests to see or delete your information, can go to %s.', 'spcs' ),
				'<a class="spcs-textlink" href="' . esc_url( home_url( '/become-an-instructor/#connect' ) ) . '">' . esc_html__( 'the team', 'spcs' ) . '</a>'
			);
			?>
		</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
