<?php adforest_advance_search_map_container_open(); ?>
<div class="col-md-4 col-xs-12 col-sm-4">
    <form method="get" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>" id="search_cats_w">
      <div class="form-group">
      <label><?php echo esc_html( $instance['title'] ); ?></label>
      <?php
	  	$cur_cat_id	=	'';
		$main_cat	= '';
	  	if( isset( $_GET['cat_id'] ) && $_GET['cat_id'] != "" )
		{
			$cur_cat_id	=	$_GET['cat_id'];
		}
	  	if( isset( $_GET['ad_cat'] ) && $_GET['ad_cat'] != "" )
		{
			$main_cat	=	$_GET['ad_cat'];
		}
	  ?>
         <select class="category form-control" id="ad_cats" name="ad_cat">
         <option label=""></option>
    <?php
		$ad_cats	=	adforest_get_cats('ad_cats' , 0 );
		foreach( $ad_cats as $ad_cat )
		{
			$category = get_term($ad_cat->term_id);
			$count = $category->count;
    ?>
            <option value="<?php echo esc_attr( $ad_cat->term_id ); ?>" <?php if( $main_cat == $ad_cat->term_id ) {  echo esc_attr("selected"); } ?>>
                <?php echo esc_html($ad_cat->name); ?>(<?php echo $count; ?>)
            </option>
    <?php
        }
    ?>
         </select>
      </div>
	<?php
        echo adforest_search_params( 'cat_id' );
    ?>
    <input type="hidden" name="cat_id" id="cat_id" value="" />

    </form>
    <?php 
		adforest_widget_counter();
	?>
</div>
<?php 
adforest_advance_search_map_container_close(); 
adforest_advance_search_container();
?>