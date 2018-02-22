<?php
/* ------------------------------------------------ */
/* About Us */
/* ------------------------------------------------ */
function adforest_sticky_sidebar_func() {
	vc_map( array(
		"name" => __("Sticky Sidebar", 'adforest'),
		"base" => "sticky_sidebar",
		"as_parent" => array('only' => 'process,adforest_ads, advertisement'),
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
		"category" => __( "Theme Shortcodes", 'adforest'),
		"js_view" => 'VcColumnView',
		"params" => array(
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
				"heading" => __( "Section Description", 'adforest' ),
				"param_name" => "section_description",
				'dependency' => array(
				'element' => 'header_style',
				'value' => array('classic'),
				) ,
			),	
			array(
				"group" => __("Advertisement", "'adforest"),
				"type" => "textarea_raw_html",
				"holder" => "div",
				"heading" => __( "Left Side Ad", 'adforest' ),
				"param_name" => "ad_left",
				"description" => __("Ad size 160 X 600", 'adforest'),
			),	
			array(
				"group" => __("Advertisement", "'adforest"),
				"type" => "textarea_raw_html",
				"holder" => "div",
				"heading" => __( "Right Side Ad", 'adforest' ),
				"param_name" => "ad_right",
				"description" => __("Ad size 160 X 600", 'adforest'),
			),	
		),
			
	) );
	require trailingslashit(__DIR__) . 'process.php';
	require trailingslashit(__DIR__) . 'adforest_ads.php';	
	require trailingslashit(__DIR__) . 'advertisement.php';
		
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_sticky_sidebar extends WPBakeryShortCodesContainer {
		 }
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_adforest_ads extends WPBakeryShortCode {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_advertisement extends WPBakeryShortCode {
		}
	}
	
}
add_action( 'vc_before_init', 'adforest_sticky_sidebar_func' );

/* Process */
function adforest_process_child($atts, $content = '') 
{
	extract(shortcode_atts(array(
		'steps' => '',
	) , $atts));

		$rows = vc_param_group_parse_atts( $atts['steps'] );
		$steps_html	=	'';
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['title'] ) && isset( $row['description'] ) && isset( $row['img'] ) )
				{
					
					$steps_html .= '<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                              <div class="usefull-info">
                                 <div class="icon-info">
								 <img src="'.esc_url( adforest_returnImgSrc ( $row['img'] ) ) .'" alt="'.$row['title'].'">
								 </div>
                                 <div class="info-content">
                                    <h3>'.esc_html( $row['title'] ) .'</h3>
                                    <div class="description">'.esc_html( $row['description'] ) .'</div>
                                 </div>
                              </div>
                           </div>';	
				}
			}
		}
	
	
	 return '<div class="grid-card info-panel">
	 		'.$steps_html.'
			</div>
	 ';		
}
if( function_exists( 'adforest_add_code' ) ) {adforest_add_code('process', 'adforest_process_child'); }


/* Adforest Ads */
function adforest_ads_child($atts, $content = '') 
{
	$cls = 'grid-card';
	require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/ads_layout.php";
	return $html;
}
if( function_exists( 'adforest_add_code' ) ) {adforest_add_code('adforest_ads', 'adforest_ads_child'); }


/* Advertisement Ads */
function adforest_advertisement_child($atts, $content = '') 
{
   extract(shortcode_atts(array(
		'ad_720' => '',
	) , $atts));
	return '<div class="col-md-12">
                            <div class="margin-bottom-40 margin-top-10">
							'.urldecode( adforest_decode(  $ad_720 ) ).'
                            </div>
                     	</div>';
}
if( function_exists( 'adforest_add_code' ) ) {adforest_add_code('advertisement', 'adforest_advertisement_child'); }



function adforest_theme_sticky_side_bar($atts, $content = '') {
	require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
	
	return '<section class="section-padding '.$bg_color.'" ' . $style .'>
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
			   '.$header.'
                  <div class="col-md-2 col-sm-2  hidden-xs hidden-sm  leftbar-stick">
                     <div class="theiaStickySidebar"> '.urldecode( adforest_decode(  $ad_left ) ).' </div>
                  </div>
                  <div class="col-md-8 col-xs-12 col-sm-12 ">
                     <!-- Main Container -->
                     <!-- Row -->
                     <div class="row">
					 	'. do_shortcode( $content ) . '
					  </div>
                     <!-- Row End -->
                     <!-- Main Container End -->
                  </div>
                  <div class="col-md-2 col-sm-2 hidden-xs hidden-sm rightbar-stick">
                     <div class="theiaStickySidebar"> '.urldecode( adforest_decode(  $ad_right ) ).' </div>
                  </div>
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>

	';
   	
}

if( function_exists( 'adforest_add_code' ) ) {adforest_add_code('sticky_sidebar', 'adforest_theme_sticky_side_bar'); }