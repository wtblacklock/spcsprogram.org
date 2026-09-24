<?php
/**
 * Dynamic blocks that render the structured content.
 *
 * Each is insertable from the editor so a page can pull in the live list of
 * studies, outcomes, testimonials, FAQs or partners without anyone re-typing
 * them into a page.
 *
 * @package SPCS_Core
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fetch published entries of a post type in editorial order.
 *
 * @param string $post_type Post type slug.
 * @param int    $limit     Maximum entries. -1 for all.
 * @return WP_Post[]
 */
function spcs_core_get_entries( string $post_type, int $limit = -1 ): array {
	return get_posts(
		array(
			'post_type'        => $post_type,
			'post_status'      => 'publish',
			'numberposts'      => $limit,
			'orderby'          => array(
				'menu_order' => 'ASC',
				'date'       => 'DESC',
			),
			'suppress_filters' => false,
		)
	);
}

/**
 * Render the citation list.
 *
 * @param array<string, mixed> $attributes Block attributes.
 * @return string
 */
function spcs_core_render_studies( array $attributes ): string {
	$limit   = isset( $attributes['limit'] ) ? (int) $attributes['limit'] : -1;
	$studies = spcs_core_get_entries( 'spcs_study', $limit );

	if ( ! $studies ) {
		return '';
	}

	$out = '<ol class="spcs-citations">';

	foreach ( $studies as $study ) {
		$authors = spcs_core_field( $study->ID, 'spcs_authors' );
		$year    = spcs_core_field( $study->ID, 'spcs_year' );
		$journal = spcs_core_field( $study->ID, 'spcs_journal' );
		$locator = spcs_core_field( $study->ID, 'spcs_locator' );
		$finding = spcs_core_field( $study->ID, 'spcs_finding' );
		$url     = spcs_core_field( $study->ID, 'spcs_url' );

		$out .= '<li class="spcs-citation">';
		$out .= '<p class="spcs-citation__ref">';

		if ( $authors ) {
			$out .= esc_html( $authors ) . ' ';
		}

		if ( $year ) {
			$out .= '(' . esc_html( $year ) . '). ';
		}

		$out .= esc_html( get_the_title( $study ) ) . '. ';

		if ( $journal ) {
			$out .= '<span class="spcs-citation__journal">' . wp_kses_post( $journal ) . '</span>';
			$out .= $locator ? ', ' : '. ';
		}

		if ( $locator ) {
			$out .= esc_html( $locator );
		}

		$out .= '</p>';

		if ( $finding ) {
			$out .= '<p class="spcs-citation__finding">' . esc_html( $finding ) . '</p>';
		}

		if ( $url ) {
			$out .= sprintf(
				'<a class="spcs-citation__link spcs-textlink" href="%s" target="_blank" rel="noopener noreferrer">%s<span class="screen-reader-text"> %s</span></a>',
				esc_url( $url ),
				esc_html__( 'Read the paper', 'spcs-core' ),
				esc_html__( '(opens in a new tab)', 'spcs-core' )
			);
		}

		$out .= '</li>';
	}

	return $out . '</ol>';
}

/**
 * Render the outcomes band.
 *
 * @param array<string, mixed> $attributes Block attributes.
 * @return string
 */
function spcs_core_render_outcomes( array $attributes ): string {
	$limit    = isset( $attributes['limit'] ) ? (int) $attributes['limit'] : 3;
	$outcomes = spcs_core_get_entries( 'spcs_outcome', $limit );

	if ( ! $outcomes ) {
		return '';
	}

	$out = '<div class="spcs-stats">';

	foreach ( $outcomes as $outcome ) {
		$value  = spcs_core_field( $outcome->ID, 'spcs_value' );
		$label  = spcs_core_field( $outcome->ID, 'spcs_label' );
		$source = spcs_core_field( $outcome->ID, 'spcs_source' );

		$out .= '<div class="spcs-stat" data-reveal>';
		$out .= '<div class="spcs-stat__rule"></div>';
		$out .= '<span class="spcs-stat__value" data-count>' . esc_html( $value ) . '</span>';
		$out .= '<span class="spcs-stat__label">' . esc_html( $label ) . '</span>';

		if ( $source ) {
			$out .= '<p class="spcs-source">' . esc_html( $source ) . '</p>';
		}

		$out .= '</div>';
	}

	return $out . '</div>';
}

/**
 * Render testimonials.
 *
 * Only quotes explicitly cleared for public use are output — an un-ticked
 * consent box is treated as "no", never as "not yet decided".
 *
 * @param array<string, mixed> $attributes Block attributes.
 * @return string
 */
