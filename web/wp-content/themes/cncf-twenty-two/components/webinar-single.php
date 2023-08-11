<?php
/**
 * presentation content - the loop
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

wp_enqueue_style( 'wp-block-embed' );

// Get date and time now.
$dat_now = new DateTime( '', new DateTimeZone( 'America/Los_Angeles' ) );

// Get date and time of presentation for comparison.
$presentation_date              = get_post_meta( get_the_ID(), 'lf_presentation_date', true );
$presentation_start_time        = get_post_meta( get_the_ID(), 'lf_presentation_start_time', true );
$presentation_start_time_period = get_post_meta( get_the_ID(), 'lf_presentation_start_time_period', true );
$presentation_end_time          = get_post_meta( get_the_ID(), 'lf_presentation_end_time', true );
$presentation_end_time_period   = get_post_meta( get_the_ID(), 'lf_presentation_end_time_period', true );
$presentation_timezone          = get_post_meta( get_the_ID(), 'lf_presentation_timezone', true );
$dat_presentation_start         = Lf_Utils::get_presentation_date_time( $presentation_date, $presentation_start_time, $presentation_start_time_period, $presentation_timezone );
$dat_presentation_end           = Lf_Utils::get_presentation_date_time( $presentation_date, $presentation_end_time, $presentation_end_time_period, $presentation_timezone );

// Get the timezone this way since we lose case otherwise and the Google cal entry won't work.
$tzlist = DateTimeZone::listIdentifiers( DateTimeZone::ALL );
$tzs    = array();
foreach ( $tzlist as $tz ) {
	$slug         = strtolower( str_replace( '/', '-', $tz ) );
	$tzs[ $slug ] = $tz;
}
$dat_presentation_start_tz = $tzs[ $presentation_timezone ];

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

// date period.
if ( $dat_presentation_end > $dat_now ) {
	$period_status = 'upcoming';
} elseif ( ( $dat_presentation_end < $dat_now ) && ( $recording_url ) ) {
	$period_status = 'recorded';
} else {
	$period_status = 'past';
}

?>
<main class="presentation-single">
	<article class="container wrap">
		<?php
		while ( have_posts() ) :
			the_post();

			if ( 'upcoming' === $period_status ) :
				// Upcoming state added just in case URL is visible.
				?>
		<p>This presentation is upcoming but we don't have the registration URL - it's details may have updated. <a href="https://community.cncf.io/events/#/list">Visit CNCF Community Groups</a> to find out more about it.</p>
				<?php
		else :
			?>

			<?php
			// the company - presented by.
			if ( $company ) :
				?>
		<div class="presentation-single__company">Presented by:
				<?php echo esc_html( $company ); ?></div>

		<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>

		<?php endif; ?>

		<div class="presentation-single__meta-wrapper">

				<?php
				if ( is_a( $dat_presentation_start, 'DateTime' ) ) :
					?>

			<div class="presentation-single__date">
					<?php
					if ( 'recorded' === $period_status ) {
						?>
							<img width="18" height="14" src="<?php LF_utils::get_svg( 'icon-camera.svg', true ); ?>" alt="Camera Icon" class="presentation-single__svg"> Recorded:
						<?php
					} else {
						?>
				Broadcast:
						<?php
					}
					echo esc_html( $dat_presentation_start->format( 'l F j, Y' ) );
					?>
			</div>

					<?php
				endif;
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
		endif;
endwhile;
		?>
		<div style="height:80px"
			aria-hidden="true" class="wp-block-spacer is-style-60-100">
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
