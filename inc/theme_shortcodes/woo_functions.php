<?php

// After Successfull payment
//add_filter( 'woocommerce_payment_complete_order_status', 'adforest_after_payment', 10, 2 );

add_action( 'woocommerce_order_status_completed',
'adforest_after_payment' );
if ( ! function_exists( 'adforest_after_payment' ) ) {
function adforest_after_payment( $order_id )
{
 
	$profile	= new adforest_profile();
	
	$order = new WC_Order( $order_id );
	
	$uid		=	get_post_meta( $order_id, '_customer_user', true );

	
	$items = $order->get_items();
	foreach ( $items as $item )
	{
		$product_id = $item['product_id'];
		$ads			=	get_post_meta( $product_id, 'package_free_ads', true );
		$featured_ads	=	get_post_meta( $product_id, 'package_featured_ads', true );
		$bump_ads	=	get_post_meta( $product_id, 'package_bump_ads', true );
		$days			=	get_post_meta( $product_id, 'package_expiry_days', true );
		
		update_user_meta( $uid, '_sb_pkg_type', get_the_title($product_id) );
		if( $ads == '-1' )
		{
			update_user_meta( $uid, '_sb_simple_ads', '-1' );
		}
		else if( is_numeric( $ads ) &&  $ads != 0 )
		{
			$simple_ads	=	get_user_meta( $uid, '_sb_simple_ads', true );
			$simple_ads	=	 $simple_ads;
			$new_ads	=	$ads + $simple_ads;
			update_user_meta( $uid, '_sb_simple_ads', $new_ads );
		}
		if( $featured_ads == '-1' )
		{
			update_user_meta( $uid, '_sb_featured_ads', '-1' );	
		}
		else if( is_numeric( $featured_ads ) &&  $featured_ads != 0 )
		{
			$f_ads	=	get_user_meta( $uid, '_sb_featured_ads', true );
			$f_ads	=	 (int)$f_ads;
			$new_f_fads	=	$featured_ads + $f_ads;
			update_user_meta( $uid, '_sb_featured_ads', $new_f_fads );
		}
		
		if( $bump_ads == '-1' )
		{
			update_user_meta( $uid, '_sb_bump_ads', '-1' );	
		}
		else if( is_numeric( $bump_ads ) &&  $bump_ads != 0 )
		{
			$b_ads	=	get_user_meta( $uid, '_sb_bump_ads', true );
			$b_ads	=	 (int)$b_ads;
			$new_b_fads	=	$bump_ads + $b_ads;
			update_user_meta( $uid, '_sb_bump_ads', $new_b_fads );
		}
		
		if( $days == '-1' )
		{
			update_user_meta( $uid, '_sb_expire_ads', '-1' );
		}
		else
		{
			$expiry_date	=	get_user_meta( $uid, '_sb_expire_ads', true );
			$e_date	=	strtotime( $expiry_date );	
			$today	=	strtotime( date( 'Y-m-d') );
			if( $today > $e_date )
			{
				$new_expiry	=	date('Y-m-d', strtotime("+$days days"));
			}
			else
			{
				$date	=	date_create( $expiry_date );
				date_add($date,date_interval_create_from_date_string("$days days"));
				$new_expiry	=	 date_format($date,"Y-m-d");
			}
			update_user_meta( $uid, '_sb_expire_ads', $new_expiry );
			
		}
		
		
		

	}
	
	
 	 	
}
}

if ( ! function_exists( 'adforest_after_payment_test' ) ) {
function adforest_after_payment_test( $product_id )
{
 
	$profile	= new adforest_profile();
	$uid		=	$profile->user_info->ID;
	

		$ads			=	get_post_meta( $product_id, 'package_free_ads', true );
		$featured_ads	=	get_post_meta( $product_id, 'package_featured_ads', true );
		$days			=	get_post_meta( $product_id, 'package_expiry_days', true );
		
		update_user_meta( $uid, '_sb_pkg_type', get_the_title($product_id) );
		if( $ads == '-1' )
		{
			update_user_meta( $uid, '_sb_simple_ads', '-1' );
		}
		else if( is_numeric( $ads ) &&  $ads != 0 )
		{
			$simple_ads	=	get_user_meta( $uid, '_sb_simple_ads', true );
			$simple_ads	=	 $simple_ads;
			$new_ads	=	$ads + $simple_ads;
			update_user_meta( $uid, '_sb_simple_ads', $new_ads );
		}
		if( $featured_ads == '-1' )
		{
			update_user_meta( $uid, '_sb_featured_ads', '-1' );	
		}
		else if( is_numeric( $featured_ads ) &&  $featured_ads != 0 )
		{
			$f_ads	=	get_user_meta( $uid, '_sb_featured_ads', true );
			$f_ads	=	 (int)$f_ads;
			$new_f_fads	=	$featured_ads + $f_ads;
			update_user_meta( $uid, '_sb_featured_ads', $new_f_fads );
		}
		
		if( $days == '-1' )
		{
			update_user_meta( $uid, '_sb_expire_ads', '-1' );
		}
		else
		{
			$expiry_date	=	get_user_meta( $uid, '_sb_expire_ads', true );
			$e_date	=	strtotime( $expiry_date );	
			$today	=	strtotime( date( 'Y-m-d') );
			if( $today > $e_date )
			{
				$new_expiry	=	date('Y-m-d', strtotime("+$days days"));
			}
			else
			{
				$date	=	date_create( $expiry_date );
				date_add($date,date_interval_create_from_date_string("$days days"));
				$new_expiry	=	 date_format($date,"Y-m-d");
			}
			update_user_meta( $uid, '_sb_expire_ads', $new_expiry );
			
		}
		
}
}


if ( ! function_exists( 'adforest_hide_package_quantity' ) ) {
function adforest_hide_package_quantity( $return, $product ) {
	return true;
}
}
add_filter( 'woocommerce_is_sold_individually', 'adforest_hide_package_quantity', 10, 2 );


if ( ! function_exists( 'adforest_woo_price' ) ) {
function adforest_woo_price($currency = '', $price = 0)
{
	global $adforest_theme;
	$thousands_sep = wc_get_price_thousand_separator();
	$decimals = wc_get_price_decimals();;
	$decimals_separator = wc_get_price_decimal_separator();

	$price  = number_format( (int)$price, $decimals, $decimals_separator, $thousands_sep  );
	$price  = ( isset( $price ) && $price != "") ? $price : 0;	
	
	if( isset($adforest_theme['sb_price_direction']) && $adforest_theme['sb_price_direction'] == 'right' )
	{
		$price =  $price . $currency;
	}	
	else if( isset($adforest_theme['sb_price_direction']) && $adforest_theme['sb_price_direction'] == 'left' )
	{
		$price =  $currency . $price;
	}	
	else
	{
		$price =  $currency . $price;	
	}
	
	return $price;
}
}