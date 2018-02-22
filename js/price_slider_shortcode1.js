/*
Template: AdForest | Largest Classifieds Portal
Author: ScriptsBundle
Version: 1.0
Designed and Development by: ScriptsBundle
*/
(function($) {
    "use strict";
	 /*==========  Price Range Slider  ==========*/
	 var min_price	=	$('#min_price').val();
	 var max_price	=	$('#max_price').val();
	 if( $('#min_price').length > 0 )
	 {
    $('#price-slider').noUiSlider({
        connect: true,
        behaviour: 'tap',
        start: [min_price, max_price],
        step: 50,
        range: {
            'min': parseInt(min_price),
            'max': parseInt(max_price)
        }
    });
		$('#price-slider').Link('lower').to($('#price-min'), null, wNumb({
			decimals: 0
		}));
		$('#price-slider').Link('lower').to($('#min_selected'), null, wNumb({
			decimals: 0
		}));
		$('#price-slider').Link('upper').to($('#price-max'), null, wNumb({
			decimals: 0
		}));
		$('#price-slider').Link('upper').to($('#max_selected'), null, wNumb({
			decimals: 0
		}));
	 }
			
})(jQuery);

