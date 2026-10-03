<?php
/**
 * Navigation and footer rendering.
 *
 * These are rendered by the theme rather than assembled from blocks because
 * they must be identical on every page and must not be editable into an
 * inaccessible or unsafe state — the footer carries the crisis resources, so it
 * appears on every page. Nav items are filterable.
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

	<header class="spcs-header">
		<div class="spcs-header__inner">
			<a class="spcs-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="spcs-logo__word">
					<?php esc_html_e( 'SPCS', 'spcs' ); ?>
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
							<li><a href="<?php echo esc_url( home_url( '/become-an-instructor/#connect' ) ); ?>"><?php esc_html_e( 'Contact', 'spcs' ); ?></a></li>
						</ul>
					</div>
					<div>
						<h3><?php esc_html_e( 'Get help', 'spcs' ); ?></h3>
						<ul>
							<li><a href="tel:988"><?php esc_html_e( '988 Lifeline — call or text', 'spcs' ); ?></a></li>
							<li><a href="https://988lifeline.org/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( '988lifeline.org', 'spcs' ); ?></a></li>
							<li><a href="tel:18664887386"><?php esc_html_e( 'The Trevor Project, for LGBTQ+ young people —', 'spcs' ); ?> <span style="white-space:nowrap">1-866-488-7386</span></a></li>
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
			</div>
		</div>
	</footer>
	<?php
}
