<?php
defined( 'ABSPATH' ) or die();

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_demonszone-album-metadata-fields',
		'title' => 'DemonsZone Album Metadata Fields',
		'fields' => array (
			array (
				'key' => 'field_53413be4e41e0',
				'label' => 'Tracklisting',
				'name' => 'tracklisting',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_53413c0fe41e1',
						'label' => 'Song Name',
						'name' => 'song_name',
						'type' => 'text',
						'required' => 1,
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_549e96f3a2f56',
				'label' => 'Previous Album',
				'name' => 'previous_album',
				'type' => 'relationship',
				'instructions' => 'The previous album in the band\'s studio album discography.',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'albums',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'featured_image',
					1 => 'post_type',
					2 => 'post_title',
				),
				'max' => 1,
			),
			array (
				'key' => 'field_549e9706a2f57',
				'label' => 'Next Album',
				'name' => 'next_album',
				'type' => 'relationship',
				'instructions' => 'The next album in the band\'s studio album discography (if there is one).',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'albums',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'featured_image',
					1 => 'post_type',
					2 => 'post_title',
				),
				'max' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'albums',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_demonszone-albums-fields',
		'title' => 'DemonsZone Albums Fields',
		'fields' => array (
			array (
				'key' => 'field_533fb43d8f055',
				'label' => 'Release Date',
				'name' => 'release_date',
				'type' => 'date_picker',
				'required' => 1,
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_533fbe37b91f0',
				'label' => 'Rating',
				'name' => 'rating',
				'type' => 'number',
				'instructions' => 'Out of 10',
				'required' => 1,
				'default_value' => '',
				'placeholder' => 5,
				'prepend' => '',
				'append' => '/ 10',
				'min' => 1,
				'max' => 10,
				'step' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'albums',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
		'label_placement' => 'left',
	));
}
