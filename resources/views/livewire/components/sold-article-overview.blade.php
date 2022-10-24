<div class="sold-overview" wire:click="triggerSideBar">
    <div class="sold-overview__cap sold-overview__cap--grey"></div>
    <div class="sold-overview__img-container">
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
    <div class="sold-overview__footer">
        <div class="flex justify-between">
            <p class="sold-overview__footer__size">
                @if($article->size->value == 'unique')
                {{ __('components.unique-size') }}
                @else
                    @if($article->creation->creation_category->filter_key == 'bonnets')
                    {{ $article->size->value }}cm
                    @else
                    {{ $article->size->value }}
                    @endif
                @endif
            </p>
            @if($article->color->name == 'multicolor')
                <div class="color-circle">
                    <img src="{{ asset('media/pictures/multicolor.png') }}">
                </div>
            @else
                <div class="color-circle color-circle--{{ $article->color->name }}"></div>
            @endif
        </div>
        <p class="sold-overview__footer__category">
            {{ $localized_creation_category }}
        </p>
        <p class="sold-overview__footer__name">
            {{ strtoupper($article->name) }}
        </p>
        <div class="flex justify-between">
            <p class="sold-overview__footer__price">
                {{ __('models.sold-sold') }}
            </p>
            @auth
            <div class="article-overview__footer__heart" wire:click.prevent.stop="toggleWishlist">
                @if(!$is_wishlisted)
                <div class="article-overview__footer__heart__icon">
                    <i class="far fa-heart"></i>
                </div>
                <div class="article-overview__footer__heart__icon article-overview__footer__heart__icon--hovered">
                    <i class="fas fa-heart"></i>
                </div>
                @else
                <div class="article-overview__footer__heart__icon article-overview__footer__heart__icon--active">
                    <i class="fas fa-heart"></i>
                </div>
                @endif
            </div>
            @else
            <div class="article-overview__footer__heart tooltip" wire:click.prevent.stop="toggleWishlist">
                <div class="article-overview__footer__heart__icon">
                    <i class="far fa-heart"></i>
                </div>
                <div class="article-overview__footer__heart__icon article-overview__footer__heart__icon--hovered">
                    <i class="fas fa-heart"></i>
                </div>
                <span class="tooltiptext tooltiptext--left">
                    {!! __('models.please-login') !!}
                </span>
            </div>
            @endauth
        </div>
    </div>
</div>