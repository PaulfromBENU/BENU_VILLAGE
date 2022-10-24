<?php

namespace App\Http\Livewire\Services;

use Livewire\Component;

use App\Models\Order;

class ReturnFormCheck extends Component
{

    public $is_checked = 0;
    public $order_id = "";
    public $email;
    public $message = "";

    protected $rules = [
        'order_id' => 'string|min:6|max:6|required',
        'email' => 'email|required'
    ];

    public function mount()
    {
        $this->email = "";
        if (auth()->check()) {
            $this->email = auth()->user()->email;
        }
    }

    public function checkInputs()
    {
        $this->validate();

        if (Order::where('unique_id', $this->order_id)->count() > 0) {
            $order = Order::where('unique_id', $this->order_id)->first();
            if ($order->user->email == $this->email) {
                $this->is_checked = 1;
                $this->message = "";
            } else {
                $this->is_checked = 0;
                $this->message = __('services.order-not-found');
            }
        } else {
            $this->is_checked = 0;
            $this->message = __('services.order-not-found');
        }
    }

    public function render()
    {
        return view('livewire.services.return-form-check');
    }
}
