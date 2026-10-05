<?php
/**
 * Title: The three-phase model
 * Slug: spcs/three-phase-model
 * Categories: spcs-program
 * Description: Information, Skills and Practice, staggered so the row reads as a progression rather than three identical cards.
 * Keywords: phases, curriculum, structure, program
 * Viewport Width: 1400
 *
 * @package SPCS
 */

?>
<!-- wp:group {"metadata":{"name":"Three-phase model"},"className":"spcs-section","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:group {"className":"spcs-grid","layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-grid">
			<!-- wp:group {"className":"col-1-7","layout":{"type":"default"}} -->
			<div class="wp-block-group col-1-7">
				<!-- wp:paragraph {"className":"spcs-eyebrow"} -->
				<p class="spcs-eyebrow"><?php esc_html_e( 'What the 90 minutes contains', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'Three phases. Knowledge, then skill, then practice.', 'spcs' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p><?php esc_html_e( 'Knowing what to look for is only the beginning. SPCS moves students through three phases to turn awareness into action.', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"spcs-review-note"} -->
				<p class="spcs-review-note"><?php esc_html_e( 'Note — The small label and “Phase one/two/three” tags are ours. The bullets are your phase text, split into lists.', 'spcs' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:html -->
		<div class="spcs-phases" style="margin-top:var(--wp--preset--spacing--50)">
			<div class="spcs-phase" data-reveal>
				<span class="spcs-phase__number"><?php esc_html_e( 'Phase one', 'spcs' ); ?></span>
				<h3 class="spcs-phase__title"><?php esc_html_e( 'Information Phase', 'spcs' ); ?></h3>
				<ul>
					<li><?php esc_html_e( 'Using safe and respectful language', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'College suicide statistics', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'Common myths and misconceptions', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'Suicide risk factors and warning signs', 'spcs' ); ?></li>
				</ul>
			</div>

			<div class="spcs-phase" data-reveal>
				<span class="spcs-phase__number"><?php esc_html_e( 'Phase two', 'spcs' ); ?></span>
				<h3 class="spcs-phase__title"><?php esc_html_e( 'Skill Building Phase', 'spcs' ); ?></h3>
				<ul>
					<li><?php esc_html_e( 'Conducting a basic suicide risk assessment with peers', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'Using a decision tree to determine the best course of action', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'Connecting peers to support', 'spcs' ); ?></li>
				</ul>
			</div>

			<div class="spcs-phase" data-reveal>
				<span class="spcs-phase__number"><?php esc_html_e( 'Phase three', 'spcs' ); ?></span>
				<h3 class="spcs-phase__title"><?php esc_html_e( 'Practice Phase', 'spcs' ); ?></h3>
				<ul>
					<li><?php esc_html_e( 'Practicing skills through role play', 'spcs' ); ?></li>
					<li><?php esc_html_e( 'Building confidence to use new skills to support peers', 'spcs' ); ?></li>
				</ul>
			</div>
		</div>
		<!-- /wp:html -->

	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
