<?php
global $adforest_theme; 
$pid	=	get_the_ID();
	$flip_it = 'text-left';
	if ( is_rtl() )
	{
		$flip_it = 'text-right';
	}
?>
   <!-- =-=-=-=-=-=-= Share Modal =-=-=-=-=-=-= -->
  <div class="modal fade sortable-images" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
        <div class="modal-content <?php echo esc_attr( $flip_it ); ?>">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&#10005;</span><span class="sr-only">Close</span></button>
              <h3 class="modal-title"><?php echo __('Re-arrange your ad photo(s).','adforest'); ?></h3>
           </div>
           <div class="modal-body <?php echo esc_attr( $flip_it ); ?>">
              <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                	<em><small><?php echo __('*First image will be main display image of this ad.','adforest'); ?></small></em>
                    <ul id="sortable">
                    <?php
					$media	=	 adforest_get_ad_images($pid);	
					$img_ids	=	'';
					if( count( $media ) > 0 )
					{
					foreach( $media as $m )
					{
						$mid	=	'';
						if ( isset( $m->ID ) )
							$mid	= 	$m->ID;
						else
							$mid	=	$m;
							
							
						$img  = wp_get_attachment_image_src($mid, 'adforest-single-small');
						if( $img[0] == "" )
							continue;
						
						$img_ids	=	$img_ids . $mid . ',';
						
						
					?>
                    <li class="ui-state-default">
                    <img alt="<?php echo get_the_title(); ?>" data-img-id="<?php echo $mid; ?>" draggable="false" src="<?php echo esc_attr( $img[0] ); ?>">
                    </li>
                    <?php
					}
					}
					$img_ids	= rtrim($img_ids,',');
					if( get_post_meta( $pid, '_sb_photo_arrangement_', true ) == "" )
						update_post_meta( $pid, '_sb_photo_arrangement_', $img_ids );
					?>
                    </ul>
                    <input type="hidden" id="post_img_ids" value="<?php echo esc_attr( $img_ids ); ?>" />
                    <input type="hidden" id="current_pid" value="<?php echo esc_attr( $pid ); ?>" />
                    <input type="hidden" id="re-arrange-msg" value="<?php echo __( 'Ad photos has been re-arranged.', 'adforest' ); ?>" />
                </div>
            </div>
           </div>
           <div class="modal-footer">
              <input type="button" class="btn btn-theme btn-block" value="<?php echo __('Re-arrange','adforest' ); ?>" id="sb_sort_images" />
           </div>
        </div>
     </div>
  </div>