<?php
global $adforest_theme;
?>
<!-- =-=-=-=-=-=-= Light Header =-=-=-=-=-=-= -->
<div class="colored-header modern-type-2">
<?php get_template_part( 'template-parts/layouts/top','bar' ); ?>
 <!-- Navigation Menu -->
<div class="clearfix"></div>
 <!-- menu start -->

<div class="header-middle">
      <div class="container">
        <div class="row">
          
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="widget ad-logo">
              <?php get_template_part( 'template-parts/layouts/site','logo' ); ?>
            </div>
          </div>
          <div class="col-xs-12 col-sm-8 col-md-8 no-right">
            <div class="widget">
            <?php
				if( isset( $adforest_theme['with_ad_720_90'] ) && $adforest_theme['with_ad_720_90'] != "" )
				{
					echo $adforest_theme['with_ad_720_90'];
				}
			?>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- menu end -->
<nav id="menu-1" class="mega-menu">
               <!-- menu list items container -->
               <section class="menu-list-items">
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-12 col-md-12 no-padding">
                           <!-- menu logo -->
                           <ul class="menu-logo">
                              <li>
                                 <?php get_template_part( 'template-parts/layouts/site','logo' ); ?>
                              </li>
                           </ul>
                           <!-- menu links -->
                          <?php get_template_part( 'template-parts/layouts/main','nav' ); ?>
                           <ul class="menu-search-bar">
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