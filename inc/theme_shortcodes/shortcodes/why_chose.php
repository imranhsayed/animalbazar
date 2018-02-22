<?php
/* ------------------------------------------------ */
/* why chose us */
/* ------------------------------------------------ */
if ( !function_exists ( 'why_us_short' ) ) {
function why_us_short()
{
	vc_map(array(
		"name" => __("Why Us", 'adforest') ,
		"base" => "why_us_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('why_us.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
			
		array
		(
			'group' => __( 'Facts', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Select Category', 'adforest' ),
			'param_name' => 'facts',
			'value' => '',
			'params' => array
			(
				array(
					'group' => __( 'Facts', 'adforest' ),
					"type" => "textfield",
					"holder" => "div",
					"heading" => __( "Title", 'adforest' ),
					"param_name" => "title",
				),	
				array(
					'group' => __( 'Facts', 'adforest' ),
					"type" => "textarea",
					"holder" => "div",
					"heading" => __( "Description", 'adforest' ),
					"param_name" => "description",
				),
				array(
					'group' => __( 'Facts', 'adforest' ),
					"type" => "vc_link",
					"heading" => __( "Read More Link", 'adforest' ),
					"param_name" => "link",
				),
			)
		),
			
		),
	));
}
}

add_action('vc_before_init', 'why_us_short');
if ( !function_exists ( 'why_us_short_base_func' ) ) {
function why_us_short_base_func($atts, $content = '')
{
require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
	
		$rows = vc_param_group_parse_atts( $atts['facts'] );
		$facts_html	=	'';
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['title'] ) && isset( $row['description'] ) )
				{
					$read_more = '';
					if( isset( $row['link'] ) )
						$read_more = adforest_ThemeBtn($row['link'], '', false);
					$facts_html	.=	'<div class="col-sm-12 col-md-4 col-xs-12 no-padding">
                        <div class="why-us border-box text-center">
                           <h5>'.$row['title'].'</h5>
                           <p>'.$row['description'].'
						   '. $read_more .'
						   </p>
                        </div>
                     </div>';
				}
			}
		}
	
	$parallex	=	'';
	if( $section_bg == 'img' )
	{
		$parallex	=	'parallex';
	}
	
	return '<section class="about-us '.$parallex.' '.$bg_color.'" ' . $style .'>
            <div class="container-fluid">
               <div class="row">
			   '.$header.'
                  <div class="col-md-12 no-padding">
				  	'.$facts_html.'
				  </div>
				</div>
			</div>
			</section>
	';		
}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('why_us_short_base', 'why_us_short_base_func');
}