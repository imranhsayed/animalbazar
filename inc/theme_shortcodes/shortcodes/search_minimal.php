<?php
/* ------------------------------------------------ */
/* Search Minimal */
/* ------------------------------------------------ */
if ( !function_exists ( 'search_minimal_short' ) ) {
function search_minimal_short()
{
	vc_map(array(
		"name" => __("Search - Minimal", 'adforest') ,
		"base" => "search_minimal_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('search-minimal.png').__( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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

add_action('vc_before_init', 'search_minimal_short');
if ( !function_exists ( 'search_minimal_short_base_func' ) ) {
function search_minimal_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
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

	
	
adforest_load_search_countries();
wp_enqueue_script( 'google-map-callback');

return '<div id="search-section">
         <div class="container">
            <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
				  <form method="get" action="'.get_the_permalink($adforest_theme['sb_search_page']).'" class="search-form">
				  	<!-- Search By Location Field -->
                     <div class="col-md-3 col-xs-12 col-sm-4 no-padding ad-location-search-input">
                        <input type="text" autocomplete="off" name="ad_location" class="form-control" placeholder="'.__('Search by City...','adforest').'" />
                     </div>
                     <!-- Search Field -->
                     <div class="col-md-4 col-xs-12 col-sm-4 no-padding">
                        <input type="text" autocomplete="off" name="ad_title" class="form-control" placeholder="'.__('What Are You Looking For...','adforest').'" />
                     </div>
                     <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                        <button type="submit" class="btn btn-block btn-light">'.__('Search','adforest').'</button>
                     </div>
                  </form>
                  </div>
               </div>
         </div>
      </div>';

}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('search_minimal_short_base', 'search_minimal_short_base_func');
}