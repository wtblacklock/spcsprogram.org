<?php
/**
 * Title: Store aside
 * Slug: spcs/store-aside
 * Categories: spcs-editorial
 * Description: A small, low-key pointer to the Glad You’re Here store.
 * Keywords: store, swag, glad you're here
 * Viewport Width: 1400
 *
 * @package SPCS
 */

$img = esc_url( get_template_directory_uri() . '/assets/img' );
?>
<!-- wp:group {"metadata":{"name":"Store aside"},"className":"spcs-section spcs-aside","backgroundColor":"purple-wash","layout":{"type":"default"}} -->
<div class="wp-block-group spcs-section spcs-aside has-purple-wash-background-color has-background">
	<!-- wp:group {"className":"spcs-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group spcs-shell">
		<!-- wp:html -->
		<div class="spcs-store-card" data-reveal="left">
			<picture>
				<source type="image/webp" srcset="<?php echo $img; ?>/glad-youre-here-logo-480.webp">
				<img
					src="<?php echo $img; ?>/glad-youre-here-logo-480.png"
					width="160"
					height="160"
					loading="lazy"
					decoding="async"
					alt=""
				>
			</picture>
			<div>
				<p class="spcs-store-card__title"><?php esc_html_e( 'Wear the message.', 'spcs' ); ?></p>
				<p><?php esc_html_e( 'Shop our “Glad You’re Here” suicide-prevention-awareness gear.', 'spcs' ); ?></p>
				<p><a class="spcs-textlink" href="/store/"><?php esc_html_e( 'Visit the Store', 'spcs' ); ?></a></p>
			</div>
		</div>
		<!-- /wp:html -->

		<!-- wp:paragraph {"className":"spcs-review-note"} -->
		<p class="spcs-review-note"><?php esc_html_e( 'Note — Moved this out of the badge box into its own card. The wording is ours.', 'spcs' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
