<div>
    <div class="mobile-only mb-5">
        <div class="all-models__mobile-header w-full">
            <div class="flex justify-center all-models__mobile-header__button" wire:click="showSortMobileFilters">
                @svg('icon_benu_couture_filtrer_OK')
                <p>
                    <!-- Filtres -->
                    {{ __('models.filter-mobile-filter') }}
                </p>
            </div>
        </div>
    </div>

    <div class="mobile-only all-models__mobile-menu" @if(!$mobile_sort_active && !$mobile_filters_active) style="display: none;" @endif>
        <div class="all-models__mobile-menu__opacifier" wire:click="resetMobileWindow"></div>

        <div class="all-models__mobile-menu__sidebar all-models__mobile-menu__sidebar--sort">
            <div class="all-models__mobile-menu__sidebar__close"  wire:click="resetMobileWindow">
                &#10005;
            </div>
            <div class="all-models__mobile-menu__sidebar__header">
                {{ __('models.filter-mobile-sorts') }}
            </div>
            <div class="pt-4 pb-4">
                <div class="all-models__filter-tag @if($sorting_order == 'asc') all-models__filter-tag--active @endif" wire:click="updateSorting('asc')">
                    {{ __('models.filter-asc') }}
                </div>
                <div class="all-models__filter-tag @if($sorting_order == 'desc') all-models__filter-tag--active @endif" wire:click="updateSorting('desc')">
                    {{ __('models.filter-desc') }}
                </div>
            </div>
        </div>

        <div class="all-models__mobile-menu__sidebar all-models__mobile-menu__sidebar--filters">
            <div class="all-models__mobile-menu__sidebar__close"  wire:click="resetMobileWindow">
                &#10005;
            </div>
            <div class="all-models__mobile-menu__sidebar__header">
                {{ __('models.filter-mobile-filters') }}
            </div>

            <div class="all-models__mobile-menu__sidebar__accordion">
                <div class="all-models__mobile-menu__sidebar__accordion__header flex justify-between" wire:click="showMobileFilters('size')">
                    <h4>{{ __('models.filter-size') }}</h4>
                    @if($mobile_show_sizes)
                        @svg('chevron-down', 'all-models__mobile-menu__sidebar__accordion__header--active')
                    @else
                        @svg('chevron-down')
                    @endif
                </div>
                @if($mobile_show_sizes)
                <div class="all-models__mobile-menu__sidebar__accordion__content">
                    @foreach($active_filters['sizes'] as $size => $filter)
                        <div wire:click="toggleFilter('sizes', '{{ $size }}')" wire:key="mobile-{{ $size }}">
                            @if($filter == 1)
                                <div class="all-models__filter-tag all-models__filter-tag--active">
                            @else
                                <div class="all-models__filter-tag">
                            @endif
                                {{ $filter_names['sizes'][$size] }}
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="all-models__mobile-menu__sidebar__accordion">
                <div class="all-models__mobile-menu__sidebar__accordion__header flex justify-between" wire:click="showMobileFilters('color')">
                    <h4>{{ __('models.filter-color') }}</h4>
                    @if($mobile_show_colors)
                        @svg('chevron-down', 'all-models__mobile-menu__sidebar__accordion__header--active')
                    @else
                        @svg('chevron-down')
                    @endif
                </div>
                @if($mobile_show_colors)
                <div class="all-models__mobile-menu__sidebar__accordion__content">
                    @foreach($active_filters['colors'] as $color => $filter)
                        <div wire:click="toggleFilter('colors', '{{ $color }}')" wire:key="{{ $color }}">
                            <div class="all-models__color-filter-tag flex justify-start lg:justify-between">
                            @if($color == 'multicolored')
                                @if($filter == 1)
                                <div class="all-models__color-filter-tag__circle mr-2">
                                @else
                                <div>
                                @endif
                                    <div class="color-circle color-circle--mobile w-2/5 md:w-1/5 mt-1">
                                        <img src="{{ asset('media/pictures/multicolor.png') }}">
                                    </div>
                                </div>
                            @else
                                @if($filter == 1)
                                <div class="all-models__color-filter-tag__circle mr-2">
                                @else
                                <div>
                                @endif
                                    <div class="color-circle color-circle--mobile color-circle--{{ $color }} w-1/5 mt-1"></div>
                                </div>
                            @endif
                                <p style="margin-top: 6px;">{{ $filter_names['colors'][$color] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="all-models__mobile-menu__sidebar__accordion">
                <div class="all-models__mobile-menu__sidebar__accordion__header flex justify-between" wire:click="showMobileFilters('shop')">
                    <h4>{{ __('models.filter-shop') }}</h4>
                    @if($mobile_show_shops)
                        @svg('chevron-down', 'all-models__mobile-menu__sidebar__accordion__header--active')
                    @else
                        @svg('chevron-down')
                    @endif
                </div>
                @if($mobile_show_shops)
                <div class="all-models__mobile-menu__sidebar__accordion__content">
                    @foreach($active_filters['shops'] as $shop => $filter)
                        <div wire:click="toggleFilter('shops', '{{ $shop }}')" wire:key="{{ $shop }}">
                            @if($filter == 1)
                                <div class="all-models__filter-tag all-models__filter-tag--active">
                            @else
                            <div class="all-models__filter-tag">
                            @endif
                                {{ $filter_names['shops'][$shop] }}
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="all-models__filters-container tablet-hidden">
        <div class="all-models__filters flex justify-between benu-container">
            <div class="flex justify-start">
                <div class="all-models__filters__filter flex" id="filter-size">
                    <p>{{ __('models.filter-size') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                </div>
                <div class="all-models__filters__filter flex" id="filter-color">
                    <p>{{ __('models.filter-color') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                </div>
                <div class="all-models__filters__filter flex" id="filter-shops">
                    <p>{{ __('models.filter-shop') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                </div>
            </div>

<!--             <div class="all-models__filters__filter flex" style="margin-right: 5px;" id="filter-order">
                <p>{{ __('models.filter-order-by') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
            </div> -->
        </div>

        @include('includes.model.article_filters')
    </div>

    <div class="model-articles__active-filters flex justify-start benu-container">
        @foreach($active_filters['sizes'] as $size => $size_filter)
            <div wire:click="toggleFilter('sizes', '{{ $size }}')" wire:key="{{ $size }}">
            @if($size_filter == '1')
                <div class="all-models__active-filters__filter flex justify-between">
                    <p class="w-4/5 pr-1" style="min-width: fit-content;">{{ $filter_names['sizes'][$size] }}</p>
                    <div class="w-1/5">&#x2715;</div>
                </div>
            @endif
            </div>
        @endforeach

        @foreach($active_filters['colors'] as $color => $color_filter)
            <div wire:click="toggleFilter('colors', '{{ $color }}')" wire:key="{{ $color }}">
            @if($color_filter == '1')
                <div class="all-models__active-filters__filter flex justify-between">
                    <div class="color-circle color-circle--{{ $color }} w-1/5"></div>
                    <p class="w-3/5 pl-1">{{ $filter_names['colors'][$color] }}</p>
                    <div class="w-1/5">&#x2715;</div>
                </div>
            @endif
            </div>
        @endforeach

        @foreach($active_filters['shops'] as $shop => $shop_filter)
            <div wire:click="toggleFilter('shops', '{{ $shop }}')" wire:key="{{ $shop }}">
            @if($shop_filter == '1')
                <div class="all-models__active-filters__filter flex justify-between">
                    <p class="w-4/5 pr-1" style="min-width: fit-content;">{{ $filter_names['shops'][$shop] }}</p>
                    <div class="w-1/5">&#x2715;</div>
                </div>
            @endif
            </div>
        @endforeach
    </div>
</div>