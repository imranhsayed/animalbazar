<?php
global $adforest_theme; 
$pid	=	get_the_ID();
?>
  <div class="hidden-xs hidden-sm">
    <ul>
      <li><a class="page-scroll" href="#description"><i class="fa fa-file-text"></i> <?php echo __('Description','adforest'); ?></a></li>
      <?php if( get_post_meta($pid, '_adforest_ad_yvideo', true ) != "" ) { ?>
      <li><a class="page-scroll" href="#video"><i class="fa fa-video-camera"></i> <?php echo __('Video','adforest'); ?></a></li>
      <?php
	  }
	  if( get_post_meta($pid, '_adforest_ad_location', true ) != "" )
	  {
	  ?>
      <li><a class="page-scroll" href="#map-location"><i class="fa fa-location-arrow"></i> <?php echo __('Location Map','adforest'); ?></a></li>
      <?php
	  }
       	if( isset( $adforest_theme['sb_enable_comments_offer'] ) && $adforest_theme['sb_enable_comments_offer'] && get_post_meta($pid, '_adforest_ad_status_', true ) != 'sold' && get_post_meta($pid, '_adforest_ad_status_', true ) != 'expired' && get_post_meta($pid, '_adforest_ad_price', true ) != "0" )
		{
			if( isset( $adforest_theme['sb_enable_comments_offer_user'] ) && $adforest_theme['sb_enable_comments_offer_user'] && get_post_meta($pid, '_adforest_ad_bidding', true ) == 1 )
			{
				?>
                <li><a class="page-scroll" href="#bids"><i class="fa fa-gavel "></i> <?php echo __('Bids','adforest'); ?></a></li>
                <?php
			}
			else if( isset( $adforest_theme['sb_enable_comments_offer_user'] ) && $adforest_theme['sb_enable_comments_offer_user'] && get_post_meta($pid, '_adforest_ad_bidding', true ) == 0 )
			{
				
			}
			else
			{
				?>
                <li><a class="page-scroll" href="#bids"><i class="fa fa-gavel "></i> <?php echo __('Bids','adforest'); ?></a></li>
                <?php
			}
		}
        ?>
      
      
    </ul>
  </div>