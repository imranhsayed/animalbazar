<?php global $adforest_theme; ?>
<footer class="minimal-footer-1">
            <div class="container">
               <div class="row">
                  <div class="col-sm-4">
                     <aside class="widget">
                        <h3 class="widget-title"><?php echo esc_html( $adforest_theme['section_2_title'] ); ?></h3>
                        <p><?php echo esc_html( $adforest_theme['footer_text_under_logo'] ); ?></p>
                     </aside>
                  </div>
                  <div class="col-sm-4">
                     <aside class="widget text-center">
            <a href="<?php echo home_url( '/' ); ?>">
			<?php 
            if( isset( $adforest_theme['footer_logo']['url'] ) && $adforest_theme['footer_logo']['url'] != "" )
            {
            ?>
               <img src="<?php echo esc_url( $adforest_theme['footer_logo']['url'] ); ?>"  alt="<?php echo esc_attr__('Site Logo', 'adforest' ); ?>">
            <?php
            }
            else
            {
            ?>
                <img src="<?php echo esc_url( trailingslashit( get_template_directory_uri () ) ). 'images/logo.png' ?>" alt="<?php echo esc_attr__('Site Logo', 'adforest' ); ?>" />
            <?php
            }
            ?> 
            </a>              

                        <div class="social-links">
            <?php
                 foreach( $adforest_theme['social_media']  as $index => $val)
                 {
            ?>
            <?php
                     if($val != "")
                     {
			?>
                        <a href="<?php echo esc_url($val); ?>">
                            <i class="<?php echo adforest_social_icons( $index ); ?>"></i>
                        </a>
            <?php
                     }
                 }
			?>
                        </div>
                     </aside>
                  </div>
                  <div class="col-sm-4">
                     <aside class="widget">
                        <h3 class="widget-title"><?php echo esc_html( $adforest_theme['section_3_title'] ); ?></h3>
                        <p><?php echo esc_html( $adforest_theme['section_3_text'] ); ?></p>
                        <form class="subscribe-form">
                           <input name="sb_email" id="sb_email" placeholder="<?php echo __ ( 'Enter your email address', 'adforest' ); ?>" type="text" autocomplete="off">
                           <button id="save_email" type="button"><i class="fa fa-envelope-o"></i></button>
                           <button id="processing_req" type="button"><i class="fa fa-spinner fa-spin"></i></button>
                           <input type="hidden" id="sb_action" value="footer_action" />
                        </form>
                     </aside>
                  </div>
               </div>
            </div>
            <div class="sub-footer">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="entry-footer">
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
         </footer>