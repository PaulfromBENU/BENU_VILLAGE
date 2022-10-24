@extends('layouts.base_layout')

@section('title')
	{{ __('footer.general-infos-seo-title') }}
@endsection

@section('description')
	{{ __('footer.general-infos-seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('footer.general-info-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.general-infos') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<section class="footer-info w-4/5 lg:w-1/2 m-auto">
		<h3 class="footer-info__subtitle">{{ __('footer.general-info-subtitle') }}</h3>
		<h1 class="footer-info__title">{{ __('footer.general-info-title') }}</h1>
		<p class="footer-info__paragraph">
			{{ __('footer.general-info-txt-1') }}
		</p>
		
		<div>
			<img src="{{ asset('media/pictures/general-infos-picture-under-construction.png') }}" style="width: 100%;" />
		</div>
	</section>
@endsection

@section('scripts')
@endsection