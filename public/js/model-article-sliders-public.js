function enablePictureSlidersPublic()
{	
	$('.article-arrow-left').on('click', function(e) {
		e.preventDefault();
		let currentContainer = $(this).parent();
		let currentIndex = 0;
		articleImgCount = currentContainer.children('img').length;
		for (var i = 0; i < articleImgCount; i++) {
			if (currentContainer.children('img:nth-child('+ i +')').attr('style') != 'display: none;') {
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
			if (currentContainer.children('img:nth-child('+ (i + 1) +')').attr('style') != 'display: none;') {
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