<?php
if (! class_exists ( 'adforest_profile' )) {
class adforest_profile
{
// user object
var $user_info;

public function __construct()
{
	$this->user_info	=	get_userdata( get_current_user_id() );
}

// Full Width Profile Top
function adforest_profile_full_top()
{
	$user_pic =	adforest_get_user_dp( $this->user_info->ID, 'adforest-user-profile' );
	
	global $adforest_theme;
		$msgs	=	'';
	   	if( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )
		{
		$msgs	=	'				<li>
				  <a href="javascript:void(0);">
					 <div class="menu-name" sb_action="my_msgs">'. __( 'Messages', 'adforest' ) .'</div>
				  </a>
			   </li>';
		}
		
		$packages	=	'';
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
		{
			$packages	=	'<li>
				  <a href="'.get_the_permalink( $adforest_theme['sb_packages_page'] ).'" target="_blank">
					 <div class="menu-name" sb_action="">'. __( 'Packages', 'adforest' ) .'</div>
				  </a>
			   </li>';
		}
		$package_type_html = '';
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
		{
			$package_type	=	get_user_meta($this->user_info->ID, '_sb_pkg_type', true );
			if( get_user_meta($this->user_info->ID, '_sb_pkg_type', true ) != 'free' )
			{
				$package_type	=	__('Paid', 'adforest' );
			}
			$package_type_html = '<span class="label label-warning">'.$package_type.'</span>';
		}
$rating = '';	
if( isset( $adforest_theme['user_public_profile'] ) && $adforest_theme['user_public_profile'] != "" && $adforest_theme['user_public_profile'] == "modern" && isset($adforest_theme['sb_enable_user_ratting']) && $adforest_theme['sb_enable_user_ratting'] )
{
											
			$rating = '<a href="'.get_author_posts_url( $this->user_info->ID ).'?type=1">
			<div class="rating">';
		$got	=	get_user_meta($this->user_info->ID, "_adforest_rating_avg", true );
		if( $got == "" )
			$got = 0;
			for( $i = 1; $i<=5; $i++ )
			{
				if( $i <= round( $got ) )
					$rating .= '<i class="fa fa-star"></i>';
				else
					$rating .= '<i class="fa fa-star-o"></i>';	
			}
			   $rating .= '<span class="rating-count">
			   (';
			   if( get_user_meta($this->user_info->ID, "_adforest_rating_count", true ) != "" )
					$rating .=  get_user_meta($this->user_info->ID, "_adforest_rating_count", true ); 
				else
					$rating .=  0;
			   $rating .= ')
			   </span>
			</div>
			</a>';
}

$badge	=	'';
if( get_user_meta($this->user_info->ID, '_sb_badge_type', true ) != "" && get_user_meta($this->user_info->ID, '_sb_badge_text', true ) != "" && isset( $adforest_theme['sb_enable_user_badge'] ) && $adforest_theme['sb_enable_user_badge'] && $adforest_theme['sb_enable_user_badge'] && isset( $adforest_theme['user_public_profile'] ) && $adforest_theme['user_public_profile'] != "" && $adforest_theme['user_public_profile'] == "modern" )
{
	$badge	= ' <span class="label '.get_user_meta($this->user_info->ID, '_sb_badge_type', true ).'">
	'.get_user_meta($this->user_info->ID, '_sb_badge_text', true ).'</span>';
}

$user_type = '';
if( get_user_meta( $this->user_info->ID, '_sb_user_type', true ) == 'Indiviual' )
{
	$user_type = __('Individual', 'adforest');
}
else if( get_user_meta( $this->user_info->ID, '_sb_user_type', true ) == 'Dealer' )
{
	$user_type = __('Dealer', 'adforest');	
}

	$profile_html	=	'';
	$profiles	=	adforest_social_profiles();
	foreach( $profiles as $key => $value )
	{
		if( get_user_meta( $this->user_info->ID, '_sb_profile_' . $key, true ) != "" )
		$profile_html .= '<li><a href="'.esc_url( get_user_meta( $this->user_info->ID, '_sb_profile_' . $key, true ) ).'" class="fa fa-'.$key.'" target="_blank"></a></li>';
	}
	
		return '<div class="row">
	  <!-- Middle Content Area -->
	  
	  <div class="col-md-12 col-xs-12 col-sm-12">
		<section class="search-result-item">
		   <div class="image-link adforest-profile-img-container" href="javascript:void(0);">
		   <img class="image" alt="'.__('Profile Picture','adforest').'" src="'.$user_pic.'" id="user_dp">
		   <ul class="social-f">
				'.$profile_html.'
			</ul>
			<div class="adforest-edit-profile-img">Edit Profile Image</div>
		   </div>
		   <div class="search-result-item-body">
			  <div class="row">
				 <div class="col-md-5 col-sm-12 col-xs-12">
					
					<h4 class="search-result-item-heading sb_put_user_name">'.$this->user_info->display_name.'</h4>
					<p class="info">
					<span class="profile_tabs" sb_action="get_profile"><i class="fa fa-user"></i>&nbsp; '.__('Profile', 'adforest') . '</span>&nbsp;| &nbsp; 
					<span class="profile_tabs" sb_action="update_profile"><i class="fa fa-edit"></i>&nbsp; '.__('Edit Profile', 'adforest') . '</span>
				  </p>
					<p class="info sb_put_user_address">'.get_user_meta($this->user_info->ID, '_sb_address', true ).'</p>
					<p class="description">'.__('You last logged in at', 'adforest') . ': '.adforest_get_last_login( $this->user_info->ID ). ' ' . __('Ago','adforest').'</p>
					'.$package_type_html.'
					<span class="label label-success sb_user_type">'.$user_type.'</span>
					'.$badge.'
					'.$rating .'
					
					
				 </div>
				 <div class="col-md-7 col-sm-12 col-xs-12">
				  <div class="row ad-history">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="user-stats">
								<h2>'.adforest_get_sold_ads( $this->user_info->ID ).'</h2>
								<small>' . __( 'Ad Sold', 'adforest' ) .'</small>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="user-stats">
								<h2>'.adforest_get_all_ads( $this->user_info->ID ).'</h2>
								<small>' . __( 'Total Listings', 'adforest' ) .'</small>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="user-stats">
								<h2>'.adforest_get_disbale_ads( $this->user_info->ID ).'</h2>
								<small>' . __( 'Inactve ads', 'adforest' ) .'</small>
							</div>
						</div>
					</div>
				 </div>
				 
				 
				 
				 
				 
			  </div>
		   </div>
		</section>
		
		<div class="dashboard-menu-container">
			<ul>
			   
			   <li>
				  <a href="javascript:void(0);">
					 <div class="menu-name" sb_action="my_ads">'. __( 'My Ads', 'adforest' ) .'</div>
				  </a>
			   </li>
			   <li>
				  <a href="javascript:void(0);">
					 <div class="menu-name" sb_action="my_inactive_ads">'. __( 'Inactive Ads', 'adforest' ) .'</div>
				  </a>
			   </li>
			   <li>
				  <a href="javascript:void(0);">
					 <div class="menu-name" sb_action="my_feature_ads">'. __( 'Featured Ads', 'adforest' ) .'</div>
				  </a>
			   </li>
			   <li>
				  <a href="javascript:void(0);">
					 <div class="menu-name" sb_action="my_fav_ads">'. __( 'Fav Ads', 'adforest' ) .'</div>
				  </a>
			   </li>
				'.$msgs.'
			    '.$packages.'
			</ul>
		 </div>
	  </div>
	  <!-- Middle Content Area  End -->
   </div>
		';
}
// Full Width Profile Body
function adforest_profile_full_body()
{
	if( isset( $_GET['sb_action'] ) && isset( $_GET['ad_id'] ) && isset( $_GET['uid'] ) &&  $_GET['sb_action'] == 'sb_load_messages' )
	{
		$script = "<script>	jQuery(document).ready(function($){
   					adforest_select_msg('$_GET[ad_id]', '$_GET[uid]', 'no');
	});
	</script>
";
		$ads	=	new ads();
		return '<div id="adforest_res">
			 '.$ads->adforest_load_messages( $_GET['ad_id'] ).'
		  </div>
		  '.$script.'
		';
	}
	else if( isset( $_GET['sb_action'] ) && isset( $_GET['ad_id'] ) && isset( $_GET['uid'] ) && isset( $_GET['user_id'] ) &&  $_GET['sb_action'] == 'sb_get_messages' )
	{
		$script = "<script>	jQuery(document).ready(function($){
   					adforest_select_msg('$_GET[ad_id]', '$_GET[uid]', 'yes');
	});
	</script>
";
		$ads	=	new ads();
		return '<div id="adforest_res">
			 '.$ads->adforest_get_messages( $_GET['user_id'] ).'
		  </div>
		  '.$script.'
		';
	}
	else
	{
		return '<div id="adforest_res">
			 '.$this->adforest_profile_get().'
		  </div>
		';
	}
}

