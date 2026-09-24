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
<!-- wp:group {"metadata":{"name":"Editorial notes"},"className":"spcs-section spcs-section--tight","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-section--tight">
	<!-- wp:group {"className":"spcs-shell spcs-shell--narrow","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell spcs-shell--narrow">
		<!-- wp:paragraph {"className":"spcs-review-note"} -->
		<p class="spcs-review-note"><?php esc_html_e( 'EDITORIAL NOTE — this page is a starting draft. Have counsel review the language below before the site goes live; nothing here should be treated as final legal wording yet.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"spcs-review-note","style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
		<p class="spcs-review-note" style="margin-top:var(--wp--preset--spacing--20)"><?php esc_html_e( 'EDITORIAL NOTE — Dr. DeHay: we added this page because a written privacy notice is standard best practice for any site that collects personal information through a form, which this one does. It gives campus partners something concrete for their own IT/procurement security review, and it builds trust with a visitor being asked to hand over their name and email on a mental-health-adjacent site. Once counsel signs off on the wording, this note can come out.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Opener"},"className":"spcs-section spcs-hero spcs-section--flush-top","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-hero spcs-section--flush-top">
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

<!-- wp:group {"metadata":{"name":"Notice"},"className":"spcs-section spcs-section--flush-top","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-section--flush-top">
	<!-- wp:group {"className":"spcs-shell spcs-shell--narrow spcs-prose spcs-prose--legal","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell spcs-shell--narrow spcs-prose spcs-prose--legal">
		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Information you give us', 'spcs' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'If you complete the team training inquiry form we collect your name, email address, organization, role, indicated timeline and anything you write in the message field. We use it to reply to you about the program. We do not sell it, rent it, or use it for advertising.', 'spcs' ); ?></p>
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
		<p><?php esc_html_e( 'Training inquiries are kept while the inquiry is active and for a reasonable period afterwards. Write to us and we will delete yours.', 'spcs' ); ?></p>
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
