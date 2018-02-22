<?php
if (! class_exists ( 'ads' )) {
class ads
{
// user object
var $obj;

public function __construct()
{
	
}
function adforest_get_ads_grid($args, $paged, $show_pagination = 0, $fav_ads )
{
	$my_ads	=	'';
	global $adforest_theme;
	
	$cols = 4;
	if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
		$cols	=	4;
	
	$flip_it = '';
	$ribbion = 'featured-ribbon';
	if ( is_rtl() )
	{
		$flip_it = 'flip';
		$ribbion = 'featured-ribbon-rtl';
	}
	
	$ads = new WP_Query( $args );
	if ( $ads->have_posts() ) {
		$number	= 0;
		while ( $ads->have_posts() ) {
			$ads->the_post();
			
			$pid	=	get_the_ID();
		$status	=	get_post_meta(get_the_ID(), '_adforest_ad_status_', true );
		$status = adforest_ad_statues($status);
		
		if( $status == '' )
		{
			$status = adforest_ad_statues('active');
		}
			$cats_html	=	adforest_display_cats( $pid );
		$messages	=	'';
		if( $fav_ads == 'no' )
		{
			if( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )
			{
	

						$messages = '<div class="notification msgs get_msgs" ad_msg='.$pid.'>
                                    <a class="round-btn" href="javascript:void(0);"><i class="fa fa-envelope-o"></i></a>
                                    <span>'.$this->adforest_count_ad_messages( $pid ).'</span>
                     </div>';
			}
		}
		
		$outer_html	=	'';
		$media	=	 adforest_get_ad_images($pid);
		if( count( $media ) > 0 )
		{
			$counting	=	1;
			foreach( $media as $m )
			{
				if( $counting > 1 )
					break;
					
					$mid	=	'';
					if ( isset( $m->ID ) )
						$mid	= 	$m->ID;
					else
						$mid	=	$m;
				$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
				$outer_html = '<div class="image"><div class="ribbon '.adforest_ads_status_color( get_post_meta(get_the_ID() , '_adforest_ad_status_', true )).'">'.$status.'</div>
				<img src="'.$image[0].'" alt="'.get_the_title().'" class="img-responsive"> </div>';
				$counting++;
			}
	
		}
		else
		{
			$outer_html = '<div class="image"><div class="ribbon '.adforest_ads_status_color( get_post_meta(get_the_ID() , '_adforest_ad_status_', true )).'">'.$status.'</div>
					<img src="'.$adforest_theme['default_related_image']['url'].'" alt="'.get_the_title().'" class="img-responsive"></div>';
		}
		
		if( $fav_ads == 'no' )
		{
									
		$ad_status	=	'<select class="ad_status category form-control"  adid="'.get_the_ID().'"><option value="">'.__('Post Status','adforest' ).'</option>';
			if( get_post_meta(get_the_ID(), '_adforest_ad_status_', true ) == 'expired' )
			{
				$ad_status	.=	'<option value="expired" selected>'.adforest_ad_statues('expired').'</option>';
			}
			else
			{
				$ad_status	.=	'<option value="expired">'.adforest_ad_statues('expired').'</option>';
			}
			if( get_post_meta(get_the_ID(), '_adforest_ad_status_', true ) == 'sold' )
			{
				$ad_status	.=	'<option value="sold" selected>'.adforest_ad_statues('sold').'</option>';
			}
			else
			{
				$ad_status	.=	'<option value="sold">'.adforest_ad_statues('sold').'</option>';
			}
			if( get_post_meta(get_the_ID(), '_adforest_ad_status_', true ) == 'active' )
			{
				$ad_status	.=	'<option value="active" selected>'.adforest_ad_statues('active').'</option>';
			}
			else
			{
				$ad_status	.=	'<option value="active">'.adforest_ad_statues('active').'</option>';
			}
		$ad_status	.=	'</select>';
		
			$my_url = adforest_get_current_url();
			if (strpos($my_url, 'adforest.scriptsbundle.com') !== false) {
		$edit	=	'<li><a data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Edit Disable for Demo', 'adforest' ) .'" href="javascript:void(0);"><i class="fa fa-pencil edit"></i></a> </li>';
			}
			else
			{
		$edit	=	'<li><a data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Edit this Ad', 'adforest' ) .'" href="'.get_the_permalink( $adforest_theme['sb_post_ad_page'] ) . '?id=' . get_the_ID() .'"><i class="fa fa-pencil edit"></i></a> </li>';
			}
								   
			if (strpos($my_url, 'adforest.scriptsbundle.com') !== false) {
				$delete	=	'<li>
									   <a  href="javascript:void(0);"  data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Delete Disable for Demo', 'adforest' ) .'"  >
									   <i class="fa fa-times delete"></i>
									   </a>
									   </li>';
			}
			else
			{
			$delete	=	'<li>
									   <a  href="javascript:void(0);" data-adid="'.get_the_ID().'" class="remove_ad" data-btn-ok-label="'.__('Yes','adforest').'" data-btn-cancel-label="'.__('No','adforest').'" data-toggle="confirmation" data-singleton="true" data-title="'.__('Are you sure?', 'adforest' ) .'" data-content=""  >
									   <i class="fa fa-times delete"></i>
									   </a>
									   </li>';
			}
		}
		else
		{
			$my_url = adforest_get_current_url();
			if (strpos($my_url, 'adforest.scriptsbundle.com') !== false)
			{
				$remove	=	'<li style="margin-right:39px;">
								   <a  href="javascript:void(0);"  data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Delete Disable for Demo', 'adforest' ) .'"  >
								   <i class="fa fa-times delete"></i>
								   </a>
								   </li><li></li>';
			}
			else
			{
				$remove	=	'<li style="margin-right:39px;">
								   <a data-btn-ok-label="'.__('Yes','adforest').'" data-btn-cancel-label="'.__('No','adforest').'"  data-toggle="confirmation" data-singleton="true" data-title="'.__('Are you sure?', 'adforest' ) .'" data-content="" href="javascript:void(0);" data-adid="'.get_the_ID().'" class="remove_fav_ad" >
								   <i class="fa fa-times delete"></i>
								   </a>
								   </li><li></li>';
			}
		}
	
			$my_ads .= '<div class="col-md-'.esc_attr($cols).' col-lg-'.esc_attr($cols).' col-sm-6 col-xs-12" id="holder-'.get_the_ID().'">
						  <div class="white category-grid-box-1 ">
						  '.adforest_video_icon().'
							 <!-- Image Box -->
									 '.$outer_html.'
							 <!-- Short Description -->
							 <div class="short-description-1 ">
							 	'.$messages.'
								<!-- Category Title -->
								<div class="category-title"> '.$cats_html.' </div>
								<!-- Ad Title -->
								<h3>
								   <a title="" href="'.get_the_permalink().'">'.get_the_title().'</a>
								</h3>
								<!-- Location -->
								<p class="location"><i class="fa fa-map-marker"></i> '.get_post_meta(get_the_ID(), '_adforest_ad_location', true ).'</p>
									   

								 <!-- Price -->
								 
								 <span class="ad-price">'. adforest_adPrice(get_the_ID()).'</span> 
								 '.$ad_status.'
							 </div>
							 <!-- Ad Meta Stats -->
							 <div class="ad-info-1">
								<ul class="pull-left '.esc_attr( $flip_it ).'">
								   <li> <i class="fa fa-eye"></i><a href="javascript:void(0);">'.adforest_getPostViews( get_the_ID() ) .'</a> </li>
								   <li> <i class="fa fa-clock-o"></i>'. get_the_date(get_option( 'date_format' ), get_the_ID() ).'</li>
								</ul>
								<ul class="pull-right '.esc_attr( $flip_it ).'">
								   '.$delete.'
								   '.$edit.'
								   '.$remove.'
								</ul>
							 </div>
						  </div>
					   </div>';
					   
		}
		wp_reset_postdata();
	}
	else
	{
		$my_ads	=	get_template_part( 'template-parts/content', 'none' );
	}
	$load_more	=	'';
	if( $show_pagination == 1 )
	{
		$load_more	=	$this->adforest_get_pages( $paged, $ads->max_num_pages, $fav_ads );
	}

		return '
       <!-- Row -->
       <div class="row">
          <!-- Middle Content Area -->
          <div class="col-md-12 col-sm-12 col-xs-12">
             <!-- Row -->
             <div class="row">
                <!-- Sorting Filters -->
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                   <!-- Sorting Filters Breadcrumb -->
                   <!-- Sorting Filters Breadcrumb End -->
                </div>
                <!-- Sorting Filters End-->
                <div class="clearfix"></div>
                <!-- Ads Archive 3 -->
                <div class="posts-masonry">
					' . $my_ads . '                   
                </div>
                <!-- Ads Archive End -->  
                <div class="clearfix"></div>
                <!-- Pagination -->  
                <div class="col-md-12 col-xs-12 col-sm-12">
                   '.$load_more.'
                </div>
                <!-- Pagination End -->   
             </div>
             <!-- Row End -->
          </div>
          <!-- Middle Content Area  End -->
       </div>
       <!-- Row End -->
	<input type="hidden" id="max_pages" value="'.$ads->max_num_pages.'" />
';
}
function adforest_get_ads_grid_inactive($args, $paged, $show_pagination = 0, $fav_ads )
{
	$my_ads	=	'';
	global $adforest_theme;
	
	$flip_it = '';
	$ribbion = 'featured-ribbon';
	if ( is_rtl() )
	{
		$flip_it = 'flip';
		$ribbion = 'featured-ribbon-rtl';
	}
	
	$ads = new WP_Query( $args );
	if ( $ads->have_posts() ) {
		$number	= 0;
		while ( $ads->have_posts() ) {
			$ads->the_post();
			
			$pid	=	get_the_ID();
		$status	=	get_post_meta(get_the_ID(), '_adforest_ad_status_', true );
		$status = adforest_ad_statues($status);
		
		if( $status == '' )
		{
			$status = adforest_ad_statues('active');
		}
			$cats_html	=	adforest_display_cats( $pid );
		$messages	=	'';
		if( $fav_ads == 'no' )
		{
			if( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )
			{
	
			$messages = '<div class="message-box get_msgs" ad_msg='.$pid.'>
						<div class="message"><span>
							<i class="fa fa-envelope"></i><small>'.$this->adforest_count_ad_messages( $pid ).'</small>
							</span></div>
						</div>';
			}
		}
		
		$outer_html	=	'';
		$media	=	 adforest_get_ad_images($pid);
		if( count( $media ) > 0 )
		{
			$counting	=	1;
			foreach( $media as $m )
			{
				if( $counting > 1 )
					break;
					
				$mid	=	'';
						if ( isset( $m->ID ) )
							$mid	= 	$m->ID;
						else
							$mid	=	$m;	
				$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
				$outer_html = '<div class="image">
				<img src="'.$image[0].'" alt="'.get_the_title().'" class="img-responsive"> ' .$messages. '
				</div>';
				$counting++;
			}
	
		}
		else
		{
			$outer_html = '<div class="image">
					<img src="'.$adforest_theme['default_related_image']['url'].'" alt="'.get_the_title().'" class="img-responsive">
                                       ' .$messages. '
					</div>';
		}
		
			$my_ads .= '<div class="col-md-4 col-lg-4 col-sm-6 col-xs-12" id="holder-'.get_the_ID().'">
						  <div class="white category-grid-box-1 ">
							 <!-- Image Box -->
									 '.$outer_html.'
							 <!-- Short Description -->
							 <div class="short-description-1 ">
								<!-- Category Title -->
								<div class="category-title"> '.$cats_html.' </div>
								<!-- Ad Title -->
								<h3>
								   <a title="" href="'.get_the_permalink().'">'.get_the_title().'</a>
								</h3>
								<!-- Location -->
								<p class="location"><i class="fa fa-map-marker"></i> '.get_post_meta(get_the_ID(), '_adforest_ad_location', true ).'</p>
								<div class="rating">
                                       <span class="rating-count">
									   '.$ad_status.'
									   </span>
                                      
                                    </div>

								 <!-- Price -->
								 
								 <span class="ad-price">'. adforest_adPrice(get_the_ID()).'</span> 
							 </div>
							 <!-- Ad Meta Stats -->
							 <div class="ad-info-1">
								<ul class="pull-left '.esc_attr( $flip_it ).'">
								   <li> <i class="fa fa-eye"></i><a href="javascript:void(0);">'.adforest_getPostViews( get_the_ID() ) .' ' . __('Views', 'adforest' ).'</a> </li>
								   <li> <i class="fa fa-clock-o"></i>'. get_the_date(get_option( 'date_format' ), get_the_ID() ).'</li>
								</ul>
								<ul class="pull-right '.esc_attr( $flip_it ).'">
								</ul>
							 </div>
						  </div>
					   </div>';
					   
		}
		wp_reset_postdata();
	}
	else
	{
		$my_ads	=	get_template_part( 'template-parts/content', 'none' );
		return '';
	}
	$load_more	=	'';
	if( $show_pagination == 1 )
	{
		$load_more	=	$this->adforest_get_pages( $paged, $ads->max_num_pages, $fav_ads );
	}

		return '
          <!-- Middle Content Area -->
          <div class="col-md-12 col-sm-12 col-xs-12">
		  <div class="row">
	   <div role="alert" class="alert alert-info alert-dismissible '.adforest_alert_type().'">
<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
<strong>'. __('Info','adforest') . '</strong> - 
'. __('Waiting for admin approval.','adforest') .'
             </div>
             <!-- Row -->
             <div class="row">
                <!-- Sorting Filters -->
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                   <!-- Sorting Filters Breadcrumb -->
                   <!-- Sorting Filters Breadcrumb End -->
                </div>
                <!-- Sorting Filters End-->
                <div class="clearfix"></div>
                <!-- Ads Archive 4 -->
                <div class="posts-masonry">
					' . $my_ads . '                   
                </div>
                <!-- Ads Archive End -->  
                <div class="clearfix"></div>
                <!-- Pagination -->  
                <div class="col-md-12 col-xs-12 col-sm-12">
                   '.$load_more.'
                </div>
                <!-- Pagination End -->   
             </div>
             <!-- Row End -->
          </div>
          <!-- Middle Content Area  End -->
       </div>
       <!-- Row End -->
	<input type="hidden" id="max_pages" value="'.$ads->max_num_pages.'" />';
}
function adforest_get_featured_ads_grid($args, $paged, $show_pagination = 0, $fav_ads )
{
	$my_ads	=	'';
	global $adforest_theme;
	
	$colors	=array( 'active' => 'status_active', 'expired' => 'status_expired', 'sold' => 'status_sold' );
	
	$flip_it = '';
	$ribbion = 'featured-ribbon';
	if ( is_rtl() )
	{
		$flip_it = 'flip';
		$ribbion = 'featured-ribbon-rtl';
	}

	
	$ads = new WP_Query( $args );
	if ( $ads->have_posts() ) {
		$number	= 0;
		while ( $ads->have_posts() ) {
			$ads->the_post();
			
			$pid	=	get_the_ID();

			adforest_display_cats( $pid );
		$messages	=	'';
		if( $fav_ads == 'no' )
		{
			if( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )
			{
	
						$messages = '<div class="notification msgs get_msgs" ad_msg='.$pid.'>
                                    <a class="round-btn" href="javascript:void(0);"><i class="fa fa-envelope-o"></i></a>
                                    <span>'.$this->adforest_count_ad_messages( $pid ).'</span>
                     </div>';
			}
		}
		
		$outer_html	=	'';
		$media	=	 adforest_get_ad_images($pid);
		if( count( $media ) > 0 )
		{
			$counting	=	1;
			foreach( $media as $m )
			{
				if( $counting > 1 )
					break;
					
					$mid	=	'';
					if ( isset( $m->ID ) )
						$mid	= 	$m->ID;
					else
						$mid	=	$m;	
						$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
				$outer_html = '<div class="image">
				<img src="'.$image[0].'" alt="'.get_the_title().'" class="img-responsive"></div>';
				$counting++;
			}
	
		}
		else
		{
			$outer_html = '<div class="image">
					<img src="'.$adforest_theme['default_related_image']['url'].'" alt="'.get_the_title().'" class="img-responsive">
					</div>';
		}
		if( $fav_ads == 'no' )
		{
		$edit	=	'<li>
								   <a data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Edit this Ad', 'adforest' ) .'" href="'.get_the_permalink( $adforest_theme['sb_post_ad_page'] ) . '?id=' . get_the_ID() .'"><i class="fa fa-pencil edit"></i></a> 
								   </li>';
		$delete	=	'<li>
								   <a  href="javascript:void(0);" data-adid="'.get_the_ID().'" class="remove_ad" data-btn-ok-label="'.__('Yes','adforest').'" data-btn-cancel-label="'.__('No','adforest').'" data-toggle="confirmation" data-singleton="true" data-title="'.__('Are you sure?', 'adforest' ) .'" data-content=""  >
								   <i class="fa fa-times delete"></i>
								   </a>
				
				
								   </li>';
		}
		
		$is_feature	=	'';
		if( get_post_meta( $pid, '_adforest_is_feature', true ) == '1' )
		{
			$is_feature	=	'<div class="'.esc_attr( $ribbion ).'">
			  <span>'.__('Featured','adforest').'</span>
		   </div>';
		}

	
			$my_ads .= '<div class="col-md-4 col-lg-4 col-sm-6 col-xs-12" id="holder-'.get_the_ID().'">
						  <div class="white category-grid-box-1 ">
						  '.adforest_video_icon().'
							 <!-- Image Box -->
							 '.$is_feature.'
									 '.$outer_html.'
							 <!-- Short Description -->
							 <div class="short-description-1 ">
							 '.$messages.'
								<!-- Category Title -->
								<div class="category-title"> '.$cats_html.' </div>
								<!-- Ad Title -->
								<h3>
								   <a title="javascript:void(0);" href="'.get_the_permalink().'">'.get_the_title().'</a>
								</h3>
								<!-- Location -->
								<p class="location"><i class="fa fa-map-marker"></i> '.get_post_meta(get_the_ID(), '_adforest_ad_location', true ).'</p>
								<div class="rating">
                                       <span class="rating-count">
									   '.$ad_status.'
									   </span>
                                      
                                    </div>

								 <!-- Price -->
								 
								 <span class="ad-price">'. adforest_adPrice(get_the_ID()).'</span> 
							 </div>
							 <!-- Ad Meta Stats -->
							 <div class="ad-info-1">
								<ul class="pull-left '.esc_attr( $flip_it ).'">
								   <li> <i class="fa fa-eye"></i><a href="javascript:void(0);">'.adforest_getPostViews( get_the_ID() ) .' ' . __('Views', 'adforest' ).'</a> </li>
								   <li> <i class="fa fa-clock-o"></i>'. get_the_date(get_option( 'date_format' ), get_the_ID() ).'</li>
								</ul>
								<ul class="pull-right '.esc_attr( $flip_it ).'">
								   '.$delete.'
								   '.$edit.'
								   '.$remove.'
								</ul>
							 </div>
						  </div>
					   </div>';
					   
		}
		wp_reset_postdata();
	}
	else
	{
		$my_ads	=	get_template_part( 'template-parts/content', 'none' );
	}
	$load_more	=	'';
	if( $show_pagination == 1 )
	{
		$load_more	=	$this->adforest_get_pages( $paged, $ads->max_num_pages, $fav_ads );
	}

		return '<div class="row">
          <!-- Middle Content Area -->
          <div class="col-md-12 col-sm-12 col-xs-12">
             <!-- Row -->
             <div class="row">
                <!-- Sorting Filters -->
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                   <!-- Sorting Filters Breadcrumb -->
                   <!-- Sorting Filters Breadcrumb End -->
                </div>
                <!-- Sorting Filters End-->
                <div class="clearfix"></div>
                <!-- Ads Archive 5 -->
                <div class="posts-masonry">
					' . $my_ads . '                   
                </div>
                <!-- Ads Archive End -->  
                <div class="clearfix"></div>
                <!-- Pagination -->  
                <div class="col-md-12 col-xs-12 col-sm-12">
                   '.$load_more.'
                </div>
                <!-- Pagination End -->   
             </div>
             <!-- Row End -->
          </div>
          <!-- Middle Content Area  End -->
       </div>
       <!-- Row End -->
	<input type="hidden" id="max_pages" value="'.$ads->max_num_pages.'" />';
}

