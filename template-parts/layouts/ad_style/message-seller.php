<?php 	
$pid	=	get_the_ID();
$poster_id	=	get_post_field( 'post_author', $pid );
global $adforest_theme;
?>
<div class="modal fade price-quote" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&#10005;</span><span class="sr-only">Close</span></button>
                  <h3 class="modal-title" id="lineModalLabel"><?php the_title(); ?></h3>
               </div>
               <div class="modal-body">
                  <!-- content goes here -->
                  <?php
				  	$user_info	=	get_userdata( get_current_user_id() );
				  ?>
                  <form id="send_message_pop">
                     <div class="form-group  col-md-12  col-sm-12">
                        <label><?php echo __('Your Name', 'adforest' ); ?></label>
                        <input type="text" name="name" readonly class="form-control" value="<?php echo esc_attr( $user_info->display_name ); ?>"> 
                     </div>
                     <div class="form-group  col-md-12  col-sm-12">
                        <label><?php echo __('Email Address', 'adforest' ); ?></label>
                        <input type="email" name="email" readonly class="form-control" value="<?php echo esc_attr( $user_info->user_email ); ?>"> 
                     </div>
                     <div class="form-group  col-md-12  col-sm-12">
                        <label><?php echo __('Message', 'adforest' ); ?></label>
                        <textarea id="sb_forest_message" name="message" placeholder="<?php echo __('Type here...', 'adforest' ); ?>" rows="3" class="form-control" data-parsley-required="true" data-parsley-error-message="<?php echo __( 'This field is required.', 'adforest' ); ?>"></textarea>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-12  col-sm-12 margin-bottom-20 margin-top-20">
                     	<input type="hidden" name="ad_post_id" value="<?php echo esc_attr($pid); ?>" />
                     	<input type="hidden" name="usr_id" value="<?php echo get_current_user_id(); ?>" />
                        <input type="hidden" name="msg_receiver_id" value="<?php echo esc_attr( $poster_id ); ?>" />
                        <button type="submit" id="send_ad_message" class="btn btn-theme btn-block"><?php echo __('Submit', 'adforest' ); ?></button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>