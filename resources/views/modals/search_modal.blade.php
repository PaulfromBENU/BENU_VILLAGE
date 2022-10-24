<div class="modal search-modal" id="search-modal" style="display: none;">
	<form method="POST" action="#" class="flex justify-between search-modal__form">
		@csrf
		<label for="general-search-input">{{ __('header.search') }}</label>
		<input type="text" name="general_search" id="general-search-input" class="input-underline">
		<button type="submit" class="m-auto">
			@svg('benu-icon-magnifying-glass-search', 'search-modal__icon')
		</button>
	</form>
</div>