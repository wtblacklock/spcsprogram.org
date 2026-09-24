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

		<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
		<p style="margin-top:var(--wp--preset--spacing--50)"><a class="spcs-textlink" href="/about/#research"><?php esc_html_e( 'Read the evidence', 'spcs' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
