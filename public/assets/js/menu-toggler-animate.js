$(function(){
	setTimeout(function(){
		menu_container = $(document).find(".menu-container");

		if( menu_container ) {
			margin_top = $(".menu-container").outerHeight();
			$(".content-container").attr("style", `margin-top:${margin_top}px;`);

			$(".content-container").addClass( $(".menu-container").hasClass("toggler-slide-right") ? "right" : "left" );
			$("body").addClass("menu-slide-animation");

			// fixed-top toggler-animation toggler-slide-left
			nb_ht = $(".navbar").outerHeight();
			$(".navbar-collapse").attr("style", `--nb-top:${nb_ht}px;`);


			$("#navbarTogglerDemo02").on("show.bs.collapse", function() {
				mcont_class = $(".menu-container").hasClass("toggler-slide-right") ? "toggler-slide-right" : "toggler-slide-left";

				if( mcont_class=="toggler-slide-left" )
					$(".content-container").addClass("open-left");
				else
					$(".content-container").addClass("open-right");

				$("body").addClass("open");
			});

			$("#navbarTogglerDemo02").on("hide.bs.collapse", function() {
				mcont_class = $(".menu-container").hasClass("toggler-slide-right") ? "toggler-slide-right" : "toggler-slide-left";

				if( mcont_class=="toggler-slide-left" )
					$(".content-container").removeClass("open-left");
				else
					$(".content-container").removeClass("open-right");

				$("body").removeClass("open");
			});
		}
	},1000);
});