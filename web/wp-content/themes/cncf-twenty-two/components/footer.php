<?php
/**
 * Footer
 *
 * Use in templates to call wp_footer.
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

$site_options = get_option( 'lf-mu' );
?>

<footer class="footer">

	<div class="container wrap footer_container" id="inner-footer-container">

		<div style="height:70px" aria-hidden="true"
			class="wp-block-spacer is-style-70-100"></div>

		<div class="lf-grid">

			<div class="footer__logo-and-hub">
				<?php
				// Only on desktop.
				if ( isset( $site_options['footer_image_id'] ) && $site_options['footer_image_id'] ) {
					?>

				<a class="footer__logo show-over-1000" href="/"
					title="<?php echo bloginfo( 'name' ); ?>">
					<img src="<?php echo esc_url( wp_get_attachment_url( $site_options['footer_image_id'] ) ); ?>"
						loading="lazy" width="210" height="40"
						alt="<?php echo bloginfo( 'name' ); ?>">
				</a>
					<?php
				}
				?>

				<!-- All CNCF button  -->
				<div class="footer__hub wp-block-buttons">
					<div class="wp-block-button"><a
							href="https://www.cncf.io/all-cncf/"
							class="wp-block-button__link wp-element-button">All
							CNCF Sites</a></div>
				</div>

			</div>

			<?php get_template_part( 'components/social-links' ); ?>

		</div>

		<div style="height:40px" aria-hidden="true" class="wp-block-spacer show-over-1000"></div>

		<div class="horizontal-rule show-over-1000"></div>

		<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>

		<?php get_template_part( 'components/copyright' ); ?>

		<?php
		// This needs to be bigger to allow for cookie banner.
		?>
		<div style="height:90px" aria-hidden="true" class="wp-block-spacer">
		</div>

	</div>
</footer>
<?php
get_template_part( 'components/back-to-top' );
get_footer();
