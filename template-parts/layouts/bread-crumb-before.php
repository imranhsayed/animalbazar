<?php global $adforest_theme; ?>
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