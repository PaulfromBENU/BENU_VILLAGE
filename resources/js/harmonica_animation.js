let harmonicaStatus = 'off';
let columnClicked = 'off';
let currentCol;

function closeHarmonica() {
    $('.harmonica-menu').fadeOut();
    $('.harmonica-bar').removeClass('harmonica-bar--active');
    harmonicaStatus = 'off';
    if (columnClicked == 'on') {
        $('.harmonica-menu__content__col__open').fadeOut();
        $('.harmonica-menu__content__col__closed').fadeIn();
        if ($(window).width() < 1081) {
            $('.harmonica-menu__content__col').css('height', '12.5%');
        } else {
            $('.harmonica-menu__content__col').css('width', '12.5%');
        }
    }
}

$(function() {
    $('.harmonica-bar').on('click', function() {
        if (harmonicaStatus == 'off') {
            //show full screen harmonica and use active class to keep top bar dark
            $('.harmonica-menu').fadeIn();
            $('.harmonica-bar').addClass('harmonica-bar--active');
            harmonicaStatus = 'on';
        } else {
            closeHarmonica();
        }
    });
    $('.harmonica-bar__close').on('click', function() {
        closeHarmonica();
    });
    $('.harmonica-bar__title--active').on('click', function() {
        closeHarmonica();
    });

    $(document).on('keyup',function(e) {
        if (e.keyCode == 27) {
           if (harmonicaStatus == 'on') {
                closeHarmonica();
            }
        }
    });

    //Display on click, column gets wider/higher on click if set in CSS -----------------
    $('.harmonica-menu__content__col').on('click', function() {
        if (currentCol != this) {
            if (columnClicked == 'on') {
                if ($(window).width() < 1081) {
                    $('.harmonica-menu__content__col__open').hide();
                    $('.harmonica-menu__content__col__closed').show();
                    $('.harmonica-menu__content__col').css('height', '12.5%');
                } else {
                    $('.harmonica-menu__content__col__open').fadeOut();
                    $('.harmonica-menu__content__col__closed').fadeIn();
                    $('.harmonica-menu__content__col').css('width', '12.5%');
                }
            }
            currentCol = this;

            if ($(window).width() < 1081) {
                $('.harmonica-menu__content__col__closed', currentCol).hide();
                $('.harmonica-menu__content__col__open', currentCol).show();
                columnClicked = 'on';
                let newHeight = $(this).children('.harmonica-menu__content__col__open').css('height');
                $(currentCol).css('height', newHeight);
            } else {
                $(currentCol).css('width', '43%');
                $('.harmonica-menu__content__col__closed', currentCol).fadeOut(400, function() {
                    $('.harmonica-menu__content__col__open', currentCol).fadeIn();
                    columnClicked = 'on';
                });
            }
        } else if (columnClicked == 'off') {
            currentCol = this;
            
            if ($(window).width() < 1081) {
                $('.harmonica-menu__content__col__closed', currentCol).hide();
                $('.harmonica-menu__content__col__open', currentCol).show();
                columnClicked = 'on';
                let newHeight = $(this).children('.harmonica-menu__content__col__open').css('height');
                $(currentCol).css('height', newHeight);
            } else {
                $(currentCol).css('width', '43%');
                $('.harmonica-menu__content__col__closed', currentCol).fadeOut(400, function() {
                    $('.harmonica-menu__content__col__open', currentCol).fadeIn();
                    columnClicked = 'on';
                });
            }
        } else {
            if ($(window).width() < 1081) {
                $('.harmonica-menu__content__col__open').hide();
                $('.harmonica-menu__content__col__closed').show();
                $('.harmonica-menu__content__col').css('height', '12.5%');
            } else {
                $('.harmonica-menu__content__col__open').fadeOut();
                $('.harmonica-menu__content__col__closed').fadeIn();
                $('.harmonica-menu__content__col').css('width', '12.5%');
            }
            columnClicked = 'off';
        }
    });
});