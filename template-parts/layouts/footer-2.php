<?php global $adforest_theme; ?>
<?php
	$footer_class = '';
	if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && isset( $adforest_theme['footer_color'] ) && $adforest_theme['footer_color'] == 'new-demo' )
		$footer_class	= $adforest_theme['footer_color'];
		
?>
<footer>
    <!-- Footer Content -->
    <div class="footer-top <?php echo esc_attr( $footer_class ) ; ?>">
       <div class="container">
          <div class="row">
             <div class="col-md-3  col-sm-6 col-xs-12">
                <!-- Info Widget -->
                <div class="widget">
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
                   <p><?php echo esc_html( $adforest_theme['footer_text_under_logo'] ); ?></p>
                   <ul>
                   <?php
				   	if( isset( $adforest_theme['footer_android_app'] ) && $adforest_theme['footer_android_app'] != "" )
					{
						echo '<li><a href="'. esc_url( $adforest_theme['footer_android_app'] ) .'"><img src="' .  esc_url( trailingslashit( get_template_directory_uri () ) ) .'images/googleplay.png" alt="'.__ ( 'Android App', 'adforest' ).'"></a></li>';
					}
				   	if( isset( $adforest_theme['footer_ios_app'] ) && $adforest_theme['footer_ios_app'] != "" )
					{
						echo '<li><a href="'. esc_url( $adforest_theme['footer_ios_app'] ) .'"><img src="' .  esc_url( trailingslashit( get_template_directory_uri () ) ) .'images/appstore.png" alt="'.__ ( 'IOS App', 'adforest' ).'"></a></li>';
					}
				   ?>
                      
                   </ul>
                </div>
                <!-- Info Widget Exit -->
             </div>
             <div class="col-md-5  col-sm-12 col-xs-12">
                <!-- Newslatter -->
                <div class="widget widget-newsletter">
                   <h5><?php echo esc_html( $adforest_theme['section_3_title'] ); ?></h5>
                   <div class="fieldset">
                      <p><?php echo esc_html( $adforest_theme['section_3_text'] ); ?></p>
                     <?php 
					 
					 	if( isset( $adforest_theme['section_3_mc'] ) && $adforest_theme['section_3_mc'] )
						{
					 ?>
                      <form>
                         <input name="sb_email" id="sb_email" placeholder="<?php echo __ ( 'Enter your email address', 'adforest' ); ?>" type="text" autocomplete="off" required>
                         <input class="submit-btn" id="save_email" value="<?php echo __ ( 'Submit', 'adforest' ); ?>" type="button">
                         <input class="submit-btn no-display" id="processing_req" value="<?php echo __ ( 'Processing...', 'adforest' ); ?>" type="button">
                         <input type="hidden" id="sb_action" value="footer_action" />
                      </form>
                     <?php 
						}
					?>
                   </div>
                </div>
                <!-- Newslatter -->
             </div>
             <div class="col-md-2  col-sm-6 col-xs-12">
                <!-- Follow Us -->
                <div class="widget socail-icons">
                   <h5><?php echo esc_html( $adforest_theme['section_2_title'] ); ?></h5>
                   <ul>
                      
            <?php
                 foreach( $adforest_theme['social_media']  as $index => $val)
                 {
            ?>
            <?php
                     if($val != "")
                     {
			?>
            
                        <li>
                            <a class="<?php echo esc_attr(  $index ); ?>" href="<?php echo esc_url($val); ?>">
                                <i class="<?php echo adforest_social_icons( $index ); ?>"></i>
                            </a><span><?php echo esc_html(  $index ); ?></span>
                        </li>
            <?php
                     }
                 }
			?>
                   </ul>
                </div>
                <!-- Follow Us End -->
             </div>
              <div class="col-md-2  col-sm-6 col-xs-12">
              
                      <div class="widget my-quicklinks">
                        	<h5><?php echo esc_html( $adforest_theme['section_4_title'] ); ?></h5>
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
    <?php
		if( $footer_class != '' )
		{
	?>
    <div class="copyrights">
       <div class="container">
          <div class="copyright-content">
             <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
       </div>
    </div>
    <?php
		}
	?>
    </div>
    <!-- Copyrights -->
    <?php
		if( $footer_class == '' )
		{
	?>
    <div class="copyrights">
       <div class="container">
          <div class="copyright-content">
             <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
       </div>
    </div>
    <?php
		}
	?>
</footer>	