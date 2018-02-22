<?php
/**
 * Custom Functions of the theme
 *
 * @package Adforest
 */




if ( ! function_exists( 'adforest_display_pet_specifications' ) ) {
	/**
	 * Creates html markup for pet specifications.
	 *
	 * @param {int} $cat_id Category id for the category selected.
	 * @param {int} $add_id Add id available on edit post.
	 * @return string
	 */
	function adforest_display_pet_specifications( $cat_id, $ad_id = '' ) {

		$cat_id = intval( $cat_id );
		$cat_slug = get_term_by( 'id', $cat_id, 'ad_cats' )->slug;
		/* Category Slug and Pet field Slug will be the same */
		$pet_field_slug = $cat_slug;
		$pet_field_name_arr = adforest_get_pet_field_names( $pet_field_slug, 'petfield' );

		if ( ! is_array( $pet_field_name_arr ) && empty( $pet_field_name_arr ) ) {
			return;
		}

		$pet_field_desc_arr = myrltech_pet_field_val_arr( $ad_id );

		$content = '<div class="pet-specifications-container">
				  <!-- Pet Specifications  -->
				  <div class="pet-specification-heading-label">'. __('Pet Specifications', 'adforest' ) . '</div>
				  <div class="pet-spec-cont">
				  
					 ' . adforest_display_petage_options( $pet_field_name_arr, $pet_field_desc_arr ) . '
					 ' . adforest_display_petcolor_options( $pet_field_name_arr, $pet_field_desc_arr ) . '
					 ' . adforest_display_petgender_options( $pet_field_name_arr, $pet_field_desc_arr ) . '
					 ' . adforest_display_petsize_options( $pet_field_name_arr, $pet_field_desc_arr, $cat_slug ) . '
				 
				 
					 ' . adforest_display_petquality_options( $pet_field_name_arr, $pet_field_desc_arr, $cat_slug ) . '
					 ' . adforest_display_petweight_options( $pet_field_name_arr, $pet_field_desc_arr, $cat_slug ) . '
					 ' . adforest_display_petvaccinated_options( $pet_field_name_arr, $pet_field_desc_arr ) . '
					 ' . adforest_display_petpregnancy_options( $pet_field_name_arr, $pet_field_desc_arr ) . '
				 
				 
					 ' . adforest_display_petbreedpercentage_options( $pet_field_name_arr, $pet_field_desc_arr ) . '
					 ' . adforest_display_petbirthweight_options( $pet_field_name_arr, $pet_field_desc_arr ) . '
					 ' . adforest_display_petteeth_options( $pet_field_name_arr, $pet_field_desc_arr ) . '
					 ' . adforest_display_petheight_options( $pet_field_name_arr, $pet_field_desc_arr ) . '
				 
				 
					 ' . adforest_display_petmilkingcapacity_options( $pet_field_name_arr, $pet_field_desc_arr ) . '
					 <input type="hidden" name="ad_cat_id" id="ad_cat_id" value="" />
				 </div>
		        </div>';
		return $content;
	}
}

if ( ! function_exists( 'adforest_display_terms' ) ) {
	/**
	 * Finds and returns all the pet specification names.
	 *
	 * @return {string} $markup Markup to display terms.
	 */
	function adforest_display_terms() {
		$markup = '';
		$terms = get_taxonomies();
		foreach ( $terms as $term ) {
			$term_type = substr( $term, 0, 3 );
			if ( 'pet' === $term_type ) {
				$markup .= '<h3>' . $term . '</h3>';
			}
		}
		return $markup;
	}
}

function adforest_display_petage_options( $pet_field_name_arr, $pet_field_desc_arr = array() ) {
	if ( in_array( 'petage', $pet_field_name_arr ) ) {
		$pet_age = ( $pet_field_desc_arr['petage'] ) ? $pet_field_desc_arr['petage'] : '';
		$pet_age_value_arr = array(
			'',
			'Below than 1 Year',
			'1 Year to 5 Year',
			'6 Year to 10 Year',
			'1 Year to 20 Year',
			'21 Year to 30 Year',
			'31 Year to 40 Year',
			'41 Year to 50 Year',
			'More than 50 Year',
		);
		$pet_age_markup = '<div class="mti-pet-spec-container"><label for="pet-age" class="pet-age-label">'. __( 'Pet Age: ', 'adforest' ) . '</label>' .
		                   '<select name="ad_pet_age" class="form-control"">';
		foreach ( $pet_age_value_arr as $value ) {

		$pet_age_markup .= '<option value="' . $value . '">' . $value . '</option>';
		}
		$pet_age_markup .= '</select>
							</div>';
		return $pet_age_markup;
	}
}

