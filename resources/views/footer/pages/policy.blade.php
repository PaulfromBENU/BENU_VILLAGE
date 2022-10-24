@extends('layouts.base_layout')

@section('title')
	{{ __('footer.policy-seo-title') }}
@endsection

@section('description')
	{{ __('footer.policy-seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('footer.policy-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.policy-mentions') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<section class="footer-legal w-4/5 lg:w-1/2 m-auto">
		<h3 class="footer-legal__subtitle">{{ __('footer.policy-subtitle') }}</h3>
		<h1 class="footer-legal__title">{{ __('footer.policy-title') }}</h1>
		<p class="footer-legal__paragraph">
			{{ __('footer.policy-txt-1') }}
		</p>
		<p class="footer-legal__paragraph">
			{{ __('footer.policy-txt-2') }}
		</p>
		<p class="footer-legal__paragraph">
			{{ __('footer.policy-txt-3') }}
		</p>
		<p class="footer-legal__paragraph">
			{{ __('footer.policy-txt-4') }}
		</p>
		<p class="footer-legal__paragraph">
			{{ __('footer.policy-txt-5') }}
		</p>
	</section>
@endsection

@section('scripts')
@endsection