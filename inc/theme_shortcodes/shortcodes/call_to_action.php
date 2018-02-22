<?php
/* ------------------------------------------------ */
/* Call to Action */
/* ------------------------------------------------ */
if ( !function_exists ( 'call_to_action_short' ) ) {
function call_to_action_short()
{
	vc_map(array(
		"name" => __("Call to Action", 'adforest') ,
		"base" => "call_to_action_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('call_to_action.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),	
		array(
			"type" => "attach_image",
			"holder" => "bg_img",
			"class" => "",
			"heading" => __( "Background Image", 'adforest' ),
			"param_name" => "bg_img",
			"description" => __("1280x800", 'adforest'),
		),
		array(
			 'type' => 'iconpicker',
			 'heading' => __( 'Icon', 'adforest' ),
			 'param_name' => 'icon',
			 'settings' => array(
			 'emptyIcon' => false,
			 'type' => 'classified',
			 'iconsPerPage' => 100, // default 100, how many icons per/page to display
			   ),
	   ),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Title", 'adforest' ),
			"param_name" => "title",
		),	
		array(
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Description", 'adforest' ),
			"param_name" => "description",
		),	
		array(
			"type" => "vc_link",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Read More Link", 'adforest' ),
			"param_name" => "link",
		),	
			
			
			
		),
	));
}
}

add_action('vc_before_init', 'call_to_action_short');
if ( !function_exists ( 'call_to_action_short_base_func' ) ) {
function call_to_action_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'title' => '',
		'description' => '',
		'link' => '',
		'icon' => '',
	) , $atts));
	
$style = '';
if( $bg_img != "" )
{
$bgImageURL	=	adforest_returnImgSrc( $bg_img );
$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.') center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
}

return '<div class="parallex section-padding" '.$style . '>
            <div class="container">
               <div class="row">
                  <div class="col-md-8 col-sm-12">
                     <div class="call-action">
                        <i class="'.esc_attr($icon) .'"></i>
                        <h4>'.esc_html($title) .'</h4>
                        <p>'.esc_html($description) .'</p>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                     <div class="parallex-button">
					 '.adforest_ThemeBtn($link, 'btn btn-theme', false, '', '<i class="fa fa-angle-double-right "></i>').'
					 </div>
                  </div>
               </div>
            </div>
         </div>';



}
}


if (function_exists('adforest_add_code'))
{
	adforest_add_code('call_to_action_short_base', 'call_to_action_short_base_func');
}