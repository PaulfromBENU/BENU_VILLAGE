@for($index = 1; $index <= $number_of_elements; $index++)
	@php $i = array_search($index, $element_position); @endphp
	<div wire:key="elements-{{ $article_id }}-{{ $i }}" class="relative" style="padding-bottom: 30px;">
		<div class="absolute flex justify-between" style="top: 5px; right: 5px;">
			<input type="number" class="create-news__position" name="element_position" wire:model.lazy="element_position.{{ $i }}">
			<button wire:click.prevent="deleteElement({{ $i }})">X</button>
		</div>
		@switch($element_types[$i])
			@case('0')
				<h4 class="create-news__new-element-title">Element #{{ $index }} - Paragraph</h4>
				<div class="flex create-news__new-paragraph">
					<div class="create-news__new-paragraph__field">
						<label>Content FR:</label><br/>
						<textarea wire:model.defer="element_contents_fr.{{ $i }}" rows="7"></textarea>
					</div>
					<div class="create-news__new-paragraph__field">
						<label>Content DE:</label><br/>
						<textarea wire:model.defer="element_contents_de.{{ $i }}" rows="7"></textarea>
					</div>
					<div class="create-news__new-paragraph__field">
						<label>Content LU:</label><br/>
						<textarea wire:model.defer="element_contents_lu.{{ $i }}" rows="7"></textarea>
					</div>
					<div class="create-news__new-paragraph__field">
						<label>Content EN:</label><br/>
						<textarea wire:model.defer="element_contents_en.{{ $i }}" rows="7"></textarea>
					</div>
				</div>
			@break

			@case('1')
				<h4 class="create-news__new-element-title">Element #{{ $index }} - Highlight</h4>
				<div class="flex create-news__new-paragraph">
					<div class="create-news__new-paragraph__field">
						<label>Content FR:</label><br/>
						<textarea wire:model.defer="element_contents_fr.{{ $i }}" rows="4"></textarea>
					</div>
					<div class="create-news__new-paragraph__field">
						<label>Content DE:</label><br/>
						<textarea wire:model.defer="element_contents_de.{{ $i }}" rows="4"></textarea>
					</div>
					<div class="create-news__new-paragraph__field">
						<label>Content LU:</label><br/>
						<textarea wire:model.defer="element_contents_lu.{{ $i }}" rows="4"></textarea>
					</div>
					<div class="create-news__new-paragraph__field">
						<label>Content EN:</label><br/>
						<textarea wire:model.defer="element_contents_en.{{ $i }}" rows="4"></textarea>
					</div>
				</div>
			@break

			@case('2')
				<h4 class="create-news__new-element-title">Element #{{ $index }} - Link</h4>
				<div class="create-news__new-link__field">
					<label>Link:</label><br/>
					<input type="text" name="element_links_{{ $i }}" wire:model.defer="element_links.{{ $i }}" placeholder="https://..." minlength="7">
				</div>
				<div class="flex create-news__new-link">
					<div class="create-news__new-link__field">
						<label>Label FR:</label><br/>
						<input type="text" name="element_link_labels_fr_{{ $i }}" wire:model.defer="element_link_labels_fr.{{ $i }}">
					</div>
					<div class="create-news__new-link__field">
						<label>Label DE:</label><br/>
						<input type="text" name="element_link_labels_de_{{ $i }}" wire:model.defer="element_link_labels_de.{{ $i }}">
					</div>
					<div class="create-news__new-link__field">
						<label>Label LU:</label><br/>
						<input type="text" name="element_link_labels_lu_{{ $i }}" wire:model.defer="element_link_labels_lu.{{ $i }}">
					</div>
					<div class="create-news__new-link__field">
						<label>Label EN:</label><br/>
						<input type="text" name="element_link_labels_en_{{ $i }}" wire:model.defer="element_link_labels_en.{{ $i }}">
					</div>
				</div>
			@break

			@case('3')
				<h4 class="create-news__new-element-title">Element #{{ $index }} - Landscape Picture</h4>
				<input type="file" wire:model="element_photo_files.{{ $i }}" class="new-photo-form__file-input">
			    <div wire:loading wire:target="element_photo_files.{{ $i }}">Uploading...</div>

			    @error('element_photo_files') <span class="error">{{ $message }}</span> @enderror
			    @if(is_file($element_photo_files[$i]))
			    	<h4>Photo Preview:</h4>
			        <div class="flex justify-start new-photo-form__img-gallery">
				        <div class="new-photo-form__img-gallery__img-container">
				        	<img src="{{ $element_photo_files[$i]->temporaryUrl() }}">
				        </div>
				    </div>
			    @elseif(is_string($element_photo_files[$i]) && $element_photo_files[$i] !== "")
			    	<h4>Photo Preview:</h4>
			        <div class="flex justify-start new-photo-form__img-gallery">
				        <div class="new-photo-form__img-gallery__img-container">
				        	<img src="{{ asset('images/pictures/news/'.$element_photo_files[$i]) }}">
				        </div>
				    </div>
			    @endif

			    <div class="flex create-news__new-link">
					<div class="create-news__new-link__field">
						<label>Photo Alt:</label><br/>
						<input type="text" name="element_photo_alts_{{ $i }}" wire:model.defer="element_photo_alts.{{ $i }}">
					</div>
					<div class="create-news__new-link__field">
						<label>Photo Title:</label><br/>
						<input type="text" name="element_photo_titles_{{ $i }}" wire:model.defer="element_photo_titles.{{ $i }}">
					</div>
				</div>
			@break

			@case('4')
				<h4 class="create-news__new-element-title">Element #{{ $index }} - Portrait Picture</h4>
				<input type="file" wire:model="element_vertical_photo_files.{{ $i }}" class="new-photo-form__file-input">
			    <div wire:loading wire:target="element_vertical_photo_files.{{ $i }}">Uploading...</div>

			    @error('element_vertical_photo_files') <span class="error">{{ $message }}</span> @enderror
			    @if(is_file($element_vertical_photo_files[$i]))
			    	<h4>Photo Preview:</h4>
			        <div class="flex justify-start new-photo-form__img-gallery">
				        <div class="new-photo-form__img-gallery__img-container">
				        	<img src="{{ $element_vertical_photo_files[$i]->temporaryUrl() }}">
				        </div>
				    </div>
			    @elseif(is_string($element_vertical_photo_files[$i]) && $element_vertical_photo_files[$i] !== "")
			    	<h4>Photo Preview:</h4>
			        <div class="flex justify-start new-photo-form__img-gallery">
				        <div class="new-photo-form__img-gallery__img-container">
				        	<img src="{{ asset('images/pictures/news/'.$element_vertical_photo_files[$i]) }}">
				        </div>
				    </div>
			    @endif

			    <div class="flex create-news__new-link">
					<div class="create-news__new-link__field">
						<label>Photo Alt:</label><br/>
						<input type="text" name="element_photo_alts_{{ $i }}" wire:model.defer="element_photo_alts.{{ $i }}">
					</div>
					<div class="create-news__new-link__field">
						<label>Photo Title:</label><br/>
						<input type="text" name="element_photo_titles_{{ $i }}" wire:model.defer="element_photo_titles.{{ $i }}">
					</div>
				</div>
			@break

			@default
				<h4 class="create-news__new-element-title" style="margin-bottom: 10px;">Element #{{ $i + 1 }} - Paragraph</h4>
				<div class="flex create-news__new-paragraph">
					<div class="create-news__new-paragraph__field">
						<label>Content FR:</label><br/>
						<textarea wire:model.defer="element_contents_fr.{{ $i }}" rows="7"></textarea>
					</div>
					<div class="create-news__new-paragraph__field">
						<label>Content DE:</label><br/>
						<textarea wire:model.defer="element_contents_de.{{ $i }}" rows="7"></textarea>
					</div>
					<div class="create-news__new-paragraph__field">
						<label>Content LU:</label><br/>
						<textarea wire:model.defer="element_contents_lu.{{ $i }}" rows="7"></textarea>
					</div>
					<div class="create-news__new-paragraph__field">
						<label>Content EN:</label><br/>
						<textarea wire:model.defer="element_contents_en.{{ $i }}" rows="7"></textarea>
					</div>
				</div>
			@break
		@endswitch
	</div>
@endfor

<div class="flex create-news__add-element">
	<button wire:click.prevent="addElement(0)">Add a paragraph</button>
	<button wire:click.prevent="addElement(1)">Add a highlight</button>
	<button wire:click.prevent="addElement(2)">Add a button with link</button>
	<button wire:click.prevent="addElement(3)">Add a landscape picture</button>
	<button wire:click.prevent="addElement(4)">Add a portrait picture</button>
</div>