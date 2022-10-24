<x-filament::page>
	<div class="use-voucher__code-selection">
		<select wire:model="code">
			<option value="0" wire:click="selectCode">Select a code</option>
			@foreach($all_codes as $one_code => $value)
				<option value="{{ $one_code }}" wire:click="selectCode" wire:key="{{ $one_code }}">
					{{ $one_code }} - {{ $value }}&euro;
				</option>
			@endforeach
		</select>
	</div>

	@if($code_selected != '0')
		<div class="flex justify-start">
			<p class="use-voucher__info">
				Initial value: {{ $voucher_init_value }}&euro;
			</p>
			@if($user_id != "")
			<p class="use-voucher__info">
				User: {{ $user_first_name }} {{ $user_last_name }}
			</p>
			@endif
		</div>

		<form method="POST" wire:submit.prevent="confirmVoucherUse" class="use-voucher" onkeydown="return event.key != 'Enter';">
			@csrf
			<div class="flex justify-start">
				<p class="use-voucher__info" style="padding-top: 5px;">Total amount to pay by the client before using the voucher:</p>
				<div class="relative">
					<input type="text" name="total_to_pay" wire:model.lazy="total_to_pay" wire:change="updateVoucherValue" maxlength="20" style="margin-bottom: 0;" required>
					<p class="absolute use-voucher__euro-symbol">&euro;</p>
					<div class="use-voucher__validate-price" wire:click="updateVoucherValue">
						>
					</div>
				</div>
			</div>

			<h4>
				After voucher use
			</h4>

			<div class="flex justify-center flex-wrap use-voucher__status">
				<p class="use-voucher__info-status">
					Remaining value on voucher: <span style="color: rgb(234 179 8);"><strong>{{ number_format((float)$remaining_value, 2, '.', '') }}&euro;</strong></span>
				</p>
				<p class="use-voucher__info-status">
					Still due by the client: <span style="color: rgb(234 179 8);"><strong>{{ number_format((float)$yet_to_pay, 2, '.', '') }}&euro;</strong></span>
				</p>
			</div>

			@if($voucher_used == '1')
			<div class="text-center text-xl" style="color: rgb(234 179 8); padding-top: 10px;">
				Voucher updated! New voucher value: {{ $remaining_value }}&euro;
			</div>
			@elseif($total_to_pay > 0)
			<div class="text-center" style="margin-top: 30px;">
				<button type="submit">Confirm voucher use</button>
			</div>
			<div class="text-center">
				<em>(Confirm after payment of the due amount by the client)</em>
			</div>
			@endif
		</form>
	@endif
</x-filament::page>
