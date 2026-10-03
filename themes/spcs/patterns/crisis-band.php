<?php
/**
 * Title: Crisis support band
 * Slug: spcs/crisis-band
 * Categories: spcs-editorial
 * Description: The 988 support message, standing on its own rather than tucked inside another section.
 * Keywords: 988, crisis, help, support, lifeline
 * Viewport Width: 1400
 *
 * @package SPCS
 */

?>
<!-- wp:group {"metadata":{"name":"Crisis support"},"className":"spcs-section spcs-section--tight","backgroundColor":"purple-wash","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-section--tight has-purple-wash-background-color has-background">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:paragraph {"className":"spcs-crisis-band"} -->
		<p class="spcs-crisis-band">
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

		<!-- wp:paragraph {"className":"spcs-review-note","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
		<p class="spcs-review-note" style="margin-top:var(--wp--preset--spacing--30)"><?php esc_html_e( 'EDITORIAL NOTE — Dr. DeHay: our suggestion for the "get help" info you wanted to discuss. We removed the "Need support right now?" bar from the top of every page, and pulled this 988 message out of the "Become a Certified Instructor" box so it stands on its own here, on the homepage where your content puts it. On every other page, help is one click away in the footer\'s "Get help" column, which now labels the Trevor Project as being for LGBTQ+ young people. Flag if you\'d rather keep a version of the top bar.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
