<?php
 /* Template Name: Ad Search */ 
/**
 * The template for displaying Pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Adforest
 */

?>
<?php get_header(); ?>
<?php global $adforest_theme;
adforest_load_search_countries();
/* Only need on this page so inluded here don't want to increase page size for optimizaion by adding extra scripts in all the web */
wp_enqueue_script( 'google-map-callback');
wp_enqueue_script( 'adforest-search');

	$meta	=	array( 
			'key'     => 'post_id',
			'value'   => '0',
			'compare' => '!=',
	);
	
	// only active ads
	$is_active	=	array(
		'key'     => '_adforest_ad_status_',
		'value'   => 'active',
		'compare' => '=',
	);		

	
	$condition	=	'';
	if( isset( $_GET['condition'] ) && $_GET['condition'] != "" )
	{
		$condition	=	array(
			'key'     => '_adforest_ad_condition',
			'value'   => $_GET['condition'],
			'compare' => '=',
		);	
	}
	$ad_type	=	'';
	if( isset( $_GET['ad_type'] ) && $_GET['ad_type'] != "" )
	{
		$ad_type	=	array(
			'key'     => '_adforest_ad_type',
			'value'   => $_GET['ad_type'],
			'compare' => '=',
		);	
	}
	$warranty	=	'';
	if( isset( $_GET['warranty'] ) && $_GET['warranty'] != "" )
	{
		$warranty	=	array(
			'key'     => '_adforest_ad_warranty',
			'value'   => $_GET['warranty'],
			'compare' => '=',
		);	
	}
	$feature_or_simple	=	'';
	if( isset( $_GET['ad'] ) && $_GET['ad'] != "" )
	{
		$feature_or_simple	=	array(
			'key'     => '_adforest_is_feature',
			'value'   => $_GET['ad'],
			'compare' => '=',
		);	
	}
	$currency	=	'';
	if( isset( $_GET['c'] ) && $_GET['c'] != "" )
	{
		$currency	=	array(
			'key'     => '_adforest_ad_currency',
			'value'   => $_GET['c'],
			'compare' => '=',
		);	
	}
	$price	=	'';
	if( isset( $_GET['min_price'] ) && $_GET['min_price'] != "" )
	{
		$price	=	array(
			'key'     => '_adforest_ad_price',
			'value'   => array( $_GET['min_price'], $_GET['max_price'] ),
			'type'    => 'numeric',
			'compare' => 'BETWEEN',
		);	
	}
	$location	=	'';
	if( isset( $_GET['location'] ) && $_GET['location'] != "" )
	{
		$location	=	array(
			'key'     => '_adforest_ad_location',
			'value'   => trim( $_GET['location'] ),
			'compare' => 'LIKE',
		);	
	}
	
//Location
 $countries_location = '';
 if( isset( $_GET['country_id'] ) && $_GET['country_id'] != ""  )
 {
  $countries_location = array(
   array(
   'taxonomy' => 'ad_country',
   'field'    => 'term_id',
   'terms'    => $_GET['country_id'],
   ),
  ); 
 }
	
$order	=	'desc';
$orderBy = 'ID';
if( isset( $_GET['sort'] ) && $_GET['sort'] != "" )
	{
		$orde_arr	= explode('-', $_GET['sort']);
		$order		=	isset($orde_arr[1]) ? $orde_arr[1] : 'desc';
		
		if(isset($orde_arr[0]) && $orde_arr[0] == 'price')
		{
					
			$orderBy = 'meta_value_num';
		}
		else
		{
			$orderBy	=	isset($orde_arr[0]) ? $orde_arr[0] : 'ID';	
		}
		
	}	
	
	
	$category	=	'';
	if( isset( $_GET['cat_id'] ) && $_GET['cat_id'] != ""  )
	{
		$category	=	array(
			array(
			'taxonomy' => 'ad_cats',
			'field'    => 'term_id',
			'terms'    => $_GET['cat_id'],
			),
		);	
	}
	
	$title	=	'';
	if( isset( $_GET['ad_title'] ) && $_GET['ad_title'] != "" )
	{
		$title	=	$_GET['ad_title'];
	}

	$custom_search = array();
	if( isset( $_GET['custom'] ) )
	{
		foreach($_GET['custom'] as $key => $val)
		{
			if( is_array($val) )
			{
				$arr = array();
				$metaKey = '_adforest_tpl_field_'.$key;
				
				foreach ($val as $v)
				{ 
				
					 $custom_search[] = array(
					  'key'     => $metaKey,
					  'value'   => $v,
					  'compare' => 'LIKE',
					 ); 
				}
			}
			else
			{
				if(trim( $val ) == "0" ) { continue; }
				
				$val =  stripslashes_deep($val);
				
				$metaKey = '_adforest_tpl_field_'.$key;
				$custom_search[] = array(
				 'key'     => $metaKey,
				 'value'   => $val,
				 'compare' => 'LIKE',
				);     
			}
   		}
	}

