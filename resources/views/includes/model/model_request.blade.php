<section class="benu-container model-request">
	<h3 class="model-request__title">{!! __('models.request-title') !!}</h3>
	<p class="model-request__subtitle w-5/6 lg:w-1/2 m-auto">
		{{ __('models.request-txt-1') }}
	</p>
	<div class="text-center model-request__link">
		<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="btn-couture m-auto">{{ __('models.request-link') }}</a>
	</div>
</section>