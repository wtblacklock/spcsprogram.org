<?php
/**
 * Title: Student voices
 * Slug: spcs/voices
 * Categories: spcs-editorial
 * Description: A horizontally scrolling carousel of quotes from students who completed the training. Only quotes marked as cleared for public use are shown.
 * Keywords: quotes, testimonials, voices, students, carousel
 * Viewport Width: 1400
 *
 * @package SPCS
 */

?>
<!-- wp:group {"metadata":{"name":"Student voices"},"className":"spcs-section","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
		<p class="spcs-eyebrow"><?php esc_html_e( 'What students are saying', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'From students who completed it.', 'spcs' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:spcs/testimonials {"limit":8,"layout":"carousel"} /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
