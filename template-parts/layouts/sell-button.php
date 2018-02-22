<?php global $adforest_theme; 
if( isset( $adforest_theme['sell_button'] ) && $adforest_theme['sell_button'] )
{
	$sell = __( 'SELL', 'adforest' );
	if( isset( $adforest_theme['sticky_title'] ) && $adforest_theme['sticky_title'] )
	{
		$sell	=	$adforest_theme['sticky_title'];	
	}
	$icon = 'flaticon-transport-9';
	if( isset( $adforest_theme['sticky_icon'] ) && $adforest_theme['sticky_icon'] )
	{
		$icon	=	$adforest_theme['sticky_icon'];	
	}
	if( is_page() && get_the_ID() == $adforest_theme['sb_post_ad_page'] )
		return;
?>

<a href="<?php echo get_the_permalink( $adforest_theme['sb_post_ad_page'] ); ?>" class="sticky-post-button sticky-post-button-hidden hidden-xs">
         <span class="sell-icons">
         <i class="<?php echo esc_attr( $icon ); ?>"></i>
         </span>
         <h4><?php echo esc_html( $sell ); ?></h4>
</a>
<?php
}
?>