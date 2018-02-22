<?php
global $adforest_theme; 
$pid	=	get_the_ID();
?>
 <div class="grid-panel margin-top-30">
<div class="heading-panel">
  <div class="col-xs-12 col-md-12 col-sm-12">
	 <h3 class="main-title text-left">
	   <?php echo __( 'Rating', 'adforest' ); ?>
	 </h3>
       <?php if(function_exists('the_ratings')) { the_ratings(); } ?>

  </div>
</div> 
</div>