@extends('layouts.base_layout')

@section('title')
    {{ __('auth.password-forgotten-seo-title') }}
@endsection

@section('description')
    {{ __('auth.password-forgotten-seo-description') }}
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
        <h3 class="login__subtitle">BENU</h3>
        @if(session('status') == null)
        <h1 class="login__title">{{ __('auth.password-forgotten-title-1') }} <br/>{{ __('auth.password-forgotten-title-2') }}</h1>

        <form method="POST" action="{{ route('password.email', ['locale' => app()->getLocale()]) }}" class="login__forgotten-form m-auto mb-10">
            @csrf
            <div class="input-group reactive-label-input">
                <label for="email">{{ __('auth.password-forgotten-email') }} *</label>
                <input type="email" id="email" name="email" class="input-underline w-full" required>
            </div>

            <p class="login__info">
                <em>* {{ __('auth.password-forgotten-mandatory-fields') }}</em>
            </p>
            
            <div class="m-auto login__validate">
                <input type="submit" name="login_submit" class="btn-couture-plain" value="{{ __('auth.password-forgotten-update-password-btn') }}">
                <div class="login__validate__question">
                    {{ __('auth.password-forgotten-no-account-yet') }}
                </div>
                <a href="{{ route('register-'.app()->getLocale()) }}" class="btn-slider-left mt-3">{{ __('auth.password-forgotten-create-account') }}</a>
            </div>
            @if($errors->any())
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif
        </form>
        @else
        <h1 class="login__title">{{ __('auth.password-forgotten-email-info-1') }} <br/>{{ __('auth.password-forgotten-email-info-2') }}</h1>

        <p class="font-medium w-5/6 md:w-4/5 lg:w-1/2 m-auto">
            <!-- Dans cet e-mail, tu trouveras un lien sécurisé, valable une heure, qui te permettra de choisir un nouveau mot de passe. Si tu ne voies pas l'e-mail dans ta boite de réception, vérifie qu'il n'a pas atterri par erreur dans ton courrier indésirable&nbsp;! -->
            {{ __('auth.password-forgotten-email-info-3') }}
        </p>
        @endif
    </section>
@endsection

@section('scripts')

@endsection



