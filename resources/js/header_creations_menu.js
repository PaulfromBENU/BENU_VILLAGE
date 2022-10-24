function showMenu(id) 
{
    let menuClass = '';
    switch(id) {
        case '#nav-toggle-unisex':
            menuClass = '.navbar-list-unisex';
            break;

        case '#nav-toggle-adult':
            menuClass = '.navbar-list-adult';
            break;

        case '#nav-toggle-woman':
            menuClass = '.navbar-list-woman';
            break;

        case '#nav-toggle-man':
            menuClass = '.navbar-list-man';
            break;

        case '#nav-toggle-child':
            menuClass = '.navbar-list-child';
            break;

        case '#nav-toggle-accessories':
            menuClass = '.navbar-list-accessories';
            break;

        case '#nav-toggle-home':
            menuClass = '.navbar-list-home';
            break;

        default:
            menuClass = '';
    }
    //Remove all menus to avoid multiple display
    $('.creations-navbar__nav__toggle').removeClass('creations-navbar__nav__toggle--active');

    //Add menu of hovered toggle
    $(this).addClass('creations-navbar__nav__toggle--active');
    $('.creations-navbar__menu').css('max-height', '280px');

    $('.creations-navbar__menu__list').hide();
    $(menuClass).show();
}

function resetMobileMenu()
{
    $('#mobile-creations-menu-toggle').removeClass('side-mobile__toggler--creation--active');
    $('#side-mobile-creations-links').hide();
    $('#side-mobile-general-links').show();
}

