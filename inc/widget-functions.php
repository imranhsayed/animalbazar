<?php
/**
 * Categories, Pet field and Location Widget Functions
 *
 * @package adforest
 */

// Register and load the widget
function adforest_load_widget() {
	register_widget( 'adforest_widget' );
}
add_action( 'widgets_init', 'adforest_load_widget' );

// Creating the widget
class adforest_widget extends WP_Widget {

	function __construct() {
		parent::__construct(

// Base ID of your widget
			'adforest_widget',

// Widget name will appear in UI
			__('Ad Search Filter Widget', 'adforest'),

// Widget description
			array( 'description' => __( 'Sample widget based on WPBeginner Tutorial', 'adforest' ), )
		);
	}

// Creating widget front-end

	public function widget( $args, $instance ) {

		$cat_and_loc_slug_array = $this->get_cat_and_location_slug();
		$cat_slug = $cat_and_loc_slug_array['cat_slug'];
		$location_slug = $cat_and_loc_slug_array['location_slug'];

		/**
		 * Get an Array $category_array containing all categories info.
		 */
		$cat_terms = get_terms( array(
			'taxonomy' => 'ad_cats',
			'hide_empty' => false,
			'parent' => 0,
			'slug' => $cat_slug,  // Remove slug to get the complete list of categories.
		) );

		// If match not found or if the search is made by location then show all categories.
		if ( ! $cat_terms || $location_slug ) {
			$cat_terms = get_terms( array(
				'taxonomy' => 'ad_cats',
				'hide_empty' => false,
				'parent' => 0,
			) );
		}

		$pet_fields = get_terms( array(
			'taxonomy' => 'petfield',
			'hide_empty' => false,
		) );


		// Array Containing pet filed slug.
		$pet_field_array = array();
		for( $i = 0; $i < count( $pet_fields ); $i++ ) {
			$slug = $pet_fields[ $i ]->slug;
			$pet_field_type_arr = explode( '|', $pet_fields[ $i ]->description );
			$pet_field_array[ $slug ] = $pet_field_type_arr;
		}

		// Get an array of all taxonomies
		$all_taxonomies = get_taxonomies( '', 'names' );
		/**
		 * Get an Array $location_slug_array containing all Ad Location taxonomy info
		 */
		$location_terms = get_terms( array(
			'taxonomy' => 'ad_country',
			'hide_empty' => false,
			'parent' => 0,
			'slug' => $location_slug,
		) );

		// If match not found then show all location
		if ( ! $location_terms ) {
			$location_terms = get_terms( array(
				'taxonomy' => 'ad_country',
				'hide_empty' => false,
				'parent' => 0,
			) );
		}

		/**
		 * Create Categories markup
		 */
		$cat_markup = $this->get_cat_markup( $cat_terms, $cat_slug );

		/**
		 * Create Pet Field markup
		 */
		$pet_field_markup = $this->get_pet_field_markup( $all_taxonomies, $cat_slug, $pet_field_array );

		/**
		 * Create Categories markup
		 */
		$location_markup = $this->get_location_markup( $location_terms, $location_slug );


		// Get widget title values
		$category_title = apply_filters( 'widget_title', $instance['category_title'] );
		$pet_field_title = apply_filters( 'widget_title', $instance['pet_field_title'] );
		$location_title = apply_filters( 'widget_title', $instance['location_title'] );

		/**
		 * Category Front End Title.
		 * Before and after widget arguments are defined by themes.
		 */
		global $adforest_theme;
		echo '<form action="" method="post" id="ad-search-widget-form">';
		echo '<div class="adforest-display hidden-element-to-submit-form ad-search-hidden-submit"></div>';
		echo '<input type="submit" class=" adforest-display ad-search-widget-submit">';
		echo $args['before_widget'];
		if ( ! empty( $category_title ) )
			echo $args['before_title'] .
			     '<div class="adforest-panel-heading" role="tab" id="headingOne">' .
			     '<h4 class="panel-title" data-ad-content="ad-cat-list-content">' .
			     '<a class="collapsed adforest-widget-category" role="button" data-ad-content="ad-cat-list-content" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseOne">
					            <i class="more-less glyphicon glyphicon-plus"></i>' .
			     $category_title .
			     '</a>' .
			     '</h4>' .
			     '</div>' .
			     $args['after_title'] . '</br>';

		// This is where you run the code and display the output
		echo '<div id="collapseOne" class="panel-collapse ad-cat-list-content adforest-display" role="tabpanel" aria-labelledby="headingOne">' .
		     '<div class="panel-body categories">' .
		     $cat_markup .
		     '</div>' .
		     '</div>';
		echo $args['after_widget'];

		/**
		 * Pet Fields Front End Title.
		 * Before and after widget arguments are defined by themes.
		 */
		echo $args['before_widget'];
		if ( ! empty( $pet_field_title ) )
			echo $args['before_title'] .
			     '<div class="adforest-panel-heading" role="tab" id="headingTwo">' .
			     '<h4 class="panel-title" data-ad-content="ad-petfield-list-content">' .
			     '<a class="collapsed adforest-widget-pet-fields" role="button" data-ad-content="ad-petfield-list-content" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseOne">
					            <i class="more-less glyphicon glyphicon-plus"></i>' .
			     $pet_field_title .
			     '</a>' .
			     '</h4>' .
			     '</div>' .
			     $args['after_title'] . '</br>';

		// This is where you run the code and display the output
		echo '<div id="collapseTwo" class="panel-collapse ad-petfield-list-content adforest-display" role="tabpanel" aria-labelledby="headingTwo">' .
		     '<div class="panel-body categories">' .
		     $pet_field_markup .
		     '</div>' .
		     '</div>';
		echo $args['after_widget'];

		/**
		 * Location Front End Title.
		 * Before and after widget arguments are defined by themes.
		 */
		echo $args['before_widget'];
		if ( ! empty( $location_title ) )
			echo $args['before_title'] .
			     '<div class="adforest-panel-heading" role="tab" id="headingThree">' .
			     '<h4 class="panel-title" data-ad-content="ad-location-content">' .
			     '<a class="collapsed adforest-widget-location" role="button" data-ad-content="ad-location-content" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseOne">
					            <i class="more-less glyphicon glyphicon-plus"></i>' .
			     $location_title .
			     '</a>' .
			     '</h4>' .
			     '</div>' .
			     $args['after_title'] . '</br>';

		// This is where you run the code and display the output
		echo '<div id="collapseThree" class="panel-collapse ad-location-content adforest-display" role="tabpanel" aria-labelledby="headingThree">' .
		     '<div class="panel-body categories">' .
		     $location_markup .
		     '</div>' .
		     '</div>';
		echo $args['after_widget'];
		echo '</form>';
	}

