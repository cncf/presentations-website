<?php
/**
 * Upcoming presentations
 *
 * Usage:
 * [upcoming_presentations count=6]
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

/**
 * Upcoming presentations shortcode.
 *
 * @param array $atts Attributes.
 */
function add_upcoming_presentations_shortcode( $atts ) {
	// Attributes.
	$atts = shortcode_atts(
		array(
			'count' => '6', // set default.
		),
		$atts,
		'upcoming_presentations'
	);

	// make sure we have a number.
	$count = intval( $atts['count'] );

	// if no number, something wrong.
	if ( ! is_int( $count ) ) {
		return;
	}

	// setup the arguments.
	$args  = array(
		'posts_per_page' => $count,
		'post_type'      => array( 'lf_presentation' ),
		'post_status'    => array( 'publish' ),
		'meta_key'       => 'lf_presentation_date',
		'order'          => 'ASC',
		'meta_type'      => 'DATETIME',
		'orderby'        => 'meta_value',
		'no_found_rows'  => true,
		'meta_query'     => array(
			array(
				'key'     => 'lf_presentation_date',
				'value'   => date_i18n( 'Y-m-d' ),
				'compare' => '>=',
				'type'    => 'DATETIME',
			),
			array(
				'key'     => 'lf_presentation_recording',
				'compare' => 'NOT EXISTS',
			),
		),
	);
	$query = new WP_Query( $args );

	ob_start();

	if ( $query->have_posts() ) {
		?>
<div class="presentations columns-three">
		<?php
		while ( $query->have_posts() ) :
			$query->the_post();

			get_template_part( 'components/presentation-upcoming-item' );

		endwhile;
		wp_reset_postdata();
		?>
</div>

		<?php
	} else {
		?>

		<div class="presentations columns-one">
			<h3>Sorry, there are no online programs scheduled right now.</h3>

			<div style="height:40px" aria-hidden="true"
					class="wp-block-spacer"></div>

			<p>But new online programs will be scehduled soon. <a href="#newsletter" title="Sign up for newsletter">Sign up for our newsletter to get the latest updated.</p>
		</div>

		<?php
	}
	$block_content = ob_get_clean();
	return $block_content;
}
add_shortcode( 'upcoming_presentations', 'add_upcoming_presentations_shortcode' );
