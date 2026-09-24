<?php
/**
 * Title: Page — Instructor Login
 * Slug: spcs/page-instructor-login
 * Categories: spcs-editorial, pages
 * Block Types: core/post-content
 * Description: Sends Certified Instructors to the real, live login at clovered.org — that account system already exists there, this site does not duplicate it.
 * Keywords: instructor, login, portal
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
		<p class="spcs-eyebrow"><?php esc_html_e( 'Instructor Login', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"fontSize":"headline"} -->
		<h1 class="wp-block-heading has-headline-font-size"><?php esc_html_e( 'Sign in at the Certified Instructor Portal.', 'spcs' ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"spcs-lead"} -->
		<p class="spcs-lead"><?php esc_html_e( 'Certified Instructors sign in through Clover Educational Consulting Group for the manual, slides, handouts, QR codes and their training outcomes report.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button">
				<a class="wp-block-button__link wp-element-button" href="https://clovered.org/spcs-certified-instructor-portal/" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Go to the Instructor Portal', 'spcs' ); ?>
					<span class="screen-reader-text"> (<?php esc_html_e( 'opens in a new tab', 'spcs' ); ?>)</span>
				</a>
			</div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

		<!-- wp:paragraph -->
		<p><a class="spcs-textlink" href="/become-an-instructor/"><?php esc_html_e( 'Not certified yet? Become an Instructor', 'spcs' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
