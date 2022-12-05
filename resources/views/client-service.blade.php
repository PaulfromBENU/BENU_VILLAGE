@extends('layouts.base_layout')

@section('title')
	{{ __('services.seo-title') }}
@endsection

@section('description')
	{{ __('services.seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
<!-- 			<a href="{{ route('client-service-'.app()->getLocale()) }}">{{ __('breadcrumbs.client-service') }}</a>
			<div class="pl-5 pr-5">
				>
			</div> -->
			@switch($page)
				@case(__('slugs.services-contact'))
					<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="primary-color"><strong>{{ __('breadcrumbs.contact') }}</strong></a>
					@break

				@default
					<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="primary-color"><strong>{{ __('breadcrumbs.contact') }}</strong></a>
					@break
			@endswitch
		</div>
	</div>
@endsection

@section('main-content')
	@switch($page)
		@case(__('slugs.services-contact'))
			@include('includes.services.contact')
			@break

		@default
			@include('includes.services.contact')
			@break
	@endswitch
@endsection

@section('scripts')
<script type="text/javascript">
	$(function() {
		$('.service__nav__link').on('click', function() {
			$('.service__nav__link').removeClass('service__nav__link--active');
			$(this).addClass('service__nav__link--active');
		});
	});
</script>
<script type="text/javascript">
	$(function() {
		$('.service__nav__arrow--left').on('click', function() {
			let leftPos = $('.service__nav').scrollLeft();
   			$(".service__nav").animate({scrollLeft: leftPos - 100}, 'fast');
		});
		$('.service__nav__arrow--right').on('click', function() {
			let leftPos = $('.service__nav').scrollLeft();
   			$(".service__nav").animate({scrollLeft: leftPos + 100}, 'fast');
		});
	});
</script>

@switch($page)
	@case(__('slugs.services-delivery'))
	<script type="text/javascript">
		$(function() {
			// Menu automatic activation on scroll
		 	let optionsTop = $('#delivery-chapter-options').offset().top;
		 	let costTop = $('#delivery-chapter-fees').offset().top;
		 	let boxesTop = $('#delivery-chapter-boxes').offset().top;
		 	let delayTop = $('#delivery-chapter-delay').offset().top;

		 	let currentScrollPos = $(window).scrollTop();
		 	activateDeliverySideMenu(currentScrollPos, optionsTop, costTop, boxesTop, delayTop);

		 	$(window).on('scroll', function() {
		 		currentScrollPos = $(window).scrollTop();
		 		activateDeliverySideMenu(currentScrollPos, optionsTop, costTop, boxesTop, delayTop);
		 	});
		});

		function activateDeliverySideMenu(topPos, pos1, pos2, pos3, pos4)
		{
			let windowHeight = $(window).height();
			if (topPos < pos1 - windowHeight / 2 - 50) {
	 			$('.delivery-menu-link').removeClass('btn-slider-left--active');
	 		} else if(topPos < pos2 - windowHeight / 2 - 50) {
	 			$('.delivery-menu-link').removeClass('btn-slider-left--active');
	 			$('#delivery-chapter-options-link').addClass('btn-slider-left--active');
	 		} else if(topPos < pos3 - windowHeight / 2 - 50) {
	 			$('.delivery-menu-link').removeClass('btn-slider-left--active');
	 			$('#delivery-chapter-fees-link').addClass('btn-slider-left--active');
	 		} else if(topPos < pos4 - windowHeight / 2 - 50) {
	 			$('.delivery-menu-link').removeClass('btn-slider-left--active');
	 			$('#delivery-chapter-boxes-link').addClass('btn-slider-left--active');
	 		} else {
	 			$('.delivery-menu-link').removeClass('btn-slider-left--active');
	 			$('#delivery-chapter-delay-link').addClass('btn-slider-left--active');
	 		}
		}
	</script>
	@break

	@case(__('slugs.services-sizes'))
	<script type="text/javascript">
		$(function() {
			// Menu automatic activation on scroll
		 	let unisexTop = $('#sizes-chapter-unisex').offset().top;
		 	let ladiesTop = $('#sizes-chapter-ladies').offset().top;
		 	let gentlemenTop = $('#sizes-chapter-gentlemen').offset().top;
		 	let kidsTop = $('#sizes-chapter-kids').offset().top;

		 	let currentScrollPos = $(window).scrollTop();
		 	activateSizesSideMenu(currentScrollPos, unisexTop, ladiesTop, gentlemenTop, kidsTop);

		 	$(window).on('scroll', function() {
		 		currentScrollPos = $(window).scrollTop();
		 		activateSizesSideMenu(currentScrollPos, unisexTop, ladiesTop, gentlemenTop, kidsTop);
		 	});
		});

		function activateSizesSideMenu(topPos, pos1, pos2, pos3, pos4)
		{
			let windowHeight = $(window).height();
			if (topPos < pos1 - windowHeight / 2 - 50) {
	 			$('.sizes-menu-link').removeClass('btn-slider-left--active');
	 		} else if(topPos < pos2 - windowHeight / 2 - 50) {
	 			$('.sizes-menu-link').removeClass('btn-slider-left--active');
	 			$('#sizes-chapter-unisex-link').addClass('btn-slider-left--active');
	 		} else if(topPos < pos3 - windowHeight / 2 - 50) {
	 			$('.sizes-menu-link').removeClass('btn-slider-left--active');
	 			$('#sizes-chapter-ladies-link').addClass('btn-slider-left--active');
	 		} else if(topPos < pos4 - windowHeight / 2 - 50) {
	 			$('.sizes-menu-link').removeClass('btn-slider-left--active');
	 			$('#sizes-chapter-gentlemen-link').addClass('btn-slider-left--active');
	 		} else {
	 			$('.sizes-menu-link').removeClass('btn-slider-left--active');
	 			$('#sizes-chapter-kids-link').addClass('btn-slider-left--active');
	 		}
		}
	</script>
	@break

	@case(__('slugs.services-return'))
	<script type="text/javascript">
		$(function() {
			// Menu automatic activation on scroll
		 	let articleTop = $('#return-chapter-article').offset().top;
		 	let voucherTop = $('#return-chapter-voucher').offset().top;
		 	let refundTop = $('#return-chapter-refund').offset().top;
		 	let claimTop = $('#return-chapter-reclamations').offset().top;

		 	let currentScrollPos = $(window).scrollTop();
		 	activateReturnSideMenu(currentScrollPos, articleTop, voucherTop, refundTop, claimTop);

		 	$(window).on('scroll', function() {
		 		currentScrollPos = $(window).scrollTop();
		 		activateReturnSideMenu(currentScrollPos, articleTop, voucherTop, refundTop, claimTop);
		 	});
		});

		function activateReturnSideMenu(topPos, pos1, pos2, pos3, pos4)
		{
			let windowHeight = $(window).height();
			if (topPos < pos1 - windowHeight / 2 - 50) {
	 			$('.return-menu-link').removeClass('btn-slider-left--active');
	 		} else if(topPos < pos2 - windowHeight / 2 - 50) {
	 			$('.return-menu-link').removeClass('btn-slider-left--active');
	 			$('#return-chapter-aricle-link').addClass('btn-slider-left--active');
	 		} else if(topPos < pos3 - windowHeight / 2 - 50) {
	 			$('.return-menu-link').removeClass('btn-slider-left--active');
	 			$('#return-chapter-voucher-link').addClass('btn-slider-left--active');
	 		} else if(topPos < pos4 - windowHeight / 2 - 50) {
	 			$('.return-menu-link').removeClass('btn-slider-left--active');
	 			$('#return-chapter-refund-link').addClass('btn-slider-left--active');
	 		} else {
	 			$('.return-menu-link').removeClass('btn-slider-left--active');
	 			$('#return-chapter-reclamations-link').addClass('btn-slider-left--active');
	 		}
		}
	</script>
	@break

	@default
		@break
@endswitch
@endsection