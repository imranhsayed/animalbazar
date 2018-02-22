<?php
add_action( 'widgets_init', function(){
     register_widget( 'adforest_search_condition' );
});
if (! class_exists ( 'adforest_search_condition' )) {
class adforest_search_condition extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 
			'classname' => 'adforest_search_conidtion',
			'description' => __('Only for search and single ad sidebar.', 'adforest'),
		);
		// Instantiate the parent object
		parent::__construct( false, __('Ad Condition', 'adforest' ), $widget_ops );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		$expand	=	"";
		$cur_con	=	'';
		
		$is_show = adforest_getTemplateID('static', '_sb_default_cat_condition_show');
		if($is_show = ''  || $is_show == 1){}else{ return;}
		
		if( isset( $_GET['condition'] ) && $_GET['condition'] != "" )
		{
			$cur_con	=	$_GET['condition'];
			$expand	=	"in";
		}
		global $adforest_theme;
		$widget_layout	= adforest_search_layout();
		require trailingslashit( get_template_directory () ) . 'template-parts/layouts/widgets/' . $widget_layout . '/condition.php';
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		{
			$title = $instance[ 'title' ];
		}
		else 
		{
			$title = esc_html__( 'Condition', 'adforest' );
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Condition
}


// Ad type Widget
add_action( 'widgets_init', function(){
     register_widget( 'adforest_search_ad_type' );
});
if (! class_exists ( 'adforest_search_ad_type' )) {
class adforest_search_ad_type extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 
			'classname' => 'adforest_search_ad_type',
			'description' => __('Only for search and single ad sidebar.', 'adforest'),
		);
		// Instantiate the parent object
		parent::__construct( false, __('Ad Type', 'adforest' ), $widget_ops );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$cur_type	=	'';
		$expand	=	"";

		$is_show = adforest_getTemplateID('static', '_sb_default_cat_ad_type_show');
		if($is_show = ''  || $is_show == 1){}else{ return;}
		
		
		if( isset( $_GET['ad_type'] ) && $_GET['ad_type'] != "" )
		{
			$expand	=	"in";
			$cur_type	=	$_GET['ad_type'];
		}
		global $adforest_theme;
		$widget_layout	= adforest_search_layout();
		require trailingslashit( get_template_directory () ) . 'template-parts/layouts/widgets/' . $widget_layout . '/ad_type.php';
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		{
			$title = $instance[ 'title' ];
		}
		else 
		{
			$title = esc_html__( 'Ad Type', 'adforest' );
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Ad Type
}

// Ad Warranty
add_action( 'widgets_init', function(){
     register_widget( 'adforest_search_ad_warranty' );
});
if (! class_exists ( 'adforest_search_ad_warranty' )) {
class adforest_search_ad_warranty extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 
			'classname' => 'adforest_search_ad_warranty',
			'description' => __('Only for search and single ad sidebar.', 'adforest'),
		);
		// Instantiate the parent object
		parent::__construct( false, __('Ad Warranty', 'adforest' ), $widget_ops );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$cur_war	=	'';
		$expand	=	"";
		
		$is_show = adforest_getTemplateID('static', '_sb_default_cat_warranty_show');
		if($is_show = ''  || $is_show == 1){}else{ return;}
		
		
		if( isset( $_GET['warranty'] ) && $_GET['warranty'] != "" )
		{
			$expand	=	"in";
			$cur_war	=	$_GET['warranty'];
		}
		global $adforest_theme;
		$widget_layout	= adforest_search_layout();
		require trailingslashit( get_template_directory () ) . 'template-parts/layouts/widgets/' . $widget_layout . '/warranty.php';
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		{
			$title = $instance[ 'title' ];
		}
		else 
		{
			$title = esc_html__( 'Warranty', 'adforest' );
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Ad Warranty
}

