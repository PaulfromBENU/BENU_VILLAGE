<section class="benu-container footer-learnmore flex flex-col md:flex-row flex-wrap justify-around">
	<div class="footer-learnmore__block">
		<img src="{{ asset('media/pictures/benu-couture-illustration-footer1.png') }}">
		<h3>
			<span class="primary-color">BENU COUTURE</span> {{ __('footer.more-title-1') }}
		</h3>
		<p>
			{{ __('footer.more-txt-1') }}
		</p>
		<div class="text-center footer-learnmore__block__btn">
			<a href="{{ route('footer.general-info-'.app()->getLocale()) }}" class="btn-couture">{{ __('footer.more-learn') }}</a>
		</div>
	</div>
	<div class="footer-learnmore__block">
		<img src="{{ asset('media/pictures/benu-couture-illustration-footer2.png') }}">
		<h3>
			{{ __('footer.more-title-2') }} <span class="primary-color">BENU COUTURE</span>
		</h3>
		<p>
			{{ __('footer.more-txt-2') }}
		</p>
		<div class="text-center footer-learnmore__block__btn">
			<a href="{{ route('about-'.app()->getLocale()) }}" class="btn-couture">{{ __('footer.more-learn-2') }}</a>
		</div>
	</div>
</section>