<?php
/**
 * Recorded presentation Item
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

// get presentation date.
$presentation_date = new DateTime( get_post_meta( get_the_ID(), 'lf_presentation_date', true ) );

// get recording URL (for video thumb).
$recording_url = get_post_meta( get_the_ID(), 'lf_presentation_recording_url', true );

// extract YouTube video ID.
$video_id = Lf_Utils::get_youtube_id_from_url( $recording_url );

// get views.
$presentation_views        = get_post_meta( get_the_ID(), 'lf_presentation_recording_views', true );

// get companies (presented by).
$company = Lf_Utils::get_term_names( get_the_ID(), 'lf-company' );
?>

<div class="presentation-recorded-item has-animation-scale-2">

	<figure class="presentation-recorded-item__figure">
		<a href="<?php the_permalink(); ?>"  class="presentation-recorded-item__figure-link">

		<?php
		if ( $video_id ) {
			// Applying loading lazy to this YouTueb image stops it appearing.
			?>
			<img width="325" height="245" loading="lazy" src="https://img.youtube.com/vi/<?php echo esc_html( $video_id ); ?>/hqdefault.jpg"
				alt="<?php the_title_attribute(); ?>" class="presentation-recorded-item__image">

<svg class="presentation-recorded-item__overlay" width="70" height="71">
 <use xlink:href="#play-button" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
</svg>

			<?php
		} else {
			// setup options.
			$site_options = get_option( 'lf-mu' );
			Lf_Utils::display_responsive_images( $site_options['generic_thumb_id'], 'full', '400px', 'presentation-recorded-item__image', 'lazy', get_the_title() );
		}
		?>
		</a>
	</figure>

	<div class="presentation-recorded-item__text-wrapper">

	<h3 class="presentation-recorded-item__title"><a  class="presentation-recorded-item__link"
			href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<?php
		if ( $company ) :
			?>
	<span class="presentation-recorded-item__presented">Presented by:
			<?php echo esc_html( $company ); ?></span>
			<?php
			endif;
		?>

<div class="presentation-recorded-item__date-views-wrapper">
		<?php
		if ( $presentation_date ) :
			?>
	<span class="presentation-recorded-item__date">
			<?php
			echo esc_html( $presentation_date->format( 'F j, Y' ) );
			?>
</span>
<?php endif; ?>

<?php if ( $presentation_views ) : ?>
	<span class="presentation-recorded-item__views">
		<?php
		echo esc_html( number_format( $presentation_views ) ) . ' views';
		?>
		</span>
			<?php
			endif;
?>
</div>
</div>
</div>
