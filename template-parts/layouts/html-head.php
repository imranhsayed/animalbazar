<!doctype html>
<html <?php language_attributes(); ?> >
<head>
<?php global $adforest_theme; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<?php 
if ( !in_array( 'wordpress-seo/wp-seo.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
{
?>
<meta name="description" content="<?php esc_attr(  bloginfo( 'description' ) ); ?>">
<?php
}
?>
<?php
if( isset( $adforest_theme['header_js_and_css'] ) && $adforest_theme['header_js_and_css'] != "" )
{
	echo $adforest_theme['header_js_and_css'];
}
$sb_body_class	=	'';
if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && isset( $adforest_theme['sb_header'] ) &&  $adforest_theme['sb_header'] == 'transparent' && is_page_template( 'page-home.php' ) )
{
	$sb_body_class	=	 'enable-transparent';
}

?>
<?php wp_head(); ?>
</head>
<body <?php body_class($sb_body_class); ?>>
	<?php
    if( isset( $adforest_theme['sb_pre_loader'] ) && $adforest_theme['sb_pre_loader'] )
    {
    ?>
      <!-- =-=-=-=-=-=-= Preloader =-=-=-=-=-=-= -->
      <div id="loader-wrapper">
			<div id="loader"></div>
			<div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
	 </div>
	<?php
    }
    ?>
	<?php
    if( isset( $adforest_theme['sb_color_plate'] ) && $adforest_theme['sb_color_plate'] )
    {
    ?>
 <div class="color-switcher" id="choose_color">
         <a href="#" class="picker_close"><i class="fa fa-gear"></i></a>
         <h5><?php echo __ ( 'STYLE SWITCHER', 'adforest' ); ?></h5>
         <div class="theme-colours">
            <p> <?php echo __ ( 'Choose Colour style', 'adforest' ); ?> </p>
            <ul>
               <li>
                  <a href="#." class="defualt" id="defualt"></a>
               </li>
               <li>
                  <a href="#." class="green" id="green"></a>
               </li>
               <li>
                  <a href="#." class="blue" id="blue"></a>
               </li>
               <li>
                  <a href="#." class="red" id="red"></a>
               </li>
               <li>
                  <a href="#." class="sea-green" id="sea-green"></a>
               </li>
            </ul>
         </div>
         <div class="clearfix"> </div>
      </div>
	<?php
    }
    ?>
      <?php
	if( isset( $adforest_theme['sb_comming_soon_mode'] ) && $adforest_theme['sb_comming_soon_mode'] )
	{
		if (!current_user_can('administrator') && !is_admin())
		{
			get_template_part( 'template-parts/layouts/coming','soon' );
			exit;
		}
	}
?>
<div class="loading" id="sb_loading"><?php __( 'Loading', 'adforest' ); ?>&#8230;</div>