<div class="side-mobile__creations mt-4" id="side-mobile-creations-links">
    <div>

        <div>
            <div class="side-mobile__creations__title flex justify-between">
                <h3>{{ __('header.unisex') }}</h3>
                @svg('chevron-down', 'side-mobile__creations__title__svg')
            </div>
            <div class="side-mobile__creations__list side-mobile__creations__list--hidden">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['types' => 'unisex', 'family' => 'clothes']) }}">{{ __('header.menu-title-1') }}</a></h4>
                <ul class="side-mobile__creations__list__links mb-3">
                    @foreach($unisex_clothes as $category => $link_query)
                        <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'unisex', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                    @endforeach
                </ul>

                @if(count($unisex_accessories) > 0)
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'unisex']) }}">{{ __('header.menu-title-2') }}</a></h4>
                <ul class="side-mobile__creations__list__links">
                    @foreach($unisex_accessories as $category => $link_query)
                        <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'unisex', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

        <div>
            <div class="side-mobile__creations__title flex justify-between">
                <h3>{{ __('header.women') }}</h3>
                @svg('chevron-down', 'side-mobile__creations__title__svg')
            </div>
            <div class="side-mobile__creations__list side-mobile__creations__list--hidden">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['types' => 'ladies', 'family' => 'clothes']) }}">{{ __('header.menu-title-1') }}</a></h4>
                <ul class="side-mobile__creations__list__links mb-3">
                    @foreach($ladies_clothes as $category => $link_query)
                        <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'ladies', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                    @endforeach
                </ul>

                @if(count($ladies_accessories) > 0)
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'ladies']) }}">{{ __('header.menu-title-2') }}</a></h4>
                <ul class="side-mobile__creations__list__links">
                    @foreach($ladies_accessories as $category => $link_query)
                        <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'ladies', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

        <div>
            <div class="side-mobile__creations__title flex justify-between">
                <h3>{{ __('header.men') }}</h3>
                @svg('chevron-down', 'side-mobile__creations__title__svg')
            </div>
            <div class="side-mobile__creations__list side-mobile__creations__list--hidden">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['types' => 'gentlemen', 'family' => 'clothes']) }}">{{ __('header.menu-title-1') }}</a></h4>
                <ul class="side-mobile__creations__list__links mb-3">
                    @foreach($gentlemen_clothes as $category => $link_query)
                        <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'gentlemen', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                    @endforeach
                </ul>

                @if(count($gentlemen_accessories) > 0)
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'gentlemen']) }}">{{ __('header.menu-title-2') }}</a></h4>
                <ul class="side-mobile__creations__list__links">
                    @foreach($gentlemen_accessories as $category => $link_query)
                        <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'gentlemen', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

        <div>
            <div class="side-mobile__creations__title flex justify-between">
                <h3>{{ __('header.adults') }}</h3>
                @svg('chevron-down', 'side-mobile__creations__title__svg')
            </div>
            <div class="side-mobile__creations__list side-mobile__creations__list--hidden">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['types' => 'unisex*ladies*gentlemen', 'family' => 'clothes']) }}">{{ __('header.menu-title-1') }}</a></h4>
                <ul class="side-mobile__creations__list__links mb-3">
                    @foreach($adults_clothes as $category => $link_query)
                        <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'unisex*ladies*gentlemen', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                    @endforeach
                </ul>

                @if(count($adults_accessories) > 0)
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'unisex*ladies*gentlemen']) }}">{{ __('header.menu-title-2') }}</a></h4>
                <ul class="side-mobile__creations__list__links">
                    @foreach($adults_accessories as $category => $link_query)
                        <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'unisex*ladies*gentlemen', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

        <div>
            <div class="side-mobile__creations__title flex justify-between">
                <h3>{{ __('header.children') }}</h3>
                @svg('chevron-down', 'side-mobile__creations__title__svg')
            </div>
            <div class="side-mobile__creations__list side-mobile__creations__list--hidden">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['types' => 'kids', 'family' => 'clothes']) }}">{{ __('header.menu-title-1') }}</a></h4>
                <ul class="side-mobile__creations__list__links mb-3">
                    @foreach($kids_clothes as $category => $link_query)
                        <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'kids', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                    @endforeach
                </ul>

                @if(count($kids_accessories) > 0)
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'kids']) }}">{{ __('header.menu-title-2') }}</a></h4>
                <ul class="side-mobile__creations__list__links">
                    @foreach($kids_accessories as $category => $link_query)
                        <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'kids', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

        <div>
            <div class="side-mobile__creations__title flex justify-between">
                <h3>{{ __('header.accessories') }}</h3>
                @svg('chevron-down', 'side-mobile__creations__title__svg')
            </div>
            <div class="side-mobile__creations__list side-mobile__creations__list--hidden">
    <!--             <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories']) }}">{{ __('header.menu-title-2') }}</a></h4> -->
                <ul class="side-mobile__creations__list__links mt-3">
                    @foreach($accessories as $category => $link_query)
                        <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div>
            <div class="side-mobile__creations__title flex justify-between">
                <h3>{{ __('header.house') }}</h3>
                @svg('chevron-down', 'side-mobile__creations__title__svg')
            </div>
            <div class="side-mobile__creations__list side-mobile__creations__list--hidden">
                <ul class="side-mobile__creations__list__links mt-3">
                    @foreach($home_creations as $category => $link_query)
                        <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'home', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

       <!--  <a href="{{ route('model-'.app()->getLocale(), ['family' => 'home']) }}" class="side-mobile__creations__title flex justify-start">
            <h3>{{ __('header.house') }}</h3>
        </a> -->

        <a href="{{ route('vouchers-'.app()->getLocale()) }}" class="side-mobile__creations__title flex justify-start">
            <h3>{{ __('header.vouchers') }}</h3>
        </a>
    </div>
</div>