<?php
// Password Reset Html	
if( isset( $_GET['token'] ) && $_GET['token'] != "" && !is_user_logged_in() )
{
?>
<input type="hidden" id="adforest_password_mismatch_msg"  value="<?php echo __( 'Password not matched.', 'adforest' ); ?>" />
<div id="sb_reset_password_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
       <!-- Modal content-->
       <div class="modal-content">
          <div class="modal-header rte">
             <h2 class="modal-title"><?php echo  __( 'Set your Password','adforest' ); ?></h2>
          </div>
          		<form id="sb-reset-password-form">
				 <div class="modal-body">
					<div class="form-group">
					  <label><?php echo __( 'New Password','adforest' ); ?></label>
					  <input placeholder="<?php echo  __( 'Enter Password','adforest' ); ?>" class="form-control" type="password" data-parsley-required="true" data-parsley-error-message="<?php echo __( 'This field this required.', 'adforest' ); ?>" data-parsley-trigger="change" name="sb_new_password" id="sb_new_password">
					</div>
					<div class="form-group">
					  <label><?php echo __( 'Confirm New Password','adforest' ); ?></label>
					  <input placeholder="<?php echo  __( 'Confirm Password','adforest' ); ?>" class="form-control" type="password" data-parsley-required="true" data-parsley-error-message="<?php echo __( 'This field this required.', 'adforest' ); ?>" data-parsley-trigger="change" name="sb_confirm_new_password" id="sb_confirm_new_password">
					</div>
                 </div>
				 <div class="modal-footer">
                 <br />
					   <button class="btn btn-theme btn-sm" type="submit" id="sb_reset_password_submit"><?php echo __( 'Change Password','adforest' ); ?></button>
					   <button class="btn btn-theme btn-sm" type="button" id="sb_reset_password_msg"><?php echo __( 'Processing...','adforest' ); ?></button>
                       <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>" />
					<br /><br />
				 </div>
		  </form>
          </div>
    </div>
 </div>
 <?php
}

// Email verificatioon	
if( isset( $_GET['verification_key'] ) && $_GET['verification_key'] != "" && !is_user_logged_in()  )
{
	$token	= $_GET['verification_key'];
	$token_arr	=	explode( '-sb-uid-', $token );
	$key	=	$token_arr[0];
	$uid	= 	$token_arr[1];
	$token_db	=	get_user_meta( $uid, 'sb_email_verification_token', true ); 
	if( $token_db != $key )
	{
		echo '<script>jQuery(document).ready(function($) { toastr.error("'.__( "Invalid security token.", 'adforest' ).'", "", {timeOut: 3500,"closeButton": true, "positionClass": "toast-top-right"}); });</script>';
	}
	else
	{
		echo '<script>jQuery(document).ready(function($) { toastr.success("'.__( "Your account has been verified.", 'adforest' ).'", "", {timeOut: 3500,"closeButton": true, "positionClass": "toast-top-right"}); });</script>';
		update_user_meta($uid, 'sb_email_verification_token', '');

	// Set the user's role (and implicitly remove the previous role).
	$user = new WP_User( $uid );
	$user->set_role( 'subscriber' );
	}
}