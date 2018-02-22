<?php
if (! class_exists ( 'adforest_ad_post' )) {
class adforest_ad_post
{
// user object
var $user_info;

public function __construct()
{
	$this->user_info	=	get_userdata( get_current_user_id() );
}

}
}

// Ad Posting...
add_action('wp_ajax_sb_ad_posting', 'adforest_ad_posting');

if ( ! function_exists( 'adforest_ad_posting' ) ) {
	
	function adforest_ad_posting() {

		global $adforest_theme;

		// Insert custom_taxonomy for that post into database


		if( get_current_user_id() == "" )
		{
			echo "0";
			die();
		}

		if( ! is_super_admin( get_current_user_id() ) )
		{
			$simple_ads	=	get_user_meta(get_current_user_id(), '_sb_simple_ads', true);
			$expiry	= get_user_meta( get_current_user_id(), '_sb_expire_ads', true );
			if( $simple_ads == -1 )
			{

			}
			else if( $simple_ads <= 0 )
			{
				echo "1";
				die();
			}

			if( $expiry != '-1' )
			{
				if( $expiry < date('Y-m-d') )
				{
					echo "1";
					die();
				}
			}
		}

		// Getting values
		$params = array();
	    parse_str($_POST['sb_data'], $params);

		$cats = array();
		if($params['ad_cat_sub_sub_sub'] != "") { $cats[]	= $params['ad_cat_sub_sub_sub'];}
		if($params['ad_cat_sub_sub']  != "" ){ $cats[]	=  $params['ad_cat_sub_sub'];}
		if($params['ad_cat_sub'] != ""){ $params['ad_cat_sub'];}
		if($params['ad_cat'] != "") {$cats[]	=  $params['ad_cat'];}

		$ad_status	=	 'publish';

		if( $_POST['is_update'] != "" )
		{
			$pid	=	$_POST['is_update'];
			if( $adforest_theme['sb_update_approval'] == 'manual' )
			{
				$ad_status	=	'pending';
			}
			else if( get_post_status( $pid ) == 'pending' )
			{
				$ad_status	=	'pending';
			}

			$is_imageallow = adforestCustomFieldsVals($pid, $cats);
			$media = get_attached_media( 'image',$pid );
			if($is_imageallow == 1 && count($media) == 0)
			{
				echo "img_req";
				die();
			}
		}
		else
		{
			if( $adforest_theme['sb_ad_approval'] == 'manual' )
			{
				$ad_status	=	'pending';
			}
			$pid	=	get_user_meta ( get_current_user_id(), 'ad_in_progress', true );

			$is_imageallow = adforestCustomFieldsVals($pid, $cats);
			$media = get_attached_media( 'image',$pid );
			if($is_imageallow == 1 && count($media) == 0)
			{
				echo "img_req";
				die();
			}

			// Now user can post new ad
			delete_user_meta(get_current_user_id(), 'ad_in_progress');

			$simple_ads	=	get_user_meta(get_current_user_id(), '_sb_simple_ads', true);
			if( $simple_ads > 0 && !is_super_admin( get_current_user_id() ) )
			{
				$simple_ads	=	$simple_ads - 1;
				update_user_meta( get_current_user_id(), '_sb_simple_ads', $simple_ads );
			}

			update_post_meta($pid, '_adforest_ad_status_', 'active' );
			update_post_meta($pid, '_adforest_is_feature', '0' );
			adforest_get_notify_on_ad_post($pid);

		}
//		wp_set_post_terms( $pid, '11 Years', 'petprice', true );

			global $wpdb;
			$qry = "UPDATE $wpdb->postmeta SET meta_value = '' WHERE post_id = '$pid' AND meta_key LIKE '_adforest_tpl_field_%'";
			$wpdb->query( $qry );


		// Bad words filteration
		$words		=	explode( ',', $adforest_theme['bad_words_filter'] );
		$replace	=	$adforest_theme['bad_words_replace'];
		$desc		=	adforest_badwords_filter( $words, $params['ad_description'], $replace );
		$title		=	adforest_badwords_filter( $words, $params['ad_title'], $replace );

		// Remove Style and Scripts
		// create a new DomDocument object
		//$doc = new DOMDocument();

		// load the HTML into the DomDocument object (this would be your source HTML)
		//$doc->loadHTML($desc);

		//adforest_removeElementsByTagName('script', $doc);
		//adforest_removeElementsByTagName('style', $doc);

		// output cleaned html
		//$desc	=	$doc->saveHtml();
		$desc	=	preg_replace('/style[^>]*/', '', $desc);

		$my_post = array(
		'ID'           => $pid,
		'post_title'   => sanitize_text_field( $title ),
		'post_status'   => $ad_status,
		'post_content'   => $desc,
		'post_name' => sanitize_text_field($title)
		);

		wp_update_post( $my_post );

		$category =	array();
		if( $params['ad_cat'] != "" )
		{
			$category[]	=	$params['ad_cat'];
		}
		if( $params['ad_cat_sub'] != "" )
		{
			$category[]	=	$params['ad_cat_sub'];
		}
		if( $params['ad_cat_sub_sub'] != "" )
		{
			$category[]	=	$params['ad_cat_sub_sub'];
		}
		if( $params['ad_cat_sub_sub_sub'] != "" )
		{
			$category[]	=	$params['ad_cat_sub_sub_sub'];
		}
		wp_set_post_terms( $pid, $category, 'ad_cats' );

		/* Insert Pet Age taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_age' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_age' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petage' );

		/* Insert Pet Color taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_color' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_color' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petcolor' );

		/* Insert Pet Gender taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_gender' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_gender' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petgender' );

		/* Insert Pet Gender taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_gender' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_gender' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petgender' );

		/* Insert Pet Size taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_size' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_size' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petsize' );

		/* Insert Pet Quality taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_quality' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_quality' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petquality' );

		/* Insert Pet Weight taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_weight' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_weight' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petweight' );

		/* Insert Pet is Vaccinated taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_vaccinated' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_vaccinated' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petisvaccinated' );

		/* Insert Pet is Pregnant taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_pregnant' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_pregnant' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petispregnant' );

		/* Insert Pet Weight at Birth taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_birth_weight' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_birth_weight' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petweightatbirth' );

		/* Insert Pet Breed Percentage taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_breed_percentage' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_breed_percentage' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petbreedpercentage' );

		/* Insert Pet Teeth taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_teeth' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_teeth' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petteeth' );

		/* Insert Pet Height taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_height' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_height' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petheight' );

		/* Insert Pet Height taxonomy values to database */
		$pet_taxonomy_val = array();
		if ( '' !== $params[ 'ad_pet_milking_capacity' ] ) {
			$pet_taxonomy_val[] = $params[ 'ad_pet_milking_capacity' ];
		}
		wp_set_post_terms( $pid, $pet_taxonomy_val, 'petmilkingcapacity' );


		// MTI Add the locality, sub locality, city and State values to the database
		$city_name = '';
		$locality_name = '';
		$sub_locality_name = '';
		if ( $params['ad_map_city'] ) { $city_name = $params['ad_map_city']; }
		if ( $params['ad_map_locality'] ) { $locality_name = $params['ad_map_locality']; }
		if ( $params['ad_map_sub_locality'] ) { $sub_locality_name = $params['ad_map_sub_locality']; }

		// If locality and sub locality are the same then set locality name to sub locality.
		if ( ! empty ( $city_name ) && ! empty( $locality_name ) && $city_name === $locality_name ) {
			$locality_name = $sub_locality_name;
		}

		/*
		 * Store the city name into database only if it does not exists in the database
		 * and get the $city_id frm the database after storing it
		 */
		$city_exists = term_exists( $city_name, 'ad_country' );
		if ( $city_name && ! $city_exists ) {
			$city_id = wp_insert_term( $city_name, 'ad_country' );
			$city_id = intval( $city_id['term_id'] );
		} else {
			$city_id = $city_exists;
			$city_id = intval( $city_id['term_id'] );
		}

		/*
		 * Store the locality name into database only if it does not exists in the database
		 * and set its parent to $city_id .Also get the $locality_id frm the database after
		 * storing it .
		 */
		$locality_exits = term_exists( $locality_name, 'ad_country' );
		if ( $locality_name && ! $locality_exits ) {
			$locality_id = wp_insert_term( $locality_name, 'ad_country', array( 'parent' => $city_id ) );
			$locality_id = intval( $locality_id['term_id'] );
		} else {
			$locality_id = $locality_exits;
			$locality_id = intval( $locality_id['term_id'] );
		}

		// Create an array with city_id( parent ) and locality_id ( child )
		$pet_location_ids = array( $city_id, $locality_id );

		// Store the city_id( parent ) and locality_id ( child ) relationship with post_id into database.
		wp_set_post_terms( $pid, $pet_location_ids, 'ad_country' );


//		/*countries*/
//		$countries = array();
//		if( $params['ad_country'] != "" ){ $countries[] = $params['ad_country'];  }
//		if( $params['ad_country_states'] != "" ){$countries[] = $params['ad_country_states'];}
//		if( $params['ad_country_cities'] != "" ){$countries[] = $params['ad_country_cities']; }
//		if( $params['ad_country_towns'] != "" ){$countries[] = $params['ad_country_towns']; }
//		wp_set_post_terms( $pid, $countries, 'ad_country' );



		// Setting taxonomoies selected
		$type = '';
		if( $params['buy_sell'] != "" )
		{
			$type_arr	=	explode( '|', $params['buy_sell'] );
			wp_set_post_terms( $pid, $type_arr[0], 'ad_type' );
			$type = $type_arr[1];
		}
		$conditon = '';
		if( $params['condition'] != "" )
		{
			$condition_arr	=	explode( '|', $params['condition'] );
			wp_set_post_terms( $pid, $condition_arr[0], 'ad_condition' );
			$conditon	= $condition_arr[1];
		}
		$warranty = '';
		if( $params['ad_warranty'] != "" )
		{
			$warranty_arr	=	explode( '|', $params['ad_warranty'] );
			wp_set_post_terms( $pid, $warranty_arr[0], 'ad_warranty' );
			$warranty	= $warranty_arr[1];
		}

		$currency = '';
		if( $params['ad_currency'] != "" )
		{
			$currency_arr	=	explode( '|', $params['ad_currency'] );
			wp_set_post_terms( $pid, $currency_arr[0], 'ad_currency' );
			$currency	= $currency_arr[1];
			update_post_meta($pid, '_adforest_ad_currency', sanitize_text_field($currency) );

		}

		$tags	=	explode(',', $params['tags'] );
		wp_set_object_terms($pid, $tags, 'ad_tags');

		// Update post meta
		update_post_meta($pid, '_adforest_poster_name', sanitize_text_field($params['sb_user_name']) );
		update_post_meta($pid, '_adforest_poster_contact', sanitize_text_field($params['sb_contact_number']) );
		update_post_meta($pid, '_adforest_ad_location', sanitize_text_field($params['sb_user_address']) );
		update_post_meta($pid, '_adforest_ad_type', sanitize_text_field($type));
		update_post_meta($pid, '_adforest_ad_condition', sanitize_text_field($conditon) );
		update_post_meta($pid, '_adforest_ad_warranty', sanitize_text_field($warranty) );
		update_post_meta($pid, '_adforest_ad_price', sanitize_text_field($params['ad_price']) );
		update_post_meta($pid, '_adforest_ad_map_lat', sanitize_text_field($params['ad_map_lat']) );
		update_post_meta($pid, '_adforest_ad_map_long', sanitize_text_field($params['ad_map_long']) );
		update_post_meta($pid, '_adforest_ad_bidding', sanitize_text_field($params['ad_bidding']) );
		update_post_meta($pid, '_adforest_ad_price_type', sanitize_text_field($params['ad_price_type']) );
		if( isset( $params['ad_yvideo'] ) && $params['ad_yvideo'] != "" )
		{

			update_post_meta($pid, '_adforest_ad_yvideo', sanitize_text_field($params['ad_yvideo']) );
		}
		else
		{
			update_post_meta($pid, '_adforest_ad_yvideo', '' );
		}

		// Making it featured ad
		if( isset( $params['sb_make_it_feature'] ) && $params['sb_make_it_feature'] )
		{
			// Uptaing remaining ads.
			$featured_ad	=	get_user_meta(get_current_user_id(), '_sb_featured_ads', true);
			if( $featured_ad > 0  )
			{
				update_post_meta($pid, '_adforest_is_feature', '1' );
				update_post_meta( $pid, '_adforest_is_feature_date', date( 'Y-m-d' ) );

				$featured_ad	=	$featured_ad - 1;
				update_user_meta( get_current_user_id(), '_sb_featured_ads', $featured_ad );
			}

		}

		// Bumping it up
		if( isset( $params['sb_bump_up'] ) && $params['sb_bump_up'] )
		{
			// Uptaing remaining ads.
			$bump_ads	=	get_user_meta(get_current_user_id(), '_sb_bump_ads', true);
			if( $bump_ads > 0 || isset( $adforest_theme['sb_allow_free_bump_up']	) && $adforest_theme['sb_allow_free_bump_up'] )
			{
				wp_update_post(
					array (
						'ID'            => $pid, // ID of the post to update
						'post_date'     => current_time('mysql'),
						'post_date_gmt' => get_gmt_from_date( current_time('mysql') )
					)
				);
				if( !$adforest_theme['sb_allow_free_bump_up'] )
				{
					$bump_ads	=	$bump_ads - 1;
					update_user_meta( get_current_user_id(), '_sb_bump_ads', $bump_ads );
				}
			}

		}

		// Stroring Extra fileds in DB
		if( $params['sb_total_extra'] > 0 )
		{
			for( $i = 1; $i <= $params['sb_total_extra']; $i++ )
			{
				update_post_meta($pid, "_sb_extra_" . $params["title_$i"], sanitize_text_field($params["sb_extra_$i"]) );
			}
		}
		//Add Dynamic Fields
		if( isset($params['cat_template_field']) && count( $params['cat_template_field'] ) > 0)
		{
			foreach($params['cat_template_field'] as $key => $data)
			{
				if( is_array($data) )
				{
					$dataArr = array();
					foreach($data as $k ) $dataArr[] = $k;
					$data = stripslashes(json_encode($dataArr, true));
				}
	            update_post_meta($pid, $key, sanitize_text_field($data) );
			}
		}
		// Making Location DB

		// explode address
		if( $params['ad_map_lat'] == "" && $params['ad_map_long'] )
		{
			$address	=	explode(',', $params['sb_user_address'] );
			if( count( $address ) == 3 )
			{
				$city	=	trim( $address[0] );
				$state	=	trim( $address[1] );
				$country	=	trim( $address[2] );
				adforest_add_location( $country, $state, $city );
			}
			else if( count( $address ) == 2 )
			{
				$city	=	trim( $address[0] );
				$country	=	trim( $address[1] );
				$state	=	'';
				adforest_add_location( $country, $state, $city );
			}
		}


		echo get_the_permalink( $pid );

		die();


	}
}

