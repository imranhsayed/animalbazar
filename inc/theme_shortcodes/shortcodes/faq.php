<?php
/* ------------------------------------------------ */
/* Faq */
/* ------------------------------------------------ */
if ( !function_exists ( 'faq_short' ) ) {
function faq_short()
{
	vc_map(array(
		"name" => __("FAQ", 'adforest') ,
		"base" => "faq_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('faq.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
			"holder" => "img",
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
			'group' => __( 'FAQ', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Question & Answer', 'adforest' ),
			'param_name' => 'cats',
			'value' => '',
			'params' => array
			(
				array(
					"type" => "textfield",
					"heading" => __("Question", 'adforest') ,
					"param_name" => "title",
					"admin_label" => true,
				),
				array(
					"type" => "textarea",
					"heading" => __("Answer", 'adforest') ,
					"param_name" => "description",
					"admin_label" => true,
				),

			)
		),
								
		),
	));
}
}

add_action('vc_before_init', 'faq_short');
if ( !function_exists ( 'faq_short_base_func' ) ) {
function faq_short_base_func($atts, $content = '')
{
	global $adforest_theme;
	
	$bg_bootom	=	'yes';
	require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
		$rows = vc_param_group_parse_atts( $atts['cats'] );
		$faq_html	=	'';
		if( count( $rows ) > 0 )
		{
			$faq_html .= '<ul class="accordion">';
			foreach($rows as $row )
			{
				if( isset( $row['title'] ) && isset( $row['description']  ) )
				{
					$faq_html .= '<li>
                           <h3 class="accordion-title"><a href="#">'.esc_html($row['title']).'</a></h3>
                           <div class="accordion-content">
                              <p>'.esc_html($row['description']).'</p>
                           </div>
                        </li>';
				}
			}
			$faq_html .= '</ul>';
		}

return '<section class="section-padding error-page '.$bg_color.'" ' . $style .'>
            <div class="container">
               <div class="row">
				   '.$header.'
                  <div class="col-md-12 col-xs-12 col-sm-12">
				  	'.$faq_html.'
				  </div>
			  </div>
		  </div>
	   </section>
';


}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('faq_short_base', 'faq_short_base_func');
}