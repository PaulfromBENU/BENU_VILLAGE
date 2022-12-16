@if($online_articles->count() == 0)
	<p>No online news for the moment...</p>
@endif
@foreach($online_articles as $online_article)
<div wire:key="online-{{ $online_article->id }}" class="flex create-news__pending" style="padding-top: 5px;">
	<p>
		{{ $online_article->title_en }}
	</p>
	<p>
		Creation date: {{ $online_article->created_at->format('d\/m\/Y') }}
	</p>
	<div class="text-right flex">
		<button wire:click="removeNews({{ $online_article->id }})" style="margin-right: 5px;">Remove</button>
		<button wire:click="fillArticleData({{ $online_article->id }})">Modify</button>
	</div>
</div>
@endforeach