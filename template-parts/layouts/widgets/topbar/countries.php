<div class="col-md-4 col-xs-12 col-sm-6">
   <form method="get" id="search_countries" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>">

      <div class="form-group">
      <label><?php echo esc_html( $instance['title'] ); ?></label>
      <?php
	  	$cur_cat_id	=	'';
		$main_cat	= '';
	  	if( isset( $_GET['country_id'] ) && $_GET['country_id'] != "" )
		{
			$main_cat	=	$_GET['country_id'];
		}
	  	if( isset( $_GET['ad_country'] ) && $_GET['ad_country'] != "" )
		{
			$main_cat	=	$_GET['ad_country'];
		}
	  ?>
         <select class="category form-control" id="ad_country" name="ad_country">
         <option label=""></option>
    <?php
		$ad_country	=	adforest_get_cats('ad_country' , 0 );
		foreach( $ad_country as $ad_catz )
		{
			$category = get_term($ad_catz->term_id);
			$count = $category->count;
    ?>
            <option value="<?php echo esc_attr( $ad_catz->term_id ); ?>" <?php if( $main_cat == $ad_catz->term_id ) {  echo esc_attr("selected"); } ?>>
                <?php echo esc_html($ad_catz->name); ?>(<?php echo $count; ?>)
            </option>
    <?php
        }
    ?>
         </select>
      </div>
	<?php
        echo adforest_search_params( 'country_id' );
    ?>
    <input type="hidden" name="country_id" id="country_id" value="" />

    </form>
    
    <?php 
		adforest_widget_counter();
	?>
</div>
<?php adforest_advance_search_container(); ?>