<?php
/* ------------------------------------------------ */
/* Info Blocks */
/* ------------------------------------------------ */
if ( !function_exists ( 'info_blocks_short' ) ) {
function info_blocks_short()
{
	vc_map(array(
		"name" => __("Info Block", 'adforest') ,
		"base" => "info_blocks_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('info_block.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),	
		array(
			"group" => __("Basic", "adforest"),
			"type" => "attach_image",
			"holder" => "bg_img",
			"class" => "",
			"heading" => __( "Background Image", 'adforest' ),
			"param_name" => "bg_img",
			"description" => __("1280x800", 'adforest'),
		),
		// Left Block
		array(
			"group" => __("Left Block", "'adforest"),
			 'type' => 'iconpicker',
			 'heading' => __( 'Icon', 'adforest' ),
			 'param_name' => 'l_icon',
			 'settings' => array(
			 'emptyIcon' => false,
			 'type' => 'classified',
			 'iconsPerPage' => 100, // default 100, how many icons per/page to display
			   ),
	   ),
		array(
			"group" => __("Left Block", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Title", 'adforest' ),
			"param_name" => "l_title",
		),	
		array(
			"group" => __("Left Block", "'adforest"),
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Description", 'adforest' ),
			"param_name" => "l_description",
		),	
		array(
			"group" => __("Left Block", "'adforest"),
			"type" => "vc_link",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Read More Link", 'adforest' ),
			"param_name" => "l_link",
		),	
			
		// Right Block
		array(
			"group" => __("Right Block", "'adforest"),
			 'type' => 'iconpicker',
			 'heading' => __( 'Icon', 'adforest' ),
			 'param_name' => 'r_icon',
			 'settings' => array(
			 'emptyIcon' => false,
			 'type' => 'classified',
			 'iconsPerPage' => 100, // default 100, how many icons per/page to display
			   ),
	   ),
		array(
			"group" => __("Right Block", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Title", 'adforest' ),
			"param_name" => "r_title",
		),	
		array(
			"group" => __("Right Block", "'adforest"),
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Description", 'adforest' ),
			"param_name" => "r_description",
		),	
		array(
			"group" => __("Right Block", "'adforest"),
			"type" => "vc_link",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Read More Link", 'adforest' ),
			"param_name" => "r_link",
		),	
			
			
		),
	));
}
}

add_action('vc_before_init', 'info_blocks_short');
if ( !function_exists ( 'info_blocks_short_base_func' ) ) {
function info_blocks_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'r_title' => '',
		'r_description' => '',
		'r_link' => '',
		'r_icon' => '',
		'l_title' => '',
		'l_description' => '',
		'l_link' => '',
		'l_icon' => '',
	) , $atts));

	
	

	
	
$style = '';
if( $bg_img != "" )
{
$bgImageURL	=	adforest_returnImgSrc( $bg_img );
$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.') center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
}


return '<section class="section-padding-140 parallex" data-stellar-background-ratio="0.1" '. $style .'>
            <div class="container">
               <div class="row">
                  <div class="col-xs-12 col-md-6 col-sm-12">
                     <a '.adforest_ThemeBtn($l_link, '', true).'>
                        <div class="icon-box yellow">
                           <div class="icon"> <i class="'.esc_attr($l_icon).'"></i> </div>
                           <div class="icon-text">
                              <h3 class="title">
                                 '.esc_html($l_title).'			
                              </h3>
                              <div class="content">
                                 <p><span>'.esc_html($l_description).'</span></p>
                              </div>
                           </div>
                        </div>
                     </a>
                  </div>
                  <div class="col-xs-12 col-md-6 col-sm-12">
                     <a '.adforest_ThemeBtn($r_link, '', true).'>
                        <div class="icon-box red">
                           <div class="icon"> <i class="'.esc_attr($r_icon).'"></i> </div>
                           <div class="icon-text">
                              <h3 class="title">
                                 '.esc_html($r_title).'				
                              </h3>
                              <div class="content">
                                 <p><span>'.esc_html($r_description).'</span></p>
                              </div>
                           </div>
                        </div>
                     </a>
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
	adforest_add_code('info_blocks_short_base', 'info_blocks_short_base_func');
}