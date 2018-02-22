<?php
if ( ! function_exists( 'adforest_color_text' ) ) {
function adforest_color_text( $str )
{
	preg_match_all('~{color}([^{]*){/color}~i', $str, $matches);
	$i	= 1;
	$found	=	array();
	foreach( $matches as $key => $val )
	{
		if( $i == 2 )
		{
			$found	=	$val;
		}
		$i++;
	}
	foreach( $found as $k )
	{
		$search = "{color}" . $k  . "{/color}";
		$replace = '<span class="heading-color">'.$k.'</span>';
		$str	=	 str_replace($search,$replace,$str);
	}
	return $str;
}
}

// For Section header
if ( ! function_exists( 'adforest_getHeader' ) ) {
function adforest_getHeader($sb_section_title, $sb_section_description, $style = 'classic')
{
	if ($style == 'classic')
	{
		$desc	=	'';
		if( $sb_section_description != '' )
		{
			$desc	=	'<p class="heading-text">' . $sb_section_description . '</p>';
		}
		$main_title	= adforest_color_text( $sb_section_title );

		return '<div class="heading-panel">
				 <div class="col-xs-12 col-md-12 col-sm-12 text-center">
					<!-- Main Title -->
					<h1>' . $main_title. '</h1>
					<!-- Short Description -->
					'.$desc.'
				 </div>
			  </div>';
	}
	else if ($style == 'regular')
	{
			return '<div class="heading-panel">
                     <div class="col-xs-12 col-md-12 col-sm-12">
                        <h3 class="main-title text-left">
                           ' . esc_html($sb_section_title) . '
                        </h3>
                     </div>
                  </div>';
	}
}
}

// Get param array
if ( ! function_exists( 'adforest_generate_type' ) ) {
function adforest_generate_type($heading = '', $type = '', $para_name = '',  $description = '', $group = '', $values = array(), $default = '', $class = 'vc_col-sm-12 vc_column', $dependency = '', $holder = 'div')
{
	
	$val	=	'';
	if( count( $values ) > 0 )
	{
		$val	=	$values;		
	}
	
	return array(
			"group" => $group,
			"type" => $type,
			"holder" => $holder,
			"class" => "",
			"heading" => $heading,
			"param_name" => $para_name,
			"value" => $val,
			"description" => $description,
			"edit_field_class" => $class,
			"std"	=> $default,
			'dependency' => $dependency,
	);
}
}


if ( ! function_exists( 'adforest_ThemeBtn' ) ) {
function adforest_ThemeBtn($section_btn = '', $class = '' , $onlyAttr = false, $iconBefore = '', $iconAfter = '')
{
 $buttonHTML = "";
 if( isset( $section_btn ) && $section_btn != "") 
 {
  $button = adforest_extarct_link( $section_btn );
  $class = ( $class != "" ) ? 'class="'.esc_attr($class).'"' : ''; 
  $rel    = ( isset( $button["rel"] ) && $button["rel"] != "" ) ? ' rel="'.esc_attr($button["rel"]). ' "' : "";
  $href   = ( isset( $button["url"] ) && $button["url"] != "" ) ? ' href="'.esc_url($button["url"]). ' "' : "javascript:void(0);";
  $title  = ( isset( $button["title"] ) && $button["title"] != "" ) ? ' title="'.esc_attr($button["title"]). '"' : "";
  $target = ( isset( $button["target"] ) && $button["target"] != "" ) ? ' target="'.esc_attr($button["target"]). '"' : "";
  $titleText  = ( isset( $button["title"] ) && $button["title"] != "" ) ?  esc_html($button["title"]) : "";
  
	if( isset( $button["url"] ) && $button["url"] != ""  )
	{
	 $btn = ( $onlyAttr == true ) ? $href. $target. $class. $rel : '<a '.$href.' '.$target.' '.$class.' '.$rel.'>'.$iconBefore.' '.esc_html($titleText).' ' .$iconAfter.'</a>';
  		$buttonHTML = ( isset( $title ) ) ? $btn : "";
	}
 }
 return $buttonHTML;
}
}

if ( ! function_exists( 'adforest_extarct_link' ) ) {
function adforest_extarct_link( $string )
{
 $arr = explode( '|', $string );
 list($url, $title, $target, $rel) = $arr;
 $rel  = urldecode( adforest_themeGetExplode( $rel, ':', '1') ); 
 $url  = urldecode( adforest_themeGetExplode( $url, ':', '1') );
 $title  = urldecode( adforest_themeGetExplode( $title, ':', '1') );
 $target = urldecode( adforest_themeGetExplode( $target, ':', '1') );
 return array( "url" => $url, "title" => $title, "target" => $target, "rel" => $rel ); 
}
}


