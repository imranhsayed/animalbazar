<?php
/* ------------------------------------------------ */
/* Ads */
/* ------------------------------------------------ */
vc_map( array(
	"name" => __("Ads", 'adforest') ,
	"description" => __("Featured or Simple Ads", 'adforest') ,
	"base" => "adforest_ads",
	"category" => __("Theme Shortcodes", 'adforest') ,
	"as_child" => array('only' => 'sticky_sidebar'),
	"content_element" => true,
	"params" => array(
	
		array(
		"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"heading" => __( "Title", 'adforest' ),
			"param_name" => "s_title",
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "dropdown",
			"heading" => __("Ads Type", 'adforest') ,
			"param_name" => "ad_type",
			"admin_label" => true,
			"value" => array(
			__('Select Ads Type', 'adforest') => '',
			__('Featured Ads', 'adforest') => 'feature',
			__('Simple Ads', 'adforest') => 'regular'
			) ,
		),
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "dropdown",
			"heading" => __("Layout Type", 'adforest') ,
			"param_name" => "layout_type",
			"admin_label" => true,
			"value" => array(
			__('Select Layout Type', 'adforest') => '',
			__('Slider (Use once on a page.)', 'adforest') => 'slider',
			__('Grid 1', 'adforest') => 'grid_1',
			__('Grid 2', 'adforest') => 'grid_2',
			__('Grid 3', 'adforest') => 'grid_3',
			__('List 1', 'adforest') => 'list_1',
			__('List 2', 'adforest') => 'list_2',
			__('List 3', 'adforest') => 'list_3',
			) ,
		),
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "dropdown",
			"heading" => __("Number fo Ads", 'adforest') ,
			"param_name" => "no_of_ads",
			"admin_label" => true,
			"value" => range( 1, 50 ),
		),
		//Group For Left Section
		array
		(
			'group' => __( 'Categories', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Select Category', 'adforest' ),
			'param_name' => 'cats',
			'value' => '',
			'params' => array
			(
				array(
					"type" => "dropdown",
					"heading" => __("Category", 'adforest') ,
					"param_name" => "cat",
					"admin_label" => true,
					"value" => adforest_cats(),
				),
			)
		),
		),
	) );