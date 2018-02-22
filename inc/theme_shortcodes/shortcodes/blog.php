<?php
/* ------------------------------------------------ */
/* Blog */
/* ------------------------------------------------ */
if ( !function_exists ( 'blog_short' ) ) {
function blog_short()
{
	vc_map(array(
		"name" => __("Blog Posts", 'adforest') ,
		"base" => "blog_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' =>adforest_VCImage('blog.png') .  __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
				"description" =>  __('For color ', 'adforest') . '<strong>' . '<strong>' . esc_html('{color}') . '</strong>' . '</strong>' . __('warp text within this tag', 'adforest') . '<strong>' . esc_html('{/color}') . '</strong>',
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
			"heading" => __("Number fo Ads", 'adforest') ,
			"param_name" => "max_limit",
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
					"value" => adforest_cats('category','no'),
				),
			)
		),
								
		),
	));
}
}

add_action('vc_before_init', 'blog_short');
if ( !function_exists ( 'blog_short_base_func' ) ) {
function blog_short_base_func($atts, $content = '')
{
require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
		$cats =	array();
		$rows = vc_param_group_parse_atts( $atts['cats'] );
		$is_all	=	false;
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['cat'] ) )
				{
					if( $row['cat'] != 'all' )
					{
						$cats[]	=	$row['cat'];
					}
				}
			}
		}
		
	$args = array( 
		'post_type' => 'post',
		'posts_per_page' => $max_limit,
		'post_status' => 'publish',
		'category__in' => $cats,
		'orderby'        => 'ID',
		'order'   => 'DESC',
		

	);
	$posts = new WP_Query( $args );
	$html	=	'';
	if ( $posts->have_posts() )
	{
		$count = 1;
		while( $posts->have_posts() )
		{
			$posts->the_post();
			$pid	=	get_the_ID();
			
			$image	= wp_get_attachment_image_src( get_post_thumbnail_id( $pid ), 'adforest-category' );
			$img_header	= '';
			if( $image[0] != "" )
			{
				$img_header	=	'<div class="post-img">
                                 <a href="'.get_the_permalink().'">
								 <img class="img-responsive" alt="'.get_the_title().'" src="'.esc_url( $image[0] ).'">
								 </a>
                              </div>';
			}
			
			$html .= '<div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="blog-post">
                              	'.$img_header.'
                              <div class="post-info">
							  <a href="javascript:void(0);">'.get_the_date( get_option( 'date_format' ), $pid ).'</a>
							  <a href="javascript:void(0);">'.get_comments_number() . ' ' . __('comments', 'adforest' ) .'</a>
							  </div>
                              <h3 class="post-title">
							  <a href="'.get_the_permalink().'">'.get_the_title().'</a> </h3>
                              <p class="post-excerpt"> '.adforest_words_count(get_the_excerpt(), 140).'</p>
                           </div>
                        </div>';
			if($count % 3 == 0){ $html .= '<div class="clearfix"></div>';}else{$html .= '';}
			$count++;
			
		}		
	}
	$parallex	=	'';
	if( $section_bg == 'img' )
	{
		$parallex	=	'parallex';
	}
return '<section class="custom-padding '.$parallex.' '.$bg_color.'" ' . $style .'>
            <!-- Main Container -->
            <div class="container">
               <div class="row">
			   '.$header.'
			   <div class="col-md-12 col-xs-12 col-sm-12">
               <div class="row">
			   		'.$html.'
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
	adforest_add_code('blog_short_base', 'blog_short_base_func');
}