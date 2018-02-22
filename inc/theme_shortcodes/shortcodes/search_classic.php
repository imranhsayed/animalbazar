<?php
/* ------------------------------------------------ */
/* Search Classic */
/* ------------------------------------------------ */
if ( !function_exists ( 'search_classic_short' ) ) {
function search_classic_short()
{
	vc_map(array(
		"name" => __("Search - Classic", 'adforest') ,
		"base" => "search_classic_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('search-classic.png').__( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
		// Android
			
			
		),
	));
}
}

add_action('vc_before_init', 'search_classic_short');
if ( !function_exists ( 'search_classic_short_base_func' ) ) {
function search_classic_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'section_title' => '',
		'section_tag_line' => '',
		'max_tags_limit' => '',
		'is_display_tags' => '',
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
$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.') fixed center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
}
adforest_load_search_countries();
wp_enqueue_script( 'google-map-callback');

return '<div id="banner" '.$style.'>
         <div class="container">
            <div class="search-container">
               <h2>'.esc_html($section_title).'</h2>
               <form method="get" action="'.get_the_permalink($adforest_theme['sb_search_page']).'">
                  <div class="col-md-4 col-sm-6 col-xs-12 no-padding">
                     <div class="form-group">
                        <input type="text" autocomplete="off" name="ad_title" placeholder="'.__('Search here...','adforest').'" class="form-control banner-icon-search"> 
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12 no-padding">
                     <div class="form-group">
                        <input type="text" class="form-control" name="location" id="sb_user_address" placeholder="'.__('Location...','adforest').'">
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-9 col-xs-12 no-padding">
                     <div class="form-group">
                        <select class="category form-control" name="cat_id">
							<option label="'.__('Select Category','adforest').'" value="">'.__('Select Category','adforest').'</option>
				  		'.$cats_html.'
                        </select>
                     </div>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-12 no-padding">
                     <div class="form-group form-action">
                        <button type="submit" class="btn btn-theme btn-search-submit">'.__('Search','adforest').'</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>';

}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('search_classic_short_base', 'search_classic_short_base_func');
}