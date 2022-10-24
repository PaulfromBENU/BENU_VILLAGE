<div class="article-overview-wishlist">
    <div class="article-overview-wishlist__cap article-overview-wishlist__cap--red"></div>
    <div class="flex flex-col md:flex-row justify-start">
        <div class="article-overview-wishlist__img-container">
            @if($is_pop_up == 1)
            <div class="article-overview-wishlist__img-container__partner-icon">
                <div class="article-overview-wishlist__img-container__partner-icon__content flex justify-between">
                    <div class="flex flex-col justify-center">
                        <p class="pl-2 pr-2 text-sm">
                            <em>{{ __('components.other-shop') }}</em>
                        </p>
                    </div>
                    <div>
                        @svg('icon_pop_up_store')
                    </div>
                </div>
            </div>
            @endif
            <img src="{{ asset('media/pictures/articles/'.$pictures[$current_picture_index]) }}" alt="Model {{ $article->creation->name }}">
            @if($pictures->count() > 1)
                <div class="slider-arrow slider-arrow--color-2 slider-arrow--left" wire:click.prevent.stop="changePicture('left')">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="slider-arrow slider-arrow--color-2 slider-arrow--right" wire:click.prevent.stop="changePicture('right')">
                    <i class="fas fa-chevron-right"></i>
                </div>
            @endif
        </div>

        <div class="article-overview-wishlist__footer">
            <div class="flex justify-between">
                <p class="article-overview-wishlist__footer__size">
                    {{ $article->size->value }}
                </p>
                @auth
                <div class="article-overview-wishlist__footer__heart" wire:click.prevent.stop="toggleWishlist">
                    @if(!$is_wishlisted)
                    <div class="article-overview-wishlist__footer__heart__icon">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="article-overview-wishlist__footer__heart__icon article-overview-wishlist__footer__heart__icon--hovered">
                        <i class="fas fa-heart"></i>
                    </div>
                    @else
                    <div class="article-overview-wishlist__footer__heart__icon article-overview-wishlist__footer__heart__icon--active">
                        <i class="fas fa-heart"></i>
                    </div>
                    @endif
                </div>
                @else
                <div class="article-overview-wishlist__footer__heart">
                    <div class="article-overview-wishlist__footer__heart__icon" style="color: grey;">
                        <i class="far fa-heart"></i>
                    </div>
                </div>
                @endauth
            </div>
            <p class="article-overview-wishlist__footer__category">
                {{ $localized_creation_category }}
            </p>
            <p class="article-overview-wishlist__footer__name">
                {{ strtoupper($article->name) }}
            </p>
            <div>
                <p class="article-overview-wishlist__footer__price">
                    @if($article->is_extra_accessory == '1')
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
                </p>
            </div>
            <div>
                @if($sent_to_cart == 0)
                <button class="btn-couture-plain btn-couture-plain--dark-hover article-overview-wishlist__footer__btn" wire:click.prevent.stop="addToCart">{{ __('sidebar.add-to-cart') }}</button>
                @else
                <!-- <p class="text-left mt-5">
                    {{ __('vouchers.added-to-cart') }}
                </p> -->
                <a class="block btn-couture-plain btn-couture-plain--dark-hover btn-couture-plain--fit article-overview-wishlist__footer__btn" href="{{ route('cart-'.app()->getLocale()) }}">{{ __('sidebar.go-to-cart') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>