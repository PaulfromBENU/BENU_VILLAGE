<form method="POST" wire:submit.prevent="updateGiftInfo" class="cart-gift-modal">
    @csrf
    <div class="cart-gift-modal__close-container" wire:click="closeModal">
        <div class="cart-gift-modal__close">
            {{ __('sidebar.close') }} <span class="pl-2">&#10005;</span>
        </div>
    </div>

    <h4>{{ __('cart.article-is-gift') }}</h4>
    
    @if($article_id > 0)
    <div class="flex flex-col lg:flex-row justify-center">
        <button class="cart-gift-modal__section-btn @if($section == 'wrapping') cart-gift-modal__section-btn--active @endif" wire:click.prevent.stop="changeSection('wrapping')">
            {{ __('cart.gift-wrapping') }}
        </button>
        <button class="cart-gift-modal__section-btn @if($section == 'card') cart-gift-modal__section-btn--active @endif" wire:click.prevent.stop="changeSection('card')">
            {{ __('cart.unique-card') }}
        </button>
        <button class="cart-gift-modal__section-btn @if($section == 'message') cart-gift-modal__section-btn--active @endif" wire:click.prevent.stop="changeSection('message')">
            {{ __('cart.unique-message') }}
        </button>
    </div>

    <div class="cart-gift-modal__wrapping" @if($section !== 'wrapping') style="display: none;" @endif>
        <div class="cart-gift-modal__wrapping__input">
            <input type="checkbox" name="cart_add_wrapping" wire:model="with_wrapping" id="cart-add-wrapping">
            <label for="cart-add-wrapping">{{ __('cart.add-wrapping') }} <span class="pl-1 lg:pl-3 font-bold">
                @if(session('has_kulturpass') !== null)
                + 2.50&euro;
                @else
                + 5&euro;
                @endif
            </span></label>
        </div>
        <p>
            {{ __('cart.add-wrapping-txt') }}
        </p>
    </div>

    <div class="cart-gift-modal__card" @if($section !== 'card') style="display: none;" @endif>
        <h5>{{ __('cart.add-card') }} <span class="pl-3 font-bold">
            @if(session('has_kulturpass') !== null)
                + 1.50&euro;
            @else
                + 3&euro;
            @endif

        </span></h5>
        <div class="flex justify-start lg:justify-center cart-gift-modal__card-container">
            <!-- <div class="cart-gift-modal__card__type @if($card_type == 1) cart-gift-modal__card__type--active @endif" wire:click="updateCard(1)">
                <div class="cart-gift-modal__card__type__svg-container">
                    <img src="{{ asset('media/pictures/gift_card_1.png') }}" alt="Gift card from BENU" title="Gift Card" />
                </div>
                <div>
                    <input type="radio" name="cart_add_card" value="1" wire:model="card_type" wire:click="updateCard(1)" id="cart-add-card-1">
                    <label for="cart-add-card-1">{{ __('cart.add-specific-card') }} #1</label>
                </div>
            </div> -->
            <div class="cart-gift-modal__card__type @if($card_type == 1) cart-gift-modal__card__type--active @endif" wire:click="updateCard(1)">
                <div class="cart-gift-modal__card__type__svg-container">
                    <img src="{{ asset('media/pictures/gift_card_1.jpg') }}" alt="Gift card from BENU" title="Gift Card" />
                </div>
                <div>
                    <input type="radio" name="cart_add_card" value="1" wire:model="card_type" wire:click="updateCard(1)" id="cart-add-card-2">
                    <label for="cart-add-card-2">{{ __('cart.add-specific-card') }} #1</label>
                </div>
            </div>
            <div class="cart-gift-modal__card__type @if($card_type == 2) cart-gift-modal__card__type--active @endif" wire:click="updateCard(2)">
                <div class="cart-gift-modal__card__type__svg-container">
                    <img src="{{ asset('media/pictures/gift_card_2.jpg') }}" alt="Gift card from BENU" title="Gift Card" />
                </div>
                <div>
                    <input type="radio" name="cart_add_card" value="2" wire:model="card_type" wire:click="updateCard(2)" id="cart-add-card-3">
                    <label for="cart-add-card-3">{{ __('cart.add-specific-card') }} #2</label>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-gift-modal__message" @if($section !== 'message') style="display: none;" @endif>
        <h5>{{ __('cart.add-message') }}<span class="pl-3 font-bold uppercase">{{ __('cart.add-message-free') }}</span></h5>
        <div class="relative">
            <div class="absolute cart-gift-modal__message__placeholder">
                {{ __('cart.my-message') }}
            </div>
            <textarea wire:model="message" class="w-full" rows="5" maxlength="250" placeholder="{{ __('cart.add-message-max-length') }}"></textarea>
        </div>
    </div>

    <div class="text-center cart-gift-modal__confirm-btn">
        <button type="submit" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover m-auto">
            {{ __('cart.gift-confirm-options') }}
        </button>
    </div>

    @endif
</form>