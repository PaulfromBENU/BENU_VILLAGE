<section class="benu-container footer-more">
	<div class="benu-container footer-more__wrapper">
		<div class="footer-more__block">
			<h3>{!! __('footer.questions-title') !!}</h3>
			<p class="footer-more__txt">
				{!! __('footer.questions-txt-1') !!}
			</p>
			<div class="text-center">
				<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="btn-couture">{{ __('footer.questions-contact') }}</a>
			</div>
		</div>
		<div class="footer-more__illustration footer-more__illustration--left mobile-hidden">
			<img src="{{ asset('media/pictures/benu-village-illustration-footer-left.png') }}">
		</div>
		<div class="footer-more__illustration footer-more__illustration--right mobile-hidden">
			<img src="{{ asset('media/pictures/benu-village-illustration-footer-right.png') }}">
		</div>
	</div>
</section>