<?php global $adforest_theme; ?>
 <footer class="minimal-footer text-center <?php echo esc_attr( $adforest_theme['footer_4_bg'] ); ?>">
	 <?php echo '<a href="' . get_page_link( 31 ) . '" class="footer-about-us-link">About Us</a>'?>
    <div class="container">
	    <!-- About Us Page Link for Footer -->
       <ul class="footer-social text-center">
            <?php
                 foreach( $adforest_theme['social_media']  as $index => $val)
                 {
            ?>
            <?php
                     if($val != "")
                     {
			?>
            			<li>
                        <a href="<?php echo esc_url($val); ?>">
                        <span class="<?php echo adforest_social_icons( $index ); ?>"></span>
                        </a>
                        </li>
            <?php
                     }
                 }
			?>
       </ul>
       <p class="copy-rights">
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
       </p>
    </div>
 </footer>