function adforest_get_ads_grid_slider($args, $title, $col = 12, $css_class = '' )
{
	
	$my_ads	=	'';
	global $adforest_theme;
	
	$flip_it = '';
	$ribbion = 'featured-ribbon';
	if ( is_rtl() )
	{
		$flip_it = 'flip';
		$ribbion = 'featured-ribbon-rtl';
	}
	
	$ads = new WP_Query( $args );
	if ( $ads->have_posts() ) {
		$number	= 0;
		while ( $ads->have_posts() ) {
			$ads->the_post();
			
			$pid	=	get_the_ID();
			$cats_html	=	adforest_display_cats( $pid );
		$outer_html	=	'';
		$media	=	 adforest_get_ad_images($pid);
		if( count( $media ) > 0 )
		{
			$counting	=	1;
			foreach( $media as $m )
			{
				if( $counting > 1 )
					break;
					
					$mid	=	'';
					if ( isset( $m->ID ) )
						$mid	= 	$m->ID;
					else
						$mid	=	$m;
					$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
				$outer_html = '<div class="image">
				<a title="" href="'.get_the_permalink().'"><img src="'.$image[0].'" alt="'.get_the_title().'" class="img-responsive"></a>
				</div>';
				$counting++;
			}
		}
		else
		{
			$outer_html = '<div class="image">
					<a title="" href="'.get_the_permalink().'"><img src="'.$adforest_theme['default_related_image']['url'].'" alt="'.get_the_title().'" class="img-responsive"></a>
					</div>';	
		}
		$is_feature	=	'';
		if( get_post_meta( $pid, '_adforest_is_feature', true ) == '1' )
		{
			$is_feature	=	'<div class="'.esc_attr( $ribbion ).'">
			  <span>'.__('Featured','adforest').'</span>
		   </div>';
		}
	$save_ad	= '';
	if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
	{
	}
	else
	{
	$save_ad	= '<ul class="pull-right '.esc_attr( $flip_it ).'">
								   <li>
								   <a data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Saved Ad', 'adforest' ) .'" href="javascript:void(0);" class="save-ad" data-adid="'.get_the_ID().'"><i class="fa fa-heart-o"></i></a> 
								   </li>

								</ul>';
	}
	$no_padding	=	'';
	if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && is_single('ad_post') )
	{
		$save_ad	= '';
		$no_padding	=	'no-padding';
	}
	else
	{
		if( $css_class	!= "" )
		{
			$no_padding	=	$css_class;	
		}
	}
		
			$my_ads .= '<div class="item"><div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" id="holder-'.get_the_ID().'">
						  <div class="white category-grid-box-1 ">
						  '.adforest_video_icon().'
							 <!-- Image Box -->
							 		'.$is_feature.'
									 '.$outer_html.'
							 <!-- Short Description -->
							 <div class="short-description-1 ">
								<!-- Category Title -->
								<div class="category-title"> '.$cats_html.' </div>
								<!-- Ad Title -->
								<h3>
								   <a title="" href="'.get_the_permalink().'">'.get_the_title().'</a>
								</h3>
								<!-- Location -->
								<p class="location"><i class="fa fa-map-marker"></i> '.get_post_meta(get_the_ID(), '_adforest_ad_location', true ).'</p>
								<!-- Rating -->
								 <!-- Price -->
								 
								 <span class="ad-price">' .  adforest_adPrice(get_the_ID()).'</span> 
							 </div>
							 <!-- Ad Meta Stats -->
							 <div class="ad-info-1">
								<ul class="pull-left '.esc_attr( $flip_it ).'">
								   <li> <i class="fa fa-eye"></i><a href="javascript:void(0);">'.adforest_getPostViews( get_the_ID() ) .' ' . __('Views', 'adforest' ).'</a> </li>
								   <li> <i class="fa fa-clock-o"></i>'. get_the_date(get_option( 'date_format' ), get_the_ID() ).'</li>
								</ul>
								'.$save_ad.'
							 </div>
						  </div>
					   </div>
					   </div>';
					   
					/*   <li>
								   <a  data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('View Ad', 'adforest' ) .'" href="'.get_permalink( get_the_ID() ).'">
								   <i class="fa fa-search"></i>
								   </a>
								   </li>*/
					   

		}
		wp_reset_postdata();
	}
		if( $my_ads == '' )
		{
			return '';	
		}

		return '<div class="col-xs-12 col-md-12 col-sm-12 margin-bottom-30 '.esc_attr($no_padding).'"><div class="grid-card">
