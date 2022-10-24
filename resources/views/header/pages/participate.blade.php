@extends('layouts.base_layout')

@section('title')
	{{ __('participate.seo-title') }}
@endsection

@section('description')
	{{ __('participate.seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('header.participate-'.app()->getLocale()) }}">{{ __('breadcrumbs.participate') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			@switch($page)
				@case(__('slugs.participate-badges'))
					<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-badges')]) }}" class="primary-color"><strong>{{ __('breadcrumbs.badges') }}</strong></a>
					@break

				@case(__('slugs.participate-give'))
					<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-give')]) }}" class="primary-color"><strong>{{ __('breadcrumbs.give-clothes') }}</strong></a>
					@break

				@case(__('slugs.participate-partnership'))
					<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-partnership')]) }}" class="primary-color"><strong>{{ __('breadcrumbs.participate-partnership') }}</strong></a>
					@break

				@case(__('slugs.participate-smart'))
					<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-smart')]) }}" class="primary-color"><strong>{{ __('breadcrumbs.participate-smart') }}</strong></a>
					@break

				<!-- @case(__('slugs.participate-sustainable'))
					<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-sustainable')]) }}" class="primary-color"><strong>{{ __('breadcrumbs.participate-sustainable') }}</strong></a>
					@break -->

				@default
					<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-badges')]) }}" class="primary-color"><strong>{{ __('breadcrumbs.badges') }}</strong></a>
					@break
			@endswitch
		</div>
	</div>
@endsection

@section('main-content')
	<div class="benu-container text-center participate">
		<h4 class="participate__subtitle">BENU COUTURE</h4>
		<h2 class="participate__title">{{ __('participate.main-title') }}</h2>
		<div class="participate__nav flex justify-start md:justify-center">
			<div class="participate__nav__arrow participate__nav__arrow--left mobile-only">
				@svg('chevron-down')
			</div>
			<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-badges')]) }}" class="participate__nav__link @if($page == '' || $page == __('slugs.participate-badges')) participate__nav__link--active @endif" id="participate-nav-faq">
				{{ __('participate.nav-badges') }}
			</a>
			<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-give')]) }}" class="participate__nav__link @if($page == __('slugs.participate-give')) participate__nav__link--active @endif" id="participate-nav-delivery">
				{{ __('participate.nav-give') }}
			</a>
			<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-partnership')]) }}" class="participate__nav__link @if($page == __('slugs.participate-partnership')) participate__nav__link--active @endif" id="participate-nav-sizes">
				{{ __('participate.nav-partnership') }}
			</a>
			<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-smart')]) }}" class="participate__nav__link @if($page == __('slugs.participate-smart')) participate__nav__link--active @endif" id="participate-nav-return">
				{{ __('participate.nav-smart') }}
			</a>
			<div class="participate__nav__arrow participate__nav__arrow--right mobile-only">
				@svg('chevron-down')
			</div>
		</div>
	</div>

	<div class="benu-container participate-section-container">
		@switch($page)
			@case(__('slugs.participate-badges'))
				@include('includes.participate.badges')
				@break

			@case(__('slugs.participate-give'))
				@include('includes.participate.give')
				@break

			@case(__('slugs.participate-partnership'))
				@include('includes.participate.partnership')
				@break

			@case(__('slugs.participate-smart'))
				@include('includes.participate.smart')
				@break

			<!-- @case(__('slugs.participate-sustainable'))
				@include('includes.participate.sustainable')
				@break -->

			@default
				@include('includes.participate.badges')
				@break
		@endswitch
	</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$(function() {
		$('.participate__nav__link').on('click', function() {
			$('.participate__nav__link').removeClass('participate__nav__link--active');
			$(this).addClass('participate__nav__link--active');
		});
	});
</script>
<script type="text/javascript">
	$(function() {
		$('.participate__nav__arrow--left').on('click', function() {
			let leftPos = $('.participate__nav').scrollLeft();
   			$(".participate__nav").animate({scrollLeft: leftPos - 100}, 'fast');
		});
		$('.participate__nav__arrow--right').on('click', function() {
			let leftPos = $('.participate__nav').scrollLeft();
   			$(".participate__nav").animate({scrollLeft: leftPos + 100}, 'fast');
		});
	});
</script>
@endsection