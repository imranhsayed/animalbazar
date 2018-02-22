<?php global $adforest_theme; ?>
<?php
if( !$adforest_theme['ad_in_menu'] )
{
	return;
}
$btn_text	=	__( 'Post Free Ad','adforest' );
if( isset( $adforest_theme['ad_in_menu_text'] ) &&  $adforest_theme['ad_in_menu_text'] != "" )
{
	$btn_text	=	$adforest_theme['ad_in_menu_text'];
}
?>
    <a href="<?php echo get_the_permalink( $adforest_theme['sb_post_ad_page'] ); ?>" class="btn btn-light">
    <i class="fa fa-plus" aria-hidden="true"></i>
     <?php echo esc_html($btn_text ); ?>
     </a>