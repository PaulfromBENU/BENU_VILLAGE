<section class="w-5/6 lg:w-1/2 m-auto text-center contact service-panel service-column" id="services-contact">
	<div class="contact__subtitle">
		{!! __('services.contact-subtitle') !!}
	</div>
	<div class="contact__title">
		<h1>
			{!! __('services.contact-title') !!}
		</h1>
	</div>
	<div class="contact__mail">
		<a href="mailto:benu@benu.lu" class="btn-slider-left m-auto">benu@benu.lu</a>
	</div>
	<div class="contact__phone">
		+352 2791 1949
	</div>
	<div class="contact__opening">
		{!! __('services.contact-opening-1') !!}
	</div>
	<div class="contact__moreinfo">
		{!! __('services.contact-extra-txt') !!}
	</div>
	<div class="contact__form">
		<p class="contact__form__subtitle">
			{!! __('services.contact-form-subtitle') !!}
		</p>
		<h3 class="contact__form__title">{!! __('services.contact-form-title') !!}</h3>
		@livewire('services.contact-form')
	</div>
</section>