// Getting profile details
function adforest_profile_get()
{
	$expiry	=	'';
	$free_ads	=	'';
	$featured_ads	=	'';
	$bump_ads	=	'';
	$paid_html	=	'';
	global $adforest_theme;
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
	{
		if( get_user_meta( $this->user_info->ID, '_sb_expire_ads', true ) != '-1' )
		{
			$expiry	=	get_user_meta( $this->user_info->ID, '_sb_expire_ads', true );
		}
		else
		{
			$expiry	=	__('Never', 'adforest' );	
		}
		if( get_user_meta( $this->user_info->ID, '_sb_simple_ads', true ) != '-1' && get_user_meta( $this->user_info->ID, '_sb_simple_ads', true ) >= 0 )
		{
			$free_ads	=	get_user_meta( $this->user_info->ID, '_sb_simple_ads', true );
		}
		else
		{
			$free_ads	=	__('Unlimited', 'adforest' );	
		}
		if( get_user_meta( $this->user_info->ID, '_sb_featured_ads', true ) != '-1' )
		{
			$featured_ads	=	get_user_meta( $this->user_info->ID, '_sb_featured_ads', true );
		}
		else
		{
			$featured_ads	=	__('Unlimited', 'adforest' );	
		}
		if( get_user_meta( $this->user_info->ID, '_sb_bump_ads', true ) != '-1' )
		{
			$bump_ads	=	get_user_meta( $this->user_info->ID, '_sb_bump_ads', true );
		}
		else
		{
			$bump_ads	=	__('Unlimited', 'adforest' );	
		}
		
		
	$paid_html = '<dt><strong>' . __('Package Type', 'adforest' ) . ' </strong></dt>
					<dd>
					   '.esc_attr( get_user_meta( $this->user_info->ID, '_sb_pkg_type', true ) ).'
					</dd>
					<dt><strong>' . __('Free Ads Remaining', 'adforest' ) . ' </strong></dt>
					<dd>
					   '.$free_ads.'
					</dd>
					<dt><strong>' . __('Feature Ads Remaining', 'adforest' ) . ' </strong></dt>
					<dd>
					   '.$featured_ads.'
					</dd>
					<dt><strong>' . __('Bump-up Ads Remaining', 'adforest' ) . ' </strong></dt>
					<dd>
					   '.$bump_ads.'
					</dd>
					<dt><strong>' . __('Package Expiry', 'adforest' ) . ' </strong></dt>
					<dd>
					   '.$expiry.'
					</dd>';
	}
	
	
	$user_type = '';
	if( get_user_meta( $this->user_info->ID, '_sb_user_type', true ) == 'Indiviual' )
	{
		$user_type = __('Individual', 'adforest');
	}
	else if( get_user_meta( $this->user_info->ID, '_sb_user_type', true ) == 'Dealer' )
	{
		$user_type = __('Dealer', 'adforest');	
	}
	
	
		// Phone verification logic
		$is_verified = '';
		if( isset( $adforest_theme['sb_phone_verification'] ) && $adforest_theme['sb_phone_verification'] && in_array( 'wp-twilio-core/core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && get_user_meta( $this->user_info->ID , '_sb_contact', true ) != "" )
		{
			if( get_user_meta( $this->user_info->ID, '_sb_is_ph_verified', true ) == '1' )
			{
				$is_verified	=	'<span class="label label-success sb_user_type">'.__('Verified','adforest').'</span>';
			}
			else
			{
				$is_verified	=	'<span class="label label-danger sb_user_type">'.__('Not verified','adforest').'</span>&nbsp;
				<a data-target="#verification_modal" data-toggle="modal" class="small_text">'. __( 'Verify now?','adforest' ).'</a>
				';
			}
		}
	
	$res =  '
	<div class="profile-section margin-bottom-20">
		<div class="profile-tabs">
		   <div class="tab-content">
			  <div class="profile-edit tab-pane fade in active" id="profile">
				 <h2 class="heading-md">' . __('Manage your profile', 'adforest' ) . '</h2>
				 <dl class="dl-horizontal">
					<dt><strong>' . __('Your name', 'adforest' ) . '</strong></dt>
					<dd>
					   '.esc_html($this->user_info->display_name).'
					</dd>
					<dt><strong>' . __('Email Address', 'adforest' ) . ' </strong></dt>
					<dd>
					   '.esc_html($this->user_info->user_email).'
					</dd>
					<dt><strong>' . __('Phone Number', 'adforest' ) . ' </strong></dt>
					<dd>
					   '.esc_html( get_user_meta( $this->user_info->ID , '_sb_contact', true )).'
					   &nbsp;'.$is_verified.'
					</dd>
					<dt><strong>' . __('You are a(n)', 'adforest' ) . ' </strong></dt>
					<dd>
					   '.$user_type.'
					</dd>
					<dt><strong>' . __('Location', 'adforest' ) . ' </strong></dt>
					<dd>
					   '.esc_html( get_user_meta( $this->user_info->ID, '_sb_address', true ) ).'
					</dd>
						'.$paid_html.'
				 </dl>
			  </div>
		   </div>
		</div>
	 </div>
	 ';
	 	return $res . '<div class="custom-modal">
         <div id="verification_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header rte">
                     <h2 class="modal-title">'.  __( 'Verify phone number','adforest' ).'</h2>
                  </div>
                    <form id="sb-ph-verification">
                 <div class="modal-body">

                    <div class="form-group sb_ver_ph_div">
                      <label>'. __( 'Phone number','adforest' ).'</label>
                      <input class="form-control" value="'.esc_html( get_user_meta( $this->user_info->ID , '_sb_contact', true )).'" type="text" name="sb_ph_number" id="sb_ph_number" readonly>
                    </div>
                    <div class="form-group sb_ver_ph_code_div no-display">
                      <label>'. __( 'Enter code','adforest' ).'</label>
                      <input class="form-control" type="text" name="sb_ph_number_code" id="sb_ph_number_code">
					  <small class="pull-right">'. __('Did not get code?','adforest') .' <a href="javascript:void(0);" class="small_text" id="resend_now">'. __('Resend now','adforest') .'</a></small>
                    </div>
                 </div>
                 <div class="modal-footer">
                       <button class="btn btn-theme btn-sm" type="button" id="sb_verification_ph">'.  __( 'Verify now','adforest' ).'</button>
                       <button class="btn btn-theme btn-sm no-display" type="button" id="sb_verification_ph_back">'.  __( 'Processing ...','adforest' ).'</button>
                       <button class="btn btn-theme btn-sm no-display" type="button" id="sb_verification_ph_code">'.  __( 'Verify now','adforest' ).'</button>
                    
                 </div>
          </form>
               </div>
            </div>
         </div>
    </div>
';
	}
	
	
	function adforest_profile_update_form()
	{
	$user_pic	=	$user_pic	=	adforest_get_user_dp($this->user_info->ID);
	
	$is_indiviual	=	'';						 
	$is_dealer	=	'';		 				 
	if( get_user_meta( $this->user_info->ID, '_sb_user_type', true ) == 'Dealer' )
	{
		$is_dealer	=	'selected="selected"';
	}
	if( get_user_meta( $this->user_info->ID, '_sb_user_type', true ) == 'Indiviual' )
	{
		$is_indiviual	=	'selected="selected"';
	}
		$user_type = '<option value="Indiviual"  '.$is_indiviual.'>'. __( 'Individual', 'adforest' ) .'</option>
					 <option value="Dealer" '.$is_dealer.'>'. __( 'Dealer', 'adforest' ) .'</option>';

							 
			$change_password_html = '';
			$my_url = adforest_get_current_url();
			if (strpos($my_url, 'adforest.scriptsbundle.com') !== false)
			{
				$change_password_html = '<a data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Disable for Demo', 'adforest' ) .'">'. __( 'Change Password','adforest' ).'</a>';
			}
			else
			{
				$change_password_html = '<a data-target="#myModal" data-toggle="modal">'. __( 'Change Password','adforest' ).'</a>';
			}
			$intro_html  = '';
			if( true)
			{
				$intro_html = '<div class="col-md-12 col-sm-12 col-xs-12 margin-bottom-30">
						  <label>'. __( 'Introduction', 'adforest' ) .' <span class="color-red"></span></label>
						  <textarea name="sb_user_intro" class="form-control" rows="6">'.esc_attr( get_user_meta( $this->user_info->ID, '_sb_user_intro', true ) ).'</textarea>
					   </div>';
			}
			global $adforest_theme;
			if( isset( $adforest_theme['sb_enable_social_links'] ) && $adforest_theme['sb_enable_social_links'] )
			{
				$social_html	=	'';
				$profiles	=	adforest_social_profiles();
				foreach( $profiles as $key => $value )
				{
					
					$social_html	.= '<div class="col-md-6 col-sm-6 col-xs-12">
						  <label>'. $value .' <span class="color-red"></span></label>
						  <input type="text" class="form-control margin-bottom-20" value="'.esc_attr( get_user_meta( $this->user_info->ID, '_sb_profile_' . $key, true ) ).'" name="_sb_profile_'.$key.'">
					   </div>';
				}	
			}
			
			$ph_placeholder	=	'';
			if( isset( $adforest_theme['sb_phone_verification'] ) && $adforest_theme['sb_phone_verification'] && in_array( 'wp-twilio-core/core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
			{
				$ph_placeholder	= __( '+CountrycodePhonenumber', 'adforest' );
			}
		
		return adforest_load_search_countries() . adforest_get_location( 'adforest_location' ) . '
	<div class="profile-section margin-bottom-20">
		<div class="profile-tabs">
		   <div class="tab-content">
			<div class="profile-edit tab-pane fade in active" id="edit">
				 <h2 class="heading-md">'. __( 'Manage your Security Settings', 'adforest' ) .'</h2>
				 <p>'. __( 'Manage Your Account', 'adforest' ) .'</p>
				 <div class="clearfix"></div>
				 <form id="sb_update_profile" enctype="multipart/form-data">
					<div class="row">
					   <div class="col-md-12 col-sm-12 col-xs-12">
						  <p class="help-block pull-right">
						  	'.$change_password_html.'
						  </p>
					   </div>
					   <div class="col-md-6 col-sm-6 col-xs-12">
						  <label>'. __( 'Your Name', 'adforest' ) .'</label>
						  <input type="text" class="form-control margin-bottom-20" value="'.esc_attr( $this->user_info->display_name ).'" name="sb_user_name">
					   </div>
					   <div class="col-md-6 col-sm-6 col-xs-12">
						  <label>'. __( 'Email Address', 'adforest' ) .' <span class="color-red">*</span></label>
						  <input type="text" class="form-control margin-bottom-20" value="'.esc_attr( $this->user_info->user_email ).'" readonly>
					   </div>
					   <div class="col-md-6 col-sm-12 col-xs-12">  
						  <label>'. __( 'Contact Number', 'adforest' ) .'<span class="color-red">*</span></label>
						  <input type="text" class="form-control margin-bottom-20" name="sb_user_contact" id="sb_user_contact" value="'.esc_attr( get_user_meta( $this->user_info->ID, '_sb_contact', true ) ).'" placeholder="'. $ph_placeholder.'">
					   </div>
					   <div class="col-md-6 col-sm-12 col-xs-12 margin-bottom-20 form-group">
						  <label>'. __( 'I am', 'adforest' ) .' <span class="color-red">*</span></label>
						  <select class="category form-control" name="sb_user_type">
							 '.$user_type.'
						  </select>
					   </div>
					   '.$social_html.'
					   <div class="col-md-12 col-sm-12 col-xs-12 margin-bottom-20">
						  <label>'. __( 'Location', 'adforest' ) .' <span class="color-red">*</span></label>
						  <input type="text" class="form-control margin-bottom-20" name="sb_user_address" id="sb_user_address" autocomplete="on" value="'.esc_attr( get_user_meta( $this->user_info->ID, '_sb_address', true ) ).'">
						  
					   </div>
					   '.$intro_html.'
					</div>   
				 <div class="row margin-bottom-20">
					   <div class="form-group">
						  <div class="col-md-9">
							 <div class="input-group">
								<span class="input-group-btn">
								<span class="btn btn-default btn-file">
								'.__('Edit Profile Picture','adforest').'
								<input type="file" id="imgInp" name="my_file_upload[]" accept = "image/*" class="sb_files-data form-control">
								</span>
								</span>
								<input type="text" class="form-control" readonly>
							 </div>
						  </div>
						  <div class="col-md-3">
							 <img id="img-upload" class="img-responsive" src="'.$user_pic.'" alt="'.__('Profile Picture', 'adforest').'" width="100" height="100" />
						  </div>
					   </div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
					   <div class="col-md-8 col-sm-8 col-xs-12">
					   </div>
					   <div class="col-md-4 col-sm-4 col-xs-12 text-right">
						  <button type="button" class="btn btn-theme btn-sm" id="sb_user_profile_update">
						  '. __( 'Update My Info', 'adforest' ) .'
						  </button>
					   </div>
					</div>
				 </form>
			  </div>
			  <div class="custom-modal">
         <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header rte">
                     <h2 class="modal-title">'.  __( 'Password Change','adforest' ).'</h2>
                  </div>
					<form id="sb-change-password">
				 <div class="modal-body">
					<div class="form-group">
					  <label>'. __( 'Current Password','adforest' ).'</label>
					  <input placeholder="'.  __( 'Current Password','adforest' ).'" class="form-control" type="password"  name="current_pass" id="current_pass">
					</div>
					<div class="form-group">
					  <label>'. __( 'New Password','adforest' ).'</label>
					  <input placeholder="'.  __( 'New Password','adforest' ).'" class="form-control" type="password" name="new_pass" id="new_pass">
					</div>
					<div class="form-group">
					  <label>'. __( 'Confirm New Password','adforest' ).'</label>
					  <input placeholder="'.  __( 'Confirm Password','adforest' ).'" class="form-control" type="password" name="con_new_pass" id="con_new_pass">
					</div>
				 </div>
				 <div class="modal-footer">
					   <button class="btn btn-theme btn-sm" type="button" id="change_pwd">'.  __( 'Reset My Account','adforest' ).'</button>
					
				 </div>
		  </form>
               </div>
            </div>
         </div>
      </div>
		';
	}
	
	// Get met Ads
	function adforest_my_ads( $args, $paged, $show_pagination, $fav_ads )
	{
		$ads = new ads();
		return $ads->adforest_get_ads_grid( $args, $paged, $show_pagination, $fav_ads );
	}
}
}


// Ajax handler for add to cart
add_action( 'wp_ajax_sb_add_cart', 'adforest_add_to_cart' );
add_action('wp_ajax_nopriv_sb_add_cart', 'adforest_add_to_cart');
if ( ! function_exists( 'adforest_add_to_cart' ) ) {
function adforest_add_to_cart()
{
		global $adforest_theme;

	if( get_current_user_id() == "" )
	{
		echo '0|' . __( "You must need to logged in.", 'adforest' ) .'|' . get_the_permalink( $adforest_theme['sb_sign_in_page'] );
		die();	
	}
	
	$product_id	= $_POST['product_id'];
	$qty	=	$_POST['qty'];
	global $woocommerce;
	if( $woocommerce->cart->add_to_cart($product_id, $qty) )
	{
		echo '1|' . __( "Added to cart.", 'adforest' ) .'|' . $woocommerce->cart->get_cart_url();
	}
	else
	{
		echo '1|' . __( "Already in your cart.", 'adforest' ) .'|' . $woocommerce->cart->get_cart_url();
	}
	die();
}
}

// Make ad featured
add_action( 'wp_ajax_sb_make_featured', 'adforest_make_featured' );
if ( ! function_exists( 'adforest_make_featured' ) ) {
function adforest_make_featured()
{
	$ad_id		= $_POST['ad_id'];
	$user_id	=	get_current_user_id();
	
	if( get_post_field( 'post_author', $ad_id ) == $user_id )
	{
		
		if( get_user_meta( $user_id, '_sb_featured_ads', true ) != 0 )
		{
			if( get_user_meta( $user_id, '_sb_expire_ads', true ) != '-1' )
			{
				if( get_user_meta( $user_id, '_sb_expire_ads', true ) < date('Y-m-d') )
				{
					echo '0|' . __( "Your package has bee expired.", 'adforest' );
					die();
				}
			}
			$feature_ads	=	get_user_meta($user_id, '_sb_featured_ads', true);
			$feature_ads	=	$feature_ads - 1;
			update_user_meta( $user_id, '_sb_featured_ads', $feature_ads );
			
			update_post_meta( $ad_id, '_adforest_is_feature', '1' );
			update_post_meta( $ad_id, '_adforest_is_feature_date', date( 'Y-m-d' ) );
			echo '1|' . __( "This ad has been featured successfullly.", 'adforest' );
		}
		else
		{
			echo '0|' . __( "Get package in order to make it feature.", 'adforest' );
		}
	}
	else
	{
		echo '0|' . __( "You must be Ad owner tomake it feature.", 'adforest' );
	}

	die();
}
}


// Ajax handler for My ads
add_action( 'wp_ajax_sb_packages','adforest_packages' ); 
if ( ! function_exists( 'adforest_packages' ) ) {
function adforest_packages()
{
	$args	=	array(
	'post_type' => 'product',
	'post_status' => 'publish',
	'order'=> 'DESC',
	'orderby' => 'ID'
	);

	$package	=	new packages();
	echo($package->adforest_get_packages_style_1( $args , 4 ));
	
	die();
}
}


// Ajax handler for My ads
add_action( 'wp_ajax_sb_load_messages','adforest_load_messages' ); 
if ( ! function_exists( 'adforest_load_messages' ) ) {
function adforest_load_messages()
{
	$ad_id	=	$_POST['ad_id'];
	$profile	= new adforest_profile();
	$args	=	array(
	'post_type' => 'ad_post',
	'author' => $profile->user_info->ID,
	'post_status' => 'any',
	'posts_per_page' => get_option( 'posts_per_page' ),
	'paged' => $paged,
	'order'=> 'DESC',
	'orderby' => 'ID'
	);

	
	$ads	=	new ads();
	echo($ads->adforest_load_messages( $ad_id ));
	
	die();
}
}


// Ajax handler for messages
add_action( 'wp_ajax_my_msgs','adforest_my_msgs' ); 
if ( ! function_exists( 'adforest_my_msgs' ) ) {
function adforest_my_msgs()
{
	$profile	= new adforest_profile();
	$ads	=	new ads();
	echo($ads->adforest_get_messages( $profile->user_info->ID ));
	
	die();
}
}

// ajax handler for featured Ads

add_action( 'wp_ajax_my_feature_ads','adforest_my_feature_ads' );
if ( ! function_exists( 'adforest_my_feature_ads' ) ) {
function adforest_my_feature_ads()
{
	$profile	= new adforest_profile();
	$paged	=	$_POST['paged'];
	if( !isset( $paged )  )
		$paged = 1;
	$args	=	array(
	'post_type' => 'ad_post',
	'author' => $profile->user_info->ID,
	'post_status' => 'any',
	'posts_per_page' => get_option( 'posts_per_page' ),
	'meta_key' => '_adforest_is_feature',
	'meta_value' => '1',
	'paged' => $paged,
	'order'=> 'DESC',
	'orderby' => 'ID'
);
	$fav_ads	=	'no';
	$show_pagination = 1;
	$ads = new ads();
	echo($ads->adforest_get_featured_ads_grid( $args, $paged, $show_pagination, $fav_ads ));
	
	die();
}
}

// Ajax handler for My ads
add_action( 'wp_ajax_my_ads','adforest_my_ads' ); 
if ( ! function_exists( 'adforest_my_ads' ) ) {
function adforest_my_ads()
{
	$profile	= new adforest_profile();
	$paged	=	$_POST['paged'];
	if( !isset( $paged )  )
		$paged = 1;
	$args	=	array(
	'post_type' => 'ad_post',
	'author' => $profile->user_info->ID,
	'post_status' => 'publish',
	'posts_per_page' => get_option( 'posts_per_page' ),
	'paged' => $paged,
	'order'=> 'DESC',
	'orderby' => 'ID'
);
	$fav_ads	=	'no';
	$show_pagination = 1;
	echo ( $profile->adforest_my_ads( $args, $paged, $show_pagination, $fav_ads ) );

	die();
}
}

// Ajax handler my_ads_msgs
add_action( 'wp_ajax_received_msgs_ads_list','adforest_received_msgs_ads_list' ); 
if ( ! function_exists( 'adforest_received_msgs_ads_list' ) ) {
function adforest_received_msgs_ads_list()
{
	$ads = new ads();
	echo ( $ads->adforest_get_user_ads_list() );

	die();
}
}

// Ajax handler for My ads
add_action( 'wp_ajax_my_inactive_ads','adforest_my_inactive_ads' );
if ( ! function_exists( 'adforest_my_inactive_ads' ) ) { 
function adforest_my_inactive_ads()
{
	$profile	= new adforest_profile();
	$paged	=	$_POST['paged'];
	if( !isset( $paged )  )
		$paged = 1;
	$args	=	array(
	'post_type' => 'ad_post',
	'author' => $profile->user_info->ID,
	'post_status' => 'pending',
	'posts_per_page' => get_option( 'posts_per_page' ),
	'paged' => $paged,
	'order'=> 'DESC',
	'orderby' => 'ID'
);
	$show_pagination = 1;
	
	$ads = new ads();
	echo ( $ads->adforest_get_ads_grid_inactive( $args, $paged, $show_pagination, 'inactive') );

	die();
}
}

// Ajax handler for My ads
add_action( 'wp_ajax_my_fav_ads','adforest_my_fav_ads' );
if ( ! function_exists( 'adforest_my_fav_ads' ) ) { 
function adforest_my_fav_ads()
{
	$profile	= new adforest_profile();
	$paged	=	$_POST['paged'];
	if( !isset( $paged )  )
		$paged = 1;
		
	// Getting most ID of fav ads
	global $wpdb;
	$uid	=	$profile->user_info->ID;
	$rows = $wpdb->get_results( "SELECT meta_value FROM $wpdb->usermeta WHERE user_id = '$uid' AND meta_key LIKE '_sb_fav_id_%'" );
	$pids	=	array(0);
	foreach( $rows as $row )
	{
		$pids[]	=	$row->meta_value;	
	}
	$args	=	array(
	'post_type' => 'ad_post',
	'post__in' => $pids,
	'post_status' => 'publish',
	'posts_per_page' => get_option( 'posts_per_page' ),
	'paged' => $paged,
	'order'=> 'DESC',
	'orderby' => 'ID'
);
	$show_pagination = 1;
	$fav_ads	=	'yes';
	echo ( $profile->adforest_my_ads( $args, $paged, $show_pagination, $fav_ads ) );
	die();
}
}


// Ajax hander for get profile
add_action( 'wp_ajax_get_profile','adforest_profile_get_ajax' );
if ( ! function_exists( 'adforest_profile_get_ajax' ) ) { 
function adforest_profile_get_ajax()
{
	$profile	= new adforest_profile();
	echo ( $profile->adforest_profile_get() );
	die();
}
}


// Ajax hander for update profile
add_action( 'wp_ajax_update_profile','adforest_profile_update_ajax' );
if ( ! function_exists( 'adforest_profile_update_ajax' ) ) { 
function adforest_profile_update_ajax()
{
	$profile	= new adforest_profile();
	echo ( $profile->adforest_profile_update_form() );
	die();
}
}

// Ajax hander for update profile processing
add_action( 'wp_ajax_sb_update_profile','adforest_profile_update_ajax_processed' );
if ( ! function_exists( 'adforest_profile_update_ajax_processed' ) ) {  
function adforest_profile_update_ajax_processed()
{
	
	// Getting values
	$params = array();
    parse_str($_POST['sb_data'], $params);
		
	$profile	= new adforest_profile();
	$uid	=	$profile->user_info->ID;
	
	global $adforest_theme;
	if( isset( $adforest_theme['sb_phone_verification'] ) && $adforest_theme['sb_phone_verification'] && in_array( 'wp-twilio-core/core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
	{
		$ph_num	= sanitize_text_field($params['sb_user_contact']);
		if(!preg_match("/\+[0-9]+$/", $ph_num)) {
		 	echo __('Please enter valid phone number +CountrycodePhonenumber','adforest');
			die();
		}
		
		$saved_ph = get_user_meta( $uid, '_sb_contact', true );
		if( $saved_ph != $ph_num )
		{
			update_user_meta( $uid, '_sb_is_ph_verified', '0' );
		}
		

		
	}
	wp_update_user( array( 'ID' => $uid, 'display_name' => sanitize_text_field($params['sb_user_name'] )) );
	update_user_meta($uid, '_sb_contact', sanitize_text_field($params['sb_user_contact']));
	update_user_meta($uid, '_sb_address', sanitize_text_field($params['sb_user_address']));
	update_user_meta($uid, '_sb_user_type', sanitize_text_field($params['sb_user_type']));
	update_user_meta($uid, '_sb_user_intro', sanitize_textarea_field($params['sb_user_intro']));
	
	$profiles	=	adforest_social_profiles();
	foreach( $profiles as $key => $value )
	{
		update_user_meta($uid, '_sb_profile_' . $key, sanitize_textarea_field($params['_sb_profile_' . $key]));
	}

		
	echo '1';
	die();
}
}

add_action('wp_ajax_upload_user_pic', 'adforest_user_profile_pic');
if ( ! function_exists( 'adforest_user_profile_pic' ) ) {  
function adforest_user_profile_pic(){
    

  /* img upload */

 $condition_img=7;
 $img_count = count(explode( ',',$_POST["image_gallery"] )); 

 if(!empty($_FILES["my_file_upload"])){

 require_once ABSPATH . 'wp-admin/includes/image.php';
 require_once ABSPATH . 'wp-admin/includes/file.php';
 require_once ABSPATH . 'wp-admin/includes/media.php';
  
   
 $files = $_FILES["my_file_upload"];
 

   
 $attachment_ids=array();
 $attachment_idss='';

 if($img_count>=1){
 $imgcount=$img_count;
 }else{
 $imgcount=1;
 }
  

 $ul_con='';

 foreach ($files['name'] as $key => $value) {            
   if ($files['name'][$key]) { 
    $file = array( 
     'name' => $files['name'][$key],
     'type' => $files['type'][$key], 
     'tmp_name' => $files['tmp_name'][$key], 
     'error' => $files['error'][$key],
     'size' => $files['size'][$key]
    ); 
	
    $_FILES = array ("my_file_upload" => $file); 
	
// Allow certain file formats
$imageFileType	=	strtolower( end( explode('.', $file['name'] ) ) );
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo '0|' . __( "Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 'adforest' );
	die();
}
 
 // Check file size
if ($file['size'] > 2097152) {
    echo '0|' . __( "Max allowd image size is 2MB", 'adforest' );
    die();
}
    
    
    foreach ($_FILES as $file => $array) {              
      
      if($imgcount>=$condition_img){ break; } 
     $attach_id = media_handle_upload( $file, $post_id );
      $attachment_ids[] = $attach_id; 

      $image_link = wp_get_attachment_image_src( $attach_id, 'adforest-user-profile' );
      
    }
    if($imgcount>$condition_img){ break; } 
    $imgcount++;
   } 
  }

  
 } 
/*img upload */
$attachment_idss = array_filter( $attachment_ids  );
$attachment_idss =  implode( ',', $attachment_idss );  


$arr = array();
$arr['attachment_idss'] = $attachment_idss;
$arr['ul_con'] =$ul_con; 

$profile	= new adforest_profile();
$uid	=	$profile->user_info->ID;
update_user_meta($uid, '_sb_user_pic', $attach_id );
echo '1|' . $image_link[0];
 die();

}
}

if ( ! function_exists( 'adforest_get_all_ads' ) ) {  
function adforest_get_all_ads( $user_id )
{
	global $wpdb;
	$total = $wpdb->get_var( "SELECT COUNT(*) AS total FROM  $wpdb->posts WHERE post_type = 'ad_post' AND post_status = 'publish' AND post_author = '$user_id'" );
	return $total;
}
}

if ( ! function_exists( 'adforest_get_sold_ads' ) ) {  
function adforest_get_sold_ads( $user_id )
{
	global $wpdb;
	$total = $wpdb->get_var( "SELECT COUNT(*) AS total FROM $wpdb->posts WHERE post_type = 'ad_post' AND post_author = '$user_id' AND post_status = 'publich' " );
	
	$args	=	array(
	'post_type' => 'ad_post',
	'author' => $user_id,
	'post_status' => 'publish',
	'meta_key' => '_adforest_ad_status_',
	'meta_value' => 'sold',
	);

	$query = new WP_Query( $args );
	return $query->post_count;
}
}

if ( ! function_exists( 'adforest_get_fav_ads' ) ) {  
function adforest_get_fav_ads( $user_id )
{
	global $wpdb;
	$rows = $wpdb->get_results( "SELECT meta_value FROM $wpdb->usermeta WHERE user_id = '$user_id' AND meta_key LIKE  '_sb_fav_id%' " );
	$total	=	0;
	foreach( $rows as $row )
	{
		if( get_post_status( $row->meta_value ) == 'publish' )
		{
			$total++;
		}
	}
	return $total;
	
	

}
}

if ( ! function_exists( 'adforest_get_disbale_ads' ) ) {  
function adforest_get_disbale_ads( $user_id )
{
	global $wpdb;
	$rows = $wpdb->get_results( "SELECT ID FROM $wpdb->posts WHERE post_author = '$user_id' AND post_status = 'pending' AND post_type = 'ad_post' " );
	
	return count( $rows );
	
	

}
}


// Add to favourites
add_action('wp_ajax_sb_fav_ad', 'adforest_sb_fav_ad');
add_action('wp_ajax_nopriv_sb_fav_ad', 'adforest_sb_fav_ad');
if ( ! function_exists( 'adforest_sb_fav_ad' ) ) {  
function adforest_sb_fav_ad()
{
	adforest_authenticate_check();
	
	$ad_id		=	$_POST['ad_id'];
	
	if( get_user_meta( get_current_user_id(), '_sb_fav_id_' . $ad_id, true ) == $ad_id )
	{
		echo '0|' . __( "You have added already.", 'adforest' );
	}
	else
	{
		update_user_meta( get_current_user_id(), '_sb_fav_id_' . $ad_id, $ad_id )	;
		echo '1|' . __( "Added to your favourites.", 'adforest' );
	}

	
	die();
}
}

// Remove to favourites
add_action('wp_ajax_sb_fav_remove_ad', 'adforest_sb_fav_remove_ad');
if ( ! function_exists( 'adforest_sb_fav_remove_ad' ) ) {  
function adforest_sb_fav_remove_ad()
{
	adforest_authenticate_check();
	
	$ad_id		=	$_POST['ad_id'];
	
	if ( delete_user_meta(get_current_user_id(), '_sb_fav_id_' . $ad_id) )
	{
  		echo '1|' . __( "Ad removed successfully.", 'adforest' );
	}
	else
	{
		echo '0|' . __( "There'is some problem, please try again later.", 'adforest' );
	}
	die();
}
}

// Remove Ad
add_action('wp_ajax_sb_remove_ad', 'adforest_sb_remove_ad');
if ( ! function_exists( 'adforest_sb_remove_ad' ) ) {  
function adforest_sb_remove_ad()
{
	adforest_authenticate_check();
	
	$ad_id		=	$_POST['ad_id'];
	if( wp_trash_post( $ad_id ) )
	{
		echo '1|' . __( "Ad removed successfully.", 'adforest' );
	}
	else
	{
		echo '0|' . __( "There'is some problem, please try again later.", 'adforest' );
	}

	
	die();
}
}


// Remove Ad
add_action('wp_ajax_sb_update_ad_status', 'adforest_sb_update_ad_status');
if ( ! function_exists( 'adforest_sb_update_ad_status' ) ) {  
function adforest_sb_update_ad_status()
{
	adforest_authenticate_check();
	$ad_id		=	$_POST['ad_id'];
	$status		=	$_POST['status'];
	update_post_meta($ad_id, '_adforest_ad_status_', $status );
	echo '1|' . __( "Updated successfully.", 'adforest' );
	die();
}
}


// Get user profile PIC
if ( ! function_exists( 'adforest_get_user_dp' ) ) { 
function adforest_get_user_dp( $user_id, $size = 'adforest-single-small' )
{
	global $adforest_theme;
	$user_pic	=	trailingslashit( get_template_directory_uri () ) . 'images/users/9.jpg';
	if( isset( $adforest_theme['sb_user_dp']['url'] ) && $adforest_theme['sb_user_dp']['url'] != "" )
	{
		$user_pic = $adforest_theme['sb_user_dp']['url'];	
	}
	
	$image_link	= array();
	if( get_user_meta($user_id, '_sb_user_pic', true ) != "" )
	{
		$attach_id =	get_user_meta($user_id, '_sb_user_pic', true );
		$image_link = wp_get_attachment_image_src( $attach_id, $size );
	}
	if( count( $image_link ) > 0 )
	{
		return $image_link[0];
	}
	else
	{
		return $user_pic;	
	}
}
}

// check permission for ad posting
if ( ! function_exists( 'adforest_check_validity' ) ) { 
function adforest_check_validity()
{
	global $adforest_theme;
	$uid	=	get_current_user_id();
	if( get_user_meta( $uid, '_sb_simple_ads', true ) == 0 || get_user_meta( $uid, '_sb_simple_ads', true ) == "" )
	{
		adforest_redirect_with_msg( get_the_permalink( $adforest_theme['sb_packages_page'] ), __( 'Please subscribe package for ad posting.', 'adforest') );
		exit;	
	}
	else
	{
		
		if( get_user_meta( $uid, '_sb_expire_ads', true ) != '-1' )
		{
			if( get_user_meta( $uid, '_sb_expire_ads', true ) < date('Y-m-d') )
			{
				update_user_meta( $uid, '_sb_simple_ads', 0 );
				update_user_meta( $uid, '_sb_featured_ads', 0 );
				adforest_redirect_with_msg( get_the_permalink( $adforest_theme['sb_packages_page'] ), __( "Your package has been expired.", 'adforest') );
				exit;		
			}
		}	
	}
		
}
}

if ( ! function_exists( 'adforest_load_countries' ) ) { 
function adforest_load_countries()
{
	global $wpdb;
	$res	=	$wpdb->get_results( "SELECT post_excerpt FROM $wpdb->posts WHERE post_type = '_sb_country' AND post_status = 'publish'"  );
	$countries	=	array();
	foreach( $res as $r )
	{
		$countries[]	=	$r->post_excerpt;	
	}
	return json_encode($countries);
	


}
}

if ( ! function_exists( 'adforest_load_search_countries' ) ) {
function adforest_load_search_countries($action_on_complete = '')
{
	global $adforest_theme;
	$stricts = '';
	if( isset( $adforest_theme['sb_location_allowed'] ) && !$adforest_theme['sb_location_allowed'] && isset ($adforest_theme['sb_list_allowed_country'] ) )
	{
		$stricts = "componentRestrictions: {country: ". json_encode( $adforest_theme['sb_list_allowed_country'] ) . "}";
	}
	$types	= "'(cities)'";
	if( isset( $adforest_theme['sb_location_type'] ) && $adforest_theme['sb_location_type'] != "" )
	{
		if( $adforest_theme['sb_location_type'] == 'regions' )
			$types = "";
		else
			$types = "'(cities)'";
	}

echo "<script>
	   function adforest_location() {
	   var options = {
  types: [".$types."],
  ".$stricts."
 };
      var input = document.getElementById('sb_user_address');
	  var action_on_complete	=	'".$action_on_complete."';
      var autocomplete = new google.maps.places.Autocomplete(input, options);
	  if( action_on_complete )
	  {
	   new google.maps.event.addListener(autocomplete, 'place_changed', function() {
	  // document.getElementById('sb_loading').style.display	= 'block';
    var place = autocomplete.getPlace();
	document.getElementById('ad_map_lat').value = place.geometry.location.lat();
	document.getElementById('ad_map_long').value = place.geometry.location.lng();
	var markers = [
        {
            'title': '',
            'lat': place.geometry.location.lat(),
            'lng': place.geometry.location.lng(),
        },
    ];
	my_g_map(markers);
	//document.getElementById('sb_loading').style.display	= 'none';
});
	   }

   }
   </script>";
	
}
}

// Ajax handler for Change Password
add_action( 'wp_ajax_sb_change_password', 'adforest_change_password' );
if ( ! function_exists( 'adforest_change_password' ) ) {
function adforest_change_password()
{
	adforest_authenticate_check();
	global $adforest_theme;
	// Getting values
	$params = array();
    parse_str($_POST['sb_data'], $params);
	$current_pass	=	$params['current_pass'];
	$new_pass	=	$params['new_pass'];
	$con_new_pass	=	$params['con_new_pass'];
	if( $current_pass == "" || $new_pass == "" || $con_new_pass == "" )
	{
		echo '0|' . __( "All fields are required.", 'adforest' );
		die();
	}
	if( $new_pass != $con_new_pass )
	{
		echo '0|' . __( "New password not matched.", 'adforest' );
		die();
	}
	$user = get_user_by( 'ID', get_current_user_id() );
	if( $user && wp_check_password( $current_pass, $user->data->user_pass, $user->ID) )
	{
		wp_set_password( $new_pass, $user->ID );
		echo '1|' . __( "Password changed successfully.", 'adforest' );
	}
	else
	{
	   echo '0|' . __( "Current password not matched.", 'adforest' );
	}
	
	die();
}
}

// Check Notification
add_action('wp_ajax_sb_check_messages', 'adforest_check_messages');
if ( ! function_exists( 'adforest_check_messages' ) ) {
function adforest_check_messages()
{
	adforest_authenticate_check();
	
	$user_id		=	get_current_user_id();
	$current_msgs	= $_POST['new_msgs'];
	global $wpdb;
	$unread_msgs = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->commentmeta WHERE comment_id = '$user_id' AND meta_value = '0' " );
	
	if ( $unread_msgs > $current_msgs )
	{
		global $adforest_theme;
  		echo '1|' . str_replace( '%count%', $unread_msgs, $adforest_theme['msg_notification_text'] ) . '|' . $unread_msgs;
	}
	die();
}
}


// Check Notification
add_action('wp_ajax_sb_get_notifications', 'adforest_get_notifications');
if ( ! function_exists( 'adforest_get_notifications' ) ) {
function adforest_get_notifications()
{
	global $wpdb;
	global $adforest_theme;
	$user_id		=	get_current_user_id();
	$notes = $wpdb->get_results( "SELECT * FROM $wpdb->commentmeta WHERE comment_id = '$user_id' AND  meta_value = 0 ORDER BY meta_id DESC LIMIT 5", OBJECT );
	if( count( $notes ) > 0 )
	{
		$list = '';
		foreach( $notes as $note )
		{
			$ad_img	=	$adforest_theme['default_related_image']['url'];
			$get_arr	=	explode( '_', $note->meta_key );
			$ad_id = $get_arr[0];
			$media	=	 adforest_get_ad_images($ad_id);
			if( count( $media ) > 0 )
			{
				$counting	=	1;
				foreach( $media as $m )
				{
					if( $counting > 1 )
					{
						$mid	=	'';
						if ( isset( $m->ID ) )
							$mid	= 	$m->ID;
						else
							$mid	=	$m;	
							
						$image  = wp_get_attachment_image_src( $mid, 'adforest-single-small');
						if( $image[0] != "" )
						{
							$ad_img = $image[0];	
						}
						break;
					}
					$counting++;	
				}
			}
			
			$action = get_the_permalink( $adforest_theme['sb_profile_page'] ) . '?sb_action=sb_get_messages'.  '&ad_id=' . $ad_id  .  '&user_id=' . $user_id .'&uid=' . $get_arr[1];
			$poster_id	=	get_post_field( 'post_author', $ad_id );
			if( $poster_id == $user_id )
			{
				$action = get_the_permalink( $adforest_theme['sb_profile_page'] ) . '?sb_action=sb_load_messages' .  '&ad_id=' . $ad_id .  '&uid=' . $get_arr[1];
			}
			$user_data	=	get_userdata( $get_arr[1] );
			$user_pic	=	adforest_get_user_dp($get_arr[1]);
			$list .= '<a href="'.esc_url( $action ) .'"><div class="user-img"> <img src="'.esc_url( $user_pic ).'" alt="'. $user_data->display_name.'" width="30" height="50" > </div><div class="mail-contnet"><h5>'.$user_data->display_name.'</h5> <span class="mail-desc">'. get_the_title( $ad_id ).'</span></div></a>';
			
		}
		echo $list;
	}
	die();
}
}


// Rate User
add_action('wp_ajax_sb_post_user_ratting', 'adforest_post_user_ratting');
add_action('wp_ajax_nopriv_sb_post_user_ratting', 'adforest_post_user_ratting');
if ( ! function_exists( 'adforest_post_user_ratting' ) ) {
function adforest_post_user_ratting()
{
	adforest_authenticate_check();
	// Getting values
	$params = array();
    parse_str($_POST['sb_data'], $params);
	$ratting	=	$params['sb_rate_user'];
	$comments	=	$params['sb_rate_user_comments'];
	$author	=	$params['author'];
	$rator		=	get_current_user_id();
	
	if( $author == $rator )
	{
		echo '0|' . __( "You can't rate yourself.", 'adforest' );
		die();	
	}
	if( get_user_meta( $author, "_user_" . $rator, true ) == "" )
	{ 
		update_user_meta($author, "_user_" . $rator, $ratting ."_separator_" . $comments ."_separator_" . date('Y-m-d'));
		
		$ratings	=	adforest_get_all_ratings($author);
		$all_rattings	=	0;
		$got	=	0;
		if( count( $ratings ) > 0 )
		{
			foreach( $ratings as $rating )
			{
			$data	=	explode( '_separator_', $rating->meta_value );
			$got	=	$got + $data[0];
			$all_rattings++;
			}
			$avg	=	 $got/$all_rattings;
		}
		else
		{
			$avg = $ratting;
		}
		
		update_user_meta($author, "_adforest_rating_avg", $avg );
		$total	=	get_user_meta( $author, "_adforest_rating_count", true );
		if( $total == "" )
			$total = 0;
		$total	=	$total + 1;
		update_user_meta($author, "_adforest_rating_count", $total  );
		
		// Send email if enabled
		global $adforest_theme;
		if( isset( $adforest_theme['email_to_user_on_rating'] ) && $adforest_theme['email_to_user_on_rating'] )
		{
			adforest_send_email_new_rating( $rator, $author, $ratting, $comments );
		}

		
		echo '1|' . __( "You've rated this user.", 'adforest' );
	}
	else
	{
		echo '0|' . __( "You already rated this user.", 'adforest' );	
	}
	die();
}
}


// Reply Rator
add_action('wp_ajax_sb_reply_user_rating', 'adforest_reply_rator');
add_action('wp_ajax_nopriv_sb_reply_user_rating', 'adforest_reply_rator');
if ( ! function_exists( 'adforest_reply_rator' ) ) {
function adforest_reply_rator()
{
	adforest_authenticate_check();
	$params = array();
    parse_str($_POST['sb_data'], $params);
	$comments	=	$params['sb_rate_user_comments'];
	$rator	=	$params['rator_reply'];
	$got_ratting		=	get_current_user_id();
	
	$ratting = get_user_meta( $got_ratting, "_user_" . $rator, true );
	$data_arr	=	explode( '_separator_', $ratting );
	if( count( $data_arr ) > 3 )
	{
		echo '0|' . __( "You already replied to this user.", 'adforest' );
	}
	else
	{
		$ratting = $ratting .  "_separator_" . $comments . "_separator_" . date('Y-m-d');
		update_user_meta( $got_ratting, '_user_' . $rator, $ratting );
		echo '1|' . __( "You're reply has been posted.", 'adforest' );
	}
	die();
}
}

if ( ! function_exists( 'adforest_get_all_ratings' ) ) {
function adforest_get_all_ratings( $user_id )
{
	global $wpdb;
	$ratings = $wpdb->get_results( "SELECT * FROM $wpdb->usermeta WHERE user_id = '$user_id' AND  meta_key like  '_user_%' ORDER BY umeta_id DESC", OBJECT );
	return $ratings;

}
}


// Submit bid
add_action('wp_ajax_sb_submit_bid', 'adforest_submit_bid');
add_action('wp_ajax_nopriv_sb_submit_bid', 'adforest_submit_bid');
if ( ! function_exists( 'adforest_submit_bid' ) ) {
function adforest_submit_bid()
{
	adforest_authenticate_check();
	global $adforest_theme;
	$params = array();
    parse_str($_POST['sb_data'], $params);
	$comments	=	sanitize_text_field($params['bid_comment']);
	$offer	=	sanitize_text_field($params['bid_amount']);
	$ad_id	=	$params['ad_id'];
	$offer_by		=	get_current_user_id();
	$ad_author = get_post_field( 'post_author', $ad_id );
	if( $offer_by == $ad_author )
	{
		echo '0|' . __( "Ad author can't post bid.", 'adforest' );
		die();
	}
	$bid =	'';
	if( $offer == "" )
	{
		$bid = date('Y-m-d') .  "_separator_" . $comments . "_separator_" . $offer_by;
	}
	else
	{
		$bid = date('Y-m-d') .  "_separator_" . $comments . "_separator_" . $offer_by . "_separator_" . $offer;
	}
	
	if( isset( $adforest_theme['sb_email_on_new_bid_on'] ) && $adforest_theme['sb_email_on_new_bid_on'] )
	{
		adforest_send_email_new_bid($offer_by,$ad_author, $offer, $comments, $ad_id);
	}
	
	$is_exist = get_post_meta( $ad_id, "_adforest_bid_" . $offer_by, true );
	if( $is_exist != "" )
	{
		update_post_meta( $ad_id, "_adforest_bid_" . $offer_by, $bid );
		echo '1|' . __( "Updated successfully.", 'adforest' );
	}
	else
	{
		
		update_post_meta( $ad_id, "_adforest_bid_" . $offer_by, $bid );
		echo '1|' . __( "Posted successfully.", 'adforest' );
	}
	die();
}
}

if ( ! function_exists( 'adforest_get_all_biddings' ) ) {
function adforest_get_all_biddings( $ad_id )
{
	global $wpdb;
	$biddings = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE post_id = '$ad_id' AND  meta_key like  '_adforest_bid_%' ORDER BY meta_id DESC", OBJECT );
	return $biddings;

}
}

if ( ! function_exists( 'adforest_get_all_biddings_array' ) ) {
function adforest_get_all_biddings_array( $ad_id )
{
	global $wpdb;
	$biddings = $wpdb->get_results( "SELECT meta_value FROM $wpdb->postmeta WHERE post_id = '$ad_id' AND  meta_key like  '_adforest_bid_%' ORDER BY meta_id DESC", OBJECT  );
	$bid_array	=	array();
	if( count( $biddings ) > 0 )
	{
		foreach( $biddings as $bid )
		{
			// date - comment - user - offer
			$data_array	=	explode( '_separator_', $bid->meta_value );
			$bid_array[] = 	$data_array[3];
		}
	}

	return $bid_array;

}
}

if ( ! function_exists( 'adforest_bidding_html' ) ) {
function adforest_bidding_html($ad_id)
{
	global $adforest_theme;
	
	$curreny = $adforest_theme['sb_currency'];
	if( get_post_meta($ad_id, '_adforest_ad_currency', true ) != "" )
	{
		$curreny = get_post_meta($ad_id, '_adforest_ad_currency', true );
	}
	
	$biddings	=	adforest_get_all_biddings( $ad_id );
	global $wpdb;
	$html	=	'';
	if( count( $biddings ) > 0 )
	{
		foreach( $biddings as $bid )
		{
			// date - comment - user - offer
			$data_array	=	explode( '_separator_', $bid->meta_value );
			$date	=	$data_array[0];
			$comments	=	$data_array[1];
			$user	=	$data_array[2];
			$offer	=	'';
			$user_info = get_user_by( 'ID', $user );
			if( $user_info === false )
				continue;
				
			$current_user	=	get_current_user_id();
			$ad_owner	=	get_post_field( 'post_author', $ad_id );
			$cls	=	'';
			$admin_html	= '';
			if( $current_user == $ad_owner && get_post_meta($ad_id, '_adforest_poster_contact', true ) != "" )
			{
				$cls	=	'admin';
				$admin_html = '<div>'.get_post_meta($ad_id, '_adforest_poster_contact', true ).'</div>';	
			}
			
			$offer = 	$data_array[3];
			$thousands_sep = ",";
			if( isset( $adforest_theme['sb_price_separator'] ) )
			{
				$thousands_sep = $adforest_theme['sb_price_separator'];
			}
			$decimals = 0;
			if( isset( $adforest_theme['sb_price_decimals'] ) )
			{
				$decimals = $adforest_theme['sb_price_decimals'];
			}
			$decimals_separator = ".";
			if( isset( $adforest_theme['sb_price_decimals_separator'] ) )
			{
				$decimals_separator = $adforest_theme['sb_price_decimals_separator'];
			}
			// Price format
		$price  = number_format( (int)$offer, $decimals, $decimals_separator, $thousands_sep  );
		$price  = ( isset( $price ) && $price != "") ? $price : 0;	
		
		if( isset($adforest_theme['sb_price_direction']) && $adforest_theme['sb_price_direction'] == 'right' )
		{
			$price =  $price . $curreny;
		}	
		else if( isset($adforest_theme['sb_price_direction']) && $adforest_theme['sb_price_direction'] == 'left' )
		{
			$price =  $curreny . $price;
		}	
		else
		{
			$price =  $curreny . $price;	
		}
			
			
			$col	=	'8';
			$html .= '<div class="panel panel-default event" id="sb_bids">
                      <div class="panel-body"><div class="author col-xs-4 col-sm-2">
        <div class="profile-image"><a href="'.get_author_posts_url( $user_info->ID ).'?type=ads">
		<img src="'.adforest_get_user_dp($user_info->ID).'"/></a></div></div>
		<div class="info col-xs-'.esc_attr($col).' col-sm-'.esc_attr($col).'">
    <p class="no-margin-8"><strong>'.date(get_option('date_format'), strtotime($date)).'</strong></p>
      <p>'.esc_html($comments).' - <strong><a href="'.get_author_posts_url( $user_info->ID ).'?type=ads">'.$user_info->display_name.'</a></strong></p>
    </div>';
		$html .= '<div class="rsvp col-xs-12 col-sm-2">
      <i class="'.esc_attr($cls).'">'.$price.'</i>
	  '. $admin_html .'
    </div>';	
	$html .= '</div></div>';
		}
	}

	return $html;
	
}
}

if ( ! function_exists( 'adforest_bidding_stats' ) ) {
function adforest_bidding_stats($ad_id)
{
	global $adforest_theme;
	$html	=	'';
	$bids_res	=	adforest_get_all_biddings_array( $ad_id );
	$total_bids	=	count( $bids_res );
	$max	=	0;
	$min	=	0;
	if($total_bids > 0)
	{
		$max	=	max( $bids_res );	
		$min	=	min( $bids_res );	
	}
				$thousands_sep = ",";
			if( isset( $adforest_theme['sb_price_separator'] ) )
			{
				$thousands_sep = $adforest_theme['sb_price_separator'];
			}
			$decimals = 0;
			if( isset( $adforest_theme['sb_price_decimals'] ) )
			{
				$decimals = $adforest_theme['sb_price_decimals'];
			}
			$decimals_separator = ".";
			if( isset( $adforest_theme['sb_price_decimals_separator'] ) )
			{
				$decimals_separator = $adforest_theme['sb_price_decimals_separator'];
			}
			
		$curreny = $adforest_theme['sb_currency'];
		if( get_post_meta($ad_id, '_adforest_ad_currency', true ) != "" )
		{
			$curreny = get_post_meta($ad_id, '_adforest_ad_currency', true );
		}
			
		// Price format
		$max  = number_format( (int)$max, $decimals, $decimals_separator, $thousands_sep  );
		$min  = number_format( (int)$min, $decimals, $decimals_separator, $thousands_sep  );
		if( isset($adforest_theme['sb_price_direction']) && $adforest_theme['sb_price_direction'] == 'right' )
		{
			$max =  $max . '' . $curreny . '</small>';
			$min =  $min . '<small>' . $curreny . '</small>';
		}	
		else if( isset($adforest_theme['sb_price_direction']) && $adforest_theme['sb_price_direction'] == 'left' )
		{
			$max =  '<small>' . $curreny . '</small>' . $max;
			$min =  '<small>' . $curreny . '</small>' . $min;
		}	
		else
		{
			$max =  '<small>' . $curreny . '</small>' . $max;
			$min =  '<small>' . $curreny . '</small>' . $min;
		}
		if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
		{
			$html	=	'<div class="panel status panel-info">
				<div class="panel-heading">
					<h1 class="panel-title fancy ">'.__('Total Bids', 'adforest' ).':<strong><a href="#tab2default">'.esc_html( $total_bids ).'</a></strong></h1>
				</div>
			</div>
			<div class="panel status panel-success">
				<div class="panel-heading">
					<h1 class="panel-title fancy">'.__('Highest Bid', 'adforest' ).':<strong> <a href="#tab2default">'.$max.'</a></strong></h1>
				</div>
			</div>
			<div class="panel status panel-warning">
				<div class="panel-heading">
					<h1 class="panel-title fancy">'.__('Lowest Bid', 'adforest' ).': <strong><a href="#tab2default">'.$min.'</a></strong></h1>
				</div>
			</div>';
		}
		else
		{
          $html =	'<div class="bid-info">
                               <div class="descs-box  col-md-4 col-sm-4 col-xs-12">
                                <h4>'.__('Total Bids', 'adforest' ).'</h4>
                                <a href="#tab2default">'.esc_html( $total_bids ).'</a>
                               </div>
                               <div class="descs-box  col-md-4 col-sm-4 col-xs-12">
                                <h4>'.__('Highest', 'adforest' ).'</h4>
                                <a href="#tab2default">'.$max.'</a></div>
                               <div class="descs-box  col-md-4 col-sm-4 col-xs-12">
                                <h4>'. __('Lowest', 'adforest' ).'</h4>
                                <a href="#tab2default">'.$min.'</a>
                               </div>
                         </div>';
		}
						 
						 
						 return $html;
          
}
}

// phone verification
add_action('wp_ajax_sb_verification_system', 'adforest_verification_system');
if ( ! function_exists( 'adforest_verification_system' ) ) {
function adforest_verification_system()
{
	global $adforest_theme;
	$ph		=	sanitize_text_field($_POST['sb_phone_numer']);
	if(!preg_match("/\+[0-9]+$/", $ph)) {
		echo '0|' . __('Please update valid phone number +CountrycodePhonenumber in profile.','adforest');
		die();
	}

	$user_id	=	get_current_user_id();
	
	if( isset( $adforest_theme['sb_resend_code'] ) && $adforest_theme['sb_resend_code'] != "" && get_user_meta($user_id, '_ph_code_', true) != "" )
	{
		$timeFirst  = strtotime(get_user_meta($user_id, '_ph_code_date_', true));
		$timeSecond = strtotime(date('Y-m-d H:i:s'));
		$differenceInSeconds = $timeSecond - $timeFirst;
		$adforest_theme['sb_resend_code'] . "<" . $differenceInSeconds;
		if( $adforest_theme['sb_resend_code'] > $differenceInSeconds )
		{
			$after_seconds	=	$adforest_theme['sb_resend_code'] - $differenceInSeconds;
			echo '0|' . __( "You can't resend the verification code before", 'adforest' ) . " " . $after_seconds .'-' . __( "seconds.", 'adforest' );
			die();
		}
	}
	
	$code	=	mt_rand(100000, 500000);
	$res	=	adforest_send_sms($ph, $code);
	if( $res->sid )
	//if( true )
	{
		update_user_meta($user_id, '_ph_code_', $code);
		update_user_meta( $user_id, '_sb_is_ph_verified', '0' );
		update_user_meta( $user_id, '_ph_code_date_', date('Y-m-d H:i:s') );
		echo '1|' . __( "Verification code has been sent.", 'adforest' );
	}
	else
	{
		echo '0|' . __( "Server not responding.", 'adforest' );
		update_user_meta( $user_id, '_sb_is_ph_verified', '0' );
	}
	die();
}
}

if ( ! function_exists( 'adforest_send_sms' ) ) {
function adforest_send_sms($receiver_ph, $code)
{
	global $adforest_theme;
	$message	= __('Your verification code is','adforest') . " " . $code;
	$twl_data = get_option( 'twl_option' );
	
	$account_sid = $twl_data['account_sid'];
	$auth_token = $twl_data['auth_token'];
	$twilio_phone_number = $twl_data['number_from'];
	
	$client = new Twilio\Rest\Client( $account_sid, $auth_token );
	$response	= $client->messages->create(
	$receiver_ph,
	array(
		"from" => $twilio_phone_number,
		"body" => $message
	)
	);
	return $response;
}
}
add_action('wp_ajax_sb_verification_code', 'adforest_verification_code');
if ( ! function_exists( 'adforest_verification_code' ) ) {
function adforest_verification_code()
{
	$code		=	$_POST['sb_code'];
	$user_id	=	get_current_user_id();
	$saved	=	get_user_meta($user_id, '_ph_code_', true);
	if( $saved == "" )
	{
		echo '0|' . __( "Code not found in DB", 'adforest' );	
	}
	
	if( $code == $saved )
	{
		update_user_meta($user_id, '_ph_code_', '');
		update_user_meta( $user_id, '_sb_is_ph_verified', '1' );
		update_user_meta( $user_id, '_ph_code_date_', '' );
		echo '1|' . __( "Phone number has been verified", 'adforest' );
	}
	else
	{
		echo '0|' . __( "Invalid code that you entered", 'adforest' );
	}
	
	die();
}
}
