/*
Template: AdForest | Largest Classifieds Portal
Author: ScriptsBundle
Version: 1.0
Designed and Development by: ScriptsBundle
*/
(function($) {
    "use strict";
	var adforest_ajax_url	=	$('#adforest_ajax_url').val();
	$(document).ready(function() { 
		$('.iCheck-helper, ul.list li label').on('click', function() {
			$('#sb_loading').show();
			$(this).closest("form").submit();
		});
		$('#order_by').on('change', function() {
			$('#sb_loading').show();
			$(this).closest("form").submit();
		});
	});
	
	 /*==========  Price Range Slider  ==========*/
	 var min_price	=	$('#min_price').val();
	 var max_price	=	$('#max_price').val();
	 if( $('#min_price').length > 0 )
	 {
    $('#price-slider').noUiSlider({
        connect: true,
        behaviour: 'tap',
        start: [$('#min_selected').val(), $('#max_selected').val()],
        step: 0,
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
		
		$('.categories ul li a').on('click', function()
		{
			var cat_s_id	=	$(this).attr('data-cat-id');
			if( cat_s_id != "" )
			{
				$('#cat_id').val( cat_s_id );
				$('#sb_loading').show();
				$('#cats_response').html('');
				$.post(adforest_ajax_url,	{action : 'sb_get_sub_cat_search', cat_id:cat_s_id, }).done( function(response)
				{
				  $('#sb_loading').hide();
				  if( $.trim(response) == 'submit' )
				  {
					  $('#search_cats_w').submit();
				  }
				  else
				  {
					$('#cat_modal').modal('show');
					$('#cats_response').html(response);
				  }
				});
			}
		});
		
		$('#ad_cats').on('change', function()
		{
			var cat_s_id	=	$('#ad_cats').val();
			if( cat_s_id != "" )
			{
				$('#sb_loading').show();
				$('#cats_response').html('');
				$('#cat_id').val( cat_s_id );
				$.post(adforest_ajax_url,	{action : 'sb_get_sub_cat_search', cat_id:cat_s_id, }).done( function(response)
				{
				  $('#sb_loading').hide();
				  if( $.trim(response) == 'submit' )
				  {
					  $('#search_cats_w').submit();
				  }
				  else
				  {
					$('#cat_modal').modal('show');
					$('#cats_response').html(response);
				  }
				});
			}
		});

		
		$(document).on('click', '#ajax_cat', function()
		{
			$('#sb_loading').show();
			var cat_s_id	=	$(this).attr('data-cat-id');
			$('#cat_id').val( cat_s_id );
		  $.post(adforest_ajax_url,	{action : 'sb_get_sub_cat_search', cat_id:cat_s_id, }).done( function(response)
		  {
			  $('#sb_loading').hide();
			  if( $.trim(response) == 'submit' )
			  {
				  $('#search_cats_w').submit();
			  }
			  else
			  {
			  	$('#cats_response').html(response);
			  }
		  });
		});
		$(document).on('click', '#ad-search-btn', function()
		{
			$('#search_cats_w').submit();
		});
		
		$('.adv-srch').on('click', function()
		{
			$(this).hide();
			$('.hide_adv_search').show();	
		});
		
		/*// Validating Registration process*/
		if( $('#sb-radius-form').length > 0 )
		{
			  $('#sb-radius-form').parsley().on('field:validated', function() {
						var ok = $('.parsley-error').length === 0;
			  })
			  .on('form:submit', function() {
				  //radius_search();
				  //return false;
			  });
		}
		
		 /*// Location*/
  $('.countries ul li a').on('click', function()
  {
   $('#sb_loading').show();
   $('#countries_response').html('');
   var cat_s_id = $(this).attr('data-country-id');
   $('#country_id').val( cat_s_id );
    $.post(adforest_ajax_url, {action : 'get_related_cities', country_id:cat_s_id, }).done( function(response)
    {
     $('#sb_loading').hide();
     if( $.trim(response) == 'submit' )
     {
      $('#search_countries').submit();
     }
     else
     {
    $('#states_model').modal('show');
      $('#countries_response').html(response);
     }
    });
  });
  
  
  $(document).on('click', '#ajax_states', function()
  {
   $('#sb_loading').show();
   var cat_s_id = $(this).attr('data-country-id');
   $('#country_id').val( cat_s_id );
    $.post(adforest_ajax_url, {action : 'get_related_cities', country_id:cat_s_id, }).done( function(response)
    {
     $('#sb_loading').hide();
     if( $.trim(response) == 'submit' )
     {
      $('#search_countries').submit();
     }
     else
     {
      $('#countries_response').html(response);
     }
    });
  });
  $(document).on('click', '#country-btn', function()
  {
   $('#search_countries').submit();
  });
  
  $('#ad_country').on('change', function()
  {
   
   var cat_s_id = $('#ad_country').val();
   if( cat_s_id != "" )
   {
    $('#sb_loading').show();
    $('#countries_response').html('');
    $('#country_id').val( cat_s_id );
    $.post(adforest_ajax_url, {action : 'get_related_cities', country_id:cat_s_id, }).done( function(response)
    {
      $('#sb_loading').hide();
      if( $.trim(response) == 'submit' )
      {
        $('#search_countries').submit();
      }
      else
      {
     $('#states_model').modal('show');
      $('#countries_response').html(response);
      }
    });
   }
  });
					
})(jQuery);


