<?php
/* ------------------------------------------------ */
/* Services */
/* ------------------------------------------------ */
if ( !function_exists ( 'register_short' ) ) {
function register_short()
{
	vc_map(array(
		"name" => __("Sign Up", 'adforest') ,
		"base" => "register_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		
			adforest_generate_type( __('BG Color', 'adforest' ), 'dropdown', 'sb_bg_color', __( "Section background color", 'adforest' ), "", array( "Please select" => "", "Gray" => "bg-gray", "White" => "bg-white" , "BG Image" => "bg_img") ),
			
			adforest_generate_type( __('BG Image', 'adforest' ), 'attach_image', 'bg_img' ,'' ,'', '', '', 'vc_col-sm-12 vc_column', array( 'element' => 'sb_bg_color' , 'value' => 'bg_img' ) ),
			adforest_generate_type( __('Section Title', 'adforest' ), 'textfield', 'section_title' ),
			adforest_generate_type( __('Terms & Conditions', 'adforest' ), 'vc_link', 'terms_link' ),
			adforest_generate_type( __('Terms & Condition Title', 'adforest' ), 'textfield', 'terms_title' ),
			
			adforest_generate_type( __('Capcha Code', 'adforest' ), 'dropdown', 'is_captcha', __( "Captcha is for stop spamming", 'adforest' ), "", array( "Please select" => "", "With Capcha" => "with", "Without Capcha" => "without") ),
			
		
			// Making add more loop
			array
				(
					'group' => __( 'Features', 'adforest' ),
					'type' => 'param_group',
					'heading' => __( 'Add Feature', 'adforest' ),
					'param_name' => 'features',
					'value' => '',
					'params' => array
					(
						adforest_generate_type( __('Image 80x80', 'adforest' ), 'attach_image', 'image' ),
						adforest_generate_type( __('Title', 'adforest' ), 'textfield', 'title' ),
						adforest_generate_type( __('Page Link', 'adforest' ), 'vc_link', 'link' ),
						adforest_generate_type( __('Short Description', 'adforest' ), 'textarea', 'description' ),
					)
			),
		) ,
	));
}
}

add_action('vc_before_init', 'register_short');
if ( !function_exists ( 'register_short_base_func' ) ) {
function register_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(		
		'sb_bg_color' => '',
		'terms_link' => '',
		'terms_title' => '',
		'section_title' => '',
		'is_captcha' => '',
		'bg_img' => '',
		'features' => '',
	) , $atts));
	
		adforest_user_logged_in();
	
		// Making features
		$rows = vc_param_group_parse_atts( $atts['features'] );
		$features	=	'';
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				$icon	=	'';
				if( isset( $row['image'] ))
				{
					$img  = wp_get_attachment_image_src($row['image'], 'full');
					$icon 	=	'<div class="features-icons">
                              <img src="'.$img[0].'" alt="'.__('image', 'adforest').'">
                           </div>';
				}
				$title	=	'';

				if( isset( $row['title'] ))
				{
					if( isset( $row['link'] ))
					{
						$res	=	adforest_extarct_link( $row['link'] );
						$title	=	'<h3><a href="'.$res['url'].'" title="'.$res['title'].'" target="'.$res['target'].'">'.$row['title'].'</a></h3>';
					}
					else
					{
						$title	=	'<h3>'.$row['title'].'</h3>';
					}
				}
				$desc	=	'';
				if( isset( $row['description'] ))
				{
					$desc	=	'<p>'.$row['description'].'</p>';
				}
					$features	.= '<div class="features">
                           '.$icon.'
                           <div class="features-text">
                              '.$title.'
                              '.$desc.'
                           </div>
                        </div>';
			}
		}
		
		global $adforest_theme;
		$social_login	=	'';
		if( $adforest_theme['fb_api_key'] != "" )
		{ 
			   $social_login	.= '<div class="col-md-6 col-xs-12 col-sm-6"><a class="btn btn-block btn-social btn-facebook" onclick="hello(\'facebook\').login('. "{
scope : 'email',
}".')">
                          <span class="fa fa-facebook"></span>' . __('Facebook', 'adforest' ) . '
                          </a></div>';                       
		}
		if( $adforest_theme['gmail_api_key'] != "" )
		{
			   $social_login	.= '<div class="col-md-6 col-xs-12 col-sm-6"><a class="btn btn-block btn-social btn-google" onclick="hello(\'google\').login('. "{
scope : 'email'
}".')">
                           <span class="fa fa-google"></span>' . __('Google', 'adforest' ) . '
                          </a></div>';                       
		}
		
		
		
		$get_res	=	adforest_bg_func( $sb_bg_color, $bg_img);
		$class 	=	$get_res['color'];
		$css	= '';
		if( $get_res['url'] != "" )
			$css	=	 'style="background: #fff url('.$get_res['url'].') repeat-x scroll center bottom;
padding-bottom: 120px !important;"';
$authentication	=	new authentication();
$code = time();
$_SESSION['sb_nonce'] = $code;
$if_social_login_enable = '';
if( $social_login != "" )
{
	$if_social_login_enable = '<hr>
						<div class="center-line">'.__('OR', 'adforest' ) . '</div>
						<hr>';
}

$class	= 'style="display:none;"';
$styling	= 'style="color:#000;"';
if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
{
		$styling	= '';
}

return ' <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding error-page '. $class .'" '.$css.'>
            <!-- Main Container -->
            <div class="container">
			
<div class="row">
	<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 resend_email" '.$class.'>
	<div role="alert" class="alert alert-info alert-dismissible '. adforest_alert_type() .'">
	<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
	'.__('Did not get an email? Resend now?','adforest').'<a href="javascript:void(0)" '.$styling.' id="resend_email"> '.__('Resend now.','adforest').'</a>
	</div>
	</div>

	<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 contact_admin" '.$class.'>
	<div role="alert" class="alert alert-info alert-dismissible '. adforest_alert_type() .'">
	<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
	'.__('Still not get the email? ','adforest').'<a href="'.trailingslashit( get_the_permalink( $adforest_theme['admin_contact_page'] ) ) .'" '.$styling.' id="resend_email"> '.__('Contact to admin.','adforest').'</a>
	</div>
	</div>


</div>			
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <div class="col-md-5 col-md-push-7 col-sm-12 col-xs-12">
                     <!--  Form -->
                     <div class="form-grid">
						<div class="row">
							'.$social_login.'
						</div>
						'.$if_social_login_enable.'
					 
					 	'.$authentication->adforest_sign_up_form( $terms_link, $terms_title, $adforest_theme['google_api_key'], $is_captcha, $code ).'
                     </div>
                     <!-- Form -->
                  </div>
                 
                  <div class="col-md-7  col-md-pull-5  col-sm-12 col-xs-12">
                     <div class="heading-panel">
                        <h3 class="main-title text-left">
                           '.$section_title.' 
                        </h3>
                     </div>
                     <div class="content-info">
					 	'.$features.'
                        <span class="arrowsign hidden-sm hidden-xs">
						<img src="'.trailingslashit( get_template_directory_uri () ).'images/arrow.png" alt="'.__('image','adforest').'">
						</span>
                     </div>
                  </div>
                  <!-- Middle Content Area  End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
      </div>
      <!-- Main Content Area End --> 
      <!-- Forget Password -->
';

}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('register_short_base', 'register_short_base_func');
}