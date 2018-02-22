<?php adforest_advance_search_map_container_open(); ?>
<div class="col-md-4 col-xs-12 col-sm-4">
    <form method="get" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>">
      <div class="form-group">
      <label><?php echo esc_html( $instance['title'] ); ?></label>
         <select class="category form-control submit_on_select" name="ad_type">
         <option label=""></option>
    <?php
        $conditions	=	adforest_get_cats('ad_type' , 0 );
        foreach( $conditions as $con )
        {
    ?>
            <option value="<?php echo esc_attr( $con->name); ?>" <?php if( $cur_type == $con->name ) {  echo esc_attr("selected"); } ?>>
                <?php echo esc_html($con->name); ?>
            </option>
    <?php
        }
    ?>
         </select>
      </div>
	<?php
        echo adforest_search_params( 'ad_type' );
    ?>
    </form>
    <?php 
		adforest_widget_counter();
	?>
</div>
<?php 
adforest_advance_search_map_container_close(); 
adforest_advance_search_container();

?>