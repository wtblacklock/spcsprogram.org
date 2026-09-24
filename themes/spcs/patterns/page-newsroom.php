<?php
/**
 * Title: Page — Newsroom
 * Slug: spcs/page-newsroom
 * Categories: spcs-editorial, pages
 * Block Types: core/post-content
 * Description: Placeholder for the curated research/news feed. No aggregation is built yet — that is a separate project.
 * Keywords: newsroom, news, research updates
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
		<p class="spcs-eyebrow"><?php esc_html_e( 'Newsroom', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"fontSize":"headline"} -->
		<h1 class="wp-block-heading has-headline-font-size"><?php esc_html_e( 'New research and news in college suicide prevention.', 'spcs' ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"spcs-lead"} -->
		<p class="spcs-lead"><?php esc_html_e( 'We are building a moderated feed of new research, reports and news about suicide prevention on college campuses. It will land here soon.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p><a class="spcs-textlink" href="/about/#research"><?php esc_html_e( 'In the meantime, read the published research behind SPCS', 'spcs' ); ?></a></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p><a class="spcs-textlink" href="/become-an-instructor/"><?php esc_html_e( 'Or skip the reading and become an Instructor yourself', 'spcs' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
