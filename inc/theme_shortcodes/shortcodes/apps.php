<?php
/* ------------------------------------------------ */
/* Apps */
/* ------------------------------------------------ */
if ( !function_exists ( 'apps_short' ) ) {
function apps_short()
{
	vc_map(array(
		"name" => __("Apps - Simple", 'adforest') ,
		"base" => "apps_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('apps.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
			"heading" => __( "Section Title", 'adforest' ),
			"param_name" => "section_title",
		),	
		// Android
		array(
			"group" => __("Android", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Tag Line", 'adforest' ),
			"param_name" => "a_tag_line",
		),	
		array(
			"group" => __("Android", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Title", 'adforest' ),
			"param_name" => "a_title",
		),	
		array(
			"group" => __("Android", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Download Link", 'adforest' ),
			"param_name" => "a_link",
		),	
		// IOS
		array(
			"group" => __("IOS", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Tag Line", 'adforest' ),
			"param_name" => "i_tag_line",
		),	
		array(
			"group" => __("IOS", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Title", 'adforest' ),
			"param_name" => "i_title",
		),	
		array(
			"group" => __("IOS", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Download Link", 'adforest' ),
			"param_name" => "i_link",
		),	
		// Windows
		array(
			"group" => __("Windows", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Tag Line", 'adforest' ),
			"param_name" => "w_tag_line",
		),	
		array(
			"group" => __("Windows", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Title", 'adforest' ),
			"param_name" => "w_title",
		),	
		array(
			"group" => __("Windows", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Download Link", 'adforest' ),
			"param_name" => "w_link",
		),	
			
			
		),
	));
}
}

add_action('vc_before_init', 'apps_short');
if ( !function_exists ( 'apps_short_base_func' ) ) {
function apps_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'section_title' => '',
		'a_tag_line' => '',
		'a_title' => '',
		'a_link' => '',
		'w_tag_line' => '',
		'w_title' => '',
		'w_link' => '',
		'i_tag_line' => '',
		'i_title' => '',
		'i_link' => '',
	) , $atts));

	
	
	$apps = '';
	$count = 0;
	if( $a_link != "" )
	{
		$count++;
		$apps .= '<div class="col-md-4">
                           <a href="'.esc_url($a_link).'" title="'.esc_attr($a_title).'" class="btn app-download-button"> <span class="app-store-btn">
                           <i class="fa fa-android"></i>
                           <span>
                           <span>'.esc_html($a_tag_line).'</span> <span>'.esc_html($a_title).'</span> </span>
                           </span>
                           </a>
                        </div>';	
	}
	if( $i_link != "" )
	{
		$count++;
		$apps .= '<div class="col-md-4">
                           <a href="'.esc_url($i_link).'" title="'.esc_attr($i_title).'" class="btn app-download-button"> <span class="app-store-btn">
                           <i class="fa fa-apple"></i>
                           <span>
                           <span>'.esc_html($i_tag_line).'</span> <span>'.esc_html($i_title).'</span> </span>
                           </span>
                           </a>
                        </div>';	
	}
	if( $w_link != "" )
	{
		$count++;
		$apps .= '<div class="col-md-4">
                           <a href="'.esc_url($w_link).'" title="'.esc_attr($w_title).'" class="btn app-download-button"> <span class="app-store-btn">
                           <i class="fa fa-windows"></i>
                           <span>
                           <span>'.esc_html($w_tag_line).'</span> <span>'.esc_html($w_title).'</span> </span>
                           </span>
                           </a>
                        </div>';	
	}
	
	$off_set	=	'';
	if( $count == 1 )
	{
		$off_set = 'col-md-offset-4';
	}
	else if( $count == 2 )
	{
		$off_set = 'col-md-offset-2';
	}
	else if( $count == 3 )
	{
		$off_set = '';
	}
	
	
$style = '';
if( $bg_img != "" )
{
$bgImageURL	=	adforest_returnImgSrc( $bg_img );
$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.') fixed center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
}
	return ' <div class="app-download-section parallex" '. $style .'>
            <div class="app-download-section-wrapper">
               <div class="app-download-section-container">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="section-title"> <span>'.$section_title.'</span></div>
                        </div>
						<div class="col-md-12 '.$off_set.'">
						'.$apps.'
						</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
	
	';
}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('apps_short_base', 'apps_short_base_func');
}