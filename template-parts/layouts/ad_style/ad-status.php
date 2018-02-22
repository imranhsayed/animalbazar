<?php
$pid	=	get_the_ID();
 if( get_post_meta($pid, '_adforest_ad_status_', true ) != ""  && get_post_meta($pid, '_adforest_ad_status_', true ) != 'active' )
 {
?>
    <div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
     <div role="alert" class="alert alert-info alert-dismissible <?php echo adforest_alert_type(); ?>">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
    <strong><?php echo __('Info','adforest'); ?></strong> - 
    <?php echo __('This ad has been','adforest') . " "; ?>
    <?php echo adforest_ad_statues(get_post_meta($pid, '_adforest_ad_status_', true )); ?>.
     </div>
     </div>
     </div>
<?php
 }