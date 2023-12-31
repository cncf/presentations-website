<?php
/**
 * Search & Filter Pro
 *
 * Presentations
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

wp_enqueue_style( 'wp-block-separator' );

if ( $query->have_posts() ) : ?>

<p class="search-filter-results-count">
	<?php
	// get total list of presentations.
	$full_count = $wpdb->get_var( "select count(*) from wp_posts where wp_posts.post_type = 'lf_presentation' and wp_posts.post_status = 'publish';" );

	// if filter matches all presentations.
	if ( $full_count == $query->found_posts ) {
		echo 'Found ' . esc_html( $query->found_posts ) . ' presentations';
	} else {
		// else show partial count.
		echo 'Showing ' . esc_html( $query->found_posts ) . ' of ' . esc_html( $full_count ) . ' presentations';
	}
	?>
</p>
<div style="height:40px" aria-hidden="true"
	class="wp-block-spacer is-style-30-40"></div>

<hr
	class="wp-block-separator has-text-color has-background has-gray-500-background-color has-gray-500-color is-style-horizontal-rule">

	<div style="height:50px" aria-hidden="true"
	class="wp-block-spacer is-style-30-50"></div>

<!-- Embeded svg sprite reference -->
<svg display="none" xmlns="http://www.w3.org/2000/svg">
<symbol id="play-button" fill="none" viewBox="0 0 70 71" id=".5155955424562817" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_4409_15889)">
<path d="M35 70.468c19.33 0 35-15.67 35-35s-15.67-35-35-35-35 15.67-35 35 15.67 35 35 35z" fill="#D62293"/>
<path d="M26.676 51.298V18.964a2.682 2.682 0 0 1 4.394-2.06l19.367 16.177a2.686 2.686 0 0 1 0 4.115L31.07 53.362a2.676 2.676 0 0 1-4.394-2.064z" fill="#fff"/>
</g>
</symbol>
</svg>

<div class="presentations columns-three">

	<?php
	while ( $query->have_posts() ) :
		$query->the_post();

			get_template_part( 'components/presentation-item' );

	endwhile;
	?>
</div>
	<?php
endif;
