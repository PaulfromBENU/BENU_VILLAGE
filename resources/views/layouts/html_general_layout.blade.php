<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Social networks data -->
        @yield('og-metadata-top')

        <!-- Page title and description -->
        <title>@yield('title-top') | BENU COUTURE</title>
        <meta charset="utf-8" name="description" content="@yield('description-top')">

        <!-- Search Engines visibility -->
        <meta name="robots" content="@yield('robots-behaviour-top')" />
        <meta name="keywords" content="@yield('seo-keywords-top')" />

        <!-- Fonts -->
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">  -->

        <!-- Favicon -->
        <link rel="mask-icon" href="{{ asset('static/favicon/safari-pinned-tab.svg') }}" color="#f9941d">
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('media/favicon/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('media/favicon/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('media/favicon/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('media/favicon/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('media/favicon/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('media/favicon/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('media/favicon/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('media/favicon/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicon/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('media/favicon/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('media/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('media/favicon/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('media/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('media/favicon/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('media/favicon/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">

        <!-- Styles -->
        <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
        <link rel="stylesheet" href="{{ asset('css/tailwindcss.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
        @yield('more-styles')

        <!-- Font awesome icons -->
        <script src="https://kit.fontawesome.com/983b1bd0fa.js" crossorigin="anonymous"></script>

        <!-- Livewire Styles -->
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Google Data -->
    </head>

    <body class="antialiased overflow-x-hidden">
        @if(App::environment() == 'stage')
            @if(session('stage_checked') == null)
                <form method="POST" action="{{ route('stage-access', ['locale' => app()->getLocale()]) }}" class="stage-check flex flex-col justify-center" style="width: 100vw; height: 100vh; background: white; position: fixed; z-index: 1000;">
                    @csrf
                    <div>
                        @if(session('msg') !== null)
                        <div class="flex flex-col justify-center">
                            <p class="text-center primary-color mb-5">
                                {{ session('msg') }}
                            </p>
                        </div>
                        @endif
                        <div class="m-auto mb-4 text-center">
                            <label>Enter the stage password to access the stage server:</label><br/><br/>
                            <input type="password" name="stage_password" placeholder="Stage password here" required>
                        </div>
                        <div class="m-auto text-center">
                            <input type="submit" name="stage_sumbit" value="Confirm" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">
                        </div>
                    </div>
                </form>
            @endif
        @endif
        <div class="min-h-screen">
            <!-- Page header -->
            @yield('header')

            <!-- Modals -->
            @yield('modals')

            <div class="content-wrapper">
                <!-- Page Content -->
                <main>
                    @yield('main-content-top')
                </main>

                <!-- Footer -->
                @yield('footer')

                <!-- Sticky bottom nav bar for mobiles -->
                <div class="welcome-mobile-nav mobile-only flex justify-around">
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="inline-block welcome-mobile-nav__link">
                        <button class="header__main-menu__icons__btn">
                            @svg('benu-couture-mobile-home', '')
                        </button>
                        <p>
                            {!! __('welcome.nav-home') !!}
                        </p>
                    </a>
                    <a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}" class="inline-block welcome-mobile-nav__link">
                        <button class="header__main-menu__icons__btn">
                            @guest
                                @svg('benu-icon-silhouette-connect')
                            @else
                                @svg('benu-icon-silhouette-disconnect')
                            @endguest
                        </button>
                        <p>
                            {!! __('welcome.nav-account') !!}
                        </p>
                    </a>
                    @livewire('components.cart-mobile-icon')
                </div>

                <!-- Side menu for mobile -->
                @include('includes.layout.side_mobile')
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        @livewireScripts
        @yield('scripts-top')
    </body>
</html>
