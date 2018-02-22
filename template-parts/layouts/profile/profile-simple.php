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
					 	if( have_posts() > 0 && in_array( 'sb_framework/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
						{
							$author_id = get_query_var( 'author' );
							$author = get_user_by( 'ID', $author_id );
					 ?>
                        <!-- Sorting Filters -->
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                           <!-- Sorting Filters Breadcrumb -->
                           <div class="filter-brudcrums">
                              <span>
                              <?php echo __('Ad(s) posted by', 'adforest' ); ?>
                              <span class="showed"><?php echo " " . $author->display_name; ?></span>
                              </span>
                           </div>
                           <!-- Sorting Filters Breadcrumb End -->
                        </div>
                        <!-- Sorting Filters End-->
                        <div class="clearfix"></div>
                        <!-- Ads Archive 9 -->
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
                        <div class="col-md-12 col-xs-12 col-sm-12">
                           <?php adforest_pagination(); ?>
                        </div>
                        <!-- Pagination End -->
                   <?php
						}
						else
						{
							echo '<div class="col-md-8 col-sm-12 col-xs-12">
<h2>' .  __('No Ad(s) result found.','adforest') . '</h2></div><br /><br /><br /><br />';
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
      </div>