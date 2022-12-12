@extends('layouts.base_layout')

@section('title')
	{{ __('news.all-seo-title') }}
@endsection

@section('description')
	{{ __('news.all-seo-desc') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start flex-wrap">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('news-all-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.news') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<div class="text-center all-news w-2/3 md:w-3/4 lg:w-2/3 m-auto">
		<h1 class="all-news__subtitle">{{ __('news.all-subtitle') }}</h1>
		<h2 class="all-news__title">{{ __('news.all-title') }}</h2>

		<p class="text-center font-medium">
			{{ __('news.all-explanation') }}
		</p>

		@livewire('news.tag-filters')

		@livewire('news.all-news')
	</div>
@endsection

@section('scripts')

@endsection