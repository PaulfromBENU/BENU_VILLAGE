<section class="model-articles benu-container" id="voucher-options">
	<h2>{{ __('vouchers.options-title') }}</h2>
	<div class="model-articles__filters flex">
		<div class="model-articles__filters__filter">
			<p>{{ __('vouchers.options-no-filter') }}</p>
		</div>
	</div>

	<div class="model-articles__list flex flex-wrap justify-start">
		@foreach($vouchers as $voucher)
			@livewire('components.voucher-overview', ['voucher' => $voucher], key($voucher->id))
		@endforeach
	</div>
</section>