function spcs_core_render_testimonials( array $attributes ): string {
	$limit = isset( $attributes['limit'] ) ? (int) $attributes['limit'] : 2;
	$all   = spcs_core_get_entries( 'spcs_testimonial', -1 );

	$cleared = array_values(
		array_filter(
			$all,
			static function ( WP_Post $post ): bool {
				return (bool) get_post_meta( $post->ID, 'spcs_consent', true );
			}
		)
	);

	if ( ! $cleared ) {
		return '';
	}

	$is_carousel = isset( $attributes['layout'] ) && 'carousel' === $attributes['layout'];
	$slides      = array_slice( $cleared, 0, $limit );

	if ( ! $is_carousel ) {
		$out = '<div class="spcs-grid">';

		foreach ( $slides as $index => $testimonial ) {
			$column = 0 === $index % 2 ? 'col-1-5' : 'col-7-5';
			$out   .= spcs_core_render_quote( $testimonial, $column, true );
		}

		return $out . '</div>';
	}

	/*
	 * A continuous leftward marquee, built as one track holding the quote set
	 * twice back to back — a pure CSS animation slides the track exactly one
	 * set-width (-50%) and loops, so the seam between the second copy ending
	 * and the first beginning again is invisible. No JS: the animation pauses
	 * on hover/focus and switches off entirely under reduced motion, both in
	 * CSS, so there is nothing here that can fail to load or run.
	 */
	$out  = '<div class="spcs-quote-marquee">';
	$out .= '<div class="spcs-quote-marquee__track">';

	foreach ( $slides as $testimonial ) {
		$out .= spcs_core_render_quote( $testimonial );
	}

	foreach ( $slides as $testimonial ) {
		$out .= spcs_core_render_quote( $testimonial, '', false, true );
	}

	$out .= '</div>';

	return $out . '</div>';
}

/**
 * Render one testimonial as an editorial pull quote.
 *
 * @param WP_Post $testimonial   The testimonial post.
 * @param string  $column        Optional grid column class.
 * @param bool    $reveal        Whether to gate the figure behind the scroll-reveal animation.
 * @param bool    $duplicate     Whether this is the marquee's repeated second copy — hidden from
 *                                assistive tech so the quotes are not announced twice.
 * @return string
 */
function spcs_core_render_quote( WP_Post $testimonial, string $column = '', bool $reveal = false, bool $duplicate = false ): string {
	$attribution = spcs_core_field( $testimonial->ID, 'spcs_attribution' );
	$campus      = spcs_core_field( $testimonial->ID, 'spcs_campus' );

	$classes = trim( 'spcs-quote ' . $column );

	$out  = '<figure class="' . esc_attr( $classes ) . '"' . ( $reveal ? ' data-reveal' : '' ) . ( $duplicate ? ' aria-hidden="true"' : '' ) . '>';
	$out .= '<blockquote class="spcs-quote__text">';
	$out .= wp_kses_post( wpautop( $testimonial->post_content ) );
	$out .= '</blockquote>';

	if ( $attribution || $campus ) {
		$out .= '<figcaption class="spcs-quote__attribution">';
		$out .= esc_html( trim( $attribution . ( $campus ? ', ' . $campus : '' ), ', ' ) );
		$out .= '</figcaption>';
	}

	return $out . '</figure>';
}

/**
 * Render the FAQ list as an accessible disclosure set.
 *
 * @param array<string, mixed> $attributes Block attributes.
 * @return string
 */
function spcs_core_render_faqs( array $attributes ): string {
	$group = isset( $attributes['group'] ) ? (string) $attributes['group'] : '';
	$faqs  = spcs_core_get_entries( 'spcs_faq', -1 );

	if ( $group ) {
		$faqs = array_filter(
			$faqs,
			static function ( WP_Post $post ) use ( $group ): bool {
				return strtolower( (string) get_post_meta( $post->ID, 'spcs_faq_group', true ) ) === strtolower( $group );
			}
		);
	}

	if ( ! $faqs ) {
		return '';
	}

	$out = '<div class="spcs-faq">';

	foreach ( $faqs as $faq ) {
		$answer_id = 'spcs-faq-answer-' . $faq->ID;

		$out .= '<div class="spcs-faq__item">';
		$out .= sprintf(
			'<button class="spcs-faq__question" type="button" aria-expanded="false" aria-controls="%s">',
			esc_attr( $answer_id )
		);
		$out .= '<span>' . esc_html( get_the_title( $faq ) ) . '</span>';
		$out .= '<span class="spcs-faq__marker" aria-hidden="true"></span>';
		$out .= '</button>';
		$out .= sprintf(
			'<div class="spcs-faq__answer spcs-prose" id="%s" hidden>%s</div>',
			esc_attr( $answer_id ),
			wp_kses_post( wpautop( $faq->post_content ) )
		);
		$out .= '</div>';
	}

	return $out . '</div>';
}

