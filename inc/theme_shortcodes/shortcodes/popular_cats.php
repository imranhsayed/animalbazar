<?php
/* ------------------------------------------------ */
/* Popular Cats */
/* ------------------------------------------------ */
if ( !function_exists ( 'popular_cats_short' ) ) {
function popular_cats_short()
{
	vc_map(array(
		"name" => __("Popular - Categories", 'adforest') ,
		"base" => "popular_cats_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('popular_cats.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),	
		array(
			"group" => __("Basic", "adforest"),
			"type" => "attach_image",
			"holder" => "img",
			"heading" => __( "Background Image", 'adforest' ),
			"param_name" => "bg_img",
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

add_action('vc_before_init', 'popular_cats_short');
if ( !function_exists ( 'popular_cats_short_base_func' ) ) {
function popular_cats_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'section_title' => '',
		'section_description' => '',
		'cats' => '',
	) , $atts));
	global $adforest_theme;
	
		$rows = vc_param_group_parse_atts( $atts['cats'] );
		$categories_html	=	'';
		if( count( $rows ) > 0 )
		{
			$categories_html .= '<ul class="nav nav-tabs">';
			foreach($rows as $row )
			{
				if( isset( $row['cat'] ) && isset( $row['icon'] )  )
				{
					$term = get_term( $row['cat'], 'ad_cats' );
					$categories_html .= '<li class="clearfix">
                     <a href="'. get_the_permalink($adforest_theme['sb_search_page']).'?cat_id='.$row['cat'].'"> <i class="'.esc_attr($row['icon']).'"></i> <span class="hidden-xs">'.$term->name.'</span></a>
                  </li>';
					
				}
			}
			$categories_html .= '</ul>';
		}
$style = '';
if( $bg_img != "" )
{
$bgImageURL	=	adforest_returnImgSrc( $bg_img );
$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.') center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
}
return '<section id="hero" class="hero" '. $style . '>
         <div class="content">
            <p>'.adforest_color_text($section_title ).'</p>
            <h1>'.esc_html( $section_description).'</h1>
            <div class="search-holder">
			'.$categories_html.'
            </div>
         </div>
      </section>
';

}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('popular_cats_short_base', 'popular_cats_short_base_func');
}