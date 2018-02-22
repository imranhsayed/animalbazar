<?php get_template_part( 'template-parts/layouts/html','head' ); ?>
<?php global $adforest_theme; ?>
<div class="sb-top-bar_notification">
<a href="javascript:void(0);">
<?php echo __('For a better experience please change your browser to CHROME, FIREFOX, OPERA or Internet Explorer.', 'adforest' ); ?>
</a>
</div>
<?php
	if( isset( $adforest_theme['sb_header'] ) &&  $adforest_theme['sb_header'] == 'black' )
	{
		get_template_part( 'template-parts/layouts/header','2' );
	}
	else if( isset( $adforest_theme['sb_header'] ) &&  $adforest_theme['sb_header'] == 'with_ad' )
	{
		get_template_part( 'template-parts/layouts/header','3' );
	}
	else if( isset( $adforest_theme['sb_header'] ) &&  $adforest_theme['sb_header'] == 'light' )
	{
		get_template_part( 'template-parts/layouts/header','4' );
	}
	else
	{
		get_template_part( 'template-parts/layouts/header','1' );	
	}

if ( in_array( 'sb_framework/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  )
{	
	if( isset( $adforest_theme['sb_header'] ) &&  $adforest_theme['sb_header'] == 'black' )
	{
		global $post;
		if( is_404() || is_search()  )
		{
			get_template_part( 'template-parts/layouts/bread','crumb-search' );
		}
		else if( is_author()  )
		{
			get_template_part( 'template-parts/layouts/bread','crumb' );
		}
		else
		{
			if( basename(get_page_template()) != 'page-home.php' && $adforest_theme['sb_profile_page'] != $post->ID )
			{
				get_template_part( 'template-parts/layouts/bread','crumb' );
			}
		}
	}
	else
	{
		if( is_404() || is_search()  )
		{
			get_template_part( 'template-parts/layouts/bread','crumb-search' );
		}
		else if( is_author()  )
		{
			get_template_part( 'template-parts/layouts/bread','crumb' );
		}
		else
		{
			if( basename(get_page_template()) != 'page-home.php' )
			{
				get_template_part( 'template-parts/layouts/bread','crumb' );
			}
		}
	}
}
else
{
		get_template_part( 'template-parts/layouts/bread','crumb-before' );	
}
?>