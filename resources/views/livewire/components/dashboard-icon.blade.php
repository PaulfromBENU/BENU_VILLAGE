<li class="tablet-hidden">
    <a href="{{ route('dashboard', ['section' => 'overview']) }}" class="relative header__main-menu__icons__btn" id="dashboard-btn">
        @svg('benu-icon-silhouette-disconnect')
        @if($counter > 0)
            <div class="header__main-menu__icons__btn__cart-counter">
                {{ $counter }}
            </div>
        @endif
    </a>
</li>