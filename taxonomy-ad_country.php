<?php get_header(); ?>
<?php global $adforest_theme; ?>
<div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding pattern_dots">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <div class="col-md-12 col-lg-12 col-sx-12">
                     <!-- Row -->
                     <div class="row">
                     <?php
					 	if( have_posts() )
						{
					 ?>
                     <?php
					 if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
					 {
						 
					 }
					 else
					 {
					 ?>
                        <!-- Sorting Filters -->
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                           <!-- Sorting Filters Breadcrumb -->
                           <div class="filter-brudcrums">
                              <span>
                              <?php echo __('Tag', 'adforest'). ': ' . ucfirst( single_cat_title( "", false ) ); ?>
                              </span>
                           </div>
                           <!-- Sorting Filters Breadcrumb End -->
                        </div>
                        <!-- Sorting Filters End-->
                    <?php
					 }
					 ?>
                        <div class="clearfix"></div>
                        <!-- Ads Archive 2 -->
                        <div class="posts-masonry">
                           <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                              <ul class="list-unstyled">
                             <?php
							 	while( have_posts() )
								{
									the_post();
									$pid	=	get_the_ID();
									$ad	= new ads();
									echo($ad->adforest_search_layout_list($pid));
								}
							?>
                              </ul>
                           </div>
                        </div>
                        <!-- Ads Archive End -->  
                        <div class="clearfix"></div>
                        <!-- Pagination -->  
                        <!-- Pagination -->  
                        <div class="col-md-12 col-xs-12 col-sm-12">
                           <?php adforest_pagination(); ?>
                        </div>
                        <!-- Pagination End -->
                   <?php
						}
						else
						{
							get_template_part( 'template-parts/content', 'none' );
						}
					?>
                     </div>
                     <!-- Row End -->
                  </div>
                  <!-- Middle Content Area  End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->

      </div>
<?php get_footer(); ?>