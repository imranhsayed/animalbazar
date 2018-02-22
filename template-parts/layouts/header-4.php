<?php
global $adforest_theme;
?>
<div class="colored-header">
 <!-- Top Bar -->
 <div class="new-version">
 <!-- Top Bar End -->
 <!-- Navigation Menu -->
<nav id="menu-1" class="mega-menu">
       <!-- menu list items container -->
       <section class="menu-list-items">
          <div class="container-fluid">
                <div class="logo-area">
                   <!-- menu logo -->
                   <ul class="menu-logo">
                      <li>
                         <?php get_template_part( 'template-parts/layouts/site','logo' ); ?>
                      </li>
                   </ul>
                   
                </div>   
                   <!-- menu links -->
                   <?php get_template_part( 'template-parts/layouts/main','nav' ); ?>
<?php
$user_id	=	get_current_user_id();
?>
<ul class="menu-search-bar">
<?php
$user_id	=	get_current_user_id();
$user_info	=	get_userdata( $user_id );
if( isset( $adforest_theme['communication_mode'] ) && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' ) )
{
	if( is_user_logged_in() )
	{
?>
<li> 
<a href="<?php echo get_the_permalink( $adforest_theme['sb_notification_page'] ); ?>"><i class="icon-envelope"></i>
    <div class="notify">
	<?php
        global $wpdb;
        $unread_msgs = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->commentmeta WHERE comment_id = '$user_id' AND meta_value = '0' " );
        if( $unread_msgs > 0 )
        {
            $msg_count	=	$unread_msgs;
    ?>
    <span class="heartbit"></span><span class="point"></span>
    <?php
        }
    ?>
    </div>
  </a>
</li>
<?php
}
}
?>



                   <li class="nav-table dropdown hidden-sm-down">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <span class="nav-cell">
          <?php
		  if( is_user_logged_in() )
		  {
		 ?>
            <img class="img-circle" src="<?php echo adforest_get_user_dp($user_id); ?>" alt="<?php __('user prfile picture','adforest' ); ?>" width="32" height="32">
            
         <?php
		  }
		  ?>
          </span>
         
        </a>
        
<?php
if( is_user_logged_in() )
{
	global $wpdb;
	$unread_msgs = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->commentmeta WHERE comment_id = '$user_id' AND meta_value = '0' " );
?>
<ul class="dropdown-menu">
          <li>
            <a href="<?php echo get_the_permalink( $adforest_theme['sb_profile_page'] ); ?>">
              <i class="fa fa-user"></i> <?php echo __ ( "Profile", "adforest" ); ?></a>
          </li>
          <?php
		  if( isset( $adforest_theme['communication_mode'] ) && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' ) )
			{
			?>
          <li>
            <a href="<?php echo get_the_permalink( $adforest_theme['sb_notification_page'] ); ?>">
              <i class="fa fa-envelope"></i> <?php echo __('Messages', 'adforest' ); ?> <span class="badge"><?php echo esc_html($unread_msgs); ?></span></a> 
          </li>
          <?php
			}
			?>
          <li role="separator" class="divider"></li>
          <li>
            <a href="<?php echo wp_logout_url( get_the_permalink( $adforest_theme['sb_sign_in_page'] ) ); ?>">
              <i class="fa fa-power-off"></i> <?php echo __ ( "Logout", "adforest" ); ?></a>
          </li>
        </ul>
      </li>
<?php
}
else
{ 
		if( isset( $adforest_theme['sb_sign_in_page'] ) && $adforest_theme['sb_sign_in_page'] != "" )
		{
?> 
            <li>
              <a href="<?php echo get_the_permalink( $adforest_theme['sb_sign_in_page'] ); ?>">
              <?php echo get_the_title( $adforest_theme['sb_sign_in_page'] ); ?>
              </a>
            </li>
<?php
		}
		if( isset( $adforest_theme['sb_sign_up_page'] ) && $adforest_theme['sb_sign_up_page'] != "" )
		{
?>
            <li>
             <a href="<?php echo get_the_permalink( $adforest_theme['sb_sign_up_page'] ); ?>">
             <?php echo get_the_title( $adforest_theme['sb_sign_up_page'] ); ?>
             </a>
            </li>
<?php
		}
	}
?>
                       
                       <li>
                         <?php get_template_part( 'template-parts/layouts/ad','button' ); ?>
                      </li>
                      
                   </ul>
          </div>
       </section>
    </nav>            
 </div>   
</div>