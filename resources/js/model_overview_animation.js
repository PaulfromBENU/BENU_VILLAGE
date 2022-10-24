$(function() {
	if ($(window).width() > 768) {
		$('.model-overview').on('mouseenter', function() {
			$(this).children('.model-overview__header').css('padding-left', '45px');
			$(this).children('.model-overview__footer').css('padding-left', '45px');
		});
		$('.model-overview').on('mouseleave', function() {
			$(this).children('.model-overview__header').css('padding-left', '30px');
			$(this).children('.model-overview__footer').css('padding-left', '30px');
		});
	}
});