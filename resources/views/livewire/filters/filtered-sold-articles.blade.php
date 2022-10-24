<div class="model-articles__list flex flex-wrap justify-start benu-container">
    @if($articles->count() == 0)
        <div class="filter-no-result">
            {{ __('models.filter-no-result') }}
        </div>
    @endif
    @foreach($articles as $article)
        @livewire('components.sold-article-overview', ['article' => $article], key($article->id))
    @endforeach
</div>