// Get sub cats
add_action('wp_ajax_sb_get_sub_cat_search', 'adforest_get_sub_cats_search');
add_action( 'wp_ajax_nopriv_sb_get_sub_cat_search', 'adforest_get_sub_cats_search' );
if ( ! function_exists( 'adforest_get_sub_cats_search' ) ) {
function adforest_get_sub_cats_search()
{
	$cat_id	=	$_POST['cat_id'];
	$ad_cats	=	adforest_get_cats('ad_cats' , $cat_id );
	$res	=	'';
	if( count( $ad_cats ) > 0 )
	{
		$res	=	'<label>'.adforest_get_taxonomy_parents( $cat_id, 'ad_cats', false).'</label>';
		$res	.= '<ul class="city-select-city" >';
		foreach( $ad_cats as $ad_cat )
		{
			$id	=	'ajax_cat';
			$res .= '<li class="col-sm-4 col-xs-6 margin-top-10"><a href="javascript:void(0);" data-cat-id="'.esc_attr( $ad_cat->term_id ). '" id="'.$id.'">'.$ad_cat->name.' (' . $ad_cat->count. ')</a></li>';	
		}
		$res	.= '</ul>';
		echo($res);
	}
	else
	{
		echo "submit";
	}
	die();
}
}


// Get sub cats
add_action('wp_ajax_sb_get_sub_cat', 'adforest_get_sub_cats');
if ( ! function_exists( 'adforest_get_sub_cats' ) ) {
function adforest_get_sub_cats()
{
	$cat_id	=	$_POST['cat_id'];
	$ad_cats	=	adforest_get_cats('ad_cats' , $cat_id );
	if( count( $ad_cats ) > 0 )
	{

		$cats_html	=	'<select class="category form-control sub-categories-container" id="ad_cat_sub" name="ad_cat_sub">';
		$cats_html	.=	'<option label="Select Option"></option>';
		foreach( $ad_cats as $ad_cat )
		{
			$cats_html	.=	'<option value="'.$ad_cat->term_id.'" class="sub-category-'.$ad_cat->term_id.'">' . $ad_cat->name .  '</option>';
		}
		$cats_html	.=	'</select>';
		echo($cats_html);
		die();
	}
	else
	{
		echo '';
		die();
	}
}
}


