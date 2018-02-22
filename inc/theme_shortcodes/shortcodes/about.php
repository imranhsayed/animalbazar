<?php
/* ------------------------------------------------ */
/* About Us */
/* ------------------------------------------------ */
if (!function_exists('about_us_short')) {
function about_us_short()
{
	vc_map(array(
		"name" => __("About Us", 'adforest') ,
		"base" => "about_us_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('about_us.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
				"description" =>  __('For color ', 'adforest') . '<strong>' . esc_html('{color}') . '</strong>' . __('warp text within this tag', 'adforest') . '<strong>' . '<strong>' . esc_html('{/color}') . '</strong>' . '</strong>',
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
				"group" => __("About Us", "'adforest"),
				"type" => "textfield",
				"holder" => "div",
				"heading" => __( "Title", 'adforest' ),
				"param_name" => "main_heading",
			),	
			array(
				"group" => __("About Us", "'adforest"),
				"type" => "textarea",
				"holder" => "div",
				"heading" => __( "Description", 'adforest' ),
				"param_name" => "main_description",
			),
			
			array(
				"group" => __("About Us", "'adforest"),
				"type" => "vc_link",
				"heading" => __( "Read More Link", 'adforest' ),
				"param_name" => "main_link",
				"description" => __("Read more Link if any.", "'adforest"),
			),
			array(
				"group" => __("About Us", "'adforest"),
				"type" => "attach_image",
				"holder" => "bg_img",
				"heading" => __( "Image", 'adforest' ),
				"param_name" => "main_image",
				"description" => "555x460",
			),
			
								
		),
	));
}
}

add_action('vc_before_init', 'about_us_short');
if (!function_exists('about_us_short_base_func')) {
function about_us_short_base_func($atts, $content = '')
{
require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
	$parallex	=	'';
	if( $section_bg == 'img' )
	{
		$parallex	=	'parallex';
	}
	
		$img_html	=	'';
		$main_img	=	adforest_returnImgSrc( $main_image );
		if( isset( $main_img ) )
		{
			$img_html = '<div class="about-page-featured-image">
                        <img src="'.$main_img.'" alt="'.$main_title.'">
                     </div>';
		}
		
   return '<section class="section-padding '.$parallex.' '.$bg_color.'" ' . $style .'>
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
			   '.$header.'
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     <div class="about-us-content">
                        <div class="heading-panel">
                           <h3 class="main-title text-left">
                              '.$main_heading.'
                           </h3>
                        </div>
                        <h2></h2>
                        <p>'.$main_description.'
						'. adforest_ThemeBtn($main_link, '', false).'
						</p>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     '.$img_html.'
                  </div>
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>';

}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('about_us_short_base', 'about_us_short_base_func');
}