function adforest_display_petcolor_options($pet_field_name_arr, $pet_field_desc_arr = array() ) {
	if ( in_array( 'petcolor', $pet_field_name_arr ) ) {
		$pet_color = ( $pet_field_desc_arr['petcolor'] ) ? $pet_field_desc_arr['petcolor'] : '';
		return '<div class="mti-pet-spec-container"><label for="pet-color">'. __( 'Pet Color: ', 'adforest' ) . '<input type="text" class="form-control" name="ad_pet_color" value="' . $pet_color . '"></label></div>';
	}
}

function adforest_display_petgender_options( $pet_field_name_arr, $pet_field_desc_arr = array() ) {
	if ( in_array( 'petgender', $pet_field_name_arr ) ) {
		$pet_male_value = '';
		$pet_female_value = '';
		if ( $pet_field_desc_arr['petgender'] ) {
			$pet_gender = $pet_field_desc_arr['petgender'];
			if ( 'male' === $pet_gender ) {
				$pet_male_value = 'checked';
			} else if ( 'female' === $pet_gender  ) {
				$pet_female_value = 'checked';
			}
		}

		$markup = '<div class="mti-pet-spec-container">
						<label class="pet-gender-label">' . __( 'Pet Gender: ', 'adforest' ) . '</label>
						<label>
							<input class="pet-input-gender " id="anbz-male" type="radio" name="ad_pet_gender" value="male" ' . $pet_male_value . '> '. __( 'Male ', 'adforest' )
                        .'</label>
						<label>
						<input type="radio" class="pet-input-gender" id="anbz-female" name="ad_pet_gender" value="female" ' . $pet_female_value . '> '. __( 'Female ', 'adforest' ) .
		                '</label>
					</div>';
		return $markup;
	}
}

function adforest_display_petsize_options( $pet_field_name_arr, $pet_field_desc_arr = array(), $cat_slug = '' ) {

	if ( in_array( 'petsize', $pet_field_name_arr ) ) {		
		$pet_size = ( $pet_field_desc_arr['petsize'] ) ? $pet_field_desc_arr['petsize'] : '';
		$pet_size_markup = '';
		
		if ( 'pet-birds' === $cat_slug || 'aquarium-fish' === $cat_slug ) {

			$pet_size_value_arr = array(
				'',
				'Small',
				'Medium',
				'Large',
			);
			$pet_size_markup = '<div class="mti-pet-spec-container"><label for="pet-size">'. __( 'Pet Size: ', 'adforest' ) .'</label>' .
			                  '<select name="ad_pet_size" class="form-control">';
			foreach ( $pet_size_value_arr as $value ) {

				$pet_size_markup .= '<option value="' . $value . '">' . $value . '</option>';
			}
			$pet_size_markup .='</select>';
			return $pet_size_markup;
		} else {
			$pet_size_markup = '<label for="pet-size">'. __( 'Pet Size:', 'adforest' ) . '<input type="text" class"form-control" name="ad_pet_size" value="' . $pet_size . '"></label></div>';
		}
		return $pet_size_markup;
	}
}

