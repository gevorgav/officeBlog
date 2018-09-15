jQuery(function($){

	$(document).on('click', "#left_sidebar h2, #nav_open_toggle", function(e) {
		e.stopPropagation();
		let open = $("#nav_open_toggle").attr("data-open");
		if (open == "false") {
			$("#left_sidebar_navigation").fadeIn(500);
			$("#nav_open_toggle").attr("data-open", true);
            $("#left_sidebar").addClass("open-menu");
		} else {
			$("#left_sidebar_navigation").fadeOut(100);
			$("#nav_open_toggle").attr("data-open", false);
            $("#left_sidebar").removeClass("open-menu");
		}
	});

	$(document).on('click', '.left-sidebar-navigation ul li.has-submenu', function() {
		$(this).toggleClass("open");
	});
    
	$(document).on('click', '.left-sidebar-navigation ul li.has-submenu ul', function(e) {
		e.stopPropagation();
	});

});