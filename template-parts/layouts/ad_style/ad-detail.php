<?php
global $adforest_theme; 
$pid	=	get_the_ID();
?>
<div class="descs-box">
 <?php get_template_part( 'template-parts/layouts/ad_style/status', 'watermark' ); ?>
<?php get_template_part( 'template-parts/layouts/ad_style/short', 'features' ); ?>
                   <div class="desc-points">
                      <?php the_content(); ?>
                   </div>
                   <?php if( get_post_meta($pid, '_adforest_ad_yvideo', true ) != "" ) {
					   
						preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', get_post_meta($pid, '_adforest_ad_yvideo', true ), $match);
		
						if( isset( $match[1] ) && $match[1] != "" )
						{
					    
							$video_id = $match[1];
					
				   ?>
                   <div class="heading-panel">
                         <h3 class="main-title text-left">
                            <?php echo __('Ad Video','adforest'); ?>
                         </h3>
                   </div>

                   <div>
                   		<?php 
							$iframe = 'iframe';
							echo '<'.$iframe.' width="560" height="450" src="https://www.youtube.com/embed/'. esc_attr( $video_id ) . '" frameborder="0" allowfullscreen></'.$iframe.'>'; 
					   ?>
                   </div>
                   <?php
					}
				   }
				   ?>
                   <hr />
                   <?php get_template_part( 'template-parts/layouts/ad_style/ad', 'tags' ); ?>
                   <div class="clearfix"></div>
                </div>
		<?php
       	if( isset( $adforest_theme['sb_enable_comments_offer'] ) && $adforest_theme['sb_enable_comments_offer'] && get_post_meta($pid, '_adforest_ad_status_', true ) != 'sold' && get_post_meta($pid, '_adforest_ad_status_', true ) != 'expired' && get_post_meta($pid, '_adforest_ad_price', true ) != "0" )
		{
			if( isset( $adforest_theme['sb_enable_comments_offer_user'] ) && $adforest_theme['sb_enable_comments_offer_user'] && get_post_meta($pid, '_adforest_ad_bidding', true ) == 1 )
			{
				echo adforest_html_bidding_system( $pid );
			}
			else if( isset( $adforest_theme['sb_enable_comments_offer_user'] ) && $adforest_theme['sb_enable_comments_offer_user'] && get_post_meta($pid, '_adforest_ad_bidding', true ) == 0 )
			{
				
			}
			else
			{
				echo adforest_html_bidding_system( $pid );
			}

        ?>
            
	   <?php
	   }
	   ?>