<?php
/* ------------------------------------------------ */
/* Search Modern */
/* ------------------------------------------------ */
if ( !function_exists ( 'clouds_short' ) ) {
function clouds_short()
{
	vc_map(array(
		"name" => __("Hero - Clouds", 'adforest') ,
		"base" => "clouds_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('clouds.png').__( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Section Title", 'adforest' ),
			"param_name" => "section_title",
			"description" => esc_html__("For bold the text;<strong>Your text</strong> and %count% for total ads.", 'adforest'),
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Search Button Text", 'adforest' ),
			"param_name" => "search_btn_text",
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Ad post Button Text", 'adforest' ),
			"param_name" => "ad_btn_text",
		),	
		
		
		),
	));
}
}

add_action('vc_before_init', 'clouds_short');
if ( !function_exists ( 'clouds_short_base_func' ) ) {
function clouds_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'section_title' => '',
		'search_btn_text' => '',
		'ad_btn_text' => '',
	) , $atts));
	global $adforest_theme;


$style = '';
if( $bg_img != "" )
{
$bgImageURL	=	adforest_returnImgSrc( $bg_img );
$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.')  no-repeat scroll center center / cover ;"' : "";
}

$count_posts = wp_count_posts('ad_post');
$main_title = str_replace( '%count%', '<b>' .  $count_posts->publish . '</b>', $section_title);

return '<div class="modern_sample2 parallex-light" '.$style.'>
								  <div class="container">
										<div class="content">
            								<h1 class="tx-smooth">'.$main_title.'</h1>
                                            <a href="'.get_the_permalink( $adforest_theme['sb_search_page'] ).'" class="btn btn-theme">'.$search_btn_text.'</a>
                                            <a href="'.get_the_permalink( $adforest_theme['sb_post_ad_page'] ).'" class="btn btn-clean">'.$ad_btn_text.'</a>
											
         								</div> 
									</div>
                                     <div class="cloud"><img src="'.trailingslashit( get_template_directory_uri () ) .'images/cloud-pattern.png" alt="'.__('clouds','adforest') . '" class="img-responsive"></div>

    							</div>';

return '<div class="modern_sample" '.$style.'>
          <div class="container">
                <div class="content">
                    <h1 class="tx-smooth">'.$section_title.'</h1>
                    <form method="get" action="'.get_the_permalink($adforest_theme['sb_search_page']).'">
             <div class="search-section">
                <div id="form-panel">
                   <ul class="list-unstyled search-options clearfix">
                      <li>
                        <select class="category form-control" name="cat_id">
							<option label="'.__('Select Category','adforest').'" value="">'.__('Select Category','adforest').'</option>
							'.$cats_html.'
						</select>	
                      </li>
                      <li>
                         <input type="text" autocomplete="off" name="ad_title" placeholder="'.esc_attr($search_placeholder).'">
                      </li>
                      <li>
                         <button type="submit" class="btn btn-danger btn-lg btn-block">'.__('Search','adforest').'</button>
                      </li>
                   </ul>
    
                </div>
             </div>
             </form>
                </div> 
                <div class="new-categoy">
                    <div class="cat_lists">	
    					'.$cats_round_html.'
					</div>
                </div>
        </div>
    </div>';

}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('clouds_short_base', 'clouds_short_base_func');
}