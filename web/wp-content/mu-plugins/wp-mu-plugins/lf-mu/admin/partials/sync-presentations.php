<?php
/**
 * Sync Presentations
 *
 * Sync presentations from web/wp-content/mu-plugins/wp-mu-plugins/lf-mu/admin/partials/sync-programs.php .
 *
 * @link       https://www.cncf.io/
 * @since      1.2.0
 *
 * @package    Lf_Mu
 * @subpackage Lf_Mu/admin/partials
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// If a yaml parser is not available, return.
// It doesn't seem to get installed on lando instances by default.
if ( ! function_exists( 'yaml_parse' ) ) {
	return;
}

$presentations_url = 'https://raw.githubusercontent.com/cncf/presentations/master/presentations.yaml';
$args = array(
	'timeout'   => 100,
	'sslverify' => false,
);

$data = wp_remote_get( $presentations_url, $args );
if ( is_wp_error( $data ) || ( wp_remote_retrieve_response_code( $data ) != 200 ) ) {
	return;
}

$remote_body = yaml_parse( wp_remote_retrieve_body( $data ) );

foreach ( $remote_body as $pres ) {
	$lf_presentation_slides_url = $pres['slides'];

	if ( $lf_presentation_slides_url ) {
		preg_match( '/id=(\d*)&/', $lf_presentation_slides_url, $matches );
		if ( array_key_exists( 1, $matches ) ) {
			$lf_presentation_slides_url = 'https://www.slideshare.net/slideshow/embed_code/' . $matches[1];
		}
	}

	$params = array(
		'post_title' => $pres['name'],
		'post_type' => 'lf_presentation',
		'post_status' => 'publish',
		'post_content' => $pres['description'],
		'meta_input' => array(
			'lf_presentation_date' => $pres['date'],
			'lf_presentation_recording_url' => $pres['video'],
			'lf_presentation_slides_url' => $lf_presentation_slides_url,
			'lf_presentation_license' =>$pres['license'],
		),
	);

	$query = new WP_Query(
		array(
			'post_type' => 'lf_presentation',
			'meta_value' => $pres['slides'],
			'no_found_rows' => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'fields' => 'ids',
			'posts_per_page' => 1,
		)
	);
	if ( $query->have_posts() ) {
		$query->the_post();
		$params['ID'] = get_the_ID(); // post to update.
	}

	$newid = wp_insert_post( $params ); // will insert or update the post as needed.

	if ( $newid ) {
		wp_set_object_terms( $newid, strtolower( $pres['language'] ), 'lf-language' );

		if ( is_array( $pres['presenters'] ) ) {
			$p = Array();
			foreach( $pres['presenters'] as $presenter ) {
				$term = term_exists( $presenter['github'], 'lf-presenter' );
				if ( ! $term ) {
					$args = Array(
						'slug' => $presenter['github']
					);
					$term = wp_insert_term( $presenter['name'], 'lf-presenter', $args );
				}
				$p[] = $term['term_id'];
			}
			wp_set_post_terms( $newid, $p, 'lf-presenter' );
		}
	}
}
