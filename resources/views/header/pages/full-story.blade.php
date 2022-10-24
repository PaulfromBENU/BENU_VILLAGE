@extends('layouts.base_layout')

@section('title')
	{{ __('about.full-story-seo-title') }}
@endsection

@section('description')
	{{ __('about.full-story-seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('full-story-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.full-story') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
<section class="w-11/12 xl:w-3/5 m-auto full-story">
	<h2 class="full-story__subtitle">{{ __('about.full-toptitle') }}</h2>
	<h1 class="full-story__title">{{ __('about.full-title') }}</h1>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-0-1') }}
	</p>

	<h3 class="full-story__highlight">{{ __('about.full-paragraph-0-2') }}</h3>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-0-3') }}
	</p>
	<p class="full-story__txt">
		{{ __('about.full-paragraph-0-4') }}
	</p>
	<p class="full-story__txt">
		{{ __('about.full-paragraph-0-5') }}
	</p>

	<h3 class="full-story__lowtitle">{{ __('about.full-subtitle-1') }}</h3>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-1-1') }} <a href="https://global-standard.org/" target="_blank" rel="noreferrer">global-standard.org</a> {{ __('about.full-paragraph-1-2') }} <a href="https://naturtextil.de/en/home/" target="_blank" rel="noreferrer">naturtextil.de</a> {{ __('about.full-paragraph-1-3') }}
	</p>

	<h3 class="full-story__lowtitle">{{ __('about.full-subtitle-2') }}</h3>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-2-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-2-2') }}
	</p>

	<h3 class="full-story__lowtitle">{{ __('about.full-subtitle-3') }}</h3>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-3-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-3-2') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-3-3') }}
	</p>

	<h3 class="full-story__lowtitle--2">{{ __('about.full-subtitle-4') }}</h3>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-4-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-4-2') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-4-3') }}
	</p>

	<h3 class="full-story__lowtitle">{{ __('about.full-subtitle-5') }}</h3>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-5-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-5-2') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-5-3') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-5-4') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-5-5') }}
	</p>

	<p class="full-story__txt">
		{{ __('about.full-paragraph-5-6') }} <a href="{{ route('about-'.app()->getLocale()) }}" target="_blank">{{ __('about.full-paragraph-5-7') }}</a>. {{ __('about.full-paragraph-5-8') }} (<a href="https://benu.lu" target="_blank" rel="noreferrer">benu.lu</a>).
	</p>
</section>
@endsection

@section('scripts')
@endsection