// Simple or featured ad search
add_action( 'widgets_init', function(){
     register_widget( 'adforest_search_ad_simple_feature' );
});
if (! class_exists ( 'adforest_search_ad_simple_feature' )) {
class adforest_search_ad_simple_feature extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 
			'classname' => 'adforest_search_ad_simple_feature',
			'description' => __('Only for search and single ad sidebar.', 'adforest'),
		);
		// Instantiate the parent object
		parent::__construct( false, __('Simple or feature ad search', 'adforest' ), $widget_ops );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$simple	=	'';
		$featured	=	'';
		$expand	=	"";
		$is_ad_type = '';
		if( isset( $_GET['ad'] ) && $_GET['ad'] != "" )
		{
			$expand	=	"in";
			if( $_GET['ad'] == 0)
			{
				$is_ad_type	=	0;
				$simple	=	"checked";	
			}
			if( $_GET['ad'] == 1)
			{
				$is_ad_type	=	1;
				$featured	=	"checked";	
			}
		}
		global $adforest_theme;
		$widget_layout	= adforest_search_layout();
		require trailingslashit( get_template_directory () ) . 'template-parts/layouts/widgets/' . $widget_layout . '/simple_feature.php';
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		{
			$title = $instance[ 'title' ];
		}
		else 
		{
			$title = esc_html__( 'Simple or Featured', 'adforest' );
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Simple or featured ad search
}

// Ad Price Widget
add_action( 'widgets_init', function(){
     register_widget( 'adforest_search_ad_price' );
});
if (! class_exists ( 'adforest_search_ad_price' )) {
class adforest_search_ad_price extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 
			'classname' => 'adforest_search_ad_price',
			'description' => __('Only for search and single ad sidebar.', 'adforest'),
		);
		// Instantiate the parent object
		parent::__construct( false, __('Ad Price', 'adforest' ), $widget_ops );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$expand	=	"";
		

		$is_show = adforest_getTemplateID('static', '_sb_default_cat_price_show');
		if($is_show = ''  || $is_show == 1){}else{ return;}
		
		
		$min_price	=	$instance['min_price'];
		if( isset( $_GET['min_price'] ) && $_GET['min_price'] != "" )
		{
			$expand	=	"in";
			$min_price	=	$_GET['min_price'];
		}
		$max_price	=	$instance['max_price'];
		if( isset( $_GET['max_price'] ) && $_GET['max_price'] != "" )
		{
			$max_price	=	$_GET['max_price'];
		}
		global $adforest_theme;
		
		$min	=	0;
		if( isset( $instance['min_price'] ) )
		{
			$min	=	$instance['min_price'];	
		}
		$currency	=	'';
		if( isset( $_GET['c'] ) )
		{
			$currency	=	$_GET['c'];	
		}
		global $adforest_theme;
		$widget_layout	= adforest_search_layout();
		require trailingslashit( get_template_directory () ) . 'template-parts/layouts/widgets/' . $widget_layout . '/price.php';
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		{
			$title = $instance[ 'title' ];
		}
		else 
		{
			$title = esc_html__( 'Ad Price', 'adforest' );
		}
		
		if ( isset( $instance[ 'min_price' ] ) )
		{
			$min_price = $instance[ 'min_price' ];
		}
		else 
		{
			$min_price = 1;
		}
		
		if ( isset( $instance[ 'max_price' ] ) )
		{
			$max_price = $instance[ 'max_price' ];
		}
		else 
		{
			$max_price = esc_html__( '10000000', 'adforest' );
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'min_price' ) ); ?>" >
            <?php echo esc_html__( 'Min Price:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'min_price' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'min_price' ) ); ?>" type="text" value="<?php echo esc_attr( $min_price ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'max_price' ) ); ?>" >
            <?php echo esc_html__( 'Max Price:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'max_price' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'max_price' ) ); ?>" type="text" value="<?php echo esc_attr( $max_price ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['min_price'] = ( ! empty( $new_instance['min_price'] ) ) ? strip_tags( $new_instance['min_price'] ) : '';
		$instance['max_price'] = ( ! empty( $new_instance['max_price'] ) ) ? strip_tags( $new_instance['max_price'] ) : '';
		return $instance;
	}
} // Ad Price
}


// Ad Categories widget
add_action( 'widgets_init', function(){
     register_widget( 'adforest_search_cats' );
});
if (! class_exists ( 'adforest_search_cats' )) {
class adforest_search_cats extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 
			'classname' => 'adforest_search_cats',
			'description' => __('Only for search and single ad sidebar.', 'adforest'),
		);
		// Instantiate the parent object
		parent::__construct( false, __('Ad Categories', 'adforest' ), $widget_ops );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		$new	=	'';
		$used	=	'';
		$expand	=	"";
		if( isset( $_GET['cat_id'] ) && $_GET['cat_id'] != "" )
		{
			$expand	=	"in";
		}
		global $adforest_theme;
		$widget_layout	= adforest_search_layout();
		require trailingslashit( get_template_directory () ) . 'template-parts/layouts/widgets/' . $widget_layout . '/cats.php';
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		{
			$title = $instance[ 'title' ];
		}
		else 
		{
			$title = esc_html__( 'Categories', 'adforest' );
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Categories widget
}


