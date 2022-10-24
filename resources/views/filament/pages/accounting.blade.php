<x-filament::page>
	<h2 class="accounting-invoices__title">
		Invoices
	</h2>
	<div class="accounting-invoices">
		<form wire:submit.prevent="displayInvoices" class="flex justify-between">
			<div class="flex justify-start flex-wrap">
			    <div class="accounting-invoices__input-group">
			    	<label>
			    		Invoice start date (dd/mm/yyyy):
			    	</label>
			    	<br/>
			    	<input type="date" name="invoices_start" wire:model="invoices_start">
			    </div>

			    <div class="accounting-invoices__input-group">
			    	<label>
			    		Invoice end date (dd/mm/yyyy):
			    	</label>
			    	<br/>
			    	<input type="date" name="invoices_end" wire:model="invoices_end">
			    </div>
			</div>
		 
		 	<div class="flex flex-col justify-center">
			    <button type="submit">
			        Get invoices
			    </button>
			</div>
		</form>
		@if($invoices->count() > 0)
			<h3>
				All orders - click to display and download invoice
			</h3>
			@foreach($invoices as $invoice)
				<a target="_blank" href="{{ route('invoice-download-en', ['order_code' => \Illuminate\Support\Str::random(4).$invoice->unique_id.\Illuminate\Support\Str::random(12)]) }}" class="accounting-invoices__invoice">
					{{ $invoice->unique_id }} - Paid on {{ Carbon\Carbon::parse($invoice->transaction_date)->format('d\/m\/Y') }} - Total {{ $invoice->total_price }}&euro;
				</a>
			@endforeach
		@endif
	</div>

	<h2 class="accounting-csv__title">
		Full orders export in CSV
	</h2>
	<div class="accounting-csv">
		@for($year = 2022; $year <= date('Y'); $year ++)
			@for($month = 1; $month <= 12; $month ++)
				@if(!($year == date('Y') && $month > date('m')))
				<p>
					<a href="{{ route('export-invoice-csv-en', ['year' => $year, 'month' => $month]) }}">Download full export <strong>{{ str_pad($month, 2, '0', STR_PAD_LEFT).'/'.$year }}</strong></a>
				</p>
				@endif
			@endfor
		@endfor
	</div>
</x-filament::page>
