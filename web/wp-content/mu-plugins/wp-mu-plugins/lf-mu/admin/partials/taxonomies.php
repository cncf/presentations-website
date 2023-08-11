<?php
/**
 * Taxonomy definitions
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

$labels = array(
	'name'          => __( 'Language', 'lf-mu' ),
	'singular_name' => __( 'Language', 'lf-mu' ),
	'search_items'  => __( 'Search Languages', 'lf-mu' ),
	'all_items'     => __( 'All Languages', 'lf-mu' ),
	'edit_item'     => __( 'Edit Language', 'lf-mu' ),
	'update_item'   => __( 'Update Language', 'lf-mu' ),
	'add_new_item'  => __( 'Add New Language', 'lf-mu' ),
	'new_item_name' => __( 'New Language', 'lf-mu' ),
	'menu_name'     => __( 'Languages', 'lf-mu' ),
);
$args   = array(
	'labels'            => $labels,
	'show_in_rest'      => true,
	'hierarchical'      => false,
	'show_in_nav_menus' => false,
	'show_admin_column' => true,
);
register_taxonomy( 'lf-language', array( 'lf_presentation', 'lf_person' ), $args );

$labels = array(
	'name'          => __( 'Expertise', 'lf-mu' ),
	'singular_name' => __( 'Expertise', 'lf-mu' ),
	'search_items'  => __( 'Search Expertise', 'lf-mu' ),
	'all_items'     => __( 'All Expertise', 'lf-mu' ),
	'edit_item'     => __( 'Edit Expertise', 'lf-mu' ),
	'update_item'   => __( 'Update Expertise', 'lf-mu' ),
	'add_new_item'  => __( 'Add New Expertise', 'lf-mu' ),
	'new_item_name' => __( 'New Expertise', 'lf-mu' ),
	'menu_name'     => __( 'Expertise', 'lf-mu' ),
);
$args   = array(
	'labels'            => $labels,
	'show_in_rest'      => true,
	'hierarchical'      => false,
	'show_in_nav_menus' => false,
	'show_admin_column' => true,
);
register_taxonomy( 'lf-expertise', array( 'lf_person' ), $args );

$labels = array(
	'name'          => __( 'Projects', 'lf-mu' ),
	'singular_name' => __( 'Project', 'lf-mu' ),
	'search_items'  => __( 'Search Projects', 'lf-mu' ),
	'all_items'     => __( 'All Projects', 'lf-mu' ),
	'edit_item'     => __( 'Edit Project', 'lf-mu' ),
	'update_item'   => __( 'Update Project', 'lf-mu' ),
	'add_new_item'  => __( 'Add New Project', 'lf-mu' ),
	'new_item_name' => __( 'New Project Name', 'lf-mu' ),
	'menu_name'     => __( 'Projects', 'lf-mu' ),
);
$args   = array(
	'labels'            => $labels,
	'show_in_rest'      => true,
	'hierarchical'      => false,
	'show_in_nav_menus' => false,
	'show_admin_column' => true,
);
register_taxonomy( 'lf-project', array( 'lf_presentation', 'lf_person' ), $args );

$labels = array(
	'name'          => __( 'Category', 'lf-mu' ),
	'singular_name' => __( 'Category', 'lf-mu' ),
	'search_items'  => __( 'Search Categories', 'lf-mu' ),
	'all_items'     => __( 'All Categories', 'lf-mu' ),
	'edit_item'     => __( 'Edit Category', 'lf-mu' ),
	'update_item'   => __( 'Update Category', 'lf-mu' ),
	'add_new_item'  => __( 'Add New Category', 'lf-mu' ),
	'new_item_name' => __( 'New Category Name', 'lf-mu' ),
	'menu_name'     => __( 'People Categories', 'lf-mu' ),
);
$args   = array(
	'labels'            => $labels,
	'show_in_rest'      => true,
	'hierarchical'      => false,
	'show_in_nav_menus' => false,
	'show_admin_column' => true,
);
register_taxonomy( 'lf-person-category', array( 'lf_person' ), $args );

$labels = array(
	'name'          => __( 'Project Stage', 'lf-mu' ),
	'singular_name' => __( 'Project Stage', 'lf-mu' ),
	'search_items'  => __( 'Search Project Stages', 'lf-mu' ),
	'all_items'     => __( 'All Project Stages', 'lf-mu' ),
	'edit_item'     => __( 'Edit Project Stage', 'lf-mu' ),
	'update_item'   => __( 'Update Project Stage', 'lf-mu' ),
	'add_new_item'  => __( 'Add New Project Stage', 'lf-mu' ),
	'new_item_name' => __( 'New Project Stage', 'lf-mu' ),
	'menu_name'     => __( 'Project Stages', 'lf-mu' ),
);
$args   = array(
	'labels'            => $labels,
	'show_in_rest'      => true,
	'show_admin_column' => true,
	'hierarchical'      => false,
	'show_in_nav_menus' => false,
);
register_taxonomy( 'lf-project-stage', array( 'lf_project' ), $args );

$labels = array(
	'name'              => __( 'Country', 'lf-mu' ),
	'singular_name'     => __( 'Country', 'lf-mu' ),
	'search_items'      => __( 'Search Countries', 'lf-mu' ),
	'all_items'         => __( 'All Countries', 'lf-mu' ),
	'parent_item'       => __( 'Parent Continent', 'lf-mu' ),
	'parent_item_colon' => __( 'Parent Continent:', 'lf-mu' ),
	'edit_item'         => __( 'Edit Country', 'lf-mu' ),
	'update_item'       => __( 'Update Country', 'lf-mu' ),
	'add_new_item'      => __( 'Add New Country', 'lf-mu' ),
	'new_item_name'     => __( 'New Country Name', 'lf-mu' ),
	'menu_name'         => __( 'Countries', 'lf-mu' ),
);
$args   = array(
	'labels'            => $labels,
	'show_in_rest'      => true,
	'hierarchical'      => true,
	'show_in_nav_menus' => false,
	'show_admin_column' => true,
);
register_taxonomy( 'lf-country', array( 'lf_person' ), $args );