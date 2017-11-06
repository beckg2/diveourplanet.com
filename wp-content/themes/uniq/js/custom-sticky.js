(function($){
	// Sticky Header Options 
			 
		$(window).scroll(function() {
		if ($(this).scrollTop() > 1){  
		    $('.site-header').addClass("site-header-sticky");
		  }
		  else{
		    $('.site-header').removeClass("site-header-sticky");
		  }
		});

})(jQuery); 