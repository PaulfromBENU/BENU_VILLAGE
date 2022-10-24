<section class="w-full lg:w-2/3 m-auto text-center participate-partnership participate-panel" id="participate-partnership">
	<h1 class="participate-partnership__title">{{ __('participate.partnership-title') }}</h1>

	<p class="participate-partnership__content">
		{{ __('participate.partnership-content-1') }}
	</p>
	<p class="participate-partnership__content">
		{{ __('participate.partnership-content-2') }}
	</p>
	<p class="participate-partnership__highlight">
		{{ __('participate.partnership-highlight-1') }}
	</p>
	<p class="participate-partnership__content">
		{{ __('participate.partnership-content-3') }}
	</p>
	<p class="text-center m-10" style="margin-bottom: 80px;">
		<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="inline-block btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">{{ __('participate.partnership-highlight-2-link') }}</a>
	</p>
	<!-- <p class="participate-partnership__highlight">
		{{ __('participate.partnership-highlight-2') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="primary-color hover:text-gray-800 transition">{{ __('participate.partnership-highlight-2-link') }}</a>
	</p> -->
	<p class="participate-partnership__subtitle">
		{{ __('participate.partnership-subtitle-4') }}
	</p>
	<p class="participate-partnership__content">
		{{ __('participate.partnership-content-4') }}
	</p>
</section>