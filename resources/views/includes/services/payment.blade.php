<section class="w-11/12 lg:w-1/2 m-auto text-center payment service-panel service-column" id="services-payment">
	<h1 class="payment__title">{!! __('services.payment-title') !!}</h1>
	<p class="payment__subtitle">
		{!! __('services.payment-subtitle') !!}
	</p>

	<div class="payment__option">
		<h3 class="payment__option__title">{!! __('services.payment-option-1-title') !!}</h3>
		<img src="{{ asset('media/pictures/services_payment_cards.png') }}">
		<p class="payment__option__txt">
			{!! __('services.payment-option-1-desc-1') !!}
		</p>
		<ul>
			<li><span class="primary-color">•</span> {!! __('services.payment-option-1-bullet-1') !!}</li>
			<li><span class="primary-color">•</span> {!! __('services.payment-option-1-bullet-2') !!}</li>
			<li><span class="primary-color">•</span> {!! __('services.payment-option-1-bullet-3') !!}</li>
			<li><span class="primary-color">•</span> {!! __('services.payment-option-1-bullet-4') !!}</li>
			<li><span class="primary-color">•</span> {!! __('services.payment-option-1-bullet-5') !!}</li>
			<li><span class="primary-color">•</span> {!! __('services.payment-option-1-bullet-6') !!}</li>
		</ul>
		<p class="payment__option__txt">
			{!! __('services.payment-option-1-desc-2') !!}
		</p>
	</div>

	<div class="payment__option">
		<h3 class="payment__option__title">{!! __('services.payment-option-2-title') !!}</h3>
		<img src="{{ asset('media/pictures/services_payment_paypal.png') }}">
		<p class="payment__option__txt">
			{!! __('services.payment-option-2-desc') !!}
		</p>
	</div>

	<div class="payment__option">
		<h3 class="payment__option__title">{!! __('services.payment-option-3-title') !!}</h3>
		<img src="{{ asset('media/pictures/services_payment_digicash.png') }}">
		<p class="payment__option__txt">
			{!! __('services.payment-option-3-desc') !!}
		</p>
	</div>

	<div class="payment__option">
		<h3 class="payment__option__title">{!! __('services.payment-option-4-title') !!}</h3>
		<img src="{{ asset('media/pictures/services_payment_transfer.png') }}">
		<p class="payment__option__txt">
			{!! __('services.payment-option-4-desc') !!}
		</p>
	</div>
</section>