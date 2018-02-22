/*
Template: AdForest | Largest Classifieds Portal
Author: ScriptsBundle
Version: 1.0
Designed and Development by: ScriptsBundle
*/
/*
====================================
[ CSS TABLE CONTENT ]
------------------------------------
    1.0 -  Page Preloader
	2.0 -  Counter FunFacts
    3.0 -  List Grid Style Switcher
	4.0 -  Sticky Ads
	5.0 -  Accordion Panels
    6.0 -  Accordion Style 2
	7.0 -  Jquery CheckBoxes
	8.0 -  Jquery Select Dropdowns
    9.0 -  Profile Image Upload
    10.0 - Masonry Grid System
	11.0 - Featured Carousel 1
    12.0 - Featured Carousel 2
	12.0 - Featured Carousel 3
	13.0 - Category Carousel
	14.0 - Background Image Rotator Carousel
	15.0 - Single Ad Slider Carousel
	16.0 - Single Page SLider With Thumb
	17.0 - Price Range Slider
	18.0 - Template MegaMenu
	19.0 - Back To Top
	20.0 - Tooltip
	21.0 - Quick Overview Modal
-------------------------------------
[ END JQUERY TABLE CONTENT ]
=====================================
*/
(function($) {
    "use strict";
	
	
	
	var adlocation_words = $("#word-count").text().length;
	if( adlocation_words < 35  )
	{
		$('.country-locations').addClass('single-line');
	}
	
	var adforest_ajax_url	=	$('#adforest_ajax_url').val();
	
	var ua = navigator.userAgent.toLowerCase();
if (ua.indexOf("safari/") !== -1 &&  // It says it's Safari
    ua.indexOf("windows") !== -1 &&  // It says it's on Windows
    ua.indexOf("chrom")   === -1     // It DOESN'T say it's Chrome/Chromium
    ) {
    $('.sb-top-bar_notification').show();
}

    /* ======= Preloader ======= */
    setTimeout(function() {
        $('body').addClass('loaded');
    }, 3000);

    /* ======= Counter FunFacts ======= */
    var timer = $('.timer');
    if (timer.length) {
        timer.appear(function() {
            timer.countTo();
        });
    }

    /* ======= List Grid Style Switcher ======= */
    $('#list').on("click", function(event) {
        event.preventDefault();
        $(this).addClass('active');
        $('#grid').removeClass('active');
        $('#products .item').addClass('list-group-items');
    });
    $('#grid').on("click", function(event) {
        event.preventDefault();
        $(this).addClass('active');
        $('#list').removeClass('active');
        $('#products .item').removeClass('list-group-items');
        $('#products .item').addClass('grid-group-item');
    });

    /* ======= Sticky Ads ======= */
    $('.leftbar-stick, .rightbar-stick').theiaStickySidebar({
        additionalMarginTop: 80
    });

    /* ======= Accordion Panels ======= */
    $('.accordion-title a').on('click', function(event) {
        event.preventDefault();
        if ($(this).parents('li').hasClass('open')) {
            $(this).parents('li').removeClass('open').find('.accordion-content').slideUp(400);
        } else {
            $(this).parents('.accordion').find('.accordion-content').not($(this).parents('li').find('.accordion-content')).slideUp(400);
            $(this).parents('.accordion').find('> li').not($(this).parents('li')).removeClass('open');
            $(this).parents('li').addClass('open').find('.accordion-content').slideDown(400);
        }
    });

    /* ======= Accordion Style 2 ======= */
    $('#accordion').on('shown.bs.collapse', function() {
        var offset = $('.panel.panel-default > .panel-collapse.in').offset();
        if (offset) {
            $('html,body').animate({
                scrollTop: $('.panel-title a').offset().top - 20
            }, 500);
        }
    });

    /* ======= Jquery CheckBoxes ======= */
    $('.skin-minimal .list li input').iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal',
        increaseArea: '20%' // optional
    });
	
   var get_sticky = $('#is_sticky_header').val();
   var is_sticky = false;
   if( get_sticky != "" && get_sticky == "1" )
   {
		var is_sticky = true;   
   }
	if( $('#is_rtl').val() != "" &&  $('#is_rtl').val() == "1" )
	{
		/* ======= Masonry Grid System ======= */
		$('.posts-masonry').imagesLoaded(function() {
			$('.posts-masonry').isotope({
				layoutMode: 'masonry',
				transitionDuration: '0.3s',
				isOriginLeft: false,
			});
		});

    /* ======= Template MegaMenu  ======= */
    $('#menu-1').megaMenu({
        // DESKTOP MODE SETTINGS
        logo_align: 'left', // align the logo left or right. options (left) or (right)
        links_align: 'left', // align the links left or right. options (left) or (right)
        socialBar_align: 'right', // align the socialBar left or right. options (left) or (right)
        searchBar_align: 'left', // align the search bar left or right. options (left) or (right)
        trigger: 'hover', // show drop down using click or hover. options (hover) or (click)
        effect: 'expand-top', // drop down effects. options (fade), (scale), (expand-top), (expand-bottom), (expand-left), (expand-right)
        effect_speed: 400, // drop down show speed in milliseconds
        sibling: true, // hide the others showing drop downs if this option true. this option works on if the trigger option is "click". options (true) or (false)
        outside_click_close: true, // hide the showing drop downs when user click outside the menu. this option works if the trigger option is "click". options (true) or (false)
        top_fixed: false, // fixed the menu top of the screen. options (true) or (false)
        sticky_header: is_sticky, // menu fixed on top when scroll down down. options (true) or (false)
        sticky_header_height: 0, // sticky header height top of the screen. activate sticky header when meet the height. option change the height in px value.
        menu_position: 'horizontal', // change the menu position. options (horizontal), (vertical-left) or (vertical-right)
        full_width: false, // make menu full width. options (true) or (false)
        // MOBILE MODE SETTINGS
        mobile_settings: {
            collapse: true, // collapse the menu on click. options (true) or (false)
            sibling: true, // hide the others showing drop downs when click on current drop down. options (true) or (false)
            scrollBar: true, // enable the scroll bar. options (true) or (false)
            scrollBar_height: 400, // scroll bar height in px value. this option works if the scrollBar option true.
            top_fixed: false, // fixed menu top of the screen. options (true) or (false)
            sticky_header: false, // menu fixed on top when scroll down down. options (true) or (false)
            sticky_header_height: 0 // sticky header height top of the screen. activate sticky header when meet the height. option change the height in px value.
        }
    });
		
		/* ======= Jquery Select Dropdowns ======= */
		$("select").select2({
			dir: "rtl",
			placeholder: $('#select_place_holder').val(),
			allowClear: true,
			width: '100%'
		});
		
		$('.remove_select2').select2('destroy');
		
    /* ======= Featured Carousel 1 ======= */
    $('.featured-slider').owlCarousel({
		rtl:true,
		dots: ($(".featured-slider .item").length > 1) ? false: false,
		loop:($(".featured-slider .item").length > 1) ? true: false,
        margin: -10,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: $('#slider_item').val(),
                nav: true,
                loop: false
            }
        }
    });

    /* ======= Featured Carousel 2 ======= */
    $('.featured-slider-1').owlCarousel({
		rtl:true,
		dots: ($(".featured-slider-1 .item").length > 1) ? false: false,
		loop:($(".featured-slider-1 .item").length > 1) ? true: false,
        margin: -10,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: $('#slider_item').val(),
                nav: true,
                loop: false
            }
        }
    });
	
    /* ======= Featured Carousel 2 ======= */
    $('.featured-slider-5').owlCarousel({
		rtl:true,
		dots: ($(".featured-slider-5 .item").length > 1) ? false: false,
		loop:($(".featured-slider-5 .item").length > 1) ? true: false,
        margin: -10,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: 3,
                nav: true,
                loop: false
            }
        }
    });

    /* ======= Featured  Carousel 3 ======= */
    $('.featured-slider-3').owlCarousel({
		rtl:true,
		dots: ($(".featured-slider-3 .item").length > 1) ? false: false,
		loop:($(".featured-slider-3 .item").length > 1) ? true: false,
        margin: 0,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 1,
                nav: true
            },
            1000: {
                items: 1,
                nav: true,
                loop: false
            }
        }
    });

    /* ======= Category Carousel ======= */
    $('.category-slider').owlCarousel({
        loop: true,
		rtl:true,
        dots: false,
        margin: 0,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: 4,
                nav: true,
                loop: false
            }
        }
    });

    /* ======= Background Image Rotator Carousel ======= */
    $('.background-rotator-slider').owlCarousel({
        loop: false,
		rtl:true,
        dots: false,
        margin: 0,
        autoplay: true,
        mouseDrag: true,
        touchDrag: true,
        autoplayTimeout: 5000,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        nav: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });
	
	/* ======= إعلان واحد Slider Carousel  ======= */
    $('.single-details').owlCarousel({
		dots: ($(".single-details .item").length > 1) ? false: false,
		loop:($(".single-details .item").length > 1) ? true: false,
		rtl:true,
        margin: 0,
        autoplay: false,
        mouseDrag: true,
        touchDrag: true,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });

    /*==========  Single Page SLider With Thumb ==========*/
    $('#carousels').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 110,
        itemMargin: 50,
		rtl: true,
        asNavFor: '.single-page-slider'
    });
    $('.single-page-slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: true,
		rtl: true,
        sync: "#carousel"
    });  
	}
	else
	{
		/* ======= Masonry Grid System ======= */
		$('.posts-masonry').imagesLoaded(function() {
			$('.posts-masonry').isotope({
				layoutMode: 'masonry',
				transitionDuration: '0.3s',
			});
		});
		/* ======= Template MegaMenu  ======= */
		$('#menu-1').megaMenu({
			// DESKTOP MODE SETTINGS
			logo_align: 'left', // align the logo left or right. options (left) or (right)
			links_align: 'left', // align the links left or right. options (left) or (right)
			socialBar_align: 'left', // align the socialBar left or right. options (left) or (right)
			searchBar_align: 'right', // align the search bar left or right. options (left) or (right)
			trigger: 'hover', // show drop down using click or hover. options (hover) or (click)
			effect: 'expand-top', // drop down effects. options (fade), (scale), (expand-top), (expand-bottom), (expand-left), (expand-right)
			effect_speed: 400, // drop down show speed in milliseconds
			sibling: true, // hide the others showing drop downs if this option true. this option works on if the trigger option is "click". options (true) or (false)
			outside_click_close: true, // hide the showing drop downs when user click outside the menu. this option works if the trigger option is "click". options (true) or (false)
			top_fixed: false, // fixed the menu top of the screen. options (true) or (false)
			sticky_header: is_sticky, // menu fixed on top when scroll down down. options (true) or (false)
			sticky_header_height: 0, // sticky header height top of the screen. activate sticky header when meet the height. option change the height in px value.
			menu_position: 'horizontal', // change the menu position. options (horizontal), (vertical-left) or (vertical-right)
			full_width: false, // make menu full width. options (true) or (false)
			// MOBILE MODE SETTINGS
			mobile_settings: {
				collapse: true, // collapse the menu on click. options (true) or (false)
				sibling: true, // hide the others showing drop downs when click on current drop down. options (true) or (false)
				scrollBar: true, // enable the scroll bar. options (true) or (false)
				scrollBar_height: 400, // scroll bar height in px value. this option works if the scrollBar option true.
				top_fixed: false, // fixed menu top of the screen. options (true) or (false)
				sticky_header: false, // menu fixed on top when scroll down down. options (true) or (false)
				sticky_header_height: 0 // sticky header height top of the screen. activate sticky header when meet the height. option change the height in px value.
			}
		});
		
		/* ======= Jquery Select Dropdowns ======= */
		$("select").select2({
			placeholder: $('#select_place_holder').val(),
			allowClear: true,
			width: '100%'
		});
		$('.remove_select2').select2('destroy');
		
    /* ======= Featured Carousel 1 ======= */
    $('.featured-slider').owlCarousel({
		dots: ($(".featured-slider .item").length > 1) ? false: false,
		loop:($(".featured-slider .item").length > 1) ? true: false,
        margin: -10,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: $('#slider_item').val(),
                nav: true,
                loop: false
            }
        }
    });

    /* ======= Featured Carousel 2 ======= */
    $('.featured-slider-1').owlCarousel({
		dots: ($(".featured-slider-1 .item").length > 1) ? false: false,
		loop:($(".featured-slider-1 .item").length > 1) ? true: false,
        margin: -10,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: $('#slider_item').val(),
                nav: true,
                loop: false
            }
        }
    });
	
    /* ======= Featured Carousel 2 ======= */
    $('.featured-slider-5').owlCarousel({
		dots: ($(".featured-slider-5 .item").length > 1) ? false: false,
		loop:($(".featured-slider-5 .item").length > 1) ? true: false,
        margin: -10,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: 3,
                nav: true,
                loop: false
            }
        }
    });

    /* ======= Featured  Carousel 3 ======= */
    $('.featured-slider-3').owlCarousel({
		dots: ($(".featured-slider-3 .item").length > 1) ? false: false,
		loop:($(".featured-slider-3 .item").length > 1) ? true: false,
        margin: 0,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 1,
                nav: true
            },
            1000: {
                items: 1,
                nav: true,
                loop: false
            }
        }
    });

    /* ======= Category Carousel ======= */
    $('.category-slider').owlCarousel({
        loop: true,
        dots: false,
        margin: 0,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: 4,
                nav: true,
                loop: false
            }
        }
    });

    /* ======= Background Image Rotator Carousel ======= */
    $('.background-rotator-slider').owlCarousel({
        loop: false,
        dots: false,
        margin: 0,
        autoplay: true,
        mouseDrag: true,
        touchDrag: true,
        autoplayTimeout: 5000,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        nav: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });
	
	/* ======= Single Ad Slider Carousel  ======= */
    $('.single-details').owlCarousel({
		dots: ($(".single-details .item").length > 1) ? false: false,
		loop:($(".single-details .item").length > 1) ? true: false,
        margin: 0,
        autoplay: false,
        mouseDrag: true,
        touchDrag: true,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });

    /*==========  Single Page SLider With Thumb ==========*/
    $('#carousels').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 110,
        itemMargin: 50,
        asNavFor: '.single-page-slider'
    });
    $('.single-page-slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: true,
        sync: "#carousel"
    });

	}

    /* ======= Profile Image Upload ======= */
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });
    $(document).on('fileselect', '.btn-file :file', function(event, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        if (input.length) {
            input.val(log);
        }
    });



	


   

    /*==========  Back To Top  ==========*/
    	var offset = 300,
        offset_opacity = 1200,
        //duration of the top scrolling animation (in ms)
        scroll_top_duration = 700,
        //grab the "back to top" link
        $back_to_top = $('.cd-top');
        var ad_post_btn = $('.sticky-post-button');
		//hide or show the "back to top" link
		$(window).scroll(function() {
			($(this).scrollTop() > offset) ? ad_post_btn.addClass('sticky-post-button-visible'): ad_post_btn.removeClass('sticky-post-button-visible').removeClass('sticky-post-button-fadeout');
			($(this).scrollTop() > offset) ? $back_to_top.addClass('cd-is-visible'): $back_to_top.removeClass('cd-is-visible cd-fade-out');
			if ($(this).scrollTop() > offset_opacity) {
				$back_to_top.addClass('cd-fade-out');
				ad_post_btn.addClass('sticky-post-button-fadeout');
				
				
			}
		});
    	//smooth scroll to top
		$back_to_top.on('click', function(event) {
	
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0,
			}, scroll_top_duration);
		});

	/*==========  Tooltip  ==========*/
    $('body').on('hover','[data-toggle="tooltip"]', function()
	{
		
		$('[data-toggle="tooltip"]').tooltip();
		$(this).trigger('hover');


	});

    /*==========  Quick Overview Modal  ==========*/
    $(".quick-view-modal").css("display", "block");
	