// Get pet specifications
add_action('wp_ajax_sb_get_pet_spec', 'adforest_get_pet_specifications');
if ( ! function_exists( 'adforest_get_pet_specifications' ) ) {
	function adforest_get_pet_specifications()
	{
		$cat_id	 =	$_POST['cat_id'];
		$ad_id = $_POST['my_ad_id'];
		$content = adforest_display_pet_specifications( $cat_id, $ad_id );
		wp_send_json_success( array(
			'content' => $content,
		) );
	}
}


if ( ! function_exists( 'adforest_check_author' ) ) {
function adforest_check_author( $ad_id )
{
	if( get_post_field( 'post_author', $ad_id ) != get_current_user_id() )
	{
		return false;
	}
	else
	{
		return true;	
	}
}
}


add_action('wp_ajax_post_ad', 'adforest_post_ad_process');
if ( ! function_exists( 'adforest_post_ad_process' ) ) {
function adforest_post_ad_process()
{
	
	if( $_POST['is_update'] != "")
	{
		die();
	}
	
	
	$title	=	$_POST['title'];

	if( get_current_user_id() == "" )
		die();
		
	if( !isset( $title ) )
		die();
		
	$ad_id	=	get_user_meta ( get_current_user_id(), 'ad_in_progress', true );
	if( get_post_status ( $ad_id ) && $ad_id != "" )
	{
		$my_post = array(
			'ID'           => get_user_meta ( get_current_user_id(), 'ad_in_progress', true ),
			'post_title'   => $title,
		);
		wp_update_post( $my_post );	
		die();	
	}

		
	// Gather post data.
$my_post = array(
    'post_title'    => sanitize_text_field($title),
    'post_status'   => 'pending',
    'post_author'   => get_current_user_id(),
    'post_type' => 'ad_post'
);
 
// Insert the post into the database.
$id	=  wp_insert_post( $my_post );
if( $id )
{
	update_user_meta( get_current_user_id(), 'ad_in_progress', $id );	
}

die();
}
}