function adforest_display_petquality_options( $pet_field_name_arr, $pet_field_desc_arr = array(), $cat_slug = '' ) {
	if ( in_array( 'petquality', $pet_field_name_arr ) ) {
		$pet_quality = ( $pet_field_desc_arr['petquality'] ) ? $pet_field_desc_arr['petquality'] : '';
		$pet_quality_markup = '';

		if ( 'dog' === $cat_slug ) {

			$pet_quality_value_arr = array(
				'',
				'Pure Breed',
				'Pure Breed with Paper',
				'Pure Breed without Paper',
				'Pure Breed with champion line',
				'Cross Breed',
			);
			$pet_quality_markup = '<div class="mti-pet-spec-container">
									<label for="pet-quality">'. __( 'Pet Quality: ', 'adforest' ) .
			                        '<select name="ad_pet_quality" class="form-control">';
			foreach ( $pet_quality_value_arr as $value ) {

				$pet_quality_markup .= '<option value="' . $value . '">' . $value . '</option>';
			}
			$pet_quality_markup .= '</label>' .
			                    '</select>
								  </div>';
			return $pet_quality_markup;
		} else {
			$pet_quality_markup = '<div class="mti-pet-spec-container">
									<label for="pet-quality">'. __( 'Pet Quality:', 'adforest' ) . '
									<input type="text" name="ad_pet_quality" class="form-control" value="' . $pet_quality . '">
									</label>
									</div>';
		}
		return $pet_quality_markup;
	}
}

function adforest_display_petweight_options( $pet_field_name_arr, $pet_field_desc_arr = array(), $cat_slug = '' ) {
	if ( in_array( 'petweight', $pet_field_name_arr ) ) {
		$pet_weight = ( $pet_field_desc_arr['petweight'] ) ? $pet_field_desc_arr['petweight'] : '';
		$pet_weight_markup = '';
		$heavy_weight_pets = array( 'cattle', 'buffalo', 'horse', 'camel' );
		$is_heavy_weight_pet = in_array( $cat_slug, $heavy_weight_pets );
		if ( $is_heavy_weight_pet ) {

			$pet_weight_value_arr = array(
				'',
				'50 Kilo to 1 Quintal',
				'1 Quintal to 2 Quintal',
				'2 Quintal to 4 Quintal',
				'4 Quintal to 6 Quintal',
				'6 Quintal to 8 Quintal',
				'8 Quintal and above',
			);
		} else {
			$pet_weight_value_arr = array(
				'',
				'Less than 5 Kg',
				'5Kg - 10Kg',
				'10Kg – 25Kg',
				'26Kg – 50Kg',
				'51Kg – 75Kg',
				'76Kg – 100Kg',
				'More than 100Kg',
			);
		}
		$pet_weight_markup = '<div class="mti-pet-spec-container"><label for="pet-weight">'. __( 'Pet Weight: ', 'adforest' ) .
		                     '<select name="ad_pet_weight" class="form-control">';
		foreach ( $pet_weight_value_arr as $value ) {

			$pet_weight_markup .= '<option value="' . $value . '">' . $value . '</option>';
		}
		$pet_weight_markup .= '</label>' .
		                      '</select>
							</div>';
		return $pet_weight_markup;
	}
}

function adforest_display_petvaccinated_options( $pet_field_name_arr, $pet_field_desc_arr = array() ) {
	if ( in_array( 'petisvaccinated', $pet_field_name_arr ) ) {
		$pet_is_vacc_yes = '';
		$pet_is_vacc_no = '';
		if ( $pet_field_desc_arr['petisvaccinated'] ) {
			$pet_is_vacc = $pet_field_desc_arr['petisvaccinated'];
			if ( 'yes' === $pet_is_vacc ) {
				$pet_is_vacc_yes = 'checked';
			} else if ( 'no' === $pet_is_vacc  ) {
				$pet_is_vacc_no = 'checked';
			}
		}
		return '<div class="mti-pet-spec-container">
					<label class="pet-vacc-label">'. __( 'Pet Vaccinated: ', 'adforest' ) . '</label>' .
		            '<label>' .
		                '<input type="radio" name="ad_pet_vaccinated" value="yes" ' . $pet_is_vacc_yes . '> '. __( 'Yes ', 'adforest' ) .
		            '</label>
					<label>
                        <input type="radio" name="ad_pet_vaccinated" value="no" ' . $pet_is_vacc_no . '> '. __( 'No ', 'adforest' ) .
		            '</label>
               </div>';
	}
}

