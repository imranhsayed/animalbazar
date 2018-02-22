<?php
/* ------------------------------------------------ */
/* Sign In */
/* ------------------------------------------------ */
if ( !function_exists ( 'login_short' ) ) {
function login_short()
{
	vc_map(array(
		"name" => __("Sign In", 'adforest') ,
		"base" => "login_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		
			adforest_generate_type( __('BG Color', 'adforest' ), 'dropdown', 'sb_bg_color', __( "Section background color", 'adforest' ), "", array( "Please select" => "", "Gray" => "bg-gray", "White" => "bg-white" , "BG Image" => "bg_img") ),
			
			adforest_generate_type( __('BG Image', 'adforest' ), 'attach_image', 'bg_img' ,'' ,'', '', '', 'vc_col-sm-12 vc_column', array( 'element' => 'sb_bg_color' , 'value' => 'bg_img' ) ),
			adforest_generate_type( __('Section Title', 'adforest' ), 'textfield', 'section_title' ),
			
		
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

add_action('vc_before_init', 'login_short');
if ( !function_exists ( 'login_short_base_func' ) ) {
function login_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'sb_bg_color' => '',
		'section_title' => '',
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
return ' <div class="main-content-area clearfix ' . $sb_bg_color . '">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding error-page '. $class .'" '.$css.'>
            <!-- Main Container -->
            <div class="container">
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
					 	'.$authentication->adforest_sign_in_form( $code ).'
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
      <div class="custom-modal">
         <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header rte">
                     <h2 class="modal-title">'.  __( 'Forgot Your Password ?','adforest' ).'</h2>
                  </div>
					'.$authentication->adforest_forgot_password_form().'
               </div>
            </div>
         </div>
      </div>
';

}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('login_short_base', 'login_short_base_func');
}