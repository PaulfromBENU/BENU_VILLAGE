<a href="{{ route('cart-'.app()->getLocale()) }}" class="inline-block welcome-mobile-nav__link">
    <button class="header__main-menu__icons__btn">
        @svg('benu-icon-bag-cart')
        @if($counter > 0)
            <div class="header__main-menu__icons__btn__cart-counter">
                {{ $counter }}
            </div>
        @endif
    </button>
    <p>
        {!! __('welcome.nav-cart') !!}
    </p>
</a>