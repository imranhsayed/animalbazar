<?php
/* ------------------------------------------------ */
/* Post Ad  */
/* ------------------------------------------------ */
if ( !function_exists ( 'ad_post_short' ) ) {
function ad_post_short()
{
	vc_map(array(
		"name" => __("Ad Post - Modern", 'adforest') ,
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
			adforest_generate_type( __('Extra Fields Section Title', 'adforest' ), 'textfield', 'extra_section_title' ),
			
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

		) ,
	));
}
}

add_action('vc_before_init', 'ad_post_short');
if ( !function_exists ( 'ad_post_short_base_func' ) ) {
function ad_post_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'extra_section_title' => '',
		'tips_description' => '',
		'fields' => '',
		'ad_post_form_type' => 'no',
	) , $atts));
	
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
	
	$ad_price_type = '';
	$is_feature_ad	= 0;
	
	$ad_currency	=  '';
	$levelz='';
	$country_html 	=	'';
	$country_states	=	'';
	$country_cities	=	'';
	$country_towns	=	'';
	
	
	
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
			$ad_price_type	= get_post_meta($id, '_adforest_ad_price_type', true);
			$is_feature_ad	= get_post_meta($id, '_adforest_is_feature', true);
			$ad_currency	= get_post_meta($id, '_adforest_ad_currency', true);
			
			
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
				$selected	=	' selected="selected"';
				}
				$cats_html	.=	'<option value="'.$ad_cat->term_id.'" '.$selected.' class="select-'.$ad_cat->term_id.'">' . $ad_cat->name .  '</option>';
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
						$selected	=	' selected="selected"';
						$data_attr_selected = 'data-attr-selected';
					}
					$sub_cats_html	.=	'<option value="'.$ad_cat->term_id.'" '.$selected.' ' . $data_attr_selected . '>' . $ad_cat->name .  '</option>';
					
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
						$selected	=	' selected="selected"';
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
						$selected	=	' selected="selected"';
					}
					$sub_sub_sub_cats_html	.=	'<option value="'.$ad_cat->term_id.'" '.$selected.'>' . $ad_cat->name .  '</option>';
					
				}
				
			}
			
			
			//Countries
			$countries	=	adforest_get_ad_cats ( $id, '',true );
			$levelz	=	count($countries);
			/* Make cats selected on update ad */
			$ad_countries	=	adforest_get_cats('ad_country' , 0 );

			$country_html	=	'';
			foreach( $ad_countries as $ad_country )
			{
				$selected	=	'';
				if( $levelz > 0 && $ad_country->term_id == $countries[0]['id'] )
				{
					$selected	=	'selected="selected"';
				}
				$country_html	.=	'<option value="'.$ad_country->term_id.'" '.$selected.'>' . $ad_country->name .  '</option>';
			}
			
			if( $levelz >= 2 )
			{
			
				$ad_states	=	adforest_get_cats('ad_country' , $countries[0]['id'] );
				$country_states	=	'';
				foreach( $ad_states as $ad_state )
				{
					$selected	=	'';
					if( $levelz > 0 && $ad_state->term_id == $countries[1]['id'] )
					{
						$selected	=	'selected="selected"';
					}
					$country_states	.=	'<option value="'.$ad_state->term_id.'" '.$selected.'>' . $ad_state->name .  '</option>';
					
				}
				
			}
			
			if( $levelz >= 3 )
			{
				$ad_country_cities	=	adforest_get_cats('ad_country' , $countries[1]['id'] );
				$country_cities	=	'';
				foreach( $ad_country_cities as $ad_city )
				{
					$selected	=	'';
					if( $levelz > 0 && $ad_city->term_id == $countries[2]['id'] )
					{
						$selected	=	'selected="selected"';
					}
					$country_cities	.=	'<option value="'.$ad_city->term_id.'" '.$selected.'>' . $ad_city->name .  '</option>';
					
				}
				
			}
			
			if( $levelz >= 4 )
			{
				$ad_country_town	=	adforest_get_cats('ad_country' , $countries[2]['id'] );
				$country_towns	=	'';
				foreach( $ad_country_town as $ad_town )
				{
					$selected	=	'';
					if( $levelz > 0 && $ad_town->term_id == $countries[3]['id'] )
					{
						$selected	=	'selected="selected"';
					}
					$country_towns	.=	'<option value="'.$ad_town->term_id.'" '.$selected.'>' . $ad_town->name .  '</option>';
					
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
		if ( !is_super_admin( get_current_user_id() ) )
		{
			adforest_check_validity();	
		}
		
		
		$poster_name	=	$profile->user_info->display_name;
		$poster_ph	=	$profile->user_info->_sb_contact;
		//$ad_location	=	get_user_meta($profile->user_info->ID, '_sb_address', true );
	
		$ad_cats	=	adforest_get_cats('ad_cats' , 0 );
		$cats_html	=	'';
		foreach( $ad_cats as $ad_cat )
		{
			$cats_html	.=	'<option value="'.$ad_cat->term_id.'" class="select-'.$ad_cat->term_id.'">' . $ad_cat->name .  '</option>';
		}
		//Countries
		$ad_country	=	adforest_get_cats('ad_country' , 0 );
		$country_html	=	'';
		foreach( $ad_country as $ad_count )
		{
			$country_html	.=	'<option value="'.$ad_count->term_id.'">' . $ad_count->name .  '</option>';
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
			$selected = ' selected="selected"';
		}

		$ad_type_html	.=		'<option value="'.$type->term_id.'|'.$type->name.'"'.$selected.'>'. $type->name . '</option>';
	}
	$ad_type_html	.=	'</select>';
	
	$ad_condition_html	=	'';
	if( $adforest_theme['allow_tax_condition'] )
	{
//		$ad_condition_html	=	'
//			  <!-- Category  -->
//			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
//			  <label class="control-label">'. __('Item Condition', 'adforest' ) . '</label><select class="category form-control" id="condition" name="condition">
//						<option value="">'. __('Select Option', 'adforest' ) . '</option>';
//		$conditions	=	adforest_get_cats('ad_condition' , 0 );
//		foreach( $conditions as $con )
//		{
//			$selected	=	'';
//			if( $ad_condition == $con->name )
//			{
//				$selected = ' selected="selected"';
//			}
//
//			$ad_condition_html	.=		'<option value="'.$con->term_id.'|'.$con->name.'"'.$selected.'>'. $con->name . '</option>';
//		}
//		$ad_condition_html	.=	'</select></div>';
	}
	$ad_warranty_html	=	'';
	if( $adforest_theme['allow_tax_warranty'] )
	{
//		$ad_warranty_html	=	'
//			  <!-- Category  -->
//			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
//			  <label class="control-label">'. __('Warranty', 'adforest' ) . '</label><select class="category form-control" id="warranty" name="ad_warranty">
//						<option value="">'. __('Select Option', 'adforest' ) . '</option>';
//		$ad_warraty	=	adforest_get_cats('ad_warranty' , 0 );
//		foreach( $ad_warraty as $warranty )
//		{
//			$selected	=	'';
//			if( $ad_warranty == $warranty->name )
//			{
//				$selected = ' selected="selected"';
//			}
//
//			$ad_warranty_html	.=		'<option value="'.$warranty->term_id.'|'.$warranty->name.'"'.$selected.'>'. $warranty->name . '</option>';
//		}
//		$ad_warranty_html	.=	'</select></div>';
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
				 <label class="control-label">'.$row['title'].' <span class="required">*</span></label>';
					if( $row['type'] == 'text' )
					{
					$extra_fields_html	.=	'<input class="form-control" value="'.get_post_meta($id, '_sb_extra_' . $row['slug'], true ).'" type="text" name="sb_extra_'.$total_fileds.'" id="sb_extra_'.$total_fileds.'" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'"></div></div>';
					}
					if( $row['type'] == 'select' && isset( $row['option_values'] ) )
					{
						$extra_fields_html	.= '<select class="category form-control" id="sb_extra_'.$total_fileds.'" name="sb_extra_'.$total_fileds.'">';
						$extra_fields_html	.= '<option value="">'.__('None','adforest').'</option>';
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
wp_enqueue_style( 'adforest-wizard', trailingslashit( get_template_directory_uri () )  . 'css/smart_wizard.min.css' );
if( isset($adforest_theme['post_ad_layout']) && $adforest_theme['post_ad_layout'] == 'arrows' )
{
	wp_enqueue_style( 'adforest-wizard-arrows', trailingslashit( get_template_directory_uri () )  . 'css/smart_wizard_theme_arrows.css' );
}


adforest_load_search_countries(1);
wp_enqueue_script( 'google-map-callback');
wp_enqueue_script( 'jquery-smartWizard');
wp_enqueue_script( 'adforest-ad-wizard');

$update_notice = '';
if( isset( $id ) && $id != "" )
{
	$update_notice = '<div class="row">
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
<div role="alert" class="alert alert-info alert-dismissible '. adforest_alert_type() .'">
<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
'.$adforest_theme['sb_ad_update_notice'].'
</div>
</div>
</div>';	
}
	
	$isCustom = $ad_post_form_type;
	
	$imageStaticHTML = $priceStaticHTML = $priceTypeHTML = $ad_curreny_html = $someStaticHTML = $customDynamicFields = $customDynamicAdType = '';
	if($isCustom == 'no' )
	{
		
		$price_fixed	=	'';
		$price_negotiable= '';
		$price_on_call= '';
		$free= '';
		$no_price= '';
		$price_auction= '';
		if( $ad_price_type == 'Fixed' )
		{
			$price_fixed	=	'selected=selected';	
		}
		else if( $ad_price_type == 'Negotiable' )
		{
			$price_negotiable	=	'selected=selected';
		}
		else if( $ad_price_type == 'on_call' )
		{
			$price_on_call	=	'selected=selected';
		}
		else if( $ad_price_type == 'free' )
		{
			$free	=	'selected=selected';
		}
		else if( $ad_price_type == 'no_price' )
		{
			$no_price	=	'selected=selected';
		}
		else if( $ad_price_type == 'auction' )
		{
			$price_auction	=	'selected=selected';
		}
	  $priceStaticHTML =  '<div class="row"><!-- Price  -->
		  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			 <label class="control-label">'. __('Price', 'adforest' ) . ' <span class="required">*</span></label>
			 <input class="form-control" type="text" name="ad_price" id="ad_price" data-parsley-required="true" data-parsley-type="integer" data-parsley-error-message="'. __( 'only integers allowed.', 'adforest' ) .'" value="'.$price.'">
		  </div>
		  </div>';
		  
	   $priceTypeHTML = '<div class="row">
		  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			 <label class="control-label">'. __('Price Type', 'adforest' )  . '</label>
			 <select class="form-control" name="ad_price_type" id="ad_price_type">
					<option value="">'.__('None','adforest').'</option>
					<option value="Fixed" '.$price_fixed.'>'.__('Fixed','adforest').'</option>
					<option value="Negotiable" '.$price_negotiable.'>'.__('Negotiable','adforest').'</option>
					<option value="on_call" '.$price_on_call.'>'.__('Price on call','adforest').'</option>
					<option value="auction" '.$price_auction.'>'.__('Auction','adforest').'</option>
					<option value="free" '.$free.'>'.__('Free','adforest').'</option>
					<option value="no_price" '.$no_price.'>'.__('No price','adforest').'</option>
			</select>
		  </div>
	   </div>';

	   if( isset( $adforest_theme['allow_price_type'] )  )
	   {
		   if( $adforest_theme['allow_price_type'] )
		   {
			   $priceStaticHTML .= $priceTypeHTML;
		   }
	   }
	   else
	   {
			$priceStaticHTML . $priceTypeHTML;
	   }
		
		
		$imageStaticHTML = '<!-- Image Upload  -->
		<div class="row">
		  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			 <label class="control-label">'. __('Click the box below to ad photos', 'adforest' ) . ' <small>'.__( 'upload only jpg, png and jpeg files with a max file size of', 'adforest' ) ." " . $display_size  . '</small></label>
			 <div id="dropzone" class="dropzone"></div>
		  </div>
		</div>';
		
		
		$someStaticHTML = '<div class="row">

			</div>
	   
		   <!-- Ad Type  -->
		   <div class="row" >
			  <!-- Category  -->
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
			  <div class="form-group">
			  <label class="control-label">'. __('Type of Ad', 'adforest' ) . '</label>
				'.$ad_type_html.'
			  </div>
			  </div>
			  
		
		   <!-- Ad Condition  -->
				'.$ad_condition_html.'
			
		   <!-- Ad Warranty  -->
				'.$ad_warranty_html.'
				
				
				<!-- Youtube Video  -->
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
			  <div class="form-group">
				 <label class="control-label">'. __('Youtube Video Link', 'adforest' ) . '</label>
				 <input class="form-control" type="text" name="ad_yvideo" value="'.$ad_yvideo.'">
			</div>	 
			  </div>
				
				</div>
			'.$extra_fields_html.'';

			$currenies	=	adforest_get_cats('ad_currency' , 0 );
			if( count($currenies) > 0 )
			{

			}

		
	}
	else
	{
		
		$customDynamicAdType = '';
		$customDynamicFields = '<div id="dynamic-fields"> '.adforest_returnHTML($id).' </div>';
	
	}
	
	$lat_long_html = '';
	$lat_lon_script = '';
	$for_g_map	=	'';
	if( isset( $adforest_theme['allow_lat_lon'] ) &&  !$adforest_theme['allow_lat_lon']  )
	{
	}
	else
	{
		$pin_lat	=	$ad_map_lat;
		$pin_long	=	$ad_map_long;
		if( $ad_map_lat == "" && $ad_map_long == "" && isset( $adforest_theme['sb_default_lat'] ) && $adforest_theme['sb_default_lat'] && isset( $adforest_theme['sb_default_long'] ) && $adforest_theme['sb_default_long'] )
		{
			$pin_lat	=	$adforest_theme['sb_default_lat'];	
			$pin_long	=	$adforest_theme['sb_default_long'];	
		}
		
		$for_g_map = '<div class="row ' . $pin_long . '">
		<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			  <div id="dvMap" style="width: 100%; height: 350px"></div>
			  <em><small>'.__('Drag pin for your pin-point location.','adforest').'</small></em>
			  </div></div>';		  
	$lat_lon_script = '<script type="text/javascript">
	var my_map;
    var markers = [
        {
            "title": "",
            "lat": "'.$pin_lat.'",
            "lng": "'.$pin_long.'",
        },
    ];
    window.onload = function () {
        	my_g_map(markers);
        }
		function my_g_map(markers1)
		{
			var mapOptions = {
            center: new google.maps.LatLng(markers1[0].lat, markers1[0].lng),
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var infoWindow = new google.maps.InfoWindow();
        var latlngbounds = new google.maps.LatLngBounds();
        var geocoder = geocoder = new google.maps.Geocoder();
        my_map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            var data = markers1[0]
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: my_map,
                title: data.title,
                draggable: true,
                animation: google.maps.Animation.DROP
            });
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    infoWindow.setContent(data.description);
                    infoWindow.open(map, marker);
                });
                google.maps.event.addListener(marker, "dragend", function (e) {
					document.getElementById("sb_loading").style.display	= "block";
                    var lat, lng, address,
                    locality = "", subLocality = "", city = "", state = "";
                    geocoder.geocode({ "latLng": marker.getPosition() }, function (results, status) {

                        if ( status == google.maps.GeocoderStatus.OK ) {
                            lat = marker.getPosition().lat();
                            lng = marker.getPosition().lng();
                            address = results[0].formatted_address;
                            
                            // Extract values for locality, City and State
                            addressComponent = results[0].address_components;
                            for ( var i = 0; i < addressComponent.length; i++ ) {
                            	if ( "locality" === addressComponent[i].types[0] ) {
                            		locality = addressComponent[i].long_name;
                            	}
                            	if ( "political" === addressComponent[i].types[0] ) {
                            		subLocality = addressComponent[i].long_name;
                            	}
                            	if ( "administrative_area_level_2" === addressComponent[i].types[0] ) {
                            		city = addressComponent[i].long_name;
                            	}
                            	if ( "administrative_area_level_1" === addressComponent[i].types[0] ) {
                            		state = addressComponent[i].long_name;
                            	}
                            }
							document.getElementById("ad_map_lat").value = lat;
							document.getElementById("ad_map_long").value = lng;
							
							// MT Imran : Set the input values of locality, city and state.
							document.getElementById("ad_map_locality").value = locality;
							document.getElementById("ad_map_sub_locality").value = subLocality;
							document.getElementById("ad_map_city").value = city;
							document.getElementById("ad_map_state").value = state;
							
							document.getElementById("sb_user_address").value = address;
							document.getElementById("sb_loading").style.display	= "none";
                            //alert("Latitude: " + lat + "\nLongitude: " + lng + "\nAddress: " + address);
                        }
                    });
                });
            })(marker, data);
            latlngbounds.extend(marker.position);
		}
        /*var bounds = new google.maps.LatLngBounds();
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);*/
</script>';
		$lat_long_html = $for_g_map . '<div class="row">
				<!-- Post Add Latitude -->
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
				 <label class="control-label">'.__( 'Latitude', 'adforest' ).'</label>
				 <input class="form-control" type="text" name="ad_map_lat" id="ad_map_lat" value="'.$pin_lat.'">
			  </div>
			  <!-- Post Add Longitude -->
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
				 <label class="control-label">'.__( 'Longitude', 'adforest' ).'</label>
				 <input class="form-control" name="ad_map_long" id="ad_map_long" value="" type="text">
			  </div>
			  <!-- MT Imran Post Add Locality-->
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
				 <label class="control-label">'.__( 'Locality', 'adforest' ).'</label>
				 <input class="form-control" name="ad_map_locality" id="ad_map_locality" value="" type="text">
			  </div>
			  <!-- MT Imran Post Add Locality-->
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
				 <label class="control-label">'.__( 'Sub Locality', 'adforest' ).'</label>
				 <input class="form-control" name="ad_map_sub_locality" id="ad_map_sub_locality" value="" type="text">
			  </div>
			  <!-- MT Imran Post Add City-->
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
				 <label class="control-label">'.__( 'City', 'adforest' ).'</label>
				 <input class="form-control" name="ad_map_city" id="ad_map_city" value="" type="text">
			  </div>
			  <!-- MT Imran Post Add State-->
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
				 <label class="control-label">'.__( 'State', 'adforest' ).'</label>
				 <input class="form-control" name="ad_map_state" id="ad_map_state" value="" type="text">
			  </div>
		   </div>

		   <!-- end row -->
