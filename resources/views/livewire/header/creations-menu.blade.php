<div class="creations-navbar__menu">
    <div class="benu-container">
        <div class="creations-navbar__menu__lists flex justify-start">
            <div class="creations-navbar__menu__list navbar-list-unisex">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['types' => 'unisex', 'family' => 'clothes']) }}">{{ __('header.menu-title-1') }}</a></h4>
                <div class="flex">
                    <ul>
                        <!-- <li><a href="{{ route('model-'.app()->getLocale(), ['types' => 'unisex', 'family' => 'clothes']) }}">{{ __('header.see-all-clothes-unisex') }}</a></li> -->
                        @foreach($unisex_clothes as $category => $link_query)
                            @if($loop->index < 6)
                                <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'unisex', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @if(count($unisex_clothes) > 6)
                            @foreach($unisex_clothes as $category => $link_query)
                                @if($loop->index >= 6)
                                    <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'unisex', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="creations-navbar__menu__list navbar-list-adult">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'ladies*gentlemen*unisex']) }}">{{ __('header.menu-title-1') }}</a></h4>
                <div class="flex">
                    <ul>
                        <!-- <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'ladies*gentlemen*unisex']) }}">{{ __('header.see-all-clothes-adults') }}</a></li> -->
                        @foreach($adults_clothes as $category => $link_query)
                            @if($loop->index < 6)
                                <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'unisex*ladies*gentlemen', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @if(count($adults_clothes) > 6)
                            @foreach($adults_clothes as $category => $link_query)
                                @if($loop->index >= 6)
                                    <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'unisex*ladies*gentlemen', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="creations-navbar__menu__list navbar-list-woman">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'ladies']) }}">{{ __('header.menu-title-1') }}</a></h4>
                <div class="flex">
                    <ul>
                        <!-- <li style="margin-bottom: 7px;"><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'ladies']) }}">{{ __('header.see-all-clothes-ladies') }}</a></li> -->
                        @foreach($ladies_clothes as $category => $link_query)
                            @if($loop->index < 6)
                                <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'ladies', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @if(count($ladies_clothes) > 6)
                            <!-- <li style="color: transparent; margin-bottom: 7px;">Empty</li> -->
                            @foreach($ladies_clothes as $category => $link_query)
                                @if($loop->index >= 6)
                                    <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'ladies', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="creations-navbar__menu__list navbar-list-man">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'gentlemen']) }}">{{ __('header.menu-title-1') }}</a></h4>
                <div class="flex">
                    <ul>
                        <!-- <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'gentlemen']) }}">{{ __('header.see-all-clothes-gentlemen') }}</a></li> -->
                        @foreach($gentlemen_clothes as $category => $link_query)
                            @if($loop->index < 6)
                                <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'gentlemen', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @if(count($gentlemen_clothes) > 6)
                            @foreach($gentlemen_clothes as $category => $link_query)
                                @if($loop->index >= 6)
                                    <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'gentlemen', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="creations-navbar__menu__list navbar-list-child">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'kids']) }}">{{ __('header.menu-title-1') }}</a></h4>
                <div class="flex">
                    <ul>
                        <!-- <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'kids']) }}">{{ __('header.see-all-clothes-kids') }}</a></li> -->
                        @foreach($kids_clothes as $category => $link_query)
                            @if($loop->index < 6)
                                <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'kids', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @if(count($kids_clothes) > 6)
                            @foreach($kids_clothes as $category => $link_query)
                                @if($loop->index >= 6)
                                    <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'kids', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="creations-navbar__menu__list navbar-list-accessories">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories']) }}">{{ __('header.menu-title-2') }}</a></h4>
                <div class="flex">
                    <ul>
                        <!-- <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories']) }}">{{ __('header.see-all-accessories') }}</a></li> -->
                        @foreach($accessories as $category => $link_query)
                            @if($loop->index < 6)
                                <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @if(count($accessories) > 6)
                            @foreach($accessories as $category => $link_query)
                                @if($loop->index >= 6)
                                    <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="creations-navbar__menu__list navbar-list-home">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'home']) }}">{{ __('header.menu-title-home') }}</a></h4>
                <!-- <h4>{{ __('header.menu-title-1') }}</h4> -->
                <div class="flex">
                    <ul>
                        <!-- <li><a href="{{ route('model-'.app()->getLocale(), ['types' => 'home']) }}">{{ __('header.see-all-home-creations') }}</a></li> -->
                        @foreach($home_creations as $category => $link_query)
                            @if($loop->index < 6)
                                <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'home', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @if(count($home_creations) > 6)
                            @foreach($home_creations as $category => $link_query)
                                @if($loop->index >= 6)
                                    <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'home', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            
            @if(count($unisex_accessories) > 0)
            <div class="creations-navbar__menu__list navbar-list-unisex">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'unisex']) }}">{{ __('header.menu-title-2') }}</a></h4>
                <div class="flex">
                    <ul>
                        <!-- <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'unisex']) }}">{{ __('header.see-all-accessories-unisex') }}</a></li> -->
                        @foreach($unisex_accessories as $category => $link_query)
                            @if($loop->index < 6)
                                <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'unisex', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @if(count($unisex_accessories) > 6)
                            @foreach($unisex_accessories as $category => $link_query)
                                @if($loop->index >= 6)
                                    <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'unisex', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            @endif

            @if(count($adults_accessories) > 0)
            <div class="creations-navbar__menu__list navbar-list-adult">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'ladies*gentlemen*unisex']) }}">{{ __('header.menu-title-2') }}</a></h4>
                <div class="flex">
                    <ul>
                        <!-- <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'ladies*gentlemen*unisex']) }}">{{ __('header.see-all-accessories-adults') }}</a></li> -->
                        @foreach($adults_accessories as $category => $link_query)
                            @if($loop->index < 6)
                                <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'unisex*ladies*gentlemen', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @if(count($adults_accessories) > 6)
                            @foreach($adults_accessories as $category => $link_query)
                                @if($loop->index >= 6)
                                    <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'unisex*ladies*gentlemen', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            @endif

            @if(count($ladies_accessories) > 0)
            <div class="creations-navbar__menu__list navbar-list-woman">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'ladies']) }}">{{ __('header.menu-title-2') }}</a></h4>
                <div class="flex">
                    <ul>
                        <!-- <li style="margin-bottom: 7px;"><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'ladies']) }}">{{ __('header.see-all-accessories-ladies') }}</a></li> -->
                        @foreach($ladies_accessories as $category => $link_query)
                            @if($loop->index < 6)
                                <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'ladies', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @if(count($ladies_accessories) > 6)
                            @foreach($ladies_accessories as $category => $link_query)
                                @if($loop->index >= 6)
                                    <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'ladies', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            @endif

            @if(count($gentlemen_accessories) > 0)
            <div class="creations-navbar__menu__list navbar-list-man">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'gentlemen']) }}">{{ __('header.menu-title-2') }}</a></h4>
                <div class="flex">
                    <ul>
                        <!-- <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'gentlemen']) }}">{{ __('header.see-all-accessories-gentlemen') }}</a></li> -->
                        @foreach($gentlemen_accessories as $category => $link_query)
                            @if($loop->index < 6)
                                <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'gentlemen', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @if(count($gentlemen_accessories) > 6)
                            @foreach($gentlemen_accessories as $category => $link_query)
                                @if($loop->index >= 6)
                                    <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'gentlemen', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            @endif

            @if(count($kids_accessories) > 0)
            <div class="creations-navbar__menu__list navbar-list-child">
                <h4><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'kids']) }}">{{ __('header.menu-title-2') }}</a></h4>
                <div class="flex">
                    <ul>
                        <!-- <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'kids']) }}">{{ __('header.see-all-accessories-kids') }}</a></li> -->
                        @foreach($kids_accessories as $category => $link_query)
                            @if($loop->index < 6)
                                <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'kids', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @if(count($kids_accessories) > 6)
                            @foreach($kids_accessories as $category => $link_query)
                                @if($loop->index >= 6)
                                    <li><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories', 'types' => 'kids', 'categories' => $link_query]) }}">{{ $category }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>