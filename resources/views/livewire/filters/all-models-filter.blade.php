<div>
    <div class="mobile-only mb-5">
        <div class="flex justify-around all-models__mobile-header w-3/4 m-auto">
            <div class="flex justify-start all-models__mobile-header__button" wire:click="showSortMobileFilters">
                @svg('icon_benu_couture_filtrer_OK')
                <p>
                    <!-- Filtres -->
                    {{ __('models.filter-mobile-filter') }}
                </p>
            </div>

            <div class="flex justify-start all-models__mobile-header__button" wire:click="showSortMobileOptions">
                @svg('icon_benu_couture_classer_OK')
                <p>
                    <!-- Classer par -->
                    {{ __('models.filter-mobile-order-by') }}
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
                <div class="all-models__mobile-menu__sidebar__accordion__header flex justify-between" wire:click="showMobileFilters('family')">
                    <h4>{{ __('models.filter-family') }}</h4>
                    @if($mobile_show_families)
                        @svg('chevron-down', 'all-models__mobile-menu__sidebar__accordion__header--active')
                    @else
                        @svg('chevron-down')
                    @endif
                </div>
                @if($mobile_show_families)
                <div class="all-models__mobile-menu__sidebar__accordion__content">
                    @foreach($filter_names['families'] as $key => $family_name)
                    <a href="{{ route('model-'.app()->getLocale(), ['family' => $key]) }}" wire:key="mobile-{{ $family }}">
                        @if($key == $family)
                            <div class="all-models__filter-tag all-models__filter-tag--active">
                        @else
                            <div class="all-models__filter-tag">
                        @endif
                            {{ $family_name }}
                        </div>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="all-models__mobile-menu__sidebar__accordion">
                <div class="all-models__mobile-menu__sidebar__accordion__header flex justify-between" wire:click="showMobileFilters('type')">
                    <h4>{{ __('models.filter-type') }}</h4>
                    @if($mobile_show_types)
                        @svg('chevron-down', 'all-models__mobile-menu__sidebar__accordion__header--active')
                    @else
                        @svg('chevron-down')
                    @endif
                </div>
                @if($mobile_show_types)
                <div class="all-models__mobile-menu__sidebar__accordion__content">
                    @foreach($active_filters['types'] as $type => $filter)
                        <div wire:click="toggleFilter('types', '{{ $type }}')" wire:key="mobile-{{ $type }}">
                            @if($filter == 1)
                                <div class="all-models__filter-tag all-models__filter-tag--active">
                            @else
                                <div class="all-models__filter-tag">
                            @endif
                                {{ $filter_names['types'][$type] }}
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="all-models__mobile-menu__sidebar__accordion">
                <div class="all-models__mobile-menu__sidebar__accordion__header flex justify-between" wire:click="showMobileFilters('category')">
                    <h4>{{ __('models.filter-category') }}</h4>
                    @if($mobile_show_categories)
                        @svg('chevron-down', 'all-models__mobile-menu__sidebar__accordion__header--active')
                    @else
                        @svg('chevron-down')
                    @endif
                </div>
                @if($mobile_show_categories)
                <div class="all-models__mobile-menu__sidebar__accordion__content">
                    @foreach($active_filters['categories'] as $category => $filter)
                        <div wire:click="toggleFilter('categories', '{{ $category }}')"  wire:key="{{ $category }}">
                            @if($filter == 1)
                                <div class="all-models__filter-tag all-models__filter-tag--active">
                            @else
                                <div class="all-models__filter-tag">
                            @endif
                                {{ $filter_names['categories'][$category] }}
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
                <div class="all-models__mobile-menu__sidebar__accordion__header flex justify-between" wire:click="showMobileFilters('price')">
                    <h4>{{ __('models.filter-price') }}</h4>
                    @if($mobile_show_prices)
                        @svg('chevron-down', 'all-models__mobile-menu__sidebar__accordion__header--active')
                    @else
                        @svg('chevron-down')
                    @endif
                </div>
                @if($mobile_show_prices)
                <div class="all-models__mobile-menu__sidebar__accordion__content">
                    @foreach($active_filters['prices'] as $price => $filter)
                        <div wire:click="toggleFilter('prices', '{{ $price }}')" wire:key="{{ $price }}">
                            @if($filter == 1)
                                <div class="all-models__filter-tag all-models__filter-tag--active">
                            @else
                                <div class="all-models__filter-tag">
                            @endif
                                {!! $filter_names['prices'][$price] !!}
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>

            @if(count($active_filters['partners']) > 0)
            <div class="all-models__mobile-menu__sidebar__accordion">
                <div class="all-models__mobile-menu__sidebar__accordion__header flex justify-between" wire:click="showMobileFilters('partner')">
                    <h4>{{ __('models.filter-partner') }}</h4>
                    @if($mobile_show_partners)
                        @svg('chevron-down', 'all-models__mobile-menu__sidebar__accordion__header--active')
                    @else
                        @svg('chevron-down')
                    @endif
                </div>
                @if($mobile_show_partners)
                <div class="all-models__mobile-menu__sidebar__accordion__content">
                    @foreach($active_filters['partners'] as $partner => $filter)
                        <div wire:click="toggleFilter('partners', '{{ $partner }}')" wire:key="{{ $partner }}">
                            @if($filter == 1)
                                <div class="all-models__filter-tag all-models__filter-tag--active">
                            @else
                                <div class="all-models__filter-tag">
                            @endif
                                {{ $filter_names['partners'][$partner] }}
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

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
                <div class="all-models__filters__filter flex" id="filter-family">
                    <p>{{ __('models.filter-family') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                </div>
                @if($family !== 'home')
                    <div class="all-models__filters__filter flex" id="filter-gender">
                        <p>{{ __('models.filter-type') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                    </div>
                @endif
                
                <div class="all-models__filters__filter flex" id="filter-category">
                    <p>{{ __('models.filter-category') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                </div>
                <div class="all-models__filters__filter flex" id="filter-color">
                    <p>{{ __('models.filter-color') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                </div>
                <div class="all-models__filters__filter flex" id="filter-price">
                    <p>{{ __('models.filter-price') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                </div>
                @if(count($active_filters['partners']) > 0)
                <div class="all-models__filters__filter flex" id="filter-partners">
                    <p>{{ __('models.filter-partner') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                </div>
                @endif
                <div class="all-models__filters__filter flex" id="filter-shops">
                    <p>{{ __('models.filter-shop') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                </div>
            </div>

            <div class="all-models__filters__filter flex" style="margin-right: 5px;" id="filter-order">
                <p>{{ __('models.filter-order-by') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
            </div>
        </div>

        @include('includes.model.model_filters')
    </div>

    <div class="all-models__active-filters flex justify-start flex-wrap benu-container" wire:key="active-filters">
        <!-- <div>
            <div class="all-models__active-filters__filter flex justify-between">
                <p class="w-4/5 pr-1" style="min-width: fit-content;">{{ $filter_names['families'][$family] }}</p>
                <div class="w-1/5">&#x2715;</div>
            </div>
        </div> -->

        @foreach($active_filters['categories'] as $category => $category_filter)
            <div wire:click="toggleFilter('categories', '{{ $category }}')" wire:key="{{ $category }}">
            @if($category_filter == '1')
                <div class="all-models__active-filters__filter flex justify-between">
                    <p class="w-4/5 pr-1" style="min-width: fit-content;">{{ $filter_names['categories'][$category] }}</p>
                    <div class="w-1/5">&#x2715;</div>
                </div>
            @endif
            </div>
        @endforeach

        @foreach($active_filters['colors'] as $color => $color_filter)
            <div wire:click="toggleFilter('colors', '{{ $color }}')" wire:key="{{ $color }}">
            @if($color_filter == '1')
                <div class="all-models__active-filters__filter flex justify-between">
                    @if($color == 'multicolored')
                        <div class="color-circle w-1/5">
                            <img src="{{ asset('media/pictures/multicolor.png') }}">
                        </div>
                    @else
                        <div class="color-circle color-circle--{{ $color }} w-1/5"></div>
                    @endif
                    <p class="w-3/5 pl-1" style="min-width: fit-content; padding-right: 4px;">{{ $filter_names['colors'][$color] }}</p>
                    <div class="w-1/5">&#x2715;</div>
                </div>
            @endif
            </div>
        @endforeach

        @foreach($active_filters['types'] as $type => $type_filter)
            <div wire:click="toggleFilter('types', '{{ $type }}')" wire:key="{{ $type }}">
            @if($type_filter == '1')
                <div class="all-models__active-filters__filter flex justify-between">
                    <p class="w-4/5 pr-1" style="min-width: fit-content;">{{ $filter_names['types'][$type] }}</p>
                    <div class="w-1/5">&#x2715;</div>
                </div>
            @endif
            </div>
        @endforeach

        @foreach($active_filters['prices'] as $price => $price_filter)
            <div wire:click="toggleFilter('prices', '{{ $price }}')" wire:key="{{ $price }}">
            @if($price_filter == '1')
                <div class="all-models__active-filters__filter flex justify-between">
                    <p class="w-4/5 pr-1" style="min-width: fit-content;">{!! $filter_names['prices'][$price] !!}</p>
                    <div class="w-1/5">&#x2715;</div>
                </div>
            @endif
            </div>
        @endforeach

        @foreach($active_filters['partners'] as $partner => $partner_filter)
            <div wire:click="toggleFilter('partners', '{{ $partner }}')" wire:key="{{ $partner }}">
            @if($partner_filter == '1')
                <div class="all-models__active-filters__filter flex justify-between">
                    <p class="w-4/5 pr-1" style="min-width: fit-content;">{{ $filter_names['partners'][$partner] }}</p>
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