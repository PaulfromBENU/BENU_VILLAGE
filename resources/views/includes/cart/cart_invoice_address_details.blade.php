<div class="payment-tunnel__delivery__address__name">
    {{ $invoice_address->address_name }}
</div>
<h5>
    {{ $invoice_address->first_name }} {{ $invoice_address->last_name }}
</h5>
<p>
    {{ $invoice_address->street_number }}, {{ $invoice_address->street }}
</p>
@if(isset($invoice_address->floor))
    <p>
        {{ $invoice_address->floor }}
    </p>
@endif
<p>
    {{ $invoice_address->zip_code }} {{ $invoice_address->city }}
</p>
<p>
    {{ $invoice_address->phone }}
</p>
@if(isset($invoice_address->other_infos))
    <p>
        {{ __('cart.payment-delivery-more-info') }}&nbsp;: {{ $invoice_address->other_infos }}
    </p>
@endif