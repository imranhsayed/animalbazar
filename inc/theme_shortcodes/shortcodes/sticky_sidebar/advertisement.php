<?php
/* ------------------------------------------------ */
/* advertisement */
/* ------------------------------------------------ */
vc_map( array(
	"name" => __("Advertisement", 'adforest') ,
	"description" => __("Banner Ad 720x90", 'adforest') ,
	"base" => "advertisement",
	"category" => __("Theme Shortcodes", 'adforest') ,
	"as_child" => array('only' => 'sticky_sidebar'),
	"content_element" => true,
	"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('advertisement.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),	
			array(
				"type" => "textarea_raw_html",
				"holder" => "div",
				"heading" => __( "Banner Ad 720x90", 'adforest' ),
				"param_name" => "ad_720",
				"description" => __("Ad size 720 X 90", 'adforest'),
			),	
		),
	) );