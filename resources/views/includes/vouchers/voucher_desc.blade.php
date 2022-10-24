<section class="flex flex-col lg:flex-row jsutify-start lg:justify-between model-pres benu-container">
	<div class="model-pres__img-container">
		<img src="{{ asset('media/pictures/photo_voucher.jpg') }}">
	</div>

	<div class="model-pres__mobile-anchors mobile-only flex flex-col md:flex-row justify-start md:justify-center">
		<a onclick='document.getElementById("voucher-options").scrollIntoView({ behavior: "smooth", block: "start" });' class="flex justify-start md:justify-center">
			{{ __('vouchers.desc-link') }} @svg('model_arrow_down')
		</a>
	</div>

	<div class="model-pres__desc">
		<h1 class="model-pres__desc__title">{{ __('vouchers.desc-title') }}</h1>
		<p class="model-pres__desc__txt-vouchers">
			{{ __('vouchers.desc-txt-1') }}
		</p>
		<p class="model-pres__desc__txt-vouchers">
			{{ __('vouchers.desc-txt-2') }}
		</p>
		<p class="model-pres__desc__txt-vouchers">
			{{ __('vouchers.desc-txt-3') }}
		</p>

		<div class="model-pres__wiki-link">
			@php
			$localized_links = [
				'en' => 'https://en.wikipedia.org/wiki/Lesser_bilby',
				'fr' => 'https://fr.wikipedia.org/wiki/Macrotis_leucura',
				'de' => 'https://de.wikipedia.org/wiki/Kleiner_Kaninchennasenbeutler',
				'lu' => 'https://de.wikipedia.org/wiki/Kleiner_Kaninchennasenbeutler',
			];
			@endphp
			<p class="model-pres__desc__txt" style="margin-bottom: 20px;">
				{!! __('models.link-explanation') !!}
			</p>
			<p class="model-pres__desc__link">
				<a href="{{ $localized_links[app()->getLocale()] }}" target="_blank" rel="noreferrer" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" style="margin: 0;">{{ __('models.model-origins') }} BILBY</a>
			</p>
		</div>
		
		<div class="flex model-pres__desc__seemore tablet-hidden">
			<a onclick='document.getElementById("voucher-options").scrollIntoView({ behavior: "smooth", block: "start" });' class="flex">
				{{ __('vouchers.desc-link') }} @svg('model_arrow_down')
			</a>
		</div>
	</div>
</section>