<section class="text-center delivery service-panel" id="services-delivery">
	<h1 class="delivery__title">{{ __('services.delivery-title') }}</h1>
	
	<div class="flex justify-between benu-container delivery__container">
		<div class="delivery__index relative mobile-hidden tablet-hidden">
			<ul class="delivery__index__menu">
				<li>
					<button id="delivery-chapter-options-link" class="delivery-menu-link btn-slider-left font-bold" onclick="document.getElementById('delivery-chapter-options').scrollIntoView({ behavior: 'smooth', block: 'center' });">
						{{ __('services.delivery-options') }}
					</button>
				</li>
				<li>
					<button id="delivery-chapter-fees-link" class="delivery-menu-link btn-slider-left font-bold" onclick="document.getElementById('delivery-chapter-fees').scrollIntoView({ behavior: 'smooth', block: 'center' });">
						{{ __('services.delivery-fees') }}
					</button>
				</li>
				<li>
					<button id="delivery-chapter-boxes-link" class="delivery-menu-link btn-slider-left font-bold" onclick="document.getElementById('delivery-chapter-boxes').scrollIntoView({ behavior: 'smooth', block: 'center' });">
						{{ __('services.delivery-boxes') }}
					</button>
				</li>
				<li>
					<button id="delivery-chapter-delay-link" class="delivery-menu-link btn-slider-left font-bold" onclick="document.getElementById('delivery-chapter-delay').scrollIntoView({ behavior: 'smooth', block: 'center' });">
						{{ __('services.delivery-delay') }}
					</button>
				</li>
			</ul>
		</div>

		<div class="delivery__chapters">
			<div class="delivery__chapter" id="delivery-chapter-options">
				<h3>{{ __('services.delivery-options') }}</h3>
				
				<p class="mb-2">
					{!! __('services.delivery-details') !!} <a href="{{  route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-shops')]) }}" class="delivery__chapter__link">{!! __('services.delivery-details-link') !!}</a>. 
				</p>
			</div>

			<div class="delivery__chapter" id="delivery-chapter-fees">
				<h3>{{ __('services.delivery-fees') }}</h3>
				
				<p class="mb-2">
					{!! __('services.delivery-costs') !!}
				</p>

				<div class="delivery__chapter__table-container">
					<table class="delivery__chapter__table">
						<tbody>
							<tr class="grid grid-cols-6 mb-2">
								<th>{{ __('services.delivery-weight-in-kg') }}</th>
	<!-- 							<th></th> -->
								<th>Zone 1 (LUX)</th>
								<th>Zone 2 (BE/NL)</th>
								<th>Zone 3 (DE, FR, AU)</th>
								<th>Zone 4 (CH, CZ, DK, FI, IT, PT, SE, SK)</th>
								<th>Zone 5 (ES, GR, HU, IR, IS, LT, NO, UK)</th>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>0.05</td>
	<!-- 							<td>0.1</td> -->
								<td>2</td>
								<td>2</td>
								<td>2</td>
								<td>2</td>
								<td>2</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>0.5</td>
	<!-- 							<td>0.1</td> -->
								<td>3</td>
								<td>4</td>
								<td>4</td>
								<td>4</td>
								<td>4</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>1</td>
	<!-- 							<td>0.1</td> -->
								<td>8.13</td>
								<td>13.15</td>
								<td>15.87</td>
								<td>19.04</td>
								<td>19.31</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>2</td>
	<!-- 							<td>0.3</td> -->
								<td>8.13</td>
								<td>11.63</td>
								<td>16.23</td>
								<td>20.49</td>
								<td>22.35</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>3</td>
	<!-- 							<td>0.4</td> -->
								<td>9.07</td>
								<td>14.10</td>
								<td>16.76</td>
								<td>21.92</td>
								<td>25.62</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>4</td>
	<!-- 							<td>0.4</td> -->
								<td>9.07</td>
								<td>14.59</td>
								<td>17.21</td>
								<td>23.37</td>
								<td>28.83</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>5</td>
	<!-- 							<td>0.4</td> -->
								<td>9.07</td>
								<td>14.65</td>
								<td>17.92</td>
								<td>24.82</td>
								<td>28.83</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>6</td>
	<!-- 							<td>0.5</td> -->
								<td>9.07</td>
								<td>15.12</td>
								<td>18.40</td>
								<td>25.46</td>
								<td>28.83</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>7</td>
	<!-- 							<td>0.6</td> -->
								<td>9.07</td>
								<td>15.59</td>
								<td>18.95</td>
								<td>25.99</td>
								<td>28.83</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>8</td>
	<!-- 							<td>0.7</td> -->
								<td>9.07</td>
								<td>16.04</td>
								<td>19.52</td>
								<td>27.34</td>
								<td>28.83</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>9</td>
	<!-- 							<td>0.7</td> -->
								<td>9.07</td>
								<td>16.51</td>
								<td>19.52</td>
								<td>28.69</td>
								<td>28.83</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>10</td>
	<!-- 							<td>1</td> -->
								<td>9.07</td>
								<td>16.97</td>
								<td>19.52</td>
								<td>30.04</td>
								<td>28.83</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>12</td>
	<!-- 							<td>1</td> -->
								<td>10.55</td>
								<td>17.54</td>
								<td>20.54</td>
								<td>32.57</td>
								<td>41.47</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>14</td>
	<!-- 							<td>1.2</td> -->
								<td>10.55</td>
								<td>18.46</td>
								<td>21.19</td>
								<td>35.24</td>
								<td>46.04</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>16</td>
	<!-- 							<td>1.2</td> -->
								<td>10.55</td>
								<td>19.36</td>
								<td>21.61</td>
								<td>37.92</td>
								<td>48.60</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>18</td>
	<!-- 							<td>1.3</td> -->
								<td>10.55</td>
								<td>20.27</td>
								<td>22.35</td>
								<td>40.61</td>
								<td>52.99</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>20</td>
	<!-- 							<td>1.3</td> -->
								<td>10.55</td>
								<td>20.62</td>
								<td>23.08</td>
								<td>43.28</td>
								<td>57.37</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>25</td>
	<!-- 							<td>1.5</td> -->
								<td>11.05</td>
								<td>21.49</td>
								<td>24.67</td>
								<td>49.98</td>
								<td>62.95</td>
							</tr>
							<tr class="grid grid-cols-6 delivery__chapter__table__data-rows">
								<td>30</td>
	<!-- 							<td>1.5</td> -->
								<td>11.05</td>
								<td>22.55</td>
								<td>25.81</td>
								<td>56.70</td>
								<td>66.51</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="delivery__chapter" id="delivery-chapter-boxes">
				<h3>{{ __('services.delivery-boxes') }}</h3>
				
				<p>
					{{ __('services.delivery-low-impact') }}
				</p>
			</div>

			<div class="delivery__chapter" id="delivery-chapter-delay">
				<h3>{{ __('services.delivery-delay') }}</h3>
				
				<p class="mb-2">
					{!! __('services.delivery-planning') !!}
				</p>
			</div>
		</div>
	</div>
</section>