	/**
	 * Returns the singular name for a taxonomy when its slug is passed.
	 *
	 * @param string $slug
	 *
	 * @return {string} $singular_name Singular NAme of a taxonomy.
	 */
	public function get_field_singular_name( $slug = '' ) {

		$taxonomies_name_array = get_object_taxonomies( 'ad_post', 'object_or_name' );
		$singular_name = $taxonomies_name_array[ $slug ]->labels->singular_name;
		return $singular_name;
	}

	/**
	 * Get the Category and location slug from the url
	 *
	 * @return {array} $cat_and_loc_slug_array Contains $cat_and_loc_slug_array['cat_slug'] and $cat_and_loc_slug_array['location_slug']
	 */
	public function get_cat_and_location_slug() {
		// Get the category slug and location slug from url.
		$cat_slug = '';
		$location_slug = '';

		if ( $_GET['ad_location'] && $_GET['ad_title'] ) {

			$location_slug = strtolower( $_GET['ad_location'] );
			$cat_slug = strtolower( $_GET['ad_title'] );

		} else if ( $_GET['ad_location'] ) {

			$location_slug = strtolower( $_GET['ad_location'] );

		} else if ( $_GET['ad_title'] ) {

			$cat_slug = strtolower( $_GET['ad_title'] );

		} else {
			$path = explode( '/', $_SERVER['REQUEST_URI'] );
			$item = count( $path ) - 2;
			$cat_slug = strtolower( $path[ $item ] );

			if ( 'search-results' === $cat_slug ) {
				$cat_slug = '';
			}
		}
		$cat_slug = str_replace( ' ', '-', $cat_slug );

		$cat_and_loc_slug_array = array(
			'cat_slug' => $cat_slug,
			'location_slug' => $location_slug,
		);

		return $cat_and_loc_slug_array;
	}

