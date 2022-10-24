<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

use App\Models\Address;

class Addresses extends Component
{
    public $delete_check;

    protected $listeners = ['addressDeleted' => 'render'];

    public function mount()
    {
        foreach (auth()->user()->addresses as $address) {
            $this->delete_check[$address->id] = 0;
        }
    }

    public function showAddressModal($address_id = '')
    {
        $this->emit('displayModal', $address_id);
    }

    public function getConfirmation(int $address_id, int $value)
    {
        $this->delete_check[$address_id] = $value;
    }

    public function deleteAddress(int $address_id)
    {
        if (auth()->user()->addresses->contains($address_id)) {
            $deleted_address = Address::where('id', $address_id)->first();
            $deleted_address->is_active = 0;
            $deleted_address->save();
            $this->delete_check[$address_id] = 0;
            $this->emit('addressDeleted');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.addresses', [
            'user_addresses' => auth()->user()->addresses()->where('is_active', '1')->get(),
        ]);
    }
}
