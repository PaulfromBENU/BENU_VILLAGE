<div class="all-news__filter-tags flex justify-center flex-wrap">
    @foreach($all_tags as $index => $tag)
        <div class="all-news__filter-tags__tag @if($index == $active_tag) all-news__filter-tags__tag--active @endif" wire:click="filterByTag('{{ $tag }}', {{ $index }})" wire:key="all-tags-{{ strtolower($tag) }}-{{ $index }}">
            {{ ucfirst(strtolower($tag)) }}
        </div>
    @endforeach
</div>
