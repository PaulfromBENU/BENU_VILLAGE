<x-filament::page>
	<form method="POST" wire:submit.prevent="saveVariation" class="stock-handling">
		@csrf

		<h2>Select a variation to update</h2>

		<div class="flex justify-between mb-10 stock-handling__input-group">
			<div class="flex justify-start flex-wrap">
				<div>
					<label for="creation-0">Creation</label><br/>
					<select name="creation-0" id="creation-0" class="stock-handling__select" wire:model="creation_name">
						<option value="none-0" wire:click="adaptVariations(0)">Select a creation</option>
						@foreach($all_creations as $creation)
							<option value="{{ $creation->name }}" wire:key="stock-creation-{{ $creation->id }}" wire:click="adaptVariations({{ $creation->id }})">{{ $creation->name }}</option>
						@endforeach
					</select> 
				</div>
				<div>
					<label for="variation-0">Variation</label><br/>
					<select name="variation-0" id="variation-0" class="stock-handling__select" wire:model="variation_name">
						<option value="none-0">Select a variation</option>
						@foreach($computed_variations as $variation)
							<option value="{{ $variation->name }}" wire:key="stock-variation-{{ $variation->id }}" wire:click="loadVariationData">{{ $variation->name }}</option>
						@endforeach
					</select> 
				</div>
			</div>
		</div>

		@if($selected_variation !== null)
			<h2>Stock in Shops</h2>
			<div class="flex justify-start stock-handling__stock-container">
				@foreach($all_shops as $shop)
					<div wire:key="stock-shops-{{ $shop->id }}" class="stock-handling__stock">
						<p>
							{{ $shop->name }}
						</p>
						<input type="text" name="shop_name" wire:model.defer="stock_by_shop.{{ $shop->filter_key }}">
					</div>
				@endforeach
			</div>

			<h2>Variation pictures</h2>
			<div class="flex justify-start new-photo-form__variations-gallery" style="height: auto; overflow-y: auto;">
				@if($selected_variation !== null && $selected_variation->photos()->count() > 0)
					@foreach($selected_variation->photos()->get() as $photo)
						<figure class="new-photo-form__variations-gallery__img-container text-center">
							<figcaption style="height: 25px;">{{ explode("/", $photo->file_name)[2] }}</figcaption>
							<img src="{{ asset('media/pictures/articles/'.$photo->file_name) }}" style="margin-bottom: 5px;">
							<input type="checkbox" name="is_front" value="1" id="is_front_{{ $photo->id }}" wire:model="front_pictures.{{ $photo->id }}" style="border-radius: 4px; margin-right: 5px;">
							<label for="is_front_{{ $photo->id }}">Is front picture</label>

							<button wire:click.prevent.stop="deletePhoto({{ $photo->id }})" class="flex" style="margin: auto; margin-top: 5px; padding: 10px; border: none; font-size: 1rem;">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
								</svg> Delete picture
							</button>
				        </figure>
				    @endforeach
				@endif
			</div>

			<h2>Upload new pictures for this variation</h2>
			<h4>Photos Preview:</h4>
	        <div class="flex justify-start new-photo-form__img-gallery" style="overflow-x: auto; height: fit-content; min-height: 20px; max-height: 220px;">
		        @foreach($photos as $photo)
		        <div class="new-photo-form__img-gallery__img-container" style="height: auto;">
		        	<img src="{{ $photo->temporaryUrl() }}">
		        </div>
		        @endforeach
		    </div>
		    <input type="file" wire:model="photos" class="new-photo-form__file-input" multiple>
		    <div wire:loading wire:target="photos">Uploading...</div>

		    @error('photo') <span class="error">{{ $message }}</span> @enderror

		    <div class="flex" style="margin-bottom: 40px;">
		    	<button wire:click.prevent.stop="loadPictures">Load pictures</button>
		    	<button wire:click.prevent.stop="clearUploadPictures">Clear pictures</button>
		    </div>

		    <h2 style="margin-top: 40px;">Variation data</h2>
		    <div class="flex justify-start flex-wrap mb-5">
				<div>
					<label>Size:<br/></label>
					<select name="size" class="sell-form__select" wire:model="size_id">
						@foreach($all_sizes as $size_id => $size_value)
							<option value="{{ $size_id }}" wire:key="{{ 'size-'.$selected_variation->id.'-'.$size_id }}">{{ $size_value }}</option>
						@endforeach
					</select>
				</div>

				<div>
					<label>Color:<br/></label>
					<select name="color" class="sell-form__select" wire:model="color_id">
						@foreach($all_colors as $color_id => $color_name)
							<option value="{{ $color_id }}" wire:key="{{ 'color-'.$selected_variation->id.'-'.$color_id }}">{{ $color_name }}</option>
						@endforeach
					</select>
				</div>

				<div>
					<label>Size for delivery:<br/></label>
					<select name="color" class="sell-form__select" wire:model="delivery_size">
						<option value="0">Send as package</option>
						<option value="1">Envelope MINI</option>
						<option value="2">Envelope MAXI</option>
					</select>
				</div>
			</div>

			<h2>Composition</h2>
			<div class="flex justify-between flex-wrap">
				@foreach($all_compos as $compo_id => $composition)
				<div wire:key="{{ 'compo-'.$selected_variation->id.'-'.$compo_id }}" class="article-check__form__select-group">
					<input type="checkbox" id="compo-{{ $compo_id }}" name="compo-{{ $compo_id }}" wire:model="compo_ids.{{ $compo_id }}">
					<label for="compo-{{ $compo_id }}">{{ $composition }}</label>
				</div>
				@endforeach
			</div>

			<h2 style="margin-top: 40px;">Care Recommendations</h2>
			<div class="flex justify-between flex-wrap">
				@foreach($all_cares as $care_id => $care)
				<div wire:key="{{ 'care-'.$selected_variation->id.'-'.$care_id }}" class="article-check__form__select-group">
					<input type="checkbox" id="care-{{ $care_id }}" name="care-{{ $care_id }}" wire:model="care_ids.{{ $care_id }}">
					<label for="care-{{ $care_id }}">{{ $care }}</label>
				</div>
				@endforeach
			</div>

			<h2 style="margin-top: 40px;">Singularity</h2>
			<div class="flex justify-between flex-wrap">
				<div class="article-check__form__singularity">
					<label>Singularity FR<br/></label>
					<textarea wire:model="singularity_fr"></textarea>
				</div>
				<div class="article-check__form__singularity">
					<label>Singularity DE<br/></label>
					<textarea wire:model="singularity_de"></textarea>
				</div>
				<div class="article-check__form__singularity">
					<label>Singularity LU<br/></label>
					<textarea wire:model="singularity_lu"></textarea>
				</div>
				<div class="article-check__form__singularity">
					<label>Singularity EN<br/></label>
					<textarea wire:model="singularity_en"></textarea>
				</div>
			</div>

			<div class="text-center" style="margin-top: 60px;">
				<button type="submit">Update</button>
			</div>
		@endif
	</form>
</x-filament::page>
