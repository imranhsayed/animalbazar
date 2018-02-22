<?php
/* ------------------------------------------------ */
/* Post Ad  */
/* ------------------------------------------------ */

function ad_post_short()
{
	vc_map(array(
		"name" => __("Ad Post", 'adforest') ,
		"base" => "ad_post_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		
			array(
				
				"type" => "dropdown",
				"heading" => __("Ad Post Form Type", 'adforest') ,
				"param_name" => "ad_post_form_type",
				"admin_label" => true,
				"value" => array(
					__('Select Post Form', 'adforest') => '',
					__('Default Form', 'adforest') => 'no',
					__('Categories Based Form', 'adforest') => 'yes',
				) ,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				"std" => 'no',
				"description" => __("Select the ad post form type default or with dynamic categories based. Extra fields will only works with default form.", 'adforest'),
			),			
			adforest_generate_type( __('Section Title', 'adforest' ), 'textfield', 'section_title' ),
			adforest_generate_type( __('Section Description', 'adforest' ), 'textarea', 'section_description' ),
			adforest_generate_type( __('Extra Fields Section Title', 'adforest' ), 'textfield', 'extra_section_title' ),
			adforest_generate_type( __('Tip Section Title', 'adforest' ), 'textfield', 'tip_section_title' ),
			adforest_generate_type( __('Tips Description', 'adforest' ), 'textarea', 'tips_description' ),
			
			// Making add more loop for fields
			array
				(
					'group' => __( 'Extra Fields', 'adforest' ),
					'type' => 'param_group',
					'heading' => __( 'Add field', 'adforest' ),
					'param_name' => 'fields',
					'value' => '',
					'dependency' => array(
					'element' => 'ad_post_form_type',
					'value' => 'no',
					) ,
					'params' => array
					(
						adforest_generate_type( __('Title', 'adforest' ), 'textfield', 'title' ),
						adforest_generate_type( __('Slug', 'adforest' ), 'textfield', 'slug', __('This should be unique and if you change it the pervious data of this field will be lost', 'adforest' ) ),
						adforest_generate_type( __('Type', 'adforest' ), 'dropdown', 'type', '', "", array( "Please select" => "", "Textfield" => "text", "Select/List" => "select" ) ),
						adforest_generate_type( __('Values for Select/List', 'adforest' ), 'textarea', 'option_values' ,__('Like: value1,value2,value3', 'adforest') ,'', '', '', 'vc_col-sm-12 vc_column', array( 'element' => 'type' , 'value' => 'select' ) ),
					)
			),
			
			// Making add more loop for tips
			array
				(
					'group' => __( 'Saftey Tips', 'adforest' ),
					'type' => 'param_group',
					'heading' => __( 'Add Tip', 'adforest' ),
					'param_name' => 'tips',
					'value' => '',
					'params' => array
					(
						adforest_generate_type( __('Tip', 'adforest' ), 'textarea', 'description' ),
					)
			),

		) ,
	));
}

add_action('vc_before_init', 'ad_post_short');

