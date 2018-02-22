<?php global $adforest_theme; ?>
<?php 
if ( have_posts() )
{ 
	$cols	=	'';
	if( isset( $adforest_theme['blog_sidebar'] ) && $adforest_theme['blog_sidebar'] == 'no-sidebar' )
	{
		$cols	=	'col-md-4 col-sm-6 col-xs-12';	
	}
	else
	{
		$cols	=	'col-md-6 col-sm-6 col-xs-12';	
	}
    while ( have_posts() )
    { the_post();
?>
        <div class="<?php echo esc_attr( $cols ); ?>">
              <div class="blog-post">
                  <div <?php post_class(); ?>>
                    <?php
                        $no_img  =	'no-img';
                        $response	=	adforest_get_feature_image( get_the_ID(), 'adforest-category' );
                        if( $response[0] != "" )
                        {
                            $no_img  =	'';
                    ?>
                     <div class="post-img">
                        <a href="<?php the_permalink(); ?>">
                        <img class="img-responsive" src="<?php echo esc_url( $response[0] ); ?>" alt="<?php the_title(); ?>">
                        </a>
                     </div>
                     <?php
                        }
                    ?>
                     <div class="post-info <?php echo esc_attr( $no_img ); ?>">
                         <a href="javascript:void(0);"><?php echo adforest_get_date( get_the_ID() ); ?></a>
                         <a href="javascript:void(0);"><?php echo adforest_get_comments(); ?></a>
                     </div>
                     <h3 class="post-title">
                     <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                     </h3>
                     <?php if( get_the_excerpt() != "" )
                     {
                     ?>
                     <p class="post-excerpt">
                        <?php echo get_the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>">
                        <strong><?php echo __('Read More','adforest'); ?></strong>
                        </a>
                     </p>
                    <?php
                     }
                    ?>
                  </div>
            </div>
        </div>
<?php     
    }
}
else
{
    get_template_part( 'template-parts/content', 'none' );
}
?>