// Ad title Widget
add_action( 'widgets_init', function(){
     register_widget( 'adforest_search_ad_title' );
});
if (! class_exists ( 'adforest_search_ad_title' )) {
class adforest_search_ad_title extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 
			'classname' => 'adforest_search_ad_title',
			'description' => __('Only for search and single ad sidebar.', 'adforest'),
		);
		// Instantiate the parent object
		parent::__construct( false, __('Ad Search', 'adforest' ), $widget_ops );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$expand	=	"";
		$title	=	'';
		if( isset( $_GET['ad_title'] ) && $_GET['ad_title'] != "" )
		{
			$expand	=	"in";
			$title	=	$_GET['ad_title'];
		}
		global $adforest_theme;
		$widget_layout	= adforest_search_layout();
		require trailingslashit( get_template_directory () ) . 'template-parts/layouts/widgets/' . $widget_layout . '/title.php';
	?>
     
    <?php
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		{
			$title = $instance[ 'title' ];
		}
		else 
		{
			$title = esc_html__( 'Ad Search', 'adforest' );
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Ad title
}


// Ad Locations widget
add_action( 'widgets_init', function(){
     register_widget( 'adforest_search_locations' );
});
if (! class_exists ( 'adforest_search_locations' )) {
class adforest_search_locations extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 
			'classname' => 'adforest_search_locations',
			'description' => __('Only for search and single ad sidebar.', 'adforest'),
		);
		// Instantiate the parent object
		parent::__construct( false, __('Ad Locations', 'adforest' ), $widget_ops );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		$expand	=	"";
		$location	=	'';
		if( isset( $_GET['location'] ) && $_GET['location'] != "" )
		{
			$expand	=	"in";
			$location	=	$_GET['location'];
		}
		global $adforest_theme;
		$widget_layout	= adforest_search_layout();
		require trailingslashit( get_template_directory () ) . 'template-parts/layouts/widgets/' . $widget_layout . '/location.php';
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		{
			$title = $instance[ 'title' ];
		}
		else 
		{
			$title = esc_html__( 'Ad Locations', 'adforest' );
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Locations widget
}


