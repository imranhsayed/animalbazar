<div class="col-md-4 col-xs-12 col-sm-6">
<form method="get" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>">
    <div class="form-group">
    	<label><?php echo esc_html( $instance['title'] ); ?></label>
          <div class="input-group add-on">
      <input type="text" name="ad_title" value="<?php echo esc_attr( $title ); ?>" class="form-control" placeholder="<?php echo esc_html( $instance['title'] ); ?>"  /> 
      <div class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
      </div>
    </div>
         </div>
	<?php
        echo adforest_search_params( 'ad_title' );
    ?>
</form>
<?php 
		adforest_widget_counter();
?>
</div>
<?php adforest_advance_search_container(); ?>