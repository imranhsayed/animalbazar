<?php
global $adforest_theme; 
$pid	=	get_the_ID();
?>
<div class="ad-share text-center">
		<?php
        if( isset( $adforest_theme['share_ads_on'] ) && $adforest_theme['share_ads_on'] )
        {
        ?>
           <div data-toggle="modal" data-target=".share-ad" class="descs-box col-md-4 col-sm-4 col-xs-12">
              <i class="fa fa-share-alt"></i> <span class="hidetext"><?php echo __('Share','adforest'); ?></span>
           </div>
       <?php
       get_template_part( 'template-parts/layouts/ad_style/share', 'ad' );
        }
        ?>
           <a class="descs-box col-md-4 col-sm-4 col-xs-12" href="javascript:void(0);" id="ad_to_fav" data-adid="<?php echo get_the_ID(); ?>">
           <i class="fa fa-heart-o active"></i> 
           <span class="hidetext">
		   <?php echo __('Add to Favourites','adforest'); ?>
           </span>
           </a>
           <div data-target=".report-quote" data-toggle="modal" class="descs-box col-md-4 col-sm-4 col-xs-12">
              <i class="fa fa-warning"></i>
              <span class="hidetext"><?php echo __('Report','adforest'); ?></span>
           </div>
</div>
<?php
	get_template_part( 'template-parts/layouts/ad_style/report', 'ad' );
?>