function ad_post_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'section_title' => '',
		'section_description' => '',
		'tip_section_title' => '',
		'extra_section_title' => '',
		'tips_description' => '',
		'fields' => '',
		'tips' => '',
		'ad_post_form_type' => 'no',
	) , $atts));
	
	// Making tips
	$tips	=	'';
	if( isset( $atts['tips'] ) )
	{
		$rows = vc_param_group_parse_atts( $atts['tips'] );
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['description'] ))
				{
					$tips	.=	'<li>'.$row['description'].'</li>';
				}
			}
		}
	}

	$profile	=	new adforest_profile();
	global $adforest_theme;	
	
	$size_arr	=	explode( '-', $adforest_theme['sb_upload_size'] );
	$display_size	=	$size_arr[1];
	$actual_size	=	$size_arr[0];
	
	adforest_user_not_logged_in();	

	$description='';
	$title='';
	$price='';
	$poster_name='';
	$poster_ph='';
	$ad_location='';
	$ad_condition='';
	$is_update='';
	$level='';
	
	$cats_html	=	'';
	$sub_cats_html	=	'';
	$sub_sub_cats_html	=	'';
	$sub_sub_sub_cats_html	=	'';
	
	$type_selected	=	'';
	
	$ad_type	=	'';
	$ad_warranty	=	'';
	$tags	=	'';
	$id	=	'';
	
	$ad_yvideo = '';
	
	$ad_map_lat = '';
	$ad_map_long = '';
	$ad_bidding = '';
	
	
	
	if( isset( $_GET['id'] ) )
	{
		$id	=	 $_GET['id'];
		$my_url = adforest_get_current_url();
		if (strpos($my_url, 'adforest.scriptsbundle.com') !== false && !is_super_admin( get_current_user_id() ) )
		{
			echo adforest_redirect( home_url( '/' ) );
			exit;	
		}
		if( get_post_field( 'post_author', $id ) != get_current_user_id() && !is_super_admin( get_current_user_id() ) )
		{
			echo adforest_redirect( home_url( '/' ) );
			exit;
		}
		else
		{
			$post = get_post($id);
			$description = $post->post_content;
			$title	=	$post->post_title;
			$price	= get_post_meta($id, '_adforest_ad_price', true);
			$poster_name	= get_post_meta($id, '_adforest_poster_name', true);
			$poster_ph	= get_post_meta($id, '_adforest_poster_contact', true);
			$ad_location	= get_post_meta($id, '_adforest_ad_location', true);
			$ad_condition	= get_post_meta($id, '_adforest_ad_condition', true);
			$ad_type	= get_post_meta($id, '_adforest_ad_type', true);
			$ad_warranty	= get_post_meta($id, '_adforest_ad_warranty', true);
			$ad_yvideo	= get_post_meta($id, '_adforest_ad_yvideo', true);
			$ad_map_lat	= get_post_meta($id, '_adforest_ad_map_lat', true);
			$ad_map_long	= get_post_meta($id, '_adforest_ad_map_long', true);
			$ad_bidding	= get_post_meta($id, '_adforest_ad_bidding', true);
			
			
			$tags_array = wp_get_object_terms( $id,  'ad_tags', array('fields' => 'names') );
			$tags	=	implode( ',', $tags_array );
			
			$is_update	=	$id;
			$cats	=	adforest_get_ad_cats ( $id );
			
			$level	=	count($cats);
			/* Make cats selected on update ad */
			$ad_cats	=	adforest_get_cats('ad_cats' , 0 );
			$cats_html	=	'';
			foreach( $ad_cats as $ad_cat )
			{
				$selected	=	'';
				if( $level > 0 && $ad_cat->term_id == $cats[0]['id'] )
				{
				$selected	=	'selected="selected"';
				}
				$cats_html	.=	'<option value="'.$ad_cat->term_id.'" '.$selected.'>' . $ad_cat->name .  '</option>';
			}
			
			if( $level >= 2 )
			{
				$ad_sub_cats	=	adforest_get_cats('ad_cats' , $cats[0]['id'] );
				$sub_cats_html	=	'';
				foreach( $ad_sub_cats as $ad_cat )
				{
					$selected	=	'';
					if( $level > 0 && $ad_cat->term_id == $cats[1]['id'] )
					{
						$selected	=	'selected="selected"';
					}
					$sub_cats_html	.=	'<option value="'.$ad_cat->term_id.'" '.$selected.'>' . $ad_cat->name .  '</option>';
					
				}
				
			}

			
			if( $level >= 3 )
			{
				$ad_sub_sub_cats	=	adforest_get_cats('ad_cats' , $cats[1]['id'] );
				$sub_sub_cats_html	=	'';
				foreach( $ad_sub_sub_cats as $ad_cat )
				{
					$selected	=	'';
					if( $level > 0 && $ad_cat->term_id == $cats[2]['id'] )
					{
						$selected	=	'selected="selected"';
					}
					$sub_sub_cats_html	.=	'<option value="'.$ad_cat->term_id.'" '.$selected.'>' . $ad_cat->name .  '</option>';
					
				}
				
			}

			
			if( $level >= 4 )
			{
				$ad_sub_sub_sub_cats	=	adforest_get_cats('ad_cats' , $cats[2]['id'] );
				$sub_sub_sub_cats_html	=	'';
				foreach( $ad_sub_sub_sub_cats as $ad_cat )
				{
					$selected	=	'';
					if( $level > 0 && $ad_cat->term_id == $cats[3]['id'] )
					{
						$selected	=	'selected="selected"';
					}
					$sub_sub_sub_cats_html	.=	'<option value="'.$ad_cat->term_id.'" '.$selected.'>' . $ad_cat->name .  '</option>';
					
				}
				
			}

		}
	
	}
	else
	{
		if( !$adforest_theme['admin_allow_unlimited_ads'] )
		{
			adforest_check_validity();
		}
		$user	=	wp_get_current_user();
		$user_role	=	  $user->roles ? $user->roles[0] : false;
		if( $user_role != "administrator" )
		{
			adforest_check_validity();	
		}
		
		
		$poster_name	=	$profile->user_info->display_name;
		$poster_ph	=	$profile->user_info->_sb_contact;
		$ad_location	=	get_user_meta($profile->user_info->ID, '_sb_address', true );
	
		$ad_cats	=	adforest_get_cats('ad_cats' , 0 );
		$cats_html	=	'';
		foreach( $ad_cats as $ad_cat )
		{
			$cats_html	.=	'<option value="'.$ad_cat->term_id.'">' . $ad_cat->name .  '</option>';
		}
	}
	
	
	$ad_type_html	=	'<select class="category form-control" id="type" name="buy_sell">
					<option value="">'. __('Select Option', 'adforest' ) . '</option>';
	$types	=	adforest_get_cats('ad_type' , 0 );
	foreach( $types as $type )
	{
		$selected	=	'';
		if( $ad_type == $type->name )
		{
			$selected = 'selected="selected"';
		}

		$ad_type_html	.=		'<option value="'.$type->term_id.'|'.$type->name.'"'.$selected.'>'. $type->name . '</option>';
	}
	$ad_type_html	.=	'</select>';
	
	$ad_condition_html	=	'';
	if( $adforest_theme['allow_tax_condition'] )
	{
		$ad_condition_html	=	'<div class="row" >
			  <!-- Category  -->
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			  <label class="control-label">'. __('Item Condition', 'adforest' ) . '</label><select class="category form-control" id="condition" name="condition">
						<option value="">'. __('Select Option', 'adforest' ) . '</option>';
		$conditions	=	adforest_get_cats('ad_condition' , 0 );
		foreach( $conditions as $con )
		{
			$selected	=	'';
			if( $ad_condition == $con->name )
			{
				$selected = 'selected="selected"';
			}
	
			$ad_condition_html	.=		'<option value="'.$con->term_id.'|'.$con->name.'"'.$selected.'>'. $con->name . '</option>';
		}
		$ad_condition_html	.=	'</select></div></div>';
	}
	$ad_warranty_html	=	'';
	if( $adforest_theme['allow_tax_warranty'] )
	{
		$ad_warranty_html	=	'<div class="row" >
			  <!-- Category  -->
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			  <label class="control-label">'. __('Warranty', 'adforest' ) . '</label><select class="category form-control" id="warranty" name="ad_warranty">
						<option value="">'. __('Select Option', 'adforest' ) . '</option>';
		$ad_warraty	=	adforest_get_cats('ad_warranty' , 0 );
		foreach( $ad_warraty as $warranty )
		{
			$selected	=	'';
			if( $ad_warranty == $warranty->name )
			{
				$selected = 'selected="selected"';
			}
	
			$ad_warranty_html	.=		'<option value="'.$warranty->term_id.'|'.$warranty->name.'"'.$selected.'>'. $warranty->name . '</option>';
		}
		$ad_warranty_html	.=	'</select></div></div>';
	}
	
		$extra_fields_html	=	'';
		// Making fields
		if(isset($atts['fields'])){
		$rows = vc_param_group_parse_atts( $atts['fields'] );
		if( count( $rows[0] ) > 0 && count( $rows ) > 0 )
		{
			$total_fileds	=	1;
			$extra_fields_html	.= '<div class="select-package">
			   <div class="no-padding col-md-12 col-lg-12 col-xs-12 col-sm-12">
				 <h3 class="margin-bottom-10">'. $extra_section_title . '</h3>
				 <hr />
			  </div>
			</div>';
			foreach($rows as $row )
			{
				if( isset( $row['title'] ) && isset( $row['type'] ) && isset( $row['slug'] ) )
				{
					$extra_fields_html	.=	'<div class="row">
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
				 <label class="control-label">'.$row['title'].'</label>';
					if( $row['type'] == 'text' )
					{
					$extra_fields_html	.=	'<input class="form-control" value="'.get_post_meta($id, '_sb_extra_' . $row['slug'], true ).'" type="text" name="sb_extra_'.$total_fileds.'" id="sb_extra_'.$total_fileds.'" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'"></div></div>';
					}
					if( $row['type'] == 'select' && isset( $row['option_values'] ) )
					{
						$extra_fields_html	.= '<select class="category form-control" id="sb_extra_'.$total_fileds.'" name="sb_extra_'.$total_fileds.'">';
						$options	=	explode( ',', $row['option_values'] );
						foreach( $options as $key => $value )
						{
							$is_select	=	'';
							if( $value == get_post_meta($id, '_sb_extra_' . $row['slug'], true ) )
							{
								$is_select	=	'selected';	
							}
							$extra_fields_html	.= '<option value="'.$value.'" '.$is_select.'>'.$value.'</option>';	
						}
						$extra_fields_html	.= '</select></div></div>';
					}
					$extra_fields_html	.= '<input type="hidden" name="title_'.$total_fileds.'" value="'.$row['slug'].'">';
					$total_fileds++;
				}
			}
			$total_fileds	=	$total_fileds - 1;
			$extra_fields_html	.= '<input type="hidden" name="sb_total_extra" value="'.$total_fileds.'">';
		}
		}

