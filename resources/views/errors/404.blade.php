@php
	if(strpos(url()->full(), 'fr/') !== false) {
		app()->setLocale('fr');
	} elseif(strpos(url()->full(), 'en/') !== false) {
		app()->setLocale('en');
	} elseif(strpos(url()->full(), 'de/') !== false) {
		app()->setLocale('de');
	} elseif(strpos(url()->full(), 'lu/') !== false) {
		app()->setLocale('lu');
	} else {
		app()->setLocale('en');
	}
@endphp

@extends('layouts.error_page_layout')

@section('title')
	{{ __('welcome.error-seo-title') }}
@endsection

@section('description')
	{{ __('welcome.error-seo-description') }}
@endsection

@section('main-content')
	<section class="text-center text-3xl pt-10 error-page">
		<div style="padding-top: 10vh;">
			<h2>
				<!-- {{ __('welcome.error-404-1') }} -->
				Wooops! 404 error...
			</h2>
			<h1>
				<!-- {{ __('welcome.error-404-2') }} -->
				This page does not exist.
			</h1>
		</div>
		<div class="text-center">
			@svg('error_picture')
		</div>
	</section>
@endsection

@section('scripts')

@endsection
