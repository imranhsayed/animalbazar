<?php
global $adforest_theme;
$param	=	$_SERVER['QUERY_STRING'];
$search_params = array('cat_id', 'min_price' , 'ad_type', 'warranty', 'ad_title', 'location', 'condition', 'ad', 'country_id' );
$search_label = array('cat_id' => __('Category', 'adforest' ), 'min_price' => __('Price', 'adforest' ) , 'ad_type' => __('Ad Type', 'adforest' ), 'warranty' => __('Warranty', 'adforest' ), 'ad_title' => __('keyword', 'adforest' ), 'location' => __('Google Location', 'adforest' ), 'condition' => __('Condition', 'adforest' ), 'ad' => __('Class', 'adforest' ), 'country_id' => __('Location', 'adforest' ) );
if( isset( $param ) )
{
?>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 no-padding margin-bottom-10">
<?php
		parse_str($_SERVER['QUERY_STRING'], $vars);
		foreach( $vars as $key => $val )
		{
			if (!in_array( $key, $search_params ))
				continue;
		?>
        <div class="tag-search">
       <form method="get" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>">
            <span class="tag label label-info sb_tag">
            <span><?php echo $search_label[$key]; ?></span>
            <a href="javascript:void(0);" class="submit_on_select" >
            	<i class="remove glyphicon glyphicon-remove-sign glyphicon-white"></i>
            </a> 
            </span>
            <?php 
			if( $key == 'min_price' )
			{
				echo adforest_search_params( 'min_price', 'max_price', 'c' );
			}
			else
			{
				echo adforest_search_params( $key );
			}
			
			 ?>
		</form>
        </div>
        <?php	
			if( $key == 'cat_id' )
			{
				if(isset( $_GET['custom'] ) && count( $_GET['custom'] ) > 0 )
				{
					foreach( $_GET['custom'] as $k=>$v )
					{
		?>
        			<div class="tag-search">
                    <form method="get" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>">
                    <span class="tag label label-info sb_tag">
                    <span><?php echo $k; ?></span>
                    <a href="javascript:void(0);" class="submit_on_select"><i class="remove glyphicon glyphicon-remove-sign glyphicon-white"></i></a> 
                    </span>
                    <?php echo adforest_search_params( 'custom[' . $k . ']'  ); ?>
                    </form>
                    </div>
		<?php
						
					}
				}	
			}
				
			
?>
<?php
		}
?>
    </div>
   
<?php
}
?>