if ( ! function_exists( 'adforest_themeGetExplode' ) ) {
function adforest_themeGetExplode($string = "", $explod = "", $index = "")
{
 $ar = '';
 if( $string != "" )
 {
   $exp = explode( $explod, $string );
   $ar  =  ( $index != "" ) ? $exp[$index] : $exp;
 }
 return ( $ar != "" ) ? $ar : "";
}
}


// BG Color or Image
if ( ! function_exists( 'adforest_bg_func' ) ) {
function adforest_bg_func( $sb_bg_color, $sb_bg = '')
{
	$bg	=	'';
	if( $sb_bg_color == 'bg_img' )
	{
		$bgimg  = wp_get_attachment_image_src($sb_bg, 'full');
		if( $bgimg[0] != "" )
		{
			$bg	=	$bgimg[0];
		}
	}
	return array( 'url' => $bg, 'color' => $sb_bg_color );
	
}
}

if ( ! function_exists( 'adforest_returnImgSrc' ) ) {
function adforest_returnImgSrc($id, $size= 'full', $showHtml = false, $class = '', $alt = '')
{
 
 $img = '';
 if( isset( $id ) && $id != "" )
 {
  if( $showHtml == false )
  {
   $img1 = wp_get_attachment_image_src($id, $size);
   $img = $img1[0];
  }
  else
  {
   $class = ( $class != "" ) ? 'class="'.esc_attr($class).'"' : '';
   $alt = ( $alt != "" ) ? 'alt="'.esc_attr($alt).'"' : '';
   $img1 = wp_get_attachment_image_src($id, $size);   
   $img = '<img src="'.esc_url( $img1[0] ).'" '.$class.' '.$alt.'>'; 
  }
 }
 return $img;
}
}

if ( ! function_exists( 'adforest_VCImage' ) ) {
function adforest_VCImage($imgName = '')
{
 $val = '';
 if( $imgName != "" )
 {
  $path = esc_url( trailingslashit( get_template_directory_uri () ) . 'vc_images/'.$imgName );
  $val = '<img src="'.esc_url($path ).'" style="width:100%" class="img-responsive">'; 
 }
 
 return $val;
 
}
}

// Get cats
if ( ! function_exists( 'adforest_cats' ) ) {
function adforest_cats( $taxonomy = 'ad_cats' , $all = 'yes' )
{
	$ad_cats = get_terms( $taxonomy, array( 'hide_empty' => 0 ) );
	if( $all == 'yes' )
		$cats	= array( 'All' => 'all' );
	else
	$cats	= array();
	if( count( $ad_cats ) > 0 )
	{
		foreach( $ad_cats as $cat )
		{
			$cats[$cat->name .' (' . $cat->slug . ')'.' (' . $cat->count . ')']	=	$cat->term_id;
		}
	}
	return $cats;
}
}

// Get Products
if ( ! function_exists( 'adforest_get_products' ) ) {
function adforest_get_products()
{
	$args	=	array(
	'post_type' => 'product',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'order'=> 'DESC',
	'orderby' => 'ID'
	);
	$products	= array('Select Product' => '' );
	$packages = new WP_Query( $args );
	if ( $packages->have_posts() )
	{
		while ( $packages->have_posts() )
		{
			$packages->the_post();
			$products[get_the_title()]	=	get_the_ID();
		}
	}
	return $products;
	
}
}

// Get Countries
if ( ! function_exists( 'adforest_locations' ) ) {
function adforest_locations( $type )
{
		if( $type == 'countries' )
		{
			
		}
}
}

if ( ! function_exists( 'adforest_get_location' ) ) {
function adforest_get_location( $call_back = '' )
{
	global $adforest_theme;
	$api_key	=	$adforest_theme['gmap_api_key'];	
	return $snippnet	=	'<script src="https://maps.googleapis.com/maps/api/js?key='.$api_key.'&libraries=places&callback='.$call_back.'" type="text/javascript"></script>';
}
}


