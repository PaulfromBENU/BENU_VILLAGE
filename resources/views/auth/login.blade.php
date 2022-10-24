@extends('layouts.base_layout')

@section('title')
    {{ __('auth.login-seo-title') }}
@endsection

@section('description')
    {{ __('auth.login-seo-desc') }}
@endsection

@section('breadcrumbs')
    <div class="breadcrumbs pattern-bg">
        <div class="benu-container breadcrumbs__content flex justify-start">
            <a href="{{ route('home') }}">{{ __('breadcrumbs.home') }}</a>
            <div class="pl-5 pr-5">
                >
            </div>
            <a href="{{ route('login-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.login') }}</strong></a>
        </div>
    </div>
@endsection

@section('main-content')
    <section class="benu-container login">
        <h3 class="login__subtitle">BENU COUTURE</h3>
        <h1 class="login__title">{{ __('auth.login-title-1') }} <br/>{{ __('auth.login-title-2') }}</h1>

        <form method="POST" action="{{ route('login.connect', ['locale' => app()->getLocale()]) }}" class="w-full lg:w-1/4 m-auto mb-10">
            @csrf
            <div class="input-group reactive-label-input">
                <label for="login_email">{{ __('auth.login-email') }} *</label>
                <input type="email" id="login_email" name="email" class="input-underline w-full" required>
            </div>
            <div class="input-group reactive-label-input">
                <label for="login_password">{{ __('auth.login-password') }} *</label>
                <input type="password" id="login_password" name="password" class="input-underline w-full" required>
            </div>

            <div class="flex justify-between flex-wrap flex-col lg:flex-row">
                <!-- Remember Me -->
                <div class="login__options">
                    <input id="remember" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm" name="remember" value="1" checked>
                    <label for="remember" class="inline-flex items-center">
                        <span class="ml-3">{{ __('auth.login-remember-me') }}</span>
                    </label>
                </div>

                <div class="flex items-center lg:justify-end login__options">
                    <a class="hover:underline" href="{{ route('password.request-'.app()->getLocale()) }}">
                        {{ __('auth.login-pwd-forgotten') }}
                    </a>
                </div>
            </div>

            <p class="login__info">
                <em>* {{ __('auth.login-mandatory') }}</em>
            </p>
            
            <div class="m-auto login__validate">
                <input type="submit" name="login_submit" class="btn-couture-plain" value="{{ __('auth.login-connect') }}">
                <div class="login__validate__question">
                    {!! __('auth.login-no-account') !!}
                </div>
                <a href="{{ route('register-'.app()->getLocale()) }}" class="btn-slider-left mt-3">{{ __('auth.login-create-account') }}</a>
            </div>
            @if($errors->any())
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif
        </form>
    </section>
@endsection

@section('scripts')

@endsection

