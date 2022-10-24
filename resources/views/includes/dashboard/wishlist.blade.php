<div class="dashboard-wishlist w-full">
	<h2>
        {!! __('dashboard.my-wishlist') !!}
    </h2>
	<h3 class="dashboard-wishlist__title dashboard-wishlist__title--couture">BENU COUTURE</h3>
	<div class="flex justify-between flex-wrap mb-10 w-full m-auto">
		@foreach($couture_wishlisted_vouchers as $voucher)
			@livewire('components.voucher-overview', ['voucher' =>  $voucher], key($voucher->id))
		@endforeach
		@foreach($couture_wishlisted_articles as $article)
			@livewire('components.article-overview-wishlist', ['article' =>  $article], key($article->id))
		@endforeach
		@foreach($couture_wishlisted_sold_articles as $sold_article)
			@livewire('components.sold-article-overview-wishlist', ['article' =>  $sold_article], key($sold_article->id))
		@endforeach
	</div>

<!-- 	<h2 class="dashboard-wishlist__title dashboard-wishlist__title--design pt-5">BENU DESIGN</h2>
	<div class="flex justify-start flex-wrap mb-10 w-4/5 m-auto">

	</div>

	<h2 class="dashboard-wishlist__title dashboard-wishlist__title--lasa pt-5">BENU LaSA</h2>
	<div class="flex justify-start flex-wrap mb-10 w-4/5 m-auto">

	</div> -->
	<!-- <p class="text-sm"><em>* Adaptation des couleurs prévue ;)</em></p> -->
</div>


