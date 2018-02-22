<?php
/* ------------------------------------------------ */
/* Pricing Minimal */
/* ------------------------------------------------ */
if ( !function_exists ( 'price_minimal_short' ) ) {
function price_minimal_short()
{
	vc_map(array(
		"name" => __("Products - Minimal", 'adforest') ,
		"base" => "price_minimal_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('pricing-minimal.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
			
			array(
				"group" => __("Products Setting", "'adforest"),
				"type" => "dropdown",
				"heading" => __("Column", 'adforest') ,
				"param_name" => "p_cols",
				"value" => array(
				__('Select Col ', 'adforest') => '',
				__('3 Col', 'adforest') => '4',
				__('4 Col', 'adforest') => '3'
				) ,
			),
			
		array
		(
			'group' => __( 'Products', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Select Category', 'adforest' ),
			'param_name' => 'woo_products',
			'value' => '',
			'params' => array
			(
				array(
					"type" => "dropdown",
					"heading" => __("Select Product", 'adforest') ,
					"param_name" => "product",
					"admin_label" => true,
					"value" => adforest_get_products(),
				),

			)
		),
								
		),
	));
}
}

add_action('vc_before_init', 'price_minimal_short');
if ( !function_exists ( 'price_minimal_short_base_func' ) ) {
function price_minimal_short_base_func($atts, $content = '')
{
require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
	
	
	$html	=	'';
	
		$rows = vc_param_group_parse_atts( $woo_products );
		$categories_html	=	'';
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['product'] ) )
				{
					$product_satus	=	get_post_status( $row['product'] );
					if ($product_satus == false || $product_satus != 'publish' )
					{
						continue;
					}
			$product	=	new WC_Product( $row['product'] );
			$cls	=	'block';
			if( get_post_meta( $row['product'], 'package_bg_color', true ) == 'dark' )
				$cls	=	'block featured';
				
			$inner_html	=	'';
			if( get_post_meta( $row['product'], 'package_expiry_days', true ) == "-1" )
			{
				$inner_html.= '<span class="f_custom">'.__('Validity','adforest').': ' . __('Lifetime','adforest').'</span>';
			}
			else if( get_post_meta( $row['product'], 'package_expiry_days', true ) != "" )
			{
				$inner_html.= '<span class="f_custom">'.__('Validity','adforest').': '.get_post_meta( $row['product'], 'package_expiry_days', true ) . ' ' . __('Days','adforest').'</span>';
			}
			
			if( get_post_meta( $row['product'], 'package_free_ads', true ) != "" )
				$inner_html .= '<span class="f_custom">'.__('Ads','adforest').': '.get_post_meta( $row['product'], 'package_free_ads', true ) .'</span>';
			if( get_post_meta( $row['product'], 'package_featured_ads', true ) != "" )
				$inner_html .= '<span class="f_custom">'.__('Featured Ads','adforest').': '.get_post_meta( $row['product'], 'package_featured_ads', true ) .'</span>';
			if( get_post_meta( $row['product'], 'package_bump_ads', true ) != "" )
				$inner_html .= '<span class="f_custom">'.__('Bump-up Ads','adforest').': '.get_post_meta( $row['product'], 'package_bump_ads', true ) .'</span>';
			
			
			$html .= '<div class="col-sm-4 col-md-4 col-xs-12">
                           <div class="pricing-item">
                              <div class="price"><small>'.get_woocommerce_currency_symbol().'</small>'.$product->get_price().'</div>
                              <strong>'.get_the_title($row['product']).'</strong>
                              <p>'.$inner_html.'</p>
                      <a href="javascript:void(0);" class="btn btn-theme sb_add_cart" data-product-id="'.$row['product'].'" data-product-qty="1">'.__('Select Plan', 'adforest' ) . ' <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
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
	
	return ' <section class="custom-padding '.$parallex.' '.$bg_color.'" ' . $style .'>
            <div class="container">
               <div class="row">
			   '.$header.'
                  <div class="col-md-12 col-xs-12 col-sm-12">
				  <div class="row">
					 '.$html.'
                  </div>
                  </div>
               </div>
            </div>
         </section>
			
	';
	
}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('price_minimal_short_base', 'price_minimal_short_base_func');
}