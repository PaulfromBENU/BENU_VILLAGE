<x-filament::page>
	@if($variations_to_validate->count() > 0)
		@foreach($variations_to_validate as $article)
			<div class="article-check" wire:key="article-block-{{ $article->id }}">

				<h3>{{ strtoupper($article->name) }}</h3>

				<div class=" flex flex-start flex-wrap article-check__img-container" style="height: 270px;">
					@foreach($article->photos as $photo)
					<div class="text-center" style="margin-right: 5px;" wire:key="{{ 'photo-'.$article->id.'-'.$photo->id }}">
						<img src="{{ asset('media/pictures/articles/'.$photo->file_name) }}" />
					</div>
					@endforeach
				</div>

				<div class="flex justify-start flex-wrap" style="margin-bottom: 25px;">
					<div class="flex flex-col justify-start" style="width: 25%;">
						<p style="margin-right: 15px;">
							<strong>Size:</strong> {{ $article->size->value }}
						</p>

						<p style="margin-right: 15px;">
							<strong>Main color:</strong> {{ $article->color->name }}
						</p>

						<p style="margin-right: 15px;">
							<strong>Size for delivery:</strong> 
							@if($article->size_category == 1)
								Small Envelope
							@elseif($article->size_category == 2)
								Maxi Envelope
							@else
								Package
							@endif
						</p>

						<p style="margin-right: 15px;">
							<strong>Weight:</strong> {{ $article->creation->weight }}g
						</p>

						<p style="margin-right: 15px;">
							<strong>Creation date:</strong> {{ $article->creation_date }}
						</p>
					</div>

					<div style="width: 25%;">
						@foreach($all_shops as $shop_id => $shop_name)
						<div wire:key="{{ 'shop-'.$article->id.'-'.$shop_id }}" style="margin-right: 25px;">
							<p><strong>Stock {{ $shop_name }}:</strong> {{ $stocks[$article->id][$shop_id] }}</p>
						</div>
						@endforeach
					</div>

					<div style="width: 25%;">
						@foreach($all_compos as $compo_id => $composition)
						<div wire:key="{{ 'compo-'.$article->id.'-'.$compo_id }}" class="flex">
							<p style="width: 25px;">
								<strong>@if($compo_ids[$article->id][$compo_id]) X @endif</strong>
							</p>
							<p>{{ $composition }}</p>
						</div>
						@endforeach
					</div>

					<div style="width: 25%;">
						@foreach($all_cares as $care_id => $care)
						<div wire:key="{{ 'care-'.$article->id.'-'.$care_id }}" class="flex">
							<p style="width: 25px;">
								<strong>@if($care_ids[$article->id][$care_id]) X @endif</strong>
							</p>
							<p>{{ $care }}</p>
						</div>
						@endforeach
					</div>
				</div>

				<div class="flex justify-between flex-wrap">
					<div style="width: 40%; margin-bottom: 25px;">
						Singularity - FR
						<p style="padding: 20px; border: lightgrey 1px solid; border-radius: 4px;">
							<em>{{ $singularities_fr[$article->id] }}</em>
						</p>
					</div>
					<div style="width: 40%; margin-bottom: 25px;">
						Singularity - EN
						<p style="padding: 20px; border: lightgrey 1px solid; border-radius: 4px;">
							<em>{{ $singularities_en[$article->id] }}</em>
						</p>
					</div>
					<div style="width: 40%; margin-bottom: 25px;">
						Singularity - DE
						<p style="padding: 20px; border: lightgrey 1px solid; border-radius: 4px;">
							<em>{{ $singularities_de[$article->id] }}</em>
						</p>
					</div>
					<div style="width: 40%; margin-bottom: 25px;">
						Singularity - LU
						<p style="padding: 20px; border: lightgrey 1px solid; border-radius: 4px;">
							<em>{{ $singularities_lu[$article->id] }}</em>
						</p>
					</div>
				</div>

				<div class="flex justify-center">
					<div class="new-photo-form__btn-container text-center" style="width: 20%;">
						<button wire:click="validateVariation({{ $article->id }})">Validate and send online</button>
					</div>
					<div class="new-photo-form__btn-container text-center" style="width: 20%;">
						<button wire:click="refuseVariation({{ $article->id }})">Refuse variation</button>
					</div>
				</div>
			</div>
		@endforeach
	@else
		<p>No variation to validate for the moment...</p>
	@endif
</x-filament::page>
