jQuery(document).ready(function($) {

	$(".top-navigation").prepend("<div class='mobile-menu-collaps-button'> <i class='fa fa-bars'></i> <i class='fa fa-times'></i></div>");
	
	$(".mobile-menu-collaps-button").click(function(){
		$(".nav-menu").toggleClass("showMenus");
		$(".mobile-menu-collaps-button").toggleClass("close-btns");
		$(".flex-direction-nav").toggleClass("close-nav");
		$(".site-footer").toggleClass("close-nav");
		
	});

	$( ".nav-menu li:has(> ul)" ).each(function() {
		 $(this).addClass("hasSubMenu");
		 $(this).append("<span class='submenuu-arrrow'><i class='fa fa-caret-down'></i></span>");
	});
	
	$(".submenuu-arrrow").click(function(){
			//$(this).parent().toggleClass("openSubmenu");
			$(this).closest('li.hasSubMenu').toggleClass("openSubmenu");
		 });

});
