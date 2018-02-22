<?php
/* ------------------------------------------------ */
/* Profile */
/* ------------------------------------------------ */
if ( !function_exists ( 'profile_short' ) ) {
function profile_short()
{
	vc_map(array(
		"name" => __("User Profile", 'adforest') ,
		"base" => "profile_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		
			
			adforest_generate_type( __('Prolfile Layout', 'adforest' ), 'dropdown', 'profile_layout', '', "", array( "Please select" => "", "Profile 1" => "p1", "Profile 2" => "p2" ) ),
			
			
		) ,
	));
}
}

add_action('vc_before_init', 'profile_short');
if ( !function_exists ( 'profile_short_base_func' ) ) {
function profile_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'profile_layout' => '',
	) , $atts));
	
	$profile	=	new adforest_profile();
	adforest_user_not_logged_in();
	
	
return ' 
         <section class="section-padding bg-gray" >
            <!-- Main Container -->
            <div class="container">
               '.$profile->adforest_profile_full_top().'
               <br>
               '.$profile->adforest_profile_full_body().'
            </div>
            <!-- Main Container End -->
         </section>
';

}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('profile_short_base', 'profile_short_base_func');
}