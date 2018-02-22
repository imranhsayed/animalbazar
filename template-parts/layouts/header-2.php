<?php global $adforest_theme; ?>
<!-- Header -->
 <?php get_template_part( 'template-parts/layouts/top','bar' ); ?>
<div class="header">
 <div class="row">
    <div class="container">
       <!-- Logo -->
       <div class="col-md-3 col-sm-12 col-xs-12">
          <div class="logo">
             <?php get_template_part( 'template-parts/layouts/site','logo' ); ?>
          </div>
       </div>
       <!-- Category -->
       <div class="col-md-7 col-sm-9">
       <?php
	   if( isset( $adforest_theme['search_in_header'] ) && $adforest_theme['search_in_header'] )
	   {
	   ?>
       <?php
	   	$search_title	=	'';
		if( isset( $_GET['ad_title'] ) && $_GET['ad_title'] != "" )
			$search_title = $_GET['ad_title'];
	   ?>
      	 <form method="get" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>">
             <div class="input-group">
                <input placeholder="<?php echo __('What Are You Looking For ?', 'adforest' ); ?>" type="text" name="ad_title" class="form-control" value="<?php echo esc_attr( $search_title ); ?>"><span class="input-group-btn">
                <button class="btn btn-default" type="submit"><?php echo __('Search', 'adforest' ); ?></button>
                </span> 
             </div>
        </form>  
      <?php
	   }
	  ?>
       </div>
       <!-- Post Button -->
       <div class="col-md-2 col-sm-3 no-padding">
       <?php
	   if( isset( $adforest_theme['ad_in_menu'] ) && $adforest_theme['ad_in_menu'] )
	   {
			$btn_text	=	__( 'Post Ad','adforest' );
			if( isset( $adforest_theme['ad_in_menu_text'] ) &&  $adforest_theme['ad_in_menu_text'] != "" )
			{
				$btn_text	=	$adforest_theme['ad_in_menu_text'];
			}
	   ?>
            <a href="<?php echo get_the_permalink( $adforest_theme['sb_post_ad_page'] ); ?>" class="btn btn-orange btn-block">
                <i class="fa fa-plus" aria-hidden="true"></i>
                 <?php echo esc_html($btn_text ); ?>
            </a>
      <?php
	   }
	  ?>
       </div>
    </div>
 </div>
</div>
<div class="elegent-black">
<div class="main-menu">
 <!-- Navigation Bar -->
 <nav id="menu-1" class="mega-menu">
    <!-- menu list items container -->
    <section class="menu-list-items">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
       <!-- menu logo -->
       <ul class="menu-logo">
          <li>
             <?php get_template_part( 'template-parts/layouts/site','logo' ); ?>
          </li>
       </ul>
       <!-- menu links -->
       <?php get_template_part( 'template-parts/layouts/main','nav' ); ?>
       <ul class="menu-search-bar hidden">
          <li>
             <?php get_template_part( 'template-parts/layouts/ad','button' ); ?>
          </li>
       </ul>
            </div>
        </div>
    </div>      
</section>
 </nav>
</div>
<div class="clearfix"></div>
</div>