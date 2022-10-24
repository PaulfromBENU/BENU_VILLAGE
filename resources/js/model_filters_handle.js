function filtersHandle(filter) {
	$('.all-models__filters__filter img').css('transform', 'rotate(0deg)');
	$('.all-models__filters-container__options').children('div').hide();
	$('#filters-' + filter).show();
	$('#filter-' + filter).children('img').css('transform', 'rotate(180deg)');
	$('.all-models__filters-container__options').fadeIn();
}

$(function() {
	$('#filter-family').on('mouseover', function() {
		filtersHandle('family');
	});

	$('#filter-category').on('mouseover', function() {
		filtersHandle('category');
	});

	$('#filter-shops').on('mouseover', function() {
		filtersHandle('shops');
	});

	$('#filter-color').on('mouseover', function() {
		filtersHandle('color');
	});

	$('#filter-gender').on('mouseover', function() {
		filtersHandle('gender');
	});

	$('#filter-price').on('mouseover', function() {
		filtersHandle('price');
	});

	$('#filter-partners').on('mouseover', function() {
		filtersHandle('partners');
	});

	$('#filter-order').on('mouseover', function() {
		filtersHandle('order');
	});

	$('#filter-size').on('mouseover', function() {
		filtersHandle('size');
	});

	$('.all-models__filters-container__options').on('mouseleave', function() {
		$(this).hide();
		$('.all-models__filters-container__options').children('div').hide();
		$('.all-models__filters__filter img').css('transform', 'rotate(0deg)');
	})

	$('.all-models__filters__filter').on('click', function(e) {
		if ($('.all-models__filters-container__options').css('display') == 'none') {
			$('.all-models__filters-container__options').fadeIn();
			e.stopPropagation();
		} else {
			$('.all-models__filters-container__options').fadeOut();
			$('.all-models__filters__filter img').css('transform', 'rotate(0deg)');
		}
	});

	$(document).on('click', function(e) {
		if ($('.all-models__filters-container__options').css('display') != 'none') {
			$('.all-models__filters-container__options').fadeOut();
			$('.all-models__filters__filter img').css('transform', 'rotate(0deg)');
		}
	});
});