function adforest_display_petpregnancy_options( $pet_field_name_arr, $pet_field_desc_arr = array() ) {
	if ( in_array( 'petispregnant', $pet_field_name_arr ) ) {
		$pet_is_preg_yes = '';
		$pet_is_preg_no = '';
		if ( $pet_field_desc_arr['petispregnant'] ) {
			$pet_is_preg = $pet_field_desc_arr['petispregnant'];
			if ( 'yes' === $pet_is_preg ) {
				$pet_is_preg_yes = 'checked';
			} else if ( 'no' === $pet_is_preg  ) {
				$pet_is_preg_no = 'checked';
			}
		}
		return '<div class="mti-pet-spec-container"><p class="adforest-pet-pregnant-text adforest-display"><label class="pet-pregnant-label">'. __( 'Pet Pregnant: ', 'adforest' ) . '</label><label><input type="radio" name="ad_pet_pregnant" value="yes" ' . $pet_is_preg_yes . '> '. __( 'Yes ', 'adforest' ) . '</label>
            <label><input type="radio" name="ad_pet_pregnant"  value="no" ' . $pet_is_preg_no . '> '. __( 'No ', 'adforest' ) . '</label></p></div>';
	}
}

function adforest_display_petbreedpercentage_options( $pet_field_name_arr, $pet_field_desc_arr = array() ) {
	if ( in_array( 'petbreedpercentage', $pet_field_name_arr ) ) {
		$pet_breed_percentage = ( $pet_field_desc_arr['petbreedpercentage'] ) ? $pet_field_desc_arr['petbreedpercentage'] : '';
		return '<div class="mti-pet-spec-container"><label for="pet-teeth">'. __( 'Pet breed Percentage:', 'adforest' ) . '<input class="form-control" type="number" name="ad_pet_breed_percentage" value="' . $pet_breed_percentage . '" min="0" max="100"></label></div>';
	}
}

function adforest_display_petbirthweight_options( $pet_field_name_arr, $pet_field_desc_arr = array() ) {
	if ( in_array( 'petweightatbirth', $pet_field_name_arr ) ) {
		$pet_birth_weight = ( $pet_field_desc_arr['petbirthweight'] ) ? $pet_field_desc_arr['petbirthweight'] : '';
		return '<div class="mti-pet-spec-container"><label for="pet-birth-weight">'. __( 'Pet Weight at Birth:', 'adforest' ) . '<input class="form-control" type="text" name="ad_pet_birth_weight" value="' . $pet_birth_weight . '"></label></div>';
	}
}

function adforest_display_petteeth_options( $pet_field_name_arr, $pet_field_desc_arr = array() ) {
	if ( in_array( 'petteeth', $pet_field_name_arr ) ) {
		$pet_teeth = ( $pet_field_desc_arr['petteeth'] ) ? $pet_field_desc_arr['petteeth'] : '';
		return '<div class="mti-pet-spec-container"><label for="pet-teeth">'. __( 'Pet Teeth:', 'adforest' ) . '<input type="text" class="form-control" name="ad_pet_teeth" value="' . $pet_teeth . '"></label></div>';
	}
}

function adforest_display_petheight_options( $pet_field_name_arr, $pet_field_desc_arr = array() ) {
	if ( in_array( 'petheight', $pet_field_name_arr ) ) {
		$pet_height = ( $pet_field_desc_arr['petheight'] ) ? $pet_field_desc_arr['petheight'] : '';
		return '<div class="mti-pet-spec-container"><label for="pet-height">'. __( 'Pet Height:', 'adforest' ) . '<input type="text" class="form-control" name="ad_pet_height" value="' . $pet_height . '"></label></div>';
	}
}

function adforest_display_petmilkingcapacity_options( $pet_field_name_arr, $pet_field_desc_arr = array() ) {
	if ( in_array( 'petmilkingcapacity', $pet_field_name_arr ) ) {
		$pet_milking_capacity = ( $pet_field_desc_arr['petmilkingcapacity'] ) ? $pet_field_desc_arr['petmilkingcapacity'] : '';
		return '<div class="mti-pet-spec-container"><p class="adforest-display" id="anbz-milking-capacity" ><label for="pet-milking-capacity">'. __( 'Pet Milking Capacity:', 'adforest' ) . '<input type="number" class="form-control" min="0" max="100" name="ad_pet_milking_capacity" value="' . $pet_milking_capacity . '"></label></p></div>';
	}
}

