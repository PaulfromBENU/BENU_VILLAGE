<section class="w-11/12 lg:w-1/2 m-auto text-center faq service-panel service-column" id="services-faq">
	<h1 class="faq__title">{!! __('services.faq-title') !!}</h1>
	<ul class="faq__accordion">
		<!-- Umwelt und Nachhaltigkeit -->
		<li>
			<div class="faq__accordion__header flex justify-between">
				<p class="faq__accordion__header__title">{!! __('services.faq-group-title-1') !!}</p>
				<p class="faq__accordion__header__arrow flex flex-col justify-center">
					<img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="faq__accordion__header__chevron">
				</p>
			</div>

			<div class="faq__accordion__answer" style="display: none;">
				<ul class="mb-10">
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-1-question-title-1') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-1') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-1-question-title-2') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-2-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-2-2') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-2-3') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-2-4') !!} <a href="{{ route('about-'.app()->getLocale()) }}#materials" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-1-question-content-2-5') !!}</a>
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-1-question-title-3') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-3-1') !!} <a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-give')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-1-question-content-3-2') !!}</a> {!! __('services.faq-group-1-question-content-3-3') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-3-4') !!} <a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-smart')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-1-question-content-3-5') !!}</a>
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-3-6') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-1-question-title-4') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-4-1') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-1-question-title-5') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-5-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-5-2') !!}
						</p>
						<div class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-5-3') !!}
							<div class="flex justify-start">
								<div style="min-width: 30px; margin-top: 9px;">@svg('list_cintre')</div> <p>{!! __('services.faq-group-1-question-content-5-4') !!}</p>
							</div>
							<div class="flex justify-start">
								<div style="min-width: 30px; margin-top: 9px;">@svg('list_cintre')</div> <p>{!! __('services.faq-group-1-question-content-5-5') !!}</p>
							</div>
							<div class="flex justify-start">
								<div style="min-width: 30px; margin-top: 9px;">@svg('list_cintre')</div> <p>{!! __('services.faq-group-1-question-content-5-6') !!}</p>
							</div>
						</div>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-1-question-title-6') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-6-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-6-2') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-6-3') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-6-4') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-6-5') !!} <a href="https://benu.lu" target="_blank" rel="noreferrer" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-1-question-content-6-6') !!}</a>
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-1-question-title-7') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-1-question-content-7-1') !!}
						</p>
					</li>
				</ul>
			</div>
		</li>

		<li>
			<div class="faq__accordion__header flex justify-between">
				<p class="faq__accordion__header__title">{!! __('services.faq-group-title-2') !!}</p>
				<p class="faq__accordion__header__arrow flex flex-col justify-center">
					<img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="faq__accordion__header__chevron">
				</p>
			</div>

			<div class="faq__accordion__answer" style="display: none;">
				<ul class="mb-10">
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-2-question-title-1') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-2-question-content-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-2-question-content-2') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-2-question-title-2') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-2-question-content-2-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-2-question-content-2-2') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-2-question-content-2-3') !!} <a href="https://kulturpass.lu" target="_blank" rel="noreferrer" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-2-question-content-2-4') !!}</a>
						</p>
					</li>
				</ul>
			</div>
		</li>

		<li>
			<div class="faq__accordion__header flex justify-between">
				<p class="faq__accordion__header__title">{!! __('services.faq-group-title-3') !!}</p>
				<p class="faq__accordion__header__arrow flex flex-col justify-center">
					<img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="faq__accordion__header__chevron">
				</p>
			</div>

			<div class="faq__accordion__answer" style="display: none;">
				<ul class="mb-10">
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-3-question-title-1') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-1-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-1-2') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-sizes')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-3-question-content-1-3') !!}</a>
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-1-4') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-3-question-content-1-5') !!}</a> {!! __('services.faq-group-3-question-content-1-6') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-3-question-title-2') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-2-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-2-2') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-2-3') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-3-question-title-3') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-3-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-3-2') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-3-3') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-3-question-content-3-4') !!}</a> {!! __('services.faq-group-3-question-content-3-5') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-3-question-title-4') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-4-1') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-3-question-title-5') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-5-1') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-3-question-title-6') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-6-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-6-2') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-3-question-title-7') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-7-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-7-2') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-care')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-3-question-content-7-3') !!}</a>
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-3-question-title-8') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-8-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-3-question-content-8-2') !!}
						</p>
					</li>
				</ul>
			</div>
		</li>

		<li>
			<div class="faq__accordion__header flex justify-between">
				<p class="faq__accordion__header__title">{!! __('services.faq-group-title-4') !!}</p>
				<p class="faq__accordion__header__arrow flex flex-col justify-center">
					<img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="faq__accordion__header__chevron">
				</p>
			</div>

			<div class="faq__accordion__answer" style="display: none;">
				<ul class="mb-10">
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-4-question-title-1') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-4-question-content-1-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-4-question-content-1-2') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-4-question-content-1-3') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-4-question-content-1-4') !!} <a href="{{ route('footer.general-conditions-'.app()->getLocale()) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-4-question-content-1-5') !!}</a>
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-4-question-title-2') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-4-question-content-2-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-4-question-content-2-2') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-payment')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-4-question-content-2-3') !!}</a>
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-4-question-title-3') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-4-question-content-3-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-4-question-content-3-2') !!} <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-4-question-content-3-4') !!}</a> {!! __('services.faq-group-4-question-content-3-5') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-4-question-content-3-6') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-shops')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-4-question-content-3-7') !!}</a>
						</p>
					</li>
				</ul>
			</div>
		</li>

		<li>
			<div class="faq__accordion__header flex justify-between">
				<p class="faq__accordion__header__title">{!! __('services.faq-group-title-5') !!}</p>
				<p class="faq__accordion__header__arrow flex flex-col justify-center">
					<img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="faq__accordion__header__chevron">
				</p>
			</div>

			<div class="faq__accordion__answer" style="display: none;">
				<ul class="mb-10">
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-5-question-title-1') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-5-question-content-1-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-5-question-content-1-2') !!} <a href="{{ route('vouchers-'.app()->getLocale()) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-5-question-content-1-3') !!}</a>
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-5-question-title-2') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-5-question-content-2-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-5-question-content-2-2') !!} <a href="https://www.benureuse.lu" target="_blank" rel="noreferrer" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-5-question-content-2-3') !!}</a> {!! __('services.faq-group-5-question-content-2-4') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-5-question-content-2-5') !!} <a href="{{ route('footer.general-conditions-'.app()->getLocale()) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-5-question-content-2-6') !!}</a>
						</p>
					</li>
				</ul>
			</div>
		</li>

		<li>
			<div class="faq__accordion__header flex justify-between">
				<p class="faq__accordion__header__title">{!! __('services.faq-group-title-6') !!}</p>
				<p class="faq__accordion__header__arrow flex flex-col justify-center">
					<img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="faq__accordion__header__chevron">
				</p>
			</div>

			<div class="faq__accordion__answer" style="display: none;">
				<ul class="mb-10">
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-6-question-title-1') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-1-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-1-2') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-1-3') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-6-question-title-2') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-2-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-2-2') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-2-3') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-2-4') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-shops')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-6-question-content-2-5') !!}</a>
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-6-question-title-3') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-3-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-3-2') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-3-3') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-delivery')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-6-question-content-3-4') !!}</a>
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-6-question-title-4') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-4-1') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-6-question-title-5') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-5-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-5-2') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-6-question-title-6') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-6-question-content-6-1') !!}
						</p>
					</li>
				</ul>
			</div>
		</li>

		<li>
			<div class="faq__accordion__header flex justify-between">
				<p class="faq__accordion__header__title">{!! __('services.faq-group-title-7') !!}</p>
				<p class="faq__accordion__header__arrow flex flex-col justify-center">
					<img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="faq__accordion__header__chevron">
				</p>
			</div>

			<div class="faq__accordion__answer" style="display: none;">
				<ul class="mb-10">
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-7-question-title-1') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-1-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-1-2') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-1-3') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-return')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-7-question-content-1-4') !!}</a>
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-7-question-title-2') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-2-1') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-shops')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-7-question-content-2-2') !!}</a> {!! __('services.faq-group-7-question-content-2-3') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-2-4') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-return')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-7-question-content-2-5') !!}</a>
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-7-question-title-3') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-3-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-3-2') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-3-3') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-3-4') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-shops')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-7-question-content-3-5') !!}</a> {!! __('services.faq-group-7-question-content-3-6') !!}
						</p>
					</li>
					<li>
						<div class="flex justify-between faq__accordion__answer__header">
							<p>{!! __('services.faq-group-7-question-title-4') !!}</p>
							<p>
								<span class="faq__accordion__answer__header__plus">+</span>
								<span class="faq__accordion__answer__header__minus" style="display: none;">-</span>
							</p>
						</div>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-4-1') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-4-2') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-return')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-7-question-content-4-3') !!}</a>
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-4-4') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-4-5') !!}
						</p>
						<p class="faq__accordion__answer__subanswer" style="display: none;">
							{!! __('services.faq-group-7-question-content-4-6') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('services.faq-group-7-question-content-47') !!}</a>
						</p>
					</li>
				</ul>
			</div>
		</li>
	</ul>
</section>