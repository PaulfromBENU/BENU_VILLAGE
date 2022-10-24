function activateInputsDynamicBehaviour()
{
	let labelColorSearch = $('.search-modal label').css('color');

	// On page load, reduce labels size if input is not empty
	// if ($('.connect-modal input[type=password]').val() != '') {
	// 	$(".connect-modal label[for='" + $('.connect-modal input[type=password]').attr('id') + "']").css('top', '-10px').css('transform', 'scale(0.75)').css('color', 'grey');
	// }
	// if ($('.connect-modal input[type=text]').val() != '') {
	// 	$(".connect-modal label[for='" + $('.connect-modal input[type=text]').attr('id') + "']").css('top', '-10px').css('transform', 'scale(0.75)').css('color', 'grey');
	// }
	$('.search-modal input[type=text]').val('');

	// Handle search label behaviour depending on input status
	$('.search-modal input[type=text]').on('focus', function() {
		$('.search-modal label').css('top', '30px').css('transform', 'scale(0.75)').css('color', 'darkgray');
	})
	$('.search-modal input[type=text]').on('blur', function() {
		if ($(this).val() == '') {
			$('.search-modal label').css('top', '60px').css('transform', 'scale(1)').css('color', labelColorSearch);
		}
	});

	// Handle connect label behaviour depending on input status
	// $('.connect-modal input[type=text]').on('focus', function() {
	// 	$(".connect-modal label[for='" + $(this).attr('id') + "']").css('top', '-10px').css('transform', 'scale(0.75)').css('color', 'grey');
	// })
	// $('.connect-modal input[type=text]').on('blur', function() {
	// 	if ($(this).val() == '' && $('.connect-modal input[type=password]').val() == '') {
	// 		$(".connect-modal label").css('top', '3px').css('transform', 'scale(1)').css('color', labelColorSearch);
	// 	}
	// });

	// $('.connect-modal input[type=password]').on('focus', function() {
	// 	$(".connect-modal label[for='" + $(this).attr('id') + "']").css('top', '-10px').css('transform', 'scale(0.75)').css('color', 'grey');
	// })
	// $('.connect-modal input[type=password]').on('change', function() {
	// 	$(".connect-modal label[for='" + $(this).attr('id') + "']").css('top', '-10px').css('transform', 'scale(0.75)').css('color', 'grey');
	// })
	// $('.connect-modal input[type=password]').on('blur', function() {
	// 	if ($(this).val() == '') {
	// 		$(".connect-modal label[for='" + $(this).attr('id') + "']").css('top', '3px').css('transform', 'scale(1)').css('color', labelColorSearch);
	// 	}
	// });



	let labelColorSearchReactive = $('.reactive-label-input label').css('color');
	//Generic dynamic label handle using the reactive-label-input class
	$('.reactive-label-input label').each(function() {
		if ($(this).parent().children('input').val().length == 0) {
			if ($(this).parent().hasClass('reactive-label-input--white')) {
				$(this).css('transform', 'scale(1)').css('bottom', '9px').css('color', 'white');
			} else {
				$(this).css('transform', 'scale(1)').css('bottom', '9px').css('color', labelColorSearchReactive);
			}
		} else {
			if ($(this).parent().hasClass('reactive-label-input--white')) {
				$(this).css('transform', 'scale(0.75)').css('bottom', '35px').css('color', 'white');
			} else {
				$(this).css('transform', 'scale(0.75)').css('bottom', '35px').css('color', 'darkgray');
			}
		}
	});

	$('.reactive-label-input input').on('focus', function() {
		if ($(this).parent().hasClass('reactive-label-input--white')) {
			$(this).parent().children('label').css('transform', 'scale(0.75)').css('bottom', '35px').css('color', 'white');
		} else {
			$(this).parent().children('label').css('transform', 'scale(0.75)').css('bottom', '35px').css('color', 'darkgray');
		}
	});
	$('.reactive-label-input input').on('blur', function() {
		if($(this).val().length == 0) {
			if ($(this).parent().hasClass('reactive-label-input--white')) {
				$(this).parent().children('label').css('transform', 'scale(1)').css('bottom', '9px').css('color', 'white');
			} else {
				$(this).parent().children('label').css('transform', 'scale(1)').css('bottom', '9px').css('color', labelColorSearchReactive);
			}
		}
	});
	$('.reactive-label-input input').on('change', function() {
		if($(this).val().length > 0) {
			if ($(this).parent().hasClass('reactive-label-input--white')) {
				$(this).parent().children('label').css('transform', 'scale(0.75)').css('bottom', '35px').css('color', 'white');
			} else {
				$(this).parent().children('label').css('transform', 'scale(0.75)').css('bottom', '35px').css('color', 'darkgray');
			}
		}
	});

	$('.reactive-label-input input').eq(0).focus();

	//Show or hide password on icon click
	$('.reactive-label-input__show-btn--show').on('click', function() {
		$(this).hide();
		$(this).parent().children('.reactive-label-input__show-btn--hide').show();
		$(this).parent().children('input[type="password"]').attr('type', 'text');
	});
	$('.reactive-label-input__show-btn--hide').on('click', function() {
		$(this).hide();
		$(this).parent().children('.reactive-label-input__show-btn--show').show();
		$(this).parent().children('input[type="text"]').attr('type', 'password');
	});
}

$(function() {
	activateInputsDynamicBehaviour();

	Livewire.on('activateInputs', function() {
		activateInputsDynamicBehaviour();
	});
});