add_action('wp_ajax_delete_ad_image', 'adforest_delete_ad_image');
if ( ! function_exists( 'adforest_delete_ad_image' ) ) {
function adforest_delete_ad_image()
{
	if( get_current_user_id() == "" )
		die();
	
	
	if( $_POST['is_update'] != "" )
	{
		$ad_id	=	$_POST['is_update'];
	}
	else
	{
		$ad_id	=	get_user_meta ( get_current_user_id(), 'ad_in_progress', true );
	}
	 
	 if( !is_super_admin( get_current_user_id() ) && get_post_field( 'post_author', $ad_id ) != get_current_user_id() )
	 	die();
	
	
	$attachmentid	=	$_POST['img'];	
	wp_delete_attachment( $attachmentid, true );
	
	if( get_post_meta( $ad_id, '_sb_photo_arrangement_', true ) != "" )
	{
		$ids	= get_post_meta( $ad_id, '_sb_photo_arrangement_', true );
		$res	=	 str_replace($attachmentid, "", $ids);
		$res	=	 str_replace(',,', ",", $res);
		$img_ids= trim($res,',');
		update_post_meta( $ad_id, '_sb_photo_arrangement_', $img_ids );
	}

	
	echo "1";
	die();
}
}


add_action('wp_ajax_upload_ad_images', 'adforest_upload_ad_images');
if ( ! function_exists( 'adforest_upload_ad_images' ) ) {
function adforest_upload_ad_images(){
	
	global $adforest_theme;
	
	adforest_authenticate_check();
	
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	
	$size_arr	=	explode( '-', $adforest_theme['sb_upload_size'] );
	$display_size	=	$size_arr[1];
	$actual_size	=	$size_arr[0];
	
	// Allow certain file formats
	$imageFileType	=	strtolower(end( explode('.', $_FILES['my_file_upload']['name'] ) ));
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" )
	{
		echo '0|' . __( "Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 'adforest' );
		die();
	}
	 
	 // Check file size
	if ($_FILES['my_file_upload']['size'] > $actual_size) 
	{
		echo '0|' . __( "Max allowed image size is", 'adforest' ) . " " . $display_size;
		die();
	}
	
	
	// Let WordPress handle the upload.
	// Remember, 'my_image_upload' is the name of our file input in our form above.
	if( $_GET['is_update'] != "" )
	{
		$ad_id	=	$_GET['is_update'];
	}
	else
	{
		$ad_id	=	get_user_meta ( get_current_user_id(), 'ad_in_progress', true );
	}
	
	if($ad_id == "" )
	{
		echo '0|' . __( "Please enter title first in order to create ad.", 'adforest' );
		die();
	}
	
	// Check max image limit
	$media = get_attached_media( 'image',$ad_id );
	if( count( $media ) >= $adforest_theme['sb_upload_limit'] )
	{
		echo '0|' . __( "You can not upload more than ", 'adforest' ) . " " . $adforest_theme['sb_upload_limit'];
		die();
	}
	
	$attachment_id = media_handle_upload( 'my_file_upload', $ad_id );
	$imgaes	=	get_post_meta( $ad_id, '_sb_photo_arrangement_', true );
	if( $imgaes != "" )
	{
		$imgaes = $imgaes .',' . $attachment_id;
		update_post_meta( $ad_id, '_sb_photo_arrangement_', $imgaes );	
	}
	echo $attachment_id;
	die();
    

}
}

add_action('wp_ajax_sb_sort_images', 'adforest_sort_images');
if ( ! function_exists( 'adforest_sort_images' ) ) {
function adforest_sort_images(){
	update_post_meta( $_POST['ad_id'], '_sb_photo_arrangement_', $_POST['ids'] );
	die();
}
}



add_action('wp_ajax_get_uploaded_ad_images', 'adforest_get_uploaded_ad_images');
if ( ! function_exists( 'adforest_get_uploaded_ad_images' ) ) {
function adforest_get_uploaded_ad_images()
{
	if( $_POST['is_update'] != "" )
	{
		$ad_id	=	$_POST['is_update'];
	}
	else
	{
		$ad_id	=	get_user_meta ( get_current_user_id(), 'ad_in_progress', true );
	}
	if( $ad_id == "" )
	{
		return '';	
	}


	$media	=	 adforest_get_ad_images($ad_id);
	$result	=	array();
	foreach( $media as $m )
	{
		$mid	=	'';
		$guid	= '';
		if ( isset( $m->ID ) )
		{
			$mid	= 	$m->ID;
			$guid	=	$m->guid;
		}
		else
		{
			$mid	=	$m;
			$guid	=	get_the_guid( $mid );
		}
		
		$obj	=	array();
		$obj['dispaly_name'] = basename( get_attached_file( $mid ) );;
		$obj['name'] = $guid;
		$obj['size'] = filesize( get_attached_file( $mid ) );
		$obj['id'] = $mid;
		$result[] = $obj;	
	}
	header('Content-type: text/json');
	header('Content-type: application/json');
	echo json_encode($result);
	die();
}
}


if ( ! function_exists( 'adforest_delete_post_taxonomies' ) ) {
function adforest_delete_post_taxonomies( $object_id, $taxonomy )
{
	global $wpdb;
	$rows = $wpdb->get_results( "SELECT term_taxonomy_id FROM $wpdb->term_relationships WHERE object_id = '$object_id'" );
	if( count( $rows ) > 0 )
	{
		foreach( $rows as $row )
		{
			$rs = $wpdb->get_row( "SELECT taxonomy FROM $wpdb->term_taxonomy WHERE term_taxonomy_id = '".$row->term_taxonomy_id."'" );
			if( $rs->taxonomy == $taxonomy )
			{
				echo "DELETE FROM $wpdb->term_relationships WHERE object_id = '$object_id' AND term_taxonomy_id = '".$row->term_taxonomy_id."'";
				
				$wpdb->delete( $wpdb->term_relationships, array( 'object_id' => $object_id, 'term_taxonomy_id' => $row->term_taxonomy_id ) );	
			}	
			
		}
	}
}
}

function sort_terms_hierarchicaly(&$cats, &$into, $parentId = 0)
{
    foreach ($cats as $i => $cat) {
        if ($cat->parent == $parentId) {
            $into[$cat->term_id] = $cat;
            unset($cats[$i]);
        }
    }

    foreach ($into as $topCat) {
        $topCat->children = array();
        sort_terms_hierarchicaly($cats, $topCat->children, $topCat->term_id);
    }
}

if ( ! function_exists( 'adforest_get_ad_cats' ) ) {
function adforest_get_ad_cats( $id , $by = 'name', $for_country = false )
{
$taxonomy = 'ad_cats'; //Put your custom taxonomy term here

	if($for_country)
	{
	  $taxonomy = 'ad_country';
	}
	else
	{
		$taxonomy = 'ad_cats'; //Put your custom taxonomy term here
	}

 $terms = wp_get_post_terms( $id, $taxonomy );
 $cats = array();
 	$myparentID = '';
	foreach ( $terms as $term )
	{
		 if ($term->parent == 0) 
		 {
				$myparent = $term;
				$myparentID = $myparent->term_id;
				$cats[] = array( 'name' => $myparent->name, 'id' => $myparent->term_id );
				break;
		 }
	}
	
	if( $myparentID  != "" ) 
	{
		$mychildID = '';
		 // Right, the parent is set, now let's get the children
		 foreach ( $terms as $term ) {
		  if ($term->parent == $myparentID) // this ignores the parent of the current post taxonomy
		  { 
			  $child_term = $term; // this gets the children of the current post taxonomy	
			  $mychildID  = $child_term->term_id;
			  $cats[] = array( 'name' => $child_term->name, 'id' => $child_term->term_id );
			  break;
		  }
		}	
		 if( $mychildID != "" )
		 {
			 $mychildchildID = '';
			 // Right, the parent is set, now let's get the children
			 foreach ( $terms as $term ) {
			  if ($term->parent == $mychildID) // this ignores the parent of the current post taxonomy
			  { 
				  $child_term = $term; // this gets the children of the current post taxonomy
				   $mychildchildID  = $child_term->term_id;
				  $cats[] = array( 'name' => $child_term->name, 'id' => $child_term->term_id );
				  break;
			  }
			}		
			if( $mychildchildID != "" )
			{
				 // Right, the parent is set, now let's get the children
				 foreach ( $terms as $term ) {
				  if ($term->parent == $mychildchildID) // this ignores the parent of the current post taxonomy
				  { 
					  $child_term = $term; // this gets the children of the current post taxonomy	  
					  $cats[] = array( 'name' => $child_term->name, 'id' => $child_term->term_id );
					  break;
				  }
				}	
			}
		 }
	}
	return $cats;
	
	$post_categories = wp_get_object_terms( $id,  array('ad_cats'), array('orderby' => 'term_group') );
	$cats = array();
	foreach($post_categories as $c)
	{
		$cat = get_term( $c );
		$cats[] = array( 'name' => $cat->name, 'id' => $cat->term_id );
	}
	return $cats;
}
}


// Get all messages of particular ad
add_action('wp_ajax_sb_get_messages', 'adforest_get_messages');
if ( ! function_exists( 'adforest_get_messages' ) ) {
function adforest_get_messages()
{
	adforest_authenticate_check();
	
	$ad_id	=	$_POST['ad_id'];
	$user_id	=	$_POST['user_id'];
	$authors	=	array( $user_id, get_current_user_id() );
	
	// Mark as read conversation
	update_comment_meta( get_current_user_id(), $ad_id."_".$user_id, 1 );

	
	$parent	=	$user_id;
	if( $_POST['inbox'] == 'yes' )
	{
		$parent	=	get_current_user_id();
	}
	$args = array(
		'author__in' => $authors,
		'post_id' => $ad_id,
		'parent' => $parent,
		'orderby' => 'comment_date',
		'order' => 'ASC',
	);
	$comments	=	get_comments( $args );
	$messages	=	'';
	$i = 1;
	$total	=	count( $comments );
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
			$id		=	'';
			if( $i ==  $total )
			{
				$id	=	'id="last_li"';
			}
			$i++;
			$messages .= '<li class="'.$class.' clearfix" '.$id.'>
							 <figure class="profile-picture">
								<img src="'.$user_pic.'" class="img-circle" alt="'.__('Profile Pic','adforest').'">
							 </figure>
							 <div class="message">
								'.$comment->comment_content .'
								<div class="time"><i class="fa fa-clock-o"></i> '.adforest_timeago($comment->comment_date ).'</div>
							 </div>
						  </li>';	
		}
	}
	echo($messages);
	die();
}
}


