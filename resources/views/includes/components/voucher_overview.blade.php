<a href="#" class="block article-overview mr-4">
	<div class="article-overview__cap article-overview__cap--red"></div>
	<div class="article-overview__img-container">
		<img src="{{ asset('media/pictures/vouchers_img.png') }}">
		<div class="slider-arrow slider-arrow--color-2 slider-arrow--left article-arrow-left">
			<i class="fas fa-chevron-left"></i>
		</div>
		<div class="slider-arrow slider-arrow--color-2 slider-arrow--right article-arrow-right">
			<i class="fas fa-chevron-right"></i>
		</div>
	</div>
	<div class="article-overview__footer">
		<div class="flex justify-start">
			@if($voucher->voucher_type == 'pdf')
			<p class="article-overview__footer__size">
				{{ __('vouchers.format-pdf') }}
			</p>
			@else
			<p class="article-overview__footer__size">
				{{ __('vouchers.format-clothe') }}
			</p>
			@endif
		</div>
		<p class="article-overview__footer__category">
			
		</p>
		<p class="article-overview__footer__name">
			{{ __('vouchers.card-name') }}
		</p>
		<div class="flex justify-between">
			<p class="article-overview__footer__price" style="font-size: 2rem;">
				{{ __('vouchers.card-price') }} 30&euro;
			</p>
			<div class="article-overview__footer__heart">
				<div class="article-overview__footer__heart__icon">
					<i class="far fa-heart"></i>
				</div>
				<div class="article-overview__footer__heart__icon article-overview__footer__heart__icon--hovered">
					<i class="fas fa-heart"></i>
				</div>
			</div>
		</div>
	</div>
</a>