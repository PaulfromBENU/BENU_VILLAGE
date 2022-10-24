<a href="{{ route('model-'.app()->getLocale(), ['name' => 'caretta']) }}" class="block model-overview">
	<div class="model-overview__header flex justify-between">
		<div>
			<p class="model-overview__header__txt">
				{!! __('components.models-header') !!}
			</p>
			<div class="flex flex-start">
				<div class="color-circle color-circle--green"></div>
				<div class="color-circle color-circle--blue"></div>
				<div class="color-circle color-circle--yellow"></div>
				<div class="color-circle color-circle--purple"></div>
			</div>
		</div>

		<div class="model-overview__header__heart">
			<!-- <div class="model-overview__header__heart__icon">
				<i class="far fa-heart"></i>
			</div>
			<div class="model-overview__header__heart__icon model-overview__header__heart__icon--hovered">
				<i class="fas fa-heart"></i>
			</div> -->
		</div>
	</div>
	<div class="model-overview__img-container">
		<img src="{{ asset('media/pictures/articles/modele_2.png') }}">
	</div>
	<div class="model-overview__footer flex justify-between">
		<p>
			{{ __('components.models-model') }} XXXX
		</p>
		<p>
			129,90&euro;
		</p>
	</div>
</a>