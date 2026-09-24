<?php
/**
 * Title: Credibility strip — SPRC badge and claim
 * Slug: spcs/credibility-strip
 * Categories: spcs-evidence
 * Description: The badge, the one-sentence distinction, and the funder logos. Place it directly under the hero so the credential lands before anything is asked of the reader.
 * Keywords: badge, sprc, credibility, proof
 * Viewport Width: 1400
 *
 * @package SPCS
 */

$img = esc_url( get_template_directory_uri() . '/assets/img' );
?>
<!-- wp:group {"metadata":{"name":"Credibility strip"},"className":"spcs-section spcs-section--tight has-purple-wash-background-color has-background","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-section--tight has-purple-wash-background-color has-background">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:html -->
		<div class="spcs-credibility spcs-credibility--prominent" data-reveal>
			<picture>
				<source type="image/webp" srcset="<?php echo $img; ?>/sprc-badge-340.webp">
				<img
					class="spcs-credibility__badge"
					src="<?php echo $img; ?>/sprc-badge-340.png"
					width="340"
					height="342"
					loading="lazy"
					decoding="async"
					alt="<?php esc_attr_e( 'Suicide Prevention Resource Center Approved Program — Best Practices Registry', 'spcs' ); ?>"
				>
			</picture>
			<p class="spcs-credibility__claim">
				<?php esc_html_e( 'SPCS is the ONLY Best Practice gatekeeper training specifically designed for college campuses.', 'spcs' ); ?>
			</p>
		</div>
		<!-- /wp:html -->

		<!-- wp:html -->
		<div class="spcs-glad-strip">
			<picture>
				<source type="image/webp" srcset="<?php echo $img; ?>/glad-youre-here-logo-480.webp">
				<img
					src="<?php echo $img; ?>/glad-youre-here-logo-480.png"
					width="72"
					height="72"
					loading="lazy"
					decoding="async"
					alt="<?php esc_attr_e( 'Glad You’re Here', 'spcs' ); ?>"
				>
			</picture>
			<p><?php esc_html_e( 'Wear the message. Shop our “Glad You’re Here” suicide-prevention-awareness gear.', 'spcs' ); ?> <a class="spcs-textlink" href="/store/"><?php esc_html_e( 'Visit the Store', 'spcs' ); ?></a></p>
		</div>
		<!-- /wp:html -->

		<!-- wp:group {"className":"spcs-grid","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"default"}} -->
		<div class="wp-block-group spcs-grid" style="margin-top:var(--wp--preset--spacing--40)">
			<!-- wp:paragraph {"className":"col-1-5 spcs-source"} -->
			<p class="col-1-5 spcs-source">
				<?php
				printf(
					/* translators: %s: link to Clover Educational Consulting Group. */
					esc_html__( 'Developed by experts at %s.', 'spcs' ),
					'<a href="https://clovered.org" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Clover Educational Consulting Group', 'spcs' ) . '</a>'
				);
				?>
			</p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"className":"col-7-6","layout":{"type":"default"}} -->
			<div class="wp-block-group col-7-6">
				<!-- wp:spcs/partners /-->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
