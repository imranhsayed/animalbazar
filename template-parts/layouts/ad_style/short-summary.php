<?php
	global $adforest_theme;
	$pid	=	get_the_ID();
	$post_categories = wp_get_object_terms( $pid,  array('ad_cats'), array('orderby' => 'term_group') );
?>
<ul>
     <li><b><?php echo get_the_date(); ?></b></li>
     <li><?php echo __('Category', 'adforest'); ?>: 
     <b>
     
     <?php
     
        foreach($post_categories as $c)
        {
            $cat = get_term( $c );
     ?>
     <a href="<?php echo get_term_link( $cat->term_id ); ?>"><?php echo esc_html( $cat->name ); ?> </a>
     <?php
     }
     ?>
     </b>
     </li>
     <li><?php echo __('Views', 'adforest'); ?>: <b><?php echo adforest_getPostViews($pid); ?></b></li>
     <?php
	 $my_url = adforest_get_current_url();
		if (strpos($my_url, 'adforest.scriptsbundle.com') !== false) {
			
		}
		else
		{
	 	if( get_post_field( 'post_author', $pid ) == get_current_user_id() || is_super_admin( get_current_user_id() ) )
		{
	 ?>
     <li><a href="<?php echo get_the_permalink( $adforest_theme['sb_post_ad_page'] ); ?>?id=<?php echo esc_attr( $pid );  ?>"><?php echo __('Edit', 'adforest'); ?></a></li>
     <?php
		}
		}
	?>
</ul>