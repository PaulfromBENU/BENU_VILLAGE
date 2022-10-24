<div class="model-articles__list flex flex-col md:flex-row flex-wrap justify-start benu-container">
    @if($articles->count() == 0)
        <div class="filter-no-result">
            {{ __('models.filter-no-result') }}
        </div>
    @endif
    @foreach($articles as $article)
        @livewire('components.article-overview', ['article' => $article], key($article->id))
    @endforeach
</div>