// Featured Ads Widget
add_action( 'widgets_init', function(){
     register_widget( 'adforest_search_featured_ad' );
});
if (! class_exists ( 'adforest_search_featured_ad' )) {
class adforest_search_featured_ad extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 
			'classname' => 'adforest_search_featured_ad',
			'description' => __('Only for search and single ad sidebar.', 'adforest'),
		);
		// Instantiate the parent object
		parent::__construct( false, __('Ad Featured', 'adforest' ), $widget_ops );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$max_ads	=	$instance['max_ads'];
		global $adforest_theme;
		if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
		{
		if( !is_singular( 'ad_post' ) && isset( $adforest_theme['search_design'] ) )
		{
			if( is_page_template( 'page-search.php' ) && ($adforest_theme['search_design'] == 'map' ||  $adforest_theme['search_design'] == 'topbar' )  ) 
				return;
		}
		}
		
	?>
    
    <div class="panel panel-default">
      <!-- Heading -->
      <div class="panel-heading" >
         <h4 class="panel-title">
            <a>
            <?php echo esc_html( $instance['title'] ); ?>
            </a>
         </h4>
      </div>
      <!-- Content -->
      <div class="panel-collapse">
         <div class="panel-body recent-ads">
            <div class="featured-slider-3">
               <!-- Featured Ads -->
               <?php
					$f_args = 
					array( 
					'post_type' => 'ad_post',
					'post_status' => 'publish',
					'posts_per_page' => $max_ads,
					'meta_query' => array(
					array(
					'key'     => '_adforest_is_feature',
					'value'   => 1,
					'compare' => '=',
					),
					),
					'orderby'        => 'rand',
					
					);
				$f_ads = new WP_Query( $f_args );
				if ( $f_ads->have_posts() ) {
					$number	= 0;
					while ( $f_ads->have_posts() )
					{
						$f_ads->the_post();
						$pid	=	get_the_ID();
						$author_id = get_post_field( 'post_author', $pid );;
						$author = get_user_by( 'ID', $author_id );
						
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

			   ?>
                       <div class="item">
                          <div class="col-md-12 col-xs-12 col-sm-12 no-padding">
                             <!-- Ad Box -->
                             <div class="category-grid-box">
                             
                                <!-- Ad Img -->
                                <div class="category-grid-img">
                                   <img class="img-responsive" alt="<?php echo get_the_title(); ?>" src="<?php echo esc_url( $img ); ?>">
                                   <!-- Ad Status -->
                                   <!-- User Review -->
                                   <?php echo adforest_video_icon(); ?>
                                   <div class="user-preview">
                                      <a href="<?php echo get_author_posts_url( $author_id ); ?>?type=ads">
                                      <img src="<?php echo adforest_get_user_dp( $author_id ); ?>" class="avatar avatar-small" alt="<?php echo get_the_title(); ?>">
                                      </a>
                                   </div>
                                   
                                   <!-- View Details -->
                                   <a href="<?php echo get_the_permalink(); ?>" class="view-details">
                                  <?php echo __('View Details', 'adforest' ); ?>
                                   </a>
                                </div>
                                <!-- Ad Img End -->
                                <div class="short-description">
                                   <!-- Ad Category -->
                                   <div class="category-title">
                                   <?php echo adforest_display_cats( get_the_ID() ); ?>
                                   </div>
                                   <!-- Ad Title -->
                                   <h3><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                   <!-- Price -->
                                   <div class="price">
                                   <?php echo(adforest_adPrice(get_the_ID())); ?> 
                                   </div>
                                </div>
                                <!-- Addition Info -->
                                <div class="ad-info">
                                   <ul>
                                      <li><i class="fa fa-map-marker"></i><?php echo get_post_meta(get_the_ID(), '_adforest_ad_location', true ); ?></li>
                                   </ul>
                                </div>
                             </div>
                             <!-- Ad Box End -->
                          </div>
                       </div>
               <?php
					}
				}
				wp_reset_postdata();
				?>
               <!-- Featured Ads -->
            </div>
         </div>
      </div>
   </div>
    <?php
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		{
			$title = $instance[ 'title' ];
		}
		else 
		{
			$title = esc_html__( 'Featured Ads', 'adforest' );
		}
		if ( isset( $instance[ 'max_ads' ] ) )
		{
			$max_ads = $instance[ 'max_ads' ];
		}
		else 
		{
			$max_ads = 5;
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'max_ads' ) ); ?>" >
            <?php echo esc_html__( 'Max # of Ads:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'max_ads' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'max_ads' ) ); ?>" type="text" value="<?php echo esc_attr( $max_ads ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['max_ads'] = ( ! empty( $new_instance['max_ads'] ) ) ? strip_tags( $new_instance['max_ads'] ) : '';
		return $instance;
	}
} // Featured Ads
}


// Recent Ads Widget
add_action( 'widgets_init', function(){
     register_widget( 'adforest_search_recent_ad' );
});
if (! class_exists ( 'adforest_search_recent_ad' )) {
class adforest_search_recent_ad extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 
			'classname' => 'adforest_search_recent_ad',
			'description' => __('Only for search and single ad sidebar.', 'adforest'),
		);
		// Instantiate the parent object
		parent::__construct( false, __('Ads Recent', 'adforest' ), $widget_ops );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$max_ads	=	$instance['max_ads'];
		global $adforest_theme;
		if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
		{
			if(  !is_singular( 'ad_post' ) && is_page_template( 'page-search.php' )  )
				return;	
		}
	?>
    
