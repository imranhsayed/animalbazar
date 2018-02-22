<?php
	extract(shortcode_atts(array(
		'section_bg' => '',
		'bg_img' => '',
		'header_style' => '',
		'section_title' => '',
		'section_title_regular' => '',
		'section_description' => '',
		'ad_left' => '',
		'ad_right' => '',
		'cat_link_page' => '',
		'sub_limit' => '',
		'max_limit' => '',
		'p_cols' => '',
		'main_heading' => '',
		'main_description' => '',
		'main_image' => '',
		'main_link' => '',
		'ad_720_90' => '',
		'woo_products' => '',
		'woo_products' => '',
	) , $atts));
	
	
	if ( isset( $header_style ) )
	{
		$main_title	=	'';
		if( $header_style == 'classic' )
		{
			$main_title	=	$section_title;
		}
		else
		{
			$main_title	=	$section_title_regular;
		}
		$header	=	adforest_getHeader( $main_title, $section_description, $header_style );	
	}
	$style = '';
	$bg_color	=	'';
	
	if( $section_bg == 'img' )
	{
		$bgImageURL	=	adforest_returnImgSrc( $bg_img );
		if( isset( $bg_bootom ) )
		{
			$style = ( $bgImageURL != "" ) ? ' style="background:#fff url('.$bgImageURL.') repeat-x scroll center bottom; "' : "";
		}
		else
		{
			$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.') center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
		}
			
	}
	else
	{
		$bg_color	=	$section_bg;
	}