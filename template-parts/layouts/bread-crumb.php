<?php global $adforest_theme; ?>
<?php
if(  isset( $_GET['type'] ) && ( $_GET['type'] == 'ads' || $_GET['type'] == 1 ) )
	return;

global $post;
if( basename( get_page_template() ) == "page-search.php"  && isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && isset( $adforest_theme['search_design'] ) && ( $adforest_theme['search_design'] == 'topbar' || $adforest_theme['search_design'] == 'map' ) )
 {
 }
 else
 {
	if( is_archive() || is_category() || is_tax() ||  is_author() || is_404() || ( isset( $adforest_theme['sb_profile_page'] ) && $adforest_theme['sb_profile_page'] != $post->ID) )
	{
		 if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && isset( $adforest_theme['Breadcrumb_type'] ) && $adforest_theme['Breadcrumb_type'] == 2 )
		 {
?>
	  <?php			 
		 }
		 else
		 {
?>
    <div class="page-header-area">
     <div class="container">
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="header-page">
                 <h1><?php echo adforest_bread_crumb_heading(); ?></h1>
              </div>
           </div>
        </div>
     </div>
    </div>
<?php
		 }
	}
 }
?>
<?php
	if( basename( get_page_template() ) == "page-search.php"  && isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && isset( $adforest_theme['search_design'] ) && ( $adforest_theme['search_design'] == 'topbar' || $adforest_theme['search_design'] == 'map' )  )
	 {
	 }
	 else if( isset( $adforest_theme['sb_profile_page'] ) && $adforest_theme['sb_profile_page'] != $post->ID )
	 {
		 if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && isset( $adforest_theme['Breadcrumb_type'] ) && $adforest_theme['Breadcrumb_type'] == 2 )
		 {
?>
<div class="bread-3 page-header-area ">
 <div class="container">
    <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="header-page">
             <h1><?php echo adforest_bread_crumb_heading(); ?></h1>
          </div>
       </div>
       <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <div class="small-breadcrumb modern-type">
                <div class=" breadcrumb-link">
                   <ul>
    <li>                       
         <a href="<?php echo home_url( '/' ); ?>">
            <?php echo esc_html__('Home', 'adforest' ); ?> 
        </a>
    </li>
    <li class="active">
        <a href="javascript:void(0);" class="active">
            <?php echo adforest_breadcrumb(); ?>
        </a>
    </li>
                   </ul>
                </div>
          </div>
       </div>
       
    </div>
 </div>
</div>
	  <?php			 
		 }
		 else
		 {
?>
<div class="small-breadcrumb">
 <div class="container">
    <div class=" breadcrumb-link">
       <ul>
            <li>                       
                 <a href="<?php echo home_url( '/' ); ?>">
                    <?php echo esc_html__('Home', 'adforest' ); ?> 
                </a>
            </li>
            <li class="active">
                <a href="javascript:void(0);" class="active">
					<?php echo adforest_breadcrumb(); ?>
                </a>
            </li>
       </ul>
    </div>
 </div>
</div>

<?php
		 }
	 }
?>