<div>
    <div class="all-models__filters-container">
        <div class="all-models__filters flex justify-between benu-container">
            <div class="flex justify-start">
                <div class="all-models__filters__filter flex" id="filter-size">
                    <p>{{ __('models.filter-size') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                </div>
                <div class="all-models__filters__filter flex" id="filter-color">
                    <p>{{ __('models.filter-color') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                </div>
                <!-- <div class="all-models__filters__filter flex" id="filter-shops">
                    <p>{{ __('models.filter-shop') }}</p> <img src="{{ asset('media/pictures/chevron_bottom.png') }}">
                </div> -->
            </div>

            <!-- <div class="all-models__filters__filter flex" style="margin-right: 5px;" id="filter-order">
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