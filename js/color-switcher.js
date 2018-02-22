(function($) {
    "use strict";
		var theme_path 	=	$('#theme_path').val();
		
		  $("#defualt" ).on('click',function(){
			  $("#defualt-color-css" ).attr("href", theme_path + "css/colors/defualt.css");
			  return false;
		  });
		  
		 
		  $("#red" ).on('click',function(){
			  $("#defualt-color-css" ).attr("href", theme_path + "css/colors/red.css");
			  return false;
		  });
		  
		   $("#green" ).on('click',function(){
			  $("#defualt-color-css" ).attr("href", theme_path + "css/colors/green.css");
			  return false;
		  });
		  
		  $("#blue" ).on('click',function(){
			  $("#defualt-color-css" ).attr("href", theme_path + "css/colors/blue.css");
			  return false;
		  });
		  

		   $("#sea-green" ).on('click',function(){
			  $("#defualt-color-css" ).attr("href", theme_path + "css/colors/sea-green.css");
			  return false;
		  });
		  

	
		  // picker buttton
		  $(".picker_close").click(function(){
			  	$("#choose_color").toggleClass("position");
			  
		   });
		  
})(jQuery);