function deactivateBgScroll()
{
	$('body').css('overflow-y', 'hidden');//.css('position', 'relative');
	$('html').css('overflow-y', 'hidden').css('position', 'relative');
}

function activateBgScroll()
{
	$('body').css('overflow-y', 'auto');//.css('position', 'static');
	$('html').css('overflow-y', 'auto').css('position', 'static');
}

$(function() {
	$('.article-sidebar').hide();
	$('.mask-sidebar').hide();
	$('.items-sidebar').hide();
	$('.voucher-sidebar').hide();

	Livewire.on('displayArticle', article_id => {
		$('.modal-opacifier').fadeIn();
		$('#general-side-modal').fadeIn(500, function() {
			Livewire.emit('ArticleModalReady', article_id);
		});
		$('#general-side-modal').css('right', '0');
	});

	Livewire.on('articleLoaded', function() {
		$('.article-sidebar').hide();
		$('.article-sidebar').fadeIn();
		deactivateBgScroll();
	});

	$('.modal-opacifier').on('click', function() {
		$('#general-side-modal').css('right', '-60vw');
		$('#general-side-modal').fadeOut(400, function() {
			$('.article-sidebar').hide();
			$('.mask-sidebar').hide();
			$('.items-sidebar').hide();
			$('.voucher-sidebar').hide();
		});
		activateBgScroll();
		Livewire.emit('ArticleModalReady', 0);
	});

	Livewire.on('closeSideBar', function() {
		$('.modal-opacifier').fadeOut();
		$('#general-side-modal').css('right', '-60vw');
		$('#general-side-modal').fadeOut(400, function() {
			$('.article-sidebar').hide();
		});
		activateBgScroll();
		Livewire.emit('ArticleModalReady', 0);
	});


	// Mask sidebar handler
	$('#mask-specific-order-btn').on('click', function() {
		$('.modal-opacifier').fadeIn();
		$('#general-side-modal').fadeIn(500, function() {
			$('.mask-sidebar').fadeIn();
		});
		deactivateBgScroll();
		$('#general-side-modal').css('right', '0');
		$('.article-sidebar__img-container').scroll(function() {
			$('.article-sidebar__img-container__scroller').css('opacity', Math.max(0, 1 - $(this).scrollTop() / 100));
		});
	});

	Livewire.on('closeMaskSideBar', function() {
		$('.modal-opacifier').fadeOut();
		$('#general-side-modal').css('right', '-60vw');
		$('#general-side-modal').fadeOut(400, function() {
			$('.mask-sidebar').hide();
		});
		activateBgScroll();
	});


	// Small Items sidebar handler
	$('#items-specific-order-btn').on('click', function() {
		$('.modal-opacifier').fadeIn();
		$('#general-side-modal').fadeIn(500, function() {
			$('.items-sidebar').fadeIn();
		});
		deactivateBgScroll()
		$('#general-side-modal').css('right', '0');
		$('.article-sidebar__img-container').scroll(function() {
			$('.article-sidebar__img-container__scroller').css('opacity', Math.max(0, 1 - $(this).scrollTop() / 100));
		});
	});

	Livewire.on('closeItemsSideBar', function() {
		$('.modal-opacifier').fadeOut();
		$('#general-side-modal').css('right', '-60vw');
		$('#general-side-modal').fadeOut(400, function() {
			$('.items-sidebar').hide();
		});
		activateBgScroll();
	});


	// Voucher sidebar handler
	Livewire.on('displayVoucher', voucher_id => {
		$('.modal-opacifier').fadeIn();
		$('#general-side-modal').fadeIn(500, function() {
			Livewire.emit('VoucherModalReady', voucher_id);
		});
		$('#general-side-modal').css('right', '0');
		$('.article-sidebar__img-container').scroll(function() {
			$('.article-sidebar__img-container__scroller').css('opacity', Math.max(0, 1 - $(this).scrollTop() / 100));
		});
	});

	Livewire.on('voucherLoaded', function() {
		$('.voucher-sidebar').hide();
		$('.voucher-sidebar').fadeIn();
		deactivateBgScroll();
	});

	Livewire.on('closeVoucherSideBar', function() {
		$('.modal-opacifier').fadeOut();
		$('#general-side-modal').css('right', '-60vw');
		$('#general-side-modal').fadeOut(400, function() {
			$('.voucher-sidebar').hide();
		});
		activateBgScroll();
	});
});