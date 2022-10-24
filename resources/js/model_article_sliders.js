function enablePictureSliders()
{
	let modelImgCount = $('.model-pres__img-container img').length;
	let currentModelImg = 0;
	$('#model-picture-arrow-left').on('click', function() {
		$('.model-pres__img-container img').eq(currentModelImg).hide();
		if (currentModelImg > 0) {
			currentModelImg --;
		} else {
			currentModelImg = modelImgCount - 1;
		}
		$('.model-pres__img-container img').eq(currentModelImg).show();
	});
	$('#model-picture-arrow-right').on('click', function() {
		$('.model-pres__img-container img').eq(currentModelImg).hide();
		if (currentModelImg < modelImgCount - 1) {
			currentModelImg ++;
		} else {
			currentModelImg = 0;
		}
		$('.model-pres__img-container img').eq(currentModelImg).show();
	});

	let articleImgCount = 4;
	$('.article-arrow-left').on('click', function(e) {
		e.preventDefault();
		let currentContainer = $(this).parent();
		let currentIndex = 0;
		articleImgCount = currentContainer.children('img').length;
		for (var i = 0; i < articleImgCount; i++) {
			if (currentContainer.children('img').eq(i).css('display') != 'none') {
				currentIndex = i;
			}
		}
		currentContainer.children('img').eq(currentIndex).hide();
		if (currentIndex == 0) {
			currentIndex = articleImgCount - 1;
		} else {
			currentIndex --;
		}
		currentContainer.children('img').eq(currentIndex).show();
	});

	$('.article-arrow-right').on('click', function(e) {
		e.preventDefault();
		let currentContainer = $(this).parent();
		let currentIndex = 0;
		articleImgCount = currentContainer.children('img').length;
		for (var i = 0; i < articleImgCount; i++) {
			if (currentContainer.children('img').eq(i).css('display') != 'none') {
				currentIndex = i;
			}
		}
		currentContainer.children('img').eq(currentIndex).hide();
		if (currentIndex == articleImgCount - 1) {
			currentIndex = 0;
		} else {
			currentIndex ++;
		}
		currentContainer.children('img').eq(currentIndex).show();
	});
}

$(function() {
	enablePictureSliders();
});