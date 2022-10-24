<div class="grid grid-cols-10 lg:grid-cols-8 cart-content__article">
    @if($article->name == 'voucher')
    <a target="_blank" href="{{ route('vouchers-'.app()->getLocale()) }}" class="block col-span-4 lg:col-span-1 cart-content__article__img-container">
    @else
    <a target="_blank" href="{{ route('model-'.app()->getLocale(), ['name' => strtolower($article->creation->name), 'article' => strtolower($article->name)]) }}" class="block col-span-4 lg:col-span-1 cart-content__article__img-container">
    @endif
        @if($article->name == 'voucher')
        <img src="{{ asset('media/pictures/photo_voucher.jpg') }}" alt="BENU vouchers" title="BENU Vouchers" />
        @elseif($article->photos()->where('is_front', '1')->count() > 0)
        <img src="{{ asset('media/pictures/articles/'.$article->photos()->where('is_front', '1')->first()->file_name) }}">
        @else
        <img src="{{ asset('media/pictures/articles/'.$article->photos()->first()->file_name) }}">
        @endif
    </a>

    <div class="col-span-2 cart-content__article__name tablet-hidden">
        @if($article->name == 'voucher')
        <h4>{{ __('cart.voucher') }}</h4>
        <p class="mt-1 rounded-2xl bg-red-100 primary-color text-md pt-1 pb-1 pl-3 pr-3 absolute">
            {{ __('cart.voucher-value') }} : {{ $article->carts()->where('carts.cart_id', session('cart_id'))->first()->pivot->value }}&euro;
        </p>
        @else
        <h4>{{ strtoupper($article->name) }}</h4>
        @endif
        @if($article->pending_shops()->where('filter_key', '<>', 'benu-esch')->count() > 0)
        <button class=" mt-1 rounded-2xl bg-red-100 primary-color text-md pt-1 pb-1 pl-3 pr-3 hover:text-white hover:bg-gray-800 transition absolute" wire:click="showInfoModal">
            {{ __('cart.in-pop-up-store') }} +
        </button>
        @endif
        @if($has_extra_option)
        <div class="mt-2 text-md font-normal flex">
            <input type="checkbox" class="rounded mr-2" name="with_extra_option" wire:model="with_extra_option" style="margin-top: 5px;" id="with_extra_option_{{ $article->id }}">
            <label for="with_extra_option_{{ $article->id }}">{{ __('cart.with-extra-pillow') }} : <span class="primary-color font-bold">
                @if(session('has_kulturpass') !== null)
                +&nbsp;5&euro;</span></label>
                @else
                +&nbsp;10&euro;</span></label>
                @endif
        </div>
        @endif
        <div class="flex cart-content__article__name__checkbox">
            <input type="checkbox" name="article_cart_gift" id="article-cart-{{ $article->id }}" wire:model="is_gift">
            <label for="article-cart-{{ $article->id }}" class="pl-2 @if($is_gift) primary-color @endif">{{ __('cart.article-is-gift') }}</label>
            @if($is_gift)
                @svg('icon_gift', 'cart-content__article__name__checkbox__svg-active')
            @else
                @svg('icon_gift')
            @endif
        </div>
    </div>
    <div class="tablet-hidden">
        <div class="cart-content__article__size text-center">
            @if($article->name == 'voucher')
                @if($article->voucher_type == 'pdf')
                    PDF
                @else
                    {{ __('vouchers.fabric') }}
                @endif
            @else
                @if($article->size->value == 'unique')
                {{ __('components.unique-size') }}
                @else
                {{ $article->size->value }}
                @endif
            @endif
        </div>
    </div>
    <div class="tablet-hidden">
        @if($article->name == 'voucher')
        <div class="cart-content__article__color">
            
        </div>
        @elseif($article->color->name == 'multicolored')
        <div class="cart-content__article__color">
            <img src="{{ asset('media/pictures/multicolor.png') }}">
        </div>
        @else
        <div class="cart-content__article__color" style="background: {{ $article->color->hex_code }}"></div>
        @endif
    </div>
    <div class="tablet-hidden">
        <div class="cart-content__article__number flex justify-center">
            <p class="text-center">
                x{{ $number }}
            </p>
            @if($max_number > 1)
            <div class="ml-3 mt-2 xl:mt-3">
                <p class="article-sidebar__content__mask-btn" wire:click="updateNumber('up')">
                    <i class="fas fa-plus"></i>
                </p>
                <p class="article-sidebar__content__mask-btn" wire:click="updateNumber('down')">
                    <i class="fas fa-minus"></i>
                </p>
            </div>
            @endif
        </div>
    </div>
    <div class="tablet-hidden">
        <div class="cart-content__article__price">
            @if($article->name == 'voucher')
                @if($article->voucher_type == 'pdf')
                {{ $article->carts()->where('carts.cart_id', session('cart_id'))->first()->pivot->value }}&euro;
                @else
                    @if(session('has_kulturpass') !== null)
                        {{ $article->carts()->where('carts.cart_id', session('cart_id'))->first()->pivot->value + 2.5 }}&euro;
                    @else
                        {{ $article->carts()->where('carts.cart_id', session('cart_id'))->first()->pivot->value + 5 }}&euro;
                    @endif
                @endif
            @else
                @if($article->is_extra_accessory)
                    @if(session('has_kulturpass') !== null)
                        {{ round($article->specific_price / 2, 2) }}&euro;
                    @else
                        {{ $article->specific_price }}&euro;
                    @endif
                @else
                    @if(session('has_kulturpass') !== null)
                        {{ round($article->creation->price / 2, 2) }}&euro;
                    @else
                        {{ $article->creation->price }}&euro;
                    @endif
                @endif
            @endif

            @if($gift_price > 0)
            <p class="primary-color text-left lg:text-right pr-5" style="margin-top: 50px;">
                @if(session('has_kulturpass') !== null)
                + {{ $gift_price / 2 }}&euro;
                @else
                + {{ $gift_price }}&euro;
                @endif
            </p>
            @endif
        </div>
    </div>
    <div class="tablet-hidden">
        <div class="flex justify-end cart-content__article__icons">
            @auth
            <div class="cart-content__article__icons__heart" wire:click.prevent.stop="toggleWishlist">
                @if(!$is_wishlisted)
                <div class="cart-content__article__icons__heart__icon">
                    <i class="far fa-heart"></i>
                </div>
                <div class="cart-content__article__icons__heart__icon cart-content__article__icons__heart__icon--hovered">
                    <i class="fas fa-heart"></i>
                </div>
                @else
                <div class="cart-content__article__icons__heart__icon cart-content__article__icons__heart__icon--active">
                    <i class="fas fa-heart"></i>
                </div>
                @endif
            </div>
            @else
            <div class="cart-content__article__icons__heart tooltip" wire:click.prevent.stop="toggleWishlist">
                <div class="cart-content__article__icons__heart__icon">
                    <i class="far fa-heart"></i>
                </div>
                <div class="cart-content__article__icons__heart__icon cart-content__article__icons__heart__icon--hovered">
                    <i class="fas fa-heart"></i>
                </div>
                <span class="tooltiptext tooltiptext--top">
                    {!! __('models.please-login') !!}
                </span>
            </div>
            @endauth
            <div class="cart-content__article__icons__trash" wire:click="removeItem">
                @svg('icon_trash')
            </div>
        </div>
    </div>




    <div class="col-span-6 cart-content__article__name relative mobile-only">
        @if($article->name == 'voucher')
        <div class="flex justify-start flex-wrap">
            <h4 class="mr-3" style="min-width: fit-content;">{{ __('cart.voucher') }}</h4>
            <p class="mt-1 rounded-2xl bg-red-100 primary-color text-md pt-1 pb-1 pl-3 pr-3 mb-2" style="width: fit-content;">
                {{ __('cart.voucher-value') }} : {{ $article->carts()->where('carts.cart_id', session('cart_id'))->first()->pivot->value }}&euro;
            </p>
        </div>
        @else
        <h4>{{ strtoupper($article->name) }}</h4>
        @endif
        @if($article->pending_shops()->where('filter_key', '<>', 'benu-esch')->count() > 0)
        <button class=" mt-1 rounded-2xl bg-red-100 primary-color text-md pt-1 pb-1 pl-3 pr-3 hover:text-white hover:bg-gray-800 transition absolute" wire:click="showInfoModal">
            {{ __('cart.in-pop-up-store') }} +
        </button>
        @endif

        <div class="cart-content__article__size">
            @if($article->name == 'voucher')
                @if($article->voucher_type == 'pdf')
                    PDF
                @else
                    {{ __('vouchers.fabric') }}
                @endif
            @else
                @if($article->size->value == 'unique')
                {{ __('components.unique-size') }}
                @else
                {{ $article->size->value }}
                @endif
            @endif
        </div>

        @if($article->name == 'voucher')
        <!-- <div class="cart-content__article__color">
            
        </div> -->
        <div style="height: 1px;"></div>
        @elseif($article->color->name == 'multicolored')
        <div class="cart-content__article__color-mobile flex">
            <p class="mr-2">
                {{ __('cart.color') }}
            </p>
            <div class="cart-content__article__color flex">
                <img src="{{ asset('media/pictures/multicolor.png') }}">
            </div>
            <p>
                {{ __('colors.'.$article->color->name) }}
            </p>
        </div>
        @else
        <div class="cart-content__article__color-mobile flex">
            <p class="mr-2">
                {{ __('cart.color') }}
            </p>
            <div class="cart-content__article__color" style="background: {{ $article->color->hex_code }}"></div>
            <p>
                {{ __('colors.'.$article->color->name) }}
            </p>
        </div>
        @endif

        <div class="cart-content__article__number flex justify-start flex-wrap mt-2">
            @if($max_number > 1)
            <div class="mt-1 flex">
                <p class="cart-content__article__number__counter" wire:click="updateNumber('down')">
                    <i class="fas fa-minus"></i>
                </p>
                <p class="cart-content__article__number__counter" wire:click="updateNumber('up')">
                    <i class="fas fa-plus"></i>
                </p>
            </div>
            @endif
            <p>
                {{ __('cart.number-of-items') }} <strong class="text-2xl">x{{ $number }}</strong>
            </p>
        </div>

        <div class="cart-content__article__price flex justify-between flex-wrap">
            <div>
                @if($article->name == 'voucher')
                    @if($article->voucher_type == 'pdf')
                    {{ $article->carts()->where('carts.cart_id', session('cart_id'))->first()->pivot->value }}&euro;
                    @else
                    {{ $article->carts()->where('carts.cart_id', session('cart_id'))->first()->pivot->value + 5 }}&euro;
                    @endif
                @else
                    @if($article->is_extra_accessory)
                        @if(session('has_kulturpass') !== null)
                            {{ round($article->specific_price / 2, 2) }}&euro;
                        @else
                            {{ $article->specific_price }}&euro;
                        @endif
                    @else
                        @if(session('has_kulturpass') !== null)
                            {{ round($article->creation->price / 2, 2) }}&euro;
                        @else
                            {{ $article->creation->price }}&euro;
                        @endif
                    @endif
                @endif

                @if($gift_price > 0)
                <p class="primary-color text-left lg:text-right" style="margin-top: 5px;">
                    @if(session('has_kulturpass') !== null)
                    + {{ $gift_price / 2 }}&euro;
                    @else
                    + {{ $gift_price }}&euro;
                    @endif
                </p>
                @endif
            </div>
            <div class="flex pr-2">
                @auth
                <div class="cart-content__article__icons__heart" wire:click.prevent.stop="toggleWishlist">
                    @if(!$is_wishlisted)
                    <div class="cart-content__article__icons__heart__icon">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="cart-content__article__icons__heart__icon cart-content__article__icons__heart__icon--hovered">
                        <i class="fas fa-heart"></i>
                    </div>
                    @else
                    <div class="cart-content__article__icons__heart__icon cart-content__article__icons__heart__icon--active">
                        <i class="fas fa-heart"></i>
                    </div>
                    @endif
                </div>
                @else
                <div class="cart-content__article__icons__heart tooltip" wire:click.prevent.stop="toggleWishlist">
                    <div class="cart-content__article__icons__heart__icon">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="cart-content__article__icons__heart__icon cart-content__article__icons__heart__icon--hovered">
                        <i class="fas fa-heart"></i>
                    </div>
                    <span class="tooltiptext tooltiptext--top">
                        {!! __('models.please-login') !!}
                    </span>
                </div>
                @endauth
                <div class="cart-content__article__icons__trash" wire:click="removeItem">
                    @svg('icon_trash')
                </div>
            </div>
        </div>

<!--         <div class="flex justify-end cart-content__article__icons"> -->
        
        <!-- </div> -->
    </div>
    <div class="col-span-10 pl-1 mobile-only">
        @if($has_extra_option)
        <div class="flex cart-content__article__name__checkbox">
            <input type="checkbox" name="with_extra_option" wire:model="with_extra_option" id="with_extra_option_{{ $article->id }}">
            <label class="pl-2" for="with_extra_option_{{ $article->id }}">{{ __('cart.with-extra-pillow') }} : <span class="primary-color font-bold">
                @if(session('has_kulturpass') !== null)
                +&nbsp;5&euro;</span></label>
                @else
                +&nbsp;10&euro;</span></label>
                @endif
        </div>
        @endif
        <div class="flex cart-content__article__name__checkbox">
            <input type="checkbox" name="article_cart_gift" id="article-cart-{{ $article->id }}" wire:model="is_gift">
            <label for="article-cart-{{ $article->id }}" class="pl-2 @if($is_gift) primary-color @endif">{{ __('cart.article-is-gift') }}</label>
            @if($is_gift)
                @svg('icon_gift', 'cart-content__article__name__checkbox__svg-active')
            @else
                @svg('icon_gift')
            @endif
        </div>
    </div>
</div>
