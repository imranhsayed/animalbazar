<?php
 /* Template Name: Home */ 
/**
 * The template for displaying Pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Adforest
 */

?>
<?php get_header(); ?>
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
<section <?php post_class( 'faqs section-padding-80' ); ?>>
            <div class="container test">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="Heading-title black">
                                <h1><?php //the_title(); ?></h1>
                                
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <p><?php the_content(); ?></p>
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