<div class="panel panel-default">
          <!-- Heading -->
          <div class="panel-heading" role="tab" id="location_heading">
             <!-- Title -->
             <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#ad-location" aria-expanded="true" aria-controls="collapseOne">
                <i class="more-less glyphicon glyphicon-plus"></i>
                <?php echo esc_html( $instance['title'] ); ?>
                </a>
             </h4>
             <!-- Title End -->
          </div>
          <!-- Content -->
<form method="get" id="search_countries" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>">
          <div id="ad-location" class="panel-collapse collapse <?php echo esc_attr( $expand ); ?>" role="tabpanel" aria-labelledby="headingOne">
          
          <?php
		  $ad_country	=	adforest_get_cats('ad_country' , 0 );
		  if( count( $ad_country ) > 0 )
		  {
		  ?>
             <div class="panel-body countries">
             	<?php 
				if( isset( $_GET['country_id'] ) && $_GET['country_id'] != "" )
				{
					echo adforest_get_taxonomy_parents( $_GET['country_id'], 'ad_country', false);
				}
				?>
                <ul>
                <?php
					foreach( $ad_country as $country )
					{
						$category = get_term($country->term_id);
						$count = $category->count;
						$cat_meta	=	 get_option( "taxonomy_term_$country->term_id" );
						
				?>
                   <li> 
                   	<a href="javascript:void(0);"  data-country-id="<?php echo esc_attr( $country->term_id ); ?>">
					<?php echo esc_html( $country->name ); ?> 
                    <span>(<?php echo esc_html( $count ); ?>)</span>
                    </a>
                   </li>
                <?php
					}
				?>
                </ul>	
             </div>
          <?php
		  }
		  ?>
          </div>
     <input type="hidden" name="country_id" id="country_id" value="" />
    <?php echo adforest_search_params( 'country_id' ); ?>
  </form>
  
       </div>