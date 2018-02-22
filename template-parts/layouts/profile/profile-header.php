<?php
global $adforest_theme;
$border_cls	=	'';
if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
	$border_cls	=	'';
?>
 <div class="col-md-12 col-xs-12 col-sm-12">
                    <section class="search-result-item <?php echo esc_attr($border_cls); ?>">
                               <div class="image-link" href="javascript:void(0);">
                               <img class="image" alt="<?php echo __('Profile Picture','adforest'); ?>" src="<?php echo esc_attr($user_pic); ?>" id="user_dp">
                               <?php
									$profile_html	=	'<ul class="social-f">';
									$profiles	=	adforest_social_profiles();
									foreach( $profiles as $key => $value )
									{
										if( get_user_meta( $author->ID, '_sb_profile_' . $key, true ) != "" )
										{
										$profile_html .= '<li><a href="'.esc_url( get_user_meta( $author->ID, '_sb_profile_' . $key, true ) ).'" class="fa fa-'.$key.'" target="_blank"></a></li>';
										}
									}
									$profile_html	.=	'</ul>';
									echo( $profile_html );
							   ?>
                               </div>
                               <div class="search-result-item-body">
                                  <div class="row">
                                     <div class="col-md-5 col-sm-12 col-xs-12">
                                        
                                        <h4 class="search-result-item-heading sb_put_user_name"><?php echo esc_html($author->display_name); ?></h4>
                                        <p class="info sb_put_user_address"><?php echo get_user_meta($author->ID, '_sb_address', true ); ?></p>
                                        <p class="description"><?php echo __('Logged in at', 'adforest') . ': '.adforest_get_last_login( $author->ID ). ' ' . __('Ago','adforest'); ?></p>
                                        <?php
                                        if( get_user_meta($author->ID, '_sb_badge_type', true ) != "" && get_user_meta($author->ID, '_sb_badge_text', true ) != "" && isset( $adforest_theme['sb_enable_user_badge'] ) && $adforest_theme['sb_enable_user_badge'] && $adforest_theme['sb_enable_user_badge'] && isset( $adforest_theme['user_public_profile'] ) && $adforest_theme['user_public_profile'] != "" && $adforest_theme['user_public_profile'] == "modern" )
										{
										?>
                                        <span class="label <?php echo get_user_meta($author->ID, '_sb_badge_type', true ); ?>">
										<?php echo get_user_meta($author->ID, '_sb_badge_text', true ); ?>
                                        </span>
                                        <?php
										}
										
										$user_type = '';
										if( get_user_meta( $author->ID, '_sb_user_type', true ) == 'Indiviual' )
										{
											$user_type = __('Individual', 'adforest');
										}
										else if( get_user_meta( $author->ID, '_sb_user_type', true ) == 'Dealer' )
										{
											$user_type = __('Dealer', 'adforest');	
										}
										if( $user_type != "" )
										{
										?>
                                        &nbsp;
                                        <span class="label label-success sb_user_type">
                                        
										<?php echo $user_type; ?>
                                        </span>
                                        <?php
										}
										?>
                                        <p></p>
                                        <?php
                                        if( isset( $adforest_theme['user_public_profile'] ) && $adforest_theme['user_public_profile'] != "" && $adforest_theme['user_public_profile'] == "modern" && isset($adforest_theme['sb_enable_user_ratting']) && $adforest_theme['sb_enable_user_ratting'] )
										{
											
										?>
                                        <a href="<?php echo get_author_posts_url( $author->ID ); ?>?type=1">
                                        <div class="rating">
                                    <?php
									$got	=	get_user_meta($author->ID, "_adforest_rating_avg", true );
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
										   if( get_user_meta($author->ID, "_adforest_rating_count", true ) != "" )
										   		echo get_user_meta($author->ID, "_adforest_rating_count", true ); 
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
                                     <div class="col-md-7 col-sm-12 col-xs-12">
                                      <div class="row ad-history">
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                    
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="user-stats">
                                                    <h2><?php echo adforest_get_sold_ads( $author->ID ); ?></h2>
                                                    <small><?php echo __( 'Ad Sold', 'adforest' ); ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="user-stats">
                                                    <h2><?php echo adforest_get_all_ads( $author->ID ); ?></h2>
                                                    <small><?php echo __( 'Total Listings', 'adforest' ); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </section>
                </div>