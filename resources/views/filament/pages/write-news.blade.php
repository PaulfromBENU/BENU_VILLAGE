<x-filament::page>
	<div class="create-news">

		@if($show_general_info)
		<h1 wire:click="toggleGeneralInfo(0)" style="margin-bottom: 20px;" class="flex justify-between"><p>Create or Update News</p> <p class="text-2xl"><strong>-</strong></p></h1>
		<form style="padding-left: 5px; margin-bottom: 40px;" wire:submit.prevent="createNewArticle">
		@else
		<h1 wire:click="toggleGeneralInfo(1)" style="margin-bottom: 20px;" class="flex justify-between"><p>Create or Update News</p> <p class="text-2xl"><strong>+</strong></p></h1>
		<form style="display: none;" wire:submit.prevent="createNewArticle">
		@endif
		@csrf
			@if($show_article_meta)
			<h2 wire:click="toggleArticleMeta(0)" class="flex justify-between"><p>Article General Data (Mandatory to create news) </p><p class="text-2xl"><strong>-</strong></p></h2>
			<div style="padding-left: 10px; margin-bottom: 40px; border-left: solid 1px rgb(234 179 8);">
			@else
			<h2 wire:click="toggleArticleMeta(1)" style="margin-bottom: 20px;" class="flex justify-between"><p>Article General Data (Mandatory to create news) </p><p class="text-2xl"><strong>+</strong></p></h2>
			<div style="display: none;">
			@endif

				@include('filament.includes.write-news.article-meta')

		    </div>


		    @if($show_article_content)
			<h2 wire:click="toggleArticleContent(0)" class="flex justify-between"><p>Article Content</p> <p class="text-2xl"><strong>-</strong></p></h2>
			<div style="padding-left: 10px; margin-bottom: 40px; border-left: solid 1px rgb(234 179 8);">
			@else
			<h2 wire:click="toggleArticleContent(1)" style="margin-bottom: 20px;" class="flex justify-between"><p>Article Content </p><p class="text-2xl"><strong>+</strong></p></h2>
			<div style="display: none;">
			@endif

				@include('filament.includes.write-news.article-content')
			
			</div>


			<div class="text-center" style="margin: 20px;">
				<button>
					Create/Update News
				</button>
			</div>
		</form>


		@if($show_pending_articles)
		<h1 wire:click="togglePendingArticles(0)" class="flex justify-between"><p>News waiting for validation </p><p class="text-2xl"><strong>-</strong></p></h1>
		<div style="padding-left: 5px; margin-bottom: 40px;">
		@else
		<h1 wire:click="togglePendingArticles(1)" style="margin-bottom: 20px;" class="flex justify-between"><p>News waiting for validation </p><p class="text-2xl"><strong>+</strong></p></h1>
		<div style="display: none;">
		@endif

			@include('filament.includes.write-news.pending-news')

		</div>


		@if($show_online_articles)
		<h1 wire:click="toggleOnlineArticles(0)" class="flex justify-between"><p>News already online </p><p class="text-2xl"><strong>-</strong></p></h1>
		<div style="padding-left: 5px; margin-bottom: 40px;">
		@else
		<h1 wire:click="toggleOnlineArticles(1)" style="margin-bottom: 20px;" class="flex justify-between"><p>News already online </p><p class="text-2xl"><strong>+</strong></p></h1>
		<div style="display: none;">
		@endif

			@include('filament.includes.write-news.online-news')

		</div>
	</div>
</x-filament::page>