$(document).ready(function() {
	$("#parallax-navbar > li > a").click(function(e){
		if( $(this).attr("data-target")!="no-parallax" ) {
			e.preventDefault();
			var which = $(this).attr("data-target");
			$("#parallax-navbar > li").removeClass("active");
			$(this).parent().addClass("active");
			$("html, body").animate({
				scrollTop: $(which).offset().top-70
			},800);
		}
	});

	$(".contact-form").submit(function(e){
		recaptcha_response = grecaptcha.getResponse();

		if( recaptcha_response==0 ) {
			if( $("#verify-human") )
				$("#verify-human").empty();

			$("#recaptcha").append("<small id='verify-human' class='text-danger'>Verifica que eres humano en el recaptcha antes de enviar los datos.</small>");
			return false;
		}
	});

	$(".btn-animated").mousemove(function(e){
		x=e.offsetX;
		y=e.offsetY;

		$(this).css({"--x": x+"px","--y": y+"px"});
	});

	$("input, textarea").focusin(function(e) {
		$(this).parent().find(".fc-label").addClass("focus");
	});
	$("input, textarea").focusout(function(e) {
		if( $(this).val()=="" )
			$(this).parent().find(".fc-label").removeClass("focus");
	});

	$("#nb-search").keyup(function(e){
		token = $(".form-search input[name='_token']").val();
		route = direction+"find-product";
		_find = $(this).val();

		$.ajax({
			url: route,
			headers: { "X-CSRF-TOKEN":token },
			type: 'POST',
			dataType: 'json',
			data: {find_prod: _find},
			success: function(resp) {
				resp_arr = [];
				_html = "";

				console.log(resp_arr.length)

				if( resp.length>0 ) {
					$.each(resp, function(i,e){
						resp_arr.push(''+
							'<a href="'+direction+'products/'+e.slug+'" class="search-item row align-items-center">'+
								'<div class="col-md-4 pr-0">'+
									'<img src="'+direction+'assets/images/products/'+e.image+'" alt="" class="img-fluid d-block m-auto" />'+
								'</div>'+
								'<div class="col-md-8">'+
									'<p class="text-blue">'+e.name+'</p>'+
								'</div>'+
							'</a>'
						);
					});

					for( i=0; i<resp_arr.length; i++ ) {
						_html += resp_arr[i];
					}

					if( resp_arr.length>2 )
						$("#result-container").css("height","300px");
					else
						$("#result-container").css("height","auto");

					$("#result-container").slideDown(400);

					$("#result-container").html( _html );
				} else {
					_html = ''+
							'<div class="search-item row align-items-center">'+
								'<div class="col-md-12">'+
									'<p class="text-blue"><span class="text-green">+</span>No hay productos.</p>'+
								'</div>'+
							'</div>';

					$("#result-container").css("height","auto");
					$("#result-container").html( _html );
					$("#result-container").slideDown(400);
				}
			},
			error: function(msj){
				console.log(msj.responseJSON.genre);
			}
		});
	});

	$("#nb-search").focusout(function(){
		$("#result-container").slideUp(400,function(){
			$(this).empty();
		});
	});

});

function verifyHuman() {
	recaptcha_response = grecaptcha.getResponse();

	if( recaptcha_response!=0 ) {
		if( $("#verify-human") )
			$("#verify-human").empty();

		$(".contact-form button[type='submit']").removeAttr("disabled");
		return true;
	}
}

$(window).on("load",function(e){
	$("input").each(function(i, e) {
		if( $(this).val()!="" )
			$(this).parent().find(".fc-label").addClass("focus");
		else
			$(this).parent().find(".fc-label").removeClass("focus");
	});

	$("textarea").each(function(i, e) {
		if( $(this).val()!="" )
			$(this).parent().find(".fc-label").addClass("focus");
		else
			$(this).parent().find(".fc-label").removeClass("focus");
	});

	// if( $("input, textarea").val()=="" ) {
	// 	$("input, textarea").parent().find(".fc-label").removeClass("focus");
	// 	console.log("not founded")
	// } else {
	// 	console.log("founded")
	// 	$("input, textarea").parent().find(".fc-label").addClass("focus");
	// }
});
