<?php
/**
 * Navigation and crisis-resource rendering.
 *
 * These are rendered by the theme rather than assembled from blocks because
 * they must be identical on every page and must not be editable into an
 * inaccessible or unsafe state. Their *content* is filterable and the crisis
 * numbers are stored as options, so they remain maintainable without code.
 *
 * @package SPCS
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Primary navigation items.
 *
 * @return array<int, array{label: string, path: string}>
 */
function spcs_nav_items(): array {
	return (array) apply_filters(
		'spcs_nav_items',
		array(
			array(
				'label' => __( 'About SPCS', 'spcs' ),
				'path'  => '/about/',
			),
			array(
				'label' => __( 'Become an Instructor', 'spcs' ),
				'path'  => '/become-an-instructor/',
			),
			array(
				'label' => __( 'Store', 'spcs' ),
				'path'  => '/store/',
			),
			array(
				'label' => __( 'Newsroom', 'spcs' ),
				'path'  => '/newsroom/',
			),
			array(
				'label' => __( 'Instructor Login', 'spcs' ),
				'path'  => '/instructor-login/',
			),
		)
	);
}

/**
 * Render the site header.
 */
function spcs_render_header(): void {
	$items = spcs_nav_items();
	$here  = untrailingslashit( wp_parse_url( home_url( add_query_arg( array() ) ), PHP_URL_PATH ) ?? '' );
	?>
	<a class="spcs-skip-link" href="#main"><?php esc_html_e( 'Skip to main content', 'spcs' ); ?></a>

	<?php spcs_render_crisis_bar(); ?>

	<header class="spcs-header">
		<div class="spcs-header__inner">
			<a class="spcs-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="spcs-logo__word">
					<?php esc_html_e( 'SPCS Gatekeepers', 'spcs' ); ?>
					<span><?php esc_html_e( 'Suicide prevention for college students', 'spcs' ); ?></span>
				</span>
			</a>

			<button
				class="spcs-nav__toggle"
				type="button"
				aria-expanded="false"
				aria-controls="spcs-primary-nav"
			>
				<span class="spcs-nav__bars" aria-hidden="true"></span>
				<?php esc_html_e( 'Menu', 'spcs' ); ?>
			</button>

			<nav
				class="spcs-nav"
				id="spcs-primary-nav"
				aria-label="<?php esc_attr_e( 'Primary', 'spcs' ); ?>"
			>
				<ul class="spcs-nav__list">
					<?php
					/*
					 * The desktop bar relies on the logo to get back home, but the
					 * logo's wordmark truncates on the slide-out mobile nav, so it
					 * needs an explicit way back in — shown only at mobile widths.
					 */
					?>
					<li class="spcs-nav__home-item">
						<a
							class="spcs-nav__link"
							href="<?php echo esc_url( home_url( '/' ) ); ?>"
							<?php echo '' === $here ? 'aria-current="page"' : ''; ?>
						><?php esc_html_e( 'Home', 'spcs' ); ?></a>
					</li>
					<?php foreach ( $items as $item ) : ?>
						<?php $is_current = untrailingslashit( $item['path'] ) === $here; ?>
						<li>
							<a
								class="spcs-nav__link"
								href="<?php echo esc_url( home_url( $item['path'] ) ); ?>"
								<?php echo $is_current ? 'aria-current="page"' : ''; ?>
							><?php echo esc_html( $item['label'] ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>

				<div class="wp-block-button">
					<a
						class="wp-block-button__link wp-element-button"
						href="<?php echo esc_url( home_url( '/become-an-instructor/' ) ); ?>"
					><?php esc_html_e( 'Become an Instructor', 'spcs' ); ?></a>
				</div>
			</nav>
		</div>
	</header>
	<?php
}

/**
 * Render the persistent crisis-resource bar.
 *
 * Appears above the header on every page. Styling is intentionally calm rather
 * than alarm-red: the program's own safe messaging guidance is that help
 * information should be steady and easy to find, not sensationalised.
 */
function spcs_render_crisis_bar(): void {
	$resources = (array) apply_filters(
		'spcs_crisis_resources',
		array(
			array(
				'label' => __( '988 Suicide &amp; Crisis Lifeline', 'spcs' ),
				'text'  => __( 'Call or text 988', 'spcs' ),
				'href'  => 'tel:988',
			),
			array(
				'label' => __( 'Crisis Text Line', 'spcs' ),
				'text'  => __( 'Text HOME to 741741', 'spcs' ),
				'href'  => 'sms:741741',
			),
			array(
				'label' => __( 'The Trevor Project', 'spcs' ),
				'text'  => __( '1-866-488-7386', 'spcs' ),
				'href'  => 'tel:18664887386',
			),
		)
	);
	?>
	<aside class="spcs-crisis" aria-label="<?php esc_attr_e( 'Crisis support resources', 'spcs' ); ?>">
		<div class="spcs-crisis__inner">
			<strong><?php esc_html_e( 'Need support right now?', 'spcs' ); ?></strong>
			<?php foreach ( $resources as $index => $resource ) : ?>
				<?php if ( $index > 0 ) : ?>
					<span class="spcs-crisis__sep" aria-hidden="true">/</span>
				<?php endif; ?>
				<span>
					<a href="<?php echo esc_url( $resource['href'] ); ?>">
						<?php echo esc_html( $resource['text'] ); ?>
					</a>
					<span class="screen-reader-text">
						— <?php echo esc_html( wp_strip_all_tags( $resource['label'] ) ); ?>
					</span>
				</span>
			<?php endforeach; ?>
		</div>
	</aside>
	<?php
}

/**
 * Render the site footer.
 */
function spcs_render_footer(): void {
	?>
	<footer class="spcs-footer is-dark">
		<div class="spcs-footer__inner">
			<div class="spcs-footer__top">
				<div>
					<h2><?php esc_html_e( 'Glad you’re here. Become a Certified Instructor.', 'spcs' ); ?></h2>
					<div class="wp-block-button">
						<a
							class="wp-block-button__link wp-element-button"
							href="<?php echo esc_url( home_url( '/become-an-instructor/' ) ); ?>"
						><?php esc_html_e( 'Become an Instructor', 'spcs' ); ?></a>
					</div>
				</div>

				<div class="spcs-footer__cols">
					<div>
						<h3><?php esc_html_e( 'Program', 'spcs' ); ?></h3>
						<ul>
							<?php foreach ( spcs_nav_items() as $item ) : ?>
								<li>
									<a href="<?php echo esc_url( home_url( $item['path'] ) ); ?>">
										<?php echo esc_html( $item['label'] ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div>
						<h3><?php esc_html_e( 'Organization', 'spcs' ); ?></h3>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'FAQ', 'spcs' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/become-an-instructor/#connect' ) ); ?>"><?php esc_html_e( 'Contact', 'spcs' ); ?></a></li>
						</ul>
					</div>
					<div>
						<h3><?php esc_html_e( 'Get help', 'spcs' ); ?></h3>
						<ul>
							<li><a href="tel:988"><?php esc_html_e( '988 Lifeline — call or text', 'spcs' ); ?></a></li>
							<li><a href="sms:741741"><?php esc_html_e( 'Text HOME to 741741', 'spcs' ); ?></a></li>
							<li><a href="https://988lifeline.org/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( '988lifeline.org', 'spcs' ); ?></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="spcs-footer__bottom">
				<p>
					<?php
					printf(
						/* translators: 1: current year, 2: link to Clover Educational Consulting Group. */
						esc_html__( '© %1$d %2$s. All rights reserved.', 'spcs' ),
						(int) gmdate( 'Y' ),
						'<a href="https://clovered.org" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Clover Educational Consulting Group', 'spcs' ) . '</a>'
					);
					?>
				</p>
				<p>
					<a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>"><?php esc_html_e( 'Privacy', 'spcs' ); ?></a>
					&nbsp;·&nbsp;
					<a href="<?php echo esc_url( home_url( '/accessibility/' ) ); ?>"><?php esc_html_e( 'Accessibility', 'spcs' ); ?></a>
				</p>
			</div>
		</div>
	</footer>
	<?php
}
