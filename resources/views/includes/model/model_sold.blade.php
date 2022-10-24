<section class="model-sold pattern-bg">
	<div class="benu-container">
		<h2 class="model-sold__title">{{ __('models.sold-title') }}</h2>
		<p class="model-sold__subtitle w-5/6 lg:w-1/2 m-auto">
			{{ __('models.sold-txt-1') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="primary-color hover:text-gray-800 transition">{{ __('models.sold-txt-1-link') }}</a>
		</p>
		<div class="flex flex-wrap justify-start model-sold__list">
			@foreach($sold_articles as $article)
				@livewire('components.sold-article-overview', ['article' => $article], key($article->id))
			@endforeach
		</div>
		<div class="model-sold__link">
			@if($sold_articles_total > 4)
			<a href="{{ route('sold-'.app()->getLocale(), ['name' => strtolower($model->name)]) }}" class="btn-slider-left m-auto">{{ __('models.sold-link') }}</a>
			@endif
		</div>
	</div>
</section>