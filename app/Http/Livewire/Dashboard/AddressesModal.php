<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

use App\Models\Address;
use App\Models\DeliveryCountry;

class AddressesModal extends Component
{
    public $country_options;
    public $localized_country;
    public $address_id;
    public $address_name;
    public $address_first_name;
    public $address_last_name;
    public $address_street_number;
    public $address_street;
    public $address_floor;
    public $address_zip;
    public $address_city;
    public $address_phone;
    public $address_country;
    public $address_other;

    public $is_update;

    protected $listeners = ['displayModal' => 'showAddressModal'];

    public function mount()
    {
        $this->resetAddress();
        $this->country_options = DeliveryCountry::all();
        $this->localized_country = "country_".app()->getLocale();
    }

    public function resetAddress()
    {
        $this->is_update = 0;
        $this->address_id = 0;
        $this->address_name = '';
        $this->address_first_name = '';
        $this->address_last_name = '';
        $this->address_street_number = '';
        $this->address_street = '';
        $this->address_floor = '';
        $this->address_zip = '';
        $this->address_city = '';
        $this->address_phone = '';
        $this->address_country = '';
        $this->address_other = '';
    }

    public function closeModal()
    {
        // dd($this->pivot);
        $this->emit('closeModal');
    }

    public function showAddressModal($address_id = '')
    {
        if (is_int($address_id)) {
            if (Address::find($address_id) && auth()->user()->addresses->contains($address_id)) {
                $this->is_update = 1;
                $this->address_id = $address_id;
                $updated_address = Address::find($address_id);
                $this->address_name = $updated_address->address_name;
                $this->address_first_name = $updated_address->first_name;
                $this->address_last_name = $updated_address->last_name;
                $this->address_street_number = $updated_address->street_number;
                $this->address_street = $updated_address->street;
                $this->address_floor = $updated_address->floor;
                $this->address_zip = $updated_address->zip_code;
                $this->address_city = $updated_address->city;
                $this->address_phone = $updated_address->phone;
                $this->address_country = $updated_address->country;
                $this->address_other = $updated_address->other_infos;
            }
        }  else {
            $this->resetAddress();
        }
        $this->emit('showAddressModal');
    }

    public function render()
    {
        return view('livewire.dashboard.addresses-modal');
    }
}
