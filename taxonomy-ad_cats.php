<?php get_header(); ?>
<?php global $adforest_theme; ?>
<div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding pattern_dots">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
	               <!-- Search Filter-->
	               <div class="col-md-4 col-lg-4 col-sx-4 google-add-sidebar">
		               <!-- Search Sidebar left-->
		               <div class="ad-sidebar-search"><?php dynamic_sidebar( 'adforest_search_sidebar' ) ?></div>
		               <!-- Google adds Sidebar left-->
		               <div class="google-add-sidebar-left"><?php dynamic_sidebar( 'adforest_google_ad_sidebar_left' ) ?></div>
	               </div>
                  <!-- Middle Content Area -->
                  <div class="col-md-8 col-lg-8 col-sx-8">
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
                              <?php echo __('Category', 'adforest'). ': ' . ucfirst( single_cat_title( "", false ) ); ?>
                              </span>
                           </div>
                           <!-- Sorting Filters Breadcrumb End -->
                        </div>
                        <!-- Sorting Filters End-->
                    <?php
					 }

					  $query = mti_get_ad_search_widget_query( $_POST );
//					 echo '<pre>';
//					 print_r( $_POST );
					 ?>
                        <div class="clearfix"></div>
                        <!-- Ads Archive 1 -->
                        <div class="posts-masonry">
                           <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                              <ul class="list-unstyled">
                             <?php
								if ( ! empty( $query ) ) {
									if ( $query->have_posts() ) {
										while( $query->have_posts() )
										{
											$query->the_post();
											$pid	=	get_the_ID();
											$ad	= new ads();
											echo($ad->adforest_search_layout_list($pid));
										}
										wp_reset_postdata();
										?>
										<!-- Ads Archive End -->
										<div class="clearfix"></div>
										<!-- Pagination -->
										<div class="col-md-12 col-xs-12 col-sm-12">
											<?php adforest_pagination(); ?>
										</div>
										<!-- Pagination End -->
										<?php
									}
								} else {
									if ( have_posts() ) {
										while( have_posts() )
										{
											the_post();
											$pid	=	get_the_ID();
											$ad	= new ads();
											echo($ad->adforest_search_layout_list($pid));
										}
										wp_reset_postdata();
										?>
										<!-- Ads Archive End -->
										<div class="clearfix"></div>
										<!-- Pagination -->
										<div class="col-md-12 col-xs-12 col-sm-12">
											<?php adforest_pagination(); ?>
										</div>
										<!-- Pagination End -->
										<?php
									}
								}

							?>
                              </ul>
                           </div>
                        </div>

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
	            <!-- Google adds Sidebar footer-->
	            <div class="col-md-12 col-lg-12 col-sx-12 google-add-sidebar-footer">
		            <?php dynamic_sidebar( 'adforest_google_ad_sidebar_footer' ) ?>
	            </div>
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->

      </div>
<?php get_footer(); ?>