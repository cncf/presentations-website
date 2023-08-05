<?php
/**
 * Header
 *
 * Header section - contains the navigation.
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

get_header();

$site_options = get_option( 'lf-mu' );

if ( isset( $site_options['show_hello_bar'] ) && $site_options['show_hello_bar'] ) :
	get_template_part( 'components/hello-bar' );
endif;
?>

<header class="header">
	<div class="container wrap">

		<?php if ( isset( $site_options['header_image_id'] ) && $site_options['header_image_id'] ) { ?>
		<div class="logo">
			<a href="/" title="<?php echo bloginfo( 'name' ); ?>">
				<img loading="eager"
					src="<?php echo esc_url( wp_get_attachment_url( $site_options['header_image_id'] ) ); ?>"
					width="210" height="40"
					alt="<?php echo bloginfo( 'name' ); ?>">
			</a>
		</div>
		<?php } ?>

		<nav class="main-menu">
			<ul class="main-menu__wrapper">
				<li class="menu-item-no-children">
					<a href="/about/"><span>About</span></a>
				</li>
				<li class="menu-item-no-children">
					<a href="/speakers/"><span>Speakers</span></a>
				</li>
			</ul>

			<div style="height:60px;" aria-hidden="true"
				class="wp-block-spacer show-upto-1000">
			</div>

			<?php if ( isset( $site_options['header_cta_text'] ) && isset( $site_options['header_cta_link'] ) && $site_options['header_cta_text'] && $site_options['header_cta_link'] ) : ?>

			<div class="header-cta">
				<div class="wp-block-button">
					<a href="<?php echo esc_url( get_permalink( $site_options['header_cta_link'] ) ); ?>"
						class="wp-block-button__link wp-element-button"><?php echo esc_html( $site_options['header_cta_text'] ); ?></a>
				</div>
			</div>

			<div style="height:20px" aria-hidden="true"
				class="wp-block-spacer show-upto-1000">
			</div>
			<?php endif; ?>

		</nav>

		<button class="hamburger" type="button" aria-label="Toggle Menu">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>

	</div>
</header>
