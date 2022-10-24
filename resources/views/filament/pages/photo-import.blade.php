<x-filament::page>
	<form wire:submit.prevent="savePhoto" class="new-photo-form">
		@csrf

		<h3>Creation selection</h3>
		<div>
			<select name="creation-0" id="creation-0" class="sell-form__select" wire:model="creation_id">
				<option value="0" wire:click="adaptVariations(0)">Select a creation</option>
				@foreach($all_creations as $creation)
					<option value="{{ $creation->id }}" wire:key="creations-{{ $creation->id }}" wire:click="adaptVariations({{ $creation->id }})">{{ $creation->name }}@if($creation->creation_category()->count() > 0) - {{ $creation->creation_category->name_en }}@endif</option>
				@endforeach
			</select> 
		</div>

		
		<h4>
			@if($creation_id != 0)
			<em>Existing variations for this creation:</em>
			@else
			<em>Select a creation to continue. If the creation does not exist, it must be created in 'CREATIONS & VARIATIONS -> Creations -> New Creation'.</em>
			@endif
		</h4>
		<div class="flex justify-start new-photo-form__variations-gallery">
			@foreach($existing_variations as $variation)
				<figure class="new-photo-form__variations-gallery__img-container">
					@if($variation->photos()->where('is_front', '1')->count() > 0)
						<img src="{{ asset('media/pictures/articles/'.$variation->photos()->where('is_front', '1')->first()->file_name) }}">
					@else
						<img src="{{ asset('media/pictures/articles/'.$variation->photos()->first()->file_name) }}">
					@endif
					<figcaption>{{ $variation->name }} - {{ $variation->size->value }} - {{ $variation->color->name }}</figcaption>
		        </figure>
			@endforeach
		</div>

		<h3>New variation details</h3>
		<div class="flex justify-start flex-wrap">
			<!-- <div>
				<label for="article-0">Select an article</label><br/>
				<select name="article-0" id="article-0" class="sell-form__select" wire:model="article_id">
					<option value="-1">Select article</option>
					<option value="0" wire:click="getSizeandColor">Create new article</option>
					@foreach($existing_variations as $variation)
						<option value="{{ $variation->id }}" wire:key="{{ $variation->id }}" wire:click="getSizeandColor">{{ $variation->name }}</option>
					@endforeach
				</select> 
			</div> -->
			<div>
				<label for="size-0">Select size</label><br/>
				<select name="size-0" id="size-0" class="sell-form__select" wire:model="size_id" @if($is_new_article == 0) disabled @endif>
					<option value="0">Select size</option>
					@foreach($all_sizes as $size_id => $size_value)
						<option value="{{ $size_id }}" wire:key="size-{{ $size_id }}">{{ $size_value }}</option>
					@endforeach
				</select>
			</div>
			<div>
				<label for="color-0">Select main color</label><br/>
				<select name="color-0" id="color-0" class="sell-form__select" wire:model="color_id" @if($is_new_article == 0) disabled @endif>
					<option value="0">Choose color</option>
					@foreach($all_colors as $color_id => $color_name)
						<option value="{{ $color_id }}" wire:key="color-{{ $color_id }}">{{ $color_name }}</option>
					@endforeach
				</select> 
			</div>

			<div>
				<label for="shop-0">Shop where the article is sold</label><br/>
				<select name="shop-0" id="shop-0" class="sell-form__select" wire:model="shop_id">
					<option value="0">Choose shop</option>
					@foreach($all_shops as $shop_id => $shop_name)
						<option value="{{ $shop_id }}" wire:key="shop-{{ $shop_id }}">{{ $shop_name }}</option>
					@endforeach
				</select> 
			</div>

			<div>
				<label for="color-0">Insert date of creation (dd.mm.yyyy)</label><br/>
				<input type="text" name="creation_date" wire:model="article_creation_date" class="sell-form__select" style="background: transparent;" @if($is_new_article == 0) disabled @endif>
			</div>
		</div>

		<h3>Photo importation</h3>
        <h4>Photos Preview:</h4>
        <div class="flex justify-start new-photo-form__img-gallery">
	        @foreach($photos as $photo)
	        <div class="new-photo-form__img-gallery__img-container">
	        	<img src="{{ $photo->temporaryUrl() }}">
	        </div>
	        @endforeach
	    </div>
	    <input type="file" wire:model="photos" class="new-photo-form__file-input" multiple>
	    <div wire:loading wire:target="photos">Uploading...</div>

	    @error('photo') <span class="error">{{ $message }}</span> @enderror
	    <div class="new-photo-form__btn-container">
	    	<button type="submit">Import Photos & Save</button>
	    </div>
	</form>
</x-filament::page>
