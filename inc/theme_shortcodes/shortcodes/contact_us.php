<?php
/* ------------------------------------------------ */
/* Contact us */
/* ------------------------------------------------ */
if ( !function_exists ( 'contact_usshort' ) ) {
function contact_usshort()
{
	vc_map(array(
		"name" => __("Contact Us", 'adforest') ,
		"base" => "contact_usshort_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('contact-us.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),	
		array(
			"group" => __("Basic", "adforest"),
			"type" => "textfield",
			"holder" => "div",
			"heading" => __( "Contact Form Title", 'adforest' ),
			"param_name" => "s_title_1",
		),
		array(
			"group" => __("Basic", "adforest"),
			"type" => "textfield",
			"holder" => "div",
			"heading" => __( "Contact Info Title", 'adforest' ),
			"param_name" => "s_title_2",
		),
		array(
			"group" => __("Basic", "adforest"),
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Contact form 7 shortcode", 'adforest' ),
			"param_name" => "contact_short_code",
		),	
		array(
			"group" => __("Address", "'adforest"),
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Address", 'adforest' ),
			"param_name" => "address",
		),	
		array(
			"group" => __("Phone", "'adforest"),
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Phone", 'adforest' ),
			"param_name" => "phone",
		),	
		array(
			"group" => __("Email", "'adforest"),
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Email", 'adforest' ),
			"param_name" => "email",
		),	
			
			
		),
	));
}
}

add_action('vc_before_init', 'contact_usshort');
if ( !function_exists ( 'contact_usshort_base_func' ) ) {
function contact_usshort_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'contact_short_code' => '',
		's_title_1' => '',
		's_title_2' => '',
		'address' => '',
		'phone' => '',
		'email' => '',
	) , $atts));

	
	
	return '<section class="section-padding ">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 no-padding commentForm">
                     <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="">
                           <h2 >'.esc_html( $s_title_1).'</h2>
                           	'.do_shortcode(adforest_clean_shortcode($contact_short_code)).'
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="contactInfo">
                           <h2>'.esc_html( $s_title_2).'</h2>
                           <div class="singleContadds">
                              <i class="fa fa-map-marker"></i>
                              <p>
                                 '. $address.'
                              </p>
                           </div>
                           <div class="singleContadds phone">
                              <i class="fa fa-phone"></i>
                              <p>'.$phone.'
                              </p>
                           </div>
                           <div class="singleContadds">
                              <i class="fa fa-envelope"></i>
                              '.$email.'
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
	
	';
}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('contact_usshort_base', 'contact_usshort_base_func');
}