<header class="header-group-simplified">
    <div class="header-simplified benu-container flex">
        <a class="header-simplified__logo-container" href="{{ route('home', [app()->getLocale()]) }}">
            <img src="{{ asset('media/svg/logo_benu_village.svg') }}" class="header-simplified__logo header-simplified__logo--desktop">
            <img src="{{ asset('media/svg/benu-icon-menu-scroll.svg') }}" class="header-simplified__logo header-simplified__logo--scroll">
            <img src="{{ asset('media/svg/benu-icon-menu-scroll.svg') }}" class="header-simplified__logo header-simplified__logo--mobile">
        </a>
        <div class="header-simplified__menus-container flex flex-col justify-center">
            <div class="flex justify-between header-simplified__main-menu">
                <nav class="header-simplified__backlink flex justify-start">
                    <a href="{{ route('cart-'.app()->getLocale()) }}" class="primary-color flex">@svg('arrow_left', 'header-simplified__arrow-left') <span class="pt-1 lg:pt-0">{{ __('cart.modify-cart') }}</span></a>
                </nav>
                <ul class="header-simplified__main-menu__icons flex justify-end">
                    <li class="header-simplified__main-menu__icons__info mobile-hidden">
                        {{ __('cart.secure-payment') }}
                    </li>
                    @auth
                    <li class="header-simplified__main-menu__icons__connect">
                        <a href="{{ route('dashboard', ['section' => 'overview']) }}" class="header__main-menu__icons__btn" id="dashboard-btn">
                            @svg('benu-icon-silhouette-disconnect')
                        </a>
                    </li>
                    @endauth
                    <li class="header-simplified__main-menu__icons__locale">
                        <button class="header-simplified__main-menu__icons__lang-btn" id="lang-selector">
                            {{ strtoupper(app()->getLocale()) }}
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