if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} else if ( get_query_var( 'page' ) ) {
	// This will occur if on front page.
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}
	$args	=	array(
	's' => $title,
	'post_type' => 'ad_post',
	'post_status' => 'publish',
	'posts_per_page' => get_option( 'posts_per_page' ),
	'tax_query' => array(
		$category,
		$countries_location,
	),
	'meta_key' => '_adforest_ad_price',
	'meta_query' => array(
		$is_active,
		$condition,
		$ad_type,
		$warranty,
		$feature_or_simple,
		$price,
		$location,
		$custom_search,
	),
	'order'=> $order,
	'orderby' => $orderBy,
	'paged' => $paged,
);
$results = new WP_Query( $args );

$left_col	=	'col-md-8 col-md-push-4 col-lg-8 col-sx-12';
if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
{
	$left_col	=	'col-md-9 col-md-push-3 col-lg-9 col-sx-12';
}
$search_layout = 'sidebar';
if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && isset( $adforest_theme['search_design'] ) && $adforest_theme['search_design'] != '' )
{
	$search_layout	=	$adforest_theme['search_design'];
}
$GLOBALS['widget_counter']	=	0;
require trailingslashit( get_template_directory () ) . 'template-parts/layouts/search/search-' . $search_layout . '.php';
?>
<div class="panel panel-default my_panel">
    <div class="search-modal modal fade cats_model" id="cat_modal" tabindex="-1" role="dialog" aria-hidden="true">
                 <div class="modal-dialog">
                    <div class="modal-content">
                       <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&#10005;</span><span class="sr-only">Close</span></button>
                          <h3 class="modal-title text-center" id="lineModalLabel"> 
                          <i class="icon-gears"></i> 
                          <?php echo __( 'Select Any Category', 'adforest' ); ?> 
                          </h3>
                       </div>
                       <div class="modal-body">
                          <!-- content goes here -->
                          <div class="search-block">
							<div class="row">

							</div>
							<div class="row">
								<div class="col-md-12 col-xs-12 col-sm-12 popular-search" id="cats_response">

								</div>
							</div>

                          </div>
                       </div>
                       <div class="modal-footer">
                                <button type="submit" id="ad-search-btn" class="btn btn-lg btn-block"><?php echo __('Submit', 'adforest' ); ?></button>
                        </div>
                    </div>
                 </div>
              </div>
</div>

<div class="search-modal modal fade states_model" id="states_model" tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&#10005;</span><span class="sr-only">Close</span></button>
                              <h3 class="modal-title text-center"> 
                              <i class="icon-gears"></i> 
                              <?php echo esc_html__( 'Select Your Location', 'adforest' ); ?> 
                              </h3>
                           </div>
                           <div class="modal-body">
                              <!-- content goes here -->
                              <div class="search-block">
                                   <div class="row">
                                     <div class="col-md-12 col-xs-12 col-sm-12 popular-search" id="countries_response"></div>
                                   </div>
          </div>
                           </div>
                           <div class="modal-footer">
                                    <button type="submit" id="country-btn" class="btn btn-lg btn-block"> <?php echo esc_html__( 'Submit', 'adforest' ); ?> </button>
                                 </div>
                        </div>
                     </div>
                  </div>
<!--footer section-->
<?php get_footer(); ?>