<div class="panel panel-default">
  <!-- Heading -->
  <div class="panel-heading" >
     <h4 class="panel-title">
        <a>
        <?php echo esc_html( $instance['title'] ); ?>
        </a>
     </h4>
  </div>
  <!-- Content -->
  <div class="panel-collapse">
     <div class="panel-body recent-ads">
	   <?php
            $f_args = 
            array( 
            'post_type' => 'ad_post',
            'posts_per_page' => $max_ads,
            'post_status' => 'publish',
            'orderby'        => 'ID',
            'order' => 'DESC',
            );
        $f_ads = new WP_Query( $f_args );
        if ( $f_ads->have_posts() ) {
            $number	= 0;
            while ( $f_ads->have_posts() )
            {
                $f_ads->the_post();
                $pid	=	get_the_ID();
                $author_id = get_post_field( 'post_author', $pid );;
                $author = get_user_by( 'ID', $author_id );
                
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

       ?>
        <div class="recent-ads-list">
           <div class="recent-ads-container">
              <div class="recent-ads-list-image">
                 <a href="<?php the_permalink(); ?>" class="recent-ads-list-image-inner">
                 <img alt="<?php echo get_the_title(); ?>" src="<?php echo esc_url( $img ); ?>">
                 </a><!-- /.recent-ads-list-image-inner -->
              </div>
              <!-- /.recent-ads-list-image -->
              <div class="recent-ads-list-content">
                 <h3 class="recent-ads-list-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                 </h3>
                 <ul class="recent-ads-list-location">
                    <li><a href="javascript:void(0);"><?php echo get_post_meta(get_the_ID(), '_adforest_ad_location', true ); ?></a></li>
                 </ul>
                 <div class="recent-ads-list-price">
                    <?php echo(adforest_adPrice(get_the_ID())); ?> 
                 </div>
                 <!-- /.recent-ads-list-price -->
              </div>
              <!-- /.recent-ads-list-content -->
           </div>
           <!-- /.recent-ads-container -->
        </div>
	   <?php
            }
        }
        wp_reset_postdata();
        ?>
 </div>
</div>
</div>               
    <?php
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		{
			$title = $instance[ 'title' ];
		}
		else 
		{
			$title = esc_html__( 'Recent Ads', 'adforest' );
		}
		if ( isset( $instance[ 'max_ads' ] ) )
		{
			$max_ads = $instance[ 'max_ads' ];
		}
		else 
		{
			$max_ads = 5;
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'max_ads' ) ); ?>" >
            <?php echo esc_html__( 'Max # of Ads:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'max_ads' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'max_ads' ) ); ?>" type="text" value="<?php echo esc_attr( $max_ads ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['max_ads'] = ( ! empty( $new_instance['max_ads'] ) ) ? strip_tags( $new_instance['max_ads'] ) : '';
		return $instance;
	}
} // Recent Ads
}

// Advertisement  Widget
add_action( 'widgets_init', function(){
     register_widget( 'adforest_search_advertisement' );
});
if (! class_exists ( 'adforest_search_advertisement' )) {
class adforest_search_advertisement extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 
			'classname' => 'adforest_search_advertisement',
			'description' => __('Only for search and single ad sidebar.', 'adforest'),
		);
		// Instantiate the parent object
		parent::__construct( false, __('Adforest Advertisement', 'adforest' ), $widget_ops );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$ad_code	=	$instance['ad_code'];
		global $adforest_theme;
		
	?>
    
<div class="panel panel-default">
  <!-- Heading -->
  <div class="panel-heading" >
     <h4 class="panel-title">
        <a>
        <?php echo esc_html( $instance['title'] ); ?>
        </a>
     </h4>
  </div>
  <!-- Content -->
  <div class="panel-collapse">
     <div class="panel-body recent-ads">
     	<?php echo "" . $ad_code; ?>
 	 </div>
</div>
</div>               
    <?php
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		{
			$title = $instance[ 'title' ];
		}
		else 
		{
			$title = esc_html__( 'Advertisement', 'adforest' );
		}
		$ad_code = '';
		if ( isset( $instance[ 'ad_code' ] ) )
		{
			$ad_code = $instance[ 'ad_code' ];
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( '300 X 250 Ad', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ad_code' ) ); ?>" >
            <?php echo esc_html__( 'Code:', 'adforest' ); ?>
            </label> 
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ad_code' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ad_code' ) ); ?>" type="text"><?php echo esc_attr( $ad_code ); ?></textarea>
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['ad_code'] = ( ! empty( $new_instance['ad_code'] ) ) ? $new_instance['ad_code'] : '';
		return $instance;
	}
} // Advertisement
}






