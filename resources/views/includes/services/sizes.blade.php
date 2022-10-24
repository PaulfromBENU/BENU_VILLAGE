<section class="w-full m-auto text-center sizes service-panel mb-10" id="services-sizes">
	<h1 class="sizes__title">{{ __('services.sizes-title') }}</h1>

	
	<div class="flex justify-between benu-container sizes__container">
		<div class="sizes__index relative mobile-hidden tablet-hidden">
			<ul class="sizes__index__menu">
				<li>
					<button id="sizes-chapter-unisex-link" class="sizes-menu-link btn-slider-left font-bold" onclick="document.getElementById('sizes-chapter-unisex-picture').scrollIntoView({ behavior: 'smooth', block: 'center' });">
						{{ __('services.sizes-unisex') }}
					</button>
				</li>
				<li>
					<button id="sizes-chapter-ladies-link" class="sizes-menu-link btn-slider-left font-bold" onclick="document.getElementById('sizes-chapter-ladies-picture').scrollIntoView({ behavior: 'smooth', block: 'center' });">
						{{ __('services.sizes-ladies') }}
					</button>
				</li>
				<li>
					<button id="sizes-chapter-gentlemen-link" class="sizes-menu-link btn-slider-left font-bold" onclick="document.getElementById('sizes-chapter-gentlemen-picture').scrollIntoView({ behavior: 'smooth', block: 'center' });">
						{{ __('services.sizes-gentlemen') }}
					</button>
				</li>
				<li>
					<button id="sizes-chapter-kids-link" class="sizes-menu-link btn-slider-left font-bold" onclick="document.getElementById('sizes-chapter-kids-picture').scrollIntoView({ behavior: 'smooth', block: 'center' });">
						{{ __('services.sizes-kids') }}
					</button>
				</li>
			</ul>
		</div>

		<div class="sizes__chapters">
			<div class="sizes__index relative mobile-only">
				<ul class="sizes__index__menu flex justify-center">
					<li>
						<button onclick="document.getElementById('sizes-chapter-unisex-picture').scrollIntoView({ behavior: 'smooth', block: 'center' });">
							{{ __('services.sizes-unisex-short') }}
						</button>
					</li>
					<li>
						<button onclick="document.getElementById('sizes-chapter-ladies-picture').scrollIntoView({ behavior: 'smooth', block: 'center' });">
							{{ __('services.sizes-ladies-short') }}
						</button>
					</li>
					<li>
						<button onclick="document.getElementById('sizes-chapter-gentlemen-picture').scrollIntoView({ behavior: 'smooth', block: 'center' });">
							{{ __('services.sizes-gentlemen-short') }}
						</button>
					</li>
					<li>
						<button onclick="document.getElementById('sizes-chapter-kids-picture').scrollIntoView({ behavior: 'smooth', block: 'center' });">
							{{ __('services.sizes-kids-short') }}
						</button>
					</li>
				</ul>
			</div>

			<p class="text-left font-medium mb-10">
				{{ __('services.general-description') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="primary-color hover:text-gray-800 transition">{{ __('services.general-description-link') }}</a>.
			</p>


			<div class="sizes__chapter">
				<h3>{{ __('services.sizes-unisex') }}</h3>
				<div class="flex flex-col lg:flex-row justify-between">
					<div class="sizes__chapter__img-container">
						<img src="{{ asset('media/pictures/sizes/taille_unisexe_v2.png') }}" alt="Unisex sizes" title="Unisex sizes" id="sizes-chapter-unisex-picture" />
					</div>
					<div class="sizes__chapter__legend flex flex-col justify-center">
						<ul class="sizes__chapter__legend__list" id="sizes-chapter-unisex">
							<li>
								<h4>A. {{ __('services.sizes-unisex-legend-a') }}</h4>
								<p>
									{{ __('services.sizes-unisex-desc-a') }}
								</p>
							</li>
							<li>
								<h4>B. {{ __('services.sizes-unisex-legend-b') }}</h4>
								<p>
									{{ __('services.sizes-unisex-desc-b') }}
								</p>
							</li>
							<li>
								<h4>C. {{ __('services.sizes-unisex-legend-c') }}</h4>
								<p>
									{{ __('services.sizes-unisex-desc-c') }}
								</p>
							</li>
							<li>
								<h4>D. {{ __('services.sizes-unisex-legend-d') }}</h4>
								<p>
									{{ __('services.sizes-unisex-desc-d') }}
								</p>
							</li>
						</ul>
					</div>
				</div>

				<div class="sizes__chapter__table-container">
					<table class="sizes__chapter__table">
						<tbody>
							<tr class="grid grid-cols-12">
								<th class="col-span-3">{{ __('services.sizes-gentlemen-in-confection') }}</th>
								<th class="sizes__chapter__table__header"><!-- 34/XS -->{{ __('services.sizes-gentlemen-th-1') }}</th>
								<th class="sizes__chapter__table__header"><!-- 36/S -->{{ __('services.sizes-gentlemen-th-2') }}</th>
								<th class="sizes__chapter__table__header"><!-- 38/M -->{{ __('services.sizes-gentlemen-th-3') }}</th>
								<th class="sizes__chapter__table__header"><!-- 40/L -->{{ __('services.sizes-gentlemen-th-4') }}</th>
								<th class="sizes__chapter__table__header"><!-- 42/XL -->{{ __('services.sizes-gentlemen-th-5') }}</th>
								<th class="sizes__chapter__table__header"><!-- 44/2XL -->{{ __('services.sizes-gentlemen-th-6') }}</th>
								<th class="sizes__chapter__table__header"><!-- 46/3XL -->{{ __('services.sizes-gentlemen-th-7') }}</th>
								<th class="sizes__chapter__table__header"><!-- 48/4XL -->{{ __('services.sizes-gentlemen-th-8') }}</th>
								<th class="sizes__chapter__table__header"><!-- 50/5XL -->{{ __('services.sizes-gentlemen-th-9') }}</th>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">B.</span> {{ __('services.sizes-gentlemen-table-info-2') }}</td>
								<td><!-- 80 -->{{ __('services.sizes-gentlemen-table-info-2-1') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-2') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-3') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-4') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-5') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-6') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-7') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-8') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-9') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">C.</span> {{ __('services.sizes-gentlemen-table-info-3') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-1') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-2') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-3') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-4') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-5') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-6') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-7') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-8') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-9') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">D.</span> {{ __('services.sizes-gentlemen-table-info-4') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-1') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-2') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-3') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-4') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-5') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-6') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-7') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-8') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-9') }}</td>
							</tr>
							<tr class="text-left md:text-right">
								<td class="p-4 pr-5 font-medium">
									{{ __('services.sizes-info-cm') }}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="sizes__chapter">
				<h3>{{ __('services.sizes-ladies') }}</h3>
				<div class="flex flex-col lg:flex-row justify-between">
					<div class="sizes__chapter__img-container">
						<img src="{{ asset('media/pictures/sizes/taille_femme.png') }}" alt="Ladies sizes" title="Ladies sizes" id="sizes-chapter-ladies-picture" />
					</div>
					<div class="sizes__chapter__legend flex flex-col justify-center">
						<ul class="sizes__chapter__legend__list" id="sizes-chapter-ladies">
							<li>
								<h4>A. {{ __('services.sizes-ladies-legend-a') }}</h4>
								<p>
									{{ __('services.sizes-ladies-desc-a') }}
								</p>
							</li>
							<li>
								<h4>B. {{ __('services.sizes-ladies-legend-b') }}</h4>
								<p>
									{{ __('services.sizes-ladies-desc-b') }}
								</p>
							</li>
							<li>
								<h4>C. {{ __('services.sizes-ladies-legend-c') }}</h4>
								<p>
									{{ __('services.sizes-ladies-desc-c') }}
								</p>
							</li>
							<li>
								<h4>D. {{ __('services.sizes-ladies-legend-d') }}</h4>
								<p>
									{{ __('services.sizes-ladies-desc-d') }}
								</p>
							</li>
						</ul>
					</div>
				</div>

				<div class="sizes__chapter__table-container">
					<table class="sizes__chapter__table">
						<tbody>
							<tr class="grid grid-cols-12">
								<th class="col-span-3">{{ __('services.sizes-ladies-in-confection') }}</th>
								<th class="sizes__chapter__table__header"><!-- 34/XS -->{{ __('services.sizes-ladies-th-1') }}</th>
								<th class="sizes__chapter__table__header"><!-- 36/S -->{{ __('services.sizes-ladies-th-2') }}</th>
								<th class="sizes__chapter__table__header"><!-- 38/M -->{{ __('services.sizes-ladies-th-3') }}</th>
								<th class="sizes__chapter__table__header"><!-- 40/L -->{{ __('services.sizes-ladies-th-4') }}</th>
								<th class="sizes__chapter__table__header"><!-- 42/XL -->{{ __('services.sizes-ladies-th-5') }}</th>
								<th class="sizes__chapter__table__header"><!-- 44/2XL -->{{ __('services.sizes-ladies-th-6') }}</th>
								<th class="sizes__chapter__table__header"><!-- 46/3XL -->{{ __('services.sizes-ladies-th-7') }}</th>
								<th class="sizes__chapter__table__header"><!-- 48/4XL -->{{ __('services.sizes-ladies-th-8') }}</th>
								<th class="sizes__chapter__table__header"><!-- 50/5XL -->{{ __('services.sizes-ladies-th-9') }}</th>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">B.</span> {{ __('services.sizes-ladies-table-info-2') }}</td>
								<td><!-- 80 -->{{ __('services.sizes-ladies-table-info-2-1') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-2-2') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-2-3') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-2-4') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-2-5') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-2-6') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-2-7') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-2-8') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-2-9') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">C.</span> {{ __('services.sizes-ladies-table-info-3') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-3-1') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-3-2') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-3-3') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-3-4') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-3-5') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-3-6') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-3-7') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-3-8') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-3-9') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">D.</span> {{ __('services.sizes-ladies-table-info-4') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-4-1') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-4-2') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-4-3') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-4-4') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-4-5') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-4-6') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-4-7') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-4-8') }}</td>
								<td>{{ __('services.sizes-ladies-table-info-4-9') }}</td>
							</tr>
							<tr class="text-left md:text-right">
								<td class="p-4 pr-5 font-medium">
									{{ __('services.sizes-info-cm') }}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="sizes__chapter">
				<h3>{{ __('services.sizes-gentlemen') }}</h3>
				<div class="flex flex-col lg:flex-row justify-between">
					<div class="sizes__chapter__img-container">
						<img src="{{ asset('media/pictures/sizes/taille_homme.png') }}" alt="Gentlemen sizes" title="Gentlemen sizes" id="sizes-chapter-gentlemen-picture" />
					</div>
					<div class="sizes__chapter__legend flex flex-col justify-center">
						<ul class="sizes__chapter__legend__list" id="sizes-chapter-gentlemen">
							<li>
								<h4>A. {{ __('services.sizes-gentlemen-legend-a') }}</h4>
								<p>
									{{ __('services.sizes-gentlemen-desc-a') }}
								</p>
							</li>
							<li>
								<h4>B. {{ __('services.sizes-gentlemen-legend-b') }}</h4>
								<p>
									{{ __('services.sizes-gentlemen-desc-b') }}
								</p>
							</li>
							<li>
								<h4>C. {{ __('services.sizes-gentlemen-legend-c') }}</h4>
								<p>
									{{ __('services.sizes-gentlemen-desc-c') }}
								</p>
							</li>
							<li>
								<h4>D. {{ __('services.sizes-gentlemen-legend-d') }}</h4>
								<p>
									{{ __('services.sizes-gentlemen-desc-d') }}
								</p>
							</li>
						</ul>
					</div>
				</div>

				<div class="sizes__chapter__table-container">
					<table class="sizes__chapter__table">
						<tbody>
							<tr class="grid grid-cols-12">
								<th class="col-span-3">{{ __('services.sizes-gentlemen-in-confection') }}</th>
								<th class="sizes__chapter__table__header"><!-- 34/XS -->{{ __('services.sizes-gentlemen-th-1') }}</th>
								<th class="sizes__chapter__table__header"><!-- 36/S -->{{ __('services.sizes-gentlemen-th-2') }}</th>
								<th class="sizes__chapter__table__header"><!-- 38/M -->{{ __('services.sizes-gentlemen-th-3') }}</th>
								<th class="sizes__chapter__table__header"><!-- 40/L -->{{ __('services.sizes-gentlemen-th-4') }}</th>
								<th class="sizes__chapter__table__header"><!-- 42/XL -->{{ __('services.sizes-gentlemen-th-5') }}</th>
								<th class="sizes__chapter__table__header"><!-- 44/2XL -->{{ __('services.sizes-gentlemen-th-6') }}</th>
								<th class="sizes__chapter__table__header"><!-- 46/3XL -->{{ __('services.sizes-gentlemen-th-7') }}</th>
								<th class="sizes__chapter__table__header"><!-- 48/4XL -->{{ __('services.sizes-gentlemen-th-8') }}</th>
								<th class="sizes__chapter__table__header"><!-- 50/5XL -->{{ __('services.sizes-gentlemen-th-9') }}</th>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">B.</span> {{ __('services.sizes-gentlemen-table-info-2') }}</td>
								<td><!-- 80 -->{{ __('services.sizes-gentlemen-table-info-2-1') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-2') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-3') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-4') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-5') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-6') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-7') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-8') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-2-9') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">C.</span> {{ __('services.sizes-gentlemen-table-info-3') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-1') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-2') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-3') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-4') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-5') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-6') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-7') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-8') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-3-9') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">D.</span> {{ __('services.sizes-gentlemen-table-info-4') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-1') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-2') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-3') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-4') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-5') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-6') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-7') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-8') }}</td>
								<td>{{ __('services.sizes-gentlemen-table-info-4-9') }}</td>
							</tr>
							<tr class="text-left md:text-right">
								<td class="p-4 pr-5 font-medium">
									{{ __('services.sizes-info-cm') }}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="sizes__chapter">
				<h3>{{ __('services.sizes-kids') }}</h3>
				<div class="flex flex-col lg:flex-row justify-between">
					<div class="sizes__chapter__img-container">
						<img src="{{ asset('media/pictures/sizes/taille_enfant.png') }}" alt="Kids sizes" title="Kids sizes" id="sizes-chapter-kids-picture" />
					</div>
					<div class="sizes__chapter__legend flex flex-col justify-center" id="sizes-chapter-kids">
						<ul class="sizes__chapter__legend__list">
							<li>
								<h4>A. {{ __('services.sizes-kids-legend-a') }}</h4>
								<p>
									{{ __('services.sizes-kids-desc-a') }}
								</p>
							</li>
							<li>
								<h4>B. {{ __('services.sizes-kids-legend-b') }}</h4>
								<p>
									{{ __('services.sizes-kids-desc-b') }}
								</p>
							</li>
							<li>
								<h4>C. {{ __('services.sizes-kids-legend-c') }}</h4>
								<p>
									{{ __('services.sizes-kids-desc-c') }}
								</p>
							</li>
							<li>
								<h4>D. {{ __('services.sizes-kids-legend-d') }}</h4>
								<p>
									{{ __('services.sizes-kids-desc-d') }}
								</p>
							</li>
							<li>
								<h4>E. {{ __('services.sizes-kids-legend-e') }}</h4>
								<p>
									{{ __('services.sizes-kids-desc-e') }}
								</p>
							</li>
							<li>
								<h4>F. {{ __('services.sizes-kids-legend-f') }}</h4>
								<p>
									{{ __('services.sizes-kids-desc-f') }}
								</p>
							</li>
						</ul>
					</div>
				</div>

				<div class="sizes__chapter__table-container">
					<table class="sizes__chapter__table">
						<tbody>
							<tr class="grid grid-cols-12">
								<th class="col-span-3">{{ __('services.sizes-kids-in-confection') }}</th>
								<th class="sizes__chapter__table__header"><!-- 34/XS -->{{ __('services.sizes-kids-th-1') }}</th>
								<th class="sizes__chapter__table__header"><!-- 36/S -->{{ __('services.sizes-kids-th-2') }}</th>
								<th class="sizes__chapter__table__header"><!-- 38/M -->{{ __('services.sizes-kids-th-3') }}</th>
								<th class="sizes__chapter__table__header"><!-- 40/L -->{{ __('services.sizes-kids-th-4') }}</th>
								<th class="sizes__chapter__table__header"><!-- 42/XL -->{{ __('services.sizes-kids-th-5') }}</th>
								<th class="sizes__chapter__table__header"><!-- 44/2XL -->{{ __('services.sizes-kids-th-6') }}</th>
								<th class="sizes__chapter__table__header"><!-- 46/3XL -->{{ __('services.sizes-kids-th-7') }}</th>
								<th class="sizes__chapter__table__header"><!-- 48/4XL -->{{ __('services.sizes-kids-th-8') }}</th>
								<th class="sizes__chapter__table__header"><!-- 50/5XL -->{{ __('services.sizes-kids-th-9') }}</th>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">B.</span> {{ __('services.sizes-kids-table-info-2') }}</td>
								<td><!-- 80 -->{{ __('services.sizes-kids-table-info-2-1') }}</td>
								<td>{{ __('services.sizes-kids-table-info-2-2') }}</td>
								<td>{{ __('services.sizes-kids-table-info-2-3') }}</td>
								<td>{{ __('services.sizes-kids-table-info-2-4') }}</td>
								<td>{{ __('services.sizes-kids-table-info-2-5') }}</td>
								<td>{{ __('services.sizes-kids-table-info-2-6') }}</td>
								<td>{{ __('services.sizes-kids-table-info-2-7') }}</td>
								<td>{{ __('services.sizes-kids-table-info-2-8') }}</td>
								<td>{{ __('services.sizes-kids-table-info-2-9') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">C.</span> {{ __('services.sizes-kids-table-info-3') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-1') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-2') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-3') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-4') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-5') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-6') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-7') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-8') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-9') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">D.</span> {{ __('services.sizes-kids-table-info-4') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-1') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-2') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-3') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-4') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-5') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-6') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-7') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-8') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-9') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">E.</span> {{ __('services.sizes-kids-table-info-5') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-1') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-2') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-3') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-4') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-5') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-6') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-7') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-8') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-9') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">F.</span> {{ __('services.sizes-kids-table-info-6') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-1') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-2') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-3') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-4') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-5') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-6') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-7') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-8') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-9') }}</td>
							</tr>
							<tr class="text-right mobile-hidden">
								<td class="p-4 pr-5 font-medium">
									{{ __('services.sizes-info-cm') }}
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="sizes__chapter__table-container">
					<table class="sizes__chapter__table">
						<tbody>
							<tr class="grid grid-cols-12">
								<th class="col-span-3">{{ __('services.sizes-kids-in-confection') }}</th>
								<th class="col-span-1" class="sizes__chapter__table__header"><!-- 34/XS -->{{ __('services.sizes-kids-th-10') }}</th>
								<th class="col-span-1" class="sizes__chapter__table__header"><!-- 36/S -->{{ __('services.sizes-kids-th-11') }}</th>
								<th class="col-span-1" class="sizes__chapter__table__header"><!-- 38/M -->{{ __('services.sizes-kids-th-12') }}</th>
								<th class="col-span-1" class="sizes__chapter__table__header"><!-- 40/L -->{{ __('services.sizes-kids-th-13') }}</th>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">B.</span> {{ __('services.sizes-kids-table-info-2') }}</td>
								<td>{{ __('services.sizes-kids-table-info-2-10') }}</td>
								<td>{{ __('services.sizes-kids-table-info-2-11') }}</td>
								<td>{{ __('services.sizes-kids-table-info-2-12') }}</td>
								<td>{{ __('services.sizes-kids-table-info-2-13') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">C.</span> {{ __('services.sizes-kids-table-info-3') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-10') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-11') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-12') }}</td>
								<td>{{ __('services.sizes-kids-table-info-3-13') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">D.</span> {{ __('services.sizes-kids-table-info-4') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-10') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-11') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-12') }}</td>
								<td>{{ __('services.sizes-kids-table-info-4-13') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">E.</span> {{ __('services.sizes-kids-table-info-5') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-10') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-11') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-12') }}</td>
								<td>{{ __('services.sizes-kids-table-info-5-13') }}</td>
							</tr>
							<tr class="grid grid-cols-12 sizes__chapter__table__data-rows">
								<td class="col-span-3"><span class="primary-color">F.</span> {{ __('services.sizes-kids-table-info-6') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-10') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-11') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-12') }}</td>
								<td>{{ __('services.sizes-kids-table-info-6-13') }}</td>
							</tr>
							<tr class="text-left md:text-right">
								<td class="p-4 pr-5 font-medium">
									{{ __('services.sizes-info-cm') }}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>