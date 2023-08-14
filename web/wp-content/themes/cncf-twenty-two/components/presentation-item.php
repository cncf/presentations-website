<?php
/**
 * Recorded presentation Item
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

$presentation_date  = new DateTime( get_post_meta( get_the_ID(), 'lf_presentation_date', true ) );
$recording_url      = get_post_meta( get_the_ID(), 'lf_presentation_recording_url', true );
$video_id           = Lf_Utils::get_youtube_id_from_url( $recording_url );
$presentation_views = get_post_meta( get_the_ID(), 'lf_presentation_recording_views', true );
$tags               = get_the_terms( get_the_ID(), 'lf-presentation-tag' );
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

	<ul class="presentation-recorded-item__tags">
	<?php 
	if ( is_array( $tags ) ) {
		foreach( $tags as $tag ) {
			$tag_link = '?_sft_lf-presentation-tag=' . $tag->slug;
			?>
			<li>
			<a 	class="tag"
				title="See <?php echo esc_attr( $tag->name ); ?> presentations"
				href="<?php echo esc_url( $tag_link ); ?>">
				<?php echo esc_html( $tag->name ); ?></a>
			</li>
			<?php
		}
	}
	?>
	</ul>
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