if ( ! function_exists( 'adforest_authenticate_check' ) ) {
function adforest_authenticate_check()
{
	if( get_current_user_id() == "" )
	{
		echo '0|' . __( "You are not logged in.", 'adforest' );
		die();
	}
}
}

if ( ! function_exists( 'adforestCustomFieldsVals' ) ) {
function adforestCustomFieldsVals($post_id = '', $terms = array())
{
 if($post_id == "") return;
    /*$terms = wp_get_post_terms($post_id, 'ad_cats');*/
	 $is_show = '';
	 if(count($terms) > 0 )
	 {
	
	   foreach ($terms as $term) 
	   {
		   $term_id = $term; 
		   $t = adforest_dynamic_templateID($term_id);
		   if($t) break;
	   }  
	  $templateID = adforest_dynamic_templateID($term_id);
	  $result = get_term_meta( $templateID , '_sb_dynamic_form_fields' , true); 
	
	   $is_show = '';
	   $html = '';
	
	   if(isset($result) && $result != "")
	   {
	   $is_show = sb_custom_form_data($result, '_sb_default_cat_image_required'); 
	   }
	  }
	 return ($is_show == 1) ? 1 : 0;
}
}

// Get States
add_action('wp_ajax_sb_get_sub_states', 'adforest_get_sub_states');
add_action( 'wp_ajax_nopriv_sb_get_sub_states_search', 'adforest_get_sub_states_search' );
if ( ! function_exists( 'adforest_get_sub_states' ) ) {
function adforest_get_sub_states()
{
 $country_id = $_POST['country_id'];
 $ad_country = adforest_get_cats('ad_country' , $country_id );
 if( count( $ad_country ) > 0 )
 {
  $cats_html = '<select class="category form-control">';
  $cats_html .= '<option label="'.esc_html__('Select Option','adforest').'"></option>';
  foreach( $ad_country as $ad_cat )
  {
   $cats_html .= '<option value="'.$ad_cat->term_id.'">' . $ad_cat->name .  '</option>';
  }
  $cats_html .= '</select>';
  echo($cats_html);
  die();
 }
 else
 {
  echo "";
  die();
 }
}
}



// Get States Search
add_action('wp_ajax_get_related_cities', 'adforest_get_countries');
add_action( 'wp_ajax_noprivget_related_cities', 'adforest_get_countries' );
if ( ! function_exists( 'adforest_get_countries' ) ) {
function adforest_get_countries()
{
 
 $cat_id = $_POST['country_id'];
 $ad_cats = adforest_get_cats('ad_country' , $cat_id );
 $res = '';
 if( count( $ad_cats ) > 0 )
 {
  $res = '<label>'.adforest_get_taxonomy_parents( $cat_id, 'ad_country', false).'</label>';
  $res .= '<ul class="city-select-city" >';
  foreach( $ad_cats as $ad_cat )
  {
   $location_count = get_term($ad_cat->term_id);
   $count = $location_count->count;
   $id = 'ajax_states';
   $res .= '<li class="col-sm-4 col-md-4 col-xs-6"><a href="javascript:void(0);" data-country-id="'.esc_attr( $ad_cat->term_id ). '" id="'.$id.'">'.$ad_cat->name.' <span>('.esc_html($count).')</span></a></li>'; 
  }
  $res .= '</ul>';
  echo($res);
 }
 else
 {
  echo "submit";
 }
 die();
 
}
}
