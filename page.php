<?php get_header(); ?>
<?php
$args = array(
	'taxonomy' => 'ad_cats',
	'orderby' => 'id',
	'hide_empty' => false,
	'parent' => 0,
);

/* Object containing categories like Cattle, buffalo etc */
$categories = get_terms( $args );


/* Object containing terms like petage, petcolor */
$terms = get_taxonomies();

?>
<?php global $adforest_theme; ?>
<?php if ( have_posts() )
{ 
	the_post();
	$post	=	get_post();

	
		if ( $post && ( preg_match( '/vc_row/', $post->post_content ) || preg_match( '/post_job/', $post->post_content ) ) )
		{
			the_content();
			
		}
		else
		{

?>
<section <?php post_class( 'static-page section-padding-70' ); ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                <div class="single-blog blog-detial">
                     <div class="blog-post">
                         <div class="post-excerpt post-desc">
                     		 <?php the_content(); ?>
                            <div class="col-md-12 add-pages margin-top-20">
							<?php
                            $args = array (
                                'before'            => '',
                                'after'             => '',
                                'link_before'       => '<span class="btn btn-default">',
                                'link_after'        => '</span>',
                                'next_or_number'    => 'number',
                                'separator'         => ' ',
                                'nextpagelink'      => esc_html__( 'Next >>', 'adforest' ),
                                'previouspagelink'  => esc_html__( '<< Prev', 'adforest' ),
								'highlight'   => 'iAmActive'
                               );
                                
                                wp_link_pages($args);  
                            ?>
                            </div>
                         
                         </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 co-xs-12 xol-sm-12">
        <?php comments_template('', true); ?> 
                        </div>    
                    </div>
            </div>
        </div>
    </div>
</section>
<?php
		}
}
?>
<!--footer section-->
<?php get_footer(); ?>
