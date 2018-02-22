<?php
/* ------------------------------------------------ */
/* Search Modern */
/* ------------------------------------------------ */
if ( !function_exists ( 'search_modern_type_short' ) ) {
function search_modern_type_short()
{
	vc_map(array(
		"name" => __("Search - Modern(New)", 'adforest') ,
		"base" => "search_modern_type_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('search_modern_new.png').__( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "dropdown",
			"heading" => __("Category link Page", 'adforest') ,
			"param_name" => "cat_link_page",
			"admin_label" => true,
			"value" => array(
			__('Search Page', 'adforest') => 'search',
			__('Category Page', 'adforest') => 'category',
			) ,
			'edit_field_class' => 'vc_col-sm-12 vc_column',
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
		
		
		array
		(
			'group' => __( 'Dropdown Categories', 'adforest' ),
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
		
		
				array
		(
			'group' => __( 'Categories', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Select Category', 'adforest' ),
			'param_name' => 'cats_round',
			'value' => '',
			'params' => array
			(
				array(
					"type" => "dropdown",
					"heading" => __("Category", 'adforest') ,
					"param_name" => "cat",
					"admin_label" => true,
					"value" => adforest_cats('ad_cats','no'),
				),
				array(
				"group" => __("Basic", "adforest"),
				"type" => "attach_image",
				"holder" => "img",
				"heading" => __( "Category Image", 'adforest' ),
				"param_name" => "img",
				"description" => __('100x100', 'adforest'),
				),

			)
		),
		),
	));
}
}

add_action('vc_before_init', 'search_modern_type_short');
if ( !function_exists ( 'search_modern_type_short_base_func' ) ) {
function search_modern_type_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'cat_link_page' => '',
		'section_title' => '',
		'cats' => '',
		'cats_round' => '',
	) , $atts));
	global $adforest_theme;

		$rows = vc_param_group_parse_atts($atts['cats'] );
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
		
		$cats_round_html = '';
		$rows = vc_param_group_parse_atts( $atts['cats_round'] );
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['cat'] )  && isset( $row['cat'] ) )
				{
					$term = get_term( $row['cat'], 'ad_cats' );
					$bgImageURL	=	adforest_returnImgSrc( $row['img'] );
					$cats_round_html .= '<div class="c-icon"> <a href="'. adforest_cat_link_page($row['cat'], $cat_link_page).'" class="hover"><img alt="'.$term->name.'" src="'.esc_url($bgImageURL).'" title="'.$term->name.'" width="100" height="100"></a> </div>';
				}
			}
		}

		

	
	
$style = '';
if( $bg_img != "" )
{
$bgImageURL	=	adforest_returnImgSrc( $bg_img );
$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.')  no-repeat scroll center center / cover ;"' : "";
}


$search_placeholder	=	__('Search...','adforest');
$count_posts = wp_count_posts('ad_post');
$main_title = str_replace( '%count%', '<b>' .  $count_posts->publish . '</b>', $section_title);
return '<div class="modern_sample" '.$style.'>
          <div class="container">
                <div class="content">
                    <h1 class="tx-smooth">'.$main_title.'</h1>
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
	adforest_add_code('search_modern_type_short_base', 'search_modern_type_short_base_func');
}