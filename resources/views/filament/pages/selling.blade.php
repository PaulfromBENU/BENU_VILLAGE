<x-filament::page>
	<h2>Select one or more items to sell</h2>
	<form method="POST" wire:submit.prevent="sellArticles" class="sell-form">
		@csrf

		<div class="flex justify-between mb-10 sell-form__input-group">
			<div class="flex justify-start flex-wrap">
				<div>
					<label for="creation-0">Création</label><br/>
					<select name="creation-0" id="creation-0" class="sell-form__select" wire:model="creation_name">
						<option value="none-0" wire:click="adaptVariations(0)">Sélectionnez une création</option>
						@foreach($all_creations as $creation)
							<option value="{{ $creation->name }}" wire:key="{{ $creation->id }}" wire:click="adaptVariations({{ $creation->id }})">{{ $creation->name }}</option>
						@endforeach
					</select> 
				</div>
				<div>
					<label for="variation-0">Variation</label><br/>
					<select name="variation-0" id="variation-0" class="sell-form__select" wire:model="variation_name">
						<option value="none-0" wire:click="adaptShops(0)">Sélectionnez une variation</option>
						@foreach($computed_variations as $variation)
							<option value="{{ $variation->name }}" wire:key="{{ $variation->id }}" wire:click="adaptShops({{ $variation->id }})">{{ $variation->name }}</option>
						@endforeach
					</select> 
				</div>
				<div>
					<label for="shop-0">Magasin</label><br/>
					<select name="shop-0" id="shop-0" class="sell-form__select" wire:model="shop_name">
						<option value="none-0" wire:click="adaptStock(0)">Sélectionnez un magasin</option>
						@foreach($available_shops as $shop)
							<option value="{{ $shop->filter_key }}" wire:key="{{ $shop->filter_key }}" wire:click="adaptStock({{ $shop->id }})">{{ $shop->name }}</option>
						@endforeach
					</select> 
				</div>
				<div>
					<label for="number-0">Nombre d'articles</label><br/>
					<select name="number-0" id="number-0" class="sell-form__select" wire:model="articles_number">
						@for($stock = 1; $stock <= $max_items; $stock ++)
							<option value="{{ $stock }}" wire:click="calculateItemPrice">{{ $stock }}</option>
						@endfor
					</select> 
				</div>
			</div>

			<div class="sell-form__line-price">
				<br/>Prix : {{ $item_price }}&euro;
			</div>
		</div>

		@for($i = 1; $i <= $lines_number; $i ++)
		<!-- To be completed with additionnal lines -->
		@endfor

		<div class="flex justify-between">
			<!-- <p wire:click="addArticle" class="sell-form__add-btn">
				+ Ajouter un article
			</p> -->
			<p></p>
			<p class="sell-form__total-price">
				Total : {{ $total_price }}&euro;
			</p>
		</div>
	</form>
</x-filament::page>