$(function() {
    let creationsBarStatus = 'off';
    let fullMenuStatus = 'off';
    let keepBtnColor = 'off';
    // let lastMenu = '';
    $('#creations-nav-toggle').on('click', function() {

        Livewire.emit('loadCreations');

        $(this).toggleClass('header__main-nav__btn--active');
        //$('#creations-nav-toggle path').toggleClass('svg-primary-white--active');
        if (creationsBarStatus == 'off') {
            $('.creations-navbar').fadeIn();
            creationsBarStatus = 'on';
        } else {
            $('.creations-navbar').fadeOut();
            creationsBarStatus = 'off';
        }

        keepBtnColor = 'on';
    })

    $('#creations-nav-toggle').on('mouseenter', function() {
        $('#creations-nav-toggle path').addClass('svg-primary-white--active');
    });

    $('#creations-nav-toggle').on('mouseleave', function() {
        if (keepBtnColor == 'off') {
            $('#creations-nav-toggle path').removeClass('svg-primary-white--active');
        }
    });

    $(window).on('scroll', function() {
        var scrollTop = $(window).scrollTop();
        if ( scrollTop > 120 && creationsBarStatus == 'on') {
            $('#creations-nav-toggle').removeClass('header__main-nav__btn--active');
            $('.creations-navbar__menu').css('max-height', '0px');
            $('.creations-navbar').fadeOut(400, function() {
                $('#creations-nav-toggle path').removeClass('svg-primary-white--active');
                $('.creations-navbar__nav__toggle').removeClass('creations-navbar__nav__toggle--active');
            });
            creationsBarStatus = 'off';
            fullMenuStatus = 'off';
            keepBtnColor = 'off';
        }
    });

    $('.creations-navbar__nav__toggle').on('mouseenter', function() {
        //Remove all menus to avoid multiple display
        $('.creations-navbar__nav__toggle').removeClass('creations-navbar__nav__toggle--active');

        //Add menu of hovered toggle
        $(this).addClass('creations-navbar__nav__toggle--active');
        $('.creations-navbar__menu').css('max-height', '280px');
        fullMenuStatus = 'on';
    });

    $('.creations-navbar__nav__toggle-link').on('mouseenter', function() {
        //Remove all menus to avoid multiple display
        $('.creations-navbar__nav__toggle').removeClass('creations-navbar__nav__toggle--active');

        //Add menu of hovered toggle
        $('.creations-navbar__menu').css('max-height', '0px');
        fullMenuStatus = 'off';
    });

    $('#nav-toggle-unisex').on('mouseenter', function() {
        showMenu('#nav-toggle-unisex');
        // $('.creations-navbar__menu__list').hide();
        // $('.navbar-list-unisex').show();
    });

    $('#nav-toggle-adult').on('mouseenter', function() {
        showMenu('#nav-toggle-adult');
        // $('.creations-navbar__menu__list').hide();
        // $('.navbar-list-adult').show();
    });

    $('#nav-toggle-woman').on('mouseenter', function() {
        showMenu('#nav-toggle-woman');
        // $('.creations-navbar__menu__list').hide();
        // $('.navbar-list-woman').show();
    });

    $('#nav-toggle-man').on('mouseenter', function() {
        showMenu('#nav-toggle-man');
        // $('.creations-navbar__menu__list').hide();
        // $('.navbar-list-man').show();
    });

    $('#nav-toggle-child').on('mouseenter', function() {
        showMenu('#nav-toggle-child');
        // $('.creations-navbar__menu__list').hide();
        // $('.navbar-list-child').show();
    });

    $('#nav-toggle-accessories').on('mouseenter', function() {
        showMenu('#nav-toggle-accessories');
        // $('.creations-navbar__menu__list').hide();
        // $('.navbar-list-accessories').show();
    });

    $('#nav-toggle-home').on('mouseenter', function() {
        $('.creations-navbar__menu__list').hide();
        $('.navbar-list-home').show();
    });

    $('.creations-navbar__menu').on('mouseleave', function() {
        $('.creations-navbar__menu').css('max-height', '0px');
        $('.creations-navbar__nav__toggle').removeClass('creations-navbar__nav__toggle--active');
        fullMenuStatus = 'off';
        //$('.creations-navbar__menu__list').fadeOut('fast');
    });

    $('.creations-navbar__nav__toggle').on('click', function() {
        if (fullMenuStatus == 'on') {
            $('.creations-navbar__menu').css('max-height', '0px');
            $('.creations-navbar__nav__toggle').removeClass('creations-navbar__nav__toggle--active');
            fullMenuStatus = 'off';
            // lastMenu = $(this).attr('id');
        } else {
            showMenu('#' + $(this).attr('id'));
            fullMenuStatus = 'on';
        }
    });

    $('.creations-navbar').on('mouseleave', function() {
        if (creationsBarStatus == 'on') {
            $('#creations-nav-toggle').removeClass('header__main-nav__btn--active');
            $('.creations-navbar__menu').css('max-height', '0px');
            $('#creations-nav-toggle path').removeClass('svg-primary-white--active');
            $('.creations-navbar').fadeOut(400, function() {
                $('#creations-nav-toggle path').removeClass('svg-primary-white--active');
                $('.creations-navbar__nav__toggle').removeClass('creations-navbar__nav__toggle--active');
            });
            creationsBarStatus = 'off';
            fullMenuStatus = 'off';
            keepBtnColor = 'off';
        }
    });



    // Mobile menu handle
    resetMobileMenu();    

    $('#mobile-creations-menu-toggle').on('click', function() {
        Livewire.emit('loadCreationsMobile');
        // $('.side-mobile__creations__list').hide();
        $(this).addClass('side-mobile__toggler--creation--active');
        $('#side-mobile-general-links').hide();
        $('#side-mobile-creations-links').show();
    });

    $('#mobile-general-menu-toggle').on('click', function() {
        resetMobileMenu();
    });

    $('.side-mobile__creations__title').on('click', function() {
        if (!$(this).is("a")) {
            let menuList = $(this).parent().find('.side-mobile__creations__list');
            if (menuList.hasClass('side-mobile__creations__list--hidden')) {
                menuList.removeClass('side-mobile__creations__list--hidden');
                menuList.addClass('side-mobile__creations__list--visible');
                $(this).parent().find('.side-mobile__creations__title__svg').addClass('side-mobile__creations__title__svg--open');
                $(this).addClass('side-mobile__creations__title--active');
            } else {
                menuList.removeClass('side-mobile__creations__list--visible');
                menuList.addClass('side-mobile__creations__list--hidden');
                $(this).parent().find('.side-mobile__creations__title__svg').removeClass('side-mobile__creations__title__svg--open');
                $(this).removeClass('side-mobile__creations__title--active');
            }
        }
    });
});