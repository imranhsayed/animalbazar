<?php
/* ------------------------------------------------ */
/* Search Simple */
/* ------------------------------------------------ */
if ( !function_exists ( 'search_hero2_short' ) ) {
function search_hero2_short()
{
	vc_map(array(
		"name" => __("Search - Hero", 'adforest') ,
		"base" => "search_hero2_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('search_hero.png').__( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
			"description" => __( "%count% for total ads.", 'adforest' ),
			"param_name" => "section_title",
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Main Title", 'adforest' ),
			"param_name" => "sub_title",
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Button Text", 'adforest' ),
			"param_name" => "btn_text",
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Search Block Text", 'adforest' ),
			"param_name" => "block_text",
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Section Tagline", 'adforest' ),
			"param_name" => "section_description",
		),	
		
		array
		(
			'group' => __( 'Categories', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Select Category ( All or Selective )', 'adforest' ),
			'param_name' => 'cats',
			'value' => '',
			'params' => array
			(
				array(
					"type" => "dropdown",
					"heading" => __("Category", 'adforest') ,
					"param_name" => "cat",
					"admin_label" => true,
					"value" => adforest_cats(),
				),

			)
		),
		
		),
	));
}
}

add_action('vc_before_init', 'search_hero2_short');
if ( !function_exists ( 'search_hero2_short_base_func' ) ) {
function search_hero2_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'section_title' => '',
		'sub_title' => '',
		'section_description' => '',
		'btn_text' => '',
		'block_text' => '',
		'cats' => '',
	) , $atts));
	global $adforest_theme;

		$rows = vc_param_group_parse_atts( $atts['cats'] );
		$cats	=	false;
		$cats_html	=	'';
		if( count( $rows ) > 0 )
		{
			$cats_html .= '';
			foreach($rows as $row )
			{
				if( isset( $row['cat'] )  )
				{
					if($row['cat'] == 'all' )
					{
						$cats = true;
						$cats_html = '';
						break;
					}
					$term = get_term( $row['cat'], 'ad_cats' );
					$cats_html .= '<option value="'.$row['cat'].'">'.$term->name.'</option>';
				}
			}
			
			if( $cats )
			{
				$ad_cats = get_terms( 'ad_cats', array( 'hide_empty' => 0 ) );
				foreach( $ad_cats as $cat )
				{
					$cats_html .= '<option value="'.$cat->term_id.'">'.$cat->name.'</option>';
				}
			}
		}


$style = '';
if( $bg_img != "" )
{
$bgImageURL	=	adforest_returnImgSrc( $bg_img );
$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.') center top no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
}

adforest_load_search_countries();
wp_enqueue_script( 'google-map-callback');
$count_posts = wp_count_posts('ad_post');
$main_title = str_replace( '%count%', '<b>' .  $count_posts->publish . '</b>', $section_title);
return '<section id="intro-hero" '.$style.'>
  <div class="container">
    <div class="row">
          
      <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 margin-top-50">
        <h3 class="hero-title">'.$main_title.'</h3>
        <h2> '.$sub_title.' </h2>
        <p class="hero-tagline">
          '.$section_description.'
        </p>
        <div class="intro-btn">
          <a href="'.get_the_permalink( $adforest_theme['sb_post_ad_page'] ).'" class="btn btn-theme btn-round">'.$btn_text.'</a>
        </div>
      </div> <!-- END col-lg-6 hero-text--> 
      <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        <form class="form-join" action="'.get_the_permalink($adforest_theme['sb_search_page']).'">
          <h4>'.$block_text.'</h4>
        <div class="form-group">
           <label for="exampleInputEmail1">' . __('Title','adforest') . '</label>
            <input class="form-control" autocomplete="off" name="ad_title" placeholder="'.__('What Are You Looking For...','adforest').'" type="text"> 
         </div>
        <div class="form-group">
        <label for="exampleInputEmail1">' . __('Select Category','adforest') . '</label>
            <select class="category form-control" name="cat_id">
               <option label="'.__('Select Category','adforest').'" value="">'.__('Select Category','adforest').'</option>
               '.$cats_html.'
            </select>
        </div>
          <div class="form-group">
          <label for="exampleInputEmail1">' . __('Location','adforest') . '</label>
             <input class="form-control" name="location" id="sb_user_address" placeholder="'.__('Location...','adforest').'"  type="text"> 
          </div>
          <button class="btn btn-theme btn-block" type="submit" name="register">'.__('search','adforest').'</button>
          	
          </form>
      </div> <!-- END col-lg-5-->
      
    </div> <!-- END row-->
  </div> <!-- END container-->
</section>';

}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('search_hero2_short_base', 'search_hero2_short_base_func');
}