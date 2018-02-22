<?php
global $adforest_theme; 
$pid	=	get_the_ID();
$feature_col = 4;
?>
<div class="short-features">
  <!-- Heading Area -->
  <div class="heading-panel">
     <h3 class="main-title text-left">
        <?php echo __('Description','adforest'); ?>
     </h3>
  </div>
	<!--Display Pet fields Specifications-->
	<?php 
	?>
	<?php echo adforest_pet_field_description_markup( $pid ); ?>
<?php 
if( get_post_meta($pid, '_adforest_ad_price_type', true ) == "no_price"  || ( get_post_meta($pid, '_adforest_ad_price', true ) == "" && get_post_meta($pid, '_adforest_ad_price_type', true ) != "free" && get_post_meta($pid, '_adforest_ad_price_type', true ) != "on_call" ) )
{
    
}
else
{
	
	if( isset( $adforest_theme['ad_features_cols'] ) && $adforest_theme['ad_features_cols'] != '' )
		$feature_col = $adforest_theme['ad_features_cols'];
    
?>
  <div class="col-sm-<?php echo esc_attr($feature_col); ?> col-md-<?php echo esc_attr($feature_col); ?> col-xs-12 no-padding">
     <span><strong><?php echo __('Price','adforest'); ?></strong> :</span>
    <?php echo adforest_adPrice($pid); ?> 
     
  </div>
<?php
}
?>
  <?php if( get_post_meta($pid, '_adforest_ad_type', true ) != "" ) { ?>
  <div class="col-sm-<?php echo esc_attr($feature_col); ?> col-md-<?php echo esc_attr($feature_col); ?> col-xs-12 no-padding">
     <span><strong><?php echo __('Type','adforest'); ?></strong> :</span> <?php echo get_post_meta($pid, '_adforest_ad_type', true ); ?>
  </div>
  <?php } ?>
  <div class="col-sm-<?php echo esc_attr($feature_col); ?> col-md-<?php echo esc_attr($feature_col); ?> col-xs-12 no-padding">
     <span><strong><?php echo __('Date','adforest'); ?></strong> :</span> <?php echo get_the_date(); ?>
  </div>
  <?php 
  if( get_post_meta($pid, '_adforest_ad_condition', true ) != "" && isset( $adforest_theme['allow_tax_condition'] ) && $adforest_theme['allow_tax_condition'] )
  {
 ?>
  <div class="col-sm-<?php echo esc_attr($feature_col); ?> col-md-<?php echo esc_attr($feature_col); ?> col-xs-12 no-padding">
     <span><strong><?php echo __('Condition','adforest'); ?></strong> :</span> <?php echo get_post_meta($pid, '_adforest_ad_condition', true ); ?>
  </div>
  <?php
  }
  if( get_post_meta($pid, '_adforest_ad_warranty', true ) != "" && isset( $adforest_theme['allow_tax_warranty'] ) && $adforest_theme['allow_tax_warranty'] )
  {
  ?>
  <div class="col-sm-<?php echo esc_attr($feature_col); ?> col-md-<?php echo esc_attr($feature_col); ?> col-xs-12 no-padding">
     <span><strong><?php echo __('Warranty','adforest'); ?></strong> :</span> <?php echo get_post_meta($pid, '_adforest_ad_warranty', true ); ?>
  </div>
  <?php
  }
    global $wpdb;
    $rows = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE post_id = '$pid' AND meta_key LIKE '_sb_extra_%'" );
    foreach( $rows as $row )
    {
        $caption	=	explode( '_', $row->meta_key );
        if( $row->meta_value == "" )
        {
            continue;
        }
 ?>
  <div class="col-sm-<?php echo esc_attr($feature_col); ?> col-md-<?php echo esc_attr($feature_col); ?> col-xs-12 no-padding">
     <span><strong><?php echo esc_html( ucfirst( $caption[3] ) ); ?></strong> :</span>
     <?php echo esc_html( $row->meta_value ); ?>
  </div>
 <?php		
    }
  ?>
 
  <?php 
        if(function_exists('adforestCustomFieldsHTML'))
        {
            echo adforestCustomFieldsHTML($pid, $feature_col);
        }
   ?>                     
 
  <?php if( get_post_meta($pid, '_adforest_ad_location', true ) != "" ) { ?>
  <div class="col-sm-12 col-md-12 col-xs-12 no-padding">
     <span><strong><?php echo __( "Location", 'adforest' ); ?></strong> :</span>
     <?php echo get_post_meta($pid, '_adforest_ad_location', true ); ?>
  </div>
  <?php } ?>
  
</div>