// Validating Registration process
if( $('#sb-sign-form').length > 0 )
{
	$('#sb_register_msg').hide();
	$('#sb_register_redirect').hide();
	  $('#sb-sign-form').parsley().on('field:validated', function() {
				var ok = $('.parsley-error').length === 0;
	  })
	  .on('form:submit', function() {
		  $('#sb_loading').show();
		// Ajax for Registration
			$('#sb_register_submit').hide();
			$('#sb_register_msg').show();
		  $.post(adforest_ajax_url,	{action : 'sb_register_user', sb_data:$( "form#sb-sign-form" ).serialize(), }).done( function(response) 
			{
				$('#sb_loading').hide();
				$('#sb_register_msg').hide();
				
				if( $.trim(response) == '1' )
				{
					$('#sb_register_redirect').show();
					window.location = $( '#profile_page').val();
				}
				else if( $.trim(response) == '2' )
				{
					$('.resend_email').show();
					toastr.success($('#verify_account_msg').val(), '', {timeOut: 3500,"closeButton": true, "positionClass": "toast-top-right"});
				}
				else
				{
					$('#sb_register_submit').show();
					toastr.error(response, '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
	
				}
			});
	
		return false;
	  });
}

/*Resend Email*/
$('#resend_email').on('click', function()
{
	var usr_email	= $('#sb_reg_email').val();
	$.post(adforest_ajax_url,	{action : 'sb_resend_email', usr_email:usr_email, }).done( function(response) 
	{
		toastr.success($('#verify_account_msg').val(), '', {timeOut: 3500,"closeButton": true, "positionClass": "toast-top-right"});
		$('.resend_email').hide();
		$('.contact_admin').show();
	});
});

if( $('#sb-login-form').length > 0 )
{
	// Login Process
	$('#sb_login_msg').hide();
	$('#sb_login_redirect').hide();
	
	  $('#sb-login-form').parsley().on('field:validated', function() {
				var ok = $('.parsley-error').length === 0;
	  })
	  .on('form:submit', function() {
		  $('#sb_loading').show();
		// Ajax for Registration
			$('#sb_login_submit').hide();
			$('#sb_login_msg').show();
		  $.post(adforest_ajax_url,	{action : 'sb_login_user', sb_data:$( "form#sb-login-form" ).serialize(), }).done( function(response) 
			{
				$('#sb_loading').hide();
				$('#sb_login_msg').hide();
				
				if( $.trim(response) == '1' )
				{
					$('#sb_login_redirect').show();
					window.location = $( '#profile_page').val();
				}
				else
				{
					$('#sb_login_submit').show();
					toastr.error(response, '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
	
				}
			});
	
		return false;
	  });
}

/*// Forgot Password*/
if( $('#sb-forgot-form').length > 0 )
{
	$('#sb_forgot_msg').hide();
	
	  $('#sb-forgot-form').parsley().on('field:validated', function() {
				var ok = $('.parsley-error').length === 0;
	  })
	  .on('form:submit', function() {
		// Ajax for Registration
			$('#sb_forgot_submit').hide();
			$('#sb_forgot_msg').show();
			$('#sb_loading').show();
		  $.post(adforest_ajax_url,	{action : 'sb_forgot_password', sb_data:$( "form#sb-forgot-form" ).serialize(), }).done( function(response) 
			{
				$('#sb_loading').hide();
				$('#sb_forgot_msg').hide();
				
				if( $.trim(response) == '1' )
				{
					$('#sb_forgot_submit').show();
					$('#sb_forgot_email').val('');
					toastr.success( $('#adforest_forgot_msg').val(), '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					$('#myModal').modal('hide');
				}
				else
				{
					$('#sb_forgot_submit').show();
					toastr.error(response, '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
	
				}
			});
	
		return false;
	  });
}

/*// Reset Password*/
if( $('#sb-reset-password-form').length > 0 )
{
	$('#sb_reset_password_modal').modal('show');
	$('#sb_reset_password_msg').hide();
	
	  $('#sb-reset-password-form').parsley().on('field:validated', function() {
				var ok = $('.parsley-error').length === 0;
	  })
	  .on('form:submit', function() {
		  if( $('#sb_new_password').val() != $('#sb_confirm_new_password').val() )
		  {
			  toastr.error($('#adforest_password_mismatch_msg').val(), '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
				return false;  
		  }
		// Ajax for Registration
			$('#sb_reset_password_submit').hide();
			$('#sb_reset_password_msg').show();
			$('#sb_loading').show();
		  $.post(adforest_ajax_url,	{action : 'sb_reset_password', sb_data:$( "form#sb-reset-password-form" ).serialize(), }).done( function(response) 
			{
				$('#sb_loading').hide();
				$('#sb_reset_password_msg').hide();
				
				var get_r	=	response.split( '|');
				if( $.trim(get_r[0]) == '1' )
				{
					toastr.success( get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					 $('#sb_reset_password_modal').modal('hide');
					 $('#sb_reset_password_submit').show();
					 window.location = $('#login_page').val();
				}
				else
				{
					$('#sb_reset_password_submit').show();
					toastr.error(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
	
				}

			});
	
		return false;
	  });
}

/*// Change Password*/
	  $(document).on('click', '#change_pwd',function() {
			$('#sb_loading').show();
		  $.post(adforest_ajax_url,	{action : 'sb_change_password', sb_data:$( "form#sb-change-password" ).serialize(), }).done( function(response) 
			{
				$('#sb_loading').hide();
				
				var get_r	=	response.split( '|');
				if( $.trim(get_r[0]) == '1' )
				{
					toastr.success( get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					 $('#myModal').modal('hide');
					 window.location = $('#login_page').val();
				}
				else
				{
					toastr.error(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
	
				}
			});
	
	  });

var is_load_required	=	0;
var  is_error = false;
/*// Add Post*/
if( $('#ad_post_form').length > 0 )
{
	$('#ad_cat_sub_div').hide();
	$('#ad_cat_sub_sub_div').hide();
	$('#ad_cat_sub_sub_sub_div').hide();
		
	$('#ad_country_sub_div').hide();
	$('#ad_country_sub_sub_div').hide();
	$('#ad_country_sub_sub_sub_div').hide();
	if( $('#is_update').val() != "" )
	{
		var level =		$('#is_level').val();
		if( level >= 2 )
		{
			$('#ad_cat_sub_div').show();	
		}
		if( level >= 3 )
		{
			$('#ad_cat_sub_sub_div').show();
		}
		if( level >= 4 )
		{
			$('#ad_cat_sub_sub_sub_div').show();
		}
		
		var country_level =  $('#country_level').val();
		if( country_level >= 2 )
		{
			$('#ad_country_sub_div').show();
		}
		if( country_level >= 3 )
		{
			$('#ad_country_sub_sub_div').show();
		}
		if( country_level >= 4 )
		{
			$('#ad_country_sub_sub_sub_div').show();
		}
	}
	
	
	
	  $('#ad_post_form').parsley().on('field:validated', function() {
	  }).on('form:error', function()
	  {
		  $('.ad_errors').show();
			$('.parsley-errors-list').show();
		})
	  .on( 'form:submit', function() {
		// Ad Post
			$('#sb_loading').show();

		  $.post( adforest_ajax_url, {
			  	action : 'sb_ad_posting',
				sb_data:$( "form#ad_post_form" ).serialize(),

				is_update:$('#is_update').val(), }).done( function(response) {
					console.log( 'add posted ok' );


				$('#sb_loading').hide();
				if( $.trim(response) == "0" ) {
					toastr.error($('#not_logged_in').val(), '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});

				} else if ( $.trim(response) == "1" ){
				 	toastr.error($('#ad_limit_msg').val(), '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					window.location	=	$('#sb_packages_page').val();

				} else if ( $.trim(response) == "img_req" ){
				 toastr.error($('#required_images').val(), '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
				} else {
					toastr.success($('#ad_updated').val(), '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					window.location	=	response;
				}
			});
	
			return false;
	  });
	  var adCatsEl = $('#ad_cat');
	  /* Level 1 */
	  adCatsEl.on('change', function()
	  {
	  	$('#sb_loading').show();
		  $.post(adforest_ajax_url,	{action : 'sb_get_sub_cat', cat_id:$( "#ad_cat" ).val(), }).done( function(response)
		  {
		  	$('#sb_loading').hide();
			  $( "#ad_cat_sub" ).val('');
			  $( "#ad_cat_sub_sub" ).val('');
			  $( "#ad_cat_sub_sub_sub" ).val('');
			  if( $.trim(response) != "" )
			  {
				  	$('#ad_cat_id').val( $( "#ad_cat" ).val() );
					$('#ad_cat_sub_div').show();
					$('#ad_cat_sub').html(response);
					$('#ad_cat_sub_sub_div').hide();
					$('#ad_cat_sub_sub_sub_div').hide();
			  }
			  else
			  {
					$('#ad_cat_sub_div').hide();  
					$('#ad_cat_sub_sub_div').hide();
					$('#ad_cat_sub_sub_sub_div').hide();
			  }
			  /*For Category Templates*/
			  getCustomTemplate(adforest_ajax_url, $( "#ad_cat" ).val(), $( "#is_update" ).val() );

		  });
	  });

		/**
		 * Ajax request for displaying pet specifications
		 */
		adCatsEl.on('change', function() {

			$.post(
				adforest_ajax_url,
				{
					action : 'sb_get_pet_spec',
					cat_id: $( '#ad_cat' ).val(),
				}).done( function(response)	{
				/* Append the html content received in response for sub category and pet specifications*/
				$( '.pet-specifications-container' ).remove();
				$( '.pet-specification-wrapper' ).append( response.data.content );
				removeMilkingCapcityField( $ );
			});
		});

		/**
		 * Show pet specifications on edit Add Post page.
		 */
		var allOptionCatElArray = $( '#ad_cat' ).find( 'option' );
		for ( var i = 0; i < allOptionCatElArray.length; i++  ) {
			var optionSelectedEl = allOptionCatElArray[ i ];
			if ( optionSelectedEl.hasAttribute( 'selected' ) ) {
				$.post(
					adforest_ajax_url,
					{
						action : 'sb_get_pet_spec',
						cat_id: $( "#ad_cat" ).val(),
						my_ad_id: $( '#is_update' ).val()
					}).done( function(response)	{
					/* Append the html content received in response for sub category and pet specifications*/
					$( '.pet-specifications-container' ).remove();
					$( '.pet-specification-wrapper' ).append( response );

					/**
					 * Auto clicks on Pet Pregnancy if female gender is selected.
					 */
					var femaleInputGenderEl = document.getElementById( 'anbz-female' );
					if ( document.getElementById( 'anbz-female' ).hasAttribute( 'checked' ) ) {
						console.log( 'yes' );
						$( '.adforest-pet-pregnant-text' ).removeClass( 'adforest-display' );
					}
					removeMilkingCapcityField( $ );
				});
				}
			}
	  
	  /* Level 2 */
	  $('#ad_cat_sub').on('change', function()
	  {
		  $('#sb_loading').show();
		  $.post(adforest_ajax_url,	{action : 'sb_get_sub_cat', cat_id:$( "#ad_cat_sub" ).val(), }).done( function(response)
		  {
			  $('#sb_loading').hide();
			  $( "#ad_cat_sub_sub" ).val('');
			  $( "#ad_cat_sub_sub_sub" ).val('');
			  if( $.trim(response) != "" )
			  {
				    $('#ad_cat_id').val( $( "#ad_cat_sub" ).val() );
					$('#ad_cat_sub_sub_div').show();
					$('#ad_cat_sub_sub').html(response);
					$('#ad_cat_sub_sub_sub_div').hide(); 
			  }
			  else
			  {
					$('#ad_cat_sub_sub_div').hide();
					$('#ad_cat_sub_sub_sub_div').hide();
			  }
			  getCustomTemplate(adforest_ajax_url, $( "#ad_cat_sub" ).val(), $( "#is_update" ).val() );
		  });
	  });
	  
	  /* Level 3 */
	  $('#ad_cat_sub_sub').on('change', function()
	  {
		  $('#sb_loading').show();
		  $.post(adforest_ajax_url,	{action : 'sb_get_sub_cat', cat_id:$( "#ad_cat_sub_sub" ).val(), }).done( function(response)
		  {
			  $('#sb_loading').hide();
			  $( "#ad_cat_sub_sub_sub" ).val('');
			  if( $.trim(response) != "" )
			  {
				  	$('#ad_cat_id').val( $( "#ad_cat_sub_sub" ).val() );
					$('#ad_cat_sub_sub_sub_div').show();
					$('#ad_cat_sub_sub_sub').html(response); 
			  }
			  else
			  {
					$('#ad_cat_sub_sub_sub_div').hide();
			  }
			  getCustomTemplate(adforest_ajax_url, $( "#ad_cat_sub_sub" ).val(), $( "#is_update" ).val() );
			  
		  });
	  });
	  
	  	  /* Level 4 */
	  $('#ad_cat_sub_sub_sub').on('change', function()
	  {
		 	$('#ad_cat_id').val( $( "#ad_cat_sub_sub_sub" ).val() );
			getCustomTemplate(adforest_ajax_url, $( "#ad_cat_sub_sub_sub" ).val(), $( "#is_update" ).val() );
	  });
	  
	/*  //Countries*/
   /*/ Level 1 /*/
   $('#ad_country').on('change', function()
   {
    $('#sb_loading').show();
    $.post(adforest_ajax_url, {action : 'sb_get_sub_states', country_id:$( "#ad_country" ).val(), }).done( function(response)
    {
     $('#sb_loading').hide();
     $( "#ad_country_states" ).val('');
     $( "#ad_cat_sub_sub" ).val('');
     $( "#ad_cat_sub_sub_sub" ).val('');
     if( $.trim(response) != "" )
     {
       $('#ad_country_id').val( $( "#ad_cat" ).val() );
     $('#ad_country_sub_div').show();
     $('#ad_country_states').html(response);
     $('#ad_cat_sub_sub_div').hide();
     $('#ad_country_sub_sub_sub_div').hide();
     $('#ad_country_sub_sub_div').hide();
     }
     else
     {
     $('#ad_country_sub_div').hide();
     $('#ad_cat_sub_sub_div').hide();
     $('#ad_country_sub_sub_div').hide();
     $('#ad_country_sub_sub_sub_div').hide();
       
     }
     
    });
   });
   
    /*/ Level 2 /*/
   $('#ad_country_states').on('change', function()
   {
    $('#sb_loading').show();
    $.post(adforest_ajax_url, {action : 'sb_get_sub_states', country_id:$( "#ad_country_states" ).val(), }).done( function(response)
    {
     $('#sb_loading').hide();
     $( "#ad_country_cities" ).val('');
     $( "#ad_country_towns" ).val('');
     if( $.trim(response) != "" )
     {
        $('#ad_country_id').val( $( "#ad_country_states" ).val() );
     $('#ad_country_sub_sub_div').show();
     $('#ad_country_cities').html(response);
     $('#ad_country_sub_sub_sub_div').hide(); 
     }
     else
     {
     $('#ad_country_sub_sub_div').hide();
     $('#ad_country_sub_sub_sub_div').hide();
     }
    });
   });
   
   /*/ Level 3 /*/
   $('#ad_country_cities').on('change', function()
   {
    $('#sb_loading').show();
    $.post(adforest_ajax_url, {action : 'sb_get_sub_states', country_id:$( "#ad_country_cities" ).val(), }).done( function(response)
    {
     $('#sb_loading').hide();
     $( "#ad_country_towns" ).val('');
     if( $.trim(response) != "" )
     {
       $('#ad_country_id').val( $( "#ad_country_cities" ).val() );
     $('#ad_country_sub_sub_sub_div').show();
     $('#ad_country_towns').html(response); 
     }
     else
     {
     $('#ad_country_sub_sub_sub_div').hide();
     }
    });
   });

}




// select profile tabs
$(document).on('click','.messages_actions', function()
{
	var sb_action 	=	$(this).attr( 'sb_action' );
	if( sb_action != "" )
	{
		//$('.dashboard-menu-container ul li').removeClass('active');
		//$(this).closest("li").addClass('active');
		$('#sb_loading').show();
		$.post(adforest_ajax_url,	{action : sb_action }).done( function(response) 
		{
			$('#sb_loading').hide();
			$('#adforest_res').html(response);
			$('[data-toggle="tooltip"]').tooltip();
			$('[data-toggle=confirmation]').confirmation({
	  rootSelector: '[data-toggle=confirmation]',
	  // other options
		});
	
			
		});
	}
});
$('.menu-name, .profile_tabs').on('click', function()
{
	var sb_action 	=	$(this).attr( 'sb_action' );
	if( sb_action != "" )
	{
		$('.dashboard-menu-container ul li').removeClass('active');
		$(this).closest("li").addClass('active');
		$('#sb_loading').show();
		$.post(adforest_ajax_url,	{action : sb_action }).done( function(response) 
		{

			
			$('#sb_loading').hide();
			$('#adforest_res').html(response);
			$('[data-toggle="tooltip"]').tooltip();
			if( $('#is_video_on').val() == 1 )
			{
			/*Video Popup*/
			$('a.play-video').YouTubePopUp();
			  //$('a.play-video').YouTubePopUp();
			}
			$('[data-toggle=confirmation]').confirmation({
	  rootSelector: '[data-toggle=confirmation]',
	  // other options
		});
	
			
		});
	}
});



// Update Profile
	  $(document).on('click', '#sb_user_profile_update', function() {
		  
		// Ajax for Update profile
			$('#sb_loading').show();
		  $.post(adforest_ajax_url,	{action : 'sb_update_profile', sb_data:$( "form#sb_update_profile" ).serialize(), }).done( function(response) 
			{
				$('#sb_loading').hide();
				
				if( $.trim(response) == '1' ) 
				{
					$('.sb_put_user_name').html( $('input[name=sb_user_name]').val() );
					$('.sb_put_user_address').html( $('input[name=sb_user_address]').val() );
					$('.sb_user_type').html( $('select[name=sb_user_type]').val() );
					toastr.success( $('#adforest_profile_msg').val(), '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					$('body,html').animate({
						scrollTop: 0,
					}, scroll_top_duration);
				}
				else
				{
					$('#sb_forgot_submit').show();
					toastr.error(response, '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
	
				}
			});
	
	  });
	  
	// Upload user profile picture 
	$('body').on('change', '.sb_files-data', function(e){
		
		var fd = new FormData();
        var files_data = $('.form-group .sb_files-data'); 
     
        $.each($(files_data), function(i, obj) {
            $.each(obj.files,function(j,file){
                fd.append('my_file_upload[' + j + ']', file);
            });
        });
        
        fd.append('action', 'upload_user_pic');
		$('#sb_loading').show();
        $.ajax({
            type: 'POST',
            url: adforest_ajax_url,
            data: fd,
            contentType: false,
            processData: false,
            success: function(res){
				$('#sb_loading').hide();
				var res_arr	=	res.split( "|" );
				if( $.trim(res_arr[0]) == "1" )
				{
    				$('#user_dp').attr( 'src',res_arr[1]);
					$('#img-upload').attr('src', res_arr[1]);
				}
				else
				{
					toastr.error(res_arr[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
				}
     
            }
        });
		
  
    });
	
	
	if( $('#is_sub_active'). val() == "1" )
	{
		/*images uplaod*/
	    sbDropzone_image();
		 
	}
		/*Make Post on blur of title field*/
		 $('#ad_title').on( 'blur', function()
		 {
			 if( $('#is_update').val() == "" )
			 {
				$.post(adforest_ajax_url,	{action : 'post_ad', title:$('#ad_title').val(), is_update:$('#is_update').val(), }).done( function(response)
				{

				});
			 }
				 
		 });
		 
		 // Location while ad posting
		 $('#sb_user_address').on('focus', function()
		 {
				 adforest_location();
		 });
		 
		if( $('#facebook_key').val() != "" && $('#google_key').val() != "" )
		{
			 // Hello JS
			 hello.init({
				facebook: $('#facebook_key').val(),
				google: $('#google_key').val(),
			}, {redirect_uri: $('#redirect_uri').val()});
		}
		else if( $('#facebook_key').val() != "" && $('#google_key').val() == "" )
		{
			 // Hello JS
			 hello.init({
				facebook: $('#facebook_key').val(),
			}, {redirect_uri: $('#redirect_uri').val()});
		}
		else if( $('#google_key').val() != "" && $('#facebook_key').val() == "" )
		{
			 // Hello JS
			 hello.init({
				google: $('#google_key').val(),
			}, {redirect_uri: $('#redirect_uri').val()});
		}
		
		
		// Hello JS Hander
		$('.form-grid a.btn-social').on('click', function()
		{
			hello.on('auth.login', function(auth) {
				$('#sb_loading').show();
				// Call user information, for the given network
				hello(auth.network).api('me').then(function(r) {
					if( $('#get_action').val() == 'login' || $('#get_action').val() == 'register' )
					{
						
						$.post(adforest_ajax_url,	{action : 'sb_social_login', email:r.email, key_code:$('#nonce').val() }).done( function(response)
					{
						
						var get_r	=	response.split( '|');
						if( $.trim(get_r[0]) == '1' )
						{
							$('#nonce').val(get_r[1]);
							if( $.trim(get_r[2]) == '1' )
							{
								toastr.success(get_r[3], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
								window.location = $( '#profile_page').val();
							}
							else
							{
								toastr.error(get_r[3], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
							}
							
						}
						
					});
	
					}
					else
					{
						$('#sb_reg_name').val(r.name);
						$('#sb_reg_email').val(r.email);
					}
					$('#sb_loading').hide();
				});
			});
		});
		
		 if( $('#is_sub_active'). val() == "1" )
		 {
			  /* Tags*/
			 adforest_inputTags();
		 }
		
		
		// Single Ad JS
					  /* ======= Show Number ======= */
               $('.number').click(function() {
               	$(this).find('span').text( $(this).data('last') );
               });
			   
			  $('#show_ph_num').click(function() {
               	$(this).text( $(this).data('ph-num') );
               });

			   
			 //caches a jQuery object containing the header element
			 var header = $(".sticky-ad-detail");
				$(window).scroll(function() {
				var scroll = $(window).scrollTop();
				 if (scroll >= 500) {
					header.addClass("show-sticky-ad-detail");
				 } else {
					header.removeClass("show-sticky-ad-detail");
				 }
			 });
			 
			          /* ======= Ad Location ======= */
		  if( $('#lat').length > 0 )
		  {
				var lat =	$('#lat').val();
				var lon =	$('#lon').val();
				var  map ="";
				var latlng = new google.maps.LatLng(lat, lon);
				var myOptions = {
                   zoom: 13,
                   center: latlng,
         		   scrollwheel: false,
                   mapTypeId: google.maps.MapTypeId.ROADMAP,
                   size: new google.maps.Size(480,240)
               }
               map = new google.maps.Map(document.getElementById("itemMap"), myOptions);
               var marker = new google.maps.Marker({
                   map: map,
                   position: latlng
               });
		  }
		  
		  // Report Ad
		  $('#sb_mark_it').on('click', function()
		  {
			  $('#sb_loading').show();
			  $.post(adforest_ajax_url,	{action : 'sb_report_ad', option:$('#report_option').val(), comments:$('#report_comments').val(), ad_id:$('#ad_id').val(), }).done( function(response)
				{
					$('#sb_loading').hide();
					var get_r	=	response.split( '|');
					if( $.trim(get_r[0]) == '1' )
					{
							toastr.success(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
							$('.report-quote').modal('hide');
					}
					else
					{
						toastr.error(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					}
						
				});
		  });
		  
		  // Add to favourites
		  $('#ad_to_fav,.save-ad').on('click', function()
		  {
			  $('#sb_loading').show();
			  $.post(adforest_ajax_url,	{action : 'sb_fav_ad', ad_id:$(this).attr('data-adid'), }).done( function(response)
				{
					$('#sb_loading').hide();
					var get_p	=	response.split( '|');
					if( $.trim(get_p[0]) == '1' )
					{
							toastr.success(get_p[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					}
					else
					{
						toastr.error(get_p[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					}
						
				});
		  });
		  
		 
// Delete  Ad
$('body').on('hover', '.remove_fav_ad', function(e)
{
	$(this).confirmation({
  rootSelector: '[data-toggle=confirmation]',
  // other options
	});
});
		  // Remove to favourites
		$('body').on('click', '.remove_fav_ad', function(e)
		{
				var id	=	$(this).attr('data-adid');
			 $.post(adforest_ajax_url,	{action : 'sb_fav_remove_ad', ad_id:$(this).attr('data-adid'), }).done( function(response)
						{
							var get_r	=	response.split( '|');
							if( $.trim(get_r[0]) == '1' )
							{
								$('body').find('#holder-' + id ).remove();
									toastr.success(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
							}
							else
							{
								toastr.error(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
							}
								
						});
		});
		  
		  // Send message to ad owner
if( $('#send_message_pop').length > 0 )
{
		  
$('#send_message_pop').parsley().on('field:validated', function() {
	  })
	  .on('form:submit', function() {
		  $('#sb_loading').show();	  
			  $.post(adforest_ajax_url,	{action : 'sb_send_message', sb_data:$( "form#send_message_pop" ).serialize(), }).done( function(response)
				{
					$('#sb_loading').hide();
					var get_r	=	response.split( '|');
					if( $.trim(get_r[0]) == '1' )
					{
							toastr.success(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
							$('#sb_forest_message').val('');
							$( ".close" ).trigger( "click" );
					}
					else
					{
						toastr.error(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					}
				});
			return false;
	  });
			  
}

$('body').on('click', '.user_list', function()
{
	$('#sb_loading').show();
	$('.message-history-active').removeClass('message-history-active');
	$(this).addClass('message-history-active');
	var second_user	=	$( this ).attr('second_user');
	var inbox	=	$( this ).attr('inbox');
	var prnt	=	'no';
	if( inbox == 'yes' )
	{
		prnt = 'yes';
	}
	var cid	=	$( this ).attr('cid');
	$('#'+second_user + '_' + cid).html('');
	$.post(adforest_ajax_url,	{action : 'sb_get_messages', ad_id:cid, user_id:second_user, receiver:second_user, inbox:prnt }).done( function(response)
	{
		$('#usr_id').val(second_user);
		$('#rece_id').val(second_user);
		$('#msg_receiver_id').val(second_user);
		$('#ad_post_id').val(cid)
		$('#sb_loading').hide();
		$('#messages').html(response);
	});
});

$('body').on('click', '#send_msg', function()
{
	$('#send_message').parsley().on('field:validated', function() {
	  })
	  .on('form:submit', function() {
		var inbox	=	$( '#send_msg' ).attr('inbox');
		var prnt	=	'no';
		if( inbox == 'yes' )
		{
		prnt = 'yes';
		}

		  $('#sb_loading').show();	  
			  $.post(adforest_ajax_url,	{action : 'sb_send_message', sb_data:$( "form#send_message" ).serialize(), }).done( function(response)
				{
					var get_r	=	response.split( '|');
					if( $.trim(get_r[0]) == '1' )
					{
							toastr.success(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
							$('#sb_forest_message').val('');
							$.post(adforest_ajax_url,	{action : 'sb_get_messages', ad_id:$( "#ad_post_id" ).val(), user_id:$('#usr_id').val(),inbox:prnt }).done( function(response)
							{
								$('#sb_loading').hide();
								$('#messages').html(response);
								$('.message-details .list-wraps').scrollTop(20000).perfectScrollbar('update');
							});
					}
					else
					{
						toastr.error(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					}
				});
			return false;
	  });
});

// Delete  Ad
$('body').on('hover', '.remove_ad', function(e)
{
	$(this).confirmation({
  rootSelector: '[data-toggle=confirmation]',
  // other options
	});
});
// Delete  Ad
$('body').on('click', '.remove_ad', function(e)
{
	
	$(this).confirmation({
  rootSelector: '[data-toggle=confirmation]',
  // other options
	});
	$('#sb_loading').show();
		var id	=	$(this).attr('data-adid');
	 $.post(adforest_ajax_url,	{action : 'sb_remove_ad', ad_id:$(this).attr('data-adid'), }).done( function(response)
				{
					$('#sb_loading').hide();
					var get_r	=	response.split( '|');
					if( $.trim(get_r[0]) == '1' )
					{
						$('body').find('#holder-' + id ).remove();
							toastr.success(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					}
					else
					{
						toastr.error(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					}
						
				});
});

// My ads pagination
$('body').on('click','.sb_page', function()
{
	$('#sb_loading').show();
	var this_action	=	'my_ads';
	if( $(this).attr('ad_type') == 'yes')
	{
		this_action	=	'my_fav_ads';
	}
	else if( $(this).attr('ad_type') == 'inactive')
	{
		this_action	=	'my_inactive_ads';
	}
	$.post(adforest_ajax_url,	{action : this_action, paged:$(this).attr('page_no'), }).done( function(response) 
	{
		$('#sb_loading').hide();
		$('#adforest_res').html(response); 
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 200,
		}, scroll_top_duration);
		if( $('#is_rtl').val() != "" &&  $('#is_rtl').val() == "1" )
		{
			$('.posts-masonry').imagesLoaded(function() {
			$('.posts-masonry').isotope({
			layoutMode: 'masonry',
			transitionDuration: '0.3s',
			isOriginLeft: false,
			});
			});
		}
		else
		{
			$('.posts-masonry').imagesLoaded(function() {
			$('.posts-masonry').isotope({
			layoutMode: 'masonry',
			transitionDuration: '0.3s',
			});
			});
		}
		
	});

});
// Load Messages
$('body').on('click','.get_msgs', function()
{
	$('#sb_loading').show();
	$.post(adforest_ajax_url,	{action : 'sb_load_messages', ad_id:$(this).attr('ad_msg'), }).done( function(response) 
	{
		$('#sb_loading').hide();
		$('#adforest_res').html(response); 
	});

});

var previous;

// My ads pagination
$('body').on('focus','.ad_status', function()
{
	previous = this.value;
}).on('change','.ad_status', function()
{
	if( $(this).val() != "" )
	{
		if( confirm( $('#confirm_update').val() ) )
		{
			$('#sb_loading').show();
			$.post(adforest_ajax_url,	{action : 'sb_update_ad_status', ad_id:$(this).attr('adid'), status:$(this).val(),  }).done( function(response) 
			{
				$('#sb_loading').hide();
					var get_r	=	response.split( '|');
					if( $.trim(get_r[0]) == '1' )
					{
							toastr.success(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
							previous = this.value;
							$('.menu-name[sb_action="my_ads"]').get(0).click();
					}
					else
					{
						toastr.error(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					}
			});
		}
		else
		{
			$(this).val(previous)
		}
	}

});

// Add to Cart
$('body').on('click','.sb_add_cart', function()
{
	$('#sb_loading').show();
	$.post(adforest_ajax_url,	{action : 'sb_add_cart', product_id:$(this).attr('data-product-id'),qty:$(this).attr('data-product-qty'), }).done( function(response) 
	{
		$('#sb_loading').hide();
				var get_r	=	response.split( '|');
				if($.trim( get_r[0]) == '1' )
				{
						toastr.success(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
						window.location	=	get_r[2];
				}
				else
				{
						toastr.error(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					window.location	=	get_r[2];
				}
	});

});
 if( $('#is_sub_active'). val() == "1" )
 {

$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
  	});
	
 }
	
		if( $('#ad_description').length > 0 )
		{
			

				$('#ad_description').jqte({
		link: false,
		unlink: false,
		formats:false,
		format:false,
		funit:false,
		fsize:false,
		fsizes:false,
		color:false,
		strike:false,
		source:false,
		sub:false,
		sup:false,
		indent:false,
		outdent:false,
		right:false,
		left:false,
		center:false,
		remove:false,
		rule:false,
		title:false,
			
	});

		}

$('#sb_feature_ad').on('click', function()
{
	$('#sb_loading').show();
	$.post(adforest_ajax_url,	{action : 'sb_make_featured', ad_id:$(this).attr('aaa_id'),}).done( function(response) 
	{
		$('#sb_loading').hide();
				var get_r	=	response.split( '|');
				if( $.trim(get_r[0]) == '1' )
				{
						toastr.success(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
						location.reload();
				}
				else
				{
						toastr.error(get_r[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
				}
	});

	
});

	$(document).on('click','.ad_title_show', function()
	{
		var cur_ad_id = $(this).attr('cid');
		$('.sb_ad_title').hide();
		$('#title_for_' + cur_ad_id).show();
		
	});
	
	if( $('#msg_notification_on').val() != "" && $('#msg_notification_on').val() != 0 && $('#msg_notification_time').val() != "" )
	{
		setInterval(function()
		{ 
				$.post(adforest_ajax_url,	{action : 'sb_check_messages', new_msgs: $('#is_unread_msgs').val(),}).done( function(response) 
	{
				var get_r	=	response.split( '|');
				if( $.trim(get_r[0]) == '1' )
				{
						toastr.success(get_r[1], '', {timeOut: 5000,"closeButton": true, "positionClass": "toast-bottom-left"});
						$('#is_unread_msgs').val(get_r[2]);
						$('.msgs_count').html(get_r[2]);
						$('.notify').html('<span class="heartbit"></span><span class="point"></span>');
						
						
						
						$.post(adforest_ajax_url,	{action : 'sb_get_notifications'}).done( function(notifications) 
	{
							$('.message-center').html(notifications);
						});
				}
	});

				
		}, $('#msg_notification_time').val() );
	}
function adforest_inputTags()
{
		 $('#tags').tagsInput({
			 'width':'100%',
			 'height' : '5px;',
			 'defaultText' : '',
		});	
}
function sbDropzone_image()
{

	     Dropzone.autoDiscover = false;
         var acceptedFileTypes = "image/*"; //dropzone requires this param be a comma separated list
         var fileList = new Array;
         var i = 0;
         $("#dropzone").dropzone({
				addRemoveLinks: true,
				paramName: "my_file_upload",
				maxFiles: $('#sb_upload_limit').val(), //change limit as per your requirements
				acceptedFiles: '.jpeg,.jpg,.png',
				dictMaxFilesExceeded: $('#adforest_max_upload_reach').val(),
				/*acceptedFiles: acceptedFileTypes,*/
				url: adforest_ajax_url + "?action=upload_ad_images&is_update=" + $('#is_update').val(),
				parallelUploads: 1,
				  dictDefaultMessage: $('#dictDefaultMessage').val(),
				  dictFallbackMessage: $('#dictFallbackMessage').val(),
				  dictFallbackText: $('#dictFallbackText').val(),
				  dictFileTooBig: $('#dictFileTooBig').val(),
				  dictInvalidFileType: $('#dictInvalidFileType').val(),
				  dictResponseError: $('#dictResponseError').val(),
				  dictCancelUpload: $('#dictCancelUpload').val(),
				  dictCancelUploadConfirmation: $('#dictCancelUploadConfirmation').val(),
				  dictRemoveFile: $('#dictRemoveFile').val(),
				  dictRemoveFileConfirmation: null,

				init: function () {
               
			   var thisDropzone = this;
			$.post(adforest_ajax_url,	{action : 'get_uploaded_ad_images', is_update:$('#is_update').val() }).done( function(data)
			{
				$.each(data, function(key,value){
                 
                var mockFile = { name: value.dispaly_name, size: value.size };
                 
                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
 
                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.name);
				 $('a.dz-remove:eq(' + i + ')').attr("data-dz-remove", value.id);
					   i++;
                 
            });
			if( i > 0 )
				$('.dz-message').hide();
			else
				$('.dz-message').show();
			});
			
			this.on("addedfile", function(file) { $('.dz-message').hide(); });
			   this.on("success", function(file, responseText) {
					var res_arr	=	responseText.split( "|" );
					if( $.trim(res_arr[0]) != "0" )
					{
					   $('a.dz-remove:eq(' + i + ')').attr("data-dz-remove", responseText);
					   i++;
					   $('.dz-message').hide();
					}
					else
					{
						if( i == 0 )
						$('.dz-message').show();
						this.removeFile(file);	
						toastr.error(res_arr[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					}

        		});
				this.on("removedfile", function(file) {
					
					var img_id	=	file._removeLink.attributes[2].value;
					if( img_id != "" )
					{
						i--;
						if( i == 0 )
							$('.dz-message').show();
						$.post(adforest_ajax_url,	{action : 'delete_ad_image', img:img_id, is_update:$('#is_update').val(), }).done( function(response)
						{
							if( $.trim(response) == "1" )
							{
								/*this.removeFile(file);*/
							}
						});
					}
    			});
				
				},

         });	

}

/*// Rate User */
if( $('#user_ratting_form').length > 0 )
{
	
	  $('#user_ratting_form').parsley().on('field:validated', function() {
				var ok = $('.parsley-error').length === 0;
	  })
	  .on('form:submit', function() {
		// Ajax for Registration
			$('#sb_loading').show();
		  $.post(adforest_ajax_url,	{action : 'sb_post_user_ratting', sb_data:$( "form#user_ratting_form" ).serialize(), }).done( function(response) 
			{
				$('#sb_loading').hide();
				
				var res_arr	=	response.split( "|" );
				if( $.trim(res_arr[0]) != "0" )
				{
					toastr.success( res_arr[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					location.reload();
				}
				else
				{
					toastr.error(res_arr[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
	
				}
			});
	
		return false;
	  });
}

/*// Replay to Rator */
if( $('#sb-reply-rating-form').length > 0 )
{
	
	  $('#sb-reply-rating-form').parsley().on('field:validated', function() {
				var ok = $('.parsley-error').length === 0;
	  })
	  .on('form:submit', function() {
		// Ajax for Registration
			$('#sb_loading').show();
		  $.post(adforest_ajax_url,	{action : 'sb_reply_user_rating', sb_data:$( "form#sb-reply-rating-form" ).serialize(), }).done( function(response) 
			{
				$('#sb_loading').hide();
				
				var res_arr	=	response.split( "|" );
				if( $.trim(res_arr[0]) != "0" )
				{
					toastr.success( res_arr[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					location.reload();
				}
				else
				{
					toastr.error(res_arr[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
	
				}
			});
	
		return false;
	  });
}

	$('.clikc_reply').on('click', function()
	{
		$('#rator_name').html( $(this).attr('data-rator-name') );
		$('#rator_reply').val( $(this).attr('data-rator-id') );
	});
	
	
	/* Bidding System  */ 
	/*// Replay to Rator */
if( $('#sb_bid_ad').length > 0 )
{
	
	  $('#sb_bid_ad').parsley().on('field:validated', function() {
				var ok = $('.parsley-error').length === 0;
	  })
	  .on('form:submit', function() {
		// Ajax for Registration
			$('#sb_loading').show();
		  $.post(adforest_ajax_url,	{action : 'sb_submit_bid', sb_data:$( "form#sb_bid_ad" ).serialize(), }).done( function(response) 
			{
				$('#sb_loading').hide();
				
				var res_arr	=	response.split( "|" );
				if( $.trim(res_arr[0]) != "0" )
				{
					toastr.success( res_arr[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
					location.reload();
				}
				else
				{
					toastr.error(res_arr[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
	
				}
			});
	
		return false;
	  });
}
	
	var $scrollbar = $('.bidding');
            $scrollbar.perfectScrollbar({
                maxScrollbarLength: 150,
            });
            $scrollbar.perfectScrollbar('update');
			
$('form.custom-search-form select').on("select2:select", function(e) { 
 $('#sb_loading').show();
 $(this).closest("form").submit(); 
 /*$('#sb_loading').hide();*/
 
 

});

function getCustomTemplate(ajax_url, catId, updateId)
{

		/*For Category Templates*/
		$.post(ajax_url,	{action : 'sb_get_sub_template', 'cat_id':catId,'is_update': updateId, }).done( function(response)
		{

			  if( $.trim(response) != "" )
			  {
				  $("#dynamic-fields").html(response);
				  $('#dynamic-fields select').select2();
				   sbDropzone_image();
				   adforest_inputTags();
			  }


			 $('#sb_loading').hide();
			 if( $('#theme_type').val() == 1 && updateId == "" )
			 {
				$('#ad_post_form').submit(); 
			 }
		});		
	  /*For Category Templates*/		

}
$(document).on('change', '#ad_price_type', function()
{
	
	if( this.value == "on_call" || this.value == "free" || this.value == "no_price"  )
	{
		$('#ad_price').attr( "data-parsley-required", "false" );
		$('#ad_currency').attr( "data-parsley-required", "false" );
		$('#ad_price').val('');	
		//$('#ad_currency').val('');	
		$('#ad_price').parent('div').hide();
		$('#ad_currency').parent('div').hide();
		//$('.curreny_class').hide();
	}
	else
	{
		$('#ad_price').attr( "data-parsley-required", "true" );
		$('#ad_currency').attr( "data-parsley-required", "true" );
		$('#ad_price').parent('div').show();
		//$('.curreny_class').show();	
		$('#ad_currency').parent('div').show();
	}
});

if( $('#is_video_on').val() == 1 )
{
	/*Video Popup*/
	$("a.play-video").YouTubePopUp();
}

$('a.page-scroll').on('click', function(event) {
					var $anchor = $(this);
					$('html, body').stop().animate({
						scrollTop: $($anchor.attr('href')).offset().top - 60
					}, 1500, 'easeInOutExpo');
					event.preventDefault();
				});
				
$('select.submit_on_select').on("select2:select", function(e) { 
 $('#sb_loading').show();
 $(this).closest("form").submit(); 
});
$('.fa_cursor').on("click", function(e) { 
 $('#sb_loading').show();
 $(this).closest("form").submit(); 
});
$('.submit_on_select').on('click', function()
{
	$('#sb_loading').show();
 	$(this).closest("form").submit(); 	
});

$( "#sortable" ).sortable( {
	
stop: function( event, ui ) {
	$('#post_img_ids').val('');
	var current_img	= '';
		$( ".ui-state-default img" ).each(function( index ) {
			current_img	=	current_img + $(this).attr( 'data-img-id' ) + ",";
  			  
			
});
		$('#post_img_ids').val( current_img.replace(/,\s*$/, "") );
	}
});

$('#sb_sort_images').on('click', function()
{
	$('#sb_loading').show();
	$.post(adforest_ajax_url,	{action : 'sb_sort_images', ids:$('#post_img_ids').val(), ad_id: $('#current_pid').val(), }).done( function(response)
	{ 
		toastr.success( $('#re-arrange-msg').val(), '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
		location.reload();
		$('#sb_loading').hide();
	});	
});

      var $scrollbar = $('.rating_comments');
            $scrollbar.perfectScrollbar({
                maxScrollbarLength: 150,
            });
            $scrollbar.perfectScrollbar('update');
			
/*Phone verification logic*/
$(document).on('click', '#sb_verification_ph,#resend_now',function()
{
	var ph_number	=	$('#sb_ph_number').val();
	$('#sb_verification_ph_code').hide();
	$('#sb_verification_ph').hide();
	$('#sb_verification_ph_back').show();
	$.post(adforest_ajax_url,	{action : 'sb_verification_system', sb_phone_numer:ph_number, }).done( function(response) 
	{
		var res_arr	=	response.split( "|" );
		if( $.trim(res_arr[0]) != "0" )
		{
			
			$('#sb_verification_ph_back').hide();
			$('.sb_ver_ph_div').hide();
			$('.sb_ver_ph_code_div').show();
			$('#sb_verification_ph_code').show();
			
			toastr.success( res_arr[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
		}
		else
		{
			$('#sb_verification_ph').show();
			$('#sb_verification_ph_back').hide();
			toastr.error(res_arr[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});

		}
	});

});

$(document).on('click', '#sb_verification_ph_code',function()
{
	var ph_code	=	$('#sb_ph_number_code').val();
	$('#sb_verification_ph_code').hide();
	$('#sb_verification_ph_back').show();
	$.post(adforest_ajax_url,	{action : 'sb_verification_code', sb_code:ph_code, }).done( function(response) 
	{
		var res_arr	=	response.split( "|" );
		if( $.trim(res_arr[0]) != "0" )
		{
			toastr.success( res_arr[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
			location.reload();
		}
		else
		{
			$('#sb_verification_ph_code').show();
			$('#sb_verification_ph_back').hide();
			toastr.error(res_arr[1], '', {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});

		}
	});

});


})(jQuery);
jQuery(document).ready(function($) {
    $( "#ad_price_type" ).trigger( "change" );
	$('[data-toggle="tooltip"]').tooltip();
	
});

function adforest_validateEmail(sEmail) 
{
	var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if (filter.test(sEmail))
	{
		return true;
	}
	else 
	{
		return false;
	}
}
function adforest_select_msg(cid, second_user, prnt)
{
	jQuery('.message-history-active').removeClass('message-history-active');
	jQuery(document).find('#'+second_user + '_' + cid).html('');
	jQuery(document).find('#sb_'+second_user + '_' + cid).addClass('message-history-active');
	jQuery('#sb_loading').show();
	
	jQuery.post(jQuery('#adforest_ajax_url').val(),	{action : 'sb_get_messages', ad_id:cid, user_id:second_user, receiver:second_user, inbox:prnt }).done( function(response)
	{
			jQuery('#usr_id').val(second_user);
			jQuery('#rece_id').val(second_user);
			jQuery('#msg_receiver_id').val(second_user);
		jQuery('#ad_post_id').val(cid)
		jQuery('#sb_loading').hide();
		jQuery('#messages').html(response);
	});

}

/**
 * Adds events to input elements to add or remove the pet pregnancy field and
 * pet milking capacity fields selection and deselection of male or female gender
 *
 * @param $ jQuery
 */
function removeMilkingCapcityField( $ ) {
	var petMaleInput = $( '#anbz-male' ),
		petFemaleInput = $( '#anbz-female' ),
		body = $( 'body' );
	petMaleInput.on( 'click', removeMilkingCapacityMale );
	petFemaleInput.on( 'click', removeMilkingCapacityFemale );
	function removeMilkingCapacityMale() {
		var petPregnantTextEl = $( '.adforest-pet-pregnant-text' ),
			petMilkingCapacityEl = $( '#anbz-milking-capacity' );
		if ( ! petPregnantTextEl.hasClass( 'adforest-display' ) ) {
			petPregnantTextEl.addClass( 'adforest-display' );
		}

		if ( ! petMilkingCapacityEl.hasClass( 'adforest-display' ) ) {
			petMilkingCapacityEl.addClass( 'adforest-display' )
		}

	}
	function removeMilkingCapacityFemale() {
		$( '.adforest-pet-pregnant-text' ).removeClass( 'adforest-display' );
		$( '#anbz-milking-capacity' ).removeClass( 'adforest-display' );
	}
}
