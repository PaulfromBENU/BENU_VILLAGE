@extends('layouts.base_layout')

@section('title')
    {{ __('auth.password-reset-seo-title') }}
@endsection

@section('description')
    {{ __('auth.password-reset-seo-description') }}
@endsection

@section('robots-behaviour')
noindex, nofollow
@endsection

@section('breadcrumbs')
    <div class="breadcrumbs pattern-bg">
        <div class="benu-container breadcrumbs__content flex justify-start">
            <a href="{{ route('home') }}">{{ __('breadcrumbs.home') }}</a>
            <div class="pl-5 pr-5">
                >
            </div>
            <a href="{{ route('password.request-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.forgotten-pwd') }}</strong></a>
        </div>
    </div>
@endsection

@section('main-content')
    <section class="benu-container login">
        <h3 class="login__subtitle">BENU COUTURE</h3>
        <h1 class="login__title">{{ __('auth.password-reset-title-1') }} <br/>{{ __('auth.password-reset-title-2') }}</h1>

        <form method="POST" action="{{ route('password.update', ['locale' => app()->getLocale()]) }}" class="w-1/4 m-auto mb-10">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="input-group reactive-label-input">
                <label for="email">{{ __('auth.password-reset-email') }} *</label>
                <input type="email" id="email" name="email" class="input-underline w-full" required>
            </div>
            <div class="input-group reactive-label-input">
                <label for="password">{{ __('auth.password-reset-new-password') }} *</label>
                <input type="password" id="password" name="password" class="input-underline w-full" required>
            </div>
            <div class="input-group reactive-label-input">
                <label for="password_confirmation">{{ __('auth.password-reset-new-password-conf') }} *</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="input-underline w-full" required>
            </div>

            <p class="login__info">
                <em>* {{ __('auth.password-reset-mandatory-fields') }}</em>
            </p>
            
            <div class="m-auto login__validate">
                <input type="submit" name="login_submit" class="btn-couture-plain" value="{{ __('auth.password-reset-update-password-info') }}">
            </div>
            @if($errors->any())
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif
        </form>
    </section>
@endsection


