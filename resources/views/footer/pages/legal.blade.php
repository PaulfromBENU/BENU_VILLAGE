@extends('layouts.base_layout')

@section('title')
	{{ __('footer.legal-seo-title') }}
@endsection

@section('description')
	{{ __('footer.legal-seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('footer.legal-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.legal-mentions') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<section class="footer-legal w-4/5 lg:w-1/2 m-auto">
		<h3 class="footer-legal__subtitle">{{ __('footer.legal-subtitle') }}</h3>
		<h1 class="footer-legal__title">{{ __('footer.legal-title') }}</h1>
		<p class="footer-legal__paragraph">
			{{ __('footer.legal-txt-1') }} <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">couture.benu.lu</a> {{ __('footer.legal-txt-12') }}.
		</p>
		<p class="footer-legal__paragraph">
			{{ __('footer.legal-txt-3') }}
		</p>
		<p class="footer-legal__highlight">
			{{ __('footer.legal-highlight-1') }}
		</p>
		<p class="footer-legal__paragraph">
			{{ __('footer.legal-txt-4') }}
		</p>
		<p class="footer-legal__paragraph">
			{{ __('footer.legal-txt-5') }}
		</p>
		<p class="footer-legal__paragraph">
			{{ __('footer.legal-txt-6') }} <a href="{{ route('footer.general-conditions-'.app()->getLocale()) }}">{{ __('footer.legal-txt-general-conditions') }}</a> {{ __('footer.legal-txt-7') }} <a href="{{ route('footer.policy-'.app()->getLocale()) }}">{{ __('footer.legal-txt-data-protection') }}</a> {{ __('footer.legal-txt-8') }}.
		</p>
	</section>
@endsection

@section('scripts')
@endsection