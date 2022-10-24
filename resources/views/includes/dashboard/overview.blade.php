<div class="mobile-only w-5/6 m-auto">
    <h2 class="dashboard__nav__title">{{ __('dashboard.nav-hello') }}, <strong>{{ Auth::user()->first_name }}</strong></h2>

    <div class="w-full dashboard__content__box dashboard__content__box--large">
        <h4 class="dashboard__content__box__subtitle">
            {{ Auth::user()->first_name.' '.Auth::user()->last_name }} <br/>({!! __('dashboard.client-number') !!}: {{ Auth::user()->client_number }})
        </h4>
        <p>
            {{ __('dashboard.overview-member-since') }} {{ Auth::user()->created_at->format('d'.'/'.'m'.'/'.'Y') }}
        </p>
        <div class="flex justify-center lg:justify-start mt-5 dashboard__content__box__svg-container">
            @foreach($user_badges as $badge)
            @svg($badge->svg_file)
            @endforeach
        </div>
    </div>

    <ul class="dashboard__nav__links">
       <!--  <li>
            <a wire:click="changeSection('overview')" class="dashboard__nav__link-mobile">
                {{ __('dashboard.nav-overview') }}
            </a>
        </li> -->
        @if(auth::user()->role == 'admin')
        <li>
            <a href="{{ route('filament.pages.dashboard') }}" class="dashboard__nav__link-mobile" target="_blank">
                Admin Panel
            </a>
        </li>
        @endif
        <li>
            <a wire:click="changeSection('orders')" class="dashboard__nav__link-mobile">
                {{ __('dashboard.nav-orders') }}
            </a>
        </li>
        <li>
            <a wire:click="changeSection('communications')" class="dashboard__nav__link-mobile">
                {{ __('dashboard.nav-demands') }}
            </a>
        </li>
        <!-- <li>
            <a wire:click="changeSection('returns')" class="dashboard__nav__link-mobile">
                {{ __('dashboard.nav-returns') }}
            </a>
        </li> -->
        <li>
            <a wire:click="changeSection('wishlist')" class="dashboard__nav__link-mobile">
                {{ __('dashboard.nav-wishlist') }}
            </a>
        </li>
        <li>
            <a wire:click="changeSection('vouchers')" class="dashboard__nav__link-mobile">
                {{ __('dashboard.nav-vouchers') }}
            </a>
        </li>
        <li>
            <a wire:click="changeSection('addresses')" class="dashboard__nav__link-mobile">
                {{ __('dashboard.nav-addresses') }}
            </a>
        </li>
        <li>
            <a wire:click="changeSection('conditions')" class="dashboard__nav__link-mobile">
                {{ __('dashboard.nav-conditions') }}
            </a>
        </li>
        <li>
            <a wire:click="changeSection('details')" class="dashboard__nav__link-mobile">
                {{ __('dashboard.nav-details') }}
            </a>
        </li>
        <li>
            <a wire:click="changeSection('delete')" class="dashboard__nav__link-mobile">
                {{ __('dashboard.nav-delete') }}
            </a>
        </li>
    </ul>
</div>

<div class="dashboard__content__box dashboard__content__box--large tablet-hidden">
    <h3 class="dashboard__content__box__title">{{ __('dashboard.overview-title-1') }}</h3>
    <div class="w-2/3">
        <h4 class="dashboard__content__box__subtitle">
            {{ Auth::user()->first_name.' '.Auth::user()->last_name }} <br/>({!! __('dashboard.client-number') !!}: {{ Auth::user()->client_number }})
        </h4>
        <p>
            {{ __('dashboard.overview-member-since') }} {{ Auth::user()->created_at->format('d'.'/'.'m'.'/'.'Y') }}
        </p>
        <div class="flex justify-start mt-5 dashboard__content__box__svg-container">
            @foreach($user_badges as $badge)
            @svg($badge->svg_file)
            @endforeach
        </div>
    </div>
    <div class="w-1/3 dashboard__content__box__low-links">
        <div class="flex flex-col justify-end">
            <p>
                <a wire:click="changeSection('details')" class="btn-dashboard-plain">{{ __('dashboard.overview-account-details') }}</a>
            </p>
            <p>
                <a wire:click="changeSection('delete')" class="btn-dashboard-plain">{{ __('dashboard.overview-delete-account') }}</a>
            </p>
        </div>
    </div>
</div>
<div class="dashboard__content__box dashboard__content__box--normal tablet-hidden">
    <h3 class="dashboard__content__box__title">{{ __('dashboard.overview-title-2') }}</h3>
    <p>
        {{ __('dashboard.overview-update-address') }}
    </p>
    <p class="dashboard__content__box__bottom-link">
        <a wire:click="changeSection('addresses')" class="btn-dashboard-plain">{{ __('dashboard.overview-all-addresses') }}</a>
    </p>
</div>
<div class="dashboard__content__box dashboard__content__box--normal tablet-hidden">
    <h3 class="dashboard__content__box__title">{{ __('dashboard.overview-title-3') }}</h3>
    <p>
        {{ __('dashboard.overview-update-orders') }}
    </p>
    <p class="dashboard__content__box__bottom-link">
        <a wire:click="changeSection('orders')" class="btn-dashboard-plain">{{ __('dashboard.overview-all-orders') }}</a>
    </p>
</div>
<div class="dashboard__content__box dashboard__content__box--normal tablet-hidden">
    <h3 class="dashboard__content__box__title">{{ __('dashboard.overview-title-4') }}</h3>
    <p>
        {{ __('dashboard.overview-update-demands') }}
    </p>
    <p class="dashboard__content__box__bottom-link">
        <a wire:click="changeSection('communications')" class="btn-dashboard-plain">{{ __('dashboard.overview-all-demands') }}</a>
    </p>
</div>
<div class="dashboard__content__box dashboard__content__box--normal tablet-hidden">
    <h3 class="dashboard__content__box__title">{{ __('dashboard.overview-title-5') }}</h3>
    <p>
        {{ __('dashboard.overview-update-returns') }}
    </p>
    <p class="dashboard__content__box__bottom-link">
        <a wire:click="changeSection('returns')" class="btn-dashboard-plain">{{ __('dashboard.overview-all-returns') }}</a>
    </p>
</div>
<div class="dashboard__content__box dashboard__content__box--normal tablet-hidden">
    <h3 class="dashboard__content__box__title">{{ __('dashboard.overview-title-6') }}</h3>
    <p>
        {{ __('dashboard.overview-update-wishlist') }}
    </p>
    <p class="dashboard__content__box__bottom-link">
        <a wire:click="changeSection('wishlist')" class="btn-dashboard-plain">{{ __('dashboard.overview-see-wishlist') }}</a>
    </p>
</div>