<?php
/* ------------------------------------------------ */
/* Fun Facts */
/* ------------------------------------------------ */
if ( !function_exists ( 'fun_factsshort' ) ) {
function fun_factsshort()
{
	vc_map(array(
		"name" => __("Fun Facts", 'adforest') ,
		"base" => "fun_factsshort_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('fun_fact.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),	
		array(
			"group" => __("Basic", "adforest"),
			"type" => "attach_image",
			"holder" => "bg_img",
			"class" => "",
			"heading" => __( "Background Image", 'adforest' ),
			"param_name" => "bg_img",
			"description" => __("1280x800", 'adforest'),
		),
			array(
				"group" => __("Basic", "adforest"),
				"type" => "dropdown",
				"heading" => __("Column", 'adforest') ,
				"param_name" => "p_cols",
				"value" => array(
				__('Select Col ', 'adforest') => '',
				__('3 Col', 'adforest') => '4',
				__('4 Col', 'adforest') => '3'
				) ,
			),
		
		array
		(
			'group' => __( 'Fun Facts', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Fun Fact', 'adforest' ),
			'param_name' => 'fun_facts',
			'value' => '',
			'params' => array
			(
				array(
				 'group' => __( 'Fun Facts', 'adforest' ),
				 'type' => 'iconpicker',
				 'heading' => __( 'Icon', 'adforest' ),
				 'param_name' => 'icon',
				 'settings' => array(
				 'emptyIcon' => true,
				 'type' => 'classified',
				 'iconsPerPage' => 100, // default 100, how many icons per/page to display
				   ),
			  ),
				array(
					'group' => __( 'Fun Facts', 'adforest' ),
					"type" => "textfield",
					"holder" => "div",
					"heading" => __( "Numbers", 'adforest' ),
					"param_name" => "numbers",
				),	
				array(
					'group' => __( 'Fun Facts', 'adforest' ),
					"type" => "textfield",
					"holder" => "div",
					"heading" => __( "Title", 'adforest' ),
					"param_name" => "title",
				),	
				array(
					'group' => __( 'Fun Facts', 'adforest' ),
					"type" => "textfield",
					"holder" => "div",
					"heading" => __( "Color Title", 'adforest' ),
					"param_name" => "color_title",
				),	
			)
		),
			
			
		),
	));
}
}

add_action('vc_before_init', 'fun_factsshort');
if ( !function_exists ( 'fun_factsshort_base_func' ) ) {
function fun_factsshort_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'p_cols' => '3',
		'fun_facts' => '',
	) , $atts));

	$fun_html  = '';
	$rows = vc_param_group_parse_atts( $atts['fun_facts'] );
	if( count( $rows ) > 0 )
	{
		foreach($rows as $row )
		{
			if( isset( $row['numbers'] ) && isset( $row['title'] )  )
			{
				$color_html = '';
				if( isset( $row['color_title'] ) )
					$color_html = '<span>'.$row['color_title'].'</span>';
				
				$icon_html = '';	
				if( isset( $row['icon'] ) )
					$icon_html = '<div class="icons">
                        <i class="'.esc_attr( $row['icon'] ).'"></i>
                     </div>';
					
				$fun_html .= '<div class="col-lg-'.esc_attr($p_cols).' col-md-'.esc_attr($p_cols).' col-sm-6 col-xs-6">
						'.$icon_html.'
                     <div class="number"><span class="timer" data-from="0" data-to="'.$row['numbers'].'" data-speed="1500" data-refresh-interval="5">0</span></div>
                     <h4>'.$row['title'].' ' . $color_html . '</h4>
                  </div>';
			}
		}
	}

	
$style = '';
if( $bg_img != "" )
{
$bgImageURL	=	adforest_returnImgSrc( $bg_img );
$style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url('.$bgImageURL.') center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
}

	return '<div class="funfacts custom-padding parallex" '. $style .'>
            <div class="container">
               <div class="row">
			   		'.$fun_html.'
               </div>
            </div>
         </div>
			  ';
}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('fun_factsshort_base', 'fun_factsshort_base_func');
}