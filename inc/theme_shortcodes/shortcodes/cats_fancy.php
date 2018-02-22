<?php
/* ------------------------------------------------ */
/* Cats Fancy */
/* ------------------------------------------------ */
if ( !function_exists ( 'cats_fancy_short' ) ) {
function cats_fancy_short()
{
	vc_map(array(
		"name" => __("Categories - Fancy", 'adforest') ,
		"base" => "cats_fancy_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('cat-fancy.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
				"group" => __("Basic", "adforest"),
				"type" => "attach_image",
				"holder" => "img",
				"heading" => __( "Category Image", 'adforest' ),
				"param_name" => "img",
				"description" => __('94x90', 'adforest'),
				),

			)
		),
								
		),
	));
}
}

add_action('vc_before_init', 'cats_fancy_short');
if ( !function_exists ( 'cats_fancy_short_base_func' ) ) {
function cats_fancy_short_base_func($atts, $content = '')
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
				if( isset( $row['cat'] ) && isset( $row['img'] ) )
				{
					$category = get_term($row['cat']);
					if( count( $category ) == 0 )
						continue;
					$count = $category->count;
					$bgImageURL	=	adforest_returnImgSrc( $row['img'] );
					
					
					$categories_html .= '<div class="col-md-3 col-sm-6">
                     <div class="box">
                         <img alt="'.$category->name.'" src="'.$bgImageURL.'">
                        <h4><a href="'. adforest_cat_link_page($row['cat'], $cat_link_page) .'">
						'.$category->name.'
						</a></h4>
                        <strong>'.$count. ' ' . __('Ads', 'adforest' ) .'</strong> 
                     </div>
                  </div>';
					

				}
			}
		}
	}

return '<section class="custom-padding categories '.$bg_color.'" ' . $style .'>
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
			   		'.$header.'
					'.$categories_html.'
			   </div>
            </div>
         </section>
	
';


}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('cats_fancy_short_base', 'cats_fancy_short_base_func');
}