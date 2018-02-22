<?php global $adforest_theme; ?>
<?php
	$author_id = get_query_var( 'author' );
	$author = get_user_by( 'ID', $author_id );
	$user_pic =	adforest_get_user_dp( $author_id, 'adforest-user-profile' );
?>
<section class="section-padding bg-gray" >
    <div class="container">
        <div class="row">
              <!-- Middle Content Area -->
			<?php require trailingslashit( get_template_directory () ) . 'template-parts/layouts/profile/profile-header.php'; ?>
                <div class="clearfix"></div>
              <div class="col-md-12 col-lg-12 col-sx-12">
              <?php
			  if( get_user_meta( $author_id, '_sb_user_intro', true ) != "" )
			  {
			  ?>
                <div class="card card-outline-warning mb-3 margin-top-20">
                  <div class="card-block">
                    <blockquote class="card-blockquote">
                      <p><?php echo get_user_meta( $author_id, '_sb_user_intro', true ); ?></p>
                    </blockquote>
                  </div>
                </div>
			<?php
			  }
			  ?>
                 <!-- Row -->
                 <div class="row">
                 <?php
                    if( have_posts() > 0 && in_array( 'sb_framework/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
                    {
                 ?>
                 <?php
				 if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
				 {
					 ?>
                      <div class=" margin-top-50"></div>
                     <?php
				 }
				 else
				 {
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
               <?php
				}
				?>
                    <div class="clearfix"></div>
                    <!-- Ads Archive 8 -->
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
                </div>
    </div>
</section>