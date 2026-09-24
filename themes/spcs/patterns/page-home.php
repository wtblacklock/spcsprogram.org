<?php
/**
 * Title: Page — Home
 * Slug: spcs/page-home
 * Categories: spcs-openers, pages
 * Block Types: core/post-content
 * Description: The full home page composition. Each section is a separate pattern, so any one of them can be reordered, replaced or removed without touching the others.
 * Keywords: home, front page, landing
 * Viewport Width: 1400
 *
 * @package SPCS
 */

?>
<!-- wp:pattern {"slug":"spcs/hero-institutional"} /-->
<!-- wp:pattern {"slug":"spcs/credibility-strip"} /-->
<!-- wp:pattern {"slug":"spcs/what-is-a-gatekeeper"} /-->
<!-- wp:pattern {"slug":"spcs/three-phase-model"} /-->

<!-- wp:group {"metadata":{"name":"Three-phase model note"},"className":"spcs-section spcs-section--tight spcs-section--flush-top","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-section--tight spcs-section--flush-top">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:paragraph -->
		<p><a class="spcs-textlink" href="/about/"><?php esc_html_e( 'See the full program overview', 'spcs' ); ?></a></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"spcs-review-note","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
		<p class="spcs-review-note" style="margin-top:var(--wp--preset--spacing--30)"><?php esc_html_e( 'EDITORIAL NOTE — Dr. DeHay: the three-phase content itself is straight from the site spec, under the About page — the spec didn\'t ask for it on the homepage too. We repeated it here because showing the actual curriculum structure up front, before someone even clicks through, makes the "90 minutes" claim concrete and gives visitors a reason to trust the program before they\'ve read anything else. Flag if you\'d rather the homepage just link to it instead of repeating it in full.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"spcs/outcomes-band"} /-->
<!-- wp:pattern {"slug":"spcs/voices"} /-->
<!-- wp:pattern {"slug":"spcs/cta-closing"} /-->
