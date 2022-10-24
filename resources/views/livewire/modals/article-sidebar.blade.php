<div class="article-sidebar flex flex-col lg:flex-row justify-start lg:justify-right relative">
    @if($article_id != '0')
        <!-- Hidden on mobile -->
        <div class="article-sidebar__img-container tablet-hidden">
            @if($variation->creation->partner != null)
            <div class="model-overview__img-container__partner-icon">
                <div class="model-overview__img-container__partner-icon__content flex justify-between">
                    <div>
                        <p class="primary-color pl-2 pr-2 text-sm">
                            <strong>{{ $variation->creation->partner->name }}</strong>
                        </p>
                        <p class="pl-2 pr-2 text-sm">
                            <em>{{ __('components.partner') }}</em>
                        </p>
                    </div>
                    <div>
                        @svg('icon_partenaire')
                    </div>
                </div>
            </div>
            @endif

            <div style="height: 100%;">
            @foreach($article_pictures as $picture)
                <img src="{{ asset('media/pictures/articles/'.$picture) }}" alt="Photo article {{ $variation->creation->name }}" class="w-full">
            @endforeach
            </div>

            @if(count($article_pictures) > 1)
            <div class="article-sidebar__img-container__scroller flex justify-between">
                <p>{{ __('sidebar.see-pictures') }}</p>
                <p>
                    @svg('model_arrow_down')
                </p>
            </div>
            @endif
        </div>


        @if($content == 'overview')
            @if(in_array(app()->getLocale(), ['lu', 'de']))
            <div class="article-sidebar__content__close-container article-sidebar__content__close-container--large mobile-only" wire:click="closeSideBar">
                <div class="article-sidebar__content__close article-sidebar__content__close--large">
                    {{ __('sidebar.close') }} <span class="pl-2">&#10005;</span>
                </div>
            </div>
            @else
            <div class="article-sidebar__content__close-container mobile-only" wire:click="closeSideBar">
                <div class="article-sidebar__content__close">
                    {{ __('sidebar.close') }} <span class="pl-2">&#10005;</span>
                </div>
            </div>
            @endif
        @endif

        <!-- Mobile only -->
        <div class="article-sidebar__img-container-mobile relative mobile-only">
            @if($content == 'overview')
                @if($variation->creation->partner != null)
                <div class="model-overview__img-container__partner-icon">
                    <div class="model-overview__img-container__partner-icon__content flex justify-between">
                        <div>
                            <p class="primary-color pl-2 pr-2 text-sm">
                                <strong>{{ $variation->creation->partner->name }}</strong>
                            </p>
                            <p class="pl-2 pr-2 text-sm">
                                <em>{{ __('components.partner') }}</em>
                            </p>
                        </div>
                        <div>
                            @svg('icon_partenaire')
                        </div>
                    </div>
                </div>
                @endif

                <div class="flex justify-between absolute" style="width: 70%; left: 15%; bottom: 20px;">
                    <div class="article-sidebar__img-container-mobile__arrow article-sidebar__img-container-mobile__arrow--left">
                        @svg('chevron-down')
                    </div>
                    <div class="article-sidebar__img-container-mobile__arrow article-sidebar__img-container-mobile__arrow--right">
                        @svg('chevron-down')
                    </div>
                </div>

                <div class="flex justify-start article-sidebar__img-container-mobile__images">
                    @foreach($article_pictures as $picture)
                        <img src="{{ asset('media/pictures/articles/'.$picture) }}" alt="Photo article {{ $variation->creation->name }}" class="w-full">
                    @endforeach
                </div>
            @endif
        </div>


        <div class="article-sidebar__content">
            @if(in_array(app()->getLocale(), ['lu', 'de']))
            <div class="article-sidebar__content__close-container article-sidebar__content__close-container--large tablet-hidden" wire:click="closeSideBar">
                <div class="article-sidebar__content__close article-sidebar__content__close--large">
                    {{ __('sidebar.close') }} <span class="pl-2">&#10005;</span>
                </div>
            </div>
            @else
            <div class="article-sidebar__content__close-container tablet-hidden" wire:click="closeSideBar">
                <div class="article-sidebar__content__close">
                    {{ __('sidebar.close') }} <span class="pl-2">&#10005;</span>
                </div>
            </div>
            @endif
            <p class="article-sidebar__content__compo__subtitle" wire:click="switchDisplay('overview')" @if($content == 'overview') style="display: none;" @endif>
                < {{ __('sidebar.back') }}
            </p>

            @if($content == 'overview')
                <h3 class="article-sidebar__content__subtitle">
                    {{ $variation->creation->creation_category->$name_query }}
                </h3>

                @auth
                <div class="article-sidebar__content__wishlist" wire:click="toggleWishlist">
                    @if(!$is_wishlisted)
                    <div class="article-sidebar__content__wishlist__icon">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="article-sidebar__content__wishlist__icon article-sidebar__content__wishlist__icon--hovered">
                        <i class="fas fa-heart"></i>
                    </div>
                    @else
                    <div class="article-sidebar__content__wishlist__icon article-sidebar__content__wishlist__icon--active">
                        <i class="fas fa-heart"></i>
                    </div>
                    @endif
                </div>
                @else
                <div class="article-sidebar__content__wishlist tooltip" wire:click.prevent.stop="toggleWishlist">
                    <div class="article-sidebar__content__wishlist__icon">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="article-sidebar__content__wishlist__icon article-sidebar__content__wishlist__icon--hovered">
                        <i class="fas fa-heart"></i>
                    </div>
                    <span class="tooltiptext tooltiptext--top">
                        {!! __('models.please-login') !!}
                    </span>
                </div>
                @endauth

                @if($sold == 0)
                <div class="article-sidebar__content__size">
                    @if(strtolower($variation->size->value) == 'unique')
                    {{ __('sidebar.size-unique-sidebar') }}
                    @else
                    {{ __('sidebar.size') }} {{ strtoupper($variation->size->value) }}
                    @endif
                </div>
                @else
                <div class="article-sidebar__content__size article-sidebar__content__size--sold">
                    @if(strtolower($variation->size->value) == 'unique')
                    {{ __('sidebar.size-unique-sidebar') }}
                    @else
                    {{ __('sidebar.size') }} {{ strtoupper($variation->size->value) }}
                    @endif
                </div>
                @endif

                <h2 class="article-sidebar__content__title">
                    {{ strtoupper($variation->name) }}
                    @if($variation->available_shops()->where('filter_key', '<>', "benu-esch")->count() > 0)
                        &nbsp;- {{ $variation->available_shops()->where('filter_key', '<>', "benu-esch")->first()->name }}
                    @endif
                </h2>

                <p class="article-sidebar__content__price">
                    @if($sold == 0)
                        @if($variation->is_extra_accessory)
                        {{ $variation->specific_price }}&euro;
                        @else
                        {{ $variation->creation->price }}&euro;
                        @endif
                    @else
                    {{ strtoupper(__('models.sold-sold')) }}
                    @endif
                </p>

                <div class="article-sidebar__content__color color-circle color-circle--{{ $variation->color->name }}"></div>

                <p class="article-sidebar__content__desc">
                    @if($full_desc == 0)
                    {{ $article_description_short }} 
                    @if(str_word_count($article_description) >= 20)
                        <span class="primary-color" style="cursor: pointer;" wire:click="showFullDescription">+</span>
                    @endif
                    @else
                    {{ $article_description }}
                    @endif
                </p>

                @if($variation->$singularity_query != "")
                <p class="article-sidebar__content__singularity">
                    <span class="primary-color">{!! __('sidebar.singularity') !!}</span> {{ $variation->$singularity_query }}
                </p>
                @endif

                @if($variation->available_shops()->where('filter_key', '<>', "benu-esch")->count() > 0)
                    @if($variation->available_shops()->where('filter_key', '<>', "benu-esch")->first()->delayed_stock == '1')
                    <div class="article-sidebar__content__delayed-stock">
                        <span class="font-bold primary-color">{!! __('sidebar.special-pop-up-store') !!}</span>: {{ __('sidebar.special-pop-up-content') }}
                    </div>
                    @endif
                @endif

                @if($variation->creation->pillow_option == 1)
                <div class="text-center m-auto mb-5">
                    <input type="checkbox" name="with_extra" wire:model="with_extra" class="mr-2 rounded" id="with_extra">
                    <label for="with_extra">{{ __('sidebar.add-extra-pillow-for') }} 10&euro;</label>
                </div>
                @endif

                @if($sold == 0)
                    @if($sent_to_cart == 0)
                    <p class="text-center mb-2 mobile-only" style="height: 24px;">
                        
                    </p>
                    <button class="btn-couture-plain article-sidebar__content__cart-btn" wire:click="addToCart">{{ __('sidebar.add-to-cart') }}</button>
                    @else
                    <p class="text-center mb-2">
                        {!! __('vouchers.added-to-cart') !!}
                    </p>
                    <a href="{{ route('cart-'.app()->getLocale()) }}" class="block btn-couture-plain article-sidebar__content__cart-btn" style="padding-top: 10px;">
                        {{ __('vouchers.go-to-cart') }}
                    </a>
                    @endif
                @else
                    <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="block btn-couture-plain btn-couture-plain--fit article-sidebar__content__cart-btn" style="height: auto; padding-top: 10px;">
                        {{ __('sidebar.order-other') }}
                    </a>
                @endif

                <p class="article-sidebar__content__size-check">
                    {!! __('sidebar.size-not-sure') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-sizes')]) }}" target="_blank" class="primary-color hover:underline"><strong>{{ __('sidebar.size-guide') }}</strong></a>
                </p>

                <ul class="article-sidebar__content__list">
                    <li class="flex justify-between" wire:click="switchDisplay('composition')">
                        <p>{{ __('sidebar.composition') }}</p> @svg('chevron-down')
                    </li>
                    <li class="flex justify-between" wire:click="switchDisplay('care')">
                        <p>{{ __('sidebar.care') }}</p> @svg('chevron-down')
                    </li>
                    <li class="flex justify-between" wire:click="switchDisplay('delivery')" id="sidebar-btn-delivery">
                        <p>{{ __('sidebar.delivery') }}</p> @svg('chevron-down')
                    </li>
                    <li class="flex justify-between" wire:click="switchDisplay('more')">
                        <p>{{ __('sidebar.more-details') }}</p> @svg('chevron-down')
                    </li>
                </ul>

                <p class="article-sidebar__content__contact">
                    {!! __('sidebar.questions') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" class="primary-color">{{ __('sidebar.contact-us') }}</a>
                </p>
             
            @elseif($content == 'composition')
                <h3 class="article-sidebar__content__compo__title">
                    {{ __('sidebar.composition') }}
                </h3>

                <h5 class="article-sidebar__content__compo__title-expl">{!! __('sidebar.composition-title') !!}</h5>

                <ul class="article-sidebar__content__compo__list">
                    @foreach($variation->compositions as $composition)
                    <li>
                        <img src="{{ asset('media/pictures/composition/'.$composition->picture) }}">
                        <h5>
                            {{ ucfirst($composition->$fabric_query) }} <span class="article-sidebar__content__compo__detail">- {{ $composition->$explanation_query }}</span>
                        </h5>
                        <p>
                            <!-- {{ $composition->$explanation_query }} -->
                        </p>
                    </li>
                    @endforeach
                </ul>
            @elseif($content == 'care')
                <h3 class="article-sidebar__content__compo__title">
                    {{ __('sidebar.care') }}
                </h3>

                <h5 class="article-sidebar__content__compo__title-expl">
                    {!! __('sidebar.care-title') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-care')]) }}">{!! __('sidebar.care-title-link') !!}</a>
                </h5>

                <ul class="article-sidebar__content__care__list">
                    @foreach($variation->care_recommendations as $recommendation)
                    <li class="flex mb-3">
                        @svg('care/'.$recommendation->picture)
                        <p>
                            {{ $recommendation->$desc_query }}
                        </p>
                    </li>
                    @endforeach
                </ul>

            @elseif($content == 'delivery')
                <h3 class="article-sidebar__content__compo__title mb-3">
                    {!! __('sidebar.delivery-costs') !!}
                </h3>
                <p class="mb-0 md:mb-10 article-sidebar__content__compo__title-expl">
                    {!! __('sidebar.delivery-costs-info-1') !!}
                    <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-delivery')]) }}" target="_blank" class="primary-color hover:underline">{!! __('sidebar.delivery-costs-info-1-link') !!}</a>.
                </p>

                <h3 class="article-sidebar__content__compo__title mb-3">
                    {!! __('sidebar.returns') !!}
                </h3>
                <p class="mb-10 lg:mb-2 article-sidebar__content__compo__title-expl">
                    {!! __('sidebar.returns-info-1') !!}
                    <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-return')]) }}" target="_blank" class="primary-color hover:underline">{!! __('sidebar.returns-info-1-link') !!}</a>.
                </p>
            @elseif($content == 'more')
                <h3 class="article-sidebar__content__compo__title">
                    {{ __('sidebar.more-details') }}
                </h3>

                <h5 class="article-sidebar__content__compo__title-expl mb-10">{!! __('sidebar.more-details-title') !!}</h5>

                <ul class="article-sidebar__content__more__list">
                    @foreach($variation->creation->keywords as $keyword)
                        <li class="flex mb-3">
                            <div class="pt-3">
                                @svg('list_cintre')
                            </div> 
                            <p class="pl-4">
                                {{ $keyword->$keyword_query }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
</div>
