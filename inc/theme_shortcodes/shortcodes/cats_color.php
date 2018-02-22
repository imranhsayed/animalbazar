<?php
/* ------------------------------------------------ */
/* Cats Color */
/* ------------------------------------------------ */
if ( !function_exists ( 'cats_color_short' ) ) {
function cats_color_short()
{
	vc_map(array(
		"name" => __("Categories - Color", 'adforest') ,
		"base" => "cats_color_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('cat-color.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
			"type" => "dropdown",
			"heading" => __("Sub cats limit", 'adforest') ,
			"param_name" => "sub_limit",
			"admin_label" => true,
			"value" => range( 1, 50 ),
		),
		array
		(
			'group' => __( 'Categories', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Select Category', 'adforest' ),
			'param_name' => 'cats',
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
				 'type' => 'iconpicker',
				 'heading' => __( 'Icon', 'adforest' ),
				 'param_name' => 'icon',
				 'settings' => array(
				 'emptyIcon' => false,
				 'type' => 'classified',
				 'iconsPerPage' => 100, // default 100, how many icons per/page to display
				   ),
			  ),

			)
		),
								
		),
	));
}
}

add_action('vc_before_init', 'cats_color_short');
if ( !function_exists ( 'cats_color_short_base_func' ) ) {
function cats_color_short_base_func($atts, $content = '')
{
	global $adforest_theme;
	$bg_bootom	=	'yes';
	require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";	
	$categories_html	=	'';
	if( isset( $atts['cats'] ) )
	{
		$rows = vc_param_group_parse_atts( $atts['cats'] );
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['cat'] ) && isset( $row['icon'] ) )
				{
					$category = get_term($row['cat']);
					if( count( $category ) == 0 )
						continue;
					$count = $category->count;
					
					$sub_cat_html	=	'';
					$ad_sub_cats	=	adforest_get_cats('ad_cats' , $row['cat'] );
					$i = 1;
					foreach( $ad_sub_cats as $sub_cat )
					{
						if( $i < $sub_limit )
						{
							$sub_cat_html	.= '<a href="'. adforest_cat_link_page($sub_cat->term_id, $cat_link_page) .'">'.$sub_cat->name.'</a>, ';
						}
						else if( $i == $sub_limit)
						{
							$sub_cat_html	.= '<a href="'. adforest_cat_link_page($sub_cat->term_id, $cat_link_page) .'">'.$sub_cat->name.'</a>';
							break;
						}
						
						$i++;
					}
					
						 $categories_html .= '<div class="item">
                  <!-- Category Banner -->
                  <div class="category-grid-5">
                     <!-- Category Icon -->
                     <div class="category-grid-5-icon"> <i class="'.$row['icon'].'"></i> </div>
                     <!-- Category Title -->
                     <div class="cat-5-title">
                        <h2>
                           <a href="'. adforest_cat_link_page($row['cat'], $cat_link_page) .'">'.$category->name.'</a>
                        </h2>
                     </div>
                     <!-- Category Ad Count -->
                     <div class="cat-5-count">'.$count. ' ' . __('ads', 'adforest' ) . '</div>
                     <!-- Popular Keywords -->
                     <div class="cat-5-popular">
                        <p>'.$sub_cat_html.'</p>
                     </div>
                     <a href="'. adforest_cat_link_page($row['cat'], $cat_link_page) .'" class="btn btn-lg btn-clean">'.__('View All', 'adforest' ) .'</a> 
                  </div>
               </div>';
					
				}
			}
		}
	}
		
return '<div class="home-category-slider">
         <div class="container-fluid no-padding">
            <div class="category-slider">
				'.$categories_html.'
            </div>
         </div>
      </div>
';


}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('cats_color_short_base', 'cats_color_short_base_func');
}