if ( ! function_exists( 'adforest_get_pet_field_names' ) ) {
	/**
	 * Construct an array of pet_field_names and return it.
	 *
	 * @param $pet_field_slug
	 * @param $taxonomy
	 *
	 * @return {array} $pet_field_name_arr Array containing pet field names.
	 */
	function adforest_get_pet_field_names( $pet_field_slug, $taxonomy ) {
		$term_string = get_term_by( 'slug', $pet_field_slug, $taxonomy )->description;
		$pet_field_name_arr = explode( '|', $term_string );
		return $pet_field_name_arr;
	}
}

if ( ! function_exists( 'adforest_get_category_info_array' ) ) {
	/**
	 * Returns an array containing the Category names id, and slug with taxonomy as 'ad_cats'.
	 *
	 * @param {int} $parent_id Optional but when passed returns array containing all the child categories of the parent category with id $parent_id.
	 *
	 * @return {array} $cat_arr Category Info Array.
	 */
	function adforest_get_category_info_array( $parent_id = 0 ) {
		$term_arr = get_terms( array(
			'taxonomy' => 'ad_cats',
			'hide_empty' => false,
			'parent' => $parent_id,
		) );

		$cat_arr = array();
		foreach ( $term_arr as $arr ) {
			$cat_info = array();
			$cat_info['cat_name'] = $arr->name;
			$cat_info['cat_id'] = $arr->term_id;
			$cat_info['slug'] = $arr->slug;
			array_push( $cat_arr, $cat_info );
		}

		return $cat_arr;
	}
}

if ( ! function_exists( 'adforest_get_category_markup' ) ) {
	/**
	 * Returns Markup for Categories
	 *
	 * @return {string} $markup Category Markup.
	 */
	function adforest_get_category_markup() {
		$cat_info_arr = adforest_get_category_info_array();

		if ( ! is_array( $cat_info_arr ) && empty( $cat_info_arr ) ) {
			return;
		}

		$markup = '<div class="adforest-category-select-category">Select Category <span class="required"> *</span></div>' .
		          '<div class="adforest-category-container">' .
		            '<div class="ad-cat-wrapper">';

		for ( $i = 0; $i < count( $cat_info_arr ); $i++ ) {
			$cat_id = $cat_info_arr[ $i ]['cat_id'];
			$cat_img_src = adforest_get_taxonomy_img_src( $cat_id );
			$markup .= '<div class="adforest-cat-item-container" id="cat-item-container-' . $cat_id . '">
					<p class="ad-cat-element ' . $cat_info_arr[ $i ]['cat_name'] . '" data-pet-id="' . $cat_id . '" data-pet-name="' . $cat_info_arr[ $i ]['cat_name'] . '" id="cat-item-' . $cat_id . '">
						<img src="' . $cat_img_src . '" alt=""  data-pet-name="' . $cat_info_arr[ $i ]['cat_name'] . '" data-pet-id="' . $cat_id . '">
						<span class="cat-name" data-pet-id="' . $cat_id . '" data-pet-name="' . $cat_info_arr[ $i ]['cat_name'] . '" id="' . $cat_id . '">' . $cat_info_arr[ $i ]['cat_name'] . '</span>
					</p>
					</div>';
		}

		$markup .='</div>';

		return $markup;
	}
}

if ( ! function_exists( 'adforest_get_subcategory_markup' ) ) {
	/**
	 * Returns the Sub Category Markup for Post Adds.
	 *
	 * @param $parent_cat_id
	 *
	 * @return {string|void} $markup Sub Category Markup.
	 */
	function adforest_get_subcategory_markup( $parent_cat_id ) {
		$cat_info_arr = adforest_get_category_info_array( $parent_cat_id );

		if ( ! is_array( $cat_info_arr ) && empty( $cat_info_arr ) ) {
			return;
		}

		$markup = '<div class="adforest-subcat-item-container adforest-display" id="sub-cat-' . $parent_cat_id . '">' .
					'<span class="button b-close"><span class="cross">Next</span></span>';
		for ( $i = 0; $i < count( $cat_info_arr ); $i++ ) {
			$cat_id = $cat_info_arr[ $i ]['cat_id'];
			$markup .= '<p class="ad-subcat-element" data-sub-cat-name="' . $cat_info_arr[ $i ]['cat_name'] . '" data-sub-cat-id="' . $cat_id . '" id="ad-subcat-el-' . $cat_id . '">
						<span class="subcat-name" data-sub-cat-name="' . $cat_info_arr[ $i ]['cat_name'] . '" data-sub-cat-id="' . $cat_id . '" id="' . $cat_id . '">' . $cat_info_arr[ $i ]['cat_name'] . '</span>
					</p>';
		}
		$markup .= '</div>';

		return $markup;
	}
}

