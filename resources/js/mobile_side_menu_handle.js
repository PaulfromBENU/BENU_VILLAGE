function toggleMobileSideMenu(menuStatus)
{
	if (menuStatus == 1) {
		$('#side-mobile').css('bottom', '150vh');
		// $('#side-mobile').css('display', 'none');
		$('#mobile-menu-btn').removeClass('header__hamburger--active');
		menuActive = 0;
	} else {
		$('#side-mobile').css('bottom', '0');
		$('#mobile-menu-btn').addClass('header__hamburger--active');
		menuActive = 1;
	}
}

let menuActive = 0;

$(function() {
	$('#mobile-menu-btn').on('click', function() {
		toggleMobileSideMenu(menuActive);
	});

	$('.side-mobile-link').on('click', function() {
		toggleMobileSideMenu(1);
	});
});