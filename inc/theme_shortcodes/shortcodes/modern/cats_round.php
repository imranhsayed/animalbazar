<?php
/* ------------------------------------------------ */
/* Ads */
/* ------------------------------------------------ */
if ( !function_exists ( 'cats_round_slider' ) ) {
function cats_round_slider()
{
	vc_map(array(
		"name" => __("Categories - Round", 'adforest') ,
		"base" => "cats_round_slider_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('cats_round.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
				__('Gray', 'adforest') => 'gray'
			) ,
			'edit_field_class' => 'vc_col-sm-12 vc_column',
			"std" => '',
			"description" => __("Select background color.", 'adforest'),
		),
		
		array(
			"group" => __("Basic", "adforest"),
			"type" => "attach_image",
			"holder" => "bg_img",
			"class" => "",
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
			

		//Group For Left Section
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

add_action('vc_before_init', 'cats_round_slider');

if ( !function_exists ( 'cats_round_slider_base_func' ) ) {
function cats_round_slider_base_func($atts, $content = '')
{
	$no_title = 'yes';
	$modern_slider	= 1;
require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";

	$cats_round_html = '';
	$rows = vc_param_group_parse_atts( $atts['cats_round'] );
	if( count( $rows ) > 0 )
	{
		foreach($rows as $row )
		{
			if( isset( $row['cat'] )  && isset( $row['cat'] ) )
			{
				$bgImageURL	=	adforest_returnImgSrc( $row['img'] );
				$term = get_term( $row['cat'], 'ad_cats' );
				$cats_round_html .= '<a href="'. adforest_cat_link_page($row['cat'], $cat_link_page).'">
						<span class="category_new"><img alt="'.$term->name.'" src="'.esc_url($bgImageURL).'" title="'.$term->name.'"></span>
						<span class="title">'.$term->name.'</span>
					</a>';
				
			}
		}
	}

return '<section class="custom-padding '.$bg_color.'">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Heading Area -->
                  '.$header.'
                  <!-- Middle Content Box -->
                   <div class="row">
                   <div class="category_gridz text-center">
                    '.$cats_round_html.'
                   </div> 
                     </div>
                  <!-- Middle Content Box End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>';

}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('cats_round_slider_base', 'cats_round_slider_base_func');
}