if ( ! function_exists( 'adforest_get_subcat_markup' ) ) {
	/**
	 * Returns the sub category markup.
	 *
	 * @return {string} $markup Markup for sub category.
	 */
	function adforest_get_subcat_markup() {

		$markup = '<p class="adforest-subcategory-select-category adforest-display">Select Sub Category</p>' .
		          '<div class="ad-sub-cat-wrapper adforest-display">';

		$cat_info_arr = adforest_get_category_info_array();
		for ( $i = 0; $i < count( $cat_info_arr ); $i++ ) {
			$cat_id = $cat_info_arr[ $i ]['cat_id'];
			$markup .= adforest_get_subcategory_markup($cat_id );
		}

		$markup .= '</div>';
		return $markup;
	}
}

if ( ! function_exists( 'adforest_get_taxonomy_img_src' ) ) {
	/**
	 * Returns the image src value for the image linked with the category for the given category id.
	 *
	 * @param $cat_id
	 *
	 * @return {string} $image_src Image Source for category.
	 */
	function adforest_get_taxonomy_img_src( $cat_id ) {

		/**
		 * Get the array value of option_name 'taxonomy_image_plugin' from wp_options table.
		 * This array has the image id and category id pair for the corresponding category.
		 */
		$image_id_array = get_option( 'taxonomy_image_plugin' );

		// Get the image id for that category id.
		$image_id = $image_id_array[ $cat_id ];
		$image_src = taxonomy_image_plugin_get_image_src( $image_id );
		return $image_src;
	}
}


if ( ! function_exists( 'get_pet_field_array_by_post_id' ) ) {
	/**
	 * Returns the pet fields description array containing pet description information for that particular
	 * post with the given post id.
	 *
	 * @param $post_id
	 *
	 * @return {array|void} $pet_field_description_arr Pet Field Description Array.
	 */
	function get_pet_field_array_by_post_id( $post_id ) {
		$post_category_arr =  get_the_terms( $post_id, 'ad_cats' );
		$cat_slug = '';

		if ( ! is_array( $post_category_arr ) ) {
			return;
		}

		// Get the Category slug of the category which does not have parent.
		foreach ( $post_category_arr as $cat_obj ) {
			if ( ! $cat_obj->parent ) {
				$cat_slug = $cat_obj->slug;
			}
		}

		// Get all the pet fields that this particular category has, in form on an array.
		$pet_field_names_arr = adforest_get_pet_field_names( $cat_slug, 'petfield' );

		$pet_field_description_arr = array();

		// Loop through each pet fields and store the pet description field_slug=>field_value pairs into an array.
		foreach ( $pet_field_names_arr as $pet_field_slug ) {
			$pet_field_array = array();
			$pet_taxonomy = $pet_field_slug;
			$pet_field_obj_arr =  get_the_terms( $post_id, $pet_taxonomy );
			$pet_field_obj = $pet_field_obj_arr[0];
			$pet_field_array[ $pet_field_slug ] = $pet_field_obj->name;
			array_push( $pet_field_description_arr, $pet_field_array );
		}

		return $pet_field_description_arr;
	}

}

if ( ! function_exists( 'adforest_pet_field_description_markup' ) ) {
	/**
	 * Pet Field Description Markup.
	 *
	 * @param $post_id Post Id
	 *
	 * @return {string|void}
	 */
	function adforest_pet_field_description_markup( $post_id ) {
		$pet_field_description_arr = get_pet_field_array_by_post_id( $post_id );
		$markup = '';

		if ( ! is_array( $pet_field_description_arr ) ) {
			return;
		}

		$singular_name_arr = adforest_get_singular_names_by_taxonomy( 'ad_post' );
		$markup .= '<div class="adforest-pet-front-end-description-box">';
		// Loop through each item to build markup for pet field descriptions.
		foreach ( $pet_field_description_arr as $pet_field_arr ) {
			foreach ( $pet_field_arr as $field_taxonomy_name => $field_value ) {
				if ( $field_value ) {
					$field_name_for_display = $singular_name_arr[ $field_taxonomy_name ];
					$markup .= '<span class="adforest-front-end-field-name">' . $field_name_for_display . '</span>' .
					           '<span class="adforest-front-end-field-value">: ' . $field_value . '</span>';
				}
			}
		}
		$markup .= '</div>';

		return $markup;
	}
}

