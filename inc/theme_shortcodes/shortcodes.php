<?php if ( in_array( 'sb_framework/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
{	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/icons/icons.php';
	/* ------------------------------------------------ */
	/* Common Shortcode */
	/* ------------------------------------------------ */
	if ( class_exists ( 'Redux' )) {
	if( Redux::getOption('adforest_theme', 'design_type') == 'modern' )
	{
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/modern/ads-slider_modern.php';
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/modern/ads-slider_modern2.php';
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/modern/ads_google_map_modern.php';
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/modern/ad_post_modern.php';
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/modern/search_modern.php';
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/modern/search_hero.php';
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/modern/search_hero2.php';
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/modern/ads_cats_tabs_modern.php';
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/modern/grid_modern.php';
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/modern/clouds.php';
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/modern/cats_round.php';
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/modern/ads-countries.php';
	}
	else
	{
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/ads_google_map.php';
		require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/ad_post.php';
	}
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/short_codes_functions.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/woo_functions.php';	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/classes/ads.php';	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/classes/packages.php';	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/classes/authentication.php';	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/classes/profile.php';	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/classes/ad_post.php';	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/sign_up.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/sign_in.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/profile.php';
	

	
	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/ads.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/ads_cats_boxes.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/ads-slider.php';
	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/search_modern.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/search_simple.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/search_classic.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/search_minimal.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/search_fancy.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/search_stylish.php';
	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/cats_modern.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/cats_minimal.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/cats_fancy.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/cats_flat.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/cats_color.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/cats_tab.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/cats_classic.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/popular_cats.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/blog.php';

// Woo Commerce is avtive
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
{
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/products_classic.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/products_simple.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/products_modern.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/products_minimal.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/select_product.php';
	
}

	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/about.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/why_chose.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/partners.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/partners_grid.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/partners_classic.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/apps.php';
	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/apps_classic.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/process_cycle.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/fun_facts.php';
	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/call_to_action.php';
	
	
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/text_block.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/faq.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/contact_us.php';
	require trailingslashit( get_template_directory () )  . 'inc/theme_shortcodes/shortcodes/advertisement_720-90.php';
	}

}