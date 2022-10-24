$(function() {
    $('.header__main-menu__icons__btn').on('mouseenter', function() {
        $('path', this).toggleClass('svg-primary--active');
        $('circle', this).toggleClass('svg-primary--active');
    });
    $('.header__main-menu__icons__btn').on('mouseleave', function() {
        $('path', this).toggleClass('svg-primary--active');
        $('circle', this).toggleClass('svg-primary--active');
    });
});