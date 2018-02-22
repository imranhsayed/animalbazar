<?php
/* ------------------------------------------------ */
/* Ads */
/* ------------------------------------------------ */
if ( !function_exists ( 'ads_short' ) ) {
function ads_short()
{
	$grid_array;
	if( Redux::getOption('adforest_theme', 'design_type') == 'modern' )
	{
		$grid_array = array(
			__('Select Layout Type', 'adforest') => '',
			__('Grid 1', 'adforest') => 'grid_1',
			__('Grid 2', 'adforest') => 'grid_2',
			__('Grid 3', 'adforest') => 'grid_3',
			__('Grid 4', 'adforest') => 'grid_4',
			__('Grid 5', 'adforest') => 'grid_5',
			__('List', 'adforest') => 'list',
			);
	}
	else
	{
		$grid_array = array(
			__('Select Layout Type', 'adforest') => '',
			__('Grid 1', 'adforest') => 'grid_1',
			__('Grid 2', 'adforest') => 'grid_2',
			__('Grid 3', 'adforest') => 'grid_3',
			__('List', 'adforest') => 'list',
			);
	}
	vc_map(array(
		"name" => __("ADs", 'adforest') ,
		"base" => "ads_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
			"group" => __("Basic", "adforest"),
			"type" => "dropdown",
			"heading" => __("Background Color", 'adforest') ,
			"param_name" => "section_bg",
			"admin_label" => true,
			"value" => array(
				__('Select Background Color', 'adforest') => '',
				__('White', 'adforest') => '',
				__('Gray', 'adforest') => 'gray',
				__('Image', 'adforest') => 'img'
			) ,
			'edit_field_class' => 'vc_col-sm-12 vc_column',
			"std" => '',
			"description" => __("Select background color.", 'adforest'),
		),
		
		array(
			"group" => __("Basic", "adforest"),
			"type" => "attach_image",
			"holder" => "bg_img",
			"class" => "",
			"heading" => __( "Background Image", 'adforest' ),
			"param_name" => "bg_img",
			'dependency' => array(
			'element' => 'section_bg',
			'value' => array('img'),
			) ,
		),
		
			array(
				"group" => __("Basic", "'adforest"),
				"type" => "dropdown",
				"heading" => __("Header Style", 'adforest') ,
				"param_name" => "header_style",
				"admin_label" => true,
				"value" => array(
				__('Section Header Style', 'adforest') => '',
				__('No Header', 'adforest') => '',
				__('Classic', 'adforest') => 'classic',
				__('Regular', 'adforest') => 'regular'
				) ,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				"std" => '',
				"description" => __("Chose header style.", 'adforest'),
			),
			array(
				"group" => __("Basic", "'adforest"),
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Section Title", 'adforest' ),
				"param_name" => "section_title",
				"description" =>  __('For color ', 'adforest') . '<strong>' . esc_html('{color}') . '</strong>' . __('warp text within this tag', 'adforest') . '<strong>' . esc_html('{/color}') . '</strong>',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'dependency' => array(
				'element' => 'header_style',
				'value' => array('classic'),
				) ,
			),	
			array(
				"group" => __("Basic", "'adforest"),
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Section Title", 'adforest' ),
				"param_name" => "section_title_regular",
				"value" => "",
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'dependency' => array(
				'element' => 'header_style',
				'value' => array('regular'),
				) ,
			),	
			array(
				"group" => __("Basic", "'adforest"),
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Section Description", 'adforest' ),
				"param_name" => "section_description",
				"value" => "",
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'dependency' => array(
				'element' => 'header_style',
				'value' => array('classic'),
				) ,
			),
			
		array(
			"group" => __("Ads Settings", "'adforest"),
			"type" => "dropdown",
			"heading" => __("Ads Type", 'adforest') ,
			"param_name" => "ad_type",
			"admin_label" => true,
			"value" => array(
			__('Select Ads Type', 'adforest') => '',
			__('Featured Ads', 'adforest') => 'feature',
			__('Simple Ads', 'adforest') => 'regular',
			__('Both', 'adforest') => 'both'
			) ,
		),
		array(
			"group" => __("Ads Settings", "'adforest"),
			"type" => "dropdown",
			"heading" => __("Order By", 'adforest') ,
			"param_name" => "ad_order",
			"admin_label" => true,
			"value" => array(
			__('Select Ads order', 'adforest') => '',
			__('Oldest', 'adforest') => 'asc',
			__('Latest', 'adforest') => 'desc',
			__('Random', 'adforest') => 'rand'
			) ,
		),
		array(
			"group" => __("Ads Settings", "'adforest"),
			"type" => "dropdown",
			"heading" => __("Layout Type", 'adforest') ,
			"param_name" => "layout_type",
			"admin_label" => true,
			"value" => $grid_array,
		),
		array(
			"group" => __("Ads Settings", "'adforest"),
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
	));
}
}

add_action('vc_before_init', 'ads_short');

if ( !function_exists ( 'ads_short_base_func' ) ) {
function ads_short_base_func($atts, $content = '')
{
	$no_title = 'yes';
require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/ads_layout.php";
$parallex	=	'';
if( $section_bg == 'img' )
{
	$parallex	=	'parallex';
}
return '<section class="custom-padding '.$bg_color.' '.$bg_color.'" ' . $style .'>
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
			   		'.$header.'
			   		'.$html.'
			   </div>
			</div>
		</section>
			   ';

}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('ads_short_base', 'ads_short_base_func');
}