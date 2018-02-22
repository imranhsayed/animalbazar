<div class="col-md-4 col-xs-12 col-sm-6">
    <form method="get" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>">
      <div class="form-group">
      <label><?php echo esc_html( $instance['title'] ); echo $is_ad_type ?></label>
         <select class="category form-control submit_on_select" name="ad">
         <option label=""></option>
    <?php
		$conditions	=	array( 0 => __('Simple Ads','adforest'), '1' => __('Featured Ads','adforest') );
        foreach( $conditions as $key => $val )
        {
    ?>
            <option value="<?php echo esc_attr( $key); ?>" <?php if( $is_ad_type == $key ) {  echo esc_attr("selected"); } ?>>
                <?php echo esc_html($val); ?>
            </option>
    <?php
        }
    ?>
         </select>
      </div>
	<?php
        echo adforest_search_params( 'ad' );
    ?>
    </form>
    <?php 
		adforest_widget_counter();
	?>
</div>
<?php adforest_advance_search_container(); ?>