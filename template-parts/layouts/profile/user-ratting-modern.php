<?php global $adforest_theme; 
if( isset($adforest_theme['sb_enable_user_ratting']) && !$adforest_theme['sb_enable_user_ratting'] )
{
	return;	
}
	$author_id = get_query_var( 'author' );
	$author = get_user_by( 'ID', $author_id );
	$user_pic =	adforest_get_user_dp( $author_id, 'adforest-user-profile' );
?>
<div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
     <section class="section-padding gray">
        <!-- Main Container -->
        <div class="container">
        
        <div class="row">
        		
               <?php
			   require trailingslashit( get_template_directory () ) . 'template-parts/layouts/profile/profile-header.php'; 
			   ?>
               		<div class="col-md-12 margin-top-30"></div>
               
					<div class="col-md-6">
                
                <div class="heading-panel">
                      <h3 class="main-title text-left">
                        <?php echo __('Rating', 'adforest' ); ?>
                        </h3>
                   </div>
                
                <form id="user_ratting_form" novalidate>
                         <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                  <label><?php echo __('Rating', 'adforest' ); ?> <span class="required">*</span>
                                  </label>
                                  <select name="sb_rate_user" id="sb_rate_user" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5" selected>5</option>
                                </select>
                               </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                               <div class="form-group">
                                  <label><?php echo __('Comments', 'adforest' ); ?> <span class="required">*</span>
                                  </label>
                                  <textarea class="form-control" placeholder="" rows="8" cols="6" id="sb_rate_user_comments" name="sb_rate_user_comments" data-parsley-required="true" data-parsley-error-message="<?php echo __( 'This field is required.', 'adforest' ); ?>"></textarea>
                                  <div><small><?php echo __('You can not edit it later.','adforest'); ?></small></div>
                               </div>
                            </div>
                            <div class="col-md-12 col-sm-12 margin-top-20 clearfix">
                       <button type="submit" class="btn btn-theme"><?php echo __('Post Your Comment', 'adforest' ); ?></button>
                        <input type="hidden" name="author" value="<?php echo esc_attr( $author_id ); ?>" />
                            </div>
                         </div>
                      </form>
                
                
                	</div>
                    <div class="col-md-6">
                    
                    
                    <?php $ratings 	=	adforest_get_all_ratings($author_id); ?>
                    <div class="heading-panel">
                      <h3 class="main-title text-left">
                         <?php echo __('Total Rating', 'adforest' ); ?> (<?php echo count( $ratings ); ?>)
                      </h3>
                   </div>
                
                	<?php
					if( count( $ratings ) > 0 )
					{
					?>
                    <div class="rating_comments">
                        <ol class="comment-list">
					<?php
					foreach( $ratings as $rating )
					{
						$data	=	explode( '_separator_', $rating->meta_value );
						$rated	=	$data[0];
						$comments	=	$data[1];
						$date	=	$data[2];
						$reply	=	'';
						$reply_date	=	'';
						if( isset( $data[3] ) )
						{
							$reply	=	$data[3];	
						}
						if( isset( $data[4] ) )
						{
							$reply_date	=	$data[4];	
						}
						$_arr	=	explode( '_user_', $rating->meta_key );
						$rator	=	$_arr[1];
						$user = get_user_by( 'ID', $rator );
					?>
                        <li class="comment">
                                                 <div class="comment-info">
                                                    <img class="pull-left hidden-xs img-circle" src="<?php echo adforest_get_user_dp( $rator, 'adforest-user-profile' ); ?>" alt="<?php echo esc_attr( $user->display_name ); ?>">
                                                    <div class="author-desc">
                                                       <div class="author-title">
                                                          <strong><?php echo esc_html( $user->display_name ); ?></strong>
                                                          <br /><br />
                                                            <div class="rating">
                                                            <?php
                                                                for( $i = 1; $i<=5; $i++ )
                                                                {
                                                                    if( $i <= $rated )
                                                                        echo '<i class="fa fa-star"></i>';
                                                                    else
                                                                        echo '<i class="fa fa-star-o"></i>';	
                                                                }
                                                            ?>
                                                            </div>
                                                          <ul class="list-inline pull-right">
                                                             <li>
                                                             <a href="javascript:void(0);">
                                                             <?php echo date_i18n(get_option('date_format'), strtotime($date)); ?>
                                                             </a>
                                                             </li>
                                                             <?php
                                                             if( $author_id == get_current_user_id() && $reply == "" )
                                                             {
                                                             ?>
                                                             <li>
                                                             <a href="javascript:void(0);" data-rator-id="<?php echo esc_attr( $rator ); ?>" data-rator-name="<?php echo esc_attr( $user->display_name ); ?>" class="clikc_reply" data-target="#rating_reply_modal" data-toggle="modal">
                                                             <i class="fa fa-reply"></i> 
                                                             <?php echo __('Reply', 'adforest' ); ?>
                                                             </a>
                                                             </li>
                                                             <?php
                                                             }
                                                             ?>
                                                          </ul>
                                                       </div>
                                                       <p><?php echo esc_html( $comments ); ?></p>
                                                    </div>
                                                 </div>
                                             <?php
                                                if( $reply != "" )
                                                {
                                                    $user = get_user_by( 'ID', $author_id );
                                             ?>
                                                <ol class="children">
                                                            <li class="comment">
                                                               <div class="comment-info">
                                                                   <img class="pull-left hidden-xs img-circle" src="<?php echo adforest_get_user_dp( $user->ID, 'adforest-user-profile' ); ?>" alt="<?php echo esc_attr( $user->display_name ); ?>">
                                                                  <div class="author-desc">
                                                                     <div class="author-title">
                                                                        <strong><?php echo esc_html( $user->display_name ); ?></strong>
                                                                        <ul class="list-inline pull-right">
                                                                           <li>
                                                                             <a href="javascript:void(0);">
                                                                             <?php echo date_i18n(get_option('date_format'), strtotime($reply_date)); ?>
                                                                             </a>
                                                                         </li>
                                                                        </ul>
                                                                     </div>
                                                                    <p><?php echo esc_html( $reply ); ?></p>
                                                                  </div>
                                                               </div>
                                                               <!-- .comment-info -->
                                                            </li>
                                                         </ol>
                                            <?php
                                                }
                                            ?>
                                              </li>
                    <?php
					}
					?>
                      </ol>
                    </div>
                	<?php
					}
					else
					{
					?>
                    <br />
						<h3><?php echo __( 'Be the first to rate this user.','adforest' ); ?></h3>
					<?php
					}
					?>
                
                </div>
                
                 
               </div>
        
    </div>
        <!-- Main Container End -->
     </section>
     <div id="rating_reply_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header rte">
                     <h2 class="modal-title"><?php echo __( 'Reply to', 'adforest' ); ?>&nbsp;<span id="rator_name"></span></h2> 
                  </div>
					<form id="sb-reply-rating-form">
				 <div class="modal-body">
					<div class="form-group">
					  <label><?php echo __('Comments', 'adforest' ); ?> <span class="required">*</span>
                                  </label>
                                  <textarea class="form-control" placeholder="" rows="8" cols="6" id="sb_rate_user_comments" name="sb_rate_user_comments" data-parsley-required="true" data-parsley-error-message="<?php echo __( 'This field is required.', 'adforest' ); ?>"></textarea>
                                  <div><small><?php echo __('You can not edit it later.','adforest'); ?></small></div>
                      <br />
					   <button class="btn btn-theme btn-sm" type="submit">
					   	<?php echo __('Post Your Reply', 'adforest' ); ?>
                       </button>
                       <input type="hidden" id="rator_reply" name="rator_reply" value="0" />
                                  
					</div>
				 </div>
		  </form>
               </div>
            </div>
         </div>
</div>