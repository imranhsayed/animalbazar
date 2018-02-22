<?php
global $adforest_theme; 
$pid	=	get_the_ID();
$address	=	get_post_meta($pid, '_adforest_ad_location', true ); 
?>
<div class="clearfix"></div>
<?php
if( isset( $adforest_theme['style_ad_720_1'] ) && $adforest_theme['style_ad_720_1'] != "" )
{
?>
<div class="margin-top-30 margin-bottom-10">
<?php echo $adforest_theme['style_ad_720_1']; ?>
</div>
<?php
}
?>

<div class="descs-box" id="description">
	<?php get_template_part( 'template-parts/layouts/ad_style/status', 'watermark' ); ?>
    <?php get_template_part( 'template-parts/layouts/ad_style/short', 'features' ); ?>
       <!-- Short Features  --> 
       <div class="desc-points">
         <?php the_content(); ?>
       </div>
       
       <?php get_template_part( 'template-parts/layouts/ad_style/ad', 'tags' ); ?>
       <hr />
       <?php
    if( isset( $adforest_theme['style_ad_720_2'] ) && $adforest_theme['style_ad_720_2'] != "" )
    {
    ?>
    <div class="margin-top-30 margin-bottom-30">
    <?php echo $adforest_theme['style_ad_720_2']; ?>
    </div>
    <?php
    }
    ?>
       <?php if( get_post_meta($pid, '_adforest_ad_yvideo', true ) != "" ) {
           
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', get_post_meta($pid, '_adforest_ad_yvideo', true ), $match);

            if( isset( $match[1] ) && $match[1] != "" )
            {
            
                $video_id = $match[1];
        
       ?>
       <div id="video">
       <div class="heading-panel">
             <h3 class="main-title text-left">
                <?php echo __('Ad Video','adforest'); ?> 
             </h3>
          </div>
       
<?php 
                $iframe = 'iframe';
                echo '<'.$iframe.' width="560" height="450" src="https://www.youtube.com/embed/'. esc_attr( $video_id ) . '" frameborder="0" allowfullscreen></'.$iframe.'>'; 
           ?>
           </div>
       <?php
        }
       }
       ?> 
       
                        
       <?php 
	   if( isset( $adforest_theme['allow_lat_lon'] ) && $adforest_theme['allow_lat_lon'] )
	   {
		?>
       <div id="map-location">
       <div class="heading-panel">
             <h3 class="main-title text-left">
                <?php echo __('Location','adforest'); ?> 
             </h3>
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
       </div>
       <?php
	   }
	   ?>
       <div class="clearfix"></div>
       <span id="bids"></span>
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
</div>	