<section class="model-articles" id="model-articles">
	<h2>{{ __('models.articles-title') }}</h2>
	@livewire('filters.model-articles-filter', ['filter_names' => $filter_names, 'initial_filters' => $initial_filters])
	@livewire('filters.filtered-articles', ['creation' => $model, 'initial_filters' => $initial_filters])
</section>