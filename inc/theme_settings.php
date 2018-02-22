<?php global $adforest_theme;
/*
 	Theme Settings.
*/

/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Leisure Sols, use a find and replace
	 * to change ''rane to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'adforest', trailingslashit( get_template_directory() ) . 'languages/' );
	
	
	// Content width
	if ( ! isset( $content_width ) ) {
	$content_width = 600;
	}
	
	
	//WooCommrce
	add_theme_support( 'woocommerce' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	
	// Theme editor style
	add_editor_style('editor.css');
	

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-SB_TAMEER_IMAGES-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails', array('post', 'project') );
	add_image_size( 'adforest-single-post', 760, 410, true ); 
	add_image_size( 'adforest-category', 400, 300, true ); 
	add_image_size( 'adforest-single-small', 80, 80, true );
	add_image_size( 'adforest-ad-thumb', 120, 63, true );
	add_image_size( 'adforest-ad-related', 313, 234, true );
	
	
	add_image_size( 'adforest-user-profile', 300, 300, true ); 
	add_image_size( 'adforest-ad-country', 250, 160, true );
	
	

	
	// This theme uses wp_nav_menu() in one location.
	
	register_nav_menus( array(
		'main_menu' => esc_html__( 'adforest Primary Menu', 'adforest' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'adforest_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
if ( in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
{	
	vc_disable_frontend();
}
	
	// Register side bar for widgets
	add_action( 'widgets_init', 'sb_themes_sidebar_widgets_init' );
if ( ! function_exists( 'sb_themes_sidebar_widgets_init' ) ) {
function sb_themes_sidebar_widgets_init() {
    register_sidebar( array(
        'name' => esc_html__('adforest Sidebar', 'adforest'),
        'id' => 'sb_themes_sidebar',
        'before_widget' => '<div class="widget widget-content"><div id="%1$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="widget-heading"><h4 class="panel-title"><a href="javascript:void(0);">',
        'after_title' => '</a></h4></div>'
    ) );
	
    register_sidebar( array(
        'name' => esc_html__('adforest Grid Sidebar', 'adforest'),
        'id' => 'sb_themes_grid_sidebar',
        'before_widget' => '<div class="widget widget-content"><div id="%1$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="widget-heading"><h4 class="panel-title"><a href="javascript:void(0);">',
        'after_title' => '</a></h4></div>'
    ) );
	
	    register_sidebar(array(
        'name' => esc_html__('Ads Search', 'adforest'),
        'id' => 'adforest_search_sidebar',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
	    register_sidebar(array(
        'name' => esc_html__('Single Ad Top', 'adforest'),
        'id' => 'adforest_ad_sidebar_top',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
	    register_sidebar(array(
        'name' => esc_html__('Single Ad Bottom', 'adforest'),
        'id' => 'adforest_ad_sidebar_bottom',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));

	register_sidebar(array(
		'name' => esc_html__('Google Adds Widget Side', 'adforest'),
		'id' => 'adforest_google_ad_sidebar_left',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	));

	register_sidebar(array(
		'name' => esc_html__('Google Adds Widget Footer', 'adforest'),
		'id' => 'adforest_google_ad_sidebar_footer',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	));
	
}
}