<div class="dashboard-addresses w-full">
    <h2>
        {!! __('dashboard.my-addresses') !!}
    </h2>
    <p class="dashboard-addresses__new-address-btn" wire:click="showAddressModal">
        + {!! __('dashboard.create-new-address') !!}
    </p>
    @if($user_addresses->count() > 0)
    <div class="flex justify-start flex-wrap">
        @foreach($user_addresses as $address)
            <div wire:key="{{ $address->id }}" class="dashboard-addresses__address">
                <div class="flex justify-between flex-col-reverse lg:flex-row">
                    <div class="w-full lg:w-7/12">
                        <h4>{{ $address->first_name.' '.$address->last_name }}</h4>
                        <p>
                            {{ $address->street_number }} {{ $address->street }}
                        </p>
                        @if($address->floor !== null && $address->floor !== "")
                        <p>
                            {{ __('dashboard.address-complement') }} : {{ $address->floor }}
                        </p>
                        @endif
                        <p>
                            {{ $address->zip_code }} {{ $address->city }}, {{ $address->country }}
                        </p>
                        <p>
                            {{ $address->phone }}
                        </p>
                        @if($address->other_infos !== null && $address->other_infos !== "")
                        <p class="mt-5">
                            <strong>{!! __('dashboard.remark') !!} : </strong> {{ $address->other_infos }}
                        </p>
                        @endif
                        <div class="flex justify-start flex-wrap mt-5">
                            <div class="mr-5">
                                <button class="btn-slider-left" wire:click="showAddressModal({{ $address->id }})">{!! __('dashboard.edit-address') !!}</button>
                            </div>
                            <div class="mr-5">
                                @if($delete_check[$address->id] == "0")
                                    <button class="btn-slider-left" wire:click="getConfirmation({{ $address->id }}, 1)">{!! __('dashboard.delete-address') !!}</button>
                                @else
                                    {!! __('dashboard.confirm-address-delete') !!} ?<br/>
                                    <div class="flex justify-between flex-wrap">
                                        <button class="btn-slider-left mr-5" wire:click="deleteAddress({{ $address->id }})">{!! __('dashboard.confirm-address-delete-yes') !!}</button> 
                                        <button class="btn-slider-left" wire:click="getConfirmation({{ $address->id }}, 0)">{!! __('dashboard.confirm-address-delete-no') !!}</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-5/12 relative">
                        <div class="dashboard-addresses__address__name text-center">
                            {{ $address->address_name }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
        <p class="mt-5"><em>{!! __('dashboard.no-address-for-the-moment') !!}</em></p>
    @endif
</div>