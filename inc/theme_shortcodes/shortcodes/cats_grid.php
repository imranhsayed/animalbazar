<?php
/* ------------------------------------------------ */
/* Cats Grid */
/* ------------------------------------------------ */
if ( !function_exists ( 'cats_grid_short' ) ) {
function cats_grid_short()
{
	vc_map(array(
		"name" => __("Categories - Grid", 'adforest') ,
		"base" => "cats_grid_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('cat-grid.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
			"type" => "dropdown",
			"heading" => __("Background Color", 'adforest') ,
			"param_name" => "section_bg",
			"admin_label" => true,
			"value" => array(
				__('Select Background Color', 'adforest') => '',
				__('White', 'adforest') => '',
				__('Gray', 'adforest') => 'gray',
				__('Image', 'adforest') => 'img'
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
				"class" => "",
				"heading" => __( "Section Description", 'adforest' ),
				"param_name" => "section_description",
				"value" => "",
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'dependency' => array(
				'element' => 'header_style',
				'value' => array('classic'),
				) ,
			),
			array(
				"group" => __("Basic", "'adforest"),
				"type" => "dropdown",
				"heading" => __("Sub cats limit", 'adforest') ,
				"param_name" => "sub_limit",
				"admin_label" => true,
				"value" => range( 0, 50 ),
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

add_action('vc_before_init', 'cats_grid_short');
if ( !function_exists ( 'cats_grid_short_base_func' ) ) {
function cats_grid_short_base_func($atts, $content = '')
{
	global $adforest_theme;
	$bg_bootom	=	'yes';
	require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
		$rows = vc_param_group_parse_atts( $atts['cats'] );
		$categories_html	=	'';
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['cat'] ) && isset( $row['icon'] )  )
				{
					$category = get_term($row['cat']);
					if( count( $category ) == 0 )
						continue;
					$count = $category->count;
					
					$sub_cat_html	=	'';
					$ad_sub_cats	=	adforest_get_cats('ad_cats' , $row['cat'] );
					$i = 1;
					if( $sub_limit != 0 )
					{
					foreach( $ad_sub_cats as $sub_cat )
					{
						if( $i < $sub_limit )
						{
							$sub_cat_html	.= '<a href="'. adforest_cat_link_page($sub_cat->term_id, $cat_link_page).'">'.$sub_cat->name.'</a>, ';
						}
						else if( $i == $sub_limit)
						{
							$sub_cat_html	.= '<a href="'. adforest_cat_link_page($sub_cat->term_id, $cat_link_page) .'">'.$sub_cat->name.'</a>';
							break;
						}
						
						$i++;
					}
					}
					
					$categories_html .= '<div class="custom-cat">
                            <i class="'.$row['icon'].'"></i>
                            <h6><a href="'. adforest_cat_link_page($row['cat'], $cat_link_page).'">'.$category->name.'</a></h6>
                            <p>'.$sub_cat_html.'</p>
                         </div>';
					
					/*$categories_html .= '<a href="'. get_the_permalink($adforest_theme['sb_search_page']).'?cat_id='.$row['cat'].'">
                            <i class="'.$row['icon'].'"></i>
                            <h6>'.$category->name.'</h6>
                            <p>'.$sub_cat_html.'</p>
                         </a>';
					*/
				}
			}
		}

return '<section class="custom-padding categories '.$bg_color.'" ' . $style .'>
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
			   		'.$header.'
			   <div class="col-md-12 col-xs-12 col-sm-12">
			   		<div class="category-grid">
					'.$categories_html.'
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
	adforest_add_code('cats_grid_short_base', 'cats_grid_short_base_func');
}