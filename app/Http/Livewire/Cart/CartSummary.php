<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;

use Illuminate\Support\Facades\Route;

use App\Models\Cart;
use App\Models\DeliveryCountry;
use App\Models\Voucher;

use App\Traits\CartAnalyzer;
use App\Traits\DeliveryCalculator;

class CartSummary extends Component
{
    use CartAnalyzer;
    use DeliveryCalculator;

    public $in_tunnel;

    public $cart_id;
    public $articles_sum;
    public $delivery_sum;
    public $gift_sum;
    public $with_extra;
    public $country_code;
    public $total;

    public $use_voucher;
    public $voucher_code;
    public $voucher_verified;
    public $voucher_current_value;
    public $voucher_remaining_value;
    public $voucher_status;

    public $show_payment_btn;
    public $conditions_validated;

    const GIFT_WRAP_PRICE = 5;
    const GIFT_CARD_PRICE = 3;
    const EXTRA_PILLOW_PRICE = 10;

    protected $listeners = ['cartSumUpdated' => 'computeAll', 'giftUpdated' => 'computeAll', 'addressUpdated' => 'updateDeliveryCode'];

    public function mount()
    {
        if (Route::currentRouteName() == 'payment-'.app()->getLocale()) {
            $this->conditions_validated = 1;
            $this->show_payment_btn = 0;
            $this->in_tunnel = 1;
        } else {
            if (auth()->check() && auth()->user()->last_conditions_agreed || !auth()->check()) {
                $this->show_payment_btn = 1;
                $this->conditions_validated = 1;
            } else {
                $this->show_payment_btn = 0;
                $this->conditions_validated = 0;
            }
            $this->in_tunnel = 0;
        }

        $this->with_extra = 0;

        $this->country_code = "LU";
        if (auth()->check() && auth()->user()->role == 'vendor') {
            $this->country_code = "collect";
        }

        $this->use_voucher = 0;
        $this->voucher_code = "";
        $this->voucher_verified = 0;
        $this->voucher_remaining_value = 0;
        $this->voucher_status = 0;

        if (Cart::where('cart_id', $this->cart_id)->count() > 0) {
            $cart = Cart::where('cart_id', $this->cart_id)->first();

            if ($cart->use_voucher == 1) {
                $this->use_voucher = 1;
            }

            if ($cart->use_voucher == 1 && Voucher::where('unique_code', $cart->voucher_code)->count() > 0) {
                $this->voucher_code = $cart->voucher_code;
                $this->voucher_current_value = Voucher::where('unique_code', $cart->voucher_code)->first()->remaining_value;
                $this->voucher_verified = 1;
            }
        }

        $this->computeAll();
    }

    public function updatedVoucherCode()
    {
        $this->voucher_verified = 0;
        $this->voucher_current_value = 0;
        $this->voucher_remaining_value = 0;
        $this->voucher_status = 0;

        $this->computeAll();
    }

    public function updatedUseVoucher()
    {
        $cart = Cart::where('cart_id', $this->cart_id)->first();
        if ($this->use_voucher == true) {
            $cart->use_voucher = 1;
        } else {
            $cart->use_voucher = 0;
            $cart->voucher_code = "";
            $this->voucher_code = "";
            $this->voucher_verified = 0;
            $this->voucher_current_value = 0;
            $this->voucher_remaining_value = 0;
        }

        if($cart->save()) {
            $this->computeAll();
        }
    }

    public function checkVoucher()
    {
        if (Voucher::where('unique_code', $this->voucher_code)->count() > 0) {
            $cart = Cart::where('cart_id', $this->cart_id)->first();
            $cart->voucher_code = $this->voucher_code;

            if($cart->save()) {
                $this->voucher_verified = 1;
                $this->voucher_status = 0;
                if ($this->voucher_verified && $this->voucher_code !== "") {
                    $this->voucher_current_value = Voucher::where('unique_code', $this->voucher_code)->first()->remaining_value;
                }
            }
        } else {
            $this->voucher_current_value = 0;
            $this->voucher_verified = 0;
            $this->voucher_code = "";
            $this->voucher_status = 1;
        }

        $this->computeAll();
    }

    public function updateDeliveryCode($country_code)
    {
        if ($country_code == 'collect' || DeliveryCountry::where('country_code', $country_code)->count() > 0) {
            $this->country_code = $country_code;
            $this->computeAll();
        }
    }

    public function computeAll()
    {
        $this->articles_sum = $this->computeArticlesSum($this->cart_id);
        $this->with_extra = $this->computeExtraSum($this->cart_id);
        $this->delivery_sum = $this->computeDeliverySum($this->cart_id, $this->country_code);
        if (Cart::where('cart_id', $this->cart_id)->count() > 0) {
            $cart = Cart::where('cart_id', $this->cart_id)->first();
            if ($cart->couture_variations()->count() == 1 && $cart->couture_variations()->first()->name == 'voucher' && $cart->couture_variations()->first()->voucher_type == 'pdf') {
                $this->delivery_sum = 0;
            }
        }
        $this->gift_sum = $this->computeGiftSum($this->cart_id);
        $this->computeTotalWithVoucher();
    }


    public function computeTotalWithVoucher()
    {
        $this->total = $this->articles_sum + $this->with_extra + $this->delivery_sum + $this->gift_sum;

        $cart = Cart::where('cart_id', $this->cart_id)->first();
        $cart->price_before_voucher = $this->total;
        $cart->save();

        if ($this->total > $this->voucher_current_value) {
            $this->total -= $this->voucher_current_value;
            $this->voucher_remaining_value = 0;
        } else {
            $this->voucher_remaining_value = $this->voucher_current_value - $this->total;
            $this->total = 0;
        }
    }

    public function acceptConditions()
    {
        if ($this->conditions_validated) {
            $this->show_payment_btn = 1;
        } else {
            $this->show_payment_btn = 0;
        }
    }

    public function goToPaymentTunnel()
    {
        if (auth()->check() && !auth()->user()->last_conditions_agreed) {
            if ($this->conditions_validated) {
                auth()->user()->last_conditions_agreed = 1;
                auth()->user()->save();
                return redirect()->route('payment-'.app()->getLocale());
            }
        } else {
            return redirect()->route('payment-'.app()->getLocale());
        }
    }

    public function render()
    {
        return view('livewire.cart.cart-summary');
    }
}
