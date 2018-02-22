<?php 
global $adforest_theme; 
$pid	=	get_the_ID();
$poster_id	=	get_post_field( 'post_author', $pid );
$user_pic	=	adforest_get_user_dp($poster_id);
$address	=	get_post_meta($pid, '_adforest_ad_location', true ); 
?>
<div class="main-content-area clearfix">
 <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
 <section class="section-padding error-page pattern-bgs gray ">
    <!-- Main Container -->
    <div class="container">
       <!-- Row -->
       <div class="row">
          <!-- Middle Content Area -->
          <div class="col-md-8 col-xs-12 col-sm-12">
             <!-- Single Ad -->
             <div class="singlepost-content">
             <?php
			 if( get_post_meta($pid, '_adforest_ad_status_', true ) != ""  && get_post_meta($pid, '_adforest_ad_status_', true ) != 'active' )
			 {
			?>
             <div role="alert" class="alert alert-info alert-dismissible <?php echo adforest_alert_type(); ?>">
<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
<strong><?php echo __('Info','adforest'); ?></strong> - 
<?php echo __('This ad has been','adforest') . " "; ?>
<?php echo adforest_ad_statues(get_post_meta($pid, '_adforest_ad_status_', true )); ?>.
             </div>
            <?php
			 }
			 
			get_template_part( 'template-parts/layouts/ad_style/feature', 'notification' );
			 ?>
         <!-- Title -->
              <?php get_template_part( 'template-parts/layouts/ad_style/title', 'box' ); ?>
               <!-- Listing Slider-->
                <?php get_template_part( 'template-parts/layouts/ad_style/slider', $adforest_theme['ad_slider_type'] ); ?>
                <!-- Share Ad  --> 
                <?php get_template_part( 'template-parts/layouts/ad_style/ad', 'tabs' ); ?>
                <div class="clearfix"></div>
                <div class="margin-bottom-20 margin-top-10">
                <?php echo "" . $adforest_theme['style_ad_720_1']; ?>
                </div>
                <!-- Short Description  --> 
                <?php get_template_part( 'template-parts/layouts/ad_style/ad', 'detail' ); ?>
                <div class="clearfix"></div>
                 <div class="margin-top-30 margin-bottom-30">
                 <?php echo "" . $adforest_theme['style_ad_720_2']; ?>
                 </div>
             </div>
             <!-- Single Ad End --> 
             <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
             <div class="row">
				<?php get_template_part( 'template-parts/layouts/ad_style/related', 'ads' ); ?>
            </div>
             <!-- =-=-=-=-=-=-= Latest Ads End =-=-=-=-=-=-= -->
          </div>
          <!-- Middle Content Area  End -->
          <!-- Right Sidebar -->
          <div class="col-md-4 col-xs-12 col-sm-12 ">
			<?php if ( is_active_sidebar( 'adforest_ad_sidebar_top' ) ) { ?>
            
            <?php dynamic_sidebar( 'adforest_ad_sidebar_top' ); ?>
            <?php } ?>
            
          
             <!-- Sidebar Widgets -->
             <div class="sidebar">
             <?php
			 	if( get_post_meta($pid, '_adforest_ad_status_', true ) == 'expired' )
				{
			 ?>
                <div class="ad-listing-price sold-out">
                   <p><?php echo adforest_ad_statues(get_post_meta($pid, '_adforest_ad_status_', true )); ?></p>
                </div>
             <?php
				}
			 	else if( get_post_meta($pid, '_adforest_ad_status_', true ) == 'sold' )
				{
			 ?>
                <div class="ad-listing-price sold-out">
                   <p><?php echo adforest_ad_statues(get_post_meta($pid, '_adforest_ad_status_', true )); ?></p>
                </div>
             <?php
				}
				else
				{
			?>
                <div class="contact white-bg">
       <?php
	   	if( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )
		{
	   ?>
                       <!-- Email Button trigger modal -->
                       <?php
					   if( get_current_user_id() == "" )
					   {
						?>
                      <a href="<?php echo get_the_permalink( $adforest_theme['sb_sign_in_page'] ); ?>"  class="btn-block btn-contact contactEmail padding-top-30"> <?php echo __( 'Message Seller', 'adforest' ); ?></a>
                       <?php
					   }
					   else
					   {
						?>
                       <button class="btn-block btn-contact contactEmail" data-toggle="modal" data-target=".price-quote" ><?php echo __( 'Message Seller', 'adforest' ); ?></button>
                       <?php
					   }
					   ?>
      <?php
		}
		if( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'phone' )
		{
		?>
                       <!-- Email Modal -->
                       <button class="btn-block btn-contact contactPhone number" data-last="<?php echo get_post_meta($pid, '_adforest_poster_contact', true ); ?>" ><span><?php echo __('Click to View', 'adforest' ); ?></span></button>
	  <?php
		}
	   ?>
                    </div>
			<?php 
			if( get_post_meta($pid, '_adforest_ad_price_type', true ) == "no_price"  || ( get_post_meta($pid, '_adforest_ad_price', true ) == "" && get_post_meta($pid, '_adforest_ad_price_type', true ) != "free" && get_post_meta($pid, '_adforest_ad_price_type', true ) != "on_call" ) )
			{
				
			}
			else
			{
				
			?>
                <div class="ad-listing-price">
                   <p>
                       <?php echo adforest_adPrice($pid, 'negotiable-single'); ?> 
                   </p>
                </div>
			<?php
            }
            ?>
				<?php
				}
				?>
		  <?php
			  if( isset( $adforest_theme['sb_enable_comments_offer'] ) && $adforest_theme['sb_enable_comments_offer'] && get_post_meta($pid, '_adforest_ad_status_', true ) != 'sold' && get_post_meta($pid, '_adforest_ad_status_', true ) != 'expired' && get_post_meta($pid, '_adforest_ad_price', true ) != "0" )
		{
			if( isset( $adforest_theme['sb_enable_comments_offer_user'] ) && $adforest_theme['sb_enable_comments_offer_user'] && get_post_meta($pid, '_adforest_ad_bidding', true ) == 1 )
			{
				echo adforest_bidding_stats( $pid );
			}
			else if( isset( $adforest_theme['sb_enable_comments_offer_user'] ) && $adforest_theme['sb_enable_comments_offer_user'] && get_post_meta($pid, '_adforest_ad_bidding', true ) == 0 )
			{
				
			}
			else
			{
				echo adforest_bidding_stats( $pid );
			}
		}
		?>
                <!-- User Info -->
                <div class="white-bg user-contact-info">
                   <div class="user-info-card">
                      <div class="user-photo col-md-4 col-sm-3  col-xs-4">
                        <a href="<?php echo get_author_posts_url( $poster_id ); ?>?type=ads" class="link">
                        	<img src="<?php echo esc_url( $user_pic ); ?>" alt="<?php echo __('Profile Pic', 'adforest' ); ?>">
                      	</a>
                      </div>
                      <div class="user-information no-padding col-md-8 col-sm-9 col-xs-8">
                      <?php
					  	$poster_name	=	get_post_meta($pid, '_adforest_poster_name', true );
					  	if( $poster_name == "" )
						{
							$user_info	=	get_userdata( $poster_id );
							$poster_name	=	$user_info->display_name;
						}
					  ?>
					  
                         <span class="user-name">
                         <a class="hover-color" href="<?php echo get_author_posts_url( $poster_id ); ?>?type=ads">
                         <?php echo esc_html($poster_name); ?>
                         </a>
                         </span>
                         <div class="item-date">
                            <p class="description"><?php echo __('Logged in at', 'adforest') . ': '.adforest_get_last_login( $poster_id ). ' ' . __('Ago','adforest'); ?></p>
									<?php
                                        if( isset( $adforest_theme['user_public_profile'] ) && $adforest_theme['user_public_profile'] != "" && $adforest_theme['user_public_profile'] == "modern" && isset($adforest_theme['sb_enable_user_ratting']) && $adforest_theme['sb_enable_user_ratting'] )
										{
											
										?>
                                        <a href="<?php echo get_author_posts_url( $poster_id ); ?>?type=1">
                                        <div class="rating">
                                    <?php
									$got	=	get_user_meta($poster_id, "_adforest_rating_avg", true );
									if( $got == "" )
										$got = 0;
										for( $i = 1; $i<=5; $i++ )
										{
											if( $i <= round( $got ) )
												echo '<i class="fa fa-star"></i>';
											else
												echo '<i class="fa fa-star-o"></i>';	
										}
									?>
                                           <span class="rating-count">
                                           (<?php 
										   if( get_user_meta($poster_id, "_adforest_rating_count", true ) != "" )
										   		echo get_user_meta($poster_id, "_adforest_rating_count", true ); 
											else
												echo 0;
										   ?>)
                                           </span>
                                        </div>
                                        </a>
                                       <?php
										}
									?>
                                                            <?php
						if( get_user_meta($poster_id, '_sb_badge_type', true ) != "" && get_user_meta($poster_id, '_sb_badge_text', true ) != "" && isset( $adforest_theme['sb_enable_user_badge'] ) && $adforest_theme['sb_enable_user_badge'] && $adforest_theme['sb_enable_user_badge'] && isset( $adforest_theme['user_public_profile'] ) && $adforest_theme['user_public_profile'] != "" && $adforest_theme['user_public_profile'] == "modern" )
						{
						?>
						<span class="label <?php echo get_user_meta($poster_id, '_sb_badge_type', true ); ?>">
						<?php echo get_user_meta($poster_id, '_sb_badge_text', true ); ?>
						</span>
						<?php
						}
						?>
                         </div>
                      </div>
                      <div class="clearfix"></div>
                   </div>
                   <div class="ad-listing-meta">
                      <ul>
                         <li><?php echo __('Ad Id', 'adforest' ); ?>: <span class="color"><?php echo get_the_ID(); ?></span></li>
                         <li><?php echo __('Visits', 'adforest'); ?>: <span class="color"><?php echo adforest_getPostViews( $pid ); ?></span></li>
                         <?php if( $address != "" ) { ?>
                         <li><?php echo esc_html( $address ); ?></li>
                         <?php } ?>
                      </ul>
                   </div>
                   <?php
					// Getting lat lon
					$map_lat	=	get_post_meta($pid, '_adforest_ad_map_lat', true ); 
					$map_long	=	get_post_meta($pid, '_adforest_ad_map_long', true );
					if( $map_lat != "" && $map_long != "" )
					{
					?>
                        <div id="itemMap" style="width: 100%; height: 370px; margin-bottom:5px;"></div>
                        <input type="hidden" id="lat" value="<?php echo esc_attr( $map_lat ); ?>" />
                        <input type="hidden" id="lon" value="<?php echo esc_attr( $map_long ); ?>" />
                        </div>
                    <?php
					}
					else
					{
						$res_arr	=	adforest_get_latlon ( $address );
						if(isset( $res_arr ) && count( $res_arr ) > 0 )
						{
				   ?>
                            <div id="itemMap" style="width: 100%; height: 370px; margin-bottom:5px;"></div>
                            <input type="hidden" id="lat" value="<?php echo esc_attr( $res_arr[0] ); ?>" />
                            <input type="hidden" id="lon" value="<?php echo esc_attr( $res_arr[1] ); ?>" />
                <?php
						}
					}
				?>
                <!-- Saftey Tips  -->
                <?php
				if( $adforest_theme['tips_title'] != '' &&  $adforest_theme['tips_for_ad'] != "" )
				{
				?>
                <div class="widget">
                   <div class="widget-heading">
                      <h4 class="panel-title"><a><?php echo($adforest_theme['tips_title']); ?></a></h4>
                   </div>
                   <div class="widget-content saftey">
					<?php echo($adforest_theme['tips_for_ad']); ?>
                   </div>
                </div>
                <?php
				}
				?>
				<?php if ( is_active_sidebar( 'adforest_ad_sidebar_bottom' ) ) { ?>
                <br />
                <?php dynamic_sidebar( 'adforest_ad_sidebar_bottom' ); ?>
				<?php } ?>
             </div>
             </div>
             </div>
       </div>

    <!-- Main Container End -->
 </section>
 <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
</div>
      <!-- =-=-=-=-=-=-= Ad Detail Modal =-=-=-=-=-=-= -->
      <?php get_template_part( 'template-parts/layouts/ad_style/sticky', 'details' ); ?>
      <?php get_template_part( 'template-parts/layouts/ad_style/message', 'seller' ); ?>