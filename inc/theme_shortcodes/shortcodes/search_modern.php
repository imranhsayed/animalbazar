<?php
/* ------------------------------------------------ */
/* Search Modern */
/* ------------------------------------------------ */
if ( !function_exists ( 'search_modern_short' ) ) {
function search_modern_short()
{
	vc_map(array(
		"name" => __("Search - Modern", 'adforest') ,
		"base" => "search_modern_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('search-modern.png').__( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Section Tagline", 'adforest' ),
			"description" => __( "%count% for total ads.", 'adforest' ),
			"param_name" => "section_tag_line",
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Search Place holder", 'adforest' ),
			"param_name" => "m_search_placeholder",
		),	
		array(
			"group" => __("Basic", "'adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Search Place holder", 'adforest' ),
			"param_name" => "m_location_placeholder",
		),	
		
			array(
				"group" => __("Basic", "'adforest"),
				"type" => "dropdown",
				"heading" => __("Display tags?", 'adforest') ,
				"param_name" => "is_display_tags",
				"admin_label" => true,
				"value" => array(
				__('Select Option', 'adforest') => '',
				__('Yes', 'adforest') => '1',
				__('No', 'adforest') => '0'
				) ,
			),
			array(
				"group" => __("Basic", "'adforest"),
				"type" => "dropdown",
				"heading" => __("Max number of tags", 'adforest') ,
				"param_name" => "max_tags_limit",
				"admin_label" => true,
				"value" => range( 1, 50 ),
				'dependency' => array(
				'element' => 'is_display_tags',
				'value' => array('1'),
				) ,
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

add_action('vc_before_init', 'search_modern_short');
if ( !function_exists ( 'search_modern_short_base_func' ) ) {
function search_modern_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'section_title' => '',
		'section_tag_line' => '',
		'm_search_placeholder' => '',
		'm_location_placeholder' => '',
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
$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.')  no-repeat scroll center center / cover ;"' : "";
}
$tags = '';
if( $is_display_tags == 1 )
{
	$tags = '<div class="hero-form-sub">
                  <strong class="hidden-sm-down">'.__('Popular Tags','adforest').'</strong>';
$args = array(
	'smallest'                  => 12, 
	'largest'                   => 12,
	'unit'                      => 'px', 
	'number'                    => $max_tags_limit,  
	'format'                    => 'list',
	'separator'                 => "\n",
	'orderby'                   => 'name', 
	'order'                     => 'ASC',
	'link'                      => 'view', 
	'taxonomy'                  => 'ad_tags', 
	'echo'                      => false,
);
$tags	.=	wp_tag_cloud( $args );
$tags	.=	'</div>';
}
adforest_load_search_countries();
wp_enqueue_script( 'google-map-callback');
$count_posts = wp_count_posts('ad_post');

$search_placeholder	=	__('Search here...','adforest');
if( isset($m_search_placeholder) && $m_search_placeholder != "" )
{
	$search_placeholder	=	$m_search_placeholder;	
}

$location_placeholder	=	__('Location...','adforest');
if( isset($m_location_placeholder) && $m_location_placeholder != "" )
{
	$location_placeholder	=	$m_location_placeholder;	
}

return  ' <section class="main-search parallex " '.$style.'>
<div class="container">
      <div class="row">
      <div class="col-md-12">
         <div class="main-search-title">
            <h1>'.esc_html($section_title).'</h1>
            <p>'.str_replace( '%count%', '<strong>'.$count_posts->publish.'</strong>', $section_tag_line).'</p>
         </div>
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
                     <input type="text" name="location" id="sb_user_address" placeholder="'.esc_attr($location_placeholder).'">
                  </li>
                  <li>
                     <button type="submit" class="btn btn-danger btn-lg btn-block">'.__('Search','adforest').'</button>
                  </li>
               </ul>
              '.$tags.'
            </div>
         </div>
		 </form>
         </div>
         </div>
       </div>
      
      </section>
							  ';
}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('search_modern_short_base', 'search_modern_short_base_func');
}