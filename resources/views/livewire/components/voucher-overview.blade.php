<div class="article-overview" wire:click="triggerSideBar">
    <div class="article-overview__cap article-overview__cap--red"></div>
    <div class="article-overview__img-container">
        <img src="{{ asset('media/pictures/photo_voucher.jpg') }}" alt="BENU vouchers" title="BENU Vouchers">
    </div>
    <div class="article-overview__footer">
        <div class="flex justify-start">
            @if($voucher->voucher_type == 'pdf')
            <p class="article-overview__footer__size">
                {{ __('vouchers.format-pdf') }}
            </p>
            @else
            <p class="article-overview__footer__size">
                {{ __('vouchers.format-clothe') }}
            </p>
            @endif
        </div>
        <p class="article-overview__footer__category">
            
        </p>
        <p class="article-overview__footer__name">
            {{ __('vouchers.card-name') }}
        </p>
        <div class="flex justify-between">
            <p class="article-overview__footer__price" style="font-size: 2rem;">
                {{ __('vouchers.card-price') }} 30&euro;
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