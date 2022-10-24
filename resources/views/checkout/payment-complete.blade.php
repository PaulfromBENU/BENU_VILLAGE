@extends('layouts.base_layout')

@section('title')
	{{ __('payment.seo-title-payment-complete') }}
@endsection

@section('description')
	{{ __('payment.seo-description-payment-complete') }}
@endsection

@section('robots-behaviour')
	noindex, nofollow
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('payment-processed-'.app()->getLocale(), ['order' => $url_order]) }}" class="primary-color"><strong>{{ __('breadcrumbs.validated-payment') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<section class="benu-container payment-confirmation">
		@inshop
			<h3 class="payment-confirmation__subtitle">
				{!! __('payment.confirmation-inshop-subtitle') !!}
			</h3>
			<h1 class="payment-confirmation__title">
				{!! __('payment.confirmation-inshop-order-validated') !!}
			</h1>

			<p class="payment-confirmation__order-number">
				{!! __('payment.confirmation-inshop-order-number') !!} {{ $order->unique_id }}
			</p>
			<p class="payment-confirmation__order-infos">
				{!! __('payment.confirmation-total-price') !!} <strong class="primary-color">{{ $order->total_price }}&euro;</strong>
			</p>
			<p class="payment-confirmation__order-infos mb-7">
				{!! __('payment.confirmation-inshop-do-not-forget-to-receive-payment') !!}
			</p>

			<div class="payment-confirmation__links flex justify-around flex-wrap">
				<div class="text-center">
					<a href="{{ route('dashboard', ['locale' => app()->getLocale(), 'section' => 'orders']) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">{!! __('payment.confirmation-inshop-see-all-orders') !!}</a>
				</div>

				<div class="text-center">
					<a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">{!! __('payment.confirmation-back-to-home') !!}</a>
				</div>
			</div>
		@else
			<h3 class="payment-confirmation__subtitle">
				{!! __('payment.confirmation-congrats') !!}
			</h3>
			<h1 class="payment-confirmation__title">
				@if($order->payment_status >= 2)
				{!! __('payment.confirmation-order-validated') !!}
				@else
				{!! __('payment.confirmation-order-pending') !!}
				@endif
			</h1>

			<p class="payment-confirmation__order-number">
				{!! __('payment.confirmation-order-number') !!} {{ $order->unique_id }}
			</p>
			<p class="payment-confirmation__order-infos">
				{!! __('payment.confirmation-total-price') !!} <strong class="primary-color">{{ $order->total_price }}&euro;</strong>
			</p>
			<p class="payment-confirmation__order-infos mb-7">
				{!! __('payment.confirmation-payment-method') !!} <strong class="primary-color">
				@if($order->payment_type == '0')
				{!! __('payment.confirmation-credit-card') !!} - {!! __('payment.confirmation-payment-ok') !!}
				@elseif($order->payment_type == '1')
				{!! __('payment.confirmation-paypal') !!} - {!! __('payment.confirmation-payment-ok') !!}
				@elseif($order->payment_type == '2')
				{!! __('payment.confirmation-digicash') !!} - {!! __('payment.confirmation-payment-pending') !!}
				@elseif($order->payment_type == '3')
				{!! __('payment.confirmation-bank-transfer') !!} - {!! __('payment.confirmation-payment-pending') !!}
				@elseif($order->payment_type == '4')
				{!! __('payment.confirmation-voucher') !!} - {!! __('payment.confirmation-payment-ok') !!}
				@else
				{!! __('payment.confirmation-payment-pending') !!}.
				@endif
				</strong>
			</p>
			@if($order->payment_type == '3')
			<p class="payment-confirmation__order-infos mb-7">
				{!! __('payment.confirmation-transfer-reference') !!} :<br/>
				<strong class="primary-color">BENU{{ $order->unique_id }}</strong>
			</p>
			<p class="payment-confirmation__order-infos mb-7">
				{!! __('payment.confirmation-our-bank-coordinates') !!} :
			</p>
			<div class="text-center m-3 font-bold">
				<p>
					{!! __('payment.confirmation-our-bank-name') !!}
				</p>
				<p>
					{!! __('payment.confirmation-our-bank-iban') !!}
				</p>
				<p>
					{!! __('payment.confirmation-our-bank-swift') !!}
				</p>
			</div>
			@elseif($order->payment_type == '2')
			<p class="payment-confirmation__order-infos mb-7">
				{!! __('payment.confirmation-payconiq-reference') !!} :<br/>
				<strong class="primary-color">BENU{{ $order->unique_id }}</strong>
			</p>
			<p class="payment-confirmation__order-infos mb-7">
				{!! __('payment.confirmation-our-payconiq-coordinates') !!} :
			</p>
			<div class="text-center m-3 font-bold">
				<p>
					{!! __('payment.confirmation-payconiq-number-intro') !!} : <strong class="primary-color">{!! __('payment.confirmation-payconiq-number') !!}</strong>
				</p>
				<p>
					{!! __('payment.confirmation-payconiq-amount') !!} : <strong class="primary-color">{{ $order->total_price }}&euro;</strong>
				</p>
				<p>
					{!! __('payment.confirmation-payconiq-reference') !!} : <strong class="primary-color">BENU{{ $order->unique_id }}</strong>
				</p>
			</div>
			@endif
			<p class="payment-confirmation__txt-details">
				@if($order->user_id > 0)
				{!! __('payment.confirmation-email-confirmation') !!} {{ $order->user->email }}
				@endif
			</p>
			@if($order->payment_status < 2)
				<p class="payment-confirmation__txt-details">
					{!! __('payment.confirmation-email-info') !!}
				</p>
			@endif
			<div class="payment-confirmation__links flex justify-around flex-wrap">
				@auth
				<div class="text-center">
					<a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">{!! __('payment.confirmation-go-to-dashboard') !!}</a>
				</div>
				<div class="text-center">
					<a href="{{ route('dashboard', ['locale' => app()->getLocale(), 'section' => 'orders']) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">{!! __('payment.confirmation-see-all-orders') !!}</a>
				</div>
				@endauth

				<div class="text-center">
					<a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">{!! __('payment.confirmation-back-to-home') !!}</a>
				</div>
			</div>
		@endinshop
	</section>
@endsection

@section('scripts')
@endsection