if ( ! function_exists( 'adforest_get_singular_names_by_taxonomy' ) ) {
	/**
	 * Returns an array containing the key value pairs of taxonomy_name => its_singular_name
	 *
	 * @param $post_type
	 *
	 * @return {array} $singular_name_arr Array containing taxonomy_name => its_singular_name pair
	 */
	function adforest_get_singular_names_by_taxonomy( $post_type ) {

		// Returns an array of objects of taxonomy names for the given post type.
		$taxonomies = get_object_taxonomies( $post_type, 'name' );


		$singular_name_arr = array();

		// Loop through the $taxonomy array
		foreach ( $taxonomies as $field_obj ) {
			$field_name = $field_obj->name;
			$lables = $field_obj->labels;
			$singular_name = $lables->singular_name;
			$singular_name_arr[ $field_name ] = $singular_name;
		}

        return $singular_name_arr;
	}
}


if ( ! function_exists( 'myrltech_pet_field_val_arr' ) ) {

	/**
	 * Returns an array of pet field and value pair for the given post id.
	 *
	 * @param {int} $ad_or_post_id Post Id.
	 *
	 * @return {array} $pet_field_arr Array of pet field and value pair.
	 */
	function myrltech_pet_field_val_arr( $ad_or_post_id ) {
		$pet_field_desc_arr = get_pet_field_array_by_post_id( $ad_or_post_id );
		$pet_field_arr = array();
		
		for ( $i = 0; $i < count( $pet_field_desc_arr ); $i++ ) {
			foreach ( $pet_field_desc_arr[ $i ] as $pet_field_name => $pet_field_val ) {
				$pet_field_arr[ $pet_field_name ] = $pet_field_val;
			}
		}

		return $pet_field_arr;

	}
}

/**
 * Create postdata object and send to js file
 */
function mti_enqueue_scripts() {
	wp_localize_script( 'adforest-category-post-add', 'postdata', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ), // admin_url( 'admin-ajax.php' ) returns the url till admin-ajax.php file of wordpress.
	) );
}

add_action( 'wp_enqueue_scripts', 'mti_enqueue_scripts' );

add_action( 'wp_ajax_my_ajax_hook', 'mti_do_something' );

/**
 * Send the success message to js file
 */
function mti_do_something() {

	wp_send_json_success( array(
		'my_data' => 'pass what you want to send to js file here',  // Always pass your data here that you want to access in js file.
		'data_recieved_from_js' => $_POST,  // $_POST will contain the array of data object passed in js file second parameter. like action,name etc
	) );
}

/**
 * Returns custom query object for ad search widget.
 *
 * @param $post $_POST.
 *
 * @return {obj} $query WP_Query.
 */
function mti_get_ad_search_widget_query( $post ) {
	$args = array(
		'post_type' => 'ad_post',
		'posts_per_page' => 10,

		'tax_query' => array(
			'relation' => 'AND',
		),
	);

	foreach ( $post as $taxonomy => $term_id_array ) {
		// Remove the last 's' that was applied at the end of the taxonomy
		$taxonomy = substr( $taxonomy, 0, -1 );
		if ( 'ad_cats' === $taxonomy || 'ad_country' === $taxonomy ) {
			$tax_array = array(
				'taxonomy' => $taxonomy,
				'field' => 'id',
				'terms' => $term_id_array,
				'include_children' => false,
				'operator' => 'AND'
			);
		} else {
			$tax_array = array(
				'taxonomy' => $taxonomy,
				'field' => 'id',
				'terms' => $term_id_array,
				'include_children' => false,
				'operator' => 'IN'
			);
		}

		array_push( $args['tax_query'], $tax_array );
	}

//	echo '<pre>';
//	print_r( $post );

	$query = new WP_Query( $args );
	if ( ! empty( $post ) ) {
		return $query;
	}
}


