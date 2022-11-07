<header class="header-group">
    <div class="header benu-container flex">
        <div id="mobile-menu-btn" class="mobile-only header__hamburger">
            <button>
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <a class="header__logo-container" href="{{ route('home', [app()->getLocale()]) }}">
            @svg('logo_benu_village', 'header__logo header__logo--desktop')
            <img src="{{ asset('media/svg/benu-icon-menu-scroll.svg') }}" class="header__logo header__logo--scroll">
            <img src="{{ asset('media/svg/benu-icon-menu-scroll.svg') }}" class="header__logo header__logo--mobile">
        </a>
        <div class="header__menus-container">
            <div class="flex justify-between header__top-menu tablet-hidden">
                <nav class="header__top-nav flex justify-start">
                    <div>
                        <a href="{{ route('home', [app()->getLocale()]) }}" class="header__home-title">BENU VILLAGE</a>
                    </div>
                    <ul class="flex justify-start header__top-nav__links tablet-hidden">
                        
                    </ul>
                </nav>
                <div class="header__newsletter-btn">
                    @guest
                    <a href="{{ route('newsletter-'.app()->getLocale()) }}" class="header__newsletter-btn__link">
                        {{ __('header.newsletter') }}
                    </a>
                    @else
                        @if(auth()->user()->newsletter < 2)
                        <a href="{{ route('newsletter-'.app()->getLocale()) }}" class="header__newsletter-btn__link">
                            {{ __('header.newsletter') }}
                        </a>
                        @else
                        <a href="{{ route('newsletter-'.app()->getLocale()) }}" class="header__newsletter-btn__link">
                            {{ __('header.newsletter-unsubscribe') }}
                        </a>
                        @endif
                    @endguest
                </div>
            </div>
            <div class="flex justify-between header__main-menu">
                <nav class="header__main-nav flex justify-start tablet-hidden">
                    <!-- ƒ -->

                    <a href="{{ route('header.participate-'.app()->getLocale()) }}" class="header__main-nav__link @if(Route::currentRouteName() == 'header.participate-'.app()->getLocale()) header__main-nav__link--active @endif">
                        {{ __('header.participate') }}
                    </a>

                    <a href="{{ route('news-'.app()->getLocale()) }}" class="header__main-nav__link @if(Route::currentRouteName() == 'news-'.app()->getLocale()) header__main-nav__link--active @endif">
                        {{ __('header.news') }}
                    </a>

                    <a href="{{ route('about-'.app()->getLocale()) }}" class="header__main-nav__link @if(Route::currentRouteName() == 'about-'.app()->getLocale()) header__main-nav__link--active @endif">{{ __('header.about') }}</a>
                </nav>
                <nav class="mobile-only">
                    <div>
                        <a href="{{ route('home', [app()->getLocale()]) }}" class="header__home-title">BENU VILLAGE</a>
                    </div>
                </nav>
                <ul class="header__main-menu__icons flex justify-end">
                    @if(1 == 0)
                    <li>
                        <button class="header__main-menu__icons__btn" id="general-search-btn">
                            @svg('benu-icon-magnifying-glass-search')
                        </button>
                    </li>
                    @endif
                    @auth
                        <li class="tablet-hidden">
                            <a href="{{ route('dashboard', ['locale' => app()->getLocale(), 'section' => 'wishlist']) }}" class="header__main-menu__icons__btn">
                                @svg('benu-icon-heart-favorites', '')
                            </a>
                        </li>
                    @endauth
                    @guest
                        <li class="tablet-hidden">
                            <a class="header__main-menu__icons__btn" id="connect-btn">
                                @svg('benu-icon-silhouette-connect')
                            </a>
                        </li>
                    @else
                        @livewire('components.dashboard-icon')
                    @endguest
                    <li class="tablet-hidden">
                        <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="header__main-menu__icons__btn">
                            @svg('benu-icon-mail-contact')
                        </a>
                    </li>
                    <li class="header__main-menu__icons__lang-container">
                        <button class="header__main-menu__icons__lang-btn" id="lang-selector">
                            {{ strtoupper(app()->getLocale()) }}
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
