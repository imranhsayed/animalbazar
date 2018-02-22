<?php
/* ------------------------------------------------ */
/* Select Product */
/* ------------------------------------------------ */
if ( !function_exists ( 'select_product_short' ) ) {
function select_product_short()
{
	vc_map(array(
		"name" => __("Select Product", 'adforest') ,
		"base" => "select_product_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('select_product.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),	
		array(
			"group" => __("Basic", "adforest"),
			"type" => "attach_image",
			"holder" => "bg_img",
			"class" => "",
			"heading" => __( "Background Image", 'adforest' ),
			"param_name" => "bg_img",
			"description" => __("1280x480", 'adforest'),
		),
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Section Tagline", 'adforest' ),
			"param_name" => "section_tag_line",
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Section Title", 'adforest' ),
			"param_name" => "section_title",
		),
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "vc_link",
			"holder" => "div",
			"heading" => __( "Button Title & Link", 'adforest' ),
			"param_name" => "link",
		),
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "dropdown",
			"heading" => __("Select Product", 'adforest') ,
			"param_name" => "one_product",
			"admin_label" => true,
			"value" => adforest_get_products(),
		),

		
		array
		(
			'group' => __( 'Key Points', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Select Category', 'adforest' ),
			'param_name' => 'points',
			'value' => '',
			'params' => array
			(
				array(
					"type" => "textfield",
					"holder" => "div",
					"heading" => __( "Point", 'adforest' ),
					"param_name" => "title",
				),	

			)
		),
			
			
		),
	));
}
}

add_action('vc_before_init', 'select_product_short');
if ( !function_exists ( 'select_product_short_base_func' ) ) {
function select_product_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'section_title' => '',
		'section_tag_line' => '',
		'one_product' => '',
		'link' => '',
		'i_link' => '',
		'points' => '',
	) , $atts));

		$rows = vc_param_group_parse_atts( $atts['points'] );
		$point_html	=	'';
		if( count( $rows ) > 0 )
		{
			$point_html .= '<ul>';
			foreach($rows as $row )
			{
				if( isset( $row['title'] ) )
				{
					$point_html .= '<li>'.$row['title'].'</li>';
				}
			}
			$point_html .= '</ul>';
		}
	
$style = '';
if( $bg_img != "" )
{
$bgImageURL	=	adforest_returnImgSrc( $bg_img );
$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.') fixed center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
}

$product_html = '';
if( $one_product != "" )
{
	$product_satus	=	get_post_status( $one_product );
	if ($product_satus == false || $product_satus != 'publish' )
	{
		return;
	}
	$product	=	new WC_Product( $one_product );
	
	$inner_html	=	'';
			if( get_post_meta( $one_product, 'package_expiry_days', true ) == "-1" )
			{
				$inner_html.= '<span class="f_custom">'.__('Validity','adforest').': ' . __('Lifetime','adforest').'</span>';
			}
			else if( get_post_meta( $one_product, 'package_expiry_days', true ) != "" )
			{
				$inner_html.= '<span class="f_custom">'.__('Validity','adforest').': '.get_post_meta( $one_product, 'package_expiry_days', true ) . ' ' . __('Days','adforest').'</span>';
			}
			
			if( get_post_meta( $one_product, 'package_free_ads', true ) != "" )
				$inner_html .= '<span class="f_custom">'.__('Ads','adforest').': '.get_post_meta( $one_product, 'package_free_ads', true ) .'</span>';
			if( get_post_meta( $one_product, 'package_featured_ads', true ) != "" )
				$inner_html .= '<span class="f_custom">'.__('Featured Ads','adforest').': '.get_post_meta( $one_product, 'package_featured_ads', true ) .'</span>';
	
	
	$product_html = '<div class="pricing-fancy ">
                        <div class="icon-bg"><i class="flaticon-money-2"></i></div>
                        <h3><strong>'.get_the_title($one_product).'</strong></h3>
                        <div class="price-box">
						    <div class="price-large">
								 <span class="dollartext">'.get_woocommerce_currency_symbol().'</span>'.$product->get_price().'</div>
                           <p>'.$inner_html.'</p>
                                 <a href="javascript:void(0);" class="btn btn-block btn-theme sb_add_cart" data-product-id="'.$one_product.'" data-product-qty="1">'.__('Select Plan', 'adforest' ) . ' <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                     </div>';
	
}

return '<section class="morden-pricing parallex for-modern-type" '. $style .'>
            <div class="container">
               <div class="container">
                  <div class="col-md-8 col-sm-6 no-padding">
                     <div class="app-text-section">
                        <h5>'.esc_html($section_tag_line) .'</h5>
                        <h3>'.esc_html($section_title) .'</h3>
						'.$point_html.'
						'.adforest_ThemeBtn($link, 'btn btn-lg btn-theme', false, '', '<i class="fa fa-refresh"></i>').'
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-6 no-padding">
				  '.$product_html.'
                  </div>
               </div>
            </div>
         </section>
';
}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('select_product_short_base', 'select_product_short_base_func');
}