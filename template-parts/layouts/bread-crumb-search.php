<?php global $adforest_theme;
		 if( isset( $adforest_theme['Breadcrumb_type'] ) && $adforest_theme['Breadcrumb_type'] == 2 )
		 {
?>
<div class="bread-3 page-header-area ">
 <div class="container">
    <div class="row">
    <div class="col-lg-8 col-md-12 col-sm-5 col-xs-12">
          <div class="header-page">
             <h1><?php echo adforest_bread_crumb_heading(); ?></h1>
          </div>
       </div>
       <div class="col-md-4 col-xs-12 col-sm-7">
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
		 ?>