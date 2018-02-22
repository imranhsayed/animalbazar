<?php
global $adforest_theme;
$right_col	=	'col-md-4 col-md-pull-8 col-sx-12';
if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
{
$right_col	=	'col-md-3 col-md-pull-9 col-sx-12';
}

?>
<div class="<?php echo esc_attr( $right_col); ?>">
 <!-- Sidebar Widgets -->
 <div class="sidebar">
    <!-- Panel group -->
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
       <?php dynamic_sidebar( 'adforest_search_sidebar' ); ?>
    </div>
    <!-- panel-group end -->
 </div>
 <!-- Sidebar Widgets End -->
</div>