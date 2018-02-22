<?php
/* ------------------------------------------------ */
/* Search Simple */
/* ------------------------------------------------ */
if ( !function_exists ( 'search_hero_short' ) ) {
function search_hero_short()
{
	vc_map(array(
		"name" => __("Search - with bg-video", 'adforest') ,
		"base" => "search_hero_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('search-simple.png').__( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "BG Video", 'adforest' ),
			"description" => __( "Youtube video url.", 'adforest' ),
			"param_name" => "section_video",
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Section Title", 'adforest' ),
			"description" => __( "%count% for total ads.", 'adforest' ),
			"param_name" => "section_title",
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Section Tagline", 'adforest' ),
			"param_name" => "section_tag_line",
		),	
		
		),
	));
}
}

add_action('vc_before_init', 'search_hero_short');
if ( !function_exists ( 'search_hero_short_base_func' ) ) {
function search_hero_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'section_video' => '',
		'section_title' => '',
		'section_tag_line' => '',
	) , $atts));
	global $adforest_theme;

$count_posts = wp_count_posts('ad_post');

$main_title = str_replace( '%count%', '<b>' .  $count_posts->publish . '</b>', $section_title);

wp_enqueue_script( 'ytPlyer',  trailingslashit( get_template_directory_uri () ) . 'js/jquery.mb.YTPlayer.min.js', false, false, true );
$script	= '<script>jQuery(document).ready(function () {
			jQuery("#bgndVideo").mb_YTPlayer();
		});</script>';
return $script . '<section class="hero video-section" >
        <a id="bgndVideo" class="player" data-property="{videoURL:\''.$section_video . '\',containment:\'.hero\', quality:\'highres\', autoPlay:true, loop:true, showControls: false, startAt:1,  mute:true, opacity: 1, origin: \''.home_url().'\'}">'. __('BG video','adforest').'</a>
         <div class="content">
             <p>'.$main_title.'</p>
            <h1>'.esc_html($section_tag_line).'</h1>
            <div class="search-holder">
               <div id="custom-search-input">
                  <div class="input-group col-md-12 col-xs-12 col-sm-12">
                     <form method="get" action="'.get_the_permalink($adforest_theme['sb_search_page']).'">
                     <input type="text" autocomplete="off" name="ad_title" class="form-control" placeholder="'.__('What Are You Looking For...','adforest').'" /> <span class="input-group-btn">
                     <button class="btn btn-theme" type="submit"> <span class=" glyphicon glyphicon-search"></span> </button>
                     </span>
					</form>
                  </div>
               </div>
            </div>
            <!-- .search-holder -->
         </div>
         <!-- .content -->
      </section>';


return '<section id="hero" class="hero" '.$style.'>
         <div class="content">
            <p>'.$main_title.'</p>
            <h1>'.esc_html($section_tag_line).'</h1>
            <div class="search-holder">
               <div id="custom-search-input">
                  <div class="input-group col-md-12 col-xs-12 col-sm-12">
				  <form method="get" action="'.get_the_permalink($adforest_theme['sb_search_page']).'">
                     <input type="text" autocomplete="off" name="ad_title" class="form-control" placeholder="'.__('What Are You Looking For...','adforest').'" /> <span class="input-group-btn">
                     <button class="btn btn-theme" type="submit"> <span class=" glyphicon glyphicon-search"></span> </button>
                     </span>
					</form>
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
	adforest_add_code('search_hero_short_base', 'search_hero_short_base_func');
}