<?php get_header(); ?>
<?php 
get_template_part( 'template-parts/layouts/content','breadcrumb-project' );
the_post(); 
?>
	<!-- =-=-=-=-=-=-= Project Details =-=-=-=-=-=-= -->
    <section class="custom-padding" id="project-details">
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Left Content Area -->
                <div class="col-sm-12 col-xs-12 col-md-8">


                    <!-- blog-grid -->
                    <div class="news-box">
                        <!-- post image -->
                        <div class="news-thumb">
                            <!-- standard post -->
			   <?php
                $image	=	adforest_get_feature_image( get_the_ID(), 'rane-single-project' );
                if( $image[0] != "" )
                {
					$large	=	adforest_get_feature_image( get_the_ID(), 'large' );
			   ?>  
                        <a href="<?php echo esc_url( $large[0] ); ?>" class="tt-lightbox">
                        <img alt="<?php the_title(); ?>" src="<?php echo esc_url( $image[0] ); ?>" class="img-responsive margin-bottom-30 no-image">
                        </a>
                <?php
				}
				?>
                            <!-- standard post end -->

                        </div>
                        <!-- post image end -->

                        <!-- blog detail -->
                        <div class="news-detail single">
                            <h2><?php the_title(); ?></h2>
                            <p><?php the_content(); ?></p>

                                <ul class="portfolio-meta">
                                <?php
									if( get_post_meta( get_the_ID(), "client", true) != "" )
									{
								?>
                                <li>
                                <span> 
									<?php echo esc_html__( 'Client', 'adforest' ); ?>
                                </span>
                                <?php echo esc_html( get_post_meta( get_the_ID(), "client", true) ); ?>
                                </li>
                                <?php
									}
								?>
                                <?php
									if( get_post_meta( get_the_ID(), "created_by", true) != "" )
									{
								?>
                                <li>
                                <span> 
									<?php echo esc_html__( 'Created by', 'adforest' ); ?>
                                </span>
                                <?php echo esc_html( get_post_meta( get_the_ID(), "created_by", true) ); ?>
                                </li>
                                <?php
									}
								?>
								<?php
									if( get_post_meta( get_the_ID(), "completed", true) != "" )
									{
								?>

                                <li>
                                <span> 
									<?php echo esc_html__( 'Completed on', 'adforest' ); ?>
                                </span>
                                <?php echo esc_html( get_post_meta( get_the_ID(), "completed", true) ); ?>
                                </li>
                                <?php
									}
								?>
                                <?php
									if( get_post_meta( get_the_ID(), "skills", true) != "" )
									{
								?>
                                <li>
                                <span> 
									<?php echo esc_html__( 'Skill(s)', 'adforest' ); ?>
                                </span>
                                <?php echo esc_html( get_post_meta( get_the_ID(), "skills", true) ); ?>
                                </li>
                                <?php
									}
								?>
                            </ul>
                          <?php
						  	if( get_post_meta( get_the_ID(), "project_url", true) != "" )
							{
						  ?>  
                                <a href="<?php echo esc_url( get_post_meta( get_the_ID(), "project_url", true) ); ?>" class="btn btn-primary" target="_blank"> 
								<?php echo esc_html__( 'Visit website', 'adforest' ); ?> 
                                </a>
							<?php
							}
							?>
                        </div>
                        <!-- blog detail end -->
                    <!-- social shares -->
					<?php
                        if( $adforest_theme['enable_share_project'] )
                        {
                    ?>  
                    <div class="b-socials full-socials pull-right clearfix">
                        <ul class="list-unstyled">
                            <?php echo wp_kses( adforest_social_icons(), adforest_required_tags() ); ?>
                        </ul>
                    </div>
                    <?php
                        }
                    ?>
 					<!-- social shares end -->

                    </div>
                    <!-- blog-grid end -->





                </div>
                <!-- Left Content Area -->

                <!-- Right Sidebar Area -->
                <div class="col-sm-12 col-xs-12  col-md-4">

                    <!-- sidebar -->
                    <?php get_sidebar(); ?>
                    <!-- sidebar end -->

                </div>
                <!-- Right Sidebar Area End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- end container -->
    </section>
    <!-- =-=-=-=-=-=-= Project Details End =-=-=-=-=-=-= -->
<?php get_footer(); ?>