// get latitude and longitude
if ( ! function_exists( 'adforest_lat_long' ) ) {
function adforest_lat_long( $address )
{
	$api_key	=	$adforest_theme['gmap_api_key'];
		
	$param	=	"?address=".$address."&key=" . $api_key;	
	$url = esc_url( "https://maps.googleapis.com/maps/api/geocode/json" ) . $param;	
	$json = wp_remote_get($url);
	$res	=	$data = json_decode($json['body'], true);
	
	$latitude	=	$res['results'][0]['geometry']['location']['lat'];
	$longitude	=	$res['results'][0]['geometry']['location']['lng'];
	
	$send_data	=	array();
	$send_data[]	=	$latitude;
	$send_data[]	=	$longitude;
	
	return $send_data;
}
}


if ( ! function_exists( 'adforest_add_location' ) ) {
function adforest_add_location($country = '', $state= '', $city= '')
{
	global $wpdb;
	$country_data = $wpdb->get_row( "SELECT ID FROM $wpdb->posts WHERE post_type = '_sb_country' AND post_title LIKE '%$country%'" );
	
	$country_id	=	$country_data->ID;
	
	$table_name = $wpdb->prefix . 'adforest_locations';
	
	
	$state_id	=	0;
	
		$is_state = $wpdb->get_row( "SELECT lid FROM $table_name WHERE country_id = '$country_id' AND location_type = 'state'  AND name = '$state'" );
		if( !isset( $is_state->lid ) )
		{
			$res	=	adforest_lat_long( $state . $country );
			
			$wpdb->query( "INSERT INTO $table_name (name,latitude,longitude,country_id,state_id,location_type) VALUES ('".$state."','".$res[0]."','".$res[1]."','".$country_id."','$state_id','state')" );
			$state_id	=	$wpdb->insert_id;
		}
		else
		{
			$state_id	=	$is_state->lid;
		}
	
		$is_city = $wpdb->get_row( "SELECT lid FROM $table_name WHERE country_id = '$country_id' AND location_type = 'city'  AND name = '$city'" );
		if( !isset( $is_city->lid ) )
		{
			$res	=	adforest_lat_long( $city . $country );
			
			$wpdb->query( "INSERT INTO $table_name (name,latitude,longitude,country_id,state_id,location_type) VALUES ('".$city."','".$res[0]."','".$res[1]."','".$country_id."','$state_id','city')" );	
		}
		
}
}

// Get lat lon by location
if ( ! function_exists( 'adforest_get_latlon' ) ) {
function adforest_get_latlon( $location )
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'adforest_locations';
	// Explode location
	$address	=	explode(',', $location );
	if( count( $address ) == 1 )
	{
		return array();	
	}
	if( count( $address ) == 3 )
	{
		$country	=	trim( $address[2] );
		$state		=	trim( $address[1] );
		$city		=	trim( $address[0] );
	}
	if( count( $address ) == 4 )
	{
		$country	=	trim( $address[3] );
		$state		=	trim( $address[2] );
		$city		=	trim( $address[1] );
	}
	else if( count( $address ) == 2 )
	{
		$country	=	trim( $address[1] );
		$city		=	trim( $address[0] );
	}
	$country_data = $wpdb->get_row( "SELECT ID FROM $wpdb->posts WHERE post_type = '_sb_country' AND post_title LIKE '%$country%'" );
	if( count( $country_data ) == 0 )
	{
		return array();	
	}
	$country_id	=	$country_data->ID;
	$arr = $wpdb->get_row( "SELECT latitude,longitude FROM $table_name WHERE country_id = '$country_id' AND location_type = 'city'  AND name = '$city'" );
	if( count( $arr ) > 0 )
	 {
	   if( $arr->latitude != ""  && $arr->longitude != "" )
	   {
		return array( $arr->latitude, $arr->longitude );
	   }
	 }
  return array();}
}

// Making shortcode function
if ( ! function_exists( 'adforest_clean_shortcode' ) ) {
function adforest_clean_shortcode($string)
{
 $replace = str_replace("`{`", "[", $string);
 $replace = str_replace("`}`", "]", $replace);
 $replace = str_replace("``", '"', $replace);
 return $replace;
}
}


if ( ! function_exists( 'adforest_cat_link_page' ) ) {
function adforest_cat_link_page( $category_id, $type = '', $tax = 'cat_id' )
{
	global $adforest_theme;
	$link = get_the_permalink($adforest_theme['sb_search_page'])."?$tax=".$category_id;
	if( $type == 'category' )
	{
		$link = get_term_link( (int)$category_id );	
	}
	return $link;
		
}
}