@extends('layouts.base_layout')

@section('title')
	{{ __('about.seo-title') }}
@endsection

@section('description')
	{{ __('about.seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('about-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.about') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
<section class="w-full m-auto about mb-2">
	<h2 class="w-11/12 lg:w-full m-auto about__subtitle">{{ __('about.subtitle-top') }}</h2>
	<h1 class="w-11/12 lg:w-full m-auto about__title">{{ __('about.title-top') }}</h1>

	<ul class="service__nav flex justify-between mobile-only" style="border-bottom: solid 1px lightgrey; overflow: hidden; max-width: min(90vw, 380px); margin: auto; margin-bottom: 40px;">
		<!-- <li class="service__nav__arrow service__nav__arrow--left">
			@svg('chevron-down')
		</li> -->
		<li>
			<button class="service__nav__link" onclick="document.getElementById('about-chapter-creations').scrollIntoView({ behavior: 'smooth', block: 'center' });">{{ __('about.side-menu-1') }}</button>
		</li>
		<li>
			<button class="service__nav__link" onclick="document.getElementById('about-chapter-services').scrollIntoView({ behavior: 'smooth', block: 'center' });">{{ __('about.side-menu-2') }}</button>
		</li>
		<li>
			<button class="service__nav__link" onclick="document.getElementById('about-chapter-team').scrollIntoView({ behavior: 'smooth', block: 'center' });">{{ __('about.side-menu-3') }}</button>
		</li>
		<li>
			<button class="service__nav__link" onclick="document.getElementById('about-chapter-materials').scrollIntoView({ behavior: 'smooth', block: 'center' });">{{ __('about.side-menu-4') }}</button>
		</li>
		<!-- <div class="service__nav__arrow service__nav__arrow--right mobile-only">
			@svg('chevron-down')
		</div> -->
	</ul>

	<h3 id="about-chapter-creations" class="about__section-title w-11/12 lg:w-full m-auto">
		{{ __('about.section-title-1') }}
	</h3>

	<div class="about__general flex justify-between">
		<div class="about__general__menu-container mobile-hidden tablet-hidden">
			<div class="about__general__menu-container__menu">
				<ul>
					<li>
						<button id="about-chapter-creations-link" class="about-menu-link btn-slider-left text-lg font-bold" onclick="document.getElementById('about-chapter-creations').scrollIntoView({ behavior: 'smooth', block: 'center' });">{{ __('about.side-menu-1') }}</button>
					</li>
					<li>
						<button id="about-chapter-services-link" class="about-menu-link btn-slider-left text-lg font-bold" onclick="document.getElementById('about-chapter-services').scrollIntoView({ behavior: 'smooth', block: 'center' });">{{ __('about.side-menu-2') }}</button>
					</li>
					<li>
						<button id="about-chapter-team-link" class="about-menu-link btn-slider-left text-lg font-bold" onclick="document.getElementById('about-chapter-team').scrollIntoView({ behavior: 'smooth', block: 'center' });">{{ __('about.side-menu-3') }}</button>
					</li>
					<li>
						<button id="about-chapter-materials-link" class="about-menu-link btn-slider-left text-lg font-bold" onclick="document.getElementById('about-chapter-materials').scrollIntoView({ behavior: 'smooth', block: 'center' });">{{ __('about.side-menu-4') }}</button>
					</li>
				</ul>
			</div>
		</div>

		<div class="about__general__content">
			<div class="benu-container">
				<div class="about__general__content__slider">	
					<div class="about__general__content__slider__cards flex justify-start">
						@for($i = 1; $i <= 11; $i++)
						<div class="about__general__content__slider__cards__card" @if($i == 1) id="slider-card-1" @endif>
							<img src="{{ asset('media/pictures/about/about-slider-'.$i.'.jpg') }}" />
							<div class="about__general__content__slider__cards__card__footer flex justify-start">
								<div class="flex flex-col justify-center">
									<p class="about__general__content__slider__cards__card__footer--number">
										{{ $i }}
									</p>
								</div>
								<div class="about__general__content__slider__cards__card__footer--txt flex flex-col justify-center">
									<p>
										{{ __('about.card-txt-'.$i) }}
									</p>
								</div>
							</div>
						</div>
						@endfor
					</div>
				</div>
				<div class="about__general__content__slider__bar flex justify-between">
					<div class="flex justify-center lg:justify-start w-full lg:w-1/5">
						<div class="about__general__content__slider__bar__btn about__general__content__slider__bar__btn--left">
							@svg('chevron-down', 'about__general__content__slider__bar__svg')
						</div>
						<div class="about__general__content__slider__bar__btn about__general__content__slider__bar__btn--right">
							@svg('chevron-down', 'about__general__content__slider__bar__svg')
						</div>
					</div>
					<div class="about__general__content__slider__bar__scroll w-4/5 mobile-hidden">
						<div class="absolute about__general__content__slider__bar__scroll--red"></div>
					</div>
				</div>
			</div>


			<h3 id="about-chapter-services" class="about__section-title">
				{{ __('about.section-title-2') }}
			</h3>
			<div class="about__general__content__info-section">
				<div class="about__general__content__info-section__picture">
					<img src="{{ asset('media/pictures/about/about-transition-1.jpg') }}">
				</div>
				<div class="about__general__content__info-section__txt">
					<h4>{{ __('about.section-2-subtitle-1') }}</h4>

					<p class="about__general__content__info-section__txt__paragraph">
						{{ __('about.section-2-txt-1') }}
					</p>

					<div class="flex flex-col md:flex-row justify-start md:justify-between flex-wrap mb-10">
						<div class="w-full md:w-2/5 mb-5 md:mb-0">
							<img src="{{ asset('media/pictures/about/about-content-1.jpg') }}">
						</div>
						<div class="w-full md:w-3/5 md:pl-5">
							<h5>
								{{ __('about.section-2-lowtitle-1') }}
							</h5>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-2-txt-2-1') }}
							</p>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-2-txt-2-2') }}
							</p>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-2-txt-2-3') }} <a href="https://couture.benu.lu/fr/creations" class="primary-color hover:text-gray-800 transition" target="_blank" rel="noreferrer">{{ __('about.section-2-txt-2-link-1') }}</a> {{ __('about.section-2-txt-2-4') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-shops')]) }}" class="primary-color hover:text-gray-800 transition" target="_blank" rel="noreferrer">{{ __('about.section-2-txt-2-link-2') }}</a> {{ __('about.section-2-txt-2-5') }}
							</p>
						</div>
					</div>

					<div class="flex flex-col-reverse md:flex-row justify-start md:justify-between flex-wrap pt-10">
						<div class="w-full md:w-3/5 pr-5">
							<h4>{{ __('about.section-2-subtitle-2') }}</h4>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-2-txt-3-1') }}
							</p>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-2-txt-3-2') }}
							</p>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-2-txt-3-3') }} <a onclick="document.getElementById('about-sub-menu-1').scrollIntoView({ behavior: 'smooth', block: 'center' });" class="primary-color hover:text-gray-800 transition" style="cursor: pointer;">{{ __('about.section-2-txt-3-link') }}</a>
							</p>
						</div>
						<div class="w-full md:w-2/5 mb-5 md:mb-0">
							<img src="{{ asset('media/pictures/about/about-content-2.jpg') }}">
						</div>
					</div>
				</div>

				<div class="about__general__content__info-section__transition">
					<img src="{{ asset('media/pictures/about/about-transition-2.jpg') }}">
				</div>

				<div class="about__general__content__info-section__txt">
					<h4>{{ __('about.section-2-subtitle-3') }}</h4>

					<p class="about__general__content__info-section__txt__paragraph">
						{{ __('about.section-2-txt-4-1') }}
					</p>
					<p class="about__general__content__info-section__txt__paragraph">
						{{ __('about.section-2-txt-4-2') }}
					</p>

					<div class="flex flex-col md:flex-row justify-start md:justify-between flex-wrap mb-10">
						<div class="w-full md:w-2/5 mb-5 md:mb-0">
							<img src="{{ asset('media/pictures/about/about-content-3.jpg') }}">
						</div>
						<div class="w-full md:w-3/5 md:pl-5">
							<h4>{{ __('about.section-2-subtitle-4') }}</h4>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-2-txt-5-1') }}
							</p>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-2-txt-5-2') }}
							</p>
						</div>
					</div>

					<h4 id="about-sub-menu-1">{{ __('about.section-2-subtitle-5') }}</h4>

					<p class="about__general__content__info-section__txt__paragraph">
						{{ __('about.section-2-txt-6') }}
					</p>

					<p class="about__general__content__info-section__txt__paragraph">
						{{ __('about.section-2-txt-7') }}
					</p>

					<p class="about__general__content__info-section__txt__highlight">
						{{ __('about.section-2-txt-8') }}
					</p>

					<p class="about__general__content__info-section__txt__paragraph">
						{{ __('about.section-2-txt-9') }}
					</p>

					<p class="about__general__content__info-section__txt__paragraph">
						{{ __('about.section-2-txt-10') }}
					</p>

					<p class="text-center mb-10">
						<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" rel="noreferrer" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">{{ __('about.section-2-btn-contact') }}</a>
					</p>
					
				</div>
			</div>


			<h3 id="about-chapter-team" class="about__section-title w-4/5 lg:w-full m-auto">
				{{ __('about.section-title-3') }}
			</h3>


			<div class="about__general__content__info-section">
				<div class="about__general__content__info-section__picture">
					<img src="{{ asset('media/pictures/about/about-transition-3.jpg') }}">
				</div>
				<div class="about__general__content__info-section__txt">
					<p class="about__general__content__info-section__txt__paragraph">
						{{ __('about.section-3-txt-1') }}
					</p>

					<p class="w-full md:w-4/5 lg:w-1/2 m-auto text-center mb-10">
						<img src="{{ asset('media/pictures/about/about-content-4.jpg') }}">
					</p>

					<div class="flex flex-col md:flex-row justify-start md:justify-between flex-wrap mb-10">
						<div class="w-full md:w-1/3 mb-5 md:mb-0">
							<img src="{{ asset('media/pictures/about/about-content-5.jpg') }}">
						</div>
						<div class="w-full md:w-2/3 md:pl-5">
							<h5>
								{{ __('about.section-3-lowtitle-0') }}
							</h5>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-3-txt-2-1') }}
							</p>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-3-txt-2-2') }}
							</p>
						</div>
					</div>

					<div class="flex flex-col-reverse lg:flex-row justify-start lg:justify-between flex-wrap pt-10">
						<div class="w-full lg:w-1/2 pr-5">
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-3-txt-3-1') }}
							</p>
							<h5>
								{{ __('about.section-3-lowtitle-1') }}
							</h5>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-3-txt-3-2') }}
							</p>
							<p class="about__general__content__info-section__txt__paragraph" style="margin-bottom: 10px;">
								{{ __('about.section-3-txt-3-3') }}
							</p>
						</div>
						<div class="w-full md:w-3/5 lg:w-1/2 mb-5 lg:mb-0 about__general__content__info-section__txt__section-3-img">
							<img src="{{ asset('media/pictures/about/about-content-6.jpg') }}">
						</div>
					</div>
					<div id="materials"></div>
					<p class="text-center mt-4 mb-10">
						<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" rel="noreferrer" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">{{ __('about.section-3-btn-contact') }}</a>
					</p>
				</div>
			</div>



			<h3 id="about-chapter-materials" class="about__section-title w-4/5 lg:w-full m-auto">
				{{ __('about.section-title-4') }}
			</h3>


			<div class="about__general__content__info-section">
				<div class="about__general__content__info-section__picture">
					<img src="{{ asset('media/pictures/about/about-transition-4.jpg') }}" style="width: 100%;">
				</div>

				<div class="about__general__content__info-section__txt">
					<p class="about__general__content__info-section__txt__paragraph">
						{{ __('about.section-4-txt-1') }}
					</p>
					<p class="about__general__content__info-section__txt__paragraph">
						{{ __('about.section-4-txt-1-bis') }}
					</p>
					<p class="about__general__content__info-section__txt__paragraph">
						{{ __('about.section-4-txt-2') }}
					</p>
					<p class="about__general__content__info-section__txt__paragraph">
						{{ __('about.section-4-txt-2-bis') }}
					</p>
				</div>
				<div class="about__general__content__info-section__txt">
					<div class="flex flex-col md:flex-row justify-start md:justify-between flex-wrap mb-10">
						<div class="w-full md:w-2/5 mb-5 md:mb-0">
							<img src="{{ asset('media/pictures/about/about-content-7.jpg') }}">
						</div>
						<div class="w-full md:w-3/5 md:pl-5">
							<h5>
								{{ __('about.section-4-lowtitle-1') }}
							</h5>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-4-txt-1-1') }} <a href="https://www.spendchen.lu" target="_blank" rel="noreferrer" class="primary-color hover:text-gray-800 transition">{{ __('about.section-4-link-1') }}</a> {{ __('about.section-4-txt-1-1-end') }}
							</p>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-4-txt-1-2') }} <a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-give')]) }}#collect-points" target="_blank" rel="noreferrer" class="primary-color hover:text-gray-800 transition">{{ __('about.section-4-link-2') }}</a> {{ __('about.section-4-txt-1-2-end') }}
							</p>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-4-txt-1-3') }} <a href="https://couture.benu.lu/fr/campagnes-politiques/carte-blanche" target="_blank" rel="noreferrer" class="primary-color hover:text-gray-800 transition">{{ __('about.section-4-link-3') }}</a>
							</p>
						</div>
					</div>

					<div class="flex flex-col-reverse md:flex-row justify-start md:justify-between flex-wrap pt-10 mb-10">
						<div class="w-full md:w-1/2 pr-5">
							<h5>
								{{ __('about.section-4-lowtitle-2') }}
							</h5>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-4-txt-2-1') }}
							</p>
						</div>
						<div class="w-full md:w-1/2 mb-5 md:mb-0">
							<img src="{{ asset('media/pictures/about/about-content-8.jpg') }}">
						</div>
					</div>

					<div class="flex flex-col md:flex-row justify-start md:justify-between flex-wrap mb-10">
						<div class="w-full md:w-2/5 mb-5 md:mb-0">
							<img src="{{ asset('media/pictures/about/about-content-9.png') }}">
						</div>
						<div class="w-full md:w-3/5 md:pl-5">
							<h5>
								{{ __('about.section-4-lowtitle-3') }}
							</h5>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-4-txt-3-1') }}
							</p>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-4-txt-3-2') }}
							</p>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-4-txt-3-3') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" rel="noreferrer" class="primary-color hover:text-gray-800 transition">{{ __('about.section-4-link-4') }}</a>
							</p>
							<p class="about__general__content__info-section__txt__paragraph">
								{{ __('about.section-4-txt-3-4') }}
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>
@endsection

