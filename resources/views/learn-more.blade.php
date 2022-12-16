@extends('layouts.base_layout')

@section('title')
	{{ __('campaigns.seo-title') }}
@endsection

@section('description')
	{{ __('campaigns.seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('learn-more-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.learn-more') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
<section class="w-11/12 xl:w-3/5 m-auto full-story">
	<h2 class="full-story__subtitle">{{ __('campaigns.full-toptitle') }}</h2>
	<h1 class="full-story__title">{{ __('campaigns.full-title') }}</h1>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-0-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-0-2') }}
	</p>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-0-3') }}
	</p>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-0-4') }}
	</p>

	<h3 class="full-story__lowtitle">{{ __('campaigns.full-subtitle-1') }}</h3>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-1-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-1-2') }}
	</p>

	<ul class="full-story__bullets">
		<li>{{ __('campaigns.full-paragraph-1-3') }}</li>
		<li>{{ __('campaigns.full-paragraph-1-4') }}</li>
		<li>{{ __('campaigns.full-paragraph-1-5') }}</li>
		<li>{{ __('campaigns.full-paragraph-1-6') }}</li>
	</ul>

	<h3 class="full-story__lowtitle">{{ __('campaigns.full-paragraph-1-7') }}</h3>

	<p class="full-story__txt">
		{{ __('campaigns.full-subtitle-2') }}
	</p>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-2-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-2-2') }} <a href="https://www.benucouture.lu" target="_blank" rel="noreferrer">{{ __('campaigns.full-paragraph-2-link-1') }}</a> {{ __('campaigns.full-paragraph-2-3') }}
	</p>

	<ul class="full-story__bullets">
		<li>{{ __('campaigns.full-paragraph-2-4') }} <a href="https://www.benusloow.lu">{{ __('campaigns.full-paragraph-2-link-2') }}</a></li>
		<li>{{ __('campaigns.full-paragraph-2-5') }}</li>
		<li>{{ __('campaigns.full-paragraph-2-6') }}</li>
		<li>{{ __('campaigns.full-paragraph-2-7') }}</li>
	</ul>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-2-8') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" rel="noreferrer">{{ __('campaigns.full-paragraph-2-link-3') }}</a>
	</p>

	<h3 class="full-story__lowtitle">{{ __('campaigns.full-subtitle-3') }}</h3>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-3-1') }}
	</p>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-3-2') }}
	</p>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-3-3') }}
	</p>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-3-4') }}
	</p>

	<ul class="full-story__bullets">
		<li>{{ __('campaigns.full-paragraph-3-5') }}</li>
		<li>{{ __('campaigns.full-paragraph-3-6') }}</li>
		<li>{{ __('campaigns.full-paragraph-3-7') }}</li>
		<li>{{ __('campaigns.full-paragraph-3-8') }}</li>
	</ul>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-3-9') }}
	</p>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-3-10') }}
	</p>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-3-11') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" rel="noreferrer">{{ __('campaigns.full-paragraph-3-link-1') }}</a>
	</p>

	<p class="full-story__txt">
		{{ __('campaigns.full-paragraph-3-12') }}
	</p>
	
</section>
@endsection

@section('scripts')

@endsection