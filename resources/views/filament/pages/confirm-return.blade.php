<x-filament::page>
	<form method="POST" wire:submit.prevent="confirmReturn" class="stock-handling">
		@csrf

		<h2>Select an order number to confirm good reception of the return to the client.</h2>
		<p style="margin-bottom: 40px;">
			If the order cannot be found in the list below, it means the return delay of 28 days has expired. When confirmed, the client will be able to see BENU's confirmation and message in his/her BENU dashboard.
		</p>

		<div class="stock-handling__input-group">
				<label for="creation-0">Select an order</label><br/>
				<select name="creation-0" id="creation-0" class="stock-handling__select" wire:model="order_unique_id">
					<option value="none-0" >Select an order</option>
					@foreach($orders as $order)
						<option value="{{ $order->unique_id }}" wire:key="order-options-{{ $order->id }}">{{ $order->unique_id }}</option>
					@endforeach
				</select> 

				<p style="margin-bottom: 30px;">
					User language if known: {{ $locale }}
				</p>

				<textarea rows="4" placeholder="Your message for the client here..." style="background: transparent; width: 100%;" wire:model.defer="message"></textarea>
		</div>

		<div class="text-center">
			<button type="submit">Confirm return reception</button>
		</div>
	</form>
</x-filament::page>
