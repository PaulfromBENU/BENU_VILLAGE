<section class="w-full lg:w-3/4 m-auto text-center participate-smart participate-panel" id="participate-smart">
	<h1 class="participate-smart__title">{{ __('participate.smart-title') }}</h1>

	<h3>
		{{ __('participate.smart-subtitle-1') }}
	</h3>

	<div class="participate-smart__cards flex justify-center flex-wrap">
		@for($i = 1; $i <= 6; $i++)
		<div class="participate-smart__cards__card">
			<div class="participate-smart__cards__card__img-container">
				<img src="{{ asset('media/pictures/BC_Participate_Smart_'.$i.'.jpg') }}" />
			</div>
			<div class="participate-smart__cards__card__number">
				{{ $i }}
			</div>
			<p class="participate-smart__cards__card__txt">
				<strong class="primary-color">{{ __('participate.smart-card-'.$i.'-title') }}</strong>
			</p>
			<p class="participate-smart__cards__card__txt">
				{{ __('participate.smart-card-'.$i.'-content') }}
			</p>

			<p class="participate-smart__cards__card__message">
				{{ __('participate.smart-card-'.$i.'-message') }}
			</p>
		</div>
		@endfor
	</div>

	<h3 class="mt-4 md:mt-10 mb-5">
		{{ __('participate.smart-subtitle-2') }}
	</h3>

	<div class="participate-smart__cards flex justify-center flex-wrap">
		@for($i = 7; $i <= 8; $i++)
		<div class="participate-smart__cards__card">
			<div class="participate-smart__cards__card__img-container">
				<img src="{{ asset('media/pictures/BC_Participate_Smart_'.$i.'.jpg') }}" />
			</div>
			<div class="participate-smart__cards__card__number">
				{{ $i }}
			</div>
			<p class="participate-smart__cards__card__txt">
				<strong class="primary-color">{{ __('participate.smart-card-'.$i.'-title') }}</strong>
			</p>
			<p class="participate-smart__cards__card__txt">
				{{ __('participate.smart-card-'.$i.'-content') }}
			</p>

			<p class="participate-smart__cards__card__message">
				{{ __('participate.smart-card-'.$i.'-message') }}
			</p>
		</div>
		@endfor
	</div>

	<p class="participate-smart__final">
		{{ __('participate.smart-final-message') }}
	</p>

</section>