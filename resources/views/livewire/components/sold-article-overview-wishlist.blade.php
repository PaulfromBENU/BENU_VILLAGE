<div class="sold-overview-wishlist">
    <div class="sold-overview-wishlist__cap sold-overview-wishlist__cap--grey"></div>
    <div class="flex flex-col md:flex-row justify-start">
        <div class="sold-overview-wishlist__img-container">
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

        <div class="sold-overview-wishlist__footer">
            <div class="flex justify-between">
                <p class="sold-overview-wishlist__footer__size">
                    {{ $article->size->value }}
                </p>
                @auth
                <div class="sold-overview-wishlist__footer__heart" wire:click.prevent.stop="toggleWishlist">
                    @if(!$is_wishlisted)
                    <div class="sold-overview-wishlist__footer__heart__icon">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="sold-overview-wishlist__footer__heart__icon sold-overview-wishlist__footer__heart__icon--hovered">
                        <i class="fas fa-heart"></i>
                    </div>
                    @else
                    <div class="sold-overview-wishlist__footer__heart__icon sold-overview-wishlist__footer__heart__icon--active">
                        <i class="fas fa-heart"></i>
                    </div>
                    @endif
                </div>
                @else
                <div class="sold-overview-wishlist__footer__heart">
                    <div class="sold-overview-wishlist__footer__heart__icon" style="color: grey;">
                        <i class="far fa-heart"></i>
                    </div>
                </div>
                @endauth
            </div>
            <p class="sold-overview-wishlist__footer__category">
                {{ $localized_creation_category }}
            </p>
            <p class="sold-overview-wishlist__footer__name">
                {{ strtoupper($article->name) }}
            </p>
            <div class="flex justify-between">
                <p class="sold-overview-wishlist__footer__price">
                    {{ __('models.sold-sold') }}
                </p>
            </div>
        </div>
    </div>
</div>