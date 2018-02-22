<?php
/* ------------------------------------------------ */
/* Process */
/* ------------------------------------------------ */
vc_map( array(
	"name" => __("Process", 'adforest') ,
	"description" => __("Process", 'adforest') ,
	"base" => "process",
	"category" => __("Theme Shortcodes", 'adforest') ,
	"as_child" => array('only' => 'sticky_sidebar'),
	"content_element" => true,	    
	"params" => array(	
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('process.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),	
	  array
		(
			'group' => __( 'Steps', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Add Step', 'adforest' ),
			'param_name' => 'steps',
			'value' => '',
			'params' => array
			(

				array(
					"type" => "textfield",
					"holder" => "div",
					"heading" => __( "Title", 'adforest' ),
					"param_name" => "title",
				),	
				array(
					"type" => "textarea",
					"holder" => "div",
					"heading" => __( "Description", 'adforest' ),
					"param_name" => "description",
				),
				
				array(
					"type" => "attach_image",
					"holder" => "img",
					"heading" => __( "Background Image", 'adforest' ),
					"param_name" => "img",
					"description" => __( "64X64", 'adforest' ),
				),
			),
		),


    ),
) );