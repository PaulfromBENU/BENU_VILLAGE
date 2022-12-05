<section class="footer-all">
	<p class="footer-all__txt footer-all__txt--left" id="footer-all-left" style="visibility: hidden;">
		{{ __('footer.all-txt-1-1') }} <strong>{{ __('footer.all-txt-1-2') }}</strong>
	</p>
	<p class="footer-all__txt footer-all__txt--right" id="footer-all-right" style="visibility: hidden;">
		{{ __('footer.all-txt-2-1') }} <strong>BENU COUTURE</strong>
	</p>
	<div class="flex justify-center flex-col md:flex-row w-full md:w-3/4 lg:w-1/2 m-auto">
		<a href="{{ route('about-'.app()->getLocale()) }}" class="btn-couture btn-couture--transparent" style="min-width: fit-content;">{{ __('footer.all-story') }}</a>
		<a href="{{ route('header.participate-'.app()->getLocale()) }}" class="btn-couture btn-couture--transparent">{{ __('footer.all-chart') }}</a>
	</div>
</section>