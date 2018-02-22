<?php
/* ------------------------------------------------ */
/* Ads- in Google Map */
/* ------------------------------------------------ */
if ( !function_exists ( 'ads_google_map_short_modern' ) ) {
function ads_google_map_short_modern()
{
	vc_map(array(
		"name" => __("ADs - Google Map Modern", 'adforest') ,
		"base" => "ads_google_map_short_modern_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('modern_map.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
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
			"type" => "attach_image",
			"holder" => "bg_img",
			"class" => "",
			"heading" => __( "Map Marker", 'adforest' ),
			"param_name" => "map_marker_img",
			"description" => __("50x77", 'adforest'),
		),
		array(
			"group" => __("Map", "'adforest"),
			"type" => "textfield",
			"heading" => __("Latitude", 'adforest') ,
			"description" => __("That Area will be display in map after loading but user can change it by dragging.", 'adforest') ,
			"param_name" => "map_latitude",
		),
		array(
			"group" => __("Map", "'adforest"),
			"type" => "textfield",
			"heading" => __("Longitude", 'adforest') ,
			"param_name" => "map_longitude",
		),
		array(
			"group" => __("Ads Settings", "'adforest"),
			"type" => "dropdown",
			"heading" => __("Number fo Ads for each category", 'adforest') ,
			"param_name" => "no_of_ads",
			"admin_label" => true,
			"value" => range( 1, 50 ),
		),
		//Group For Left Section
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
					"value" => adforest_cats('ad_cats', 'no'),
				),
			)
		),
								
		),
	));
}
}

add_action('vc_before_init', 'ads_google_map_short_modern');
if ( !function_exists ( 'ads_google_map_short_modern_base_func' ) ) {
function ads_google_map_short_modern_base_func($atts, $content = '')
{
	global $adforest_theme;
	extract(shortcode_atts(array(
		'cats' => '',
		'ad_type' => '',
		'ad_order' => '',
		'no_of_ads' => '',
		'map_latitude' => '',
		'map_longitude' => '',
		'map_marker_img' => '',
		
	) , $atts));
	
	
					$marker	= trailingslashit( get_template_directory_uri () ) . 'images/car-marker.png';
					$close_url	= trailingslashit( get_template_directory_uri () ) . 'images/close.gif';
					if( $map_marker_img != "" )
					{
						$img1 = wp_get_attachment_image_src($map_marker_img, 'full');
						$marker = $img1[0];
					}
					$map_script = '<script> var imageUrl = "'.$marker.'";
					var search_map_lat	=	"'.$map_latitude.'";
					var search_map_long	=	"'.$map_longitude.'";
					var close_url	=	"'.$close_url.'";
         			var locations = [';
	
		$rows = vc_param_group_parse_atts( $atts['cats'] );
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['cat'] ) )
				{
					
					
	$category	=	array(
		array(
		'taxonomy' => 'ad_cats',
		'field'    => 'term_id',
		'terms'    => $row['cat'],
		),
	);	
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
		'post_status ' => 'publish',
		'posts_per_page' => $no_of_ads,
		'meta_query' => array(
			$is_feature,
			array(
				'key'     => '_adforest_ad_status_',
				'value'   => 'active',
				'compare' => '=',
			),
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
	$marker_counter	=	1;
	while( $results->have_posts() )
	{
		$results->the_post();
		$pid	=	get_the_ID();

		if( isset( $map_script ) && $map_script != "" )
		{
			$title = get_the_title();
			$img	=	'';
			$media	=	 adforest_get_ad_images($pid);
			if( count( $media ) > 0 )
			{
				foreach( $media as $m )
				{
					$mid	=	'';
					if ( isset( $m->ID ) )
						$mid	= 	$m->ID;
					else
						$mid	=	$m;
						
					$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
					$img = $image[0];
					break;
				}
		
			}
			else
			{
				$img = $adforest_theme['default_related_image']['url'];
			}
			$price = strip_tags( adforest_adPrice(get_the_ID()) );
			$location = get_post_meta(get_the_ID(), '_adforest_ad_location', true );
			$p_date	=	get_the_date(get_option( 'date_format' ), get_the_ID() );
			$ad_class	=	'';
			$is_feature	=	get_the_date(get_option( '_adforest_is_feature' ), get_the_ID() );
			if( $is_feature )
			{
				$ad_class	=	__('Featured','adforest');
			}
			
			$post_categories = wp_get_object_terms( $pid,  array('ad_cats'), array('orderby' => 'term_group') );
			$cat_name	=	'';
			$cat_link	=	'';
			foreach($post_categories as $current_cat )
			{
				$cat = get_term( $current_cat );
				$cat_name	=	$cat->name;
				$cat_link	=	get_term_link( $cat->term_id );
			}
			$lat  = '';
			$lon  = '';
			if( get_post_meta($pid, '_adforest_ad_map_lat', true ) != "" && get_post_meta($pid, '_adforest_ad_map_long', true ) != "" )
			{
				$lat	=	get_post_meta($pid, '_adforest_ad_map_lat', true );
				$lon	=	get_post_meta($pid, '_adforest_ad_map_long', true );
			}
			else
			{
				if( $location != "" )
				{
					global $wpdb;
					$table_name = $wpdb->prefix . 'adforest_locations';
					$loc_arr	=	explode( ',', $location );
					if( count( $loc_arr ) > 0 )
					{
						$city = $loc_arr[0];
						$is_city = $wpdb->get_row( "SELECT latitude, longitude FROM $table_name WHERE location_type = 'city'  AND name = '$city'" );
						if( isset( $is_city->latitude ) )
						{
							$lat = $is_city->latitude;
							$lon = $is_city->longitude;
						}
					}
					
				}
			}
			if( $lat != "" && $lon != "" )
			{
				$lat_arr	=	explode('.', $lat );
				$lat	=	$lat_arr[0] . '.' . ($lat_arr[1] + mt_rand(1000,5000));
				
				$lon_arr	=	explode('.', $lon );
				$lon	=	$lon_arr[0] . '.' . ($lon_arr[1] + mt_rand(1000,5000));
			$map_script .= "[ '<div class=category-grid-box><div class=featured-ribbon><span>$ad_class</span></div><div class=category-grid-img><img alt=$title src=$img class=img-responsive></div><div class=short-description clearfix><div class=category-title> <span><a href=$cat_link>$cat_name</a></span> </div><h3><a href=".get_the_permalink($pid).">" . $title . "</a></h3><div class=price><span>" . $price . " </span></div></div><div class=ad-info><ul><li><i class=fa fa-map-marker></i>" . $location . "</li></ul></div></div>','$lat', '$lon', '$marker_counter', imageUrl],";
			
			$marker_counter++;
			}
		}
	}
}



				}
			}
		}
		$map_script .= "];</script>";
		
wp_reset_postdata();
if( $adforest_theme['gmap_api_key'] != "" )
{
/* Only need on this page so inluded here don't want to increase page size for optimizaion by adding extra scripts in all the web */
	wp_enqueue_script( 'google-map' );
	wp_enqueue_script( 'infobox', trailingslashit( get_template_directory_uri () ) . 'js/infobox.js' , array('google-map'), false, false);
	wp_enqueue_script( 'marker-clusterer', trailingslashit( get_template_directory_uri () ) . 'js/markerclusterer.js' , false, false, false);
	wp_enqueue_script( 'search-map'); 
}

return $map_script . '<section class="clearfix">
         <div class="map">
            <div id="map"></div>
         </div>
      </section>
				  ';
}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('ads_google_map_short_modern_base', 'ads_google_map_short_modern_base_func');
}