@section('scripts')
<script type="text/javascript">
	$(function() {
		$('.about__general__content__slider').animate({scrollLeft: 0}, 'fast');
		$('.about__general__content__slider__bar__scroll--red').css('left', 0);

		$('.about__general__content__slider__bar__btn--right').on('click', function(e) {
			if (!$('.about__general__content__slider').is(':animated')) {
				let leftPos = $('.about__general__content__slider').scrollLeft();
				let fullSliderWidth = $('.about__general__content__slider').get(0).scrollWidth - $('.about__general__content__slider').width();
				if ($(window).width() > 768) {
	  				$('.about__general__content__slider').animate({scrollLeft: leftPos + fullSliderWidth / 4}, 'fast');
	  			} else {
	  				$('.about__general__content__slider').animate({scrollLeft: leftPos + fullSliderWidth / 10}, 'fast');
	  			}

	  			let leftPosScroll = parseInt($('.about__general__content__slider__bar__scroll--red').css('left'));
	  			let fullBarWidth = $('.about__general__content__slider__bar__scroll').width();
	  			let redBarWidth = fullBarWidth / 4;
	  			if ($(window).width() > 768) {
		  			if (leftPosScroll >= (3 * redBarWidth - 20)) {//Margin to avoid bugs
		  				$('.about__general__content__slider__bar__scroll--red').css('left', fullBarWidth * 0.75);
		  			}
		  		} //else {
		  		// 	if (leftPosScroll >= (5 / 2 * redBarWidth - 20)) {//Margin to avoid bugs
		  		// 		$('.about__general__content__slider__bar__scroll--red').css('left', fullBarWidth * 0.75);
		  		// 	} else {
		  		// 		$('.about__general__content__slider__bar__scroll--red').css('left', leftPosScroll + fullBarWidth / 9);
		  		// 	}
		  		// }
	  		}
	 	});

	 	$('.about__general__content__slider__bar__btn--left').on('click', function(e) {
	 		if (!$('.about__general__content__slider').is(':animated')) {
				let leftPos = $('.about__general__content__slider').scrollLeft();
	  			let fullSliderWidth = $('.about__general__content__slider').get(0).scrollWidth - $('.about__general__content__slider').width();

	  			if ($(window).width() > 768) {
	  				$('.about__general__content__slider').animate({scrollLeft: leftPos - fullSliderWidth / 4}, 'fast');
	  			} else {
	  				$('.about__general__content__slider').animate({scrollLeft: leftPos - fullSliderWidth / 10}, 'fast');
	  			}

	  			let leftPosScroll = $('.about__general__content__slider__bar__scroll--red').position().left;
	  			let fullBarWidth = $('.about__general__content__slider__bar__scroll').width();
	  			let redBarWidth = fullBarWidth / 4;
	  			// console.log(leftPosScroll, $('.about__general__content__slider__bar__scroll').width());
	  			if (leftPosScroll >= (fullBarWidth / 4) + 20) {
	  				// $('.about__general__content__slider__bar__scroll--red').animate({left: leftPosScroll - fullBarWidth / 4}, 'fast');
	  			} else {
	  				$('.about__general__content__slider__bar__scroll--red').css('left', 0);
	  			}
	  		}
	 	});

	 	$('.about__general__content__slider').on('scroll', function(e) {
	 		let leftPos = $('.about__general__content__slider').scrollLeft();
			let fullSliderWidth = $('.about__general__content__slider').get(0).scrollWidth - $('.about__general__content__slider').width();
			let ratio = leftPos / fullSliderWidth;

			if ($(window).width() > 768) {
 				$('.about__general__content__slider__bar__scroll--red').css('left', $('.about__general__content__slider__bar__scroll').width() * ratio * 0.75);
 			}

	 	})

	 	// Menu automatic activation on scroll
	 	let creationsTop = $('#about-chapter-creations').offset().top;
	 	let servicesTop = $('#about-chapter-services').offset().top;
	 	let teamTop = $('#about-chapter-team').offset().top;
	 	let materialsTop = $('#about-chapter-materials').offset().top;

	 	let currentScrollPos = $(window).scrollTop();
	 	activateAboutSideMenu(currentScrollPos, creationsTop, servicesTop, teamTop, materialsTop);

	 	$(window).on('scroll', function() {
	 		currentScrollPos = $(window).scrollTop();
	 		activateAboutSideMenu(currentScrollPos, creationsTop, servicesTop, teamTop, materialsTop);
	 	});
	});

	function activateAboutSideMenu(topPos, pos1, pos2, pos3, pos4)
	{
		let windowHeight = $(window).height();
		if (topPos < pos1 - windowHeight / 2 - 50) {
 			$('.about-menu-link').removeClass('btn-slider-left--active');
 		} else if(topPos < pos2 - windowHeight / 2 - 50) {
 			$('.about-menu-link').removeClass('btn-slider-left--active');
 			$('#about-chapter-creations-link').addClass('btn-slider-left--active');
 		} else if(topPos < pos3 - windowHeight / 2 - 50) {
 			$('.about-menu-link').removeClass('btn-slider-left--active');
 			$('#about-chapter-services-link').addClass('btn-slider-left--active');
 		} else if(topPos < pos4 - windowHeight / 2 - 50) {
 			$('.about-menu-link').removeClass('btn-slider-left--active');
 			$('#about-chapter-team-link').addClass('btn-slider-left--active');
 		} else {
 			$('.about-menu-link').removeClass('btn-slider-left--active');
 			$('#about-chapter-materials-link').addClass('btn-slider-left--active');
 		}
	}
</script>
@endsection