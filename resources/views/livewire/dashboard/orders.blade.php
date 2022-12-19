<div class="dashboard-orders w-full">

    @if($show_details == '0')
        <h2>
            {!! __('dashboard.my-orders') !!}
        </h2>
        @if($orders->count() == 0)
        <p>
            <em>{{ __('dashboard.no-order-for-the-moment') }}...</em>
        </p>
        @endif
        @foreach($orders as $order)
            <div class="dashboard-orders__order flex justify-between flex-col lg:flex-row" wire:key="{{ $order->id }}">
                <div class="w-full lg:w-2/3 lg:pr-5">
                    <div class="flex flex-wrap justify-start mb-5">
                        <p class="mr-5 mb-3 md:mb-0">
                            {{ __('dashboard.order-number') }} <strong>{{ $order->unique_id }}</strong>
                        </p>
                        <p class="mb-3 md:mb-0">
                            {{ __('dashboard.order-amount') }} <strong>{{ $order->total_price }}&euro;</strong>
                        </p>
                        @if($order->payment_type >= 5 && $order->seller !== null)
                        <p>
                            {{ __('dashboard.order-sold-by') }} <strong>{{ $order->seller }}</strong>
                        </p>
                        @endif
                    </div>
                    <div class="dashboard-orders__order__details">
                        <p class="primary-color font-bold mb-5">
                            @if($order->status >= 2 && $order->status < 4)
                                @if($order->payment_status <= 1)
                                {{ __('dashboard.order-payment-pending') }}
                                @else
                                {{ __('dashboard.order-payment-paid') }} @if($order->delivery_status !== 4)- @endif
                                    @if($order->delivery_status <= 1)
                                    {{ __('dashboard.order-delivery-under-preparation') }}
                                    @else
                                        @if($order->address_id == 0)
                                            @if($order->delivery_status == '3')
                                                {{ __('dashboard.order-delivery-ready-for-collect-since') }} {{ date('d\/m\/Y', strtotime($order->delivery_date)) }}
                                            @elseif($order->delivery_status == '5')
                                                {{ __('dashboard.order-delivery-collected-on') }} {{ date('d\/m\/Y', strtotime($order->delivery_date)) }}
                                            @endif
                                        @else
                                        {{ __('dashboard.order-delivery-sent-on') }} {{ date('d\/m\/Y', strtotime($order->delivery_date)) }}
                                            @if($order->delivery_link !== null) - <a href="https://www.post.lu/de/particuliers/colis-courrier/track-and-trace#/search" class="primary-color hover:underline" target="_blank" rel="noreferrer">{{ __('dashboard.order-follow-order-link') }}</a> - {{ __('dashboard.order-delivery-tracking-number') }} {{ $order->delivery_link }}@endif
                                        @endif
                                    @endif
                                @endif
                            @elseif($order->status == 4)
                                {{ __('dashboard.order-cancelled-because-not-paid') }}
                            @elseif($order->status == 5)
                                {{ __('dashboard.sold-in-shop') }} - Paid by @if($order->payment_type == 5) SumUp/Card @elseif($order->payment_type == 6) Cash @elseif($order->payment_type == 7) Payconiq @else *** to be checked *** @endif
                            @else
                                {{ __('dashboard.order-not-finished-not-paid') }}
                            @endif
                        </p>
                        <p>
                            <strong>{{ $order->cart->couture_variations->count() }} {{ trans_choice('dashboard.order-articles', $order->cart->couture_variations->count()) }}</strong>
                        </p>
                        <p>
                            {{ __('dashboard.order-made-on') }} <strong>{{ $order->created_at->format('d\/m\/Y') }}</strong>
                        </p>
                    </div>
                </div>

                <div class="w-full lg:w-1/3 pt-4 lg:pt-0">
                    <div class="mb-5 text-right">
                        <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover w-4/5" style="padding-top: 1px; padding-bottom: 1px;" wire:click="showDetails({{ $order->id }})">
                            {{ __('dashboard.order-details') }}
                        </button>
                    </div>
                    @if($order->status !== 4)
                    <div class="mb-5 text-right">
                        <a target="_blank" href="{{ route('invoice-'.app()->getLocale(), ['order_code' => \Illuminate\Support\Str::random(4).$order->unique_id.\Illuminate\Support\Str::random(12)]) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover inline-block w-4/5" style="padding-top: 1px; padding-bottom: 1px;">
                            {{ __('dashboard.order-invoice') }}
                        </a>
                    </div>
                        @if(($order->delivery_status == 2 || $order->delivery_status == 5)
                            && $order->cart->couture_variations()->where('name', 'voucher')->count() !== $order->cart->couture_variations()->count()
                            && Carbon\Carbon::parse($order->delivery_date) > Carbon\Carbon::now()->subdays(28))
                        <div class="mb-5 text-right">
                            <a target="_blank" href="{{ route('return-'.app()->getLocale(), ['order_code' => \Illuminate\Support\Str::random(4).$order->unique_id.\Illuminate\Support\Str::random(12)]) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover inline-block w-4/5" style="padding-top: 1px; padding-bottom: 1px;">
                                {{ __('dashboard.order-return') }}
                            </a>
                        </div>
                        @endif
                    @endif
                    <!-- <div class="mb-5 text-right">
                        <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover w-4/5" style="padding-top: 1px; padding-bottom: 1px;">
                            {{ __('dashboard.order-invoice') }}
                        </button>
                    </div> -->
                    <div class="text-right">
                        <a href="{{ route('client-service-'.app()->getLocale()) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover inline-block w-4/5" style="padding-top: 1px; padding-bottom: 1px;">
                            {{ __('dashboard.order-client-service') }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else

        <h2>
            {!! __('dashboard.order-details') !!} #{{ $order->unique_id }}
        </h2>

        <div class="dashboard-orders__details__summary">
            <div class="flex justify-between flex-col lg:flex-row mb-7">
                <div>
                    <button class="primary-color underline font-bold dashboard-orders__details__summary__backlink" wire:click="hideDetails">
                        < {{ __('dashboard.order-back-to-all-orders') }}
                    </button>
                </div>
                <div class="flex lg:justify-end flex-col lg:flex-row">
                    @if($order->status >= 2 && $order->status < 4)
                    <div class="text-right">
                        <a target="_blank" href="{{ route('invoice-'.app()->getLocale(), ['order_code' => \Illuminate\Support\Str::random(4).$order->unique_id.\Illuminate\Support\Str::random(12)]) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover inline-block w-4/5" style="padding-top: 1px; padding-bottom: 1px;">
                            {{ __('dashboard.order-invoice') }}
                        </a>
                    </div>
                    @endif
                    @if(($order->delivery_status == 2 || $order->delivery_status == 5)
                            && $order->cart->couture_variations()->where('name', 'voucher')->count() !== $order->cart->couture_variations()->count()
                            && Carbon\Carbon::parse($order->delivery_date) > Carbon\Carbon::now()->subdays(28))
                    <div class="text-right">
                        <a target="_blank" href="{{ route('return-'.app()->getLocale(), ['order_code' => \Illuminate\Support\Str::random(4).$order->unique_id.\Illuminate\Support\Str::random(12)]) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover inline-block" style="padding-top: 1px; padding-bottom: 1px;">
                            {{ __('dashboard.order-return') }}
                        </a>
                    </div>
                    @endif
                    <div class="text-right">
                        <a href="{{ route('client-service-'.app()->getLocale()) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover inline-block w-4/5" style="padding-top: 1px; padding-bottom: 1px; width: fit-content;">
                            {{ __('dashboard.order-client-service') }}
                        </a>
                    </div>
                </div>
            </div>
            <div>
                <p>
                    {{ __('dashboard.order-number') }} <strong>{{ $order->unique_id }}</strong>
                </p>
                <p>
                    {{ __('dashboard.order-amount') }} <strong>{{ $order->total_price }}&euro;</strong>
                </p>
            </div>
        </div>

        <div class="dashboard-orders__details__addresses flex justify-between flex-col lg:flex-row">
            <div class="dashboard-orders__details__addresses__address">
                <h3>{{ __('dashboard.order-invoice-address') }}</h3>
                @if($order->invoice_address_id > 0)
                <div class="flex justify-between flex-col-reverse lg:flex-row">
                    <div class="w-full lg:w-7/12">
                        <h4>{{ $order->invoice_address->first_name.' '.$order->invoice_address->last_name }}</h4>
                        <p>
                            {{ $order->invoice_address->street_number }} {{ $order->invoice_address->street }}
                        </p>
                        @if($order->invoice_address->floor !== null && $order->invoice_address->floor !== "")
                        <p>
                            {{ __('dashboard.address-complement') }} : {{ $order->invoice_address->floor }}
                        </p>
                        @endif
                        <p>
                            {{ $order->invoice_address->zip_code }} {{ $order->invoice_address->city }}
                        </p>
                        <p>
                            {{ $order->invoice_address->phone }}
                        </p>
                    </div>
                    <div class="w-full lg:w-5/12 relative">
                        <div class="dashboard-addresses__address__name text-center">
                            {{ $order->invoice_address->address_name }}
                        </div>
                    </div>
                </div>
                @else
                <p>
                    {{ __('dashboard.sold-in-shop') }}
                </p>
                @endif
            </div>

            <div class="dashboard-orders__details__addresses__address pt-5 lg:pt-0">
                <h3>{{ __('dashboard.order-delivery-address') }}</h3>
                @if($order->address_id == 0)
                <h4>{{ __('dashboard.order-in-shop') }}</h4>
                <p>
                    {{ $benu_address->address }}
                </p>
                <p>
                    {{ $benu_address->email }}
                </p>
                <p>
                    {{ $benu_address->phone }}
                </p>
                <a href="{{ $benu_address->website }}" target="_blank" class="primary-color hover:underline font-bold">
                    {{ $benu_address->website }}
                </a>
                @else
                <div class="flex justify-between">
                    <div class="w-full lg:w-7/12">
                        <h4>{{ $order->address->first_name.' '.$order->address->last_name }}</h4>
                        <p>
                            {{ $order->address->street_number }} {{ $order->address->street }}
                        </p>
                        @if($order->address->floor !== null && $order->address->floor !== "")
                        <p>
                            {{ __('dashboard.address-complement') }} : {{ $order->address->floor }}
                        </p>
                        @endif
                        <p>
                            {{ $order->address->zip_code }} {{ $order->address->city }}
                        </p>
                        <p>
                            {{ $order->address->phone }}
                        </p>
                    </div>
                    <div class="w-full lg:w-5/12 relative">
                        <div class="dashboard-addresses__address__name text-center">
                            {{ $order->address->address_name }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <p>
            {{ __('dashboard.order-delivery-status') }}
            <strong class="primary-color">
            @if($order->status >= 2 && $order->status < 4)
                @if($order->payment_status <= 1)
                {{ __('dashboard.order-payment-pending') }}
                @else
                {{ __('dashboard.order-payment-paid') }} - 
                    @if($order->delivery_status <= '1')
                    {{ __('dashboard.order-delivery-under-preparation') }}
                    @else
                        @if($order->address_id == 0)
                            @if($order->delivery_status == '3')
                                {{ __('dashboard.order-delivery-ready-for-collect-since') }} {{ date('d\/m\/Y', strtotime($order->delivery_date)) }}
                            @elseif($order->delivery_status == '5')
                                {{ __('dashboard.order-delivery-collected-on') }} {{ date('d\/m\/Y', strtotime($order->delivery_date)) }}
                            @endif
                        @else
                        {{ __('dashboard.order-delivery-sent-on') }} {{ date('d\/m\/Y', strtotime($order->delivery_date)) }}
                            @if($order->delivery_link !== null) - <a href="https://www.post.lu/de/particuliers/colis-courrier/track-and-trace#/search" class="primary-color hover:underline" target="_blank">{{ __('dashboard.order-follow-order-link') }}</a> - {{ __('dashboard.order-delivery-tracking-number') }} {{ $order->delivery_link }}@endif
                        @endif
                    @endif
                @endif
            @elseif($order->status == 4)
                {{ __('dashboard.order-cancelled-because-not-paid') }}
            @elseif($order->status == 5)
                {{ __('dashboard.sold-in-shop') }} - Paid by @if($order->payment_type == 5) SumUp/Card @elseif($order->payment_type == 6) Cash @elseif($order->payment_type == 7) Payconiq @else *** to be checked *** @endif
            @else
                {{ __('dashboard.order-not-finished-not-paid') }}
            @endif
            </strong>
        </p>

        <h3 class="dashboard-wishlist__title dashboard-wishlist__title--couture" style="width: 100%; margin-top: 30px;">BENU COUTURE</h3>

        <div class="dashboard-orders__details__articles flex justify-between flex-wrap">
            @foreach($articles as $article)
                @if($article->name == 'voucher')
                <a target="_blank" href="https://couture.benu.lu/fr/bons-d-achat" wire:key="{{ $order->unique_id }}-{{ $article->id }}" class="block dashboard-orders__details__articles__article flex justify-start mb-4">
                @else
                <a target="_blank" href="https://couture.benu.lu/fr/creations/{{ strtolower($article->creation->name) }}" wire:key="{{ $order->unique_id }}-{{ $article->id }}" class="block dashboard-orders__details__articles__article flex justify-start mb-4">
                @endif
                <!-- <div wire:key="{{ $order->unique_id }}-{{ $article->id }}" class="dashboard-orders__details__articles__article flex justify-start mb-4"> -->
                    <div class="dashboard-orders__details__articles__article__img-container mr-4">
                        @if($article->name ==  'voucher')
                            <img src="https://couture.benu.lu/images/pictures/photo_voucher.jpg" />
                        @elseif($article->photos()->where('is_front', '1')->count() > 0)
                            <img src="https://couture.benu.lu/images/pictures/articles/{{ $article->photos()->where('is_front', '1')->first()->file_name }}" />
                        @else
                            <img src="https://couture.benu.lu/images/pictures/articles/{{ $article->photos()->first()->file_name }}" />
                        @endif
                    </div>
                    <div class="dashboard-orders__details__articles__article__desc relative">
                        @if($article->name == 'voucher')
                        <h5>
                            {{ __('cart.payment-voucher') }}
                        </h5>
                        <div class="dashboard-orders__details__articles__article__desc__size">
                            {{ strtoupper($article->pivot->value) }}&euro;
                        </div>
                        <p class="dashboard-orders__details__articles__article__desc__number">
                            {{ __('dashboard.order-number-of-items') }} : x{{ $article->pivot->articles_number }}
                        </p>

                        <p class="dashboard-orders__details__articles__article__desc__price">
                            @if($article->voucher_type == 'fabric')
                                {{ $article->pivot->articles_number * ($article->pivot->value + 5) }}&euro;
                            @else
                                {{ $article->pivot->articles_number * $article->pivot->value }}&euro;
                            @endif
                        </p>
                        @else
                        <h5>
                            {{ strtoupper($article->name) }}
                        </h5>
                        <div class="dashboard-orders__details__articles__article__desc__size">
                            {{ strtoupper($article->size->value) }}
                        </div>
                        <div class="dashboard-orders__details__articles__article__desc__color flex">
                            <p class="pr-1" style="margin-top: -5px;">
                                {{ __('dashboard.order-color') }} : 
                            </p>
                            @if($article->color->name == 'multicolored')
                                <div class="color-circle">
                                    <img src="{{ asset('media/pictures/multicolor.png') }}">
                                </div>
                            @else
                                <div class="color-circle color-circle--{{ $article->color->name }}"></div>
                            @endif
                        </div>
                        <p class="dashboard-orders__details__articles__article__desc__number">
                            {{ __('dashboard.order-number-of-items') }} : x{{ $article->pivot->articles_number }}
                        </p>
                        <!-- @if($article->pivot->with_extra_article)
                        + coussin
                        @endif -->

                        <p class="dashboard-orders__details__articles__article__desc__price">
                            @if($article->is_extra_accessory)
                                {{ $article->pivot->articles_number * $article->specific_price }}&euro;
                            @else
                                {{ $article->pivot->articles_number * $article->creation->price }}&euro;
                            @endif
                        </p>
                        @endif
                    </div>
                <!-- </div> -->
                </a>
            @endforeach
        </div>

    @endif
</div>
