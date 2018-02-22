(function($) {
    "use strict";
	
	var adforest_ajax_url	=	$('#adforest_ajax_url').val();
	
	var ua = navigator.userAgent.toLowerCase();
if (ua.indexOf("safari/") !== -1 &&  // It says it's Safari
    ua.indexOf("windows") !== -1 &&  // It says it's on Windows
    ua.indexOf("chrom")   === -1     // It DOESN'T say it's Chrome/Chromium
    ) {
    $('.sb-top-bar_notification').show();
}

	// Comming Soon
         $(".comming-soon-grid").height($(window).height());
         $(window).resize(function(){
            $(".comming-soon-grid").height($(window).height());
         });
         // 12.0 countdown clock active code
         $('#clock').countdown($('#when_live').val(), function (event) {
            var $this = $(this).html(event.strftime( $('#get_time').val() ));
         });

    /* ======= Preloader ======= */
	
})(jQuery);

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
