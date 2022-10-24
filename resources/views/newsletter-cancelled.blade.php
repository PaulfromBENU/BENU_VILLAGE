@extends('layouts.base_layout')

@section('title')
    {{ __('auth.newsletter-cancelled-seo-title') }}
@endsection

@section('description')
    {{ __('auth.newsletter-cancelled-seo-desc') }}
@endsection

@section('breadcrumbs')
    <div class="breadcrumbs pattern-bg">
        <div class="benu-container breadcrumbs__content flex justify-start">
            <a href="{{ route('home') }}">{{ __('breadcrumbs.home') }}</a>
            <div class="pl-5 pr-5">
                >
            </div>
            <a href="{{ route('newsletter-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.newsletter-subscribe') }}</strong></a>
        </div>
    </div>
@endsection

@section('main-content')
    <section class="benu-container login" style="min-height: 60vh;">
        <h3 class="login__subtitle">{{ __('auth.newsletter-unsubscribe-newsletter') }}</h3>

        <h1 class="login__title">{{ __('auth.newsletter-unsubscribe-pending') }}</h1>

        <p class="w-1/2 m-auto text-center">
            {{ __('auth.newsletter-unsubscribe-details') }}
        </p>
    </section>
@endsection

@section('scripts')

@endsection