<div class="modal lang-modal" id="lang-modal" style="display: none;">
	<p class="lang-modal__title">
		Je choisis ma langue&nbsp;:
	</p>
	<div class="flex justify-between">
		@if(isset($route_parameters))
		<a href="{{ route(Route::currentRouteName().'-'.de, array_merge($route_parameters, ['locale' => 'de'])) }}" class="lang-modal__block">
		@else 
		<a href="{{ route(Route::currentRouteName().'-'.de, ['locale' => 'de']) }}" class="lang-modal__block">
		@endif
			<button class="lang-modal__block__btn">
                DE
            </button>
            <p class="text-center">
            	Deutsch
            </p>
		</a>
		<a href="{{ route(Route::currentRouteName(), ['locale' => 'en']) }}" class="lang-modal__block">
			<button class="lang-modal__block__btn">
                EN
            </button>
            <p class="text-center">
            	English
            </p>
		</a>
		<a href="{{ route(Route::currentRouteName(), ['locale' => 'fr']) }}" class="lang-modal__block">
			<button class="lang-modal__block__btn">
                FR
            </button>
            <p class="text-center">
            	Français
            </p>
		</a>
		<a href="{{ route(Route::currentRouteName(), ['locale' => 'lu']) }}" class="lang-modal__block">
			<button class="lang-modal__block__btn">
                LU
            </button>
            <p class="text-center">
            	Lëtzebuergesch
            </p>
		</a>
	</div>
</div>