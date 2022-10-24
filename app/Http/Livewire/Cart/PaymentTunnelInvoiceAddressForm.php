<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;

use App\Models\Address;
use App\Models\DeliveryCountry;

class PaymentTunnelInvoiceAddressForm extends Component
{
    public $country_options;
    public $nearby_countries;
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
    public $address_country;
    public $address_phone;
    public $address_other;

    protected function rules()
    {
        return [
            'address_name' => ['required', 'string', 'max:150'],
            'address_first_name' => ['required', 'string', 'max:255'],
            'address_last_name' => ['required', 'string', 'max:255'],
            'address_street_number' => ['required', 'integer'],
            'address_street' => ['required', 'string', 'max:255'],
            'address_floor' => ['nullable', 'string', 'max:255'],
            'address_city' => ['required', 'string', 'max:150'],
            'address_zip' => ['required', 'string', 'max:10'],
            'address_phone' => ['required', 'string', 'max:30'],
            'address_country' => ['required', 'string', 'max:2'],
            'address_other' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function mount()
    {
        // $this->country_options = DeliveryCountry::all();
        $this->localized_country = "country_".app()->getLocale();
        $this->nearby_countries = DeliveryCountry::where('country_code', 'DE')
                                            ->orWhere('country_code', 'BE')
                                            ->orWhere('country_code', 'FR')
                                            ->orWhere('country_code', 'LU')
                                            ->get();
        $this->country_options = DeliveryCountry::where('country_code', '<>', 'DE')
                                            ->where('country_code', '<>', 'BE')
                                            ->where('country_code', '<>', 'FR')
                                            ->where('country_code', '<>', 'LU')
                                            ->orderBy($this->localized_country, 'asc')
                                            ->get();
        $this->address_country  = "LU";
    }

    public function createNewAddress()
    {
        $this->validate();

        $address = new Address();
        if (auth()->check()) {
            $address->user_id = auth()->user()->id;
        }
        $address->address_name = $this->address_name;
        $address->first_name = $this->address_first_name;
        $address->last_name = $this->address_last_name;
        $address->street_number = $this->address_street_number;
        $address->street = $this->address_street;
        if (isset($this->address_floor)) {
            $address->floor = $this->address_floor;
        } else {
            $address->floor = "";
        }
        $address->zip_code = $this->address_zip;
        $address->city = $this->address_city;
        $address->country = $this->address_country;
        $address->phone = $this->address_phone;
        if (isset($this->address_other)) {
            $address->other_infos = $this->address_other;
        }

        if ($address->save()) {
            $this->address_id = $address->id;
            $this->emit('newInvoiceAddressCreated', $this->address_id);
        }
    }

    public function cancelForm()
    {
        $address_id = 0;
        $address_name = "";
        $address_first_name = "";
        $address_last_name = "";
        $address_street_number = "";
        $address_street = "";
        $address_floor = "";
        $address_zip = "";
        $address_city = "";
        $address_country = "";
        $address_phone = "";
        $address_other = "";

        $this->emit('newInvoiceAddressCancelled');
    }

    public function render()
    {
        return view('livewire.cart.payment-tunnel-invoice-address-form');
    }
}
