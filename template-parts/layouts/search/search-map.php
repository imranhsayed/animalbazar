<?php 
//wp_enqueue_script( 'infobox', trailingslashit( get_template_directory_uri () ) . 'js/infobox.js' , array('google-map-callback'), false, false);
//wp_enqueue_script( 'marker-clusterer', trailingslashit( get_template_directory_uri () ) . 'js/markerclusterer.js' , false, false, false);

wp_enqueue_script( 'search-map');
wp_enqueue_script( 'oms');
?>
<div class="no-container">
    <div class="left-area">
        <div id="map" class="map"></div>
        <ul id="google-map-btn">
        <li><a href="javascript:void(0);" id="you_current_location" title="<?php echo __('You Current Location', 'adforest' ); ?>"><i class="fa fa-crosshairs"></i></a></li>
 <!--<li><a href="javascript:void(0);" id="prevpoint" title="<?php //echo __('Previous point on map', 'adforest' ); ?>"><?php //echo __('Prev', 'adforest' ); ?></a></li>
 <li><a href="javascript:void(0);" id="nextpoint" title="<?php //echo __('Next point on map', 'adforest' ); ?>"><?php //echo __('Next', 'adforest' ); ?></a></li>-->
 
 <li><a href="javascript:void(0);" id="reset_state" title="<?php echo __('Reset map', 'adforest' ); ?>"><?php echo  __("Reset", "adforest" ); ?></a></li>
</ul>
    </div> <!-- end .left-area -->
    <div class="right-area">
        <div class="inner-content">
            <div class="filtes-with-maps ">
            <?php
			$map_script	=	 '<script> var show_radius = "";';
			if( isset( $adforest_theme['sb_radius_search'] ) && $adforest_theme['sb_radius_search'] )
			{
				$radius = '';
				$area	= '';
				if( isset($_GET['org']) && $_GET['org'] != "" && isset($_GET['rd']) && $_GET['rd'] != "" )
				{
					$radius	=	$_GET['rd'];	
					$area	=	$_GET['org'];
					$map_script .= ' var show_radius = "yes";';
				}
			?>
				<div class="seprator hidden-xs hidden-sm">
                   <div class="row">
                        <div class="col-sm-12">
                            <form id="sb-radius-form" class="for-radius">
                            <div class="form-group">
                            <label ><?php echo __('Radius Search', 'adforest' ); ?></label>
                            <div class="input-group">
                            <div class="new-location">
                            <input class="form-control custom_width_location" name="org" id="sb_user_address" placeholder="<?php echo __('Type Location...','adforest' ); ?>" type="text" data-parsley-required="true" data-parsley-error-message="" value="<?php echo esc_attr( $area ); ?>">
                            <a href="javascript:void(0);" id="you_current_location_text" data-place="text_field" ><i class="fa fa-crosshairs"></i></a>
                            </div>
                            <input class="form-control custom_width_radius" name="rd" id="map_radius" value="<?php echo esc_attr( $radius ); ?>" placeholder="<?php echo __('Radius in km','adforest' ); ?>" type="number" data-parsley-required="true" data-parsley-error-message="" > 
                            <div class="input-group-btn">                           
                            <button type="submit" class="btn btn-theme" id="radius_search1"><?php echo __('Search', 'adforest' ); ?></button>
                            <?php echo adforest_search_params( 'org', 'rd'); ?>
                            </div>
                            </div>
                            </div>
                            
                            
                            
                            </form>
                        </div>
                    </div>
                </div>
            <?php
			}
			?>
               <?php dynamic_sidebar( 'adforest_search_sidebar' ); ?>
            <?php
            if( isset( $adforest_theme['sb_radius_search'] ) && $adforest_theme['sb_radius_search'] )
			{
               echo '</div></div>';
			}
	if( $GLOBALS['widget_counter'] > $adforest_theme['search_widget_limit'] )
	{
		echo '</div>';
	}
            if( isset( $adforest_theme['sb_radius_search'] ) && !$adforest_theme['sb_radius_search'] )
			{
              // echo '</div></div>';
			}
