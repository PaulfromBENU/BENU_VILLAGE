<div class="dashboard-conditions">
	<h2>{{ __('dashboard.general-conditions') }}</h2>
	<div>
		<h3>{!! __('dashboard.general-conditions-updated-on') !!}: <span class="primary-color">{{ $general_conditions_date }}</span></h3>
		<p class="mt-3 mb-3">
			<a href="{{ route('footer.general-conditions-'.app()->getLocale()) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{{ __('dashboard.new-conditions-link') }}</a>
		</p>
		<!-- <p>
			{{ $general_conditions_content }}
		</p> -->
		@if(auth()->user()->last_conditions_agreed == '0')
			<div class="text-left mt-10">
				<button class="btn-couture-plain" style="padding-bottom: 7px; padding-top: 7px; height: fit-content;" wire:click="acceptNewConditions">
					{!! __('dashboard.accept-new-conditions') !!}
				</button>
			</div>
		@else
			<div class="mt-10 text-lg font-semibold">
				{!! __('dashboard.new-conditions-accepted') !!}
			</div>
		@endif
	</div>
</div>