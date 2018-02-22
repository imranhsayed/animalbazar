<?php
// sign up form
if (! class_exists ( 'authentication' )) {
class authentication
{
		function adforest_sign_up_form( $string, $terms, $key = '' , $is_captcha = '', $key_code = '' )
		{
			global $adforest_theme;
			
				// Check phone is required or not
			$phone_html = '<input class="form-control" name="sb_reg_contact" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'" placeholder="'.  __( 'Your Contact Number','adforest' ).'" type="text">';
			if( isset( $adforest_theme['sb_user_phone_required'] ) && !$adforest_theme['sb_user_phone_required'] )
			{
				$phone_html = '<input placeholder="'.  __( 'Your Contact Number','adforest' ).'" class="form-control" type="text" name="sb_reg_contact">';
			}
			
			if( isset( $adforest_theme['sb_phone_verification'] ) && $adforest_theme['sb_phone_verification'] && in_array( 'wp-twilio-core/core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
			{
				$phone_html = '<input placeholder="'.  __( '+CountrycodePhonenumber','adforest' ).'" class="form-control" type="text" name="sb_reg_contact" data-parsley-required="true" data-parsley-pattern="/\+[0-9]+$/" data-parsley-error-message="'.  __( 'Format should be +CountrycodePhonenumber','adforest' ).'">';
			}

			
			$res	=	adforest_extarct_link( $string );
			$captcha	=	'<input type="hidden" value="no" name="is_captcha" />';
			if( $is_captcha == 'with' && $key != "" )
			{
				$captcha	=	'<div class="form-group">
			  <div class="g-recaptcha" data-sitekey="'.$key.'"></div>
		   </div><input type="hidden" value="yes" name="name_captcha" />
		';
			}
		return '<form id="sb-sign-form" >
		   <div class="form-group">
			  <label>' .   __( 'Name','adforest' ). '</label>
			  <input placeholder="'. __( 'Your Name','adforest' ).'" class="form-control" type="text" data-parsley-required="true" data-parsley-error-message="'. __( 'Please enter your name.', 'adforest' ) .'" name="sb_reg_name" id="sb_reg_name">
		   </div>
		   <div class="form-group">
			  <label>'.  __( 'Contact Number','adforest' ).'</label>
			  '.$phone_html.'
		   </div>
		   <div class="form-group">
			  <label>'. __( 'Email','adforest' ).'</label>
			  <input placeholder="'.  __( 'Your Email','adforest' ).'" class="form-control" type="email" data-parsley-type="email" data-parsley-required="true" data-parsley-error-message="'. __( 'Please enter your valid email.', 'adforest' ) .'" data-parsley-trigger="change" name="sb_reg_email" id="sb_reg_email">
		   </div>
		   <div class="form-group">
			  <label>'.  __( 'Password','adforest' ).'</label>
			  <input placeholder="'.  __( 'Your Password','adforest' ) .'" class="form-control" type="password" data-parsley-required="true" data-parsley-error-message="'. __( 'Please enter your password.', 'adforest' ) .'" name="sb_reg_password">
		   </div>
		   <div class="form-group">
			  <div class="row">
				 <div class="col-xs-12 col-md-12 col-sm-12">
					<div class="skin-minimal">
					   <ul class="list">
						  <li>
							 <input  type="checkbox" id="minimal-checkbox-1" checked name="minimal-checkbox-1" data-parsley-required="true" data-parsley-error-message="'. __( 'Please accept terms and conditions.', 'adforest' ) .'">
							 <label for="minimal-checkbox-1">'. __( 'I agreed to','adforest' ).' <a href="'.$res['url'].'" title="'.$res['title'].'" target="'.$res['target'].'">'. $terms .'</a></label>
						  </li>
					   </ul>
					</div>
				 </div>
			  </div>
		   </div>
		'.$captcha.'   
		   <button class="btn btn-theme btn-lg btn-block" type="submit" id="sb_register_submit">'.  __( 'Register','adforest' ).'</button>
		   <button class="btn btn-theme btn-lg btn-block no-display" type="button" id="sb_register_msg">'.  __( 'Processing...','adforest' ).'</button>
		   <button class="btn btn-theme btn-lg btn-block no-display" type="button" id="sb_register_redirect">'.  __( 'Redirecting...','adforest' ).'</button>
		   <br />
		   <p class="text-center"><a href="'.get_the_permalink( $adforest_theme['sb_sign_in_page'] ).'">'. __( 'Already registered, login here.','adforest' ).'</a>
					</p>
		   <input type="hidden" id="get_action" value="register" />
		   <input type="hidden" id="nonce_register" value="'.$key_code.'" />
		   <input type="hidden" id="verify_account_msg" value="'.__('Verificaton email has been sent to your email.','adforest').'" />
		</form>';
		}
		
		// sign In form
		function adforest_sign_in_form($key_code	=	'')
		{
			global $adforest_theme;
		return '<form id="sb-login-form" >
		   <div class="form-group">
			  <label>'. __( 'Email','adforest' ).'</label>
			  <input placeholder="'.  __( 'Your Email','adforest' ).'" class="form-control" type="email" data-parsley-type="email" data-parsley-required="true" data-parsley-error-message="'. __( 'Please enter your valid email.', 'adforest' ) .'" data-parsley-trigger="change" name="sb_reg_email" id="sb_reg_email">
		   </div>
		   <div class="form-group">
			  <label>'.  __( 'Password','adforest' ).'</label>
			  <input placeholder="'.  __( 'Your Password','adforest' ) .'" class="form-control" type="password" data-parsley-required="true" data-parsley-error-message="'. __( 'Please enter your password.', 'adforest' ) .'" name="sb_reg_password">
		   </div>
		   <div class="form-group">
			  <div class="row">
				 <div class="col-xs-12 col-sm-7">
					<div class="skin-minimal">
					   <ul class="list">
						  <li>
							 <input  type="checkbox" name="is_remember" id="is_remember">
							 <label for="is_remember">'. __( 'Remember Me', 'adforest' ) .'</label>
						  </li>
					   </ul>
					</div>
				 </div>
				 <div class="col-xs-12 col-sm-5 text-right">
					<p class="help-block"><a data-target="#myModal" data-toggle="modal">'. __( 'Forgot password?','adforest' ).'</a>
					</p>
				 </div>
			  </div>
		   </div>
		   
		   <button class="btn btn-theme btn-lg btn-block" type="submit" id="sb_login_submit">'.  __( 'Login','adforest' ).'</button>
		   <button class="btn btn-theme btn-lg btn-block no-display" type="button" id="sb_login_msg">'.  __( 'Processing...','adforest' ).'</button>
		   <button class="btn btn-theme btn-lg btn-block no-display" type="button" id="sb_login_redirect">'.  __( 'Redirecting...','adforest' ).'</button>
		   <br />
		   <p class="text-center"><a href="'.get_the_permalink( $adforest_theme['sb_sign_up_page'] ).'">'. __( 'Sign up for an account.','adforest' ).'</a>
					</p>
		   <input type="hidden" id="nonce" value="'.$key_code.'" />
		   <input type="hidden" id="get_action" value="login" />
		</form>';
		}
		
		// Forgot Password Form
		function adforest_forgot_password_form()
		{
			return '
			<form id="sb-forgot-form">
				 <div class="modal-body">
					<div class="form-group">
					  <label>'. __( 'Email','adforest' ).'</label>
					  <input placeholder="'.  __( 'Your Email','adforest' ).'" class="form-control" type="email" data-parsley-type="email" data-parsley-required="true" data-parsley-error-message="'. __( 'Please enter valid email.', 'adforest' ) .'" data-parsley-trigger="change" name="sb_forgot_email" id="sb_forgot_email">
					</div>
				 </div>
				 <div class="modal-footer">
					   <button class="btn btn-dark" type="submit" id="sb_forgot_submit">'.  __( 'Reset My Account','adforest' ).'</button>
					   <button class="btn btn-dark" type="button" id="sb_forgot_msg">'.  __( 'Processing...','adforest' ).'</button>
					
				 </div>
		  </form>
		';	
		}
}
}

// Goog re-capthca verification
if ( ! function_exists( 'adforest_recaptcha_verify' ) ) {
function adforest_recaptcha_verify( $api_secret, $code, $ip, $is_captcha )
{
	
	if( $is_captcha == 'no' )
		return true;
	global $adforest_theme;
	
	$url	=	'https://www.google.com/recaptcha/api/siteverify?secret='.$api_secret.'&response='.$code.'&remoteip='.$ip;
	
	$responseData = wp_remote_get($url);
	$res = json_decode( $responseData['body'], true );
		if($res["success"] === true)
        {
            return true;
        }
        else
        {
            return false;
        }
}
}



// Ajax handler for Login User
add_action( 'wp_ajax_sb_login_user', 'adforest_login_user' );
add_action( 'wp_ajax_nopriv_sb_login_user', 'adforest_login_user' );
// Login User
if ( ! function_exists( 'adforest_login_user' ) ) {
function adforest_login_user()
{
	global $adforest_theme;
	// Getting values
	$params = array();
    parse_str($_POST['sb_data'], $params);
	$remember	= false;
	if( $params['is_remember'] )
	{
		$remember	=	true;
	}
	$user 	= wp_authenticate( $params['sb_reg_email'], $params['sb_reg_password'] );
	if( !is_wp_error($user) )
	{
		if( count( $user->roles ) == 0 )
		{
			echo __( 'Your account is not verified yet.', 'adforest' );
			die();
		}
		else
		{
			$res	=	adforest_auto_login($params['sb_reg_email'], $params['sb_reg_password'], $remember );	
			if( $res == 1 )
			{
				echo "1";
			}
		}
	}
	else
	{
			echo __( 'Invalid email or password.', 'adforest' );	
	}
	die();
}
}

// Ajax handler for Register User
add_action( 'wp_ajax_sb_register_user', 'adforest_register_user' );
add_action( 'wp_ajax_nopriv_sb_register_user', 'adforest_register_user' );
// Register User
if ( ! function_exists( 'adforest_register_user' ) ) {
function adforest_register_user()
{
	global $adforest_theme;
	// Getting values
	$params = array();
    parse_str($_POST['sb_data'], $params);
	
	if( email_exists($params['sb_reg_email']) == false )
	{
		if( adforest_recaptcha_verify( $adforest_theme['google_api_secret'], $params['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'], $params['is_captcha'] ) )
		{
			
			$user_name	=	explode( '@', $params['sb_reg_email'] );
			$u_name	=	adforest_check_user_name( $user_name[0] );
			$uid =	wp_create_user( $u_name, $params['sb_reg_password'], sanitize_email($params['sb_reg_email']) );
			wp_update_user( array( 'ID' => $uid, 'display_name' => sanitize_text_field($params['sb_reg_name']) ) );
			update_user_meta($uid, '_sb_contact', sanitize_text_field($params['sb_reg_contact']));
			
			if( $adforest_theme['sb_allow_ads'] )
			{
				update_user_meta( $uid, '_sb_simple_ads', $adforest_theme['sb_free_ads_limit'] );
				if( $adforest_theme['sb_allow_featured_ads'] )
				{
					update_user_meta( $uid, '_sb_featured_ads', $adforest_theme['sb_featured_ads_limit'] );
				}
				if( $adforest_theme['sb_allow_bump_ads'] )
				{
					update_user_meta( $uid, '_sb_bump_ads', $adforest_theme['sb_bump_ads_limit'] );
				}
				if( $adforest_theme['sb_package_validity'] == '-1' )
				{
					update_user_meta( $uid, '_sb_expire_ads', $adforest_theme['sb_package_validity'] );
				}
				else
				{
					$days	=	$adforest_theme['sb_package_validity'];
					$expiry_date	=	date('Y-m-d', strtotime("+$days days"));
					update_user_meta( $uid, '_sb_expire_ads', $expiry_date );		
				}
			}
			else
			{
				update_user_meta( $uid, '_sb_simple_ads', 0 );
				update_user_meta( $uid, '_sb_featured_ads', 0 );
				update_user_meta( $uid, '_sb_bump_ads', 0 );
				update_user_meta( $uid, '_sb_expire_ads', date('Y-m-d') );
			}
			
			update_user_meta( $uid, '_sb_pkg_type', 'free' );
			// Email for new user
			if ( function_exists( 'adforest_email_on_new_user' ) )
			{
				adforest_email_on_new_user($uid, '');
			}
			
			// check phone verification is on or not
			if( isset( $adforest_theme['sb_phone_verification'] ) && $adforest_theme['sb_phone_verification'] && in_array( 'wp-twilio-core/core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
			{
				update_user_meta( $uid, '_sb_is_ph_verified', '0' );
			}

			if( isset( $adforest_theme['sb_new_user_email_verification'] ) && $adforest_theme['sb_new_user_email_verification'] )
			{
				$user = new WP_User($uid);
				// Remove all user roles after registration
				foreach($user->roles as $role){
					$user->remove_role($role);
				}
				echo 2;
				die();
			}
			else
			{
				adforest_auto_login($params['sb_reg_email'], $params['sb_reg_password'], true );
				echo 1;
				die();
			}
		}
		else
		{
			echo __( 'please verify captcha code', 'adforest' );
			die();
		}
	}
	else
	{
		
		echo __( 'Email already exist, please try other one.', 'adforest' );
		die();
	}
	
	
	die();
	 
}
}


if ( ! function_exists( 'adforest_auto_login' ) ) {
function adforest_auto_login($username, $password, $remember )
{
	$creds = array();
$creds['user_login'] = $username;
$creds['user_password'] = $password;
$creds['remember'] = $remember;

    $user = wp_signon( $creds, false );
    if ( is_wp_error($user) )
	{
        return false;
    }
	else
	{
		//global $adforest_theme;
		//if( isset( $adforest_theme['sb_new_user_email_verification'] ) && $adforest_theme['sb_new_user_email_verification'] )
		//{
			if( count( $user->roles ) > 0 )
			{
				return true;
			}
			else
			{
				return 2;
			}
		//}
    }
}
}

//associating a function to login hook
add_action('wp_login', 'adforest_set_last_login', 10, 2);
 
//function for setting the last login
if ( ! function_exists( 'adforest_set_last_login' ) ) {
function adforest_set_last_login($login, $user) {
   //$user = get_userdatabylogin($login);
   $cur_user	=	get_user_by( 'login', $login );
 	
   //add or update the last login value for logged in user
   update_user_meta( $cur_user->ID, '_sb_last_login', time() );
}
}

// Last login time
if ( ! function_exists( 'adforest_get_last_login' ) ) {
function adforest_get_last_login( $uid )
{
	$from	=	get_user_meta( $uid, '_sb_last_login', true );
	if( $from == "" )
	{
		update_user_meta( $uid, '_sb_last_login', time() );
		$from	=	get_user_meta( $uid, '_sb_last_login', true );
	}
	return human_time_diff($from, time() );
}
}

// Ajax handler for Social login
add_action( 'wp_ajax_sb_social_login', 'adforest_check_social_user' );
add_action( 'wp_ajax_nopriv_sb_social_login', 'adforest_check_social_user' );
if ( ! function_exists( 'adforest_check_social_user' ) ) {
function adforest_check_social_user()
{
	if( true )
	{
		$user_name	=	$_POST['email'];
		unset($_SESSION['sb_nonce']);
		$_SESSION['sb_nonce']	=	time();
		if( email_exists( $user_name ) == true )
		{
			$user = get_user_by( 'email', $user_name );
			$user_id = $user->ID;
			if( $user )
			{
				wp_set_current_user( $user_id, $user->user_login );
				wp_set_auth_cookie( $user_id );
				//do_action( 'wp_login', $user->user_login );
				echo '1|' . $_SESSION['sb_nonce'] . '|1|' . __( "You're logged in successfully.", 'adforest' );
			}
		}
		else
		{
			// Here we need to register user.
			$password = mt_rand (1000,10000);
			$uid 	=	adforest_do_register( $user_name, $password );
			global $adforest;
			if ( function_exists( 'adforest_email_on_new_user' ) )
			{
				adforest_email_on_new_user($uid, $password);
			}
			echo '1|' . $_SESSION['sb_nonce'] . '|1|' . __( "You're registered and logged in successfully.", 'adforest' );
		}
	}
	else
	{
		echo '0|error|Invalid request|Diret Access not allowed';	
	}
	die();
}
}

if( ! function_exists( 'adforest_do_register' ) )
{
function adforest_do_register($email= '', $password = '')
{
	global $adforest_theme;
	$user_name	=	explode( '@', $email );
	$u_name	=	adforest_check_user_name( $user_name[0] );
	$uid =	wp_create_user( $u_name, $password, $email );
	wp_update_user( array( 'ID' => $uid, 'display_name' => $u_name ) );
	adforest_auto_login($email, $password, true );
	
	if( $adforest_theme['sb_allow_ads'] )
	{
		update_user_meta( $uid, '_sb_simple_ads', $adforest_theme['sb_free_ads_limit'] );
		update_user_meta( $uid, '_sb_featured_ads', $adforest_theme['sb_featured_ads_limit'] );
		if( $adforest_theme['sb_package_validity'] == '-1' )
		{
			update_user_meta( $uid, '_sb_expire_ads', $adforest_theme['sb_package_validity'] );
		}
		else
		{
			$days	=	$adforest_theme['sb_package_validity'];
			$expiry_date	=	date('Y-m-d', strtotime("+$days days"));
			update_user_meta( $uid, '_sb_expire_ads', $expiry_date );		
		}
	}
	else
	{
		update_user_meta( $uid, '_sb_simple_ads', 0 );
		update_user_meta( $uid, '_sb_featured_ads', 0 );
		update_user_meta( $uid, '_sb_expire_ads', date('Y-m-d') );
	}
	update_user_meta( $uid, '_sb_pkg_type', 'free' );
	return $uid;
}
}
if ( ! function_exists( 'adforest_user_not_logged_in' ) ) {
function adforest_user_not_logged_in()
{
	global $adforest_theme;
	if( get_current_user_id() == "" )
	{
		echo adforest_redirect( get_the_permalink( $adforest_theme['sb_sign_in_page'] ) );	
	}
}
}


if ( ! function_exists( 'adforest_user_logged_in' ) ) {
function adforest_user_logged_in()
{
	if( get_current_user_id() != "" )
	{
		echo adforest_redirect( home_url( '/' ) );	
	}
}
}

if ( ! function_exists( 'adforest_check_user_name' ) ) {
function adforest_check_user_name( $username = '' )
{
	if ( username_exists( $username ) )
	{
		$random = mt_rand();
		$username	=	$username . '-' . $random;
		adforest_check_user_name($username);		
	}
	return $username;
}
}

add_action( 'wp_ajax_sb_reset_password', 'adforest_reset_password' );
add_action( 'wp_ajax_nopriv_sb_reset_password', 'adforest_reset_password' );
// Reset Password
if ( ! function_exists( 'adforest_reset_password' ) )
{
function adforest_reset_password()
{
	global $adforest_theme;
	// Getting values
	$params = array();
    parse_str($_POST['sb_data'], $params);
	$token	=	$params['token'];
	$token_arr	=	explode( '-sb-uid-', $token );
	$key	=	$token_arr[0];
	$uid	= 	$token_arr[1];
	$token_db	=	get_user_meta( $uid, 'sb_password_forget_token', true ); 
	if( $token_db != $key )
	{
		echo '0|' . __( "Invalid security token.", 'adforest' );
	}
	else
	{
		$new_password	=	$params['sb_new_password'];
		wp_set_password( $new_password, $uid );
		update_user_meta($uid, 'sb_password_forget_token', '');
		echo '1|' . __( "Password Changed successfully.", 'adforest' );
	}
	die();
}
}