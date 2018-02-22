<?php
$pid	=	get_the_ID();
global $adforest_theme;
?>
   <?php 
        if( get_post_meta($pid, '_adforest_ad_status_', true ) == 'sold' )
        {
   ?>
        <div class="ad-closed">
              <img class="img-responsive" src="<?php echo esc_url($adforest_theme['sb_ad_sold']['url']); ?>" alt="<?php __('sold out', 'adforest' ); ?>">
         </div>
   <?php
        }
    ?>
   <?php 
        if( get_post_meta($pid, '_adforest_ad_status_', true ) == 'expired' )
        {
   ?>
        <div class="ad-expired">
              <img class="img-responsive" src="<?php echo esc_url($adforest_theme['sb_ad_expired']['url']); ?>" alt="<?php __('sold out', 'adforest' ); ?>">
         </div>
   <?php
        }
    ?>