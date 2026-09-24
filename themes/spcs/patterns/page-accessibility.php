<?php
/**
 * Title: Page — Accessibility
 * Slug: spcs/page-accessibility
 * Categories: spcs-editorial, pages
 * Block Types: core/post-content
 * Description: Accessibility statement. Higher-education IT review will ask for this.
 * Keywords: accessibility, wcag, a11y, vpat
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
		<p class="spcs-eyebrow"><?php esc_html_e( 'Accessibility', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"fontSize":"headline"} -->
		<h1 class="wp-block-heading has-headline-font-size"><?php esc_html_e( 'This site is built to be usable by everyone who needs it.', 'spcs' ); ?></h1>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Statement"},"className":"spcs-section","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section">
	<!-- wp:group {"className":"spcs-shell spcs-shell--narrow spcs-prose","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell spcs-shell--narrow spcs-prose">
		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Standard we work to', 'spcs' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'We aim to meet WCAG 2.2 Level AA. This is a commitment we test against rather than a certification, and we would rather hear about a failure than have it go unreported.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'What that means in practice', 'spcs' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:list -->
		<ul class="wp-block-list">
			<li><?php esc_html_e( 'Every interactive element can be reached and operated with a keyboard alone, and always shows a visible focus indicator.', 'spcs' ); ?></li>
			<li><?php esc_html_e( 'Text meets AA contrast against its background. Colour is never the only way information is conveyed.', 'spcs' ); ?></li>
			<li><?php esc_html_e( 'Animation is removed entirely for anyone whose system asks for reduced motion.', 'spcs' ); ?></li>
			<li><?php esc_html_e( 'Headings, landmarks and lists are marked up semantically so screen readers can navigate by structure.', 'spcs' ); ?></li>
			<li><?php esc_html_e( 'Form fields have real labels, and errors are described in words rather than signalled only by colour.', 'spcs' ); ?></li>
			<li><?php esc_html_e( 'Photographs carry alternative text; decorative graphics are hidden from assistive technology.', 'spcs' ); ?></li>
			<li><?php esc_html_e( 'The layout works at 400% zoom without horizontal scrolling.', 'spcs' ); ?></li>
		</ul>
		<!-- /wp:list -->

		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Known limitations', 'spcs' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'The materials Certified Instructors receive — the manual, slides and handouts — were produced for print and some may not be fully tagged for screen readers yet. If you need any document in an accessible format, ask and we will provide one.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Tell us about a problem', 'spcs' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'If something on this site is difficult or impossible to use, please tell us what you were trying to do and what got in the way. We treat accessibility reports as bugs, not as feedback.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p><a class="spcs-textlink" href="/become-an-instructor/#connect"><?php esc_html_e( 'Contact the team', 'spcs' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
