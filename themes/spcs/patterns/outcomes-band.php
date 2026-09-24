<?php
/**
 * Title: Outcomes band
 * Slug: spcs/outcomes-band
 * Categories: spcs-evidence
 * Description: A dark plum band carrying the outcome statistics. Numbers are pulled live from Outcomes, so each one keeps its source attached.
 * Keywords: outcomes, statistics, results, proof
 * Viewport Width: 1400
 *
 * @package SPCS
 */

?>
<!-- wp:group {"metadata":{"name":"Outcomes band"},"className":"spcs-section is-dark","backgroundColor":"plum","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section is-dark has-plum-background-color has-background">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:group {"className":"spcs-grid","layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-grid">
			<!-- wp:group {"className":"col-1-6","layout":{"type":"default"}} -->
			<div class="wp-block-group col-1-6">
				<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
				<p class="spcs-eyebrow"><?php esc_html_e( 'What it produces', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'Measured, published, and followed up twelve weeks later.', 'spcs' ); ?></h2>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"default"}} -->
		<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50)">
			<!-- wp:spcs/outcomes {"limit":3} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:paragraph {"className":"spcs-review-note","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
		<p class="spcs-review-note" style="margin-top:var(--wp--preset--spacing--30)"><?php esc_html_e( 'EDITORIAL NOTE — Dr. DeHay: these three stats aren\'t in the site spec, so we need your sign-off before launch. Specifically: is 45% the right figure for the 12-week peer-support follow-up (and is "Ross et al., 2023" the right citation for it — it isn\'t one of the four studies listed below)? Is 900+ students trained across six institutions still accurate today? And can you confirm the three SAMHSA grants funded work specifically in North Carolina, Texas and Minnesota? If any of this is wrong or you\'d rather we pull a stat entirely, just say so.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
		<p style="margin-top:var(--wp--preset--spacing--50)"><a class="spcs-textlink" href="/about/#research"><?php esc_html_e( 'Read the evidence', 'spcs' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