	/**
	 * Returns the Categories and Subcategories Markup.
	 *
	 * @param $cat_terms
	 * @param $cat_slug
	 *
	 * @return {string} $cat_markup Cat Markup
	 */
	public function get_cat_markup( $cat_terms, $cat_slug ) {
		$cat_markup = '<ul class="ad-search-widget" data-taxonomy="ad_cats">';
		for ( $i = 0; $i < count( $cat_terms ); $i++ ) {
			$checked = ( $cat_slug === $cat_terms[ $i ]->slug ) ? 'checked' : '';
			$cat_markup .= '<li data-cat-widget-id="' . $cat_terms[ $i ]->term_id . '">' .
			               '<input type="checkbox" id="ad-widget-cat-' . $cat_terms[ $i ]->name . '" name="ad_catss[]" data-taxonomy="ad_cats" data-slug="' . $cat_terms[ $i ]->slug . '" value="' . $cat_terms[ $i ]->term_id . '" ' . $checked . '/> ' .
			               '<label class="ad-wid-cat-heading" for="ad-widget-cat-' . $cat_terms[ $i ]->name . '">' . ' ' . $cat_terms[ $i ]->name . '<span class="cat-widget-count"> ( ' . $cat_terms[ $i ]->count . ' ) </span>' . '</label>' .
			               '<ul class="widget-subcat-ul adforest-display">';

			$sub_cat = get_terms( array(
				'taxonomy' => 'ad_cats',
				'hide_empty' => false,
				'child_of' => $cat_terms[ $i ]->term_id,
			) );

			for( $z = 0; $z < count( $sub_cat ); $z++ ) {
				$checked = ( $cat_slug === $sub_cat[ $z ]->slug ) ? 'checked' : '';
				$cat_markup .=      '<li>' .
				                    '      <input type="checkbox" id="ad-widget-sub-cat-' . $sub_cat[ $z ]->name  . '" name="ad_catss[]" data-taxonomy="ad_cats" data-slug="' . $sub_cat[ $z ]->slug . '"value="' . $sub_cat[ $z ]->term_id . '" ' . $checked . '/> ' .
				                    '<label for="ad-widget-sub-cat-' . $sub_cat[ $z ]->name  . '">' . $sub_cat[ $z ]->name  . '</label>'.
				                    '</li>';
			}

			$cat_markup .=      '</ul>' .
			                    '</li>';
		}
		$cat_markup .= '</ul>';

		return $cat_markup;
	}

	/**
	 * Returns pet field markup.
	 *
	 * @param $all_taxonomies
	 * @param $cat_slug
	 * @param $pet_field_array
	 *
	 * @return {string} $pet_field_markup Pet field Markup.
	 */
	public function get_pet_field_markup( $all_taxonomies, $cat_slug, $pet_field_array ) {
		$pet_field_markup = '<ul class="ad-search-widget-pet-field">';
		foreach ( $all_taxonomies as $tax_key => $tax_value ) {
			if ( $cat_slug ) {
				if ( in_array( $tax_value, $pet_field_array[ $cat_slug ] ) ) {
					$pet_field_markup .= $this->get_pet_field_markup_conditional( $tax_value );
				}
			} else {
				$pet_field_markup .= $this->get_pet_field_markup_conditional( $tax_value );
			}
		}
		$pet_field_markup .= '</ul>';

		return $pet_field_markup;
	}

	/**
	 * Get Conditional based Pet Field markup.
	 *
	 * @param $tax_value
	 *
	 * @return {string} $pet_field_markup Pet field markup basis condition.
	 */
	public function get_pet_field_markup_conditional( $tax_value ) {
		$pet_field_markup = '';
		$first_three_letters = substr( $tax_value, 0, 3 );
		if ( 'pet' === $first_three_letters && 'petfield' !== $tax_value ) {
			$pet_terms = get_terms( array(
				'taxonomy' => $tax_value,
				'hide_empty' => false
			) );
			$singular_term_name = $this->get_field_singular_name( $tax_value );
			$pet_field_markup .= '<li data-petfield-widget-id="">' .
				                     '<p class="ad-wid-specif-heading">' .
					                       $singular_term_name .
					                     '<span class="pet-field-widget-count"> ( ' . count( $pet_terms ) . ' ) </span>' .
				                     '</p>' .
			                     '<ul class="ad-search-widget-sub-field adforest-display" data-field-taxonomy="' . $tax_value . '">';

			// Display all values in each pet fields.
			foreach ( $pet_terms as $key => $value ) {
				$pet_field_value = $value->name;
				$pet_field_id = $value->term_id;
				$pet_field_slug = $value->slug;
				$pet_field_markup .= '<li>' .
				                     '<input type="checkbox" name="' . $tax_value . 's[]" data-taxonomy="' . $tax_value . '" data-slug="' . $pet_field_slug . '" value="' . $pet_field_id  . '" id="ad-widget-field-' . ucfirst( $pet_field_value ) . '"> ' .
				                     '<label for="ad-widget-field-' . ucfirst( $pet_field_value ) . '"> ' . ucfirst( $pet_field_value ) . '</label>' .
				                     '</li>';
			}

			$pet_field_markup .= '</ul>' .
			                     '</li>';
		}
		return $pet_field_markup;
	}

