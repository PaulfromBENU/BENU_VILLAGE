<section class="payment-tunnel">
    @inshop
    <!-- Case administrator selling items in shop -->
    <div class="payment-tunnel__in-shop">
        <h2>
            {{ __('cart.payment-in-shop-title') }}
        </h2>
        <p class="mb-10">
            {{ __('cart.payment-in-shop-explanation') }}
        </p>

        <form class="payment-tunnel__in-shop__form" method="POST" wire:submit.prevent="sellFromShop">
            @csrf
            <p class="payment-tunnel__in-shop__form__explanation">
                {{ __('cart.payment-in-shop-optional-client-info') }}
            </p>
            <p class="text-left mb-4">
                @if(session('has_kulturpass') !== null)
                    <a href="{{ route('forget-kulturpass', ['locale' => app()->getLocale()]) }}" class="primary-color hover:text-gray-800 transition font-bold">{{ __('cart.payment-in-shop-has-no-kulturpass') }}</a>
                @else
                    <a href="{{ route('add-kulturpass', ['locale' => app()->getLocale()]) }}" class="primary-color hover:text-gray-800 transition font-bold">{{ __('cart.payment-in-shop-has-kulturpass') }}</a>
                @endif
            </p>
            <div class="flex justify-between flex-wrap flex-col lg:flex-row">
                <div class="w-full lg:w-2/5">
                    <label for="inshop_first_name">{{ __('forms.first-name') }}</label>
                    <input type="text" id="inshop_first_name" name="inshop_first_name" wire:model.defer="inshop_first_name" class="input-underline w-full" tabindex="1" minlength="2" maxlength="255">
                </div>
                <div class="w-full lg:w-2/5">
                    <label for="inshop_last_name">{{ __('forms.last-name') }}</label>
                    <input type="text" id="inshop_last_name" name="inshop_last_name" wire:model.defer="inshop_last_name" class="input-underline w-full" tabindex="2" minlength="2" maxlength="255">
                </div>
            </div>
            <div class="w-full mt-4">
                <label for="inshop_email">{{ __('forms.email') }}</label>
                <input type="email" id="inshop_email" name="inshop_email" wire:model.defer="inshop_email" class="input-underline w-full" tabindex="3" minlength="2" maxlength="255">
            </div>
            <div class="mt-6 pb-5" style="border-bottom: solid 1px #D41C1B;">
                <label for="inshop_newsletter" class="inline-flex items-center">
                    <input id="inshop_newsletter" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm" name="inshop_newsletter" value="1" tabindex="4" style="margin-top: 2px;">
                    <span class="ml-5">{{ __('forms.subscribe-to-newsletter') }}</span>
                </label>
            </div>

            <div class="w-full mt-8">
                <label for="inshop_security">{{ __('forms.security-code') }} *</label>
                <input type="password" id="inshop_security" name="inshop_security" wire:model.defer="inshop_security" class="input-underline w-full" tabindex="5" minlength="2" maxlength="255" required>
            </div>

            <div class="w-full mt-8">
                <p class="mb-5">
                    Paiement&nbsp;:
                    <!-- {{ __('forms.payment-types-label') }} -->
                </p>
                <div class="flex justify-start md:justify-center flex-wrap">
                    <div class="w-full md:w-1/4 text-center">
                        <input type="radio" id="payment-type-card" name="payment_type" value="card" style="margin-top: 0;" checked wire:model="inshop_payment_type">
                        <label for="payment-type-card" class="pl-2">
                            Credit Card / SumUp
                        </label>
                    </div>
                    <div class="w-full md:w-1/4 text-center">
                        <input type="radio" id="payment-type-cash" name="payment_type" value="cash" style="margin-top: 0;" wire:model="inshop_payment_type">
                        <label for="payment-type-cash" class="pl-2">
                            Cash
                        </label>
                    </div>
                    <div class="w-full md:w-1/4 text-center">
                        <input type="radio" id="payment-type-payconiq" name="payment_type" value="payconiq" style="margin-top: 0;" wire:model="inshop_payment_type">
                        <label for="payment-type-payconiq" class="pl-2">
                            Payconiq
                        </label>
                    </div>
                </div>
            </div>

            <div class="w-full mt-8 text-center">
                <p class="mb-5">
                    <span class="uppercase">{{ __('cart.payment-in-shop-warning') }}</span> {{ __('cart.payment-in-shop-pay-before-validate') }}
                </p>
                <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">{{ __('cart.payment-in-shop-validation') }}</button>
            </div>
        </form>
    </div>


    @else
    <!-- Case standard user on website -->
    <div class="payment-tunnel__identification payment-tunnel__block">
        <h2 class="payment-tunnel__block__title @if($step == 1) payment-tunnel__block__title--current @else payment-tunnel__block__title--finished @endif" wire:click="changeStep(1)" id="payment-tunnel-block-1">
            1. {{ __('cart.payment-id') }}
        </h2>
        <div class="payment-tunnel__block__content" @if($step > 1) style="display: none;" @endif>
            @guest
                @if($fill_info)
                    @livewire('cart.payment-tunnel-info-form')
                @else
                    <div class="payment-tunnel__identification__field mb-7">
                        <h4>{{ __('cart.payment-order-with-benu') }}</h4>
                        <p>
                            {{ __('cart.payment-connect-txt') }}
                        </p>
                        <div class="payment-tunnel__identification__field__btn-container flex flex-col justify-center">
                            <a href="{{ route('login-'.app()->getLocale()) }}" class="btn-couture">
                                {{ __('cart.payment-login') }}
                            </a>
                        </div>
                    </div>
                    <div class="payment-tunnel__identification__field">
                        <h4>{{ __('cart.payment-order-as-guest') }}</h4>
                        <p>
                            {{ __('cart.payment-order-as-guest-txt') }}
                        </p>
                        <div class="payment-tunnel__identification__field__btn-container flex flex-col justify-center">
                            <button class="btn-couture" wire:click="addInfo">
                                {{ __('cart.payment-info-choose') }}
                            </button>
                        </div>
                    </div>
                @endif
            @endguest
        </div>
        <div class="payment-tunnel__block__content" @if($step == 1) style="display:none;" @endif>
            @auth
                <div class="payment-tunnel__identification__logged">
                    {{ __('cart.payment-ordering-as') }} {{ ucfirst(auth()->user()->first_name) }} {{ ucfirst(auth()->user()->last_name) }} ({{ auth()->user()->email }})
                </div>
            @else
                <div class="payment-tunnel__identification__logged relative">
                    {{ __('cart.payment-ordering-as') }} {{ ucfirst($order_first_name) }} {{ ucfirst($order_last_name) }} ({{ $order_email }})
                    <div class="payment-tunnel__identification__modify flex flex-col justify-center">
                        <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" wire:click="changeStep(1)">{{ __('cart.payment-ordering-as-modify') }}</button>
                    </div>
                </div>
            @endauth
        </div>
    </div>


    <div class="payment-tunnel__delivery payment-tunnel__block">
        <h2 class="payment-tunnel__block__title  @if($step == 2) payment-tunnel__block__title--current @elseif($step == 1) payment-tunnel__block__title--waiting @else payment-tunnel__block__title--finished @endif" wire:click="changeStep(2)" id="payment-tunnel-block-2">
            2. {{ __('cart.payment-delivery') }}
        </h2>
        <div class="payment-tunnel__block__content" @if($step !== 2) style="display: none;" @endif>
            <div class="payment-tunnel__delivery__field">
                <h4>{{ __('cart.payment-delivery-info') }}</h4>
                @if(!$delivery_chosen)
                    <div>
                        <h5 class="mb-5"><strong>{{ __('cart.payment-choose-delivery') }}</strong></h5>
                        <div class="payment-tunnel__delivery__field__radio-block">
                            <input type="radio" name="delivery_method" value="0" wire:model="delivery_method" style="margin-top: -2px; margin-right: 5px;" id="delivery_method_collect">
                            <label for="delivery_method_collect">{{ __('cart.payment-delivery-in-shop-free') }}</label>
                        </div>
                        <div class="payment-tunnel__delivery__field__radio-block">
                            <input type="radio" name="delivery_method" value="1" wire:model="delivery_method" style="margin-top: -2px; margin-right: 5px;" id="delivery_method_delivery">
                            <label for="delivery_method_delivery">{{ __('cart.payment-delivery-at-home-with-fees') }}</label>
                        </div>
                        <button class="mt-5 btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" wire:click="selectDeliveryMethod">
                            {{ __('cart.payment-delivery-method-choose') }}
                        </button>
                    </div>
                @elseif(!$delivery_address_chosen)
                    <div class="mb-5 rounded-xl p-4 relative" style="border: #D41C1B solid 2px">
                        <h5 class="mb-2"><strong>{{ __('cart.payment-chosen-delivery-method') }}</strong></h5>
                        <div class="flex flex-col lg:flex-row justify-start lg:justify-between">
                            <p class="mb-1">
                                @if($pdf_voucher_only)
                                {{ __('cart.payment-delivery-pdf-voucher') }}
                                @elseif($delivery_method == '0')
                                {{ __('cart.payment-delivery-in-shop') }}
                                @else
                                {{ __('cart.payment-delivery-at-home') }}
                                @endif
                            </p>
                            <div class="text-right">
                                @if(!$pdf_voucher_only)
                                <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover payment-tunnel__delivery__field__btn" wire:click="updateDeliveryMethod">{{ __('cart.payment-btn-modify') }}</button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h3 class="font-bold text-xl mb-10 mt-10 text-center">{{ __('cart.payment-delivery-choose-address') }}</h3>

                    @if($fill_address)
                        @livewire('cart.payment-tunnel-address-form')
                    @else
                        @auth
                            @if(auth()->user()->addresses()->count() >= 1)
                                @if($address_chosen &&  $order_address_id > 0)
                                <p>
                                    {!! __('cart.payment-delivery-wish') !!}:
                                </p>
                                <div class="flex flex-col lg:flex-row justofy-start lg:justify-between payment-tunnel__delivery__address-container">
                                    <div class="payment-tunnel__delivery__address w-full lg:w-2/3">
                                        @include('includes.cart.cart_address_details')
                                    </div>

                                    <div class="w-full lg:w-1/3">
                                        <div>
                                            <button class="btn-couture mb-5" wire:click="changeAddress">
                                                {{ __('cart.payment-delivery-choose-other') }}
                                            </button>
                                        </div>
                                        <div>
                                            <a href="{{ route('dashboard', ['locale' => app()->getLocale(), 'section' => 'addresses']) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">
                                                {{ __('cart.payment-delivery-modify') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="flex justify-around flex-wrap mt-5 mb-10">
                                    @foreach(auth()->user()->addresses as $address)
                                        <div class="text-center w-full lg:w-2/5 mt-2 mb-2" wire:key="{{ $address->id }}">
                                            <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" wire:click="selectAddress({{ $address->id }})">
                                                {{ $address->address_name }}
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-center mt-5">
                                    <button class="btn-couture" wire:click="addAddress">
                                        + {{ __('cart.payment-delivery-add-new') }}
                                    </button>
                                </div>
                                @endif
                            @else
                            <div class="text-center mt-10">
                                <button class="btn-couture" wire:click="addAddress">
                                    + {{ __('cart.payment-delivery-add-new') }}
                                </button>
                            </div>
                            @endif
                        @else
                            @if(1 == 1)
                            <!--  -->
                            <div class="text-center mt-10">
                                <button class="btn-couture" wire:click="addAddress">
                                    + {{ __('cart.payment-delivery-add-new') }}
                                </button>
                            </div>
                            @else
                            <!-- <p>
                                {!! __('cart.payment-delivery-wish') !!}:
                            </p>
                            <div class="flex justify-between payment-tunnel__delivery__address-container">
                                <div class="payment-tunnel__delivery__address w-2/3">
                                    @include('includes.cart.cart_address_details')
                                </div>

                                <div class="w-1/3">
                                    <div>
                                        <button class="btn-couture mb-5" wire:click="changeAddress">
                                            {{ __('cart.payment-delivery-choose-other') }}
                                        </button>
                                    </div>
                                </div>
                            </div> -->
                            @endif
                        @endauth
                    @endif
                @else
                    <div class="mb-5 rounded-xl p-4 relative" style="border: #D41C1B solid 2px">
                        <h5 class="mb-2"><strong>{{ __('cart.payment-chosen-delivery-method') }}</strong></h5>
                        <div class="flex flex-col lg:flex-row jsutify-start lg:justify-between">
                            <p class="mb-1">
                                @if($pdf_voucher_only)
                                {{ __('cart.payment-delivery-pdf-voucher') }}
                                @elseif($delivery_method == '0')
                                {{ __('cart.payment-delivery-in-shop') }}
                                @else
                                {{ __('cart.payment-delivery-at-home') }}
                                @endif
                            </p>
                            <div class="text-right">
                                @if(!$pdf_voucher_only)
                                <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover payment-tunnel__delivery__field__btn" wire:click="updateDeliveryMethod">{{ __('cart.payment-btn-modify') }}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($delivery_method == 1)
                    <div class="mb-5 rounded-xl p-4 relative" style="border: #D41C1B solid 2px">
                        <h5 class="mb-2"><strong>{{ __('cart.payment-chosen-delivery-address') }}</strong></h5>
                        <div class="flex flex-col lg:flex-row justify-start lg:justify-between">
                            <div class="mb-1 payment-tunnel__delivery__address w-full lg:w-2/3">
                                @include('includes.cart.cart_address_details')
                            </div>
                            <div class="text-right">
                                <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover payment-tunnel__delivery__address__btn payment-tunnel__delivery__address__btn--1" wire:click="updateDeliveryAddress">{{ __('cart.payment-btn-modify') }}</button>

                                @auth
                                <a href="{{ route('dashboard', ['locale' => app()->getLocale(), 'section' => 'addresses']) }}" class="btn-couture btn-couture-plain--fit payment-tunnel__delivery__address__btn payment-tunnel__delivery__address__btn--2">
                                    {{ __('cart.payment-address-modify') }}
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!$address_chosen)
                        <h3 class="font-bold text-xl mb-10 mt-10 text-center">{{ __('cart.payment-choose-invoice-address') }}</h3>

                        @if(!$require_invoice_address)
                        <div class="flex flex-col lg:flex-row justify-start lg:justify-center">
                            <div class="m-5">
                                <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" wire:click="useDeliveryAddressForInvoice">
                                    {{ __('cart.payment-invoice-use-delivery') }}
                                </button>
                            </div>
                            <div class="m-5">
                                <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" wire:click="selectNewAddressForInvoice">
                                    {{ __('cart.payment-use-other-invoice-address') }}
                                </button>
                            </div>
                        </div>
                        @else
                            
                            @if($fill_invoice_address)
                                @livewire('cart.payment-tunnel-invoice-address-form')
                            @else
                                @auth
                                    @if(auth()->user()->addresses()->count() >= 1)
                                        @if($invoice_address_chosen)
                                        <p>
                                            {!! __('cart.payment-delivery-wish') !!}:
                                        </p>
                                        <div class="flex justify-between payment-tunnel__delivery__address-container">
                                            <div class="payment-tunnel__delivery__address w-2/3">
                                                @include('includes.cart.cart_invoice_address_details')
                                            </div>

                                            <div class="w-1/3">
                                                <div>
                                                    <button class="btn-couture mb-5" wire:click="changeInvoiceAddress">
                                                        {{ __('cart.payment-delivery-choose-other') }}
                                                    </button>
                                                </div>
                                                <div>
                                                    <a href="{{ route('dashboard', ['locale' => app()->getLocale(), 'section' => 'addresses']) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">
                                                        {{ __('cart.payment-delivery-modify') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="flex justify-around flex-wrap mt-5 mb-10">
                                            @foreach(auth()->user()->addresses as $invoice_address)
                                                <div class="text-center w-full lg:w-2/5 mt-2 mb-2" wire:key="invoice-{{ $invoice_address->id }}">
                                                    <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" wire:click="selectInvoiceAddress({{ $invoice_address->id }})">
                                                        {{ $invoice_address->address_name }}
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="text-center mt-5">
                                            <button class="btn-couture" wire:click="addInvoiceAddress">
                                                + {{ __('cart.payment-delivery-add-new') }}
                                            </button>
                                        </div>
                                        @endif
                                    @else
                                    <div class="text-center mt-10">
                                        <button class="btn-couture" wire:click="addInvoiceAddress">
                                            + {{ __('cart.payment-delivery-add-new') }}
                                        </button>
                                    </div>
                                    @endif
                                @else
                                    @if($invoice_address_chosen == 0)
                                    <div class="text-center mt-10">
                                        <button class="btn-couture" wire:click="addInvoiceAddress">
                                            + {{ __('cart.payment-delivery-add-new') }}
                                        </button>
                                    </div>
                                    @else
                                    <p>
                                        {!! __('cart.payment-delivery-wish') !!}:
                                    </p>
                                    <div class="flex justify-between payment-tunnel__delivery__address-container">
                                        <div class="payment-tunnel__delivery__address w-2/3">
                                            @include('includes.cart.cart_invoice_address_details')
                                        </div>

                                        <div class="w-1/3">
                                            <div>
                                                <button class="btn-couture mb-5" wire:click="changeInvoiceAddress">
                                                    {{ __('cart.payment-delivery-choose-other') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endauth
                            @endif
                        @endif
                    @else
                    <div class="mb-5 rounded-xl p-4 relative" style="border: #D41C1B solid 2px">
                        <h5 class="mb-2"><strong>{{ __('cart.payment-chosen-invoice-address') }}</strong></h5>
                        <div class="flex flex-col lg:flex-row justify-start lg:justify-between">
                            <div class="mb-1 w-full lg:w-2/3">
                                @if($order_address_id == $order_invoice_address_id)
                                    {{ __('cart.payment-invoice-address-same-as-delivery') }}
                                @else
                                    @include('includes.cart.cart_invoice_address_details', ['invoice_address' => $invoice_address])
                                @endif
                            </div>
                            <div class="text-right">
                                <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover payment-tunnel__delivery__address__btn payment-tunnel__delivery__address__btn--1" wire:click="updateInvoiceAddress">{{ __('cart.payment-btn-modify') }}</button>

                                @auth
                                    @if($order_address_id !== $order_invoice_address_id)
                                    <a href="{{ route('dashboard', ['locale' => app()->getLocale(), 'section' => 'addresses']) }}" class="btn-couture btn-couture-plain--fit payment-tunnel__delivery__address__btn payment-tunnel__delivery__address__btn--2">
                                        {{ __('cart.payment-address-modify') }}
                                    </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-5 pt-5" style="border-top: lightgrey 1px solid;">
                        <div>
                            <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover text-md md:text-lg" wire:click="validateDeliveryStep">
                                {{ __('cart.payment-delivery-validate') }}
                            </button>
                        </div>
                    </div>
                    @endif
                @endif
            </div>
        </div>
        @if($address_valid)
        <div class="payment-tunnel__block__content" @if($step == 2 || !$address_valid) style="display:none;" @endif>
            @if($pdf_voucher_only)
            <div class="payment-tunnel__delivery__summary">
                {{ __('cart.payment-delivery-address-summary') }}&nbsp;: {{ __('cart.payment-delivery-by-email') }}
            </div>
            @elseif($delivery_method == 0)
            <div class="payment-tunnel__delivery__summary">
                {{ __('cart.payment-delivery-address-summary') }}&nbsp;: {{ __('cart.payment-delivery-in-shop') }}
            </div>
            @else
            <div class="payment-tunnel__delivery__summary">
                {{ __('cart.payment-delivery-address-summary') }}&nbsp;: {{ $address_name }}
            </div>
            @endif
        </div>
        @endif
    </div>


    <div class="payment-tunnel__payment payment-tunnel__block">
        <h2 class="payment-tunnel__block__title @if($step == 3) payment-tunnel__block__title--current @else payment-tunnel__block__title--waiting @endif" wire:click="changeStep(3)" id="payment-tunnel-block-3">
            3. {{ __('cart.payment-pay') }}
        </h2>
        @if($total_price == 0)
        <div class="payment-tunnel__block__content" @if($step !== 3 || !$info_valid || !$address_valid) style="display:none;" @endif>
            <div class="payment-tunnel__payment__field flex flex-col justify-center">
                <div class="grid grid-cols-8">
                    <div class="col-span-3">
                        <p style="padding-top: 7px;">
                            {{ __('cart.payment-pay-with-voucher-confirm') }}
                        </p>
                    </div>
                    <div class="col-span-1"></div>
                    <div class="col-span-1">
                        
                    </div>
                    <div class="col-span-3 text-right pt-1">
                        <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" wire:click="validateOrder('voucher')">{{ __('cart.payment-confirm') }}</button>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="payment-tunnel__block__content" @if($step !== 3 || !$info_valid || !$address_valid) style="display:none;" @endif>
            <div class="payment-tunnel__payment__field flex flex-col justify-center mb-7">
                <div class="grid grid-cols-1 lg:grid-cols-8">
                    <div class="col-span-1 lg:col-span-2 text-center lg:text-left">
                        <p style="padding-top: 7px;">
                            {{ __('cart.payment-pay-with-card') }}
                        </p>
                    </div>
                    <div class="col-span-1 mobile-hidden"></div>
                    <div class="col-span-1 lg:col-span-2 flex flex-col justify-center">
                        <img src="{{ asset('media/pictures/services_payment_cards.png') }}" alt="Payment with Visa, Mastercard, AmEx" class="m-auto" />
                    </div>
                    <div class="col-span-1 mobile-hidden"></div>
                    <div class="col-span-1 lg:col-span-2 text-center lg:text-right pt-3 lg:pt-1 flex flex-col justify-center">
                        <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" wire:click="validateOrder('card')">{{ __('cart.payment-confirm') }}</button>
                    </div>
                </div>
            </div>

            <div class="payment-tunnel__payment__field flex flex-col justify-center mb-7">
                <div class="grid grid-cols-1 lg:grid-cols-8">
                    <div class="col-span-1 lg:col-span-2 text-center lg:text-left">
                        <p style="padding-top: 7px;">
                            {{ __('cart.payment-pay-with-paypal') }}
                        </p>
                    </div>
                    <div class="col-span-1 mobile-hidden"></div>
                    <div class="col-span-1 lg:col-span-2 flex flex-col justify-center">
                        <img src="{{ asset('media/pictures/services_payment_paypal.png') }}" alt="Payment with Paypal" class="m-auto" />
                    </div>
                    <div class="col-span-1 mobile-hidden"></div>
                    <div class="col-span-1 lg:col-span-2 text-center lg:text-right pt-3 lg:pt-1 flex flex-col justify-center">
                        <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" wire:click="validateOrder('paypal')">{{ __('cart.payment-confirm') }}</button>
                    </div>
                </div>
            </div>

            <div class="payment-tunnel__payment__field flex flex-col justify-center mb-7">
                <div class="grid grid-cols-1 lg:grid-cols-8">
                    <div class="col-span-1 lg:col-span-2 text-center lg:text-left">
                        <p style="padding-top: 7px;">
                            {{ __('cart.payment-pay-with-payconiq') }}
                        </p>
                    </div>
                    <div class="col-span-1 mobile-hidden"></div>
                    <div class="col-span-1 lg:col-span-2 flex flex-col justify-center">
                        <img src="{{ asset('media/pictures/services_payment_digicash.png') }}" alt="Payment with Payconiq" class="m-auto" />
                    </div>
                    <div class="col-span-1 mobile-hidden"></div>
                    <div class="col-span-1 lg:col-span-2 text-center lg:text-right pt-3 lg:pt-1 flex flex-col justify-center">
                        <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" wire:click="validateOrder('payconiq')">{{ __('cart.payment-confirm') }}</button>
                    </div>
                </div>
            </div>

            @auth
            <div class="payment-tunnel__payment__field flex flex-col justify-center">
                <div class="grid grid-cols-1 lg:grid-cols-8">
                    <div class="col-span-1 lg:col-span-2 text-center lg:text-left">
                        <p style="padding-top: 7px;">
                            {{ __('cart.payment-pay-with-transfer') }}
                        </p>
                    </div>
                    <div class="col-span-1 mobile-hidden"></div>
                    <div class="col-span-1 lg:col-span-2 flex flex-col justify-center">
                        <img src="{{ asset('media/pictures/services_payment_transfer.png') }}" alt="Payment with bank transfer" class="m-auto" />
                    </div>
                    <div class="col-span-1 mobile-hidden"></div>
                    <div class="col-span-1 lg:col-span-2 text-center lg:text-right pt-3 lg:pt-1 flex flex-col justify-center">
                        <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" wire:click="validateOrder('transfer')">{{ __('cart.payment-confirm') }}</button>
                    </div>
                </div>
            </div>
            @endauth
        </div>
        @endif
    </div>
    @endinshop
</section>