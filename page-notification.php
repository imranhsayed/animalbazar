<?php
 /* Template Name: Notification */ 
/**
 * The template for displaying Pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Adforest
 */

?>
<?php get_header(); ?>
<?php global $adforest_theme; ?>
<div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
        <section class="section-padding notification-history">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul>
                    <?php
						$user_id	=	get_current_user_id();
						$user_info	=	get_userdata( $user_id );
						global $wpdb;
						$unread_msgs = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->commentmeta WHERE comment_id = '$user_id' AND meta_value = '0' " );
						
							$msg_count	=	$unread_msgs;
					?>
                            <li>
                                <div class="drop-title">
                                <?php echo __( 'You have', 'adforest' ) . " <span class='msgs_count'>" . $unread_msgs . "</span> "  . __( 'new notification(s)', 'adforest' ); ?>
                                </div>
                            </li>
                             <li>
                                <div class="message-center">
				<?php if( $unread_msgs > 0 ) { 
                    $notes = $wpdb->get_results( "SELECT * FROM $wpdb->commentmeta WHERE comment_id = '$user_id' AND  meta_value = 0 ORDER BY meta_id DESC", OBJECT );
                    
                    if( count( $notes ) > 0 )
                    {
                    ?>
                           
								<?php
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
									?> 
								 <a href="<?php echo esc_url( $action ); ?>">
							<div class="user-img"> <img src="<?php echo esc_url( $user_pic ); ?>" alt="<?php echo( $user_data->display_name); ?>" width="30" height="50" > </div>
							<div class="mail-contnet">
								<h5><?php echo($user_data->display_name) ?></h5> <span class="mail-desc"><?php echo get_the_title( $ad_id ); ?></span></div>
						</a>
									<?php
									}
								?>
                     
                    <?php
					}
					}
					?>
                                  
                                </div>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                  </div>
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
      </div>
<!--footer section-->
<?php get_footer(); ?>