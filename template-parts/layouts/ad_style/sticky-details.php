<?php 	
$pid	=	get_the_ID();
global $adforest_theme;
?>
<div class="sticky-ad-detail">
 <div class="container">
    <div class="col-md-7 col-sm-12 col-xs-12 no-padding">
       <div class="">
          <h3><?php the_title(); ?></h3>
          <div class="short-history">
          <?php get_template_part( 'template-parts/layouts/ad_style/short', 'summary' ); ?>
          </div>
       </div>
    </div>
    <div class="col-md-5  col-sm-12 col-xs-12 no-padding">
    <?php if( get_post_meta($pid, '_adforest_ad_status_', true ) == 'active' )
	{
	?>
       <div class="pull-left row">
       <?php
	   $message_col	=	"col-md-6 col-sm-6 col-xs-12";
	   $ph_col	=	"col-md-6 col-sm-6 col-xs-12";
	   $ph_cls	=	'pull-left';
	   $msg_cls	=	'pull-left';
	   	if( $adforest_theme['communication_mode'] != 'both')
		{
		   $message_col	=	"col-md-12 col-sm-6 col-xs-12 pull-right";
		   $ph_col	=	"col-md-12 col-sm-6 col-xs-12 pull-right";
		   $ph_cls	=	'pull-right';
		   $msg_cls	=	'pull-right';
		}
	   
	   
	   	if( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'phone' )
		{
	   ?>
          <div class="<?php echo esc_attr( $ph_col ); ?>">
             <a href="javascript:void(0)" class="btn btn-block <?php echo esc_attr( $ph_cls ); ?> btn-phone number " data-last="<?php echo get_post_meta($pid, '_adforest_poster_contact', true ); ?>">
             <i class="fa fa-phone"></i> 
             <span><?php echo __('Click to View', 'adforest' ); ?></span>
             </a>
          </div>
      <?php
		}
		if( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )
		{
		?>
          <div class="<?php echo esc_attr( $message_col ); ?>">
                       <?php
					   if( get_current_user_id() == "" )
					   {
						?>
             <a href="<?php echo get_the_permalink( $adforest_theme['sb_sign_in_page'] ); ?>" class="btn btn-block <?php echo esc_attr( $msg_cls ); ?> btn-message"><i class="icon-envelope"></i> <?php echo __( 'Message Seller', 'adforest' ); ?></a>
                       <?php
					   }
					   else
					   {
						?>
             <a data-toggle="modal" data-target=".price-quote"  href="javascript:void(0)" class="btn btn-block <?php echo esc_attr( $msg_cls ); ?> btn-message"><i class="icon-envelope"></i> <?php echo __( 'Message Seller', 'adforest' ); ?></a>
                       <?php
					   }
					   ?>
          </div>
      <?php
		}
	   ?>
       </div>
   <?php
	}
	?>
    </div>
 </div>
</div>