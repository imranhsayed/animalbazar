<?php
/* ------------------------------------------------ */
/* Apps Classic */
/* ------------------------------------------------ */
if ( !function_exists ( 'app_classic_short' ) ) {
function app_classic_short()
{
	vc_map(array(
		"name" => __("Apps - Classic", 'adforest') ,
		"base" => "app_classic_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('apps_classic.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
		array(
			"group" => __("Basic", "adforest"),
			"type" => "attach_image",
			"holder" => "bg_img",
			"class" => "",
			"heading" => __( "Main Image", 'adforest' ),
			"param_name" => "app_img",
			"description" => __("400x500", 'adforest'),
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
			
			
		),
	));
}
}

add_action('vc_before_init', 'app_classic_short');
if ( !function_exists ( 'app_classic_short_base_func' ) ) {
function app_classic_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'section_title' => '',
		'section_tag_line' => '',
		'app_img' => '',
		'a_tag_line' => '',
		'a_title' => '',
		'a_link' => '',
		'i_tag_line' => '',
		'i_title' => '',
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

	
	$apps = '';
	if( $a_link != "" )
	{
		$apps .= '<div class="col-md-6">
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
		$apps .= '<div class="col-md-6">
                           <a href="'.esc_url($i_link).'" title="'.esc_attr($i_title).'" class="btn app-download-button"> <span class="app-store-btn">
                           <i class="fa fa-apple"></i>
                           <span>
                           <span>'.esc_html($i_tag_line).'</span> <span>'.esc_html($i_title).'</span> </span>
                           </span>
                           </a>
                        </div>';	
	}
	
$style = '';
if( $bg_img != "" )
{
$bgImageURL	=	adforest_returnImgSrc( $bg_img );
$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.') fixed center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
}

$img_html = '';
if( $app_img != "" )
{
	$img_html = '<div class="mobile-image-content">
	<img src="'.adforest_returnImgSrc( $app_img ).'" alt="'.__('app image', 'adforest' ).'">
	</div>';
}

return '<div class="app-download-section style-2" '. $style .'>
            <div class="app-download-section-wrapper">
               <div class="app-download-section-container">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           '.$img_html.'
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                           <div class="app-text-section">
                              <h5>'.esc_html($section_tag_line) .'</h5>
                              <h3>'.esc_html($section_title) .'</h3>
                              	'.$point_html.'
                              <div class="app-download-btn">
                                 <div class="row">
								 	'.$apps.'
                                 </div>
                              </div>
                           </div>
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
	adforest_add_code('app_classic_short_base', 'app_classic_short_base_func');
}