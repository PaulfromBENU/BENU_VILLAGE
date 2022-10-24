@if(isset($delivery_address->address_name))
    <div class="payment-tunnel__delivery__address__name">
        {{ $delivery_address->address_name }}
    </div>
    <h5>
        {{ $delivery_address->first_name }} {{ $delivery_address->last_name }}
    </h5>
    <p>
        {{ $delivery_address->street_number }}, {{ $delivery_address->street }}
    </p>
    @if(isset($delivery_address->floor))
        <p>
            {{ $delivery_address->floor }}
        </p>
    @endif
    <p>
        {{ $delivery_address->zip_code }} {{ $delivery_address->city }}
    </p>
    <p>
        {{ $delivery_address->phone }}
    </p>
    @if(isset($delivery_address->other_infos))
        <p>
            {{ __('cart.payment-delivery-more-info') }}&nbsp;: {{ $delivery_address->other_infos }}
        </p>
    @endif
@endif