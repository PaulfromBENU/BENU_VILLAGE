<section class="benu-container welcome-others">
	<h3 class="text-center">
		{{ __('welcome.others-title') }}
	</h3>
	<p class="welcome-others__list">
		@if(date('m') > 4 && date('m') < 10)
		<a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'categories' => 'blouses-shirts']) }}">{{ __('welcome.other-words-summer-1') }}</a>
		<a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'categories' => 'jackets-vests']) }}">{{ __('welcome.other-words-summer-2') }}</a>
		<a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'categories' => 'trousers']) }}">{{ __('welcome.other-words-summer-3') }}</a>
		<a href="{{ route('model-'.app()->getLocale(), ['family' => 'home']) }}">{{ __('welcome.other-words-summer-4') }}</a>
		<a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'categories' => 'cardigans']) }}">{{ __('welcome.other-words-summer-5') }}</a>
		<a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'kids']) }}">{{ __('welcome.other-words-summer-6') }}</a>
		@else
		<a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'categories' => 'blouses-shirts']) }}">{{ __('welcome.other-words-summer-1') }}</a>
		<a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'categories' => 'jackets-vests']) }}">{{ __('welcome.other-words-summer-2') }}</a>
		<a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'categories' => 'trousers']) }}">{{ __('welcome.other-words-summer-3') }}</a>
		<a href="{{ route('model-'.app()->getLocale(), ['family' => 'home']) }}">{{ __('welcome.other-words-summer-4') }}</a>
		<a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'categories' => 'cardigans']) }}">{{ __('welcome.other-words-summer-5') }}</a>
		<a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes', 'types' => 'kids']) }}">{{ __('welcome.other-words-summer-6') }}</a>
		@endif
	</p>

	<div class="flex justify-center flex-wrap">
		<div class="welcome-others__block">
			<a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes']) }}">
				<div class="welcome-others__svg-container">
						@svg('icon_benu_couture_vetements_OK')
					<h4>
						{{ __('welcome.icon-clothes') }}
					</h4>
				</div>
			</a>
		</div>
		<div class="welcome-others__block">
			<a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories']) }}">
				<div class="welcome-others__svg-container">
						@svg('icon_benu_couture_accessoires_OK')
					<h4>
						{{ __('welcome.icon-accessories') }}
					</h4>
				</div>
			</a>
		</div>
		<div class="welcome-others__block">
			<a href="{{ route('model-'.app()->getLocale(), ['family' => 'home']) }}">
				<div class="welcome-others__svg-container">
						@svg('icon_benu_couture_home_OK')
					<h4>
						{{ __('welcome.icon-home') }}
					</h4>
				</div>
			</a>
		</div>
	</div>
	<!-- <a href="{{ route('model-'.app()->getLocale()) }}" class="block welcome-others__plus">
		<div class="welcome-others__plus__symbol">
			+
		</div>
	</a> -->
</section>