<div class="heading-panel">
<div class="col-xs-12 col-md-12 col-sm-12">
<h3 class="main-title text-left">
'.$title.'
</h3>
</div>
</div>
<div class="featured-slider-1 owl-carousel owl-theme">
	'.$my_ads.'
</div>
</div>
</div>
';
}

function adforest_get_ads_list_style( $args, $title )
{
	global $adforest_theme;
		$html 	=	'';
		$cats	=	'';
        $ads = new WP_Query( $args );
		if( $ads->have_posts() )
		{
			while( $ads->have_posts() ) 
			{  $ads->the_post();
				$media	=	 adforest_get_ad_images($pid);
				$img	=	$adforest_theme['default_related_image']['url'];
				$pid = get_the_ID();
				if( count( $media ) > 0 )
				{
					foreach( $media as $m )
					{
						$mid	=	'';
						if ( isset( $m->ID ) )
							$mid	= 	$m->ID;
						else
							$mid	=	$m;
						
						$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
						$img	=	$image[0];
						break;
					}
				}
				$cats =	adforest_display_cats( $pid );
		$condition_html	= '';
	if( isset( $adforest_theme['allow_tax_condition'] ) && $adforest_theme['allow_tax_condition'] && get_post_meta(get_the_ID(), '_adforest_ad_condition', true ) != "" )
	{			
		$condition_html = '<li>
							 <div class="custom-tooltip tooltip-effect-4">
								<span class="tooltip-item"><i class="fa fa-cog"></i></span>
								<div class="tooltip-content"> 
								<strong>'.__('Condition','adforest').'</strong>
								<span class="label label-danger">
								'.get_post_meta(get_the_ID(), '_adforest_ad_condition', true ).'
								</span>
								</div>
							 </div>
						  </li>';
	}
	$ad_type_html = '';
	if( get_post_meta(get_the_ID(), '_adforest_ad_type', true ) != "" )
	{			
	$ad_type_html = '<li>
							 <div class="custom-tooltip tooltip-effect-4">
								<span class="tooltip-item"><i class="fa fa-check-square-o"></i></span>
								<div class="tooltip-content"> <strong>'.__('Type','adforest').'</strong> <span class="label label-danger">'.get_post_meta(get_the_ID(), '_adforest_ad_type', true ).'</span> </div>
							 </div>
						  </li>';
	}
	
	$poster_contact	=	'';
	if( get_post_meta(get_the_ID(), '_adforest_poster_contact', true ) != "" && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'phone' ) )
	{
		$poster_contact	=	' <li>
							 <div class="custom-tooltip tooltip-effect-4">
								<span class="tooltip-item"><i class="fa fa-phone"></i></span>
								<div class="tooltip-content">
								   <h4>'.__('Contact','adforest').'</h4>
								   '.get_post_meta(get_the_ID(), '_adforest_poster_contact', true ).' 
								</div>
							 </div>
							 
							 
						  </li>';
	}

	
			 $html 	.=	'<div class="ads-list-archive">
				 <!-- Image Block -->
				 <div class="col-lg-5 col-md-5 col-sm-5 no-padding">
					<!-- Img Block -->
					<div class="ad-archive-img">
					   <a href="'.get_permalink( get_the_ID() ).'">
						  <!--<div class="ribbon popular"></div>-->
						  <img class="img-responsive"  src="'.esc_url( $img ).'" alt="'.get_the_title().'"> 
					   </a>
					</div>
					<!-- Img Block -->
				 </div>
				 <!-- Ads Listing -->
				 <div class="clearfix visible-xs-block"></div>
				 <!-- Content Block -->
				 <div class="col-lg-7 col-md-7 col-sm-7 no-padding">
					<!-- Ad Desc -->
					<div class="ad-archive-desc">
					   <!-- Price -->
					   <div class="ad-price"> '. adforest_adPrice(get_the_ID()).'</div>
					   <!-- Title -->
					   <h3>'.get_the_title( get_the_ID() ).'</h3>
					   <!-- Category -->
					   <div class="category-title"> 
					   <span>
					   '.$cats.'
					   </span> 
					   </div>
					   <!-- Short Description -->
					   <div class="clearfix visible-xs-block"></div>
					   <p class="hidden-sm">'.adforest_words_count( get_the_content( get_the_ID() ),  100).'</p>
					   <!-- Ad Features -->
					   <ul class="add_info">
						  <!-- Contact Details -->
						  '.$poster_contact.'
						  <!-- Address -->
						  <li>
							 <div class="custom-tooltip tooltip-effect-4">
								<span class="tooltip-item"><i class="fa fa-map-marker"></i></span>
								<div class="tooltip-content">
								   <h4>'.__('Address','adforest').'</h4>
								   '.get_post_meta(get_the_ID(), '_adforest_ad_location', true ).'</div>
							 </div>
						  </li>
						  <!-- Ad Type -->
						  '.$condition_html.'
						  <!-- Ad Type -->
						  '.$ad_type_html.'
					   </ul>
					   <!-- Ad History -->
					   <div class="clearfix archive-history">
						  <div class="last-updated">'.get_the_date().'</div>
						  <div class="ad-meta"> <a class="btn save-ad" href="javascript:void(0);" data-adid="'. get_the_ID().'">
						  <i class="fa fa-heart-o"></i> '.__('Add to Favourites','adforest').'
						  </a> 
						  <a class="btn btn-success" href="'.get_permalink( get_the_ID() ).'">
						  '.__('View Details','adforest').'
						  </a>
						  </div>
					   </div>
					</div>
					<!-- Ad Desc End -->
				 </div>
				 <!-- Content Block End -->
			  </div>';
			}
			wp_reset_postdata();
		}
		if( $html == '' )
		{
			return '';	
		}
	
	return '<div class="grid-panel margin-top-30">
    <div class="heading-panel">
    <div class="col-xs-12 col-md-12 col-sm-12">
      <h3 class="main-title text-left">
         '.$title.'
      </h3>
    </div>
</div>
<div class="posts-masonry">
        <div class="col-md-12 col-xs-12 col-sm-12">
			'.$html.'
		</div>
    </div>
</div>
';
}


function adforest_get_pages( $paged,$max_pages, $fav_ads )
{
		$load_more	=	'';
		if( $max_pages > 1 )
		{
			$load_more = ' <ul class="pagination pagination-lg">';
			$p	=	$paged -1;
			if( $paged != 1 )
			{
			$load_more	.= '<li> <a href="javascript:void(0);" page_no="'.$p.'" class="sb_page" ad_type="'.$fav_ads.'"><i class="fa fa-chevron-left" aria-hidden="true"></i></a></li>';
			}
			$class	=	'';
			for( $k=1; $k <= $max_pages; $k++ )
			{
				$class	= '';
				$a_class	=	'';
				if( $k == $paged )
				{
					$class	=	'class="active"';	
				}
				else
				{
					$a_class	=	'class="sb_page"';	
				}
				$load_more	.= '<li '.$class.'> <a href="javascript:void(0);" page_no="'.$k.'" '.$a_class.' ad_type="'.$fav_ads.'">'.$k.'</a></li>';	
			}
			$next =	$paged + 1;
			if( $paged != $max_pages )
			{
			$load_more	.= '<li><a href="javascript:void(0);" page_no="'.$next.'" class="sb_page" ad_type="'.$fav_ads.'"> <i class="fa fa-chevron-right" aria-hidden="true"></i></a>';
			}
			$load_more	.='</ul>';
									  
		}
		return $load_more;
}
function adforest_count_ad_messages( $ad_id )
{
	global $wpdb;
	
	$total = $wpdb->get_var( "SELECT COUNT(DISTINCT(comment_author)) as total FROM $wpdb->comments WHERE comment_post_ID = '$ad_id' AND user_id != '" . get_current_user_id() . "'" );
	return $total;
		
}

