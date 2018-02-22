<?php global $adforest_theme; ?>
        <a href="<?php echo home_url( '/' ); ?>">
            <?php 
            if( isset( $adforest_theme['sb_site_logo']['url'] ) && $adforest_theme['sb_site_logo']['url'] != "" )
            {
				$logo_url	=	 $adforest_theme['sb_site_logo']['url'];
				if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && isset( $adforest_theme['sb_header'] ) &&  $adforest_theme['sb_header'] == 'transparent' && is_page_template( 'page-home.php' ) )
					$logo_url	=	 $adforest_theme['sb_site_logo_for_transparent']['url'];

            ?>
               <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr__('Site Logo', 'adforest' ); ?>">
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