	/**
	 * Gets the location markup.
	 *
	 * @param $location_terms
	 * @param $location_slug
	 *
	 * @return {string} $location_markup Location Markup.
	 */
	public function get_location_markup( $location_terms, $location_slug ) {
		$location_markup = '<ul class="ad-search-widget-location" data-location-taxonomy="ad_country">';
		for ( $i = 0; $i < count( $location_terms ); $i++ ) {
			$checked = ( $location_slug === $location_terms[ $i ]->slug ) ? 'checked' : '';
			$location_markup .= '<li data-location-widget-id="' . $location_terms[ $i ]->term_id . '">' .
			                    '<input type="checkbox" name="ad_countrys[]" data-taxonomy="ad_country" data-slug= "' . $location_terms[ $i ]->slug . '" value="' . $location_terms[ $i ]->term_id . '" ' . $checked . ' id="ad-widget-location-' . $location_terms[ $i ]->name . '"/> ' .
			                    '<label class="ad-widget-locat-heading" for="ad-widget-location-' . $location_terms[ $i ]->name . '">' . $location_terms[ $i ]->name . '<span class="cat-widget-count"> ( ' . $location_terms[ $i ]->count . ' ) </span></label>' .

			                    '<ul class="widget-subcat-ul location-ul adforest-display">';

			$sub_location = get_terms( array(
				'taxonomy' => 'ad_country',
				'hide_empty' => false,
				'child_of' => $location_terms[ $i ]->term_id,
			) );

			for( $z = 0; $z < count( $sub_location ); $z++ ) {
				$checked = ( $location_slug === $sub_location[ $z ]->slug ) ? 'checked' : '';
				$location_markup .=      '<li>' .
				                         '<input type="checkbox" data-taxonomy="ad_country" data-slug="' . $sub_location[ $z ]->slug . '" name="ad_countrys[]" value="' . $sub_location[ $z ]->term_id . '" ' . $checked . ' id="ad-widget-sub-location-' . $sub_location[ $z ]->name . '"/> ' .
				                         '<label for="ad-widget-sub-location-' . $sub_location[ $z ]->name . '">' . $sub_location[ $z ]->name . '</label>' .
				                         '</li>';
			}

			$location_markup .=      '</ul>' .
			                         '</li>';
		}
		$location_markup .= '</ul>';

		return $location_markup;
	}

// Widget Backend
	public function form( $instance ) {
		$category_title = ( isset( $instance[ 'category_title' ] ) ) ? $instance[ 'category_title' ] : __( 'Category', 'adforest' );
		$pet_field_title = ( isset( $instance[ 'pet_field_title' ] ) ) ? $instance[ 'pet_field_title' ] : __( 'Pet Fields', 'adforest' );
		$location_title = ( isset( $instance[ 'location_title' ] ) ) ? $instance[ 'location_title' ] : __( 'Location', 'adforest' );

// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'category_title' ); ?>" name="<?php echo $this->get_field_name( 'category_title' ); ?>" type="text" value="<?php echo esc_attr( $category_title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'pet_field_title' ); ?>" name="<?php echo $this->get_field_name( 'pet_field_title' ); ?>" type="text" value="<?php echo esc_attr( $pet_field_title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'location_title' ); ?>" name="<?php echo $this->get_field_name( 'location_title' ); ?>" type="text" value="<?php echo esc_attr( $location_title ); ?>" />
		</p>
		<?php
	}

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['category_title'] = ( ! empty( $new_instance['category_title'] ) ) ? strip_tags( $new_instance['category_title'] ) : '';
		$instance['pet_field_title'] = ( ! empty( $new_instance['pet_field_title'] ) ) ? strip_tags( $new_instance['pet_field_title'] ) : '';
		$instance['location_title'] = ( ! empty( $new_instance['location_title'] ) ) ? strip_tags( $new_instance['location_title'] ) : '';
		return $instance;
	}
} // Class adforest_widget ends here



