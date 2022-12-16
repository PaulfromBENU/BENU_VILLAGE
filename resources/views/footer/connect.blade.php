<section class="footer-connect">
	<p class="text-center">
		{{ __('footer.connect') }} <a href="https://www.instagram.com/benu_village/" target="_blank" rel="noreferrer" class="primary-color" style="font-weight: 600;">@benuvillage</a>
	</p>
	
	<div class="flex justify-start footer-connect__pictures">
		@foreach($insta_links as $insta_link)
			<a href="{{ $insta_link->post_link }}" target="_blank" rel="noreferrer" class="block footer-connect__pictures__img-container">
				<img src="{{ asset($insta_link->picture_name) }}" style="height: 100%; object-fit: cover;">
			</a>
		@endforeach
	</div>
</section>