<?php global $adforest_theme; ?>
<div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding <?php echo esc_attr( $adforest_theme['search_bg'] ); ?>">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <div class="<?php echo esc_attr($left_col); ?> <?php echo esc_attr( $adforest_theme['search_res_bg'] ); ?>">
                     <!-- Row -->
                     <div class="row">
                        <!-- Sorting Filters -->
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                        <div class="clearfix"></div>
							<div class="listingTopFilterBar">
   								 <div class="col-md-7 col-xs-12 col-sm-6 no-padding">
                                    <ul class="filterAdType">
                                        <li class="active">
                                        <a href="javascript:void(0);"><?php echo __( 'Found Ads', 'adforest' ); ?>
                                        <small>(<?php echo esc_html( $results->found_posts ); ?>)</small>
                                        </a>
                                         </li>
                              <?php
							$param	=	$_SERVER['QUERY_STRING'];
							if( $param != "" )
							{
								?>

                                        <li class="">
                                        <a href="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>"><?php echo __('Reset Search', 'adforest' ); ?></a>
                                        </li>
                                <?php	
							}
							  ?>
                                    </ul>
                                </div>
   								 <div class="col-md-5 col-xs-12 col-sm-6 no-padding">
                               	 	<div class="header-listing">
                                    <h6><?php echo __('Sort by', 'adforest' ); ?>:</h6>
                                    <div class="custom-select-box">
                                    <?php

									$selectedOldest = $selectedLatest = $selectedTitleAsc = $selectedTitleDesc = $selectedPriceHigh = $selectedPriceLow = '';
										if( isset( $_GET['sort'] ) )
										{
											$selectedOldest = ( $_GET['sort'] == 'id-asc' ) ? 'selected' : '';
											$selectedLatest	= ( $_GET['sort'] == 'id-desc' ) ? 'selected' : '';
											$selectedTitleAsc	= ( $_GET['sort'] == 'title-asc' ) ? 'selected' : '';
											$selectedTitleDesc	= ( $_GET['sort'] == 'title-desc' ) ? 'selected' : '';
											$selectedPriceHigh	= ( $_GET['sort'] == 'price-desc' ) ? 'selected' : '';
											$selectedPriceLow	= ( $_GET['sort'] == 'price-asc' ) ? 'selected' : '';												
										}
									?>
                                    <form method="get">
                                    	<select name="sort" id="order_by" class="custom-select">
                                            <option value="id-desc" <?php echo esc_attr( $selectedLatest ); ?>>
                                                <?php echo esc_html__('Newest To Oldest', 'adforest' ); ?>
                                            </option>
                                            <option value="id-asc" <?php echo esc_attr( $selectedOldest ); ?>>
                                                <?php echo esc_html__('Oldest To Newest', 'adforest' ); ?>
                                            </option>
                                            <option value="price-desc" <?php echo esc_attr( $selectedPriceHigh ); ?>>
                                                <?php echo esc_html__('Price: High to Low', 'adforest' ); ?>
                                            </option>
                                            <option value="price-asc" <?php echo esc_attr( $selectedPriceLow ); ?>>
                                                <?php echo esc_html__('Price: Low to High', 'adforest' ); ?>
                                            </option>
                                        </select>
                                        <?php echo adforest_search_params( 'sort' ); ?>
                                    </form>   
                                      
                                    </div>
                                </div>
    							</div>
							</div>
                        </div>
                        <?php if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' ) { ?>
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                        <?php get_template_part( 'template-parts/layouts/search/search', 'tags' ); ?>
                        </div>
                        <?php } ?>
                        <!-- Sorting Filters End-->
                        <div class="clearfix"></div>
					<?php
                    if( isset( $adforest_theme['feature_on_search'] ) && $adforest_theme['feature_on_search'] )
                    {
						$args = 
						array( 
							'post_type' => 'ad_post',
							'posts_per_page' => $adforest_theme['max_ads_feature'],
							'tax_query' => array(
								$category,
							),
							'meta_query' => array(
								array(
									'key'     => '_adforest_is_feature',
									'value'   => 1,
									'compare' => '=',
								),
							),
							'orderby'        => 'rand',

						);
						$ads = new ads();
						echo ( $ads->adforest_get_ads_grid_slider( $args, $adforest_theme['feature_ads_title'], 4 ) );
                    }
                    if( isset( $adforest_theme['search_ad_720_1'] ) && $adforest_theme['search_ad_720_1'] != "" && $results->have_posts() )
					{
                    ?>
                        <div class="col-md-12">
                            <div class="margin-bottom-30 margin-top-10 text-center">
                            <?php echo "" . $adforest_theme['search_ad_720_1']; ?>
                            </div>
                     	</div>
                   <?php
					}
					?>
                        <div class="clearfix"></div>
					<?php
					$layouts	=	 array( 'list_1', 'list_2', 'list_3' );
				if ( $results->have_posts() )
				{
					$type = $adforest_theme['search_ad_layout_for_sidebar'];
					$col	= 6;
					if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
						$col	= 4;
					if (in_array($adforest_theme['search_ad_layout_for_sidebar'], $layouts))
					{
						require trailingslashit( get_template_directory () ) . "template-parts/layouts/ad_style/search-layout-list.php";
						echo($out);
					}
					else
					{
						require trailingslashit( get_template_directory () ) . "template-parts/layouts/ad_style/search-layout-grid.php";
						echo($out);
					}
                    
                /* Restore original Post Data */
                wp_reset_postdata();
                }
				else
				{
					echo '<h2 class="padding-left-20">'. esc_html__('No Result Found.', 'adforest').'</h2>';	
				}

                ?>
                        <div class="clearfix"></div>
                <?php
				if(isset( $adforest_theme['search_ad_720_2'] ) &&  $adforest_theme['search_ad_720_2'] != "" && $results->have_posts() )
				{
        		?>
                <div class="col-md-12">
                     <div class="margin-top-10 margin-bottom-30 text-center">
                     <?php echo "" . $adforest_theme['search_ad_720_2']; ?>
                     </div>
                 </div>
                <?php
				}
			    ?>
                        <!-- Pagination -->  
                        <div class="text-center margin-top-30 margin-bottom-20">
                           <?php adforest_pagination_search( $results ); ?>
                        </div>
                        <!-- Pagination End -->   
                     </div>
                     <!-- Row End -->
                  </div>
                  <!-- Middle Content Area  End -->
                  <!-- Left Sidebar -->
                  <?php get_sidebar( 'ads' ); ?>
                  <!-- Left Sidebar End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
      </div>