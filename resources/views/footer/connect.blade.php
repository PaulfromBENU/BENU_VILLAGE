<section class="footer-connect">
	<p class="text-center">
		{{ __('footer.connect') }} <a href="https://www.instagram.com/benu_village/" target="_blank" rel="noreferrer" class="primary-color" style="font-weight: 600;">@benucouture</a>
	</p>
	@php
	$links = [
		'https://www.instagram.com/p/CYl-93OoVsQ/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/Ca11ENZtXO8/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/CSt0Pp7NQSX/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/CW_BbJjoWlR/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/ByciN4JA5lj/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/CIEQAM2AT9w/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/CNuenP0By4g/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/BxwuNYhFe0P/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/BwFAbYxHgjR/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/BwZ6sMmASHB/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/CR9JVgyoSiV/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/CW_BbJjoWlR/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/CRyld9aJCEQ/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/BuUUBqeAQ-r/?utm_source=ig_web_copy_link',
		'https://www.instagram.com/p/Bt_bc0zATkQ/?utm_source=ig_web_copy_link',
	];
	@endphp
	<div class="flex justify-start footer-connect__pictures">
		@for($i = 1; $i <= 15; $i++)
			<a href="{{ $links[$i - 1] }}" target="_blank" rel="noreferrer" class="block footer-connect__pictures__img-container">
				<img src="{{ asset('media/pictures/instagram/insta-'.$i.'.jpg') }}" style="height: 100%;">
			</a>
		@endfor	
	</div>
</section>