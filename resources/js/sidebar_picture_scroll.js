$(function() {
	Livewire.on('articleLoaded', function() {
		$('.article-sidebar__img-container__scroller').css('opacity', Math.max(0, 1 - $('.article-sidebar__img-container').scrollTop() / 100));
		$('.article-sidebar__img-container').scroll(function() {
			$('.article-sidebar__img-container__scroller').css('opacity', Math.max(0, 1 - $(this).scrollTop() / 100));
		});

		$('.article-sidebar__img-container-mobile__arrow--left').on('click', function() {
			let currentScrollLeft = $('.article-sidebar__img-container-mobile__images').scrollLeft();
			let windowWidth = $(document).width();
			let currentInnerWidth = $('.article-sidebar__img-container-mobile__images').get(0).scrollWidth;

			if (currentScrollLeft >= windowWidth) {
				$('.article-sidebar__img-container-mobile__images').scrollLeft(currentScrollLeft - windowWidth);
				// $('.article-sidebar__img-container-mobile__images').animate({scrollLeft: currentScrollLeft - windowWidth});
			} else {
				$('.article-sidebar__img-container-mobile__images').scrollLeft(currentInnerWidth);
				// $('.article-sidebar__img-container-mobile__images').animate({scrollLeft: currentInnerWidth});
			}
		});

		$('.article-sidebar__img-container-mobile__arrow--right').on('click', function() {
			let currentScrollLeft = $('.article-sidebar__img-container-mobile__images').scrollLeft();
			let windowWidth = $(document).width();
			// let currentInnerWidth = $('.article-sidebar__img-container-mobile__images').innerWidth();
			let currentInnerWidth = $('.article-sidebar__img-container-mobile__images').get(0).scrollWidth;

			if (currentScrollLeft < currentInnerWidth - $('.article-sidebar__img-container-mobile__images').width()) {
				// $('.article-sidebar__img-container-mobile__images').animate({scrollLeft: currentScrollLeft + windowWidth});
				$('.article-sidebar__img-container-mobile__images').scrollLeft(currentScrollLeft + windowWidth);
			} else {
				$('.article-sidebar__img-container-mobile__images').scrollLeft(0);
				// $('.article-sidebar__img-container-mobile__images').animate({scrollLeft: 0});
			}
		});
	});
	Livewire.on('sidebarChange', function() {
		$('.article-sidebar__img-container__scroller').css('opacity', Math.max(0, 1 - $('.article-sidebar__img-container').scrollTop() / 100));
		$('.article-sidebar__content').scrollTop(0);
		$('#general-side-modal').scrollTop(0);
		$('.article-sidebar').scrollTop(0);
	});

    // $('.jcarousel').jcarousel({
    //     transitions: true,
    //     wrap: 'both',

    // });
});