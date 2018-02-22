<?php 
global $adforest_theme; 
$pid	=	get_the_ID();
$poster_id	=	get_post_field( 'post_author', $pid );
$user_pic	=	adforest_get_user_dp($poster_id);
$address	=	get_post_meta($pid, '_adforest_ad_location', true ); 
$type = $adforest_theme['cat_and_location'];
?>
<div class="main-content-area clearfix">
     <section class="section-padding modern-version">
        <div class="container">
        <?php get_template_part( 'template-parts/layouts/ad_style/rearrange', 'notification' ); ?>
           <!-- Row -->
           <div class="row">
              <!-- Middle Content Area -->
              <div class="col-md-8 col-xs-12 col-sm-12">
              
                 <!-- Single Ad -->
                 <div class="singlepost-content ">
                 <div class="descs-box">
				  <?php
                        $post_categories = wp_get_object_terms( $pid,  array('ad_cats'), array('orderby' => 'term_group') );
                        foreach($post_categories as $c)
                        {
                           $cat = get_term( $c );
							if($type == 'search')
							{
								$link = get_the_permalink($adforest_theme['sb_search_page']).'?cat_id='.$cat->term_id;
							}
							else
							{
								$link = get_term_link( $cat->term_id );	
							}
                     ?>
                     <a class="modern-version-block-cat" href="<?php echo esc_url($link); ?>"><?php echo esc_html( $cat->name ); ?> </a>
                 <?php
                         }
                 ?>
                   <h1><?php the_title(); ?></h1>
				 <?php
				   if( get_post_meta($pid, '_adforest_ad_status_', true ) != ""  && get_post_meta($pid, '_adforest_ad_status_', true ) == 'active' )
				   {
				  ?>
				  <div class="new-price-tag">
				  <?php 
							if( get_post_meta($pid, '_adforest_ad_price_type', true ) == "no_price"  || ( get_post_meta($pid, '_adforest_ad_price', true ) == "" && get_post_meta($pid, '_adforest_ad_price_type', true ) != "free" && get_post_meta($pid, '_adforest_ad_price_type', true ) != "on_call" ) )
							{
								
							}
							else
							{
								
							?>
								<h3><?php echo adforest_adPrice($pid, 'negotiable-single'); ?></h3>
							<?php
							}
							?>
					
				  </div>
				  <?php
				   }
				   ?>                       
				<?php
                $flip = '';
                if ( is_rtl() )
                {
					$flip = 'flip';
				}
                ?>
                       <div class="modern-version-block-info">
                            <div class="pull-left <?php echo esc_attr( $flip ); ?> post-author">
                                <?php echo __('Posted', 'adforest'); ?>
                                <a href="javascript:void(0);"><?php echo get_the_date(); ?></a>
                                <span class="spliator">&#45;</span>
                                <?php echo __('Views', 'adforest'); ?>
                                <a href="javascript:void(0);"><?php echo adforest_getPostViews( $pid ); ?></a>
                                                 <?php
										 $my_url = adforest_get_current_url();
											if (strpos($my_url, 'adforest.scriptsbundle.com') !== false) {
												
											}
											else
											{
											if( get_post_field( 'post_author', $pid ) == get_current_user_id() || is_super_admin( get_current_user_id() ) )
											{
										 ?>
										 <span class="spliator"> &#45; </span>
                                         <a href="<?php echo get_the_permalink( $adforest_theme['sb_post_ad_page'] ); ?>?id=<?php echo esc_attr( $pid );  ?>"><?php echo __('Edit', 'adforest'); ?></a>
										 <?php
											}
											}
										?>
                            </div>
                       </div>
                       </div>
				<?php
					get_template_part( 'template-parts/layouts/ad_style/ad', 'status' );
					get_template_part( 'template-parts/layouts/ad_style/feature', 'notification' );
				?>
                
				<?php
				$f_class	=	'';
				if( get_post_meta( $pid, '_adforest_is_feature', true ) == '1' && get_post_meta($pid, '_adforest_ad_status_', true ) == 'active' )
				{
					$ribbion = 'featured-ribbon';
					if ( is_rtl() ) 
					{
						$ribbion = 'featured-ribbon-rtl';
					}
				
					echo '<div class="'.esc_attr( $ribbion ).'">
					<span>'.__('Featured','adforest').'</span>
					</div>';
					$f_class = 'featured-border';
				}
				?>
				
                    
                    <?php get_template_part( 'template-parts/layouts/ad_style/slider', $adforest_theme['ad_slider_type'] ); ?>
                    <?php get_template_part( 'template-parts/layouts/ad_style/desc', 'box' ); ?>
                                               
                   <div class="clearfix"></div>
                 </div>
                 <!-- Single Ad End --> 
              </div>
              <!-- Right Sidebar -->
              <div class="col-md-4 col-xs-12 col-sm-12">
                 <!-- Sidebar Widgets -->
                 <div class="sidebar">
                
                 
			  <?php if ( is_active_sidebar( 'adforest_ad_sidebar_top' ) ) { ?>
				<?php dynamic_sidebar( 'adforest_ad_sidebar_top' ); ?>
			<?php } ?>
				<?php
                $poster_name	=	get_post_meta($pid, '_adforest_poster_name', true );
                if( $poster_name == "" )
                {
                    $user_info	=	get_userdata( $poster_id );
                    $poster_name	=	$user_info->display_name;
                }
                ?>
                 <div class="widget">
                       <div class="widget-heading">
                          <h4 class="panel-title">
                          <a href="<?php echo get_author_posts_url( $poster_id ); ?>?type=ads">
						  <?php echo __('Agent', 'adforest') . ": " .  esc_html($poster_name); ?>
                          </a>
                          </h4>
                       </div>
                       <div class="widget-content">
                         
                         
                         <div class="sidebar-user-info">
                            <div class="row">
                            
    
    <div class="media">
    	<a href="<?php echo get_author_posts_url( $poster_id ); ?>?type=ads" class="pull-left <?php echo esc_attr( $flip ); ?>"> 
            <img src="<?php echo esc_url( $user_pic ); ?>" width="80" height="80" alt="<?php echo __('Profile Pic', 'adforest' ); ?>">
        </a>
        <div class="media-body">
            <h4 class="media-heading"></h4>
            <?php
						if( get_user_meta($poster_id, '_sb_badge_type', true ) != "" && get_user_meta($poster_id, '_sb_badge_text', true ) != "" && isset( $adforest_theme['sb_enable_user_badge'] ) && $adforest_theme['sb_enable_user_badge'] && $adforest_theme['sb_enable_user_badge'] && isset( $adforest_theme['user_public_profile'] ) && $adforest_theme['user_public_profile'] != "" && $adforest_theme['user_public_profile'] == "modern" )
						{
						?>
						<span class="label <?php echo get_user_meta($poster_id, '_sb_badge_type', true ); ?>">
						<?php echo get_user_meta($poster_id, '_sb_badge_text', true ); ?>
						</span>
                        &nbsp;
						<?php
						}
						?>
            <p>
				<?php echo __('Logged in at', 'adforest') . ': '.adforest_get_last_login( $poster_id ). ' ' . __('Ago','adforest'); ?>
            </p>
          
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
        </div>
    </div>
    
    
                            </div>
                        </div>
                
                <div class="sidebar-user-link">
   <?php
   if( get_post_meta($pid, '_adforest_ad_status_', true ) != ""  && get_post_meta($pid, '_adforest_ad_status_', true ) == 'active' )
   {
		if( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'phone' )
		{
			$call_now	= 'javascript:void(0);';
			if ( wp_is_mobile() )
				$call_now	= 'tel:' . get_post_meta($pid, '_adforest_poster_contact', true );
				
				$contact_num	= get_post_meta($pid, '_adforest_poster_contact', true );
				$tool_tip	=	'';
				$is_verification_on = false;
				$batch_src	=	'';
				$cls	= 'btn-phone';
				if( isset($adforest_theme['sb_phone_verification'] ) && $adforest_theme['sb_phone_verification'] )
				{
					$is_verification_on	=	true;
					$contact_num	= get_user_meta( $poster_id, '_sb_contact', true );
					if( $contact_num != "" )
					{
						if( get_user_meta( $poster_id, '_sb_is_ph_verified', true ) == '1' )
						{
							$tool_tip = 'data-toggle="tooltip" data-placement="top" data-original-title="'. __('Verified', 'adforest' ) . '"';
							$batch_src	=	trailingslashit( get_template_directory_uri () ) . 'images/verified.png';
							$cls	= 'btn-phone';
						}
						else
						{
							$tool_tip = 'data-toggle="tooltip" data-placement="top" data-original-title="'. __('Not verified', 'adforest' ) . '"';
							$batch_src	=	trailingslashit( get_template_directory_uri () ) . 'images/not-verified.png';
							$cls	= 'btn-warning';
						}
					}
					else
					{
						$contact_num	=	get_post_meta($pid, '_adforest_poster_contact', true );
						$tool_tip = 'data-toggle="tooltip" data-placement="top" data-original-title="'. __('Not verified', 'adforest' ) . '"';
						$batch_src	=	trailingslashit( get_template_directory_uri () ) . 'images/not-verified.png';
						$cls	= 'btn-warning';
					} 
				}
		?>
            <!--<div class="or"></div>-->
          <a href="<?php echo($call_now); ?>" class="btn btn-block <?php echo esc_attr( $cls ); ?>" role="button" id="show_ph_num" data-ph-num="<?php echo esc_attr( $contact_num );  ?>" <?php echo($tool_tip); ?>>
          <?php
		  if( !$is_verification_on )
		  {
		  ?>
              <i class="fa fa-phone"></i> 
          <?php
		  }
		  ?>
			  <span>
		  <?php
		  if( $is_verification_on )
		  {
		  ?>
              <img src="<?php echo($batch_src); ?>">
          <?php
		  }
		  ?>
			  <?php echo __('Click to show phone number', 'adforest'); ?>
              </span>
          </a>
  		<?php
		}
	   	if( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )
		{
		   if( get_current_user_id() == "" )
		   {
			   ?>

            <a href="<?php echo get_the_permalink( $adforest_theme['sb_sign_in_page'] ); ?>" class="btn btn-message btn-block" role="button" >
                    <i class="fa fa-envelope-o"> <span class="text-muted"><?php echo __('Message Seller', 'adforest'); ?></span></i>
            </a>
               <?php
		   }
		   else
		   {
		   
   ?>
            <a href="javascript:void(0);" class="btn btn-message btn-block" role="button" data-toggle="modal" data-target=".price-quote" >
                <span class="glyphicon glyphicon-floppy-disk"></span><?php echo __('Message Seller', 'adforest'); ?>
            </a>
		<?php
		   }
		}
   }
	else if( get_post_meta($pid, '_adforest_ad_status_', true ) != "" )
	{
	   ?>
       <a class="btn btn-block btn-danger "><?php echo adforest_ad_statues(get_post_meta($pid, '_adforest_ad_status_', true )); ?></a>
       <?php
	}
	else
	{
			update_post_meta( $pid, '_adforest_ad_status_', 'active' );
	}
		?>                    
                    
                <ul class="ad-action-list">
                    <li>
                        <a href="javascript:void(0);" id="ad_to_fav" data-adid="<?php echo get_the_ID(); ?>">
                            <i class="fa fa-star"></i> <?php echo __('Save ad as favorite','adforest'); ?>
                        </a>
                    </li>
			<?php
                if( isset( $adforest_theme['share_ads_on'] ) && $adforest_theme['share_ads_on'] )
                {
            ?>
                    <li>
                        <a data-toggle="modal" data-target=".share-ad">
                            <i class="fa fa-share-alt"></i> <?php echo __('Share this ad','adforest'); ?>
                        </a>
                    </li>
			<?php
                get_template_part( 'template-parts/layouts/ad_style/share', 'ad' );
                }
            ?>

                    <li>
                        <a data-target=".report-quote" data-toggle="modal">
                            <i class="fa fa-warning"></i> <?php echo __('Report this ad','adforest'); ?>
                        </a>
                    </li>
                </ul>
    
                </div>
                         
                         
                       </div>
                    </div>
                    
                     <?php if( isset( $adforest_theme['sb_custom_location'] ) && $adforest_theme['sb_custom_location']!="" && count(wp_get_post_terms($pid, 'ad_country') ) > 0 )
					 {
					 ?>
                      <div class="country-locations">
                                <img src="<?php echo trailingslashit( get_template_directory_uri () ) .'images/earth-globe.png';?>" alt="" >
                                <div class="class-name"><div id="word-count"><?php echo adforest_display_adLocation($pid); ?></div></div>
                             </div>
                             <div class="clearfix"></div>
            		<?php 
					}
					?>
                    
                    <?php
						get_template_part( 'template-parts/layouts/ad_style/report', 'ad' );
					?>
                 
                <?php
				
			  if( isset( $adforest_theme['sb_enable_comments_offer'] ) && $adforest_theme['sb_enable_comments_offer'] && get_post_meta($pid, '_adforest_ad_status_', true ) != 'sold' && get_post_meta($pid, '_adforest_ad_status_', true ) != 'expired' && get_post_meta($pid, '_adforest_ad_price', true ) != "0" )
		{
			if( isset( $adforest_theme['sb_enable_comments_offer_user'] ) && $adforest_theme['sb_enable_comments_offer_user'] && get_post_meta($pid, '_adforest_ad_bidding', true ) == 1 )
			{
				echo '<div class="widget">
                   <div class="widget-heading">
                      <h4 class="panel-title"><a>'. __('Bidding Stats','adforest').'</a></h4>
                   </div>
                   <div class="widget-content saftey">';
				echo adforest_bidding_stats( $pid );
				echo '</div></div>';
			}
			else if( isset( $adforest_theme['sb_enable_comments_offer_user'] ) && $adforest_theme['sb_enable_comments_offer_user'] && get_post_meta($pid, '_adforest_ad_bidding', true ) == 0 )
			{
				
			}
			else
			{
				echo '<div class="widget">
                   <div class="widget-heading">
                      <h4 class="panel-title"><a>'. __('Bidding Stats','adforest').'</a></h4>
                   </div>
                   <div class="widget-content saftey">';
				
				echo adforest_bidding_stats( $pid );
				echo '</div></div>';
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
                <?php dynamic_sidebar( 'adforest_ad_sidebar_bottom' ); ?>
				<?php } ?>

                 </div>
                 <!-- Sidebar Widgets End -->
              </div>
              <!-- Middle Content Area  End -->
           </div>
           <!-- Row End -->
                  <!-- Row End -->
       <div class="row">
       <?php get_template_part( 'template-parts/layouts/ad_style/related', 'ads' ); ?>
		</div>

        </div>
        <!-- Main Container End -->
     </section>
</div>
<?php 
get_template_part( 'template-parts/layouts/ad_style/message', 'seller' );
if( get_post_field( 'post_author', $pid ) == $poster_id && get_post_meta( $pid, '_adforest_ad_status_', true ) == 'active' )
{
get_template_part( 'template-parts/layouts/ad_style/sort', 'images' ); 
}
?>