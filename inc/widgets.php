<?php
add_action( 'widgets_init', function(){
     register_widget( 'SBThemeWidgets_recent_posts' );
});
if (! class_exists ( 'SBThemeWidgets_recent_posts' )) {
class SBThemeWidgets_recent_posts extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'ChimpPro Recent Posts' );
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
	
		
		global $post;
		if($instance['sb_no_of_posts'] == "" )
		{
			$instance['sb_no_of_posts']	=	5;	
		}
		$args = array( 'post_type' => 'post', 'posts_per_page' => $instance['sb_no_of_posts'], 'orderby' => 'date', 'order' => 'DESC');
		$recent_posts = get_posts( $args );
	?>
<div class="widget"> 
          <!--Recent Posts heading-->
          <div class="blog-heading">
            <h2><?php echo esc_html( $instance['title'] ); ?></h2>
          </div>
          <!--end Recent Posts--> 
          <!--recent section--> 
<?php
foreach ( $recent_posts as $recent_post )
{ 
	$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($recent_post->ID), 'sb-chaimppro-clients' );
	$src	=	$feat_image[0];
?>



<div class="recent-post-box">
	<?php 
	$class_title	= 'class=recent-title-2';
    if( $src != "" )
    {
		$class_title	= 'class=recent-title';
    ?>
    <div class="recent-img">
        <a href="<?php echo esc_url( get_the_permalink( $recent_post->ID ) ); ?>">
            <img src="<?php echo esc_url( $src ); ?>" width="100" height="75" alt="<?php echo esc_attr( get_the_title( $recent_post->ID ) ); ?>">
        </a>
    </div>
    <?php
    }
    ?>
    <div <?php echo esc_attr( $class_title ); ?>>
        <a href="<?php echo esc_url( get_the_permalink( $recent_post->ID ) ); ?>">
        <?php echo esc_html( get_the_title( $recent_post->ID ) ); ?>
        </a>
        <p>
        <span><i class="fa fa-calendar"></i></span>
		<?php echo get_the_date(get_option( 'date_format' ), $recent_post->ID );  ?>
        </p>
    </div>

</div>
<?php 
}
?>
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
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = esc_html__( 'Recent Posts', 'adforest' );
		}
		if ( isset( $instance[ 'sb_no_of_posts' ] ) ) {
			$sb_no_of_posts = $instance[ 'sb_no_of_posts' ];
		}
		else {
			$sb_no_of_posts = 5;
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'sb_no_of_posts' ) ); ?>">
			<?php esc_html__( 'How many posts to diplay:', 'adforest' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sb_no_of_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sb_no_of_posts' ) ); ?>" type="text" value="<?php echo esc_attr( $sb_no_of_posts ); ?>">
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
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['sb_no_of_posts'] = ( ! empty( $new_instance['sb_no_of_posts'] ) ) ? strip_tags( $new_instance['sb_no_of_posts'] ) : '';
		return $instance;
	}
} // Recent Posts
}


/* All Category Widget */

add_action( 'widgets_init', function(){
     register_widget( 'SBThemeWidgets_all_categories' );
});	
/**
 * Adds My_Widget widget.
 */
 if (! class_exists ( 'SBThemeWidgets_all_categories' )) {
class SBThemeWidgets_all_categories extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Rane WooCommerce Categories' );
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
		$param = array(
	'type'                     => 'product',
	'orderby'                  => 'count',
	'order'                    => 'DESC',
	'hide_empty'               => $instance['category_hide_empty'],
	'hierarchical'             => 0,
	'taxonomy'                 => 'product_cat',
	'parent'                   => 0

); 

$categories = get_categories( $param );
?>

<div class="widget">
    <div class="shop-categories">
        <h2><?php echo esc_html( $instance['category_widget_title'] ); ?></h2>
        <ul>
<?php 
	foreach ($categories as $category )
	{
?>


            <li> <span class="arrow"><i class="fa fa-angle-down"></i></span>
                <a href="<?php echo esc_url( get_term_link( $category->term_id ) ); ?>">
				<?php echo esc_html( $category->name ); ?>
                </a>
                <?php
				$sub_params = array(
					'hierarchical'             => 1,
					'show_option_none' => '',
					'parent'                   => $category->term_id,
					'taxonomy' => 'product_cat'
				); 
				global $wpdb;
				$sub_cats = $myrows = $wpdb->get_results( "SELECT * FROM $wpdb->term_taxonomy WHERE parent = $category->term_id " );
				if( count( $sub_cats ) > 0 )
				{
					echo '<ul class="children-pro">';
					foreach( $sub_cats as $sub_cat )
					{
						$term = get_term( $sub_cat->term_id, 'ad_cats' );
					?>
  
						<li>
                            <a href="<?php echo esc_url( get_term_link( $sub_cat->term_id ) ); ?>">
                                <?php echo esc_html( $term->name ); ?>
                                <span class="count"><?php echo esc_html( $sub_cat->count ); ?></span>
                            </a>
                        </li>
               <?php
					}
					echo '</ul>';
				}
			  ?>
            </li>
              
              
<?php
}
?>
        </ul>
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
		if ( isset( $instance[ 'category_widget_title' ] ) ) {
			$category_widget_title = $instance[ 'category_widget_title' ];
		}
		else {
			$category_widget_title = esc_html__( 'Categories', 'adforest' );
		}
		if ( isset( $instance[ 'category_hide_empty' ] ) ) {
			$category_hide_empty = $instance[ 'category_hide_empty' ];
		}
		else {
			$category_hide_empty = 1;
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category_widget_title' ) ); ?>"></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $category_widget_title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category_hide_empty' ) ); ?>">
			<?php echo esc_html__( 'Hide empty categories?', 'adforest' ); ?>
            </label> 
            
            <select id="<?php echo esc_attr( $this->get_field_id( 'category_hide_empty' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category_hide_empty' ) ); ?>">
            	<option value="0" <?php if(esc_attr( $category_hide_empty ) == '0' ) echo "selected"; ?>>No</option>
            	<option value="1" <?php if(esc_attr( $category_hide_empty ) == '1' ) echo "selected"; ?>>Yes</option>
            </select>
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
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['category_widget_title'] = ( ! empty( $new_instance['category_widget_title'] ) ) ? strip_tags( $new_instance['category_widget_title'] ) : '';
		$instance['category_hide_empty'] = ( ! empty( $new_instance['category_hide_empty'] ) ) ? strip_tags( $new_instance['category_hide_empty'] ) : '';
		return $instance;
	}
	
	
} 
 }