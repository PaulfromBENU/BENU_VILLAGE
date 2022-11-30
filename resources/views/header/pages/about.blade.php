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
<section class="w-11/12 xl:w-3/5 m-auto full-story">
	<h2 class="full-story__subtitle">{{ __('about.toptitle') }}</h2>
	<h1 class="full-story__title">{{ __('about.title') }}</h1>

	<h3 class="full-story__lowtitle">{{ __('about.subtitle-1') }}</h3>

	<p class="full-story__txt">
		{{ __('about.paragraph-1-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.paragraph-1-2') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.paragraph-1-3') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.paragraph-1-4') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.paragraph-1-5') }}
	</p>

	<p class="full-story__txt">
		<a href="{{ route('learn-more-'.app()->getLocale()) }}" target="_blank" rel="noreferrer">{{ __('about.paragraph-1-link-4') }}</a> {{ __('about.paragraph-1-6') }}
	</p>

	<h3 class="full-story__lowtitle">{{ __('about.subtitle-2') }}</h3>

	<p class="full-story__txt">
		{{ __('about.paragraph-2-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.paragraph-2-2') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.paragraph-2-3') }}
	</p>

	<ul class="full-story__bullets">
		<li>{{ __('about.paragraph-2-4') }}</li>
		<li>{{ __('about.paragraph-2-5') }}</li>
		<li>{{ __('about.paragraph-2-6') }}</li>
		<li>{{ __('about.paragraph-2-7') }}</li>
	</ul>

	<h3 class="full-story__lowtitle">{{ __('about.subtitle-3') }}</h3>

	<p class="full-story__txt">
		{{ __('about.paragraph-3-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.paragraph-3-2') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.paragraph-3-3') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.paragraph-3-4') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.paragraph-3-5') }} <a href="https://www.facebook.com/benuvillageesch/" target="_blank" rel="noreferrer">{{ __('about.paragraph-3-link-1') }}</a> {{ __('about.paragraph-3-6') }} <a href="https://www.instagram.com/benu_village/" target="_blank" rel="noreferrer">{{ __('about.paragraph-3-link-2') }}</a>, {{ __('about.paragraph-3-7') }} <a href="{{ route('newsletter-'.app()->getLocale()) }}" target="_blank" rel="noreferrer">{{ __('about.paragraph-3-link-3') }}</a>. {{ __('about.paragraph-3-8') }}
	</p>

</section>
@endsection

@section('scripts')

@endsection