@extends('layouts.base_layout')

@section('title')
	{{ __('cart.seo-title') }}
@endsection

@section('description')
	{{ __('cart.seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('cart-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.cart') }}</strong></a>
		</div>
	</div>
@endsection

@section('modal')
	@livewire('cart.gift-modal', ['cart_id' => $cart_id])
@endsection

@section('info-modal')
	<div class="relative">
		@if(in_array(app()->getLocale(), ['lu', 'de']))
        <div class="article-sidebar__content__close-container article-sidebar__content__close-container--large" id="info-modal-close" style="top: -15px; right: -15px;">
            <div class="article-sidebar__content__close article-sidebar__content__close--large">
                {{ __('sidebar.close') }} <span class="pl-2">&#10005;</span>
            </div>
        </div>
        @else
        <div class="article-sidebar__content__close-container" id="info-modal-close" style="top: -15px; right: -15px;">
            <div class="article-sidebar__content__close">
                {{ __('sidebar.close') }} <span class="pl-2">&#10005;</span>
            </div>
        </div>
        @endif
        <p class="pt-4">
			{{ __('cart.pop-up-store-info') }}
		</p>
	</div>
@endsection

@section('main-content')
<div class="flex flex-col lg:flex-row justify-start lg:justify-between benu-container mb-10 pb-10">
	<section class="cart-content" @if($cart_id == 0 || $cart_count == 0) style="width: 100%;" @endif>
		<h1>{{ __('cart.your-cart') }}</h1>

		@if($cart_id == 0 || $cart_count == 0)
			<p class="bg-gray-100 text-center text-2xl lg:text-4xl font-bold primary-color p-4" style="border-radius: 8px; font-family: 'Barlow Condensed';">
				{{ __('cart.no-article-for-the-moment') }}
			</p>
			<p class="text-center mt-5 pt-5 mb-10">
				<a href="{{ route('model-'.app()->getLocale()) }}" class="btn-slider-left m-auto font-bold text-lg" style="font-family: 'Barlow Condensed';">{{ __('welcome.last-link') }}</a>
			</p>
		@else
			<h2 class="cart-content__banner cart-content__banner--couture">BENU COUTURE</h2>
			@livewire('cart.cart-articles', ['cart_id' => $cart_id])
		@endif
	</section>

	@if($cart_id !== 0 && $cart_count > 0)
	<section class="cart-summary-container">
		<div class="cart-summary-container__sticky-container">
			@livewire('cart.cart-summary', ['cart_id' => $cart_id])

			<div class="cart-client-service flex justify-center lg:flex-wrap">
				<div>
					@svg('svg_conseil_tel')
					<p>{{ __('cart.service-tel') }}</p>
				</div>
				<div>
					@svg('svg_garantie_vie')
					<p>{{ __('cart.service-warranty') }}</p>
				</div>
				<div>
					@svg('svg_pickup_store')
					<p>{{ __('cart.service-pickup') }}</p>
				</div>
				<div>
					@svg('svg_voucher')
					<p>{{ __('cart.service-voucher') }}</p>
				</div>
				<div>
					@svg('svg_kulturpass_2')
					<p>{{ __('cart.service-kulturpass') }}</p>
				</div>
			</div>
		</div>
	</section>
	@endif
</div>
@endsection

@section('scripts')
@endsection