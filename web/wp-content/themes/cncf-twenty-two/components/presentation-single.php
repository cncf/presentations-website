<?php
/**
 * presentation content - the loop
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

wp_enqueue_style( 'wp-block-embed' );

$presentation_date  = new DateTime( get_post_meta( get_the_ID(), 'lf_presentation_date', true ) );
$tags               = get_the_terms( get_the_ID(), 'lf-presentation-tags' );

// get recording URL.
$recording_url = get_post_meta( get_the_ID(), 'lf_presentation_recording_url', true );

// extract YouTube video ID.
$video_id = Lf_Utils::get_youtube_id_from_url( $recording_url );

// get companies (presented by).
$company = Lf_Utils::get_term_names( get_the_ID(), 'lf-company' );

// get registration URL.
$registration_url = get_post_meta( get_the_ID(), 'lf_presentation_registration_url', true );

// get slides URL.
$slides_url = get_post_meta( get_the_ID(), 'lf_presentation_slides_url', true );

// get presentation views.
$presentation_views = get_post_meta( get_the_ID(), 'lf_presentation_recording_views', true );

$period_status = 'recorded';
?>
<main class="presentation-single">
	<article class="container wrap">
		<?php
		while ( have_posts() ) :
			the_post();
			?>

		<div class="presentation-single__meta-wrapper">


			<div class="presentation-single__date">
					<img width="18" height="14" src="<?php LF_utils::get_svg( 'icon-camera.svg', true ); ?>" alt="Camera Icon" class="presentation-single__svg"> Recorded:
					<?php
					echo esc_html( $presentation_date->format( 'F j, Y' ) );
					?>
			</div>

					<?php
				if ( $presentation_views ) :
					?>
			<div class="presentation-single__views">

			<img width="18" height="14" src="<?php LF_utils::get_svg( 'icon-views.svg', true ); ?>" alt="Views Icon" class="presentation-single__svg">

			Views: <?php echo esc_html( number_format( $presentation_views ) ); ?>
			</div>
			<?php endif; ?>

		</div>

		<div style="height:90px" aria-hidden="true" class="wp-block-spacer is-style-70-90"></div>

			<?php
			// Video.
			if ( $video_id ) :
				?>
		<figure
			class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio">
			<div class="wp-block-lf-youtube-lite">
					<lite-youtube videoid="<?php echo esc_html( $video_id ); ?>"
						videotitle="Video of <?php the_title_attribute(); ?>"
						webpStatus="1" sdthumbStatus="0"
						title="Play <?php the_title_attribute(); ?>">
					</lite-youtube>
				</div>
		</figure>

		<div style="height:80px" aria-hidden="true" class="wp-block-spacer is-style-40-80"></div>

			<?php endif; ?>

				<?php
				// Slides.
				if ( $slides_url ) :
					?>

		<div class="wp-block-buttons">
			<div class="wp-block-button"><a
					href="<?php echo esc_url( $slides_url ); ?>"
					title="Download slides for <?php the_title(); ?> Program"
					class="wp-block-button__link has-black-background-color has-background">Download
					Slides</a></div>
		</div>

		<div style="height:80px" aria-hidden="true" class="wp-block-spacer is-style-40-80">
		</div>
		<?php endif; ?>

		<div class="post-content">

			<?php the_content(); ?>

		</div>

			<?php
endwhile;
		?>
		<div aria-hidden="true" class="wp-block-spacer is-style-40-60">
		</div>

		<ul class="presentation-recorded-item__tags">
			<?php 
			if ( is_array( $tags ) ) {
				foreach( $tags as $tag ) {
					$tag_link = '?_sft_lf-presentation-tags=' . $tag->slug;
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

		<div aria-hidden="true" class="wp-block-spacer is-style-40-60">
		</div>
		<?php
		get_template_part( 'components/social-share' );
		?>
</article>
</main>

<?php
// youtube lite script.
wp_enqueue_script(
	'youtube-lite-js',
	home_url() . '/wp-content/mu-plugins/wp-mu-plugins/lf-blocks/src/youtube-lite/scripts/lite-youtube.js',
	null,
	filemtime( WPMU_PLUGIN_DIR . '/wp-mu-plugins/lf-blocks/dist/blocks.build.js' ),
	true
);
?>
