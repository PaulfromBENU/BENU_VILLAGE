<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

use App\Models\Order;
use App\Models\Shop;

class Orders extends Component
{
    public $show_details;
    public $detailed_order_id;

    public function mount()
    {
        $this->show_details = 0;
        $this->detailed_order_id = 0;
    }

    public function showDetails($order_id)
    {
        $this->show_details = 1;
        if (auth()->user()->role == 'vendor') {
            if (Order::where('payment_type', '>=', '5')->find($order_id)) {
                $this->detailed_order_id = $order_id;
                $this->emit('orderSelected');
            }
        }
        if (auth()->user()->orders()->find($order_id)) {
            $this->detailed_order_id = $order_id;
            $this->emit('orderSelected');
        }
    }

    public function hideDetails()
    {
        $this->detailed_order_id = 0;
        $this->show_details = 0;
    }

    public function render()
    {
        if ($this->detailed_order_id == 0) {
            if (auth()->user()->role == 'vendor') {
                return view('livewire.dashboard.orders', ['orders' => Order::where('payment_type', '>=', '5')->orderBy('created_at', 'desc')->get()]);
            }
            return view('livewire.dashboard.orders', ['orders' => auth()->user()->orders()->where('status', '>', '1')->orderBy('created_at', 'desc')->get()]);
        } else {
            if (auth()->user()->role == 'vendor') {
                return view('livewire.dashboard.orders', [
                    'order' => Order::find($this->detailed_order_id),
                    'benu_address' => Shop::where('filter_key', 'benu-esch')->first(),
                    'articles' => Order::find($this->detailed_order_id)->cart->couture_variations,
                ]);
            } else {
                return view('livewire.dashboard.orders', [
                    'order' => auth()->user()->orders()->find($this->detailed_order_id),
                    'benu_address' => Shop::where('filter_key', 'benu-esch')->first(),
                    'articles' => auth()->user()->orders()->find($this->detailed_order_id)->cart->couture_variations,
                ]);
            }
        }
    }
}
