<?php global $adforest_theme; ?>
<?php
	$is_bg	=	'no-bg';
	if( isset( $adforest_theme['footer_options'] ) &&  $adforest_theme['footer_options'] == 'with_bg' )
	{
		$is_bg	= '';	
	}
?>
<footer class="footer-area <?php echo esc_attr( $is_bg ); ?>">
    <!--Footer Upper-->
    <div class="footer-content">
       <div class="container">
          <div class="row clearfix">
             <!--Two 4th column-->
             <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="row clearfix">
                   <div class="col-lg-7 col-sm-6 col-xs-12 column">
                      <div class="footer-widget about-widget">
                         <div class="logo">
                    <a href="<?php echo home_url( '/' ); ?>">
			<?php 
            if( isset( $adforest_theme['footer_logo']['url'] ) && $adforest_theme['footer_logo']['url'] != "" )
            {
            ?>
               <img src="<?php echo esc_url( $adforest_theme['footer_logo']['url'] ); ?>" class="img-responsive" alt="<?php echo esc_attr__('Site Logo', 'adforest' ); ?>">
            <?php
            }
            else
            {
            ?>
                <img src="<?php echo esc_url( trailingslashit( get_template_directory_uri () ) ). 'images/logo.png' ?>" class="img-responsive" alt="<?php echo esc_attr__('Site Logo', 'adforest' ); ?>" />
            <?php
            }
            ?>                    
                    
                    </a>
                         </div>
                         <div class="text">
                            <p></p>
                         </div>
                         <ul class="contact-info">
<?php 
	foreach( $adforest_theme['footer-contact-details']  as $ar => $val)
	{        
		if($ar == "Address" && $val != ""){echo '<li><i class="icon fa fa-home"></i> '. esc_html( $val ) .'</li>';}
		else if($ar == "Phone" && $val != ""){echo '<li><i class="icon fa fa-phone"></i> '. esc_html( $val ) .'</li>';}
		else if($ar == "Fax" && $val != ""){echo '<li><i class="icon fa fa-fax"></i> '. esc_html( $val ).'</li>';}
		else if($ar == "Email" && $val != ""){echo '<li><i class="icon fa fa-envelope-o"></i> '. esc_html( $val ) .'</li>';}
		else if($ar == "Timing" && $val != ""){echo '<li><i class="icon fa fa-clock-o"></i> '. esc_html( $val ) .'</li>';}
	} 
 ?>                        
                         </ul>
                         <div class="social-links-two clearfix"> 
            <?php
                 foreach( $adforest_theme['social_media']  as $index => $val)
                 {
            ?>
            <?php
                     if($val != "")
                     {
			?>
                        <a class="img-circle" href="<?php echo esc_url($val); ?>">
                        	<span class="<?php echo adforest_social_icons( $index ); ?>"></span>
                        </a>
            <?php
                     }
                 }
			?>
                           
                            </div>
                      </div>
                   </div>
                   <!--Footer Column-->
                   <div class="col-lg-5 col-sm-6 col-xs-12 column">
                      <div class="heading-panel">
                         <h3 class="main-title text-left"><?php echo esc_html( $adforest_theme['section_2_title'] ); ?></h3>
                      </div>
                      <div class="footer-widget links-widget">
                         <ul>
							<?php 
                            if( isset($adforest_theme['sb_footer_pages']) )
                            {
                                foreach ( $adforest_theme['sb_footer_pages'] as $foot_page)
                                {
                
                echo '<li><a href="' . esc_url( get_the_permalink( $foot_page ) ) . '">'. esc_html( get_the_title($foot_page) ) . '</a></li>'; 
                                }
                              
                            }
                            ?>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
             <!--Two 4th column End-->
             <!--Two 4th column-->
             <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="row clearfix">
                   <!--Footer Column-->
                   <div class="col-lg-7 col-sm-6 col-xs-12 column">
                      <div class="footer-widget news-widget">
                         <div class="heading-panel">
                            <h3 class="main-title text-left"><?php echo esc_html( $adforest_theme['section_3_title'] ); ?></h3>
                         </div>
			<?php
				$params =  array( 
					'orderby' => 'date',
					'post_type' => 'post',
					'posts_per_page' => $adforest_theme[ 'footer_post_numbers' ],
					'meta_query' => array(array( 'key' => '_thumbnail_id','compare' => 'EXISTS'))
				);					
					
				$foot_posts	=	get_posts( $params );
				if( count( $foot_posts ) > 0 )
				{
				foreach( $foot_posts as $post_f )
				{
					$response	=	adforest_get_feature_image( $post_f->ID, 'adforest-single-small' );
				?>
                         <!--News Post-->
                         <div class="news-post">
                            <div class="icon"></div>
                            <div class="news-content">
                            <?php 
							if( $response[0] != "" )
							{
							?>
                               <figure class="image-thumb">
                               <img src="<?php echo esc_url( $response[0] ); ?>" alt="<?php echo esc_attr( get_the_title( $post_f->ID ) ); ?>">
                               </figure>
                           <?php
							}
							?>
                               <a href="<?php  echo esc_url( get_the_permalink( $post_f->ID ) ); ?>">
							   		<?php echo  get_the_title( $post_f->ID ); ?>
                               </a>
                            </div>
                            <div class="time"><?php echo get_the_date( get_option( 'date_format' ), $post_f->ID );  ?></div>
                         </div>
                <?php
				}
				?>
                <?php
				}
				?>
                      </div>
                   </div>
                   <!--Footer Column-->
                   <div class="col-lg-5 col-sm-6 col-xs-12 column">
                      <div class="footer-widget links-widget">
                         <div class="heading-panel">
                            <h3 class="main-title text-left"><?php echo esc_html( $adforest_theme['section_4_title'] ); ?></h3>
                         </div>
                         <ul>
							<?php 
                            if( isset($adforest_theme['sb_footer_links']) )
                            {
                                foreach ( $adforest_theme['sb_footer_links'] as $foot_page)
                                {
                
                echo '<li><a href="' . esc_url( get_the_permalink( $foot_page ) ) . '">'. esc_html( get_the_title($foot_page) ) . '</a></li>'; 
                                }
                              
                            }
                            ?>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
             <!--Two 4th column End-->
          </div>
       </div>
    </div>
    <!--Footer Bottom-->
    <div class="footer-copyright">
       <div class="container clearfix">
          <!--Copyright-->
          <div class="copyright text-center">
		<?php
            if( isset( $adforest_theme['sb_footer'] ) && $adforest_theme['sb_footer'] != "" )
            {
                echo wp_kses( $adforest_theme['sb_footer'], adforest_required_tags() );
            }
            else
            {
                echo wp_kses( "Copyright 2017 &copy; Theme Created By <a href='https://themeforest.net/user/scriptsbundle/portfolio'>ScriptsBundle</a> All Rights Reserved.", adforest_required_tags() );
            }
        ?>
          </div>
       </div>
    </div>
</footer>	