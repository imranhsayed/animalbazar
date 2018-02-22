/*
Template: AdForest | Largest Classifieds Portal
Author: ScriptsBundle
Version: 1.0
Designed and Development by: ScriptsBundle
*/
(function($) {
    "use strict";
	var adforest_ajax_url	=	$('#adforest_ajax_url').val();
            // Step show event 
			var map_counter	= 1;
			var show_preview	=	1;
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
               if(stepPosition === 'first')
			   {
                   $("#prev-btn").addClass('disabled');
				}
			   else if(stepPosition === 'final')
			   {
					$("#next-btn").addClass('disabled');
					$('.submit_ad_now').show();
					$('.preview_ad_now').show();
					if( map_counter == 1 )
					{
						setTimeout(function(){
    my_g_map(markers);
						map_counter++;
}, 1000);
						
					}
               }
			   else
			   {
                   $("#prev-btn").removeClass('disabled');
                   $("#next-btn").removeClass('disabled');
               }
            });
            
            // Toolbar extra buttons
            var btnFinish = $('<button style="" type="submit" class="submit_ad_now"></button>').text($('#wizard_submit').val())
                                             .addClass('btn btn-success');
                                             
            
            // Smart Wizard
            $('#smartwizard').smartWizard({ 
                    selected: 0, 
                    theme: $('#post_ad_layout').val(),
                    transitionEffect:'fade',
                    showStepURLhash: false,
					keyNavigation: false,
					lang: {  // Language variables
						next: $('#wizard_next').val(), 
						previous: $('#wizard_previous').val(),
					},
                    toolbarSettings: {toolbarPosition: 'both',
                                      toolbarExtraButtons: [btnFinish]
                                    }
            });
			$("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
				$('.ad_errors').hide();
				if( stepDirection == 'backward' && stepNumber != 2 )
				{
					$('.parsley-errors-list').hide();
					return true;
				}
				var is_error	=	false;
				$('.parsley-errors-list').show();
				$("#step-" + stepNumber +  " :input[data-parsley-required='true']").each(function(index, element)
				{
					if( $(this).val() == "" )
					{
						is_error	=	true;
						
					}
					if( $(this).attr('id') == 'ad_price' )
					{
						var isnum = /^\d+$/.test($(this).val());
						if( !isnum )
						{
							is_error	=	true;
						}
					}
                });
				
				
		$('body,html').animate({
			scrollTop: 200,
		}, 700);
				
				if( is_error )
				{
					$('#ad_post_form').submit();
					$('.ad_errors').show();
					$('.parsley-errors-list').show();
					event.preventDefault();
					return false;
				}
				else
				{
					$('.parsley-errors-list').hide();
				}
      		});

            
            // External Button Events
            $("#reset-btn").on("click", function() {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");
                return true;
            });
            
            $("#prev-btn").on("click", function() {
                // Navigate previous
                $('#smartwizard').smartWizard("prev");
                return true;
            });
			var submit_counter = 1;
			$(".sw-btn-next").on("click", function() {
				if( submit_counter == 1 && $('#is_update').val() == "" )
				{ 
					$('#ad_post_form').submit();
					submit_counter++;
				}
			});
            
            $("#next-btn").on("click", function() {
                // Navigate next
                $('#smartwizard').smartWizard("next");
                return true;
            });
			
})(jQuery);


