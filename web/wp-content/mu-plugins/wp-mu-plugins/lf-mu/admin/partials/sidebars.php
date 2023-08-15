<?php
/**
 * Sidebar definitions
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

// First we define the sidebar with it's tabs, panels and settings.
$palette = array(
	'dark-fuschia'     => '#6e1042',
	'dark-violet'      => '#411E4F',
	'dark-indigo'      => '#1A267D',
	'dark-blue'        => '#17405c',
	'dark-aqua'        => '#0e5953',
	'dark-green'       => '#0b5329',

	'light-fuschia'    => '#AD1457',
	'light-violet'     => '#6C3483',
	'light-indigo'     => '#4653B0',
	'light-blue'       => '#2874A6',
	'light-aqua'       => '#148f85',
	'light-green'      => '#117a3d',

	'dark-chartreuse'  => '#3d5e0f',
	'dark-yellow'      => '#878700',
	'dark-gold'        => '#8c7000',
	'dark-orange'      => '#784e12',
	'dark-umber'       => '#6E2C00',
	'dark-red'         => '#641E16',

	'light-chartreuse' => '#699b23',
	'light-yellow'     => '#b0b000',
	'light-gold'       => '#c29b00',
	'light-orange'     => '#c2770e',
	'light-umber'      => '#b8510d',
	'light-red'        => '#922B21',
);

$tzlist = DateTimeZone::listIdentifiers( DateTimeZone::ALL );
$tzs    = array();
foreach ( $tzlist as $tz ) {
	$slug         = str_replace( '/', '-', $tz );
	$tzs[ $slug ] = $tz;
}

$sidebar    = array(
	'id'              => 'lf-sidebar-presentation',
	'id_prefix'       => 'lf_',
	'label'           => ucwords( $this->presentation ) . ' Settings',
	'post_type'       => 'lf_presentation',
	'data_key_prefix' => 'lf_presentation_',
	'icon_dashicon'   => 'admin-settings',
	'tabs'            => array(
		array(
			'label'  => __( 'Tab label' ),
			'panels' => array(
				array(
					'label'        => __( 'General' ),
					'initial_open' => true,
					'settings'     => array(
						array(
							'type'              => 'text',
							'data_type'         => 'meta',
							'data_key'          => 'date',
							'label'             => __( 'Date' ),
							'register_meta'     => true,
							'ui_border_top'     => true,
							'default_value'     => '',
							'placeholder'       => 'YYYY/MM/DD',
						),
						array(
							'type'          => 'text',
							'data_type'     => 'meta',
							'data_key'      => 'recording_url',
							'label'         => __( 'Recording URL' ),
							'register_meta' => true,
							'ui_border_top' => true,
							'default_value' => '',
							'placeholder'   => 'https://www.youtube.com/watch?v=95pkfWf8DgA',
							'help'          => 'Leave blank if there is no recording',
						),
						array(
							'type'          => 'text',
							'data_type'     => 'meta',
							'data_key'      => 'slides_url',
							'label'         => __( 'Slides URL' ),
							'register_meta' => true,
							'ui_border_top' => true,
							'default_value' => '',
							'placeholder'   => 'https://www.cncf.io/wp-content/uploads/2019/11/StackRox-presentation-2019-11-12.pdf',
						),
						array(
							'type'          => 'text',
							'data_type'     => 'meta',
							'data_key'      => 'event_name',
							'label'         => __( 'Event Name' ),
							'register_meta' => true,
							'ui_border_top' => true,
							'default_value' => '',
						),
						array(
							'type'          => 'text',
							'data_type'     => 'meta',
							'data_key'      => 'event_url',
							'label'         => __( 'Event URL' ),
							'register_meta' => true,
							'ui_border_top' => true,
							'default_value' => '',
						),
						array(
							'type'          => 'text',
							'data_type'     => 'meta',
							'data_key'      => 'license',
							'label'         => __( 'License' ),
							'register_meta' => true,
							'ui_border_top' => true,
							'default_value' => '',
						),
					),
				),
			),
		),
	),
);
$sidebars[] = $sidebar;
