<div class="col-md-4 col-xs-12 col-sm-6 for_mobile_res">
    <form method="get" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>">
      <div class="form-group">
      <label><?php echo esc_html( $instance['title'] ); ?> </label>
      <span id="price-min"></span>
                 - 
                <span id="price-max"></span>
                </span>
                <div id="price-slider"></div>
                
                <div class="input-group margin-top-10">
                
                <input type="text" class="form-control price_slider_padding" size="10" name="min_price" id="min_selected" value="<?php echo esc_attr( $min_price ); ?>" />
                <span class="input-group-addon">-</span>
                <input type="text" class="form-control price_slider_padding" size="10" name="max_price" id="max_selected" value="<?php echo esc_attr( $max_price ); ?>" />
                 <span class="input-group-addon">
                <select class="remove_select2" name="c">
                <option value=""><?php echo __('currency', 'adforest' ); ?></option>
                <option value=""><?php echo __('all', 'adforest' ); ?></option>
                	    <?php
        $conditions	=	adforest_get_cats('ad_currency' , 0 );
        foreach( $conditions as $con )
        {
    ?>
            <option value="<?php echo esc_attr( $con->name); ?>" <?php if( $currency == $con->name ) {  echo esc_attr("selected"); } ?>>
                <?php echo esc_html($con->name); ?>
            </option>
    <?php
        }
    ?>

                </select>
                </span>
                <span class="input-group-addon fa_cursor"><i class="fa fa-search"></i></span>
          <input type="hidden" id="min_price" value="<?php echo esc_attr( $instance['min_price'] ); ?>" />
          <input type="hidden" id="max_price" value="<?php echo esc_attr( $instance['max_price'] ); ?>" />
          
          
          
                
      </div>
      </div>
	<?php echo adforest_search_params( 'min_price', 'max_price', 'c' ); ?>
    </form>
    <?php 
		adforest_widget_counter();
	?>
</div>
<?php adforest_advance_search_container(); ?>