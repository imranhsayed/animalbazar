<?php 
 if ( post_password_required() ) return;
 if(  get_comments_number()  > 0 )
 {
 ?>
 <div class="grid-panel margin-top-30">
<div class="heading-panel">
  <div class="col-xs-12 col-md-12 col-sm-12">
	 <h3 class="main-title text-left">
	   <?php echo __( 'Comments', 'adforest' ); ?> (<?php echo ads_comments_counts(get_the_ID()); ?>)
	 </h3>
  </div>
</div>
    <ol class="comment-list">
		<?php wp_list_comments( array( 'callback' => 'adforest_comments_list', 'style' => 'ul' ) ); ?>    
	</ol>
</div>
<?php }  ?>
  <?php
  if ( ! comments_open() ){ }
  else
  {
  ?>
  <div class="clearfix"></div>
  <div class="grid-panel ">
     <div class="heading-panel">
		<div class="col-xs-12 col-md-12 col-sm-12">
        <h3  class="main-title text-left"><?php echo __( 'leave your comment', 'adforest' ); ?></h3>
        <hr>
     </div>
     </div>
    <div class="col-md-12 col-xs-12 col-sm-12" >
    <div class="commentform">
<?php

	$req = '*';
	$comment_args = array(
	'class_submit' => 'btn btn-theme',
	'title_reply' =>  esc_html__( '', 'adforest' ),
	'cancel_reply_link' =>  esc_html__( 'Cancel Reply', 'adforest' ),
	'fields' => apply_filters( 'comment_form_default_fields', array(
			/* Name Field Setting Goes Here*/
			'author' => '<div class="col-sm-4"><div class="form-group"><label for="author">'
				.esc_html__( 'Name', 'adforest' ).( $req ? '<span class="required">*</span>' : '' ).'</label>' . 
					'<input type="text" required placeholder="'.esc_html__( 'Your Good Name', 'adforest' ).'" id="author" class="form-control" name="author" size="30"/></div></div> <!-- End col-sm-6 -->', 

			/* Email Field Setting Goes Here*/
			'email' => '<div class="col-sm-4"><div class="form-group"><label for="email">'
				.esc_html__( 'Email', 'adforest' ).( $req ? '<span class="required">*</span>' : '' ).'</label>' . 
					'<input type="email" required placeholder="'.esc_html__( 'Your Email Please', 'adforest' ).'" id="email" class="form-control" name="email" size="30" /></div></div> <!-- End col-sm-6 -->', 

			/* URL Field Setting Goes Here */
			'url' => '<div class="col-sm-4"><div class="form-group"><label for="url">'
				.esc_html__( 'Website', 'adforest' ) . '</label>' . 
					'<input type="text" required placeholder="'.esc_html__( 'Your URL Please', 'adforest' ).'" id="url" class="form-control" name="url" size="30"' . "" . ' /></div></div> <!-- End col-sm-6 -->', 

	 ) ),

			/* Comment Textarea Setting Goes Here*/
			'comment_field' => '<div class="col-sm-12"><div class="form-group"><label for="url">'
				. esc_html__( 'Comments:', 'adforest' ) .( $req ? '<span class="required">*</span>' : '' ).'</label></div></div>' . 
				'<div class="col-sm-12"><div class="form-group"><textarea class="form-control" id="comment" name="comment" required cols="45" rows="7" aria-required="true" ></textarea></div></div> <!-- End col-sm-6 -->', 	


		'comment_notes_after' => '',

	);


comment_form($comment_args); 
                
                ?>
    </div></div></div>
 <?php  } ?>