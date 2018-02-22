<?php global $adforest_theme; ?>
<?php if( isset( $_GET['type'] ) && $_GET['type'] == 'ads' )
{
?>
<?php get_header(); ?>
<?php
if( isset( $adforest_theme['user_public_profile'] ) && $adforest_theme['user_public_profile'] != "" )
{
	get_template_part( 'template-parts/layouts/profile/profile','modern' );
}
else
{
	get_template_part( 'template-parts/layouts/profile/profile','simple' );
}
?>
<?php get_footer(); ?>
<?php
}
else if( isset( $_GET['type'] ) && $_GET['type'] == '1' )
{
	get_header();
	//if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
		get_template_part( 'template-parts/layouts/profile/user','ratting-modern' );
	get_footer();
}
else
{
	require trailingslashit( get_template_directory () )  . 'archive.php';	
}
?>