<?php
/* ------------------------------------------------ */
/* Process Cycle */
/* ------------------------------------------------ */
if ( !function_exists ( 'process_cycle_short' ) ) {
function process_cycle_short()
{
	vc_map(array(
		"name" => __("Process Cycle", 'adforest') ,
		"base" => "process_cycle_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('process_cycle.png') .  __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),	
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
		// Step 1
		array(
			 "group" => __("Step 1", "'adforest"),
			 'type' => 'iconpicker',
			 'heading' => __( 'Icon', 'adforest' ),
			 'param_name' => 's1_icon',
			 'settings' => array(
			 'emptyIcon' => false,
			 'type' => 'classified',
			 'iconsPerPage' => 100, // default 100, how many icons per/page to display
			   ),
		  ),
		array(
			"group" => __("Step 1", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Title", 'adforest' ),
			"param_name" => "s1_title",
		),	
		array(
			"group" => __("Step 1", "'adforest"),
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Description", 'adforest' ),
			"param_name" => "s1_description",
		),	
		// Step 2
		array(
			 "group" => __("Step 2", "'adforest"),
			 'type' => 'iconpicker',
			 'heading' => __( 'Icon', 'adforest' ),
			 'param_name' => 's2_icon',
			 'settings' => array(
			 'emptyIcon' => false,
			 'type' => 'classified',
			 'iconsPerPage' => 100, // default 100, how many icons per/page to display
			   ),
		  ),
		array(
			"group" => __("Step 2", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Title", 'adforest' ),
			"param_name" => "s2_title",
		),	
		array(
			"group" => __("Step 2", "'adforest"),
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Description", 'adforest' ),
			"param_name" => "s2_description",
		),	
		// Step 3
		array(
			 "group" => __("Step 3", "'adforest"),
			 'type' => 'iconpicker',
			 'heading' => __( 'Icon', 'adforest' ),
			 'param_name' => 's3_icon',
			 'settings' => array(
			 'emptyIcon' => false,
			 'type' => 'classified',
			 'iconsPerPage' => 100, // default 100, how many icons per/page to display
			   ),
		  ),
		array(
			"group" => __("Step 3", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Title", 'adforest' ),
			"param_name" => "s3_title",
		),	
		array(
			"group" => __("Step 3", "'adforest"),
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Description", 'adforest' ),
			"param_name" => "s3_description",
		),	
			
			
		),
	));
}
}

add_action('vc_before_init', 'process_cycle_short');
if ( !function_exists ( 'process_cycle_short_base_func' ) ) {
function process_cycle_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'section_bg' => '',
		'header_style' => '',
		'section_title' => '',
		'section_title_regular' => '',
		'section_description' => '',
		's1_icon' => '',
		's1_title' => '',
		's1_description' => '',
		's2_icon' => '',
		's2_title' => '',
		's2_description' => '',
		's3_icon' => '',
		's3_title' => '',
		's3_description' => '',
	) , $atts));

	if ( isset( $header_style ) )
	{
		$main_title	=	'';
		if( $header_style == 'classic' )
		{
			$main_title	=	$section_title;
		}
		else
		{
			$main_title	=	$section_title_regular;
		}
		$header	=	adforest_getHeader( $main_title, $section_description, $header_style );	
	}


return '<section class="section-padding '.$section_bg.'">
            <div class="container">
               <div class="row">
                  '.$header.'
                  <div class="col-xs-12 col-md-12 col-sm-12 ">
                     <div class="row">
                        <div class="how-it-work text-center">
                           <div class="how-it-work-icon"> <i class="'.esc_attr($s1_icon).'"></i> </div>
                           <h4>'.esc_html($s1_title).'</h4>
                           <p>'.esc_html($s1_description).'</p>
                        </div>
                        <div class="how-it-work text-center ">
                           <div class="how-it-work-icon"> <i class="'.esc_attr($s2_icon).'"></i> </div>
                           <h4>'.esc_html($s2_title).'</h4>
                           <p>'.esc_html($s2_description).'</p>
                        </div>
                        <div class="how-it-work text-center">
                           <div class="how-it-work-icon "> <i class="'.esc_attr($s3_icon).'"></i></div>
                           <h4>'.esc_html($s3_title).'</h4>
                           <p>'.esc_html($s3_description).'</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>';
}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('process_cycle_short_base', 'process_cycle_short_base_func');
}