/* Only need on this page so inluded here don't want to increase page size for optimizaion by adding extra scripts in all the web */
wp_enqueue_style( 'jquery-tagsinput', trailingslashit( get_template_directory_uri () )  . 'css/jquery.tagsinput.min.css' );
wp_enqueue_style( 'jquery-te', trailingslashit( get_template_directory_uri () )  . 'css/jquery-te.css' );
wp_enqueue_style( 'dropzone', trailingslashit( get_template_directory_uri () )  . 'css/dropzone.css' );
adforest_load_search_countries();
wp_enqueue_script( 'google-map-callback');

$update_notice = '';
if( isset( $id ) && $id != "" )
{
	$update_notice = '<div class="row">
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
<div role="alert" class="alert alert-info alert-dismissible">
<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
'.$adforest_theme['sb_ad_update_notice'].'
</div>
</div>
</div>';	
}
	
	$isCustom = $ad_post_form_type;
	
	$imageStaticHTML = $priceStaticHTML = $someStaticHTML = $customDynamicFields = $customDynamicAdType = '';
	if($isCustom == 'no')
	{
		
		
	  $priceStaticHTML =  '<div class="row"><!-- Price  -->
		  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			 <label class="control-label">'. __('Minimum Deposit', 'adforest' ) . '<small>'. $adforest_theme['sb_currency'] . " " .  __('only', 'adforest' ) . '</small></label>
			 <input class="form-control" type="text" name="ad_price" data-parsley-required="true" data-parsley-type="integer" data-parsley-error-message="'. __( 'Can\'t be empty and only integers allowed.', 'adforest' ) .'" value="'.$price.'">
		  </div>
	   </div>';
		
		
		$imageStaticHTML = '<!-- Image Upload  -->
		<div class="row">
		  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			 <label class="control-label">'. __('Click the box below to ad photos', 'adforest' ) . ' <small>'.__( 'upload only jpg, png and jpeg files with a max file size of', 'adforest' ) ." " . $display_size  . '</small></label>
			 <div id="dropzone" class="dropzone"></div>
		  </div>
		</div>';
		
		
		$someStaticHTML = '<div class="row">
			  <!-- Youtube Video  -->
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
				 <label class="control-label">'. __('Youtube Video Link', 'adforest' ) . '</label>
				 <input class="form-control" type="text" name="ad_yvideo" value="'.$ad_yvideo.'">
			  </div>
		   </div>
		   		   
		   <div class="row">
				<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
					 <label class="control-label">'. __('Tags', 'adforest' ) . ' <small>'. __('Comma(,) separated', 'adforest' ) . '</small></label>
					 <input class="form-control" name="tags" id="tags" value="'.$tags.'" >
					 
				</div>
			</div>
	   
		   <!-- Ad Type  -->
		   <div class="row" >
			  <!-- Category  -->
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			  <label class="control-label">'. __('Type of Ad', 'adforest' ) . '</label>
				'.$ad_type_html.'
			  </div>
			  
			</div>
		   <!-- Ad Condition  -->
				'.$ad_condition_html.'
			
		   <!-- Ad Warranty  -->
				'.$ad_warranty_html.'
			
			'.$extra_fields_html.'';
		
	}
	else
	{
		
		$customDynamicAdType = '';
		$customDynamicFields = '<div id="dynamic-fields"> '.adforest_returnHTML($id).' </div>';
	
	}
	
	$lat_long_html = '';
	if( isset( $adforest_theme['allow_lat_lon'] ) &&  !$adforest_theme['allow_lat_lon']  )
	{
	}
	else
	{
		$lat_long_html = '<div class="row">
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
				 <label class="control-label">'.__( 'Latitude', 'adforest' ).'</label>
				 <input class="form-control" type="text" name="ad_map_lat" value="'.$ad_map_lat.'">
			  </div>
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
				 <label class="control-label">'.__( 'Longitude', 'adforest' ).'</label>
				 <input class="form-control" name="ad_map_long" value="'.$ad_map_long.'" type="text">
			  </div>
		   </div>
		   <!-- end row -->
';	
	}
	
	// Check phone is required or not
	$phone_html = '<input class="form-control" name="sb_contact_number" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'" value="'.$poster_ph.'" type="text">';
	if( isset( $adforest_theme['sb_user_phone_required'] ) && !$adforest_theme['sb_user_phone_required'] )
	{
		$phone_html = '<input class="form-control" name="sb_contact_number" value="'.$poster_ph.'" type="text">';
	}
	
		$bidable	=	'';
		if( isset( $adforest_theme['sb_enable_comments_offer_user'] ) && $adforest_theme['sb_enable_comments_offer_user'] )
		{
			$bidable	.=	'<div class="select-package">
			   <div class="no-padding col-md-12 col-lg-12 col-xs-12 col-sm-12">
				 <h3 class="margin-bottom-10">'. $adforest_theme['sb_enable_comments_offer_user_title'] . '</h3>
				 <hr />
			  </div>
			</div>';
			$bid_on	=	'';
			$bid_off	= '';
			if( $ad_bidding == 1)
			{
				$bid_on	=	'selected=selected';	
			}
			else
			{
				$bid_off	=	'selected=selected';
			}
			
			$bidding_options	=	'<option value="1" '.$bid_on.'>'.__('ON','adforest').'</option>';
			$bidding_options	.=	'<option value="0" '.$bid_off.'>'.__('OFF','adforest').'</option>';
			$bidable	.=	'<div class="row"><div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			 <select class="form-control" name="ad_bidding" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'">
					'.$bidding_options.'
			</select>
		  </div></div>';
		}

	
