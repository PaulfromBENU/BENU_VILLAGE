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
			<a href="{{ route('header.participate-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.participate') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
<section class="w-11/12 xl:w-3/5 m-auto full-story">
	<h2 class="full-story__subtitle">{{ __('participate.toptitle') }}</h2>
	<h1 class="full-story__title">{{ __('participate.title') }}</h1>

	<p class="full-story__txt">
		{{ __('participate.paragraph-0-1') }}
	</p>

	<h3 class="full-story__lowtitle">{{ __('participate.subtitle-1') }}</h3>

	<p class="full-story__txt">
		{{ __('participate.paragraph-1-1') }} <a href="https://www.facebook.com/benuvillageesch/" target="_blank" rel="noreferrer">{{ __('participate.paragraph-1-link-1') }}</a>, <a href="https://www.instagram.com/benu_village/" target="_blank" rel="noreferrer">{{ __('participate.paragraph-1-link-2') }}</a>, {{ __('participate.paragraph-1-2') }} <a href="{{ route('newsletter-'.app()->getLocale()) }}" target="_blank" rel="noreferrer">{{ __('participate.paragraph-1-link-3') }}</a>. {{ __('participate.paragraph-1-3') }}
	</p>

	<p class="full-story__txt">
		{{ __('participate.paragraph-1-4') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" rel="noreferrer">{{ __('participate.paragraph-1-link-4') }}</a>
	</p>

	<h3 class="full-story__lowtitle">{{ __('participate.subtitle-2') }}</h3>

	<p class="full-story__txt">
		{{ __('participate.paragraph-2-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('participate.paragraph-2-2') }} <a href="{{ route('learn-more-'.app()->getLocale()) }}" target="_blank" rel="noreferrer">{{ __('participate.paragraph-2-link-1') }}</a> {{ __('participate.paragraph-2-3') }}
	</p>

	<p class="full-story__txt">
		{{ __('participate.paragraph-2-4') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" rel="noreferrer">{{ __('participate.paragraph-2-link-2') }}</a>
	</p>

	<h3 class="full-story__lowtitle">{{ __('participate.subtitle-3') }}</h3>

	<p class="full-story__txt">
		{{ __('participate.paragraph-3-1') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" rel="noreferrer">{{ __('participate.paragraph-3-link-1') }}</a>
	</p>

	<p class="full-story__txt">
		{{ __('participate.paragraph-3-2') }} <a href="https://www.facebook.com/benuvillageesch/" target="_blank" rel="noreferrer">{{ __('participate.paragraph-3-link-2') }}</a>, <a href="https://www.instagram.com/benu_village/" target="_blank" rel="noreferrer">{{ __('participate.paragraph-3-link-3') }}</a>, {{ __('participate.paragraph-3-3') }} <a href="{{ route('newsletter-'.app()->getLocale()) }}" target="_blank" rel="noreferrer">{{ __('participate.paragraph-3-link-4') }}</a>. {{ __('participate.paragraph-3-4') }}
	</p>

	<h3 class="full-story__lowtitle">{{ __('participate.subtitle-4') }}</h3>

	<p class="full-story__txt">
		{{ __('participate.paragraph-4-1') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" rel="noreferrer">{{ __('participate.paragraph-4-link-1') }}</a>
	</p>

	<p class="full-story__txt">
		{{ __('participate.paragraph-4-2') }} <a href="https://www.benureuse.lu/page/ich-mache-mit" target="_blank" rel="noreferrer">{{ __('participate.paragraph-4-link-2') }}</a> {{ __('participate.paragraph-4-3') }} <a href="https://couture.benu.lu/de/mitmachen" target="_blank" rel="noreferrer">{{ __('participate.paragraph-4-link-3') }}</a>
	</p>


	<h3 class="full-story__lowtitle">{{ __('participate.subtitle-5') }}</h3>

	<p class="full-story__txt">
		{{ __('participate.paragraph-5-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('participate.paragraph-5-2') }} <a href="{{ route('learn-more-'.app()->getLocale()) }}" target="_blank" rel="noreferrer">{{ __('participate.paragraph-5-link-1') }}</a> {{ __('participate.paragraph-5-3') }}
	</p>

	<p class="full-story__txt">
		{{ __('participate.paragraph-5-4') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" rel="noreferrer">{{ __('participate.paragraph-5-link-2') }}</a>
	</p>

	
	<h3 class="full-story__lowtitle">{{ __('participate.subtitle-6') }}</h3>

	<p class="full-story__txt">
		{{ __('participate.paragraph-6-1') }} <a href="https://www.benureuse.lu" target="_blank" rel="noreferrer">{{ __('participate.paragraph-6-link-1') }}</a> {{ __('participate.paragraph-6-2') }}
	</p>

	<p class="full-story__txt">
		{{ __('participate.paragraph-6-3') }} <a href="https://www.benureuse.lu" target="_blank" rel="noreferrer">{{ __('participate.paragraph-6-link-2') }}</a>
	</p>

	<p class="full-story__txt">
		{{ __('participate.paragraph-6-4') }} <a href="https://www.benucouture.lu" target="_blank" rel="noreferrer">{{ __('participate.paragraph-6-link-3') }}</a> {{ __('participate.paragraph-6-5') }} <a href="https://couture.benu.lu/de/mitmachen/kleider-spenden" target="_blank" rel="noreferrer">{{ __('participate.paragraph-6-link-4') }}</a>
	</p>

</section>
@endsection

@section('scripts')

@endsection