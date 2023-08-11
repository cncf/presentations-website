<?php
/**
 * Upcoming presentation Item
 *
 * Singular upcoming presentation item.
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

// get companies (presented by).
$company = Lf_Utils::get_term_names( get_the_ID(), 'lf-company' );

// registration URL.
$presentation_reg_url           = get_post_meta( get_the_ID(), 'lf_presentation_registration_url', true );

// get presentation date and time.
$presentation_date = get_post_meta( get_the_ID(), 'lf_presentation_date', true );
$presentation_start_time        = get_post_meta( get_the_ID(), 'lf_presentation_start_time', true );
$presentation_start_time_period = get_post_meta( get_the_ID(), 'lf_presentation_start_time_period', true );
$presentation_timezone          = get_post_meta( get_the_ID(), 'lf_presentation_timezone', true );
$dat_presentation_start         = Lf_Utils::get_presentation_date_time( $presentation_date, $presentation_start_time, $presentation_start_time_period, $presentation_timezone, true );
$date_and_time             = $dat_presentation_start->format( 'D F j' );

if ( $presentation_reg_url ) {
	$link_url = $presentation_reg_url;
} else {
	$link_url = get_the_permalink();
}
?>
<article class="presentation-upcoming-item has-animation-scale-2">

		<?php
		// Date of presentation.
		if ( $date_and_time ) :
			?>
		<span class="presentation-upcoming-item__date "><?php echo esc_html( $date_and_time ); ?></span>
		<?php endif; ?>

		<a class="presentation-upcoming-item__link" href="<?php echo esc_url( $link_url ); ?>"
				title="<?php the_title_attribute(); ?> on <?php echo esc_html( $date_and_time ); ?>"><h3 class="presentation-upcoming-item__title"><?php esc_html( the_title() ); ?></h3></a>

		<?php
		// Presented by... Company.
		if ( $company ) :
			?>
		<span class="presentation-upcoming-item__company">Presented by
			<?php echo esc_html( $company ); ?></span>
		<?php endif; ?>

</article>
