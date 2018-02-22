<?php
/* ------------------------------------------------ */
/* Clients or Partners classic */
/* ------------------------------------------------ */
if ( !function_exists ( 'client_partner_classic_short' ) ) {
function client_partner_classic_short()
{
	vc_map(array(
		"name" => __("Clients or Partners - Classic", 'adforest') ,
		"base" => "client_partner_classic_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('client_parter_classic.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
			'group' => __( 'Client or Partners', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Select Category', 'adforest' ),
			'param_name' => 'clients',
			'value' => '',
			'params' => array
			(
				array(
					'group' => __( 'Client or Partners', 'adforest' ),
					"type" => "textfield",
					"holder" => "div",
					"heading" => __( "URL or Link", 'adforest' ),
					"param_name" => "link",
				),
				array(
					'group' => __( 'Client or Partners', 'adforest' ),
					"type" => "attach_image",
					"holder" => "bg_img",
					"heading" => __( "Logo", 'adforest' ),
					"description" => __( "165x107", 'adforest' ),
					"param_name" => "logo",
				),
			)
		),
			
		),
	));
}
}

add_action('vc_before_init', 'client_partner_classic_short');
if ( !function_exists ( 'client_partner_classic_short_base_func' ) ) {
function client_partner_classic_short_base_func($atts, $content = '')
{
require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
	
		$rows = vc_param_group_parse_atts( $atts['clients'] );
		$clients_html	=	'';
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['logo'] ) )
				{ $bgImageURL	=	adforest_returnImgSrc( $row['logo'] );
					$link = 'javascript:void(0);';
					if( isset( $row['link'] ) )
						$link = esc_url($row['link']);
						
					$clients_html .= '<li class="col-sm-2 col-xs-6 col-md-2">
                           <a href="'.$link.'" target="_blank">
						   <img src="'.adforest_returnImgSrc( $row['logo'] ).'" alt="'.__('logo','adforest').'">
						   </a>
                        </li>';
				}
			}
		}
	
	$parallex	=	'';
	if( $section_bg == 'img' )
	{
		$parallex	=	'parallex';
	}
	
	return '<section class="section-padding" id="partner">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-xs-12  no-padding">
                     <ul>
					 	'.$clients_html.'
                     </ul>
                  </div>
               </div>
            </div>
         </section>
					 ';
}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('client_partner_classic_short_base', 'client_partner_classic_short_base_func');
}