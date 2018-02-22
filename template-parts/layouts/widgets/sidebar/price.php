<div class="panel panel-default">
          <!-- Heading -->
          <div class="panel-heading" role="tab" id="headingfour">
             <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                <i class="more-less glyphicon glyphicon-plus"></i>
                <?php echo esc_html( $instance['title'] ); ?>
                </a>
             </h4>
          </div>
          <!-- Content -->
     	<form method="get" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>">
          <div id="collapsefour" class="panel-collapse collapse <?php echo esc_attr( $expand ); ?>" role="tabpanel" aria-labelledby="headingfour">
             <div class="panel-body">
                <span class="price-slider-value"><?php echo __( 'Price', 'adforest' ); ?>
                 (<?php echo esc_html( $adforest_theme['sb_currency'] ); ?>) 
                <span id="price-min"></span>
                 - 
                <span id="price-max"></span>
                </span>
                <div id="price-slider"></div>
                <div class="input-group margin-top-10">
                <input type="text" class="form-control" name="min_price" id="min_selected" value="<?php echo esc_attr( $min_price ); ?>" />
                <span class="input-group-addon">-</span>
                <input type="text" class="form-control" name="max_price" id="max_selected" value="<?php echo esc_attr( $max_price ); ?>" />
                </div>
			<?php
			$btn_cls	=	'btn btn-theme btn-sm margin-top-20';
			if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design'] ) && $adforest_theme['search_design'] == 'sidebar' )
			{
				$btn_cls	=	'btn btn-theme btn-sm btn-block';
			?>
            <div class="form-group margin-top-10">
	<select name="c" >
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
    </div>
			<?php
			}
			?>
          <input type="hidden" id="min_price" value="<?php echo esc_attr( $instance['min_price'] ); ?>" />
          <input type="hidden" id="max_price" value="<?php echo esc_attr( $instance['max_price'] ); ?>" />
          <input type="submit" class="<?php echo esc_attr( $btn_cls ); ?>" value="<?php echo __( 'Search', 'adforest' ); ?>" />
          
                
             </div>
          </div>
          <?php
			if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design'] ) && $adforest_theme['search_design'] == 'sidebar' )
			{ 
			  echo adforest_search_params( 'min_price', 'max_price', 'c' );
			}
			else
			{
				echo adforest_search_params( 'min_price', 'max_price' );
			}
		  ?>
       </form>
       </div>