function adforest_load_messages( $ad_id )
{
	$script = '<script type="text/javascript">
         jQuery(document).ready(function($){
         "use strict";
         $(\'.message-history\').wrap(\'<div class="list-wrap"></div>\');
         function scrollbar() {
            var $scrollbar = $(\'.message-inbox .list-wrap\');
            $scrollbar.perfectScrollbar({
                maxScrollbarLength: 150,
            });
            $scrollbar.perfectScrollbar(\'update\');
         }
         scrollbar();
         $(\'.messages\').wrap(\'<div class="list-wraps"></div>\');
         function scrollbar1() {
            var $scrollbar1 = $(\'.message-details .list-wraps\');
            $scrollbar1.perfectScrollbar({
                maxScrollbarLength: 150,
            });
            $scrollbar1.perfectScrollbar(\'update\');
         }
          scrollbar1();
         });
      </script>';
	  
	  
	  global $wpdb;
	  
	$rows = $wpdb->get_results( "SELECT comment_author, user_id FROM $wpdb->comments WHERE comment_post_ID = '$ad_id'  GROUP BY user_id ORDER BY MAX(comment_date) DESC" );
	
	  $users	=	'';
	  $messages	=	'';
	  $author_html	=	'';
	  $form	=	'<div class="text-center">'.__('No message received on this ad yet.', 'adforest' ) . '</div>';
	  $turn	=	1;
	  $level_2	=	'';
	  foreach( $rows as $row )
	  {
		  if( get_current_user_id() == $row->user_id )
		  	continue;
		$user_dp =	adforest_get_user_dp( $row->user_id );
		
		  $last_date	=	$wpdb->get_var( "SELECT comment_date FROM $wpdb->comments WHERE comment_post_ID = '$ad_id' AND user_id = '" . $row->user_id . "' AND comment_type = 'ad_post' ORDER BY comment_date DESC LIMIT 1" );
		  $date	=	explode( ' ', $last_date );
		  $cls	=	'';
		  if( $turn == 1 )
		  		$cls	=	'message-history-active';
				
			$msg_status	=	get_comment_meta( get_current_user_id(), $ad_id."_" . $row->user_id, true );
			$status = '';
			if( $msg_status == '0' )
			{
				$status = '<i class="fa fa-envelope" aria-hidden="true"></i>';
			}
			$users .= '<li class="user_list '.$cls.'" cid="'.$ad_id.'" second_user="'.$row->user_id.'" id="sb_'.$row->user_id.'_'.$ad_id.'">
						 <a href="javascript:void(0);">
							<div class="image">
							   <img src="'.$user_dp.'" alt="'.$row->comment_author.'">
							</div>
							<div class="user-name">
							   <div class="author">
								  <span>'.$row->comment_author.'</span>
							   </div>
							   <p>'.get_the_title( $ad_id ).'</p>
							   <div class="time" id="'.$row->user_id.'_'.$ad_id.'">
								  	'.$status.'
							   </div>
							</div>
						 </a>
					  </li>
';
		$authors	=	array( $row->user_id, get_current_user_id() );
		if( $turn == 1 )
		{
			$args = array(
				'author__in' => $authors,
				'post_id' => $ad_id,
				'parent' => $row->user_id,
				'orderby' => 'comment_date',
				'order' => 'ASC',
			);
			$comments	=	get_comments( $args );
			if( count( $comments ) > 0 )
			{
				
				
				$level_2	=	'<input type="hidden" id="usr_id" name="usr_id" value="'.$row->user_id.'" />
				<input type="hidden" id="rece_id" name="rece_id" value="'.$row->user_id.'" />
				<input type="hidden" name="msg_receiver_id" id="msg_receiver_id" value="'.esc_attr( $row->user_id ).'" />
				';
				foreach( $comments as $comment )
				{
					$user_pic	=	'';
					$class	=	'friend-message';
					if( $comment->user_id == get_current_user_id() )
					{
						$class = 'my-message';	
					}
					$user_pic =	adforest_get_user_dp( $comment->user_id );
					$messages .= '<li class="'.$class.' clearfix">
									 <figure class="profile-picture">
										 <a href="'.get_author_posts_url( $comment->user_id ).'?type=ads" class="link" target="_blank">
										<img src="'.$user_pic.'" class="img-circle" alt="'.__('Profile Pic','adforest').'">
										</a>
									 </figure>
									 <div class="message">
										'.$comment->comment_content .'
										<div class="time"><i class="fa fa-clock-o"></i> '.adforest_timeago($comment->comment_date ).'</div>
									 </div>
								  </li>';	
				}
			}
			
			// Message form
			$profile	= new adforest_profile();
			$form = '<form role="form" class="form-inline" id="send_message">
                                 <div class="form-group">
								 <input type="hidden" name="ad_post_id" id="ad_post_id" value="'.$ad_id.'" />
								 <input type="hidden" name="name" value="'.$profile->user_info->display_name.'" />
								 <input type="hidden" name="email" value="'.$profile->user_info->user_email.'" />
								 '.$level_2.'
                                    <input name="message" id="sb_forest_message" placeholder="'.__( 'Type a message here...', 'adforest' ).'" class="form-control message-text" autocomplete="off" type="text" data-parsley-required="true" data-parsley-error-message="'.__( 'This field is required.', 'adforest' ).'">
                                 </div>
                                 <button class="btn btn-theme" id="send_msg" type="submit" inbox="no">'.__('Send','adforest' ).'</button>
                              </form>';
		}
		$turn++;
	  }
	  if( $users ==  '' )
	  {
			$users = '<li class="padding-top-30 padding-bottom-20"><div class="user-name">'.__('No message received on this ad yet.', 'adforest' ) . '</div></li>';  
	  }
	  $title = '';
	  if( isset( $ad_id ) && $ad_id != "" )
	  {
			$title	=  '<a href="'.get_the_permalink( $ad_id ).'" target="_blank">'. get_the_title( $ad_id ) . '</a>'; 
	  }
	  $title_html = '<h2 class="padding-top-20">'.$title.'</h2>';
	  $inline = 'style="margin-right: 10px;"';
	return $script .  '<section class="gray">
                  <div class="message-body">
                     <div class="col-md-4 col-sm-5 col-xs-12">
                        <div class="message-inbox">
                           <div class="message-header">
                              <h4>'.__('Users', 'adforest' ) .'</h4>
							  <span ><a class="messages_actions active" sb_action="received_msgs_ads_list"><small>'.__('Received  Offers','adforest').'</small></a></span>
                              <span '.$inline.'><a class="messages_actions" sb_action="my_msgs"><small>'.__('Sent Offers','adforest').' &nbsp; |</small></a></span>
                           </div>
							<ul class="message-history">
								'.$users.'
							</ul>
                        </div>
                     </div>
                     <div class="col-md-8 clearfix col-sm-5 col-xs-12 message-content">
					 	'.$title_html.'
                        <div class="message-details">
                           <ul class="messages" id="messages">
                              ' . $messages . '
                           </ul>
                           <div class="chat-form ">
                              '.$form.'
                           </div>
                        </div>
                     </div>
                  </div>
         </section>';
}

function adforest_get_user_ads_list()
{
	global $adforest_theme;
	$script = '<script type="text/javascript">
         jQuery(document).ready(function($){
         "use strict";
         $(\'.message-history\').wrap(\'<div class="list-wrap"></div>\');
         function scrollbar() {
            var $scrollbar = $(\'.message-inbox .list-wrap\');
            $scrollbar.perfectScrollbar({
                maxScrollbarLength: 150,
            });
            $scrollbar.perfectScrollbar(\'update\');
         }
         scrollbar();
         $(\'.messages\').wrap(\'<div class="list-wraps"></div>\');
         function scrollbar1() {
            var $scrollbar1 = $(\'.message-details .list-wraps\');
            $scrollbar1.perfectScrollbar({
                maxScrollbarLength: 150,
            });
            $scrollbar1.perfectScrollbar(\'update\');
         }
          scrollbar1();
         });
      </script>';
	  
	  global $wpdb;
	$profile	= new adforest_profile();
	$args	=	array(
	'post_type' => 'ad_post',
	'author' => $profile->user_info->ID,
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'paged' => $paged,
	'order'=> 'DESC',
	'orderby' => 'ID'
);
	$ads = new WP_Query( $args );
	if ( $ads->have_posts() )
	{
		$number	= 0;
		$ads_list	=	'';
		while ( $ads->have_posts() )
		{
			$ads->the_post();
			$pid	=	get_the_ID();
			$ad_img	= $adforest_theme['default_related_image']['url'];	
			$media	=	 adforest_get_ad_images($pid);
			if( count( $media ) > 0 )
			{
				foreach( $media as $m )
				{
					$mid	=	'';
					if ( isset( $m->ID ) )
						$mid	= 	$m->ID;
					else
						$mid	=	$m;
					
					$img  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
					$ad_img	=	$img[0];
					break;
				}
			
			}
			
			$is_unread_msgs = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->commentmeta WHERE comment_id = '".get_current_user_id()."' AND meta_value = '0' AND meta_key like '".$pid."_%'" );
			
			$status = '';
			if( $is_unread_msgs > 0 )
			{
				$status = '<i class="fa fa-envelope" aria-hidden="true"></i>';
			}
			
			$ads_list .= '<li class="get_msgs" ad_msg="'.esc_attr($pid).'"><a href="javascript:void(0);">
							<div class="image">
							   <img src="'.$ad_img.'" alt="'.get_the_title( $pid ).'">
							</div>
							<div class="user-name">
							   <div class="author">
								  <span>'.get_the_title( $pid ).'</span>
							   </div>
							   <div class="time">
								  '.$status.'
							   </div>
							</div>
						 </a>
						 </li>';
		}
	}
	$msg	=	'<div class="text-center">'.__('Please click to your ad in order to see messages.', 'adforest' ) . '</div>';
	$inline = 'style="margin-right: 10px;"';
	return $script .  '<div>
                   <div class="message-body">
                     <div class="col-md-4 col-sm-5 col-xs-12">
                        <div class="message-inbox">
                           <div class="message-header">
                              <h4>'.__('Ads', 'adforest' ) .'</h4>
							  <span ><a class="active messages_actions" sb_action="received_msgs_ads_list"><small>'.__('Recevied Offers','adforest').'</small></a></span>
                              <span '.$inline.'><a class="messages_actions" sb_action="my_msgs"><small>'.__('Sent Offers','adforest').' &nbsp; |</small></a></span>
                           </div>
							<ul class="message-history">
								'.$ads_list.'
							</ul>
                        </div>
                     </div>
                     <div class="col-md-8 clearfix col-sm-5 col-xs-12 message-content">
                        <div class="message-details">
                           <div class="chat-form ">
                              '.$msg.'
                           </div>
                        </div>
                     </div>
                  </div>
               </div>';
}

function adforest_get_messages( $user_id )
{
	global $adforest_theme;
	$script = '<script type="text/javascript">
         jQuery(document).ready(function($){
         "use strict";
         $(\'.message-history\').wrap(\'<div class="list-wrap"></div>\');
         function scrollbar() {
            var $scrollbar = $(\'.message-inbox .list-wrap\');
            $scrollbar.perfectScrollbar({
                maxScrollbarLength: 150,
            });
            $scrollbar.perfectScrollbar(\'update\');
         }
         scrollbar();
         $(\'.messages\').wrap(\'<div class="list-wraps"></div>\');
         function scrollbar1() {
            var $scrollbar1 = $(\'.message-details .list-wraps\');
            $scrollbar1.perfectScrollbar({
                maxScrollbarLength: 150,
            });
            $scrollbar1.perfectScrollbar(\'update\');
         }
          scrollbar1();
         });
      </script>';
	  
	  global $wpdb;

	$rows = $wpdb->get_results(   "SELECT * FROM $wpdb->comments WHERE comment_type = 'ad_post' AND user_id = '$user_id' AND comment_parent = '$user_id' GROUP BY comment_post_ID ORDER BY comment_ID DESC" );
		
	  $users	=	'';
	  $messages	=	'';
	  $form	=	'<div class="text-center">'.__('No message received on this ad yet.', 'adforest' ) . '</div>';
	  $author_html	=	'';
	  $turn	=	1;
	  $level_2	=	'';
	  $title_html = '';
  foreach( $rows as $row )
	  {
		  $last_date	=	$row->comment_date;
		  $date	=	explode( ' ', $last_date );
		  $author	=	get_post_field( 'post_author', $row->comment_post_ID );
		  $cls	=	'';
		  if( $turn == 1 )
		  		$cls	=	'message-history-active';
			
			$ad_img	= $adforest_theme['default_related_image']['url'];	
			$media	=	 adforest_get_ad_images($row->comment_post_ID);
			if( count( $media ) > 0 )
			{
				foreach( $media as $m )
				{
					$mid	=	'';
					if ( isset( $m->ID ) )
						$mid	= 	$m->ID;
					else
						$mid	=	$m;
				
					$img  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
					$ad_img	=	$img[0];
					break;
				}
			
			}

			
	  if( isset( $row->comment_post_ID ) && $row->comment_post_ID != "" )
	  {
		  	if( $turn == 1 )
			{
				$title_html	.=  '<h2 class="padding-top-20 sb_ad_title" id="title_for_'.esc_attr($row->comment_post_ID).'"><a href="'.get_the_permalink( $row->comment_post_ID ).'" target="_blank" >'. get_the_title( $row->comment_post_ID ) . '</a></h2>'; 
			}
			else
			{
				$title_html	.=  '<h2 class="padding-top-20 sb_ad_title no-display" id="title_for_'.esc_attr($row->comment_post_ID).'" ><a href="'.get_the_permalink( $row->comment_post_ID ).'" target="_blank" >'. get_the_title( $row->comment_post_ID ) . '</a></h2>';
			}
	  }
	  
			
			$ad_id	=		$row->comment_post_ID;
			$comment_author	=	get_userdata( $author );
			
			$msg_status	=	get_comment_meta( get_current_user_id(), $ad_id ."_" .$author  , true );
			$status = '';
			if( $msg_status == '0' )
			{
				$status = '<i class="fa fa-envelope" aria-hidden="true"></i>';
			}
			
			$users .= '<li class="user_list ad_title_show '.$cls.'" cid="'.$row->comment_post_ID.'" second_user="'.$author.'" inbox="yes" id="sb_'.$author.'_'.$ad_id.'">
						 <a href="javascript:void(0);">
							<div class="image">
							   <img src="'.$ad_img.'" alt="'.$comment_author->display_name.'">
							</div>
							<div class="user-name">
							   <div class="author">
								  <span>'.get_the_title( $ad_id ).'</span>
							   </div>
							   <p>'.$comment_author->display_name .'</p>
							   <div class="time" id="'.$author.'_'.$ad_id.'">
								  '.$status.'
							   </div>
							</div>
						 </a>
					  </li>
';
		$authors	=	array( $author, get_current_user_id() );
		if( $turn == 1 )
		{
			$args = array(
				'author__in' => $authors,
				'post_id' => $ad_id,
				'parent' => get_current_user_id(),
				'post_type' => 'ad_post',
				'orderby' => 'comment_date',
				'order' => 'ASC',
			);
			$comments	=	get_comments( $args );
			if( count( $comments ) > 0 )
			{
				
				foreach( $comments as $comment )
				{
					$user_pic	=	'';
					$class	=	'friend-message';
					if( $comment->user_id == get_current_user_id() )
					{
						$class = 'my-message';	
					}
					$user_pic =	adforest_get_user_dp( $comment->user_id );
					$messages .= '<li class="'.$class.' clearfix">
									 <figure class="profile-picture">
									 <a href="'.get_author_posts_url( $comment->user_id ).'?type=ads" class="link" target="_blank">
										<img src="'.$user_pic.'" class="img-circle" alt="'.__('Profile Pic','adforest').'">
										</a>
									 </figure>
									 <div class="message">
										'.$comment->comment_content .'
										<div class="time"><i class="fa fa-clock-o"></i> '.adforest_timeago($comment->comment_date ).'</div>
									 </div>
								  </li>';	
				}
			}
			
			// Message form
			$profile	= new adforest_profile();
			$level_2	=	'<input type="hidden" name="usr_id" value="'.$user_id.'" />
			<input type="hidden" id="usr_id" value="'.$author.'" />
			<input type="hidden" id="rece_id" name="rece_id" value="'.$author.'" />
			<input type="hidden" name="msg_receiver_id" id="msg_receiver_id" value="'.esc_attr( $author ).'" />
			';
			$form = '<form role="form" class="form-inline" id="send_message">
                                 <div class="form-group">
								 <input type="hidden" name="ad_post_id" id="ad_post_id" value="'.$ad_id.'" />
								 <input type="hidden" name="name" value="'.$profile->user_info->display_name.'" />
								 <input type="hidden" name="email" value="'.$profile->user_info->user_email.'" />
								 '.$level_2.'
                                    <input name="message" id="sb_forest_message" placeholder="'.__( 'Type a message here...', 'adforest' ).'" class="form-control message-text" autocomplete="off" type="text" data-parsley-required="true" data-parsley-error-message="'.__( 'This field is required.', 'adforest' ).'">
                                 </div>
                                 <button class="btn btn-theme" id="send_msg" type="submit" inbox="yes">'.__('Send','adforest' ).'</button>
                              </form>';
		}
		$turn++;
	  }
	  if( $users ==  '' )
	  {
			$users = '<li class="padding-top-30 padding-bottom-20"><div class="user-name">'.__('Nothing Found.', 'adforest' ) . '</div></li>';  
	  }
	  
	$inline = 'style="margin-right: 10px;"';
	return $script .  '<div>
                   <div class="message-body">
                     <div class="col-md-4 col-sm-5 col-xs-12">
                        <div class="message-inbox">
                           <div class="message-header">
                              <h4>'.__('Ads', 'adforest' ) .'</h4>
							  <span ><a class="messages_actions" sb_action="received_msgs_ads_list"><small>'.__('Recevied Offers','adforest').'</small></a></span>
                              <span '.$inline.'><a class="messages_actions active" sb_action="my_msgs"><small>'.__('Sent Offers','adforest').' &nbsp; |</small></a></span>
                           </div>
							<ul class="message-history">
								'.$users.'
							</ul>
                        </div>
                     </div>
                     <div class="col-md-8 clearfix col-sm-5 col-xs-12 message-content">
					 	'.$title_html.'
                        <div class="message-details">
                           <ul class="messages" id="messages">
                              ' . $messages . '
                           </ul>
                           <div class="chat-form ">
                              '.$form.'
                           </div>
                        </div>
                     </div>
                  </div>
               </div>';
}

function adforest_search_layout_grid_1( $pid, $col = 6, $sm = 6, $holder = '' )
{
		$my_ads = '';
		$number	= 0;
		global $adforest_theme;
		$cats_html	=	adforest_display_cats( $pid );
			
		$flip_it = '';
		$ribbion = 'featured-ribbon';
		if ( is_rtl() )
		{
			$flip_it = 'flip';
			$ribbion = 'featured-ribbon-rtl';
		}
	
				
		$outer_html	=	'';
		$media	=	 adforest_get_ad_images($pid);
		if( count( $media ) > 0 )
		{
			$counting	=	1;
			foreach( $media as $m )
			{
				if( $counting > 1 )
					break;
					
				$mid	=	'';
				if ( isset( $m->ID ) )
					$mid	= 	$m->ID;
				else
					$mid	=	$m;
					
				$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
				$outer_html = '<div class="image">
				<a href="'.get_the_permalink().'"><img src="'.$image[0].'" alt="'.get_the_title().'" class="img-responsive"></a> 
				</div>';
				$counting++;
			}
		}
		else
		{
			$outer_html = '<div class="image">
					<a href="'.get_the_permalink().'"><img src="'.$adforest_theme['default_related_image']['url'].'" alt="'.get_the_title().'" class="img-responsive"></a>
					</div>';
		}
		$is_feature	=	'';
		if( get_post_meta( get_the_ID(), '_adforest_is_feature', true ) == '1' )
		{
			$is_feature	=	'<div class="'.esc_attr( $ribbion ).'">
			  <span>'.__('Featured','adforest').'</span>
		   </div>';
		}

	
			return $my_ads = '<div class="col-md-'. esc_attr( $col ).'  col-lg-'. esc_attr( $col ).' col-sm-'. esc_attr( $sm ).' col-xs-12" id="'.$holder.'.holder-'.get_the_ID().'">
						  <div class="white category-grid-box-1 ">
						  '.adforest_video_icon().'
							 <!-- Image Box -->
							 '.$is_feature.'
									 '.$outer_html.'
							 <!-- Short Description -->
							 <div class="short-description-1 ">
								<!-- Category Title -->
								<div class="category-title"> '.$cats_html.' </div>
								<!-- Ad Title -->
								<h3>
								   <a title="" href="'.get_the_permalink().'">'.get_the_title().'</a>
								</h3>
								<!-- Location -->
								<p class="location"><i class="fa fa-map-marker"></i> '.get_post_meta(get_the_ID(), '_adforest_ad_location', true ).'</p>
								

								 
								 <span class="ad-price">'.  adforest_adPrice(get_the_ID()).'</span> 
							 </div>
							 <!-- Ad Meta Stats -->
							 <div class="ad-info-1">
								<ul class="pull-left '.esc_attr( $flip_it ).'">
								   <li> <i class="fa fa-eye"></i><a href="javascript:void(0);">'.adforest_getPostViews( get_the_ID() ) .' ' . __('Views', 'adforest' ).'</a> </li>
								   <li> <i class="fa fa-clock-o"></i>'. get_the_date(get_option( 'date_format' ), get_the_ID() ).'</li>
								</ul>
								<ul class="pull-right">
								</ul>
							 </div>
						  </div>
					   </div>';

}

function adforest_search_layout_grid_2( $pid, $col = 6, $sm = 6,$holder = '' )
{
		$my_ads = '';
		$number	= 0;
		global $adforest_theme;
		$cats_html	=	adforest_display_cats( $pid );
					
		$img	=	'';
		$media	=	 adforest_get_ad_images($pid);
		if( count( $media ) > 0 )
		{
			foreach( $media as $m )
			{
				$mid	=	'';
				if ( isset( $m->ID ) )
					$mid	= 	$m->ID;
				else
					$mid	=	$m;
				
				$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
				$img = '<img src="'.$image[0].'" alt="'.get_the_title().'" class="img-responsive">';
				break;
			}
	
	}
		else
		{
			$img = '<img src="'.$adforest_theme['default_related_image']['url'].'" alt="'.get_the_title().'" class="img-responsive">';
		}
		
		$is_feature	=	'';
		if( get_post_meta( get_the_ID(), '_adforest_is_feature', true ) == '1' )
		{
			$is_feature	= '<span class="ad-status">'.__('Featured','adforest').'</span>';
		}
		
		$pid	=	get_the_ID();
		$author_id = get_post_field( 'post_author', $pid );;

		$condition_html	= '';
	if( isset( $adforest_theme['allow_tax_condition'] ) && $adforest_theme['allow_tax_condition'] && get_post_meta(get_the_ID(), '_adforest_ad_condition', true ) != "")
	{
    $condition_html = '<p>'.__('Condition', 'adforest' ) . ": " .get_post_meta(get_the_ID(), '_adforest_ad_condition', true ).'</p>';
    }
	
		$ad_type_html	= '';
	if( get_post_meta(get_the_ID(), '_adforest_ad_type', true ) != "" )
	{
		 $ad_type_html = '<p>'.__('Ad Type', 'adforest' ) . ": " .get_post_meta(get_the_ID(), '_adforest_ad_type', true ).'</p>';
	}

		
		return '<div class="col-md-'. esc_attr( $col ).' col-xs-12 col-sm-'. esc_attr( $sm ).'">
				  <!-- Ad Box -->
				  <div class="category-grid-box">
					 <!-- Ad Img -->
					 <div class="category-grid-img">
						'.$img.'
						<!-- Ad Status -->
						'.$is_feature.'
						<!-- User Review -->
						<div class="user-preview">
						   <a href="'.get_author_posts_url( $author_id ).'?type=ads">
						   <img src="'.adforest_get_user_dp( $author_id ).'" class="avatar avatar-small" alt="'.get_the_title().'">
						   </a>
						</div>
						'.adforest_video_icon( true ).'
						<!-- View Details -->
						<a href="'.get_the_permalink().'" class="view-details">
						' . __('View Details', 'adforest' )  . '
						</a>
						<!-- Additional Info -->
						<div class="additional-information">
						   <p>'.__('Posted on', 'adforest' ) . ": " . get_the_date(get_option( 'date_format' ), get_the_ID() ).'</p>
						   '.$ad_type_html.'
						   '.$condition_html.'
						</div>
						<!-- Additional Info End-->
					 </div>
					 <!-- Ad Img End -->
					 <div class="short-description">
							<!-- Category Title -->
								<div class="category-title"> '.$cats_html.' </div>
								<!-- Ad Title -->
								<h3>
								   <a title="" href="'.get_the_permalink().'">'.get_the_title().'</a>
								</h3>
						<!-- Price -->
						<div class="price">
						'.adforest_adPrice(get_the_ID()).'
						</div>
					 </div>
					 <!-- Addition Info -->
					 <div class="ad-info">
						<ul>
						   <li><i class="fa fa-map-marker"></i>
						   '.get_post_meta(get_the_ID(), '_adforest_ad_location', true ).'
						   </li>
						</ul>
					 </div>
				  </div>
				  <!-- Ad Box End -->
			   </div>';

}

function adforest_search_layout_grid_3( $pid, $col = 6 , $sm = 6,$holder = ''  )
{
		$my_ads = '';
		$number	= 0;
		global $adforest_theme;
		$cats_html	=	adforest_display_cats( $pid );
		
		$ribbion = 'featured-ribbon';
		if ( is_rtl() )
		{
			$ribbion = 'featured-ribbon-rtl';
		}
					
		$img	=	'';
		$media	=	 adforest_get_ad_images($pid);
		if( count( $media ) > 0 )
		{
			foreach( $media as $m )
			{
				$mid	=	'';
				if ( isset( $m->ID ) )
					$mid	= 	$m->ID;
				else
					$mid	=	$m;
							
				$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
				$img = '<img src="'.$image[0].'" alt="'.get_the_title().'" class="img-responsive">';
				break;
			}
	
	}
		else
		{
			$img = '<img src="'.$adforest_theme['default_related_image']['url'].'" alt="'.get_the_title().'" class="img-responsive">';
		}
		
		$is_feature	=	'';
		if( get_post_meta( get_the_ID(), '_adforest_is_feature', true ) == '1' )
		{
			$is_feature	=	'<div class="'.esc_attr( $ribbion ).'">
			  <span>'.__('Featured','adforest').'</span>
		   </div>';
		}
		
		$pid	=	get_the_ID();
		$author_id = get_post_field( 'post_author', $pid );;

		
		return '
		<div class="col-md-'. esc_attr( $col ).' col-sm-'. esc_attr( $sm ).' col-xs-12">
                              <div class="category-grid-box-1">
							  '.$is_feature.'
							  '.adforest_video_icon().'
                                 <div class="image">
                                    <a href="'.get_the_permalink().'">'.$img.'</a>
									
                                 </div>
                                 <div class="short-description-1 clearfix">
				<div class="price-tag">
				<div class="price">
				<span>
				'.adforest_adPrice(get_the_ID()).'
				</span>
				</div>
				</div>
									<div class="category-title">
									'.$cats_html.' 
									</div>
                                    <h3>
									<a title="" href="'.get_the_permalink().'">'.get_the_title().'</a>
									</h3>
									<i class="fa fa-clock-o"></i>
									<small>
									'.get_the_date(get_option( 'date_format' ), get_the_ID() ).'
									</small>
                                 </div>
                                 <div class="ad-info-1">
                                    <ul>
                                       <li> <i class="fa fa-map-marker"></i>
									   '.get_post_meta(get_the_ID(), '_adforest_ad_location', true ).'
									   </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
		';
		
}

function adforest_search_layout_grid_4( $pid, $col = 6 , $sm = 6,$holder = ''  )
{
		$my_ads = '';
		$number	= 0;
		global $adforest_theme;
		$cats_html	=	adforest_display_cats( $pid );
		
		$ribbion = 'featured-ribbon';
		if ( is_rtl() )
		{
			$ribbion = 'featured-ribbon-rtl';
		}
					
		$img	=	'';
		$media	=	 adforest_get_ad_images($pid);
		if( count( $media ) > 0 )
		{
			foreach( $media as $m )
			{
				$mid	=	'';
				if ( isset( $m->ID ) )
					$mid	= 	$m->ID;
				else
					$mid	=	$m;
				
				$image  = wp_get_attachment_image_src( $mid, 'adforest-category');
				$img = '<img src="'.$image[0].'" alt="'.get_the_title().'" class="img-responsive">';
				break;
			}
	
	}
		else
		{
			$img = '<img src="'.$adforest_theme['default_related_image']['url'].'" alt="'.get_the_title().'" class="img-responsive">';
		}
		
		$is_feature	=	'';
		if( get_post_meta( get_the_ID(), '_adforest_is_feature', true ) == '1' )
		{
			$is_feature	=	'<div class="'.esc_attr( $ribbion ).'">
			  <span>'.__('Featured','adforest').'</span>
		   </div>';
		}
		
		$pid	=	get_the_ID();
		$author_id = get_post_field( 'post_author', $pid );;

		return '<div class="grid-padding col-md-'. esc_attr( $col ).' col-sm-'. esc_attr( $sm ).' col-xs-12">
						
                         <div class="listing-card">
                                <div class="image-area">
								'.adforest_video_icon().'
								'.$is_feature.'
                                    <div class="photo-count-flag">'.count( $media ).' <i class="fa fa-camera"></i></div>
                                    <a href="'.get_the_permalink().'">'.$img.'</a>
                                </div>
                                <div class="listing-detail">
                                    <div class="listing-content">
                                        <div class="listing-title">
                                            <a href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>
                                        </div>
                                        <span class="listing-price">'.adforest_adPrice(get_the_ID()).'</span>
                                        <ul>
                                            <li> <i class="fa fa-th-large fa-fw"></i><span>'.$cats_html.' </span> </li>
                                            <li> <i class="fa fa-map-marker fa-fw"></i><span>'.get_post_meta(get_the_ID(), '_adforest_ad_location', true ).'</span> </li>
                                            <li> <i class="fa fa-clock-o fa-fw"></i><span>'.get_the_date(get_option( 'date_format' ), get_the_ID() ).'</span> </li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                          </div>
                        </div>';
		
		
		
}

function adforest_search_layout_grid_5( $pid, $col = 6 , $sm = 6,$holder = ''  )
{
		$my_ads = '';
		$number	= 0;
		global $adforest_theme;
		$cats_html	=	adforest_display_cats( $pid );
		
		$ribbion = 'featured-ribbon';
		if ( is_rtl() )
		{
			$ribbion = 'featured-ribbon-rtl';
		}
					
		$img	=	'';
		$media	=	 adforest_get_ad_images($pid);
		if( count( $media ) > 0 )
		{
			foreach( $media as $m )
			{
				$mid	=	'';
				if ( isset( $m->ID ) )
					$mid	= 	$m->ID;
				else
					$mid	=	$m;
				$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
				$img = '<img src="'.$image[0].'" alt="'.get_the_title().'" class="img-responsive">';
				break;
			}
	
	}
		else
		{
			$img = '<img src="'.$adforest_theme['default_related_image']['url'].'" alt="'.get_the_title().'" class="img-responsive">';
		}
		
		$is_feature	=	'';
		if( get_post_meta( get_the_ID(), '_adforest_is_feature', true ) == '1' )
		{
			$is_feature	=	'<div class="'.esc_attr( $ribbion ).'">
			  <span>'.__('Featured','adforest').'</span>
		   </div>';
		}
		
		$pid	=	get_the_ID();
		$author_id = get_post_field( 'post_author', $pid );;

		
		
		return '<div class="grid-padding col-md-'. esc_attr( $col ).' col-sm-'. esc_attr( $sm ).' col-xs-12 marrgin-bottom-20">
                         <div class="new-small-grid">
						 '.adforest_video_icon().'
						 '.$is_feature.'
				 <a href="'.get_the_permalink().'">
				  <figure class="new-small-grid-img">
					'.$img.'	
				  </figure>
				  </a>
				  <div class="new-small-grid-description">
				  
					<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
					<div class="category-title">
						'.$cats_html.' 
					</div>
					<span class="ad-price">'.adforest_adPrice(get_the_ID()).'</span>
					
					
					
				  </div>
				  
				</div>
				
				
				
                        </div>';
		
		
}

function adforest_search_layout_list( $pid, $col = 12 )
{
	global $adforest_theme;
	$author_id = get_post_field( 'post_author', $pid );
	$condition_html	= '';
	if( isset( $adforest_theme['allow_tax_condition'] ) && $adforest_theme['allow_tax_condition'] && get_post_meta($pid, '_adforest_ad_condition', true ) != "" )
	{
		$condition_html = '<div class="ad-stats hidden-xs">
		<span>'.__('Condition', 'adforest' ).'  : </span>
		'.get_post_meta($pid, '_adforest_ad_condition', true ).'
		</div>';
	}
	$ad_type_html	= '';
	if( get_post_meta($pid, '_adforest_ad_type', true ) != "")
	{
		$ad_type_html = '<div class="ad-stats hidden-xs">
	<span>'.__('Ad Type', 'adforest' ).'  : </span>
	'.get_post_meta($pid, '_adforest_ad_type', true ).'
	</div>';
	}
	
	$poster_contact	=	'';
	if( get_post_meta(get_the_ID(), '_adforest_poster_contact', true ) != "" && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'phone' ) )
	{
		$poster_contact	=	'<li>
	<a data-toggle="tooltip" title="'.get_post_meta($pid, '_adforest_poster_contact', true ).'" href="javascript:void(0);" class="fa fa-phone"></a>
	</li>';
	}
		
	$price = '<div class="price">
	<span>
	'.adforest_adPrice(get_the_ID()).'
	</span> 
	</div>';

	$output = '<li>
				<div class="well ad-listing clearfix">
				<div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">';
		   $img	=	$adforest_theme['default_related_image']['url']; 
			$media	=	 adforest_get_ad_images($pid);
			$total_imgs	=	count( $media );
			if( count( $media ) > 0 )
			{
				foreach( $media as $m )
				{
					$mid	=	'';
						if ( isset( $m->ID ) )
							$mid	= 	$m->ID;
						else
							$mid	=	$m;
					
					$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
					$img	=	$image[0];
					break;
				}
			}      
	$output .= '<div class="img-box">
	'.adforest_video_icon().'
	<img src="'.esc_url( $img ).'" class="img-responsive" alt="'.get_the_title().'">
	<div class="total-images">
	<strong>'.esc_html( $total_imgs ).'</strong>
	'.__('photos', 'adforest').'
	</div>
	<div class="quick-view">
	<a href="'.get_the_permalink().'" class="view-button"><i class="fa fa-search"></i></a>
	</div>
	</div>
	';
	//$color	=	 adforest_ads_status_color( get_post_meta($pid, '_adforest_ad_status_', true ));
	
	$output .= '
	<div class="user-preview">
	<a href="'.get_author_posts_url( $author_id ).'?type=ads">
	<img src="'.adforest_get_user_dp( $author_id ).'" class="avatar avatar-small" alt="'.get_the_title().'">
	</a>
	</div>
	</div>
	<div class="col-md-9 col-sm-7 col-xs-12">
	<!-- Ad Content-->
	<div class="row">
	<div class="content-area">
	<div class="col-md-9 col-sm-12 col-xs-12">
	';
    $cats_html	=	'';
    $post_categories = wp_get_object_terms( $pid,  array('ad_cats'), array('orderby' => 'term_group') );
	$it_one	=	1;
    foreach($post_categories as $c)
    {
		$cls	=	'';
		if( $it_one != 1 )
			$cls	=	'padding-left';
    $cat = get_term( $c );
    $cats_html	.= '<span><a class="'.$cls.'" href="'.get_term_link( $cat->term_id ).'">'.esc_html( $cat->name ).'</a></span>';
		$it_one++;
    }
	$output .= '
	<div class="category-title">
	'.$cats_html.'
	</div>
	<!-- Ad Title -->
	<h3>
	<a href="'.get_the_permalink().'">
	'.get_the_title().'
	</a>
	</h3>
	<ul class="additional-info pull-right">
	'.$poster_contact.'
	<li>
	<a data-toggle="tooltip" title="'.__('Save', 'adforest' ).'" href="javascript:void(0);" class="fa fa-heart save-ad" data-adid="'.esc_attr( $pid ).'"></a>
	</li>
	</ul>
	<ul class="ad-meta-info">
	<li> <i class="fa fa-map-marker"></i>
	<a href="javascript:void(0);">
	'.get_post_meta($pid, '_adforest_ad_location', true ).'
	</a>
	</li>
	<li> <i class="fa fa-clock-o"></i>
	'.get_the_date(get_option( 'date_format' ), $pid ).'
	</li>
	</ul>
	<div class="ad-details">
	<p>'.adforest_words_count( get_the_excerpt(), 150 ).'</p>
	</div>
	</div>
	<div class="col-md-3 col-xs-12 col-sm-12">
	<!-- Ad Stats -->
	<div class="short-info">
	'.$ad_type_html.'
	'.$condition_html.'
	<div class="ad-stats hidden-xs">
	<span>'.__('Visits', 'adforest' ).'  : </span>
	'.adforest_getPostViews( $pid ).'
	</div>
	</div>
	<!-- Price -->
	'.$price.'
	<!-- Ad View Button -->
	<a href="'.get_the_permalink().'" class="btn btn-block btn-success">
	<i class="fa fa-eye" aria-hidden="true"></i>
	'.__('View Ad', 'adforest' ).'
	</a>
	</div>
	</div>
	</div>
	<!-- Ad Content End -->
	</div>
	</div>
	</li>
	';
	return $output;
}

function adforest_search_layout_list_1( $pid )
{
		$my_ads = '';
		$number	= 0;
		global $adforest_theme;
		$cats_html	=	adforest_display_cats( $pid );
					
		$img	=	'';
		$media	=	 adforest_get_ad_images($pid);
		if( count( $media ) > 0 )
		{
			foreach( $media as $m )
			{
				$mid	=	'';
				if ( isset( $m->ID ) )
					$mid	= 	$m->ID;
				else
					$mid	=	$m;
				
				$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
				$img = '<img src="'.$image[0].'" alt="'.get_the_title().'" class="img-responsive">';
				break;
			}
	
	}
		else
		{
			$img = '<img src="'.$adforest_theme['default_related_image']['url'].'" alt="'.get_the_title().'" class="img-responsive">';
		}
		
		$is_feature	=	'';
		if( get_post_meta( get_the_ID(), '_adforest_is_feature', true ) == '1' )
		{
			$rtl_fet	=	'featured-ribbon';
			if ( is_rtl() )
			{
				$rtl_fet	=	'featured-ribbon-rtl';
			}
			$is_feature	=	'<div class="'.esc_attr($rtl_fet).'">
			  <span>'.__('Featured','adforest').'</span>
		   </div>';
		}
		
		$pid	=	get_the_ID();
		$author_id = get_post_field( 'post_author', $pid );;

		$warranty = '';
		if( get_post_meta(get_the_ID(), '_adforest_ad_warranty', true ) != "" && isset( $adforest_theme['allow_tax_warranty'] ) && $adforest_theme['allow_tax_warranty'])
		{
			$warranty	=	'<li>
						<a href="javascript:void(0);"> <i class="flaticon-ribbon-badge"></i>
					'.get_post_meta(get_the_ID(), '_adforest_ad_warranty', true ).'
					</a>
					<li>';	
		}
		$condition_html	= '';
	if( isset( $adforest_theme['allow_tax_condition'] ) && $adforest_theme['allow_tax_condition'] && get_post_meta(get_the_ID(), '_adforest_ad_condition', true ) != "" )
	{
    $condition_html = '<li>
					 <a href="javascript:void(0);"><i class="flaticon-check-square"></i>
					 '.get_post_meta(get_the_ID(), '_adforest_ad_condition', true ).'
					 </a>
					 </li>';
					 
 $modern_feature = '';
if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
{
	$modern_feature = $is_feature;
	$is_feature = '';
}

    }
	
	$poster_contact	=	'';
	if( get_post_meta(get_the_ID(), '_adforest_poster_contact', true ) != "" && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'phone' ) )
	{
		$poster_contact	=	'<li> <a href="javascript:void(0);"><i class="flaticon-phone-call"></i>
					 '.get_post_meta(get_the_ID(), '_adforest_poster_contact', true ).'
					 </a>
					 </li>';
	}
		return '
			<div class="item list-group-items col-md-6 col-sm-6 col-xs-12 clearfix">
            <div class="category-grid-box-1">
			'.$modern_feature.'
               <!-- Image Box -->
               <div class="image">
			   '.adforest_video_icon().'
                  <a href="'.get_the_permalink().'">'.$img.'</a>
                  <div class="price-tag">
                     <div class="price"><span>
					 '.adforest_adPrice(get_the_ID()).'
					 </span>
					 </div>
                  </div>
               </div>
               <!-- Short Description -->
               <div class="short-description-1 clearfix">
			   '.$is_feature.'
                  <!-- Category Title -->
                  <div class="category-title">'.$cats_html.'</div>
                  <!-- Ad Title -->
                  <h3><a title="" href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
                  <!-- Short Description -->
                  <p class="list-group-item-text">'.adforest_words_count( get_the_excerpt(), 150 ) .'</p>
                  <!-- Ad Meta Info -->
                  <ul class="ad-meta-info">
					 '.$warranty.'
					 '.$condition_html.'
                     '.$poster_contact.'
                  </ul>
               </div>
               <!-- Ad Meta Stats -->
               <div class="ad-info-1">
                  <ul>
                     <li> <i class="fa fa-map-marker"></i>
					 '.get_post_meta(get_the_ID(), '_adforest_ad_location', true ).'
					  </li>
                     <li> <i class="fa fa-clock-o"></i>
					 '.get_the_date(get_option( 'date_format' ), get_the_ID() ).'
					 </li>
                     <li class="views"> <i class="fa fa-eye"></i>
					 '.adforest_getPostViews(get_the_ID()) . " " . __( 'Views', 'adforest') .'
					 </li>
                  </ul>
                  <!-- View All Button -->
                  <div class="detail-button">
				  <a href="'.get_the_permalink().'">'. __('View Details', 'adforest' ) .'</a>
				  </div>
               </div>
            </div>
         </div>
		';

}

function adforest_search_layout_list_2( $pid, $is_show = true )
{
		$number	= 0;
		global $adforest_theme;
		$cats_html	=	adforest_display_cats( $pid );
					
		$img	=	'';
		$media	=	 adforest_get_ad_images($pid);
		if( count( $media ) > 0 )
		{
			foreach( $media as $m )
			{
				$mid	=	'';
				if ( isset( $m->ID ) )
					$mid	= 	$m->ID;
				else
					$mid	=	$m;
				
				$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
				$img = '<img src="'.$image[0].'" alt="'.get_the_title().'" class="img-responsive">';
				break;
			}
	
	}
		else
		{
			$img = '<img src="'.$adforest_theme['default_related_image']['url'].'" alt="'.get_the_title().'" class="img-responsive">';
		}
		
		$is_feature	=	'';
		if( get_post_meta( get_the_ID(), '_adforest_is_feature', true ) == '1' )
		{
			$is_feature	=	'<div class="featured-ribbon">
			  <span>'.__('Featured','adforest').'</span>
		   </div>';
		}
		
		$pid	=	get_the_ID();
		$author_id = get_post_field( 'post_author', $pid );;

		$warranty = '';
		if( get_post_meta(get_the_ID(), '_adforest_ad_warranty', true ) != "" && isset( $adforest_theme['allow_tax_warranty'] ) && $adforest_theme['allow_tax_warranty'] )
		{
					
		$warranty = ' <li><div class="custom-tooltip tooltip-effect-4">
						<span class="tooltip-item"><i class="fa fa-check-square-o"></i></span>
						<div class="tooltip-content"> 
						<strong>'.__('Warranty','adforest') .'</strong>
						<span class="label label-danger">'.get_post_meta(get_the_ID(), '_adforest_ad_warranty', true ).'</span> </div>
					 </div>
				  </li>';	
		}
		$condition = '';
		if( isset( $adforest_theme['allow_tax_condition'] ) && $adforest_theme['allow_tax_condition'] && get_post_meta(get_the_ID(), '_adforest_ad_condition', true ) != "" )
		{
			
			
					
		$condition = ' <li>
						 <div class="custom-tooltip tooltip-effect-4">
							<span class="tooltip-item"><i class="fa fa-cog"></i></span>
							<div class="tooltip-content">
							<strong>'.__('Condition','adforest') .'</strong>
							<span class="label label-danger">
							'.get_post_meta(get_the_ID(), '_adforest_ad_condition', true ).'
							</span>
							</div>
						 </div>
					  </li>';	
		}
		
$list_col_1 = 'col-lg-5 col-md-5 col-sm-5 no-padding';
$list_col_2 = 'col-lg-7 col-md-7 col-sm-7 no-padding';
$modern_feature = '';
if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
{
	$list_col_1 = 'col-lg-4 col-md-4 col-sm-4 no-padding';
	$list_col_2 = 'col-lg-8 col-md-8 col-sm-8 no-padding';
	$modern_feature = $is_feature;
	$is_feature = '';
}

$poster_contact	=	'';
	if( get_post_meta(get_the_ID(), '_adforest_poster_contact', true ) != "" && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'phone' ) )
	{
		$poster_contact	=	' <li>
								<div class="custom-tooltip tooltip-effect-4">
									<span class="tooltip-item"><i class="fa fa-phone"></i></span>
									<div class="tooltip-content">
									   <h4>'.get_post_meta(get_the_ID(), '_adforest_poster_contact', true ).'</h4>
									</div>
								 </div>
							  </li>';
	}

$options_html	=	'';
if( $is_show )
{
	$options_html = '<ul class="add_info">
                                          <!-- Contact Details -->
                                         '.$poster_contact.'
                                          <!-- Address -->
                                          <li>
                                             <div class="custom-tooltip tooltip-effect-4">
                                                <span class="tooltip-item"><i class="fa fa-map-marker"></i></span>
                                                <div class="tooltip-content">
                                                   '.get_post_meta(get_the_ID(), '_adforest_ad_location', true ).'
                                                </div>
                                             </div>
                                          </li>
                                          <!-- Ad Condition -->
                                          '.$condition.'
                                          <!-- Warranty -->
											'.$warranty.'
                                       </ul>';	
}



		return '
			<div class="ads-list-archive">
                                 <!-- Image Block -->
                                 <div class="'.esc_attr($list_col_1).'">
                                    <!-- Img Block -->
                                    <div class="ad-archive-img list-3">
									'.$modern_feature.'
									'.adforest_video_icon().'
                                       <a href="'.get_the_permalink().'">
                                          '.$img.'
										  '.$is_feature.'
                                       </a>
                                    </div>
                                    <!-- Img Block -->
                                 </div>
                                 <!-- Ads Listing -->
                                 <div class="clearfix visible-xs-block"></div>
                                 <!-- Content Block -->
                                 <div class="'.esc_attr($list_col_2).'">
                                    <!-- Ad Desc -->
                                    <div class="ad-archive-desc">
                                       <!-- Price -->
                                       <div class="ad-price">
									   '.adforest_adPrice(get_the_ID()).'
									   </div>
                                       <!-- Title -->
                                       <h3><a title="" href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
                                       <!-- Category -->
                                       <div class="category-title">'.$cats_html.'</div>
                                       <!-- Short Description -->
                                       <div class="clearfix visible-xs-block"></div>
                                       <p class="hidden-sm">'.adforest_words_count( get_the_excerpt(), 110 ) .'</p>
                                       <!-- Ad Features -->
                                       '.$options_html.'
                                       <!-- Ad History -->
                                       <div class="clearfix archive-history">
                                          <div class="last-updated">'.__('Posted', 'adforest').':'.get_the_date(get_option( 'date_format' ), get_the_ID() ).'</div>
                                          <div class="ad-meta">
										  <a href="'.get_the_permalink().'" class="btn btn-success"><i class="fa fa-phone"></i> '. __('View Details', 'adforest' ).'</a>
										   </div>
                                       </div>
                                    </div>
                                    <!-- Ad Desc End -->
                                 </div>
                                 <!-- Content Block End -->
                              </div>
		';
		
}

function adforest_search_layout_list_3( $pid )
{
		$number	= 0;
		global $adforest_theme;
		$cats_html	=	adforest_display_cats( $pid );
					
		$img	=	'';
		$media	=	 adforest_get_ad_images($pid);
		if( count( $media ) > 0 )
		{
			foreach( $media as $m )
			{
				$mid	=	'';
				if ( isset( $m->ID ) )
					$mid	= 	$m->ID;
				else
					$mid	=	$m;
				
				$image  = wp_get_attachment_image_src( $mid, 'adforest-ad-related');
				$img = '<img src="'.$image[0].'" alt="'.get_the_title().'" class="img-responsive">';
				break;
			}
	
	}
		else
		{
			$img = '<img src="'.$adforest_theme['default_related_image']['url'].'" alt="'.get_the_title().'" class="img-responsive">';
		}
		
		$is_feature	=	'';
		if( get_post_meta( get_the_ID(), '_adforest_is_feature', true ) == '1' )
		{
			$ribbion = 'featured-ribbon';
			if ( is_rtl() )
			{
				$ribbion = 'featured-ribbon-rtl';
			}
			$is_feature	=	'<div class="'.esc_attr( $ribbion ).'">
			  <span>'.__('Featured','adforest').'</span>
		   </div>';
		}
		
		$pid	=	get_the_ID();
		$author_id = get_post_field( 'post_author', $pid );;

		$warranty = '';
		if( get_post_meta(get_the_ID(), '_adforest_ad_warranty', true ) != "" && isset( $adforest_theme['allow_tax_warranty'] ) && $adforest_theme['allow_tax_warranty'] )
		{
					
		$warranty = ' <li><div class="custom-tooltip tooltip-effect-4">
						<span class="tooltip-item"><i class="fa fa-check-square-o"></i></span>
						<div class="tooltip-content"> 
						<strong>'.__('Warranty','adforest') .'</strong>
						<span class="label label-danger">'.get_post_meta(get_the_ID(), '_adforest_ad_warranty', true ).'</span> </div>
					 </div>
				  </li>';	
		}
		$condition = '';
		if( isset( $adforest_theme['allow_tax_condition'] ) && $adforest_theme['allow_tax_condition'] && get_post_meta(get_the_ID(), '_adforest_ad_condition', true ) != "" )
		{
			
			
					
		$condition = ' <li>
						 <div class="custom-tooltip tooltip-effect-4">
							<span class="tooltip-item"><i class="fa fa-cog"></i></span>
							<div class="tooltip-content">
							<strong>'.__('Condition','adforest') .'</strong>
							<span class="label label-danger">
							'.get_post_meta(get_the_ID(), '_adforest_ad_condition', true ).'
							</span>
							</div>
						 </div>
					  </li>';	
		}
		
$modern_feature = '';
if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
{
	$modern_feature = $is_feature;
	$is_feature = '';
}

		return  '
		<li class="ad">
                                 <div class="content-zone">
								 
                                    <div class="col-md-4 col-sm-4 col-xs-12">
									'.$is_feature.'
                                       <div class="img-zone">
									   '.$modern_feature.'
									   '.adforest_video_icon().'
                                          '.$img.'
                                          <div class="quick-view">
										  <a href="'.get_the_permalink().'" class="view-button">
										  <i class="fa fa-search"></i>
										  </a>
										  </div>
                                       </div>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                       <div class="short-description-1 ">
									   
                                          <!-- Category Title -->
                                          <div class="category-title">'.$cats_html.'</div>
                                          <!-- Ad Title -->
                                          <h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
										<ul class="list-3-short-info list-inline">
										  <li><a href="javascript:void(0);"> <i class="fa fa-map-marker"></i> 
													'.get_post_meta(get_the_ID(), '_adforest_ad_location', true ).'</a></li>
										  <li><a href="javascript:void(0);"> <i class="fa fa-clock-o"></i> 
													'.get_the_date(get_option( 'date_format' ), get_the_ID() ).' </a></li>
										</ul>		
										<p class="hidden-sm">'.adforest_words_count( get_the_excerpt(), 110 ) .'</p>
										  
										  
                                          <!-- Price -->
										  <span class="ad-price">
										  '.adforest_adPrice(get_the_ID()).'
										  </span> 
                                       </div>
                                    </div>
                                 </div>
                              </li>
		';
		
		
}


}
}

?>