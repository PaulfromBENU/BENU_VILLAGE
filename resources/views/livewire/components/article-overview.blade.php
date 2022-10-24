<div class="article-overview" wire:click="triggerSideBar">
    <div class="article-overview__cap article-overview__cap--red"></div>
    <div class="article-overview__img-container">
        @if($is_pop_up == 1)
        <div class="article-overview__img-container__partner-icon">
            <div class="article-overview__img-container__partner-icon__content flex justify-between">
                <div class="flex flex-col justify-center">
                    <p class="pl-2 pr-2 text-sm">
                        <em>{{ $article->available_shops()->first()->name }}</em>
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
    <div class="article-overview__footer">
        <div class="flex justify-between">
            <p class="article-overview__footer__size">
                @if($article->size->value == 'unique')
                {{ __('components.unique-size') }}
                @elseif($article->size->value == 'unique-kids')
                {{ __('components.unique-size-kids') }}
                @elseif($article->size->value == 'unique-youth')
                {{ __('components.unique-size-youth') }}
                @else
                    @if($article->creation->creation_category->filter_key == 'bonnets')
                    {{ $article->size->value }}cm
                    @else
                    {{ $article->size->value }}
                    @endif
                @endif
            </p>
            @if($article->color->name == 'multicolored')
                <div class="color-circle">
                    <img src="{{ asset('media/pictures/multicolor.png') }}">
                </div>
            @else
                <div class="color-circle color-circle--{{ $article->color->name }}"></div>
            @endif
        </div>
        <p class="article-overview__footer__category">
            {{ $localized_creation_category }}
        </p>
        <p class="article-overview__footer__name">
            {{ strtoupper($article->name) }}
        </p>
        <div class="flex justify-between">
            <p class="article-overview__footer__price">
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