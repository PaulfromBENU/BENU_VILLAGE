<section>
    <div class="mobile-only w-5/6 m-auto mt-5">
        <div class="flex justify-between">
            <a wire:click="changeSection('overview')" class="inline-block btn-slider-left dashboard__nav__link dashboard__nav__link--active">
                {{ __('dashboard.nav-overview') }}
            </a>
            <a onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="inline-block btn-slider-left dashboard__nav__link dashboard__nav__link--active">{{ __('dashboard.nav-logout') }}</a>

            <form id="logout-form-mobile" action="{{ route('logout', ['locale' => app()->getLocale()]) }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    <div class="dashboard flex justify-start">
        <div class="dashboard__nav tablet-hidden">
            <div style="position: sticky; top: 150px;">
                <h2 class="dashboard__nav__title">{{ __('dashboard.nav-hello') }}, <strong>{{ Auth::user()->first_name }}</strong></h2>
                <!-- <h2 class="dashboard__nav__title">@if(date('H') > 22 || date('H') < 6) {{ __('dashboard.nav-hello-evening') }}, @else {{ __('dashboard.nav-hello-day') }}, @endif <strong>{{ Auth::user()->first_name }}</strong></h2> -->
                <ul class="dashboard__nav__links">
                    <li>
                        <a wire:click="changeSection('overview')" class="btn-slider-left dashboard__nav__link @if($section == 'overview') dashboard__nav__link--active @endif">
                            {{ __('dashboard.nav-overview') }}
                        </a>
                    </li>
                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'vendor')
                    <li>
                        <a href="{{ route('filament.pages.dashboard') }}" class="btn-slider-left dashboard__nav__link" target="_blank">
                            Admin Panel
                        </a>
                    </li>
                    @endif
                    <!-- <li>
                        <a wire:click="changeSection('orders')" class="btn-slider-left dashboard__nav__link @if($section == 'orders') dashboard__nav__link--active @endif">
                            {{ __('dashboard.nav-orders') }}
                        </a>
                    </li> -->
                    <li>
                        <a wire:click="changeSection('communications')" class="btn-slider-left dashboard__nav__link @if($section == 'communications') dashboard__nav__link--active @endif">
                            {{ __('dashboard.nav-demands') }} @if($counter > 0) ({{ $counter }}) @endif
                        </a>
                    </li>
<!--                     <li>
                        <a wire:click="changeSection('returns')" class="btn-slider-left dashboard__nav__link @if($section == 'returns') dashboard__nav__link--active @endif">
                            {{ __('dashboard.nav-returns') }}
                        </a>
                    </li> -->
                    <li>
                        <a wire:click="changeSection('wishlist')" class="btn-slider-left dashboard__nav__link @if($section == 'wishlist') dashboard__nav__link--active @endif">
                            {{ __('dashboard.nav-wishlist') }}
                        </a>
                    </li>
                    <li>
                        <a wire:click="changeSection('vouchers')" class="btn-slider-left dashboard__nav__link @if($section == 'vouchers') dashboard__nav__link--active @endif">
                            {{ __('dashboard.nav-vouchers') }}
                        </a>
                    </li>
                    <li>
                        <a wire:click="changeSection('addresses')" class="btn-slider-left dashboard__nav__link @if($section == 'addresses') dashboard__nav__link--active @endif">
                            {{ __('dashboard.nav-addresses') }}
                        </a>
                    </li>
                    <li>
                        <a wire:click="changeSection('conditions')" class="btn-slider-left dashboard__nav__link @if($section == 'conditions') dashboard__nav__link--active @endif">
                            {{ __('dashboard.nav-conditions') }}
                        </a>
                    </li>
                    <li>
                        <a wire:click="changeSection('details')" class="btn-slider-left dashboard__nav__link @if($section == 'details') dashboard__nav__link--active @endif">
                            {{ __('dashboard.nav-details') }}
                        </a>
                    </li>
                    <li>
                        <a wire:click="changeSection('delete')" class="btn-slider-left dashboard__nav__link @if($section == 'delete') dashboard__nav__link--active @endif">
                            {{ __('dashboard.nav-delete') }}
                        </a>
                    </li>
                </ul>
                <div class="dashboard__nav__logout">
                    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn-couture-plain">{{ __('dashboard.nav-logout') }}</button>
                    <form id="logout-form" action="{{ route('logout', ['locale' => app()->getLocale()]) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <div class="dashboard__content flex justify-start flex-wrap">
            <!-- <div wire:loading>
                LOADING CONTENT...
            </div> -->
            @switch($section)
                @case('overview')
                    @include('includes.dashboard.overview')
                    @break

                @case('communications')
                    @livewire('dashboard.communications')
                    @break

                <!-- @case('returns')
                    @include('includes.dashboard.returns')
                    @break -->

                @case('wishlist')
                    @include('includes.dashboard.wishlist')
                    @break

                @case('vouchers')
                    @livewire('dashboard.vouchers')
                    @break

                @case('addresses')
                    @livewire('dashboard.addresses')
                    @break

                @case('conditions')
                    @include('includes.dashboard.conditions')
                    @break

                @case('details')
                    @include('includes.dashboard.details')
                    @break

                @case('delete')
                    @include('includes.dashboard.delete')
                    @break

                @default
                    @include('includes.dashboard.overview')
                    @break
            @endswitch
        </div>
    </div>
</section>