';	
	}
	
	// Check phone is required or not
	if( isset($adforest_theme['sb_phone_verification'] ) && $adforest_theme['sb_phone_verification'] && isset( $adforest_theme['sb_change_ph'] ) && $adforest_theme['sb_change_ph'] == false )
	{
		$phone_html = '<input class="form-control" name="sb_contact_number" readonly value="'.get_user_meta( get_current_user_id(), '_sb_contact', true ).'" type="text">';
	}
	else
	{
		$phone_html = '<input class="form-control" name="sb_contact_number" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'" value="'.$poster_ph.'" type="text">';
		$ph_reg	=	'<span class="required">*</span>';
		if( isset( $adforest_theme['sb_user_phone_required'] ) && !$adforest_theme['sb_user_phone_required'] )
		{
			$phone_html = '<input class="form-control" name="sb_contact_number" value="'.$poster_ph.'" type="text">';
			$ph_reg	=	'';
		}
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
		
	$bump_ad_html = '';
	if( isset($is_update) && $is_update != "" )
	{
		$is_package_notification = true;
		if( isset( $adforest_theme['sb_allow_free_bump_up']	) && $adforest_theme['sb_allow_free_bump_up'] )
		{
			$is_package_notification = false;
			$bump_ad_html = '<div class="select-package">
                              	<div class="no-padding col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                 <div class="pricing-list">
                                    <div class="row">
                                       <div class="col-md-12 col-sm-12 col-xs-12">
									   		
                                          <h3>
										  <input type="checkbox" name="sb_bump_up" id="sb_bump_up" />
										  '.__('Bump it up','adforest').'  <small>'.__('Bump-up ads remaining: unlimited','adforest').'</small></h3>
                                          <p>'.__('Bump it up on the top of the list.','adforest').'</p>
                                       </div>
                                       <!-- end col -->
                                       
                                    </div>
                                    <!-- end row -->
                                 </div>
                                
                              </div>
                           </div>';
		}
		else if( get_user_meta( get_current_user_id(), '_sb_expire_ads', true ) == '-1' || get_user_meta( get_current_user_id(), '_sb_expire_ads', true ) >= date('Y-m-d') )
		{
			if(  get_user_meta( get_current_user_id(), '_sb_bump_ads', true ) > 0 )
			{
				$is_package_notification = false;
				$bump_ad_html = '<div class="select-package">
                              	<div class="no-padding col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                 <div class="pricing-list">
                                    <div class="row">
                                       <div class="col-md-12 col-sm-12 col-xs-12">
									   		
                                          <h3>
										  <input type="checkbox" name="sb_bump_up" id="sb_bump_up" />
										  '.__('Bump it up','adforest').'  <small>'.__('Bump-up ads remaining:','adforest') . get_user_meta( get_current_user_id(), '_sb_bump_ads', true ).'</small></h3>
                                          <p>'.__('Bump it up on the top of the list.','adforest').'</p>
                                       </div>
                                       <!-- end col -->
                                       
                                    </div>
                                    <!-- end row -->
                                 </div>
                                
                              </div>
                           </div>';
			}
		}
		
		
		if($is_package_notification && isset( $adforest_theme['sb_show_bump_up_notification']	) && $adforest_theme['sb_show_bump_up_notification'] )
		{
			$bump_ad_html = '<div class="row">
                                       <div class="col-md-12 col-sm-12 col-xs-12"><div role="alert" class="alert alert-info alert-dismissible '.adforest_alert_type().'">
				<button aria-label="Close" data-dismiss="alert" class="close" type="button"></button>
				'. __('If you want to bump it up then please have a look on','adforest') . ' 
				<a href="'.get_the_permalink( $adforest_theme['sb_packages_page'] ) .'" class="sb_anchor" target="_blank">
				'.__('Packages. ','adforest').'
                </a></div></div></div>';	
		}	
	}
		
	$simple_feature_html = '';
	if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
	{
	if ( isset($adforest_theme['allow_featured_on_ad'] ) && $adforest_theme['allow_featured_on_ad'] && $is_feature_ad == 0 && ( get_user_meta( get_current_user_id(), '_sb_expire_ads', true ) == '-1' || get_user_meta( get_current_user_id(), '_sb_expire_ads', true ) >= date('Y-m-d') ) )
	{
		if( get_user_meta( get_current_user_id(), '_sb_featured_ads', true ) == '-1' || get_user_meta( get_current_user_id(), '_sb_featured_ads', true ) > 0 )
		{
			$count_featured_ads	= __('Featured ads remaining: Unlimited','adforest');

				if(  get_user_meta( get_current_user_id(), '_sb_featured_ads', true ) > 0 )
				{
					$count_featured_ads	= __('Featured ads remaining:','adforest') . get_user_meta( get_current_user_id(), '_sb_featured_ads', true );
				}
				$feature_text	=	'';
				if( isset( $adforest_theme['sb_feature_desc'] ) && $adforest_theme['sb_feature_desc'] != "" )
				{
					$feature_text = $adforest_theme['sb_feature_desc'];
				}
				$simple_feature_html = '<div class="select-package">
                              	<div class="no-padding col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                 <div class="pricing-list">
                                    <div class="row">
                                       <div class="col-md-12 col-sm-12 col-xs-12">
									   		
                                          <h3>
										  <input type="checkbox" name="sb_make_it_feature" id="sb_make_it_feature" />
										  '.__('Make it featured','adforest').'  <small>'.$count_featured_ads.'</small></h3>
                                          <p>'.$feature_text.'</p>
                                       </div>
                                       <!-- end col -->
                                       
                                    </div>
                                    <!-- end row -->
                                 </div>
                                
                              </div>
                           </div>';
		}
		else
		{
			$simple_feature_html = '<div role="alert" class="alert alert-info alert-dismissible '.adforest_alert_type().'">
				<button aria-label="Close" data-dismiss="alert" class="close" type="button"></button>
				'. __('If you want to make it feature then please have a look on','adforest') . ' 
				<a href="'.get_the_permalink( $adforest_theme['sb_packages_page'] ) .'" class="sb_anchor" target="_blank">
				'.__('Packages. ','adforest').'
                </a></div>';	
		}
	}
	else
	{
		$simple_feature_html = '<div role="alert" class="alert alert-info alert-dismissible '.adforest_alert_type().'">
			<button aria-label="Close" data-dismiss="alert" class="close" type="button"></button>
			'. __('If you want to make it feature then please have a look on','adforest') . ' 
			<a href="'.get_the_permalink( $adforest_theme['sb_packages_page'] ) .'" class="sb_anchor" target="_blank">
			'.__('Packages. ','adforest').'
			</a></div>';	
	}

	if( $is_feature_ad == 1 )
	{
			$simple_feature_html = '<div role="alert" class="alert alert-info alert-dismissible '.adforest_alert_type().'">
				<button aria-label="Close" data-dismiss="alert" class="close" type="button"></button>
				'. __('This ad is already featured.','adforest') . '</div>';	
	}
	}


	
	$custom_locations_html = '';
	if( isset( $adforest_theme['sb_custom_location'] ) && $adforest_theme['sb_custom_location'] )
	{
		$loc_lvl_1	=	__('Select Your Country', 'adforest' ) ;
		$loc_lvl_2	=	__('Select Your State', 'adforest' ) ;
		$loc_lvl_3	=	__('Select Your City', 'adforest' ) ;
		$loc_lvl_4	=	__('Select Your Town', 'adforest' ) ;
		if( isset( $adforest_theme['sb_location_titles'] ) && $adforest_theme['sb_location_titles'] != "" )
		{
			$titles_array	=	explode("|", $adforest_theme['sb_location_titles'] );
			if( count( $titles_array ) > 0 )
			{
				if( isset( $titles_array[0] ) )
					$loc_lvl_1	=	$titles_array[0];
				if( isset( $titles_array[1] ) )
					$loc_lvl_2	=	$titles_array[1];
				if( isset( $titles_array[2] ) )
					$loc_lvl_3	=	$titles_array[2];
				if( isset( $titles_array[3] ) )
					$loc_lvl_4	=	$titles_array[3];
					
			}
		
		}
		$custom_locations_html	=	'<div class="row">
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
				 <label class="control-label">'. $loc_lvl_1.'</label>
				 <select class="country form-control" id="ad_country" name="ad_country" data-parsley-required="true" data-parsley-error-message="'. esc_html__( 'This field is required.', 'carspot' ) .'">
					<option value="">Select Option</option>
					'.$country_html.'
				 </select>
				 <input type="hidden" name="ad_country_id" id="ad_country_id" value="" />
			  </div>
		   </div>
		   <div class="row" id="ad_country_sub_div">
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" >
			  <label class="control-label">'. $loc_lvl_2 . '</label>
				<select class="category form-control" id="ad_country_states" name="ad_country_states">
					'.$country_states.'
				</select>
			  </div>
			</div>
			 <div class="row" id="ad_country_sub_sub_div" >
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			  <label class="control-label">'. $loc_lvl_3 . '</label>
				<select class="category form-control" id="ad_country_cities" name="ad_country_cities">
					'.$country_cities.'
				</select>
			  </div>
			</div>
			 <div class="row" id="ad_country_sub_sub_sub_div">
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			  <label class="control-label">'. $loc_lvl_4 . '</label>
				<select class="category form-control" id="ad_country_towns" name="ad_country_towns">
					'.$country_towns.'
				</select>
			  </div>
			</div>
		';	
	}
	
return   ' 
  <section class="section-padding form-wizard">
            <!-- Main Container -->
            <div class="container">
			<div class="loading" id="sb_loadings"></div>
			'.$update_notice.'
			
			<div class="row ad_errors">
				<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
					<div role="alert" class="alert alert-danger alert-outline alert-dismissible">
						<button aria-label="Close" data-dismiss="alert" class="close" type="button"></button>
						'.__('Please fill all required (*) fields.', 'adforest').'
					</div>
				</div>
			</div>
			
               <!-- Row -->
               <div class="row">
                  <div class="col-md-12">
                     <!-- end post-padding -->
                      <div class="postdetails">   
            <form  class="submit-form" id="ad_post_form">   
               
           <div id="smartwizard">
           <span class="post-an-add-heading">Post a Free Add</span>
            <ul>
                <li><a href="#step-0">'. __('Step 1', 'adforest' ) . '<br /><small>'. __('Ad Information', 'adforest' ) . '</small></a></li>
                <li><a href="#step-1">'. __('Step 2', 'adforest' ) . '<br /><small>'. __('Ad Details', 'adforest' ) . '</small></a></li>
                <li><a href="#step-2">'. __('Step 3', 'adforest' ) . '<br /><small>'. __('User Information', 'adforest' ) . '</small></a></li>
            </ul>
            
            <div>
           
                <div id="step-0" class="">
                   
                   <div class="row">
                              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
							  	<label class="control-label">'.__( 'Title', 'adforest' ) .' <span class="required">*</span></label>
								 <input class="form-control" placeholder="'.__( 'Enter title', 'adforest' ) .'" type="text" name="ad_title" id="ad_title" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'" value="'.$title.'">
				 <input type="hidden" id="is_update" name="is_update" value="'.$is_update.'" />
				 <input type="hidden" id="is_level" name="is_level" value="'.$level.'" />
				 <input type="hidden" id="country_level" name="country_level" value="'.$levelz.'" />
                              </div>
                           </div>

		   <div class="row adforest-display">
			  <!-- Category  -->
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
				 <label class="control-label">'. __('Category', 'adforest' ) . ' <span class="required">*</span> <small>'. __('Select suitable category for your ad', 'adforest' ) . '</small></label>
				 <select class="category form-control anbz-category-list-container" id="ad_cat" name="ad_cat" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'">
					<option value="">Select Option</option>
					'.$cats_html.'
				 </select>
				 <input type="hidden" name="ad_cat_id" id="ad_cat_id" value="" />
			  </div>
		   </div>
		   
		   <!-- Category Pop Up Button -->
			<div class="row" id="category-pop-up-btn" >
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" >
			  <label class="">'. __('Category', 'adforest' ) . ' <span class="required">*</span> <small class="ad-selected-cat-name">'. __('Select suitable category for your ad', 'adforest' ) . '</small> <span class="ad-selected-sub-cat-name"></span></label>
				<select class="" id="" name="">
				</select>
			  </div>
			</div>
		   
		   <!-- end row -->
		   <div class="adforest-display">
		   <div class="row adforest-display" id="ad_cat_sub_div" >
			  <!-- Category  -->
			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" >
				<select class="category form-control sub-categories-container" id="ad_cat_sub" name="ad_cat_sub">
					'.$sub_cats_html.'
				</select>

			  </div>
			  
			</div>
			</div>
			
			<div class="adforest-display">
			   <div class="row i-am" id="ad_cat_sub_sub_div" >
				  <!-- Category  -->
				  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
					<select class="category form-control" id="ad_cat_sub_sub" name="ad_cat_sub_sub">
						'.$sub_sub_cats_html.'
					</select>
	
				  </div>
				  
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
			<div class="pet-category-js-wrapper adforest-display">
				<span class="button b-close"><span class="cross">x</span></span>
				' . adforest_get_category_markup() . '
				</div>
				<div class="pet-subcategory-js-wrapper adforest-display">
				' . adforest_get_subcat_markup() . '
				</div>
            </div>
            <!-- Pet Specification Wrapper -->
			<div class="pet-specification-wrapper"></div>
				<div id="step-1" class="">
					'.$customDynamicAdType.'
					'.$priceStaticHTML .'
					'.$ad_curreny_html.'
					'.$imageStaticHTML.'
				   '.$customDynamicFields.'
					<div class="row">
					  <div class="col-md-12 col-lg-12 col-xs-12  col-sm-12">
						 <label class="control-label">'. __('Ad Description', 'adforest' ) . ' <small>'. __('Enter long description for your project', 'adforest' ) . '</small></label>
						 <textarea rows="12" class="form-control" name="ad_description" id="ad_description">'.$description.'</textarea>
					  </div>
					</div>
					<!-- end row -->
					
					'.$someStaticHTML.'
					
					'.$bidable.'
					
				</div>                  
                <div id="step-2" class="">
					<div class="row">
					  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
						 <label class="control-label">'.__( 'Your Name', 'adforest' ).' <span class="required">*</span></label>
						 <input class="form-control" type="text" name="sb_user_name" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'" value="'.$poster_name.'">
					  </div>
					  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
						 <label class="control-label">'.__( 'Mobile Number', 'adforest' ).'<span class="required"> *</span></label>
						 '.$phone_html.'
					  </div>
					</div>
					
					'.$custom_locations_html.'
					
		   <div class="row">
					  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
						 <label class="control-label">'.__( 'Address', 'adforest' ).' <span class="required">*</span></label>
						 <input class="form-control" value="'.$ad_location.'" type="text" name="sb_user_address" id="sb_user_address" data-parsley-required="true" data-parsley-error-message="'. __( 'This field is required.', 'adforest' ) .'" placeholder="'.__('Enter a location','adforest').'">
					  </div>
					</div>
					<!-- end row -->
					'.$lat_long_html.'
					'. $lat_lon_script .'
					
					'.$simple_feature_html.'
					'.$bump_ad_html.'
                </div>
           
            </div>
            
        </div>
        </form>
        </div>
                     <!-- end post-ad-form-->
                  </div>
                  <!-- end col -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
<input type="hidden" id="dictDefaultMessage" value="'.__('Drop files here or click to upload.', 'adforest').'" />
<input type="hidden" id="dictFallbackMessage" value="'.__('Your browser does not support drag\'n\'drop file uploads.', 'adforest').'" />
<input type="hidden" id="dictFallbackText" value="'.__('Please use the fallback form below to upload your files like in the olden days.', 'adforest').'" />
<input type="hidden" id="dictFileTooBig" value="'.__('File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.', 'adforest').'" />
<input type="hidden" id="dictInvalidFileType" value="'.__('You can\'t upload files of this type.', 'adforest').'" />
<input type="hidden" id="dictResponseError" value="'.__('Server responded with {{statusCode}} code.', 'adforest').'" />
<input type="hidden" id="dictCancelUpload" value="'.__('Cancel upload', 'adforest').'" />
<input type="hidden" id="dictCancelUploadConfirmation" value="'.__('Are you sure you want to cancel this upload?', 'adforest').'" />
<input type="hidden" id="dictRemoveFile" value="'.__('Remove file', 'adforest').'" />
<input type="hidden" id="dictMaxFilesExceeded" value="'.__('You can not upload any more files.', 'adforest').'" />

<input type="hidden" id="wizard_previous" value="'.__('Previous', 'adforest').'" />
<input type="hidden" id="wizard_next" value="'.__('Next', 'adforest').'" />
<input type="hidden" id="wizard_submit" value="'.__('Submit', 'adforest').'" />
<input type="hidden" id="post_ad_layout" value="'.$adforest_theme['post_ad_layout'].'" />



</section>
';

}
}
if (function_exists('adforest_add_code'))
{
	adforest_add_code('ad_post_short_base', 'ad_post_short_base_func');
}
