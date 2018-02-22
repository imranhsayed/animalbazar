<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */
global $adforest_theme;
if( get_current_user_id() == "" )
{
	wp_redirect( get_the_permalink( $adforest_theme['sb_sign_in_page'] ) );
	exit;	
}
else
{
	wp_redirect( get_the_permalink( $adforest_theme['sb_profile_page'] ) );
	exit;	
}