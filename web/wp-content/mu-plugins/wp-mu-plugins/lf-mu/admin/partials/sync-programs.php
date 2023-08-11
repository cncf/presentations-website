<?php
/**
 * Sync Programs
 *
 * Sync programs from https://community.cncf.io/ and https://www.cncf.io/online-programs/.
 * Do this to get it to run locally: https://github.com/lando/lando/issues/866#issuecomment-395219617
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

$chapters = array(
	'https://community.cncf.io/api/chapter/258/event/', // https://community.cncf.io/cncf-online-programs/ .
	'https://community.cncf.io/api/chapter/296/event/', // https://community.cncf.io/end-user-community/ .
);

foreach ( $chapters as $chapter ) {
	$data = wp_remote_get( $chapter );
	if ( is_wp_error( $data ) || ( wp_remote_retrieve_response_code( $data ) != 200 ) ) {
		return;
	}

	$remote_body = json_decode( wp_remote_retrieve_body( $data ) );
	foreach ( $remote_body->results as $program ) {
		if ( 'Published' === $program->status ) {
			// add/update CPT.

			$dt_end = strtotime( $program->end_date );

			if ( $dt_end > time() + DAY_IN_SECONDS ) {
				// avoid updating programs that ended more than 2 weeks ago to limit computation.
				// don't import programs that haven't ended yet.
				continue;
			}

			$post_content = '';
			$lf_presentation_recording_url = '';
			$lf_presentation_slides_url = '';

			// grab program details for recorded view.
			$details_data = wp_remote_get( 'https://community.cncf.io/api/event/' . $program->id );
			if ( is_wp_error( $details_data ) || ( wp_remote_retrieve_response_code( $details_data ) != 200 ) ) {
				continue;
			}

			$details = json_decode( wp_remote_retrieve_body( $details_data ) );
			$post_content = strip_tags( $details->description );
			$lf_presentation_recording_url = $details->video_url;

			if ( ! $lf_presentation_recording_url ) {
				// if there is no recording url then skip import.
				continue;
			}

			if ( $details->slideshare_url ) {
				preg_match( '/id=(\d*)&/', $details->slideshare_url, $matches );
				if ( array_key_exists( 1, $matches ) ) {
					$lf_presentation_slides_url = 'https://www.slideshare.net/slideshow/embed_code/' . $matches[1];
				}
			}

			$params = array(
				'post_title' => $program->title,
				'post_type' => 'lf_presentation',
				'post_status' => 'publish',
				'post_content' => $post_content,
				'meta_input' => array(
					'lf_presentation_date' => substr( $program->start_date, 0, 10 ),
					'lf_presentation_registration_url' => $program->url,
					'lf_presentation_recording_url' => $lf_presentation_recording_url,
					'lf_presentation_slides_url' => $lf_presentation_slides_url,
					'lf_presentation_timezone' => 'america-los_angeles',
				),
			);

			$query = new WP_Query(
				array(
					'post_type' => 'lf_presentation',
					'meta_value' => $program->url,
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

			if ( $newid && 'https://community.cncf.io/api/chapter/296/event/' === $chapter ) {
				wp_set_object_terms( $newid, 'end-user', 'lf-topic', true );
			}
		}
	}
}
