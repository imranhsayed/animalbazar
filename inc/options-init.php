<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) )
	{
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "adforest_theme";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'adforest_theme',
        'dev_mode' => false,
        'display_name' => __( 'Theme Options', 'adforest' ),
        'display_version' => '1.0.0',
        'page_title' => __( 'Theme Options', 'adforest' ),
        'update_notice' => TRUE,
        'admin_bar' => TRUE,
        'menu_type' => 'submenu',
        'menu_title' => __( 'Theme Options', 'adforest' ),
        'allow_sub_menu' => TRUE,
        'page_parent_post_type' => 'your_post_type',
        'customizer' => TRUE,
        'default_show' => TRUE,
        'default_mark' => '*',
        'hints' => array(
            'icon_position' => 'right',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'global_variable' => 'adforest_theme',
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/scriptsbundle',
        'title' => __( 'Like us on Facebook', 'adforest' ),
        'icon'  => 'el el-facebook'
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS

     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'adforest' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'adforest' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'adforest' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'adforest' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'adforest' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS

     * ---> START SECTIONS
     *
     */
		/* ------------------Header Settings ----------------------- */
    Redux::setSection( $opt_name, array(
        'title'      => __( 'General', 'adforest' ),
        'id'         => 'sb_theme_generalr',
        'desc'       => '',
        'icon' => 'el el-wrench',
        'fields'     => array(
		 	array(
                'id'       => 'design_type',
                'type'     => 'button_set',
                'title'    => __( 'Theme Design', 'adforest' ),
                'options'  => array(
                    'classic' => __('Classic','adforest'),
                    'modern' => __('Modern','adforest'),
                ),
				'desc'     => __( 'After saving please refresh the page.', 'adforest' ),
                'default'  => 'modern'
            ),
			array(
                'id'       => 'sb_admin_translate',
                'type'     => 'switch',
                'title'    => __( 'Is Admin translated', 'adforest' ),
				'desc'     => __( 'After saving please refresh it.', 'adforest' ),
                'default'  => false,
            ),
			array(
                'id'       => 'sb_pre_loader',
                'type'     => 'switch',
                'title'    => __( 'Pre Page Loader', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'sb_color_plate',
                'type'     => 'switch',
                'title'    => __( 'Color Plate', 'adforest' ),
                'default'  => false,
            ),
		 array(
                'id'       => 'theme_color',
                'type'     => 'button_set',
                'title'    => __( 'Theme Colors', 'adforest' ),
                'options'  => array(
                    'defualt' => __('Default','adforest'),
                    'red' => __('Red','adforest'),
                    'green' => __('Green','adforest'),
                    'blue' => __('Blue','adforest'),
                    'sea-green' => __('Sea Green','adforest'),
                ),
                'default'  => 'defualt'
            ),
			array(
                'id'       => 'gmap_lang',
                'type'     => 'text',
                'title'    => __( 'Google map language', 'adforest' ),
				'desc' => adforest_make_link ( 'https://developers.google.com/maps/faq#languagesupport' , __( 'List of available languages' , 'adforest' ) ),
				'default'  => 'en',
            ),
			array(
                'id'       => 'sb_rtl',
                'type'     => 'switch',
                'title'    => __( 'RTL', 'adforest' ),
                'default'  => false,
            ),
			array(
                'id'       => 'admin_bar',
                'type'     => 'switch',
                'title'    => __( 'Admin Bar', 'adforest' ),
                'subtitle' => __( 'wordpress', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'scroll_to_top',
                'type'     => 'switch',
                'title'    => __( 'Scroll to top', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'sell_button',
                'type'     => 'switch',
                'title'    => __( 'Ad Post Sticky Button', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'sb_video_icon',
                'type'     => 'switch',
                'title'    => __( 'Video icon on ads', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'sticky_icon',
                'type'     => 'text',
                'title'    => __( 'Sticky Icon', 'adforest' ),
                'subtitle'    => __( 'Just like "flaticon-android"', 'adforest' ),
				'required' => array( 'sell_button', '=', array( '1' ) ),
				'desc'     => __( 'You can select from.', 'adforest' ) . ' ' . adforest_make_link ( 'http://adforest.scriptsbundle.com/theme-icons/' , __( 'List' , 'adforest' ) ),
                'default'  => 'flaticon-transport-9',				
            ),
			array(
                'id'       => 'sticky_title',
                'type'     => 'text',
                'title'    => __( 'Sticky Title', 'adforest' ),
				'required' => array( 'sell_button', '=', array( '1' ) ),
                'default'  => 'Sell',				
            ),
			
			array(
                'id'       => 'sb_android_app',
                'type'     => 'switch',
                'title'    => __( 'Android app available', 'adforest' ),
                'default'  => false,
            ),
		 array(
                'id'       => 'sb_android_app_direction',
                'type'     => 'button_set',
                'title'    => __( 'Icon position', 'adforest' ),
                'options'  => array(
                    'right' => __('Right','adforest'),
                    'left' => __('Left','adforest'),
                ),
				'required' => array( 'sb_android_app', '=', array( '1' ) ),
                'default'  => 'right'
            ),
			array(
                'id'       => 'sb_android_app_text',
                'type'     => 'text',
                'title'    => __( 'App display text', 'adforest' ),
				'required' => array( 'sb_android_app', '=', array( '1' ) ),
                'default'  => 'Android App',				
            ),
			array(
                'id'       => 'sb_android_app_link',
                'type'     => 'text',
                'title'    => __( 'App link', 'adforest' ),
				'required' => array( 'sb_android_app', '=', array( '1' ) ),
                'default'  => '',				
            ),
			
            array(
                'id'       => 'sb_android_app_img',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Default user picture', 'adforest' ),
                'compiler' => 'true',
                'subtitle' => __( 'Dimensions: 60 x 106', 'adforest' ),
				'required' => array( 'sb_android_app', '=', array( '1' ) ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/app-and.png' ),
            ),
			
            array(
                'id'       => 'sb_user_dp',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Default user picture', 'adforest' ),
                'compiler' => 'true',
                'subtitle' => __( 'Dimensions: 200 x 200', 'adforest' ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/users/9.jpg' ),
            ),
		)
		) );
	
		/* ------------------Header Settings ----------------------- */
		
	$grid_array;
	$msg	= '';
	if( Redux::getOption('adforest_theme', 'design_type') == 'modern' )
	{
		$options = array(
                    'white' => 'White',
                    'black' => 'Black',
                    'transparent' => 'Transparent',
                    'with_ad' => 'With Banner Ad',
                    'light' => 'Light',
                );
				$msg	= __( 'Transparent is only for home page in modern design.', 'adforest' );
	}
	else
	{
		$options = array(
                    'white' => 'White',
                    'black' => 'Black',
                );
				
	}

		
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Header', 'adforest' ),
        'id'         => 'sb_theme_header',
        'desc'       => '',
        'icon' => 'el el-arrow-up',
        'fields'     => array(
		 array(
                'id'       => 'sb_header',
                'type'     => 'button_set',
                'title'    => __( 'Header Style', 'adforest' ),
                'options'  => $options,
				'desc'     => $msg,
                'default'  => 'white'
            ),
			array(
                'id'       => 'with_ad_720_90',
                'type'     => 'textarea',
                'title'    => __( 'Advertisement', 'adforest' ),
				'subtitle' => __( '720 x 90', 'adforest' ),
				'required' => array( 'sb_header', '=', array( 'with_ad' ) ),
				'default'  => '<img alt="" src="'.trailingslashit( get_template_directory_uri () ).'images/banner728.jpg"> ',
            ),
			array(
                'id'       => 'sb_top_bar',
                'type'     => 'switch',
                'title'    => __( 'Top Bar', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'sb_sticky_header',
                'type'     => 'switch',
                'title'    => __( 'Sticky Menu', 'adforest' ),
                'default'  => false,
            ),
			array(
                'id'       => 'top_bar_pages',
                'type'     => 'select',
                'data'     => 'pages',
                'multi'    => false,
				'sortable' => true,
                'title'    => __( 'Select Pages', 'adforest' ),
				'subtitle' => __( 'for top bar', 'adforest' ),
				'required' => array( 'sb_top_bar', '=', true ),
				'default'  => '',
            ),
			array(
                'id'       => 'sb_sign_in_page',
                'type'     => 'select',
                'data'     => 'pages',
                'title'    => __( 'Sign In Page', 'adforest' ),
				'required' => array( 'sb_top_bar', '=', true ),
				'default'  => '',
            ),
			array(
                'id'       => 'sb_sign_up_page',
                'type'     => 'select',
                'data'     => 'pages',
                'title'    => __( 'Sign Up Page', 'adforest' ),
				'required' => array( 'sb_top_bar', '=', true ),
				'default'  => '',
            ),
			array(
                'id'       => 'sb_profile_page',
                'type'     => 'select',
                'data'     => 'pages',
                'title'    => __( 'Profile Page', 'adforest' ),
				'required' => array( 'sb_top_bar', '=', true ),
				'default'  => '',
            ),
			array(
                'id'       => 'sb_post_ad_page',
                'type'     => 'select',
                'data'     => 'pages',
                'title'    => __( 'Ad Post Page', 'adforest' ),
				'default'  => '',
            ),
		
            array(
                'id'       => 'sb_site_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo', 'adforest' ),
                'compiler' => 'true',
                'desc'     => __( 'Site Logo image for the site.', 'adforest' ),
                'subtitle' => __( 'Dimensions: 160 x 40', 'adforest' ),
				
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/logo.png' ),
            ),
            array(
                'id'       => 'sb_site_logo_for_transparent',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo for transparent', 'adforest' ),
                'compiler' => 'true',
                'desc'     => __( 'Site Logo image for the site.', 'adforest' ),
                'subtitle' => __( 'Dimensions: 230 x 40', 'adforest' ),
				'required' => array( 'sb_header', '=', array( 'transparent' ) ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/adforest-logo-white.png' ),
            ),
            array(
                'id'       => 'sb_site_logo_light',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo on Sticky', 'adforest' ),
                'compiler' => 'true',
                'desc'     => __( 'Site Logo image for the site.', 'adforest' ),
                'subtitle' => __( 'Dimensions: 230 x 40', 'adforest' ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/logo.png' ),
            ),
			array(
                'id'       => 'ad_in_menu',
                'type'     => 'switch',
                'title'    => __( 'Post A AD', 'adforest' ),
				'subtitle' => __( 'Show Button in Menu', 'adforest' ),
                'default'  => false,
            ),
			array(
                'id'       => 'ad_in_menu_text',
                'type'     => 'text',
                'title'    => __( 'Post A AD button text', 'adforest' ),
                'default'  => 'Post A AD',
            ),
			array(
                'id'       => 'search_in_header',
                'type'     => 'switch',
                'title'    => __( 'Search Bar', 'adforest' ),
				'subtitle' => __( 'in header', 'adforest' ),
				'required' => array( 'sb_header', '=', array( 'black' ) ),
                'default'  => true,
            ),

			 array(
                'id'       => 'header_js_and_css',
                'type'     => 'textarea',
                'title'    => __( 'Head Custom CSS/Javascript', 'adforest' ),
                'default'  => '',
            )

        )
    ) );	

		/* ------------------Ad Posing Settings ----------------------- */
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Ads Settings', 'adforest' ),
        'id'         => 'sb_ad_settings',
        'desc'       => '',
        'icon' => 'el el-adjust-alt',
		));
	
	    Redux::setSection( $opt_name, array(
        'title'      => __( 'General Settings', 'adforest' ),
        'id'         => 'sb_ad_general_settings',
        'desc'       => '',
        'icon' => 'el el-cogs',
		'subsection' => true,
        'fields'     => array(
		array(
			'id'       => 'sb_location_allowed',
			'type'     => 'switch',
			'title'    => __( 'Allowed all countries', 'adforest' ),
			'default'  => true,
		),
		array(
			'id'       => 'sb_list_allowed_country',
			'type'     => 'select',
			'options'     => adforest_get_all_countries(),
			'multi'    => true,
			'title'    => __( 'Select Countries', 'adforest' ),
			'required' => array( 'sb_location_allowed', '=', array( '0' ) ),
			'desc'     => __( 'You can select max 5 countries as per GOOGLE limit.', 'adforest' ) . ' ' . adforest_make_link ( 'https://developers.google.com/maps/documentation/javascript/3.exp/reference#ComponentRestrictions' , __( 'Read More' , 'adforest' ) ),
		),
		 array(
                'id'       => 'sb_location_type',
                'type'     => 'button_set',
                'title'    => __( 'Address Type', 'adforest' ),
                'options'  => array(
                    'cities' => __('Cities', 'adforest' ),
                    'regions' => __('Adresses', 'adforest' ),
                ),
                'default'  => 'cities'
            ),

		 array(
                'id'       => 'communication_mode',
                'type'     => 'button_set',
                'title'    => __( 'Communications Mode', 'adforest' ),
                'options'  => array(
                    'phone' => __('Phone', 'adforest' ),
                    'message' => __('Messages', 'adforest' ),
                    'both' => __('Both', 'adforest' ),
                ),
                'default'  => 'both'
            ),
			array(
                'id'       => 'sb_custom_location',
                'type'     => 'switch',
                'title'    => __( 'Custom locations', 'adforest' ),
                'default'  => false,
            ),
			array(
                'id'       => 'sb_location_titles',
                'type'     => 'text',
                'title'    => __( 'Location titles', 'adforest' ),
				'required' => array( 'sb_custom_location', '=', '1' ),
				'desc'    => __( '4-level location title separate by | like Country|State|City|Town', 'adforest' ),
				'default'  => 'Country|State|City|Town',
            ),
			
			array(
                'id'       => 'sb_send_email_on_ad_post',
                'type'     => 'switch',
                'title'    => __( 'Send email on Ad Post', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'ad_post_email_value',
                'type'     => 'text',
                'title'    => __( 'Email for notification.', 'adforest' ),
				'required' => array( 'sb_send_email_on_ad_post', '=', '1' ),
				'default'  => get_option( 'admin_email' ),
            ),
			array(
                'id'       => 'sb_send_email_on_message',
                'type'     => 'switch',
                'title'    => __( 'Send email on message', 'adforest' ),
                'desc'    => __( 'When someone drop a message on ad then email send to concern user.', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'msg_notification_on',
                'type'     => 'switch',
                'title'    => __( 'Toastr notification', 'adforest' ),
                'desc'    => __( 'When someone drop a message on ad then notify to user on web via small popup.', 'adforest' ),
                'default'  => true,
            ),
		array(
			'id'       => 'msg_notification_time',
			'type'     => 'text',
			'title'    => __( 'Check Notification', 'adforest' ),
			'subtitle'    => __( 'after X second', 'adforest' ),
			'desc'    => __( 'Check notification after how many second. 1000 means 1 second.', 'adforest' ),
			'required' => array( 'msg_notification_on', '=', array( '1' ) ),
			'default'  => 10000,
		),
		array(
			'id'       => 'msg_notification_text',
			'type'     => 'text',
			'title'    => __( 'Notification text', 'adforest' ),
			'desc'    => __( '%count% will be replace with number of messages.', 'adforest' ),
			'required' => array( 'msg_notification_on', '=', array( '1' ) ),
			'default'  => "You have %count% new messages.",
		),
			
			array(
                'id'       => 'sb_notification_page',
                'type'     => 'select',
                'data'     => 'pages',
                'title'    => __( 'All notifications page', 'adforest' ),
				'required' => array( 'msg_notification_on', '=', array( '1' ) ),
				'default'  => '',
            ),
			
			array(
                'id'       => 'sb_currency',
                'type'     => 'text',
                'title'    => __( 'Currency', 'adforest' ),
				'desc' => adforest_make_link ( 'http://htmlarrows.com/currency/' , __( 'List of Currency' , 'adforest' ) ) . " " . esc_attr__( 'You can use HTML code or text as well like USD etc', 'adforest' ),
				'default'  => '$',
            ),
			array(
                'id'       => 'sb_price_direction',
                'type'     => 'select',
                'options'  => array('left' => 'Left', 'right' => 'Right' ),
                'title'    => __( 'Price direction', 'adforest' ),
				'default'  => 'left',
            ),
			array(
                'id'       => 'sb_price_separator',
                'type'     => 'text',
                'title'    => __( 'Thousands Separator', 'adforest' ),
				'default'  => ',',
            ),
			array(
                'id'       => 'sb_price_decimals',
                'type'     => 'text',
                'title'    => __( 'Decimals', 'adforest' ),
                'desc'    => __( 'It should be 0 for no decimals.', 'adforest' ),
				'default'  => '2',
            ),
			array(
                'id'       => 'sb_price_decimals_separator',
                'type'     => 'text',
                'title'    => __( 'Decimals Separator', 'adforest' ),
				'default'  => '.',
            ),
			array(
                'id'       => 'sb_ad_approval',
                'type'     => 'select',
                'options'  => array('auto' => 'Auto Approved', 'manual' => 'Admin manual approval' ),
                'title'    => __( 'Ad Approval', 'adforest' ),
				'default'  => 'auto',
            ),
			array(
                'id'       => 'sb_update_approval',
                'type'     => 'select',
                'options'  => array('auto' => 'Auto Approved', 'manual' => 'Admin manual approval' ),
                'title'    => __( 'Ad Update Approval', 'adforest' ),
				'default'  => 'auto',
            ),
			array(
                'id'       => 'email_on_ad_approval',
                'type'     => 'switch',
                'title'    => __( 'Email to Ad owner on approval', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'sb_packages_page',
                'type'     => 'select',
                'data'     => 'pages',
                'title'    => __( 'Ad Packages Page', 'adforest' ),
				'default'  => '',
            ),
			array(
                'id'       => 'share_ads_on',
                'type'     => 'switch',
                'title'    => __( 'Enable Ad Share', 'adforest' ),
                'default'  => true,
            ),
			
			array(
                'id'       => 'report_options',
                'type'     => 'text',
                'title'    => __( 'Report ad Options', 'adforest' ),
				'default'  => 'Spam|Offensive|Duplicated|Fake',
            ),
			array(
                'id'       => 'report_limit',
                'type'     => 'text',
                'title'    => __( 'Ad Report Limit', 'adforest' ),
				'desc'     => __( 'Only integer value without spaces.', 'adforest' ),
				'default'  => 10,
            ),
			array(
                'id'       => 'report_action',
                'type'     => 'select',
                'title'    => __( 'Action on Ad Report Limit', 'adforest' ),
				'options'  => array(1 => 'Auto Inactive', 2 => 'Email to Admin'),
				'default'  => 1,
            ),
			array(
                'id'       => 'report_email',
                'type'     => 'text',
                'title'    => __( 'Email', 'adforest' ),
				'desc'     => __( 'Email where you want to get notify.', 'adforest' ),
				'required' => array( 'report_action', '=', array( 2 ) ),
				'default'  => get_option( 'admin_email' ),
            ),
            array(
                'id'       => 'default_related_image',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Default Image', 'adforest' ),
                'compiler' => 'true',
                'desc'     => __( 'If there is no image of ad then this will be show.', 'adforest' ),
                'subtitle' => __( 'Dimensions: 300 x 225', 'adforest' ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/no-image.jpg' ),
            ),
			)
		));
	
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Ads Post Settings', 'adforest' ),
        'id'         => 'sb_ad_post',
        'desc'       => '',
        'icon' => 'el el-cogs',
		'subsection' => true,
        'fields'     => array(
		
		 array(
                'id'       => 'post_ad_layout',
                'type'     => 'button_set',
                'title'    => __( 'Ad Post Layout', 'adforest' ),
                'options'  => array(
                    'default' => __('Default', 'adforest' ),
                    'arrows' => __('Arrows', 'adforest' ),
                ),
                'default'  => 'default',
				'required' => array( 'design_type', '=', array( 'modern') ),
            ),
			
			array(
                'id'       => 'admin_allow_unlimited_ads',
                'type'     => 'switch',
                'title'    => __( 'Post unlimited free ads', 'adforest' ),
				'subtitle'     => __( 'For Administrator', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'sb_allow_ads',
                'type'     => 'switch',
                'title'    => __( 'Free Ads', 'adforest' ),
				'subtitle'     => __( 'For new user', 'adforest' ),
                'default'  => true,
            ),

			array(
                'id'       => 'sb_free_ads_limit',
                'type'     => 'text',
                'title'    => __( 'Free Ads limit', 'adforest' ),
				'required' => array( 'sb_allow_ads', '=', array( true) ),
				'subtitle'     => __( 'For new user', 'adforest' ),
				'desc'     => __( 'It must be an inter value, -1 means unlimited.', 'adforest' ),
				'default'  => -1,
            ),
			
			array(
                'id'       => 'sb_allow_featured_ads',
                'type'     => 'switch',
                'title'    => __( 'Free Featured Ads', 'adforest' ),
				'subtitle'     => __( 'For new user', 'adforest' ),
                'default'  => true,
            ),

			array(
                'id'       => 'sb_featured_ads_limit',
                'type'     => 'text',
                'title'    => __( 'Featured Ads limit', 'adforest' ),
				'subtitle'     => __( 'For new user', 'adforest' ),
				'required' => array( 'sb_allow_featured_ads', '=', array( true) ),
				'desc'     => __( 'It must be an inter value, -1 means unlimited.', 'adforest' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'sb_allow_bump_ads',
                'type'     => 'switch',
                'title'    => __( 'Free Bump Ads', 'adforest' ),
				'subtitle'     => __( 'For new user', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'sb_bump_ads_limit',
                'type'     => 'text',
                'title'    => __( 'Bump Ads limit', 'adforest' ),
				'subtitle'     => __( 'For new user', 'adforest' ),
				'required' => array( 'sb_allow_bump_ads', '=', array( true) ),
				'desc'     => __( 'It must be an inter value, -1 means unlimited.', 'adforest' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'sb_allow_free_bump_up',
                'type'     => 'switch',
                'title'    => __( 'Free Bump Ads for all users', 'adforest' ),
				'subtitle'     => __( 'witout any package/restriction.', 'adforest' ),
                'default'  => false,
            ),
			array(
                'id'       => 'sb_show_bump_up_notification',
                'type'     => 'switch',
                'title'    => __( 'Bump Ad notification', 'adforest' ),
				'subtitle'     => __( 'On ad update page.', 'adforest' ),
                'default'  => false,
            ),

			
			array(
                'id'       => 'sb_package_validity',
                'type'     => 'text',
                'title'    => __( 'Free package validity', 'adforest' ),
                'subtitle'    => __( 'In days for new user', 'adforest' ),
				'required' => array( 'sb_allow_ads', '=', array( true) ),
				'desc'     => __( 'It must be an inter value, -1 means never expired.', 'adforest' ),
				'default'  => -1,
            ),
			
			array(
                'id'       => 'simple_ad_removal',
                'type'     => 'text',
                'title'    => __( 'Simple ad remove after', 'adforest' ),
				'subtitle'    => __( 'In DAYS', 'adforest' ),
				'desc'     => __( 'Only integer value without spaces -1 means never expired.', 'adforest' ),
				'default'  => -1,
            ),
			array(
                'id'       => 'featured_expiry',
                'type'     => 'text',
                'title'    => __( 'Feature Ad Expired', 'adforest' ),
				'subtitle'    => __( 'In DAYS', 'adforest' ),
				'desc'     => __( 'Only integer value without spaces -1 means never expired.', 'adforest' ),
				'default'  => 7,
            ),

			array(
                'id'       => 'sb_upload_limit',
                'type'     => 'select',
                'title'    => __( 'Ad image set limit', 'adforest' ),
				'options'  => array(1 => 1,2 => 2,3 => 3,4 => 4,5 => 5,6 => 6,7 => 7,8 => 8,9 => 9,10 => 10, 11 => 11, 12=> 12, 13 => 13, 14 => 14, 15 => 15),
				'default'  => 5,
            ),
			array(
                'id'       => 'sb_upload_size',
                'type'     => 'select',
                'title'    => __( 'Ad image max size', 'adforest' ),
				'options'  => array( '307200-300kb' => '300kb', '614400-600kb' => '600kb', '819200-800kb' => '800kb', '1048576-1MB' => '1MB', '2097152-2MB' => '2MB', '3145728-3MB' => '3MB', '4194304-4MB' => '4MB', '5242880-5MB' => '5MB', '6291456-6MB' => '6MB', '7340032-7MB' => '7MB', '8388608-8MB' => '8MB', '9437184-9MB' => '9MB', '10485760-10MB' => '10MB', '11534336-11MB' => '11MB', '12582912-12MB' => '12MB', '13631488-13MB' => '13MB', '14680064-14MB' => '14MB', '15728640-15MB' => '15MB', '20971520-20MB' => '20MB', '26214400-25MB' => '25MB' ),
				'default'  => '2097152-2MB',
            ),
			array(
                'id'       => 'allow_tax_condition',
                'type'     => 'switch',
                'title'    => __( 'Display Condition Taxonomy', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'allow_tax_warranty',
                'type'     => 'switch',
                'title'    => __( 'Display Warranty Taxonomy', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'allow_lat_lon',
                'type'     => 'switch',
                'title'    => __( 'Latitude & Longitude', 'adforest' ),
				'desc'     => __( 'This will be display on ad post page for pin point map', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'sb_default_lat',
                'type'     => 'text',
                'title'    => __( 'Latitude', 'adforest' ),
                'subtitle' => __( 'for default map.', 'adforest' ),
				'required' => array( 'allow_lat_lon', '=', true ),
                'default'  => '40.7127837' ,
            ),
			array(
                'id'       => 'sb_default_long',
                'type'     => 'text',
                'title'    => __( 'Longitude', 'adforest' ),
                'subtitle' => __( 'for default map.', 'adforest' ),
				'required' => array( 'allow_lat_lon', '=', true ),
                'default'  => '-74.00594130000002' ,
            ),
			array(
                'id'       => 'allow_price_type',
                'type'     => 'switch',
                'title'    => __( 'Price Type', 'adforest' ),
				'desc'     => __( 'Display Price type option.', 'adforest' ),
                'default'  => true,
            ),
			
			array(
                'id'       => 'sb_ad_update_notice',
                'type'     => 'text',
                'title'    => __( 'Update Ad Notice', 'adforest' ),
				'default'  => 'Hey, be careful you are updating this AD.',
            ),
			array(
                'id'       => 'allow_featured_on_ad',
                'type'     => 'switch',
                'title'    => __( 'Allow make featured ad', 'adforest' ),
				'subtitle' => __( 'on ad post.', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'sb_feature_desc',
                'type'     => 'textarea',
                'title'    => __( 'Featured ad description', 'adforest' ),
				'subtitle' => __( 'on ad post.', 'adforest' ),
				'required' => array( 'allow_featured_on_ad', '=', true ),
				'default'  => 'Featured AD has more attention as compare to simple ad.',
            ),
			
			array(
                'id'       => 'bad_words_filter',
                'type'     => 'textarea',
                'title'    => __( 'Bad Words Filter', 'adforest' ),
				'subtitle' => __( 'comma separated', 'adforest' ),
				'placeholder'   => __( 'word1,word2', 'adforest' ),
				'desc'     => __( 'This words will be removed from AD Title and Description', 'adforest' ),
				'default'  => '',
            ),
			array(
                'id'       => 'bad_words_replace',
                'type'     => 'text',
                'title'    => __( 'Bad Words Replace Word', 'adforest' ),
				'desc'     => __( 'This words will be replace with above bad words list from AD Title and Description', 'adforest' ),
				'default'  => '',
            ),


		

        )
    ) );
	
	    Redux::setSection( $opt_name, array(
        'title'      => __( 'Ads View Settings', 'adforest' ),
        'id'         => 'sb_view_post',
        'desc'       => '',
        'icon' => 'el el-wrench',
		'subsection' => true,
        'fields'     => array(

		 array(
                'id'       => 'ad_layout_style',
                'type'     => 'button_set',
                'title'    => __( 'Ad Style', 'adforest' ),
                'options'  => array(
                    '1' => 'Style 1',
                    '2' => 'Style 2',
                ),
                'default'  => '1',
				'required' => array( 'design_type', '=', array( 'classic') ),
            ),
			
		
		array(
                'id'       => 'cat_and_location',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Taxonomy Link', 'adforest' ),
                'options'  => array(
                    'search' => esc_html__('Search Page','adforest'),
                    'category' => esc_html__('Category Page','adforest'),
                ),
                'default'  => 'search'
            ),
			
			
		 array(
                'id'       => 'ad_layout_style_modern',
                'type'     => 'button_set',
                'title'    => __( 'Ad Style', 'adforest' ),
                'options'  => array(
                    '3' => 'Style 1',
                    '4' => 'Style 2',
                ),
                'default'  => '3',
				'required' => array( 'design_type', '=', array( 'modern') ),
            ),
			


		 array(
                'id'       => 'ad_slider_type',
                'type'     => 'button_set',
                'title'    => __( 'Images Slider Type', 'adforest' ),
                'options'  => array(
                    '1' => 'With Thumbs',
                    '2' => 'Without Thumbs',
                ),
                'default'  => '1'
            ),
			
		 array(
                'id'       => 'ad_features_cols',
                'type'     => 'button_set',
                'title'    => __( 'Ad Features Cols', 'adforest' ),
                'options'  => array(
                    '12' => '1 Cols',
                    '6' => '2 Cols',
                    '4' => '3 Cols',
                    '3' => '4 Cols',
                ),
                'default'  => '4'
            ),
			
			
			array(
                'id'       => 'Related_ads_on',
                'type'     => 'switch',
                'title'    => __( 'Related Ads', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'sb_single_ad_text',
                'type'     => 'text',
                'title'    => __( 'Single Ad Title', 'adforest' ),
				'default'  => 'Ad Detail',
            ),
			array(
                'id'       => 'sb_related_ads_title',
                'type'     => 'text',
                'title'    => __( 'Related Ads Section Title', 'adforest' ),
				'required' => array( 'Related_ads_on', '=', array( true) ),
				'default'  => 'Similiar Ads',
            ),
			array(
                'id'       => 'max_ads',
                'type'     => 'select',
                'title'    => __( 'Max Related ads to show', 'adforest' ),
				'required' => array( 'Related_ads_on', '=', array( true) ),
				'options'  => array(1 => 1,2 => 2,3 => 3,4 => 4,5 => 5,6 => 6,7 => 7,8 => 8,9 => 9,10 => 10, 11 => 11, 12=> 12, 13 => 13, 14 => 14, 15 => 15),
				'default'  => 5,
            ),
		 array(
                'id'       => 'related_ad_style',
                'type'     => 'button_set',
                'title'    => __( 'Related Ad Style', 'adforest' ),
                'options'  => array(
                    '1' => 'Grid',
                    '2' => 'List',
                ),
				'required' => array( 'Related_ads_on', '=', array( true) ),
                'default'  => '1'
            ),
			
			array(
                'id'       => 'tips_title',
                'type'     => 'text',
                'title'    => __( 'Tips Section Title', 'adforest' ),
				'default'  => 'Safety tips for deal',
            ),
			array(
                'id'      => 'tips_for_ad',
                'type'    => 'editor',
                'title'   => __( 'Deal Tips', 'adforest' ),
                'default' => '<ol>
                         <li>Use a safe location to meet seller</li>
                         <li>Avoid cash transactions</li>
                         <li>Beware of unrealistic offers</li>
                      </ol>
',
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    'teeny'         => false,
                    'quicktags'     => false,
                )
            ), 
			
						array(
                'id'       => 'style_ad_720_1',
                'type'     => 'textarea',
                'title'    => __( 'Advertisement', 'adforest' ),
				'subtitle' => __( '720 x 90', 'adforest' ),
				'desc'     => __( 'Above the Ad description', 'adforest' ),
				'default'  => '<img alt="" src="'.trailingslashit( get_template_directory_uri () ).'images/728x90.jpg"> ',
            ),
			array(
                'id'       => 'style_ad_720_2',
                'type'     => 'textarea',
                'title'    => __( 'Advertisement', 'adforest' ),
				'subtitle' => __( '720 x 90', 'adforest' ),
				'desc'     => __( 'Below the Ad description', 'adforest' ),
				'default'  => '<img alt="" src="'.trailingslashit( get_template_directory_uri () ).'images/728x90.jpg"> ',
            ),
			array(
                'id'       => 'style_ad_160_1',
                'type'     => 'textarea',
                'title'    => __( 'Advertisement', 'adforest' ),
				'subtitle' => __( '160 x 600', 'adforest' ),
				'desc'     => __( 'Right Side', 'adforest' ),
				'required' => array( 'ad_layout_style', '=', array( '2' ) ),
				'default'  => '<img alt="" src="'.trailingslashit( get_template_directory_uri () ).'images/160x600.png"> ',
            ),
			array(
                'id'       => 'style_ad_160_2',
                'type'     => 'textarea',
                'title'    => __( 'Advertisement', 'adforest' ),
				'subtitle' => __( '160 x 600', 'adforest' ),
				'desc'     => __( 'Left Side', 'adforest' ),
				'required' => array( 'ad_layout_style', '=', array( '2' ) ),
				'default'  => '<img alt="" src="'.trailingslashit( get_template_directory_uri () ).'images/160x600.png"> ',
            ),
			
            array(
                'id'       => 'sb_ad_sold',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Ad sold image', 'adforest' ),
                'compiler' => 'true',
                'subtitle' => __( 'Dimensions: 700 x 423', 'adforest' ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/sold-out.png' ),
            ),
            array(
                'id'       => 'sb_ad_expired',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Ad expired image', 'adforest' ),
                'compiler' => 'true',
                'subtitle' => __( 'Dimensions: 700 x 423', 'adforest' ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/expired.png' ),
            ),


        )
    ) );	
	
	
		    Redux::setSection( $opt_name, array(
        'title'      => __( 'Search Settings', 'adforest' ),
        'id'         => 'ad_search_settings',
        'desc'       => '',
        'icon' => 'el el-cogs',
		'subsection' => true,
        'fields'     => array(
		
			array(
                'id'       => 'sb_search_page',
                'type'     => 'select',
                'data'     => 'pages',
                'title'    => __( 'Search Page', 'adforest' ),
				'default'  => '',
            ),
			 array(
                'id'       => 'search_design',
                'type'     => 'button_set',
                'title'    => __( 'Search Layout', 'adforest' ),
                'options'  => array(
                    'sidebar' => 'With sidebar',
                    'topbar' => 'With Top Bar',
                    'map' => 'With Map',
                ),
                'default'  => 'sidebar',
				'required' => array( 'design_type', '=', array( 'modern') ),
            ),
			 array(
                'id'       => 'search_ad_layout_for_sidebar',
                'type'     => 'button_set',
                'title'    => __( 'Search Layout', 'adforest' ),
                'options'  => array(
                    'grid_1' => 'Grid 1',
                    'grid_2' => 'Grid 2',
                    'grid_3' => 'Grid 3',
                    'grid_4' => 'Grid 4',
                    'grid_5' => 'Grid 5',
                    'list_2' => 'List 1',
                    'list_3' => 'List 2',
                ),
                'default'  => 'grid_1',
				'required' => array( array('design_type', '=', array( 'modern')), array('search_design', '=', array( 'sidebar','map')) ),
            ),
		array(
			'id'       => 'sb_radius_search',
			'type'     => 'switch',
			'title'    => __( 'Allowed radius search', 'adforest' ),
			'required' => array( array('search_design', '=', array( 'map')) ),
			'default'  => true,
		),

			 array(
                'id'       => 'search_ad_layout_for_topbar',
                'type'     => 'button_set',
                'title'    => __( 'Search Layout', 'adforest' ),
                'options'  => array(
                    'grid_1' => 'Grid 1',
                    'grid_2' => 'Grid 2',
                    'grid_3' => 'Grid 3',
                    'grid_4' => 'Grid 4',
                    'grid_5' => 'Grid 5',
                ),
                'default'  => 'grid_1',
				'required' => array( array('design_type', '=', array( 'modern')), array('search_design', '=', array( 'topbar')) ),
            ),
			
			array(
                'id'       => 'search_map_marker',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Map marker', 'adforest' ),
                'compiler' => 'true',
                'subtitle'     => __( '50x77', 'adforest' ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/car-marker.png' ),
				'required' => array( 'search_design', '=', array( 'map') ),
            ),
			array(
                'id'       => 'search_map_marker_more',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Map marker more', 'adforest' ),
                'compiler' => 'true',
                'subtitle'     => __( '50x77', 'adforest' ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/car-marker-more.png' ),
				'required' => array( 'search_design', '=', array( 'map') ),
            ),
          array(
                'id'       => 'search_map_lat',
                'type'     => 'text',
                'title'    => __( 'Default Latitude', 'adforest' ),
				'required' => array( 'search_design', '=', array( 'map') ),
                'default'  => '39.739236',				
            ),
          array(
                'id'       => 'search_map_long',
                'type'     => 'text',
                'title'    => __( 'Default Longitude', 'adforest' ),
				'required' => array( 'search_design', '=', array( 'map') ),
                'default'  => '-104.990251',				
            ),
			array(
                'id'       => 'search_map_zoom',
                'type'     => 'select',
                'title'    => __( 'Map', 'adforest' ),
				'required' => array( 'search_design', '=', array( 'map') ),
				'options'  => array(1 => 1,2 => 2,3 => 3,4 => 4,5 => 5,6 => 6,7 => 7,8 => 8,9 => 9,10 => 10, 11 => 11, 12=> 12, 13 => 13, 14 => 14, 15 => 15),
				'default'  => 6,
            ),
			
			 array(
                'id'       => 'search_widget_limit',
                'type'     => 'button_set',
                'title'    => __( 'Default widgets show', 'adforest' ),
                'options'  => array(
                    '200' => 'All',
                    '3' => '3 Widgets',
                    '6' => '6 Widgets',
                    '9' => '9 Widgets',
                ),
                'default'  => '6',
				'required' => array( 'search_design', '=', array( 'topbar', 'map') ),
            ),
			array(
                'id'       => 'search_breadcrumb_bg',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Search BG Image', 'adforest' ),
                'compiler' => 'true',
                'desc'     => __( 'Search BG image on breadcrumb.', 'adforest' ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/ferrari.jpg' ),
				'required' => array( 'search_design', '=', array( 'topbar') ),
            ),


			 array(
                'id'       => 'search_layout',
                'type'     => 'button_set',
                'title'    => __( 'Search Layout', 'adforest' ),
                'options'  => array(
                    'grid_1' => 'Grid 1',
                    'grid_2' => 'Grid 2',
                    'grid_3' => 'Grid 3',
                    'list_1' => 'List 1',
                    'list_2' => 'List 2',
                    'list_3' => 'List 3',
                ),
                'default'  => 'grid_1',
				'required' => array( 'design_type', '=', array( 'classic') ),
            ),
			
			
			
			
			 array(
                'id'       => 'search_bg',
                'type'     => 'button_set',
                'title'    => __( 'Search Section BG Color', 'adforest' ),
                'options'  => array(
                    'white' => 'White',
                    'gray' => 'Gray',
                ),
                'default'  => 'gray'
            ),
			 array(
                'id'       => 'search_res_bg',
                'type'     => 'button_set',
                'title'    => __( 'Search results BG Color', 'adforest' ),
                'options'  => array(
                    'white-bg' => 'White',
                    '' => 'Gray',
                ),
                'default'  => 'white-bg'
            ),
			
			array(
                'id'       => 'feature_on_search',
                'type'     => 'switch',
                'title'    => __( 'Featured Ads', 'adforest' ),
                'default'  => true,
            ),
			array(
                'id'       => 'max_ads_feature',
                'type'     => 'select',
                'title'    => __( 'Max Featured ads to show', 'adforest' ),
				'required' => array( 'feature_on_search', '=', array( true) ),
				'options'  => array(1 => 1,2 => 2,3 => 3,4 => 4,5 => 5,6 => 6,7 => 7,8 => 8,9 => 9,10 => 10, 11 => 11, 12=> 12, 13 => 13, 14 => 14, 15 => 15),
				'default'  => 5,
            ),
          array(
                'id'       => 'feature_ads_title',
                'type'     => 'text',
                'title'    => __( 'Featured Ads Title', 'adforest' ),
				'required' => array( 'feature_on_search', '=', array( true) ),
                'default'  => 'Featured Ads',				
            ),

			array(
                'id'       => 'search_ad_720_1',
                'type'     => 'textarea',
                'title'    => __( 'Advertisement', 'adforest' ),
				'subtitle' => __( '720 x 90', 'adforest' ),
				'desc'     => __( 'Above the Ad description', 'adforest' ),
				'default'  => '<img alt="" src="'.trailingslashit( get_template_directory_uri () ).'images/728x90.jpg"> ',
            ),
			array(
                'id'       => 'search_ad_720_2',
                'type'     => 'textarea',
                'title'    => __( 'Advertisement', 'adforest' ),
				'subtitle' => __( '720 x 90', 'adforest' ),
				'desc'     => __( 'Below the Ad description', 'adforest' ),
				'default'  => '<img alt="" src="'.trailingslashit( get_template_directory_uri () ).'images/728x90.jpg"> ',
            ),

        )
    ) );	

		/* ------------------Email Templates Settings ----------------------- */
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Email Templates', 'adforest' ),
        'id'         => 'sb_email_templates',
        'desc'       => '',
        'icon' => 'el el-pencil',
        'fields'     => array(
          array(
                'id'       => 'sb_msg_subject_on_new_ad',
                'type'     => 'text',
                'title'    => __( 'New Ad email subject', 'adforest' ),
                'desc'     => __( '%site_name% , %ad_owner% , %ad_title% will be translated accordingly.', 'adforest' ),
                'default'  => 'You have new Ad - Adforest',				
            ),
          array(
                'id'       => 'sb_msg_from_on_new_ad',
                'type'     => 'text',
                'title'    => __( 'New Ad FROM', 'adforest' ),
				'desc'     => __( 'FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest' ),
                'default'  => 'From: '.get_bloginfo( 'name' ).' <'.get_option( 'admin_email' ).'>',				
            ),
          array(
                'id'       => 'sb_msg_on_new_ad',
                'type'     => 'editor',
                'title'    => __( 'New Ad Posted Message', 'adforest' ),
				'args'   => array(
						'teeny'            => true,
						'textarea_rows'    => 10,
						'wpautop' => false,
					),
				'desc'     => __( '%site_name% , %ad_owner% , %ad_title% , %ad_link% will be translated accordingly.', 'adforest' ),
                'default'  => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/sb.png" alt="" width="80" height="80" /><br/>
A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>Admin,</b></span></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">You\'ve new AD;</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Title: %ad_title%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Link: <a href="%ad_link%">%ad_title%</a></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Poster: %ad_owner%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',				
            ),
          array(
                'id'       => 'sb_message_subject_on_new_ad',
                'type'     => 'text',
                'title'    => __( 'New Message email subject', 'adforest' ),
                'desc'     => __( '%site_name% , %ad_title% will be translated accordingly.', 'adforest' ),
                'default'  => 'You have new message - Adforest',				
            ),
          array(
                'id'       => 'sb_message_from_on_new_ad',
                'type'     => 'text',
                'title'    => __( 'New Message FROM', 'adforest' ),
				'desc'     => __( 'FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest' ),
                'default'  => 'From: '.get_bloginfo( 'name' ).' <'.get_option( 'admin_email' ).'>',				
            ),
          array(
                'id'       => 'sb_message_on_new_ad',
                'type'     => 'editor',
                'title'    => __( 'New Message template', 'adforest' ),
				'args'   => array(
						'teeny'            => true,
						'textarea_rows'    => 10,
						'wpautop' => false,
					),
                'desc'     => __( '%site_name% , %message% , %sender_name%, %ad_title% , %ad_link% will be translated accordingly.', 'adforest' ),
                'default'  => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/sb.png" alt="" width="80" height="80" />
<br/>A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>Admin,</b></span></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">You\'ve new Message;</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Title: %ad_title%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Link: <a href="%ad_link%">%ad_title%</a></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Sender: %sender_name%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Message: %message%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',				
            ),
          array(
                'id'       => 'sb_report_ad_subject',
                'type'     => 'text',
                'title'    => __( 'Ad report email subject', 'adforest' ),
                'desc'     => __( '%site_name% , %ad_title% will be translated accordingly.', 'adforest' ),
                'default'  => 'Ad Reported - Adforest',				
            ),
          array(
                'id'       => 'sb_report_ad_from',
                'type'     => 'text',
                'title'    => __( 'Ad report email FROM', 'adforest' ),
				'desc'     => __( 'FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest' ),
                'default'  => 'From: '.get_bloginfo( 'name' ).' <'.get_option( 'admin_email' ).'>',				
            ),
          array(
                'id'       => 'sb_report_ad_message',
                'type'     => 'editor',
                'title'    => __( 'Ad Report template', 'adforest' ),
				'args'   => array(
						'teeny'            => true,
						'textarea_rows'    => 10,
						'wpautop' => false,
					),
                'desc'     => __( '%site_name% , %ad_owner% , %ad_title% , %ad_link% will be translated accordingly.', 'adforest' ),
                'default'  => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/sb.png" alt="" width="80" height="80" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>Admin,</b></span></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Below Ad is reported.</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Title: %ad_title%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Link: <a href="%ad_link%">%ad_title%</a></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Ad Poster: %ad_owner%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',				
            ),
          array(
                'id'       => 'sb_forgot_password_subject',
                'type'     => 'text',
                'title'    => __( 'Reset Password email subject', 'adforest' ),
                'desc'     => __( '%site_name% will be translated accordingly.', 'adforest' ),
                'default'  => 'Reset Password - Adforest',				
            ),
          array(
                'id'       => 'sb_forgot_password_from',
                'type'     => 'text',
                'title'    => __( 'Reset Password email FROM', 'adforest' ),
				'desc'     => __( 'FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest' ),
                'default'  => get_bloginfo( 'name' ).' <'.get_option( 'admin_email' ).'>',				
            ),
          array(
                'id'       => 'sb_forgot_password_message',
                'type'     => 'editor',
                'title'    => __( 'Reset Password template', 'adforest' ),
				'args'   => array(
						'teeny'            => true,
						'textarea_rows'    => 10,
						'wpautop' => false,
					),
                'desc'     => __( '%site_name% , %user% , %reset_link% will be translated accordingly.', 'adforest' ),
                'default'  => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/sb.png" alt="" width="80" height="80" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %user%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
Please use this below link to reset your password.
<br />
%reset_link%
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',				
            ),
          array(
                'id'       => 'sb_new_rating_subject',
                'type'     => 'text',
                'title'    => __( 'Rating email subject', 'adforest' ),
                'desc'     => __( '%site_name% will be translated accordingly.', 'adforest' ),
                'default'  => 'New Rating - Adforest',				
            ),
          array(
                'id'       => 'sb_new_rating_from',
                'type'     => 'text',
                'title'    => __( 'New rating email FROM', 'adforest' ),
				'desc'     => __( 'FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest' ),
                'default'  => 'From: '.get_bloginfo( 'name' ).' <'.get_option( 'admin_email' ).'>',				
            ),
          array(
                'id'       => 'sb_new_rating_message',
                'type'     => 'editor',
                'title'    => __( 'New rating template', 'adforest' ),
				'args'   => array(
						'teeny'            => true,
						'textarea_rows'    => 10,
						'wpautop' => false,
					),
                'desc'     => __( '%site_name% , %receiver% , %rator% , %rating% , %comments% , %rating_link% will be translated accordingly.', 'adforest' ),
                'default'  => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/sb.png" alt="" width="80" height="80" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %receiver%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
You got new rating;

User who rated: %rator%

Stars: %rating%

Link: %rating_link%

Comments: %comments%
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',				
            ),
          array(
                'id'       => 'sb_new_bid_subject',
                'type'     => 'text',
                'title'    => __( 'Bid email subject', 'adforest' ),
                'desc'     => __( '%site_name% will be translated accordingly.', 'adforest' ),
                'default'  => 'New Bid - Adforest',				
            ),
          array(
                'id'       => 'sb_new_bid_from',
                'type'     => 'text',
                'title'    => __( 'Bid email FROM', 'adforest' ),
				'args'   => array(
						'teeny'            => true,
						'textarea_rows'    => 10,
						'wpautop' => false,
					),
				'desc'     => __( 'FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest' ),
                'default'  => 'From: '.get_bloginfo( 'name' ).' <'.get_option( 'admin_email' ).'>',				
            ),
          array(
                'id'       => 'sb_new_bid_message',
                'type'     => 'editor',
                'title'    => __( 'Bid email template', 'adforest' ),
                'desc'     => __( '%site_name% , %receiver% , %bidder% , %bid% , %comments% , %bid_link% will be translated accordingly.', 'adforest' ),
                'default'  => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/sb.png" alt="" width="80" height="80" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %receiver%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
You got new Bid;

Bidder: %bidder%

Bid: %bid%

Link: %bid_link%

Comments: %comments%
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',				
            ),


          array(
                'id'       => 'sb_new_user_admin_message_subject',
                'type'     => 'text',
                'title'    => __( 'New user email template subject for Admin', 'adforest' ),
                'default'  => 'New User Registration',				
            ),
          array(
                'id'       => 'sb_new_user_admin_message_from',
                'type'     => 'text',
                'title'    => __( 'New user email FROM for Admin', 'adforest' ),
				'desc'     => __( 'NAME valid@email.com is compulsory as we gave in default.', 'adforest' ),
                'default'  => get_bloginfo( 'name' ).' <'.get_option( 'admin_email' ).'>',				
            ),
          array(
                'id'       => 'sb_new_user_admin_message',
                'type'     => 'editor',
                'title'    => __( 'New user email template for Admin', 'adforest' ),
				'args'   => array(
						'teeny'            => true,
						'textarea_rows'    => 10,
						'wpautop' => false,
					),
                'desc'     => __( '%site_name% , %display_name%, %email% will be translated accordingly.', 'adforest' ),
                'default'  => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/sb.png" alt="" width="80" height="80" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello Admin</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
New user has registered on your site %site_name%;

Name: %display_name%

Email: %email%

&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',				
            ),
			
			
          array(
                'id'       => 'sb_new_user_message_subject',
                'type'     => 'text',
                'title'    => __( 'New user email template subject', 'adforest' ),
                'default'  => 'New User Registration',				
            ),
          array(
                'id'       => 'sb_new_user_message_from',
                'type'     => 'text',
                'title'    => __( 'New user email FROM', 'adforest' ),
				'desc'     => __( 'NAME valid@email.com is compulsory as we gave in default.', 'adforest' ),
                'default'  => get_bloginfo( 'name' ).' <'.get_option( 'admin_email' ).'>',				
            ),
          array(
                'id'       => 'sb_new_user_message',
                'type'     => 'editor',
                'title'    => __( 'New user email template', 'adforest' ),
				'args'   => array(
						'teeny'            => true,
						'textarea_rows'    => 10,
						'wpautop' => false,
					),
                'desc'     => __( '%site_name% , %user_name% %display_name% %verification_link% will be translated accordingly.', 'adforest' ),
                'default'  => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/sb.png" alt="" width="80" height="80" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %display_name%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
Welcome to %site_name%.
<br />
Your details are below;
<br />

Username: %user_name%
<br />


&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',				
            ),
			
			
          array(
                'id'       => 'sb_active_ad_email_subject',
                'type'     => 'text',
                'title'    => __( 'Ad activation subject', 'adforest' ),
                'default'  => 'You Ad has been activated.',				
            ),
          array(
                'id'       => 'sb_active_ad_email_from',
                'type'     => 'text',
                'title'    => __( 'Ad activation FROM', 'adforest' ),
				'desc'     => __( 'NAME valid@email.com is compulsory as we gave in default.', 'adforest' ),
                'default'  => get_bloginfo( 'name' ).' <'.get_option( 'admin_email' ).'>',				
            ),
          array(
                'id'       => 'sb_active_ad_email_message',
                'type'     => 'editor',
                'title'    => __( 'Ad activation message', 'adforest' ),
				'args'   => array(
						'teeny'            => true,
						'textarea_rows'    => 10,
						'wpautop' => false,
					),
                'desc'     => __( '%site_name% , %user_name%, %ad_title% ,  %ad_link% will be translated accordingly.', 'adforest' ),
                'default'  => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/sb.png" alt="" width="80" height="80" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %user_name%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
<br />
You ad has been activated.
<br />
Details are below;
<br />

Ad Title: %ad_title%
<br />
Ad Link: %ad_link%
<br />


&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',				
            ),


        )
    ) );	
		/* ------------------Users Settings ----------------------- */
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Users', 'adforest' ),
        'id'         => 'sb_user_settings',
        'desc'       => '',
        'icon' => 'el el-cog-alt',
        'fields'     => array(
		 array(
                'id'       => 'sb_phone_verification',
				'type'     => 'switch',
                'title'    => __( 'Phone verfication', 'adforest' ),
                'default'  => false,
				'desc'		=> __( 'If phone verification is on then system put verified batch to ad details on number so other can see this number is verified.', 'adforest' ),
            ),
			array(
                'id'       => 'sb_resend_code',
                'type'     => 'text',
                'title'    => __( 'Resend security code', 'adforest' ),
				'subtitle'    => __( 'In seconds', 'adforest' ),
				'desc'     => __( 'Only integer value without spaces, 30 means 30-seconds', 'adforest' ),
				'required' => array( 'sb_phone_verification', '=', array( '1' ) ),
				'default'  => 30,
            ),
		 array(
                'id'       => 'sb_change_ph',
				'type'     => 'switch',
                'title'    => __( 'Change phone number while ad posting.', 'adforest' ),
                'desc'    => __( 'If off then only user profile number will be display and can not be changeable.', 'adforest' ),
				'required' => array( 'sb_phone_verification', '=', array( '1' ) ),
                'default'  => true,
            ),
		 array(
                'id'       => 'sb_new_user_email_verification',
				'type'     => 'switch',
                'title'    => __( 'New user email verification', 'adforest' ),
                'default'  => false,
				'desc'		=> __( 'If verfication on then please update your new user email template by verification link.', 'adforest' ),
            ),
			array(
                'id'       => 'admin_contact_page',
                'type'     => 'select',
                'data'     => 'pages',
                'multi'    => false,
                'title'    => __( 'Contact to Admin', 'adforest' ),
				'required' => array( 'sb_new_user_email_verification', '=', array( '1' ) ),
                'desc'     => __( 'Select the page if verification email is not sent to new user.', 'adforest' ),
            ),

		 array(
                'id'       => 'sb_new_user_email_to_admin',
				'type'     => 'switch',
                'title'    => __( 'New User Email to Admin', 'adforest' ),
                'default'  => true
            ),
		 array(
                'id'       => 'sb_new_user_email_to_user',
				'type'     => 'switch',
                'title'    => __( 'Welcome Email to User', 'adforest' ),
                'default'  => true
            ),
		 array(
                'id'       => 'sb_user_phone_required',
				'type'     => 'switch',
                'title'    => __( 'User phone number required', 'adforest' ),
                'default'  => true
            ),
		 array(
                'id'       => 'user_public_profile',
                'type'     => 'button_set',
                'title'    => __( 'Public Profile', 'adforest' ),
                'options'  => array(
                    'simple' => 'Simple',
                    'modern' => 'Modern',
                ),
                'default'  => 'simple'
            ),
			array(
                'id'       => 'sb_enable_user_badge',
                'type'     => 'switch',
                'title'    => __( 'Enable Badge', 'adforest' ),
                'subtitle' => __( 'for display', 'adforest' ),
				'required' => array( 'user_public_profile', '=', 'modern' ),
                'default'  => true ,
            ),
			array(
                'id'       => 'sb_enable_social_links',
                'type'     => 'switch',
                'title'    => __( 'Enable Social Profiles', 'adforest' ),
                'subtitle' => __( 'for display', 'adforest' ),
				'required' => array( 'user_public_profile', '=', 'modern' ),
                'default'  => false ,
            ),
			array(
                'id'       => 'sb_enable_user_ratting',
                'type'     => 'switch',
                'title'    => __( 'Enable User Rating', 'adforest' ),
                'subtitle' => __( 'To logged in users', 'adforest' ),
				'required' => array( 'user_public_profile', '=', 'modern' ),
                'default'  => true ,
            ),
			array(
                'id'       => 'email_to_user_on_rating',
                'type'     => 'switch',
                'title'    => __( 'Send Email to user', 'adforest' ),
                'subtitle' => __( 'on new ratting', 'adforest' ),
				'required' => array( 'sb_enable_user_ratting', '=', '1' ),
                'default'  => true ,
            ),

        )
    ) );	
		/* ------------------URL Rewriting Settings ----------------------- */
    Redux::setSection( $opt_name, array(
        'title'      => __( 'URL Rewriting', 'adforest' ),
        'id'         => 'sb_url_rewriting',
        'desc'       => '',
        'icon' => 'el el-cogs',
        'fields'     => array(
			array(
                'id'       => 'sb_url_rewriting_enable',
                'type'     => 'switch',
                'title'    => __( 'Enable url rewriting', 'adforest' ),
                'default'  => false ,
            ),
			array(
                'id'       => 'sb_ad_slug',
                'type'     => 'text',
                'title'    => __( 'Classified ad slug', 'adforest' ),
				'required' => array( 'sb_url_rewriting_enable', '=', '1' ),
                'default'  => "",
            ),

        )
    ) );
	
			/* ------------------Comment/Bidding Settings ----------------------- */
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Bidding Settings', 'adforest' ),
        'id'         => 'sb_comments_settings',
        'desc'       => '',
        'icon' => 'el el-cogs',
        'fields'     => array(
			array(
                'id'       => 'sb_enable_comments_offer',
                'type'     => 'switch',
                'title'    => __( 'Enable Bidding', 'adforest' ),
                'default'  => false ,
            ),
			array(
                'id'       => 'sb_enable_comments_offer_user',
                'type'     => 'switch',
                'title'    => __( 'Give bidding option to user', 'adforest' ),
				'required' => array( 'sb_enable_comments_offer', '=', '1' ),
                'default'  => false ,
            ),
			array(
                'id'       => 'sb_enable_comments_offer_user_title',
                'type'     => 'text',
                'title'    => __( 'User Section Title', 'adforest' ),
				'required' => array( 'sb_enable_comments_offer_user', '=', '1' ),
                'default'  => "Bidding",
            ),
			array(
                'id'       => 'sb_email_on_new_bid_on',
                'type'     => 'switch',
                'title'    => __( 'Email to Ad author', 'adforest' ),
                'subtitle'    => __( 'on bid', 'adforest' ),
				'required' => array( 'sb_enable_comments_offer', '=', '1' ),
                'default'  => false ,
            ),
			array(
                'id'       => 'sb_comments_section_title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'adforest' ),
				'required' => array( 'sb_enable_comments_offer', '=', '1' ),
                'default'  => "Bids",
            ),
			array(
                'id'       => 'sb_comments_section_note',
                'type'     => 'text',
                'title'    => __( 'Disclaimer note', 'adforest' ),
				'required' => array( 'sb_enable_comments_offer', '=', '1' ),
                'default'  => "*Your phone number will be shown to post author",
            ),

        )
    ) );	

	
		/* ------------------BreadCrumb Settings ----------------------- */
    Redux::setSection( $opt_name, array(
        'title'      => __( 'BreadCrumb', 'adforest' ),
        'id'         => 'sb_bread_crumb',
        'desc'       => '',
        'icon' => 'el el-cog-alt',
        'fields'     => array(
			 array(
                'id'       => 'Breadcrumb_type',
                'type'     => 'button_set',
                'title'    => __( 'Communications Mode', 'adforest' ),
                'options'  => array(
                    '1' => __('Classic', 'adforest' ),
                    '2' => __('Modern', 'adforest' ),
                ),
                'default'  => '1'
            ),

            array(
                'id'       => 'breadcrumb_bg',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'BG Image', 'adforest' ),
                'compiler' => 'true',
                'desc'     => __( 'BG image on breadcrumb.', 'adforest' ),
				'required' => array( 'Breadcrumb_type', '=', '1' ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/breadcrumb.jpg' ),
            ),

        )
    ) );	


		/* ------------------Blog Settings ----------------------- */
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Blog Settings', 'adforest' ),
        'id'         => 'sb-blog-settings',
        'desc'       => '',
        'icon' => 'el el-edit',
        'fields'     => array(
		 array(
                'id'       => 'blog_sidebar',
                'type'     => 'button_set',
                'title'    => __( 'Blog Sidebar', 'adforest' ),
                'options'  => array(
                    'right' => 'Right',
                    'left' => 'Left',
                    'no-sidebar' => 'No Sidebar',
                ),
                'default'  => 'right'
            ),
          array(
                'id'       => 'sb_blog_page_title',
                'type'     => 'text',
                'title'    => __( 'Blog Page Title', 'adforest' ),
                'subtitle' => __( '', 'adforest' ),
                'desc'     => '',
                'default'  => 'Blog Posts',				
            ),
			array(
                'id'       => 'ad_right',
                'type'     => 'textarea',
                'title'    => __( 'Ad on Right', 'adforest' ),
                'subtitle' => __( '160 x 600', 'adforest' ),
				'required' => array( 'single_style', '=', array( 'no-sidebar' ) ),
                'default'  => '<img src="' . trailingslashit( get_template_directory_uri () ) . 'images/160x600.png' . '" title="'.esc_attr( 'Ad', 'adforest' ).'" />',				
            ),
			array(
                'id'       => 'ad_left',
                'type'     => 'textarea',
                'title'    => __( 'Ad on Left', 'adforest' ),
                'subtitle' => __( '160 x 600', 'adforest' ),
				'required' => array( 'single_style', '=', array( 'no-sidebar' ) ),
                'default'  => '<img src="' . trailingslashit( get_template_directory_uri () ) . 'images/160x600.png' . '" title="'.esc_attr( 'Ad', 'adforest' ).'" />',				
            ),
          array(
                'id'       => 'sb_blog_single_title',
                'type'     => 'text',
                'title'    => __( 'Single Post Title', 'adforest' ),
                'subtitle' => __( '', 'adforest' ),
                'desc'     => '',
                'default'  => 'Blog Details',				
            ),
			
			array(
                'id'       => 'enable_share_post',
                'type'     => 'switch',
                'title'    => __( 'Enable Share', 'adforest' ),
                'subtitle' => __( 'on single Post', 'adforest' ),
                'default'  => true ,
            ),
			
        )
    ) );	


		/* ------------------API Settings ----------------------- */
    Redux::setSection( $opt_name, array(
        'title'      => __( 'API Settings', 'adforest' ),
        'id'         => 'sb-api-settings',
        'desc'       => '',
        'icon' => 'el el-cogs',
        'fields'     => array(
		
          array(
                'id'       => 'google_api_key',
                'type'     => 'text',
                'title'    => __( 'Google ReCAPTCHA API Key', 'adforest' ),
                'subtitle' => __( '', 'adforest' ),
                'desc' => adforest_make_link ( 'https://www.google.com/recaptcha/admin' , __( 'How to Find it' , 'adforest' ) ),
                'default'  => '',				
            ),
          array(
                'id'       => 'google_api_secret',
                'type'     => 'text',
                'title'    => __( 'Google ReCAPTCHA API Secret', 'adforest' ),
                'subtitle' => __( '', 'adforest' ),
                'desc' => adforest_make_link ( 'https://www.google.com/recaptcha/admin' , __( 'How to Find it' , 'adforest' ) ),
                'default'  => '',				
            ),
			
          array(
                'id'       => 'mailchimp_api_key',
                'type'     => 'text',
                'title'    => __( 'MailChimp API Key', 'adforest' ),
				'desc' => adforest_make_link ( 'http://kb.mailchimp.com/integrations/api-integrations/about-api-keys' , __( 'How to Find it' , 'adforest' ) ),
            ),
          array(
                'id'       => 'gmap_api_key',
                'type'     => 'text',
                'title'    => __( 'Google Map API Key', 'adforest' ),
				'desc' => adforest_make_link ( 'https://developers.google.com/maps/documentation/javascript/get-api-key' , __( 'How to Find it' , 'adforest' ) ),
				'default'  => 'AIzaSyB_La6qmewwbVnTZu5mn3tVrtu6oMaSXaI',
            ),
			
          array(
                'id'       => 'fb_api_key',
                'type'     => 'text',
                'title'    => __( 'Facebook Client ID', 'adforest' ),
				'desc' => adforest_make_link ( 'https://developers.facebook.com/?advanced_app_create=true' , __( 'How to Make' , 'adforest' ) ),
            ),
			
          array(
                'id'       => 'gmail_api_key',
                'type'     => 'text',
                'title'    => __( 'Gmail Client ID', 'adforest' ),
				'desc' => adforest_make_link ( 'https://console.developers.google.com/apis/api/gmail/' , __( 'How to Find it' , 'adforest' ) ),
            ),
			
			
          array(
                'id'       => 'redirect_uri',
                'type'     => 'text',
                'title'    => __( 'Redirect URI', 'adforest' ),
				'desc' => __('Must be URI where you want to redirect after thentication, it will be your web url.','adforest'),
            ),
			
        )
    ) );	

		/* ------------------Comming Soon ----------------------- */
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Comming Soon', 'adforest' ),
        'id'         => 'sb_comming_soon_section',
        'desc'       => '',
        'icon' => 'el el-screen',
        'fields'     => array(
			 array(
                'id'       => 'sb_comming_soon_mode',
                'type'     => 'switch',
                'title'    => __( 'Comming Soon Mode', 'adforest' ),
                'subtitle' => '',
                'default'  =>  false
            ),
            array(
                'id'       => 'sb_comming_soon_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Comming Soon Logo', 'adforest' ),
                'compiler' => 'true',
                'subtitle' => __( 'Dimensions: 220 x 40', 'adforest' ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/logo.png' ),
            ),
			 array(
                'id'       => 'coming_soon_notify',
                'type'     => 'switch',
                'title'    => __( 'Notify Section', 'adforest' ),
                'subtitle' => '',
                'default'  =>  false
            ),
          array(
                'id'       => 'mailchimp_notify_list_id',
                'type'     => 'text',
                'title'    => __( 'MailChimp List ID', 'adforest' ),
				'required' => array( 'coming_soon_notify', '=', true ),
				
				'desc' => adforest_make_link ( 'http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id' , __( 'How to Find it' , 'adforest' ) ),
            ),
			array(
                'id'       => 'sb_comming_soon_date',
                'type'     => 'text',
                'title'    => __( 'Set Date', 'adforest' ),
                'subtitle' => __( 'When you ready to launch', 'adforest' ),
                'desc'     => __( 'YYYY/MM/DD', 'adforest' ),
                'default'  => '2017/06/28',			
            ),
			array(
                'id'       => 'sb_comming_soon_title',
                'type'     => 'textarea',
                'title'    => __( 'Description', 'adforest' ),
                'default'  => 'Our website is under construction.',				
            ),
				   array(
				'id' => 'social_media_soon',
				'type' => 'sortable',
				'title' => __('Social Media', 'adforest'),
				'desc' => __('You can sort it out as you want.', 'adforest'),
				'label' => true,
				'options' => array(
					'Facebook' => '',
					'Twitter' => '',
					'Linkedin' => '',
					'Google' => '',
					'YouTube' => '',
					'Vimeo' => '',
					'Pinterest' => '',
					'Tumblr' => '',
					'Instagram' => '',
					'Reddit' => '',
					'Flickr' => '',
					'StumbleUpon' => '',
					'Delicious' => '',
					'dribble' => '',
					'behance' => '',
					'DeviantART' => '',
				),
	 
			),
			
        )
    ) );	


		/* ------------------Social Media ----------------------- */
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Social Media', 'adforest' ),
        'id'         => 'sb_theme_social_media',
        'desc'       => '',
        'icon' => 'el el-share',
        'fields'     => array(
				   array(
				'id' => 'social_media',
				'type' => 'sortable',
				'title' => __('Social Media', 'adforest'),
				'desc' => __('You can sort it out as you want.', 'adforest'),
				'label' => true,
				'options' => array(
					'Facebook' => '',
					'Twitter' => '',
					'Linkedin' => '',
					'Google' => '',
					'YouTube' => '',
					'Vimeo' => '',
					'Pinterest' => '',
					'Tumblr' => '',
					'Instagram' => '',
					'Reddit' => '',
					'Flickr' => '',
					'StumbleUpon' => '',
					'Delicious' => '',
					'dribble' => '',
					'behance' => '',
					'DeviantART' => '',
				),
	 
			),
			

        )
    ) );	


	
		
		/* ------------------  Footer Settings----------------------- */
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Footer Settings', 'adforest' ),
        'id'         => 'sb-footer',
        'desc'       => '',
        'icon' => 'el el-cog-alt',
        'fields'     => array(
		 array(
                'id'       => 'footer_style',
                'type'     => 'button_set',
                'title'    => __( 'Footer Style', 'adforest' ),
                'options'  => array(
                    '1' => 'Footer-1',
                    '2' => 'Footer-2',
                    '3' => 'Footer-3',
                    '4' => 'Footer-4',
                ),
                'default'  => '1'
            ),
			
		 array(
                'id'       => 'footer_color',
                'type'     => 'button_set',
                'title'    => __( 'Footer Style', 'adforest' ),
                'options'  => array(
                    '' => 'Black',
                    'new-demo' => 'White',
                ),
				'required' => array( array('design_type', '=', array( 'modern')), array('footer_style', '=', array( '2')) ),
                'default'  => ''
            ),
		 array(
                'id'       => 'footer_options',
                'type'     => 'button_set',
                'title'    => __( 'Footer Style', 'adforest' ),
                'options'  => array(
                    '' => 'Without BG',
                    'with_bg' => 'With BG',
                ),
				'required' => array( 'footer_style', '=', '1' ),
                'default'  => ''
            ),

            array(
                'id'       => 'footer_bg',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Footer BG', 'adforest' ),
                'compiler' => 'true',
				'required' => array( 'footer_options', '=', 'with_bg' ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/footer.jpg' ),
            ),
            array(
                'id'       => 'footer_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Footer Logo', 'adforest' ),
                'compiler' => 'true',
                'desc'     => __( 'Site Logo image for the site.', 'adforest' ),
                'subtitle' => __( 'Dimensions: 230 x 40', 'adforest' ),
				'required' => array( 'footer_style', '=', array('1','2', '3') ),
                'default'  => array( 'url' => trailingslashit( get_template_directory_uri () ) . 'images/logo.png' ),
            ),
			
            array(
                'id'       => 'footer_text_under_logo',
                'type'     => 'textarea',
                'title'    => __( 'Footer Text', 'adforest' ),
                'subtitle' => __( 'under logo', 'adforest' ),
				'required' => array( 'footer_style', '=', array('2' , '3') ),
                'default'  => 'Aoluptas sit aspernatur aut odit aut fugit, sed elits quias horisa hinoe magni magni dolores eos qui ratione volust luptatem sequised.',
            ),
            array(
                'id'       => 'footer_android_app',
                'type'     => 'text',
                'title'    => __( 'Android App Link', 'adforest' ),
				'required' => array( 'footer_style', '=', array('2') ),
                'default'  => '',
            ),
            array(
                'id'       => 'footer_ios_app',
                'type'     => 'text',
                'title'    => __( 'IOS App Link', 'adforest' ),
				'required' => array( 'footer_style', '=', array('2') ),
                'default'  => '',
            ),
			
		   array(
				'id' => 'footer-contact-details',
				'type' => 'sortable',
				'title' => __('Contact Info', 'adforest'),
				'subtitle' => __('Add address, phone, fax, email and timing', 'adforest'),
				'desc' => __('You can sort out it as you want.', 'adforest'),
				'required' => array( 'footer_style', '=', array( '1' ) ),
				'label' => true,
				'options' => array(
					'Address' => '75 Blue Street, PK 54000',
					'Phone' => '(+92) 12 345 6879',
					'Fax' => '(+92) 98 765 4321',
					'Email' => 'contact@scriptsbundle.com',
					'Timing' => 'Mon-Fri 12:00pm - 12:00am'
					
				),
	 		'default'  => array(
					'Address' => '75 Blue Street, PK 54000',
					'Phone' => '(+92) 12 345 6879',
					'Fax' => '(+92) 98 765 4321',
					'Email' => 'contact@scriptsbundle.com',
					'Timing' => 'Mon-Fri 12:00pm - 12:00am'
					
				),
			),			
			
			array(
                'id'       => 'section_2_title',
                'type'     => 'text',
                'title'    => __( 'Section-2 Title', 'adforest' ),
                'subtitle' => __( 'Footer Section', 'adforest' ),
				'required' => array( 'footer_style', '=', array( '1', '2', '3' ) ),
                'default'  => 'Hot Links',				
            ),
			array(
                'id'       => 'sb_footer_pages',
                'type'     => 'select',
                'data'     => 'pages',
                'multi'    => true,
    'sortable' => true,
                'title'    => __( 'QUICK LINKS', 'adforest' ),
				'required' => array( 'footer_style', '=', array( '1' ) ),
                'desc'     => __( 'Select Page Links For The Footer', 'adforest' ),
				'default'  => array('2'),
            ),
			array(
                'id'       => 'section_3_title',
                'type'     => 'text',
                'title'    => __( 'Section-3 Title', 'adforest' ),
                'subtitle' => __( 'Footer Section', 'adforest' ),
				'required' => array( 'footer_style', '=', array( '1' , '2', '3' ) ),
                'default'  => 'Recent Posts',				
            ),
			array(
                'id'       => 'section_3_text',
                'type'     => 'text',
                'title'    => __( 'Section-3 Description', 'adforest' ),
                'subtitle' => __( 'Footer Section', 'adforest' ),
				'required' => array( 'footer_style', '=', array(  '2', '3' ) ),
                'default'  => 'We may send you information about related events, webinars, products and services which we believe.',				
            ),
			
			 array(
                'id'       => 'section_3_mc',
                'type'     => 'switch',
                'title'    => __( 'News Letter', 'adforest' ),
                'subtitle' => '',
				'required' => array( 'footer_style', '=', array(  '2', '3' ) ),
                'default'  =>  false
            ),
          array(
                'id'       => 'mailchimp_footer_list_id',
                'type'     => 'text',
                'title'    => __( 'MailChimp List ID', 'adforest' ),
				'required' => array( 'section_3_mc', '=', true ),
				
				'desc' => adforest_make_link ( 'http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id' , __( 'How to Find it' , 'adforest' ) ),
            ),
            array(
                'id'          => 'footer_post_numbers',
                'type'        => 'spinner',
                'title'       => __( 'MAX # of posts', 'adforest' ),
                'subtitle'    => __( 'In Footer', 'adforest' ),
                'desc'        => __( 'Only that post(s) will be appear that have featured image.', 'adforest' ),
				'required' => array( 'footer_style', '=', array( '1'  ) ),
				'default' => '2',
                'min'     => '1',
                'step'    => '1',
                'max'     => '10',
            ),
			array(
                'id'       => 'section_4_title',
                'type'     => 'text',
                'title'    => __( 'Section-4 Title', 'adforest' ),
                'subtitle' => __( 'Footer Section', 'adforest' ),
				'required' => array( 'footer_style', '=', array( '1', '2' ) ),
                'default'  => 'Quick Links',				
            ),
			array(
                'id'       => 'sb_footer_links',
                'type'     => 'select',
                'data'     => 'pages',
                'multi'    => true,
    'sortable' => true,
                'title'    => __( 'QUICK LINKS', 'adforest' ),
				'required' => array( 'footer_style', '=', array( '1', '2' ) ),
                'desc'     => __( 'Select Page Links For The Footer', 'adforest' ),
				'default'  => array('2'),
            ),
			 array(
                'id'       => 'footer_4_bg',
                'type'     => 'button_set',
                'title'    => __( 'Footer BG Color', 'adforest' ),
                'options'  => array(
                    'gray' => 'Gray',
                    '' => 'White',
                ),
				'required' => array( 'footer_style', '=', '4' ),
                'default'  => 'gray'
            ),
		array(
                'id'      => 'sb_footer',
                'type'    => 'editor',
                'title'   => __( 'Footer Bar', 'adforest' ),
                'default' => 'Copyright 2017 &copy; Theme Created By ScriptsBundle, All Rights Reserved.',
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    'teeny'         => false,
                    'quicktags'     => false,
                )
            ),

          
			 array(
                'id'       => 'footer_js_and_css',
                'type'     => 'textarea',
                'title'    => __( 'Custom CSS/Javascript', 'adforest' ),
                'subtitle' => '',
                'desc'     => __( 'Here you can write CSS and Javascript that will add just before closing body tag section.', 'adforest' ),
                'default'  => '',
            )
        )
    ) );