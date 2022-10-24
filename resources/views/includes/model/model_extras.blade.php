<section class="model-articles benu-container">
	@if($extra_accessories->count() > 0)
	<h2 style="margin-bottom: 40px;">{{ __('models.extra-articles-title') }}</h2>
	<p class="text-center w-1/2 m-auto pb-10 font-medium" id="model-extra-accessories">
		{{ __('models.extra-articles-explanation') }}
	</p>
	<div class="model-articles__list flex flex-wrap justify-start pt-10">
	    @foreach($extra_accessories as $article)
	        @livewire('components.article-overview', ['article' => $article], key('extra-'.$article->id))
	    @endforeach
	</div>
	@endif
</section>