/**
 * Render the partner logo strip.
 *
 * @param array<string, mixed> $attributes Block attributes.
 * @return string
 */
function spcs_core_render_partners( array $attributes ): string {
	$type     = isset( $attributes['type'] ) ? (string) $attributes['type'] : '';
	$partners = spcs_core_get_entries( 'spcs_partner', -1 );

	if ( $type ) {
		$partners = array_filter(
			$partners,
			static function ( WP_Post $post ) use ( $type ): bool {
				return strtolower( (string) get_post_meta( $post->ID, 'spcs_partner_type', true ) ) === strtolower( $type );
			}
		);
	}

	if ( ! $partners ) {
		return '';
	}

	$out = '<ul class="spcs-logos">';

	foreach ( $partners as $partner ) {
		$logo = get_the_post_thumbnail(
			$partner,
			'medium',
			array( 'alt' => get_the_title( $partner ), 'loading' => 'lazy' )
		);

		if ( ! $logo ) {
			continue;
		}

		$url = spcs_core_field( $partner->ID, 'spcs_partner_url' );

		$out .= '<li>';
		$out .= $url
			? sprintf( '<a href="%s" target="_blank" rel="noopener noreferrer">%s</a>', esc_url( $url ), $logo )
			: $logo;
		$out .= '</li>';
	}

	return $out . '</ul>';
}

/**
 * Register the content blocks.
 */
function spcs_core_register_blocks(): void {
	$blocks = array(
		'spcs/studies'      => array(
			'title'      => __( 'Research citations', 'spcs-core' ),
			'callback'   => 'spcs_core_render_studies',
			'attributes' => array( 'limit' => array( 'type' => 'number', 'default' => -1 ) ),
		),
		'spcs/outcomes'     => array(
			'title'      => __( 'Outcome statistics', 'spcs-core' ),
			'callback'   => 'spcs_core_render_outcomes',
			'attributes' => array( 'limit' => array( 'type' => 'number', 'default' => 3 ) ),
		),
		'spcs/testimonials' => array(
			'title'      => __( 'Student voices', 'spcs-core' ),
			'callback'   => 'spcs_core_render_testimonials',
			'attributes' => array(
				'limit'  => array( 'type' => 'number', 'default' => 2 ),
				'layout' => array( 'type' => 'string', 'default' => '' ),
			),
		),
		'spcs/faqs'         => array(
			'title'      => __( 'FAQ list', 'spcs-core' ),
			'callback'   => 'spcs_core_render_faqs',
			'attributes' => array( 'group' => array( 'type' => 'string', 'default' => '' ) ),
		),
		'spcs/partners'     => array(
			'title'      => __( 'Partner logos', 'spcs-core' ),
			'callback'   => 'spcs_core_render_partners',
			'attributes' => array( 'type' => array( 'type' => 'string', 'default' => '' ) ),
		),
	);

	foreach ( $blocks as $name => $config ) {
		register_block_type(
			$name,
			array(
				'api_version'     => 3,
				'title'           => $config['title'],
				'category'        => 'theme',
				'attributes'      => $config['attributes'],
				'render_callback' => static function ( array $attributes ) use ( $config ): string {
					return (string) call_user_func( $config['callback'], $attributes );
				},
				'supports'        => array( 'html' => false ),
			)
		);
	}

}
add_action( 'init', 'spcs_core_register_blocks' );

/**
 * Names and titles of the content blocks, for the editor registration.
 *
 * @return array<string, string>
 */
function spcs_core_block_titles(): array {
	return array(
		'spcs/studies'      => __( 'Research citations', 'spcs-core' ),
		'spcs/outcomes'     => __( 'Outcome statistics', 'spcs-core' ),
		'spcs/testimonials' => __( 'Student voices', 'spcs-core' ),
		'spcs/faqs'         => __( 'FAQ list', 'spcs-core' ),
		'spcs/partners'     => __( 'Partner logos', 'spcs-core' ),
	);
}

/**
 * Register the editor previews for the content blocks.
 */
function spcs_core_editor_assets(): void {
	wp_enqueue_script(
		'spcs-core-blocks',
		plugins_url( 'assets/editor-blocks.js', SPCS_CORE_DIR . '/spcs-core.php' ),
		array( 'wp-blocks', 'wp-element', 'wp-server-side-render', 'wp-i18n', 'wp-components', 'wp-block-editor' ),
		SPCS_CORE_VERSION,
		true
	);

	wp_add_inline_script(
		'spcs-core-blocks',
		'window.spcsContentBlocks = ' . wp_json_encode( spcs_core_block_titles() ) . ';',
		'before'
	);
}
add_action( 'enqueue_block_editor_assets', 'spcs_core_editor_assets' );
