    <?php global $adforest_theme;
	if( isset( $adforest_theme['sb_android_app'] ) && $adforest_theme['sb_android_app'] )
	{
	?>
    <a id="quick-cart-pay" href="<?php echo esc_url($adforest_theme['sb_android_app_link'] ); ?>" class="wow tada animated animated" data-wow-delay="300ms" data-wow-iteration="infinite" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-delay: 300ms; animation-iteration-count: infinite; animation-name: tada;" target="_blank">
    <span>
            
    <img src="<?php echo $adforest_theme['sb_android_app_img']['url']; ?>" alt="<?php echo esc_attr($adforest_theme['sb_android_app_text']); ?>">
                 <h6><?php echo $adforest_theme['sb_android_app_text']; ?></h6>
    </span>
  </a>
  <?php
	}
function adforest_addApp_icon_function() {
	global $adforest_theme;
	if( isset( $adforest_theme['sb_android_app'] ) && $adforest_theme['sb_android_app'] )
	{
	?>
 <style>
    #quick-cart-pay {
        border-radius: 50%;
        top: 35%;
        cursor: pointer;
        display: block;
        position: fixed;
        <?php echo esc_html($adforest_theme['sb_android_app_direction']); ?>: 15px;
        text-decoration: none;
     z-index:99;
    
    }
    
    #quick-cart-pay > span {
    
        border-radius: 50%;
        color: #232323;
        display: block;
        height: 106px;
    
        position: relative;
        text-align: center;
        text-transform: uppercase;
        transition: all 0.3s ease-in-out 0s;
        width: 60px;
    }
    </style>    
    <?php
	}
}
add_action( 'wp_footer', 'adforest_addApp_icon_function', 100 );
?>
