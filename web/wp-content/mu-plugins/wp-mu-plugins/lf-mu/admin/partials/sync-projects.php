<?php
/**
 * Sync Projects from Landscape
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

$projects_url = 'https://landscape.cncf.io/api/items?project=hosted';
$items_url    = 'https://landscape.cncf.io/data/items.json';
$logos_url    = 'https://landscape.cncf.io/';

$args = array(
	'timeout'   => 100,
	'sslverify' => false,
);

$data = wp_remote_get( $projects_url, $args );
if ( is_wp_error( $data ) || ( wp_remote_retrieve_response_code( $data ) != 200 ) ) {
	return;
}
$projects = json_decode( wp_remote_retrieve_body( $data ) );

$data = wp_remote_get( $items_url, $args );
if ( is_wp_error( $data ) || ( wp_remote_retrieve_response_code( $data ) != 200 ) ) {
	return;
}
$items     = json_decode( wp_remote_retrieve_body( $data ) );
$id_column = array_column( $items, 'id' );

foreach ( $projects as $level ) {
	foreach ( $level->items as $project ) {
		$key = array_search( $project->id, $id_column );
		if ( false === $key ) {
			continue;
		}

		$p = $items[ $key ];

		// adds term to taxonomy if it doesn't exist.
		if ( ! term_exists( $p->name, 'lf-project' ) ) {
			wp_insert_term( $p->name, 'lf-project' );
		}
	}
}
