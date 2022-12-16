@if($pending_articles->count() == 0)
	<p>No pending news for the moment...</p>
@endif
@foreach($pending_articles as $pending_article)
<div wire:key="pending-{{ $pending_article->id }}" class="flex create-news__pending">
	<p>
		{{ $pending_article->title_en }}
	</p>
	<p>
		Creation date: {{ $pending_article->created_at->format('d\/m\/Y') }}
	</p>
	@if($delete_check[$pending_article->id])
	<p class="text-right">
		<button wire:click="deleteNews({{ $pending_article->id }})">Confirm delete</button>
		<button wire:click="cancelDelete({{ $pending_article->id }})">Cancel</button>
	</p>
	@else
	<p class="text-right">
		<button wire:click="checkDelete({{ $pending_article->id }})">Delete</button>
		<button wire:click="fillArticleData({{ $pending_article->id }})">Modify</button>
		<button wire:click="sendOnline({{ $pending_article->id }})">Validate</button>
	</p>
	@endif
</div>
@endforeach