?>

            </div> <!-- end .filtes-with-maps -->
            <?php if ( $results->have_posts() ) { ?>
            <div class="ads-listing-history">
            <p class="results">
				<?php echo esc_html( $results->found_posts ) . ' ' . __('Results', 'adforest' ); ?> - 
                 <a href="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>"><?php echo __('Reset', 'adforest' ); ?></a>
            </p>
            <div class="header-listing">
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
            <?php }  ?>
            <?php get_template_part( 'template-parts/layouts/search/search', 'tags' ); ?>
            <div class="search-with-adss">
                        <div class="clearfix"></div>
					<?php
                    if( isset( $adforest_theme['feature_on_search'] ) && $adforest_theme['feature_on_search'] && $results->have_posts()  )
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
						echo ( '<div class="row">' . $ads->adforest_get_ads_grid_slider( $args, $adforest_theme['feature_ads_title'], 4 ) . '</div>' );
                    }
					
					$marker	= trailingslashit( get_template_directory_uri () ) . 'images/car-marker.png';
					$marker_more	= trailingslashit( get_template_directory_uri () ) . 'images/car-marker-more.png';
					$close_url	= trailingslashit( get_template_directory_uri () ) . 'images/close.gif';
					
					$map_lon	= 39.739236;
					$map_lat	= -104.990251;
					
					if( isset( $adforest_theme['search_map_marker']['url'] ) && $adforest_theme['search_map_marker']['url'] != "" )
					{
					$marker	= $adforest_theme['search_map_marker']['url'];
					}
					
					
					if( isset( $adforest_theme['search_map_marker_more']['url'] ) && $adforest_theme['search_map_marker_more']['url'] != "" )
					{
						$marker_more	= $adforest_theme['search_map_marker_more']['url'];
					}
					
					if( isset( $adforest_theme['search_map_lat'] ) && $adforest_theme['search_map_lat']!= "" && isset( $adforest_theme['search_map_long'] ) && $adforest_theme['search_map_long']!= "" )
					{
						$map_lat	= $adforest_theme['search_map_lat'];
						$map_lon	= $adforest_theme['search_map_long'];
					}
					
					$map_zoom	=	6;
					if( isset( $adforest_theme['search_map_zoom'] ) && $adforest_theme['search_map_zoom'] != "" )
						$map_zoom	=	$adforest_theme['search_map_zoom'];
					
					$map_script .= ' var imageUrl = "'.$marker.'";
					var imageUrl_more	=	"'.$marker_more.'";
					var search_map_lat	=	"'.$map_lat.'";
					var search_map_long	=	"'.$map_lon.'";
					var search_map_zoom	=	'.$map_zoom.';
					var close_url	=	"'.$close_url.'";
					var locations = [';
				if ( $results->have_posts() )
				{
                    if( isset( $adforest_theme['search_ad_720_1'] ) && $adforest_theme['search_ad_720_1'] != "" )
					{
                    ?>
                            <div class="margin-bottom-30 margin-top-10">
                            <?php echo "" . $adforest_theme['search_ad_720_1']; ?>
                            </div>
                   <?php
					}
					?>
                        <div class="clearfix"></div>
					<?php
					$layouts	=	 array( 'list_1', 'list_2', 'list_3' );
					echo '<div class="row">';
					$type = $adforest_theme['search_ad_layout_for_sidebar'];
					$col	= 6;
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
					echo '</div>';
                    
                /* Restore original Post Data */
                wp_reset_postdata();
                ?>
                        <div class="clearfix"></div>
                <?php
				if(isset( $adforest_theme['search_ad_720_2'] ) &&  $adforest_theme['search_ad_720_2'] != "" )
				{
        		?>
                     <div class="margin-top-10 margin-bottom-30">
                     <?php echo "" . $adforest_theme['search_ad_720_2']; ?>
                 </div>
                <?php
				}
				}
				else
				{
					echo '<h2>'. esc_html__('No Result Found.', 'adforest').'</h2>';	
				}
				$map_script .= "];</script>";
			    ?>
            </div>
            
            <div class="clearfix"></div>
            
            <div class="margin-bottom-20 text-center">
                <?php adforest_pagination_search( $results ); ?>
            </div>
            
        </div> <!-- end .inner-content -->
    </div> <!-- end .right-area -->
</div>
<script>
function locationData(adImg,adPrice,isFeatured,categoryLink,categorytitle,adTitle,addLocation,adlink,adTime ){
			return ('<div class="recent-ads"><div class="recent-ads-list"> <div class="recent-ads-container"><div class="recent-ads-list-image"><div class="featured-ribbon"><span>' + isFeatured + '</span></div><a href="' + adlink + '" class="recent-ads-list-image-inner"> <img alt="' + adTitle + '" src="' + adImg + '"></a> </div><div class="recent-ads-list-content"><h3 class="recent-ads-list-title"><a href="' + adlink + '">' + adTitle + '</a></h3><ul class="recent-ads-list-location"><li><a href="javascript:void(0);">' + addLocation + '</a></li></ul><div class="recent-ads-list-price">' + adPrice + ' </div></div></div></div></div>');
        }
		
</script>
<?php echo $map_script; ?>