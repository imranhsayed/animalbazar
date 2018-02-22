<?php
/* ------------------------------------------------ */
/* Search Modern */
/* ------------------------------------------------ */
if ( !function_exists ( 'grid_modern_type_short' ) ) {
function grid_modern_type_short()
{
	vc_map(array(
		"name" => __("Grid - Modern", 'adforest') ,
		"base" => "grid_modern_type_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('grid_modern.png').__( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Category Section Title", 'adforest' ),
			"param_name" => "cat_section_title",
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Ads Section Title", 'adforest' ),
			"param_name" => "ads_section_title",
		),	
		
		array(
			"group" => __("Ads Settings", "'adforest"),
			"type" => "dropdown",
			"heading" => __("Ads Type", 'adforest') ,
			"param_name" => "ad_type",
			"admin_label" => true,
			"value" => array(
			__('Select Ads Type', 'adforest') => '',
			__('Featured Ads', 'adforest') => 'feature',
			__('Simple Ads', 'adforest') => 'regular',
			__('Both', 'adforest') => 'both'
			) ,
		),
		array(
			"group" => __("Ads Settings", "'adforest"),
			"type" => "dropdown",
			"heading" => __("Order By", 'adforest') ,
			"param_name" => "ad_order",
			"admin_label" => true,
			"value" => array(
			__('Select Ads order', 'adforest') => '',
			__('Oldest', 'adforest') => 'asc',
			__('Latest', 'adforest') => 'desc',
			__('Random', 'adforest') => 'rand'
			) ,
		),
		array(
			"group" => __("Ads Settings", "'adforest"),
			"type" => "dropdown",
			"heading" => __("Number fo Ads to display", 'adforest') ,
			"param_name" => "no_of_ads",
			"admin_label" => true,
			"value" => range( 1, 50 ),
		),
			array(
				"group" => __("Ads Settings", "'adforest"),
				"type" => "vc_link",
				"heading" => __( "View all button link", 'adforest' ),
				"param_name" => "view_all",
			),
		
		
		array
		(
			'group' => __( 'Categories for ads', 'adforest' ),
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
					"value" => adforest_cats('ad_cats', 'no'),
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

add_action('vc_before_init', 'grid_modern_type_short');
if ( !function_exists ( 'grid_modern_type_short_base_func' ) ) {
function grid_modern_type_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'cat_section_title' => '',
		'cat_link_page' => '',
		'ads_section_title' => '',
		'cats' => '',
		'cats_round' => '',
		'ad_type' => '',
		'ad_order' => '',
		'no_of_ads' => '',
		'view_all' => '',
	) , $atts));
	global $adforest_theme;

		$rows = vc_param_group_parse_atts($atts['cats'] );
		$cats	=	false;
		$cats_array	=	array();
		$ads_html	=	'';
		$ads = new ads();
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['cat'] )  )
				{
					
					if( $row['cat'] != 'all' )
					{
						$cats_array[]	=	$row['cat'];
					}

				}
			}
		}
	if( count( $cats_array ) > 0 )
	{
		$category	=	array(
			array(
			'taxonomy' => 'ad_cats',
			'field'    => 'term_id',
			'terms'    => $cats_array,
			),
		);	
	}
	
	
	$is_feature	=	'';
	if( $ad_type == 'feature' )
	{
		$is_feature	=	array(
			'key'     => '_adforest_is_feature',
			'value'   => 1,
			'compare' => '=',
		);		
	}
	else if( $ad_type == 'both' )
	{
		$is_feature	=	'';
	}
	else
	{
		$is_feature	=	array(
			'key'     => '_adforest_is_feature',
			'value'   => 0,
			'compare' => '=',
		);		
	}
	$is_active	=	array(
		'key'     => '_adforest_ad_status_',
		'value'   => 'active',
		'compare' => '=',
	);		
	
	$ordering	=	'DESC';
	$order_by	=	'ID';
	if( $ad_order == 'asc' )
	{
		$ordering	=	'ASC';
	}
	else if( $ad_order == 'desc' )
	{
		$ordering	=	'DESC';
	}
	else if( $ad_order == 'rand' )
	{
		$order_by	=	'rand';
	}

	
	$args = array( 
		'post_type' => 'ad_post',
		'posts_per_page' => $no_of_ads,
		'meta_query' => array(
			$is_feature,
			$is_active,
		),
		'tax_query' => array(
			$category,
		),
		'orderby'        => $order_by,
		'order'        => $ordering,

	);
$results = new WP_Query( $args );
if ( $results->have_posts() )
{
	while( $results->have_posts() )
	{
		$results->the_post();
		$function	=	"adforest_search_layout_list_2";
		$ads_html	.= $ads->$function( get_the_ID(), false );
		
	}
	
}


		
		$cats_round_html = '';
		$rows = vc_param_group_parse_atts( $atts['cats_round'] );
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['cat'] )  && $row['cat'] != "" && isset( $row['img'] ) && $row['img'] != "" )
				{
					$term = get_term( $row['cat'], 'ad_cats' );
					$bgImageURL	=	adforest_returnImgSrc( $row['img'] );
					$cats_round_html .= '<a href="'. adforest_cat_link_page($row['cat'], $cat_link_page).'">
                            <span class="category_new"><img alt="'.$term->name.'" src="'.esc_url($bgImageURL).'" title="'.$term->name.'"></span><span class="title">'.$term->name.'</span></a>';
				}
			}
		}

ob_start();
dynamic_sidebar('sb_themes_grid_sidebar');
$sidebar = ob_get_contents();
ob_end_clean();	

	
	
return '<section class="grid-section gray">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <div class="col-md-8 col-sm-12 col-xs-12">
                     <!-- Row -->
                     <div class="grid-card">
                         <div class="col-md-12">
                            <div class="heading-panel">
                               <h3 class="main-title text-left">
                                  '.$cat_section_title.'
                               </h3>
                            </div>
							<div class="category_gridz small-size">
							'.$cats_round_html.'
							</div>
                        
                        </div>       
                        
                     </div>
                     <!-- Row End -->
                      <!-- Row -->
                     <div class="grid-card">
                         <div class="col-md-12">
                            <div class="heading-panel">
                               <h3 class="main-title text-left">
                                  '.$ads_section_title.'
                               </h3>
                            </div>
							'.$ads_html.'
							<div class="clearfix"></div>
										   			<div class="text-center">
                     <div class="load-more-btn">
					 '. adforest_ThemeBtn($view_all, 'btn btn-theme btn-block btn-white', false).'
                     </div>
 </div>

							 </div>   
							    
                     </div>
					 
                     <!-- Row End -->
                  </div>
				  <div class="col-md-4 col-sm-12 col-xs-12 blog-sidebar">
				  '.$sidebar.'
				  </div>
                  <!-- Middle Content Area  End -->
				  
               </div>
               <!-- Row End -->

            </div>
            <!-- Main Container End -->
         </section>';

}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('grid_modern_type_short_base', 'grid_modern_type_short_base_func');
}