<?php 
global $adforest_theme; 
$pid	=	get_the_ID();
$poster_id	=	get_post_field( 'post_author', $pid );
$address	=	get_post_meta($pid, '_adforest_ad_location', true ); 
?>
<div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding error-page pattern-bgs gray ">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- =-=-=-=-=-=-= Advertizing Sidebar =-=-=-=-=-=-= -->
                  <div class="col-md-2 col-sm-2  hidden-xs hidden-sm  leftbar-stick">
                     <div class="theiaStickySidebar"><?php echo "" . $adforest_theme['style_ad_160_2']; ?></div>
                  </div>
               
                  <!-- Middle Content Area -->
                  <div class="col-md-8 col-xs-12 col-sm-12">
                     <!-- Single Ad -->
                     <div class="singlepost-content">
                     <?php
			 if( get_post_meta($pid, '_adforest_ad_status_', true ) != 'active' )
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
					<?php get_template_part( 'template-parts/layouts/ad_style/title', 'box' ); ?> 
                       <!-- Listing Slider  --> 
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
                        
                         <div class="margin-top-30">
                         <?php echo "" . $adforest_theme['style_ad_720_2']; ?>
                         </div>
                        
                     </div>
                     <!-- Single Ad End --> 
                     <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
                     <?php get_template_part( 'template-parts/layouts/ad_style/related', 'ads' ); ?>
                     <!-- =-=-=-=-=-=-= Latest Ads End =-=-=-=-=-=-= -->
                  </div>
                  <!-- Middle Content Area  End -->
                  
                   <!-- =-=-=-=-=-=-= Advertizing Sidebar =-=-=-=-=-=-= -->
                  <div class="col-md-2 col-sm-2 hidden-xs hidden-sm rightbar-stick">
                     <div class="theiaStickySidebar"><?php echo "" . $adforest_theme['style_ad_160_1']; ?></div>
                  </div>
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
      </div>      <!-- =-=-=-=-=-=-= Ad Detail Modal =-=-=-=-=-=-= -->
      <?php get_template_part( 'template-parts/layouts/ad_style/sticky', 'details' ); ?>
      <?php get_template_part( 'template-parts/layouts/ad_style/message', 'seller' ); ?>