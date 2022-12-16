// $(function() {
//     let i = 1;
//     let j = 1;
//     setInterval(function() {
//         if (i < 5) {
//             j = i + 1;
//         } else {
//             j = 1;
//         }
//         $('.welcome-illustration-' + i).fadeOut(300, function() {
//             $('.welcome-presentation__desc__bar__btn').removeClass('--active');
//             $('.welcome-illustration-btn-' + j).addClass('--active');
//             $('.welcome-illustration-' + j).fadeIn();
//             i = j;
//         });
//     }, 4000);

//     $('.welcome-presentation__desc__bar__btn').on('click', function() {
//         let index = $('.welcome-presentation__desc__bar__btn').index(this);
//         index ++;
//         $('.welcome-presentation__desc__bar__btn').removeClass('--active');
//         $(this).addClass('--active');
//         $('.welcome-illustration-' + i).fadeOut(300, function() {
//             i = index;
//             $('.welcome-illustration-' + i).fadeIn();
//         });
//     });
// });

function animateWelcomePres(i) {
    $('.welcome-presentation__desc__link').hide();
    $('.welcome-presentation__desc__link').eq(i).fadeIn('slow');

    $('.welcome-presentation__desc__title').hide();
    $('.welcome-presentation__desc__title').eq(i).fadeIn('slow');

    $('.welcome-presentation__desc__text').hide();
    $('.welcome-presentation__desc__text').eq(i).fadeIn('slow');
    
    $('.welcome-presentation__img').hide();
    $('.welcome-presentation__img').eq(i).fadeIn('slow');

    $('.welcome-presentation__desc__bar__btn').removeClass('--active');
    $('.welcome-presentation__desc__bar__btn').eq(i).addClass('--active');
}

$(function() {
    let i = 1;
    let welcomeAnimation = setInterval(function() {
        animateWelcomePres(i);
        if (i < 4) {
            i++;
        } else {
            i = 0;
        }
    }, 10000);

    $('.welcome-presentation__desc__bar__btn').on('click', function() {
        let index = $('.welcome-presentation__desc__bar__btn').index(this);
        //Upon click, stop current animation, and restart from new selected menu
        clearInterval(welcomeAnimation);
        animateWelcomePres(index);
        if (index < 4) {
            i = index + 1;
        } else {
            i = 0;
        }
        // welcomeAnimation = setInterval(function() {
        // animateWelcomePres(i);
        // if (i < 4) {
        //         i++;
        //     } else {
        //         i = 0;
        //     }
        // }, 10000);
    });
});