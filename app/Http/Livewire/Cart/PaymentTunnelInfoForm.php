<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;

use App\Models\User;

class PaymentTunnelInfoForm extends Component
{
    // Info data
    public $gender;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $duplicate_email_info;
    public $is_over_18;
    public $accepts_conditions;

    public $rules = [
        'gender' => 'nullable|string',
        'first_name' => 'required|string|min:2|max:255',
        'last_name' => 'required|string|min:2|max:255',
        'email' => 'email|required',
        'phone' => 'required|string|min:4|max:20',
        'is_over_18' => "required",
        'accepts_conditions' => "required",
    ];

    public function mount()
    {
        $this->duplicate_email_info = 0;
    }

    public function updatedEmail()
    {
        $this->duplicate_email_info = 0;
    }

    public function validateInfo()
    {
        if (User::where('email', $this->email)->count() == 0 
            || User::where('email', $this->email)->where('role', 'guest_client')->count() == 1) {
            // || (User::where('email', $this->email)->count() > 0 && $this->duplicate_email_info == 1)
            $this->validate();
            
            $info = [];
            if ($this->gender == null) {
                $this->gender = "";
            }
            $info['gender'] = $this->gender;
            $info['first_name'] = $this->first_name;
            $info['last_name'] = $this->last_name;
            $info['email'] = $this->email;
            $info['phone'] = $this->phone;

            $this->email_unchanged = 1;

            $this->emit('infoValidated', $info);

        } else {
            $this->duplicate_email_info = 1;
        }
    }

    public function render()
    {
        return view('livewire.cart.payment-tunnel-info-form');
    }
}
