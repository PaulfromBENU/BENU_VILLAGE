<x-filament::page>
	@if($unchecked_articles->count() > 0)
		@foreach($unchecked_articles as $article)
			@if($article->checked == '0')
			<div class="article-check" wire:key="{{ $article->id }}">
				<div class="flex justify-between" style="border-bottom: solid 1px lightgrey;">
					<h3 style="border: none;">{{ $article->creation->name }} - {{ $article->name }} - Added on {{ Carbon\Carbon::parse($article->created_at)->format('d M Y'); }}</h3>
					<div>
						<button wire:click="deleteVariation({{ $article->id }})">Delete variation</button>
					</div>
				</div>
				<div>
					<div class=" flex flex-start article-check__img-container">
						@foreach($article->photos as $photo)
						<div class="text-center" style="margin-right: 5px;" wire:key="{{ 'photo-'.$article->id.'-'.$photo->id }}">
							<img src="{{ asset('media/pictures/articles/'.$photo->file_name) }}" />
							<button wire:click="deletePhoto({{ $article->id }}, {{ $photo->id }})" class="flex" style="margin: auto;">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
								</svg> Delete picture
							</button>
						</div>
						@endforeach
					</div>

					<form method="POST" class="block article-check__form" wire:submit.prevent="validateArticle({{ $article->id }})">
						@csrf
						<h4>
							> General
						</h4>
						<div class="flex justify-start flex-wrap mb-5">
							<div>
								<label>Size:<br/></label>
								<select name="size" class="sell-form__select" wire:model="size_ids.{{ $article->id }}">
									@foreach($all_sizes as $size_id => $size_value)
										<option value="{{ $size_id }}" wire:key="{{ 'size-'.$article->id.'-'.$size_id }}">{{ $size_value }}</option>
									@endforeach
								</select>
							</div>

							<div>
								<label>Color:<br/></label>
								<select name="color" class="sell-form__select" wire:model="color_ids.{{ $article->id }}">
									@foreach($all_colors as $color_id => $color_name)
										<option value="{{ $color_id }}" wire:key="{{ 'color-'.$article->id.'-'.$color_id }}">{{ $color_name }}</option>
									@endforeach
								</select>
							</div>

							<div>
								<label>Size for delivery:<br/></label>
								<select name="color" class="sell-form__select" wire:model="delivery_sizes.{{ $article->id }}">
									<option value="0">Send as package</option>
									<option value="1">Envelope MINI</option>
									<option value="2">Envelope MAXI</option>
								</select>
							</div>
						</div>

						<h4>> Stock in shops</h4>
						<div class="flex justify-start flex-wrap">
							@foreach($all_shops as $shop_id => $shop_name)
							<div wire:key="{{ 'shop-'.$article->id.'-'.$shop_id }}" style="margin-right: 25px;">
								<label>Stock {{ $shop_name }}<br/></label>
								<input type="text" name="stock" wire:model="stocks.{{ $article->id }}.{{ $shop_id }}">
							</div>
							@endforeach
						</div>

						<h4>> Composition</h4>
						<div class="flex justify-between flex-wrap">
							@foreach($all_compos as $compo_id => $composition)
							<div wire:key="{{ 'compo-'.$article->id.'-'.$compo_id }}" class="article-check__form__select-group">
								<input type="checkbox" id="compo-{{ $compo_id }}" name="compo-{{ $compo_id }}" wire:model="compo_ids.{{ $article->id }}.{{ $compo_id }}">
								<label for="compo-{{ $compo_id }}">{{ $composition }}</label>
							</div>
							@endforeach
						</div>


						<h4>> Care Recommendations</h4>
						<div class="flex justify-between flex-wrap">
							@foreach($all_cares as $care_id => $care)
							<div wire:key="{{ 'care-'.$article->id.'-'.$care_id }}" class="article-check__form__select-group">
								<input type="checkbox" id="care-{{ $care_id }}" name="care-{{ $care_id }}" wire:model="care_ids.{{ $article->id }}.{{ $care_id }}">
								<label for="care-{{ $care_id }}">{{ $care }}</label>
							</div>
							@endforeach
						</div>


						<h4>> Singularity</h4>
						<div class="flex justify-between flex-wrap">
							<div class="article-check__form__singularity">
								<label>Singularity FR<br/></label>
								<textarea wire:model="singularities_fr.{{ $article->id }}"></textarea>
							</div>
							<div class="article-check__form__singularity">
								<label>Singularity DE<br/></label>
								<textarea wire:model="singularities_de.{{ $article->id }}"></textarea>
							</div>
							<div class="article-check__form__singularity">
								<label>Singularity LU<br/></label>
								<textarea wire:model="singularities_lu.{{ $article->id }}"></textarea>
							</div>
							<div class="article-check__form__singularity">
								<label>Singularity EN<br/></label>
								<textarea wire:model="singularities_en.{{ $article->id }}"></textarea>
							</div>
						</div>

						<div class="new-photo-form__btn-container">
					    	<button type="submit">Update and send to validation</button>
					    </div>
					</form>
				</div>
			</div>
			@endif
		@endforeach
	@else
		<p>No new variation for the moment...</p>
	@endif
</x-filament::page>