/*-------------------------------------------------------------------------------------*/
/* Custom Search */
add_action( 'widgets_init', function(){
     register_widget( 'adforest_search_custom_fields' );
});
if (! class_exists ( 'adforest_search_custom_fields' )) {
class adforest_search_custom_fields extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 
			'classname' => 'adforest_search_custom_fields',
			'description' => __('Only for search and single ad sidebar.', 'adforest'),
		);
		// Instantiate the parent object
		parent::__construct( false, __('Custom Fields Search', 'adforest' ), $widget_ops );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
public function widget( $args, $instance ) {
	$ad_code	= '';
	if( isset( $instance['ad_code'] ) )
	{
		$ad_code	=	$instance['ad_code'];
	}
		global $adforest_theme;
		$term_id = '';
		$customHTML = '';	
		$widget_layout	= adforest_search_layout();
		require trailingslashit( get_template_directory () ) . 'template-parts/layouts/widgets/' . $widget_layout . '/custom.php';
		echo "". $customHTML;		 
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$title =  ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : esc_html__( 'Search By:', 'adforest' );
		
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?> <small><?php echo esc_html__( 'You can leave it empty as well', 'adforest' ); ?></small>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			<p><?php echo esc_html__( 'You can show/hide the specific type from categories custom fields where you created it.', 'adforest' ); ?> </p>
		</p>
		
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} /*Custom Search*/
}




if ( !function_exists ( 'adforest_getTemplateID' ) ) {
function adforest_getTemplateID($type = 'dynamic', $is_show = '')
{

	if(isset($_GET['cat_id']) && $_GET['cat_id'] != "" && is_numeric($_GET['cat_id']))
	{
		
		$term_id = $_GET['cat_id'];
		$result = adforest_dynamic_templateID($term_id);
		$templateID = get_term_meta( $result , '_sb_dynamic_form_fields' , true);	
	
		if(isset($templateID) && $templateID != "")
		{
			
			if($type != 'dynamic')
			{
				$formData = sb_custom_form_data($templateID, $is_show);	
			}
			else
			{
				$formData = sb_dynamic_form_data($templateID);					
			}			
			return $formData;
		}
		else
		{
			return 1;
		}
	}
	else
	{
		return 1;	
	}
}
}

// Ad Categories widget
add_action( 'widgets_init', function(){
     register_widget( 'adforest_ad_locations' );
});
if (! class_exists ( 'adforest_ad_locations' )) {
class adforest_ad_locations extends WP_Widget {
 /**
  * Register widget with WordPress.
  */
 function __construct() {
  $widget_ops = array( 
   'classname' => 'adforest_ad_locations',
   'description' => __('Only for search', 'adforest'),
  );
  // Instantiate the parent object
  parent::__construct( false, __('Country Location', 'adforest' ), $widget_ops );
 }
 /**
  * Front-end display of widget.
  *
  * @see WP_Widget::widget()
  *
  * @param array $args     Widget arguments.
  * @param array $instance Saved values from database.
  */
 public function widget( $args, $instance ) {
  
  $new = '';
  $used = '';
  $expand = "";
  if( isset( $_GET['country_id'] ) && $_GET['country_id'] != "" )
  {
   $expand = "in";
  }
  global $adforest_theme;
  $widget_layout = adforest_search_layout();
  require trailingslashit( get_template_directory () ) . 'template-parts/layouts/widgets/' . $widget_layout . '/countries.php';
 }
 /**
  * Back-end widget form.
  *
  * @see WP_Widget::form()
  *
  * @param array $instance Previously saved values from database.
  */
 public function form( $instance ) {
  if ( isset( $instance[ 'title' ] ) )
  {
   $title = $instance[ 'title' ];
  }
  else 
  {
   $title = esc_html__( 'Country Location', 'adforest' );
  }

  ?>
  <p>
   <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?>
            </label> 
   <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
  </p>
  <?php 
 }
 /**
  * Sanitize widget form values as they are saved.
  *
  * @see WP_Widget::update()
  *
  * @param array $new_instance Values just sent to be saved.
  * @param array $old_instance Previously saved values from database.
  *
  * @return array Updated safe values to be saved.
  */
 public function update( $new_instance, $old_instance )
 {
  $instance = array();
  $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
  return $instance;
 }
} // Location widget
}