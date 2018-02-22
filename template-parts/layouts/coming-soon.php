<?php 
get_header();
global $adforest_theme; ?>
<section class="comming-soon-grid">
         <div class="container">
            <div class="row">
               <div class="col-xs-12 comming-soon">
                  <div class="theme-logo">
                  <a href="<?php echo home_url( '/' ); ?>" >
            <?php 
            if( isset( $adforest_theme['sb_comming_soon_logo']['url'] ) && $adforest_theme['sb_comming_soon_logo']['url'] != "" )
            {
            ?>
               <img src="<?php echo esc_url( $adforest_theme['sb_comming_soon_logo']['url'] ); ?>" alt="<?php echo esc_attr__('Site Logo', 'adforest' ); ?>">
            <?php
            }
            else
            {
            ?>
                <img src="<?php echo esc_url( trailingslashit( get_template_directory_uri () ) ). 'images/logo.png' ?>"alt="<?php echo esc_attr__('Site Logo', 'adforest' ); ?>" />
            <?php
            }
            ?>
            </a>
            <input type="hidden" id="when_live" value="<?php echo esc_attr($adforest_theme['sb_comming_soon_date']); ?>" />
            <input type="hidden" id="get_time" value="<span>%w</span><?php echo __( 'weeks', 'adforest' ); ?><span>%d</span> <?php echo __( 'days', 'adforest' ); ?> <span>%H</span> <?php echo __( 'hr', 'adforest' ); ?><span>%M</span> <?php echo __( 'min', 'adforest' ); ?> <span>%S</span><?php echo __( 'sec', 'adforest' ); ?></span>" />
                     
                  </div>
                  <div class="count-down">
                     <div id="clock"></div>
                  </div>
                  <div class="subscribe">
                     <p><?php echo wp_kses( $adforest_theme['sb_comming_soon_title'], adforest_required_tags() ); ?>
                     
                     </p>
                     <?php 
					 
					 	if( isset( $adforest_theme['coming_soon_notify'] ) && $adforest_theme['coming_soon_notify'] )
						{
					 ?>
                     <form method="post">
                        <input type="text" name="sb_email" id="sb_email" placeholder="<?php echo __( 'Valid E-mail Address', 'adforest' ); ?>" autocomplete="off">
                        <button type="button" id="save_email">
                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                        <?php echo __( 'Notify Me', 'adforest' ); ?>
                        </button>
                        <button type="button" id="processing_req">
                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                        <?php echo __( 'Processing...', 'adforest' ); ?>
                        </button>
                        <input type="hidden" id="sb_action" value="coming_soon" />
                     </form>
                     <?php 
						}
					?>
                  </div>
                  <div class="social-area-share">
            <?php
                 foreach( $adforest_theme['social_media_soon']  as $index => $val)
                 {
            ?>
            <?php
                     if($val != "")
                     {
                        ?>
                        <a href="<?php echo esc_url($val); ?>" target="_blank">
                        <i class="<?php echo adforest_social_icons( $index ); ?>" aria-hidden="true"></i>
                        </a>
            <?php
                     }
                 }
			?>
                     
                  </div>
               </div>
            </div>
         </div>
      </section>
<?php wp_footer(); ?>
</body>
</html>