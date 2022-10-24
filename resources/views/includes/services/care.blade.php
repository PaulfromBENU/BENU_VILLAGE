<section class="w-11/12 lg:w-1/2 m-auto text-center care service-panel service-column" id="services-care">
	<h1 class="care__title">{{ __('services.care-title') }}</h1>
	<p class="care__subtitle">
		{{ __('services.care-subtitle') }} <!-- <a href="#" class="primary-color hover:text-gray-800 transition">{{ __('services.care-subtitle-link') }}</a> -->
	</p>

	@php $desc_query = "description_".app()->getLocale(); @endphp

	<h4 class="text-center care__grid__title">{{ __('services.care-category-1') }}</h4>
	<div class="care__grid flex justify-between flex-wrap mb-10">
		@foreach($wash_recommendations as $wash_recommendation)
		<div class="care__grid__box">
			<div class="care__grid__box__img-container text-center flex flex-col justify-center">
				@svg('care/'.$wash_recommendation->picture)
			</div>
			<p class="care__grid__box__txt m-auto">
				{{ $wash_recommendation->$desc_query }}
			</p>
		</div>
		@endforeach
	</div>

	<h4 class="text-center care__grid__title">{{ __('services.care-category-2') }}</h4>
	<div class="care__grid flex justify-between flex-wrap mb-10">
		@foreach($dry_recommendations as $dry_recommendation)
		<div class="care__grid__box">
			<div class="care__grid__box__img-container text-center flex flex-col justify-center">
				@svg('care/'.$dry_recommendation->picture)
			</div>
			<p class="care__grid__box__txt m-auto">
				{{ $dry_recommendation->$desc_query }}
			</p>
		</div>
		@endforeach
	</div>

	<h4 class="text-center care__grid__title">{{ __('services.care-category-3') }}</h4>
	<div class="care__grid flex justify-between flex-wrap mb-10">
		@foreach($iron_recommendations as $iron_recommendation)
		<div class="care__grid__box">
			<div class="care__grid__box__img-container text-center flex flex-col justify-center">
				@svg('care/'.$iron_recommendation->picture)
			</div>
			<p class="care__grid__box__txt m-auto">
				{{ $iron_recommendation->$desc_query }}
			</p>
		</div>
		@endforeach
	</div>
</section>