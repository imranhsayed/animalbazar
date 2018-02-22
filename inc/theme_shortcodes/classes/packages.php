<?php
if (! class_exists ( 'packages' )) {
class packages
{
	// user object
	var $obj;
	
	public function __construct()
	{
		
	}
	
	function adforest_get_packages_style_1( $args, $cols = 4 )
	{
		
		$html	=	'';
		$packages = new WP_Query( $args );
		if ( $packages->have_posts() )
		{
			while ( $packages->have_posts() )
			{
				$packages->the_post();
				$product	=	new WC_Product( get_the_ID() );
				$cls	=	'block';
				if( get_post_meta( get_the_ID(), 'package_bg_color', true ) == 'dark' )
					$cls	=	'block featured';
					
				$li	=	'';
				if( get_post_meta( get_the_ID(), 'package_expiry_days', true ) == "-1" )
				{
					$li.= '<li>'.__('Validity','adforest').': ' . __('Lifetime','adforest').'</li>';
				}
				else if( get_post_meta( get_the_ID(), 'package_expiry_days', true ) != "" )
				{
					$li.= '<li>'.__('Validity','adforest').': '.get_post_meta( get_the_ID(), 'package_expiry_days', true ) . ' ' . __('Days','adforest').'</li>';
				}
				
				if( get_post_meta( get_the_ID(), 'package_free_ads', true ) != "" )
					$li .= '<li>'.__('Ads','adforest').': '.get_post_meta( get_the_ID(), 'package_free_ads', true ) .'</li>';
				if( get_post_meta( get_the_ID(), 'package_featured_ads', true ) != "" )
					$li .= '<li>'.__('Featured Ads','adforest').': '.get_post_meta( get_the_ID(), 'package_featured_ads', true ) .'</li>';
				
				$html	.=	'<div class="col-sm-6 col-lg-'.esc_attr( $cols ).' col-md-'.esc_attr( $cols ).'">
                           <div class="'.$cls.'">
                              <h3>'.get_the_title().'</h3>
                              <span class="price">'.get_woocommerce_currency_symbol() .$product->get_price().'</span>
                              <ul>
                                 '.$li.'
                              </ul>
                              <a href="javascript:void(0);" class="btn btn-theme sb_add_cart" data-product-id="'.get_the_ID().'" data-product-qty="1">'.__('Add to Cart','adforest' ).' <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                           </div>
                        </div>';		
				
			}
			wp_reset_postdata();	
		}
		return '      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Pricing =-=-=-=-=-=-= -->
         <section class="padding-top-40 bg-white">
            <!-- Main Container -->
            <div>
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Box -->
                  <div class="col-md-12 col-xs-12 col-sm-12">
                     <div class="pricing">
					 	'.$html.'
                     </div>
                  </div>
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
					 ';
	
	}
}
}


?>