return   ' 
  <section class="section-padding  gray ">
<!-- Main Container -->
<div class="container"><div class="loading" id="sb_loadings"></div>
'.$update_notice.'
<!-- Row -->
<div class="row">
  <div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
	 <!-- end post-padding -->
	 <div class="post-ad-form postdetails">
		<div class="heading-panel">
		   <h3 class="main-title text-left">
			  '.$section_title.'
		   </h3>
		</div>
		<p class="lead">'.$section_description.'</p>
		<form  class="submit-form" id="ad_post_form">
		   <!-- Title  -->
		   <div class="row">
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
				 <label class="control-label">'.__( 'Title', 'adforest' ) .'</label>
				 <input class="form-control" placeholder="'.__( 'Enter title', 'adforest' ) .'" type="text" name="ad_title" id="ad_title" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'" value="'.$title.'">
				 <input type="hidden" id="is_update" name="is_update" value="'.$is_update.'" />
				 <input type="hidden" id="is_level" name="is_level" value="'.$level.'" />
			  </div>
		   </div>
		   
		   '.$customDynamicAdType.'
		   	'.$priceStaticHTML.'
		   <div class="row">
			  <!-- Category  -->
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
				 <label class="control-label">'. __('Category', 'adforest' ) . ' <small>'. __('Select suitable category for your ad', 'adforest' ) . '</small></label>
				 <select class="category form-control" id="ad_cat" name="ad_cat" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'">
					<option value="">Select Option</option>
					'.$cats_html.'
				 </select>
				 <input type="hidden" name="ad_cat_id" id="ad_cat_id" value="" />
			  </div>
		   </div>
		   
		   <!-- end row -->
		   <div class="row" id="ad_cat_sub_div">
			  <!-- Category  -->
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" >
				<select class="category form-control" id="ad_cat_sub" name="ad_cat_sub">
					'.$sub_cats_html.'
				</select>

			  </div>
			  
			</div>
			
		   <div class="row" id="ad_cat_sub_sub_div" >
			  <!-- Category  -->
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
				<select class="category form-control" id="ad_cat_sub_sub" name="ad_cat_sub_sub">
					'.$sub_sub_cats_html.'
				</select>

			  </div>
			  
			</div>
		   
		   <div class="row" id="ad_cat_sub_sub_sub_div">
			  <!-- Category  -->
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
				<select class="category form-control" id="ad_cat_sub_sub_sub" name="ad_cat_sub_sub_sub">
					'.$sub_sub_sub_cats_html.'
				</select>

			  </div>
			  
			</div>
		   
		   
		   		'.$imageStaticHTML.'
		   
		   '.$customDynamicFields.'
		   
		   <!-- end row -->
		   <!-- Ad Description  -->
		   <div class="row">
			  <div class="col-md-12 col-lg-12 col-xs-12  col-sm-12">
				 <label class="control-label">'. __('Ad Description', 'adforest' ) . ' <small>'. __('Enter long description for your project', 'adforest' ) . '</small></label>
				 <textarea rows="18" class="form-control" name="ad_description" id="ad_description">'.$description.'</textarea>
			  </div>
		   </div>
		   <!-- end row -->
			
			'.$someStaticHTML.'
			
			'.$bidable.'
			
			<div class="select-package">
			   <div class="no-padding col-md-12 col-lg-12 col-xs-12 col-sm-12">
				 <h3 class="margin-bottom-10">'. __('User Information', 'adforest' ) . '</h3>
				 <hr />
			  </div>
			</div>
			
			
			
		   <!-- end row -->
		   <div class="row">
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
				 <label class="control-label">'.__( 'Your Name', 'adforest' ).'</label>
				 <input class="form-control" type="text" name="sb_user_name" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'" value="'.$poster_name.'">
			  </div>
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
				 <label class="control-label">'.__( 'Mobile Number', 'adforest' ).'</label>
				 '.$phone_html.'
			  </div>
		   </div>
		   <!-- end row -->
		   '.$lat_long_html.'
		   <div class="row">
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
				 <label class="control-label">'.__( 'Address', 'adforest' ).'</label>
				 <input class="form-control" value="'.$ad_location.'" type="text" name="sb_user_address" id="sb_user_address" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'" placeholder="'.__('Enter a location','adforest').'">
			  </div>
		   </div>
		   <!-- end row -->
		   <button class="btn btn-theme pull-right" id="ad_submit">'.__( 'Post My Ad', 'adforest' ).'</button>
		</form>
	 </div>
	 <!-- end post-ad-form-->
  </div>
  <!-- end col -->
  <!-- Right Sidebar -->
  <div class="col-md-4 col-xs-12 col-sm-12">
	 <!-- Sidebar Widgets -->
	 <div class="blog-sidebar">
		<!-- Categories --> 
		<div class="widget">
		   <div class="widget-heading">
			  <h4 class="panel-title"><a>'.$tip_section_title.'</a></h4>
		   </div>
		   <div class="widget-content">
			  <p class="lead">'.$tips_description.'</p>
			  <ol>
				 '.$tips.'
			  </ol>
		   </div>
		</div>
		<!-- Latest News --> 
	 </div>
	 <!-- Sidebar Widgets End -->
  </div>
  <!-- Middle Content Area  End --><!-- end col -->
</div>
<!-- Row End -->
</div>
<!-- Main Container End -->
</section>
';

}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('ad_post_short_base', 'ad_post_short_base_func');
}