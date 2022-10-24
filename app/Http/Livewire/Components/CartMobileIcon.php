<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

use App\Models\Cart;

class CartMobileIcon extends Component
{
    public $counter;
    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        if (session('cart_id') !== null && Cart::where('cart_id', session('cart_id'))->count() > 0) {
            $cart = Cart::where('cart_id', session('cart_id'))->first();
            $this->counter = $cart->couture_variations->count();
            // Fill with counts from other activities in the future
        } else {
            $this->counter = 0;
        }
    }
    
    public function render()
    {
        return view('livewire.components.cart-mobile-icon');
    }
}
