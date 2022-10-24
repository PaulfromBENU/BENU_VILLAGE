<section class="welcome-creations pattern-bg">
	<div class="benu-container">
		<h2 class="welcome-creations__title">{{ __('welcome.last-title') }}</h2>
		<p class="welcome-creations__subtitle">
			{{ __('welcome.last-subtitle') }}
		</p>
		<div class="welcome-creations__list flex flex-wrap justify-between">
			@foreach($latest_models as $model)
				@livewire('components.model-overview', ['model' => $model])
			@endforeach
			<div class="text-center welcome-creations__list__link">
				<a href="{{ route('model-'.app()->getLocale()) }}" class="">{{ __('welcome.last-link') }}</a>
			</div>
		</div>
	</div>
</section>