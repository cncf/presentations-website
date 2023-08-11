<?php
/**
 * CPT definitions
 *
 * @link       https://www.cncf.io/
 * @since      1.1.0
 *
 * @package    Lf_Mu
 * @subpackage Lf_Mu/admin/partials
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Projects.
$opts = array(
	'labels'              => array(
		'name'          => __( 'Projects' ),
		'singular_name' => __( 'Project' ),
		'all_items'     => __( 'All Projects' ),
	),
	'public'              => true,
	'has_archive'         => false,
	'show_in_nav_menus'   => false,
	'show_in_rest'        => true,
	'show_ui'             => false,
	'hierarchical'        => false,
	'rewrite'             => array( 'slug' => 'projects' ),
	'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
);
register_post_type( 'lf_project', $opts );

$opts = array(
	'labels'              => array(
		'name'          => __( 'People' ),
		'singular_name' => __( 'Person' ),
		'all_items'     => __( 'All People' ),
	),
	'public'              => false,
	'has_archive'         => false,
	'show_in_nav_menus'   => false,
	'show_in_rest'        => true,
	'hierarchical'        => false,
	'exclude_from_search' => true, // to hide the singular pages on FE.
	'publicly_queryable'  => false, // to hide the singular pages on FE.
	'menu_icon'           => 'dashicons-buddicons-buddypress-logo',
	'rewrite'             => array( 'slug' => 'person' ),
	'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'excerpt' ),
);
register_post_type( 'lf_person', $opts );

$opts = array(
	'labels'            => array(
		'name'          => ucwords( $this->presentation ) . 's',
		'singular_name' => ucwords( $this->presentation ),
		'all_items'     => 'All ' . ucwords( $this->presentation ) . 's',
	),
	'public'            => true,
	'has_archive'       => false,
	'show_in_nav_menus' => false,
	'show_in_rest'      => true,
	'hierarchical'      => false,
	'menu_icon'         => 'dashicons-video-alt3',
	'rewrite'           => array( 'slug' => str_replace( ' ', '-', $this->presentation ) . 's' ),
	'supports'          => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
);
register_post_type( 'lf_presentation', $opts );
