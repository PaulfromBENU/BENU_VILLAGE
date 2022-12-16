@extends('layouts.base_layout')

@section('title')
	{{ __('footer.sitemap-title') }}
@endsection

@section('description')
	{{ __('footer.sitemap-desc') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('footer.sitemap-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.sitemap') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<section class="sitemap">
		<div>
			<h1 class="sitemap__title">{{ __('footer.sitemap-title') }}</h1>
		</div>
		
		<div class="w-4/5 lg:w-1/2 m-auto">
			<ul>
				<li class="sitemap__list sitemap__list--large"><a href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('footer.sitemap-home') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('about-'.app()->getLocale()) }}">{{ __('footer.sitemap-about-us') }}</a></li>

				<!-- <li class="sitemap__list sitemap__list--large"><a href="{{ route('full-story-'.app()->getLocale()) }}">{{ __('footer.sitemap-full-story') }}</a></li> -->

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}">{{ __('footer.sitemap-client-service-contact') }}</a></li>
				

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('news-all-'.app()->getLocale()) }}">{{ __('footer.sitemap-all-news') }}</a></li>
				@php 
					$localized_slug = 'slug_'.app()->getLocale(); 
					$localized_title = 'title_'.app()->getLocale(); 
				@endphp
				@foreach($village_news as $single_village_news)
					<li class="sitemap__list sitemap__list--small">
						<a href="{{ route('news-'.app()->getLocale(), ['origin' => 'village', 'slug' => $single_village_news->$localized_slug]) }}">
							VILLAGE - <!-- {{ __('footer.sitemap-single-news') }} -->{{ $single_village_news->$localized_title }}
						</a>
					</li>
				@endforeach
				@foreach($couture_news as $single_couture_news)
					<li class="sitemap__list sitemap__list--small">
						<a href="{{ route('news-'.app()->getLocale(), ['origin' => 'couture', 'slug' => $single_couture_news->$localized_slug]) }}">
							COUTURE - <!-- {{ __('footer.sitemap-single-news') }} -->{{ $single_couture_news->$localized_title }}
						</a>
					</li>
				@endforeach

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('newsletter-'.app()->getLocale()) }}">{{ __('footer.sitemap-newsletter-subscribe') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('header.participate-'.app()->getLocale()) }}">{{ __('footer.sitemap-participate') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('footer.legal-'.app()->getLocale()) }}">{{ __('footer.sitemap-legal-mentions') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('footer.policy-'.app()->getLocale()) }}">{{ __('footer.sitemap-policy') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}">{{ __('footer.sitemap-dashboard') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('login-'.app()->getLocale()) }}">{{ __('footer.sitemap-login') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('register-'.app()->getLocale()) }}">{{ __('footer.sitemap-register') }}</a></li>
			</ul>
		</div>
	</section>
@endsection

@section('scripts')
@endsection