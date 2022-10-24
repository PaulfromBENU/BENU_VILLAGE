<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;

use Illuminate\Support\Str;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;

use App\Traits\CartAnalyzer;

use Carbon\Carbon;

class PaymentTunnel extends Component
{
    use CartAnalyzer;

    public $cart_id;
    public $user_id;
    public $order_id;
    public $step;
    public $fill_info;
    public $info_valid;
    public $fill_address;
    public $address_valid;
    public $fill_invoice_address;
    public $invoice_address_valid;
    public $country_code;
    public $delivery_chosen;
    public $delivery_method;// 0: collect at shop, 1: home delivery
    public $total_price;
    public $pdf_voucher_only;

    // Info data
    public $order_gender;
    public $order_first_name;
    public $order_last_name;
    public $order_email;
    public $order_phone;

    // Address data
    public $order_address_id;
    public $address_chosen;
    public $delivery_address_chosen;
    public $address_name;

    // Invoice address data
    public $require_invoice_address;
    public $order_invoice_address_id;
    public $invoice_address_chosen;
    public $invoice_address_name;

    // Sell from shop form
    public $inshop_first_name;
    public $inshop_last_name;
    public $inshop_email;
    public $inshop_newsletter;
    public $inshop_security = "";
    public $inshop_payment_type = 'card';

    protected $listeners = ['infoValidated' => 'validateInfoStep', 'newAddressCreated' => 'selectAddress', 'newAddressCancelled' => 'unselectAddress', 'newInvoiceAddressCreated' => 'selectInvoiceAddress', 'newInvoiceAddressCancelled' => 'unselectInvoiceAddress'];

    protected $rules =[
        "inshop_first_name" => "nullable|string|min:2|max:255",
        "inshop_last_name" => "nullable|string|min:2|max:255",
        "inshop_email" => "nullable|email",
        "inshop_newsletter" => "nullable",
        "inshop_security" => "required|string",
    ];

    public function mount()
    {
        $this->info_valid = 0;
        $this->address_valid = 0;
        $this->address_chosen = 0;
        $this->country_code = "LU";
        $this->delivery_chosen = 0;
        $this->delivery_method = 0;
        $this->delivery_address_chosen = 0;
        $this->invoice_address_chosen = 0;

        $this->order_address_id = 0;
        $this->order_invoice_address_id = 0;

        $this->total_price = -100;

        $this->pdf_voucher_only = 0;

        if (auth()->check()) {
            $this->user_id = auth()->user()->id;
            $this->step = 2;
            $this->info_valid = 1;
        } else {
            $this->step = 1;
        }

        $this->fill_info = 0;
        $this->fill_address = 0;
        $this->fill_invoice_address = 0;
        $this->require_invoice_address = 0;

        $this->order_id  = 0;
        if (Cart::where('cart_id', $this->cart_id)->count() > 0) {
            $cart = Cart::where('cart_id', $this->cart_id)->first();
            if ($cart->order()->count() >  0) {
                $this->order_id = $cart->order->id;
            }
            if ($cart->couture_variations()->count() == 1 
                && $cart->couture_variations()->first()->name == 'voucher' 
                && $cart->couture_variations()->first()->voucher_type == 'pdf') {
                $this->delivery_chosen = 1;
                $this->delivery_address_chosen = 1;
                $this->require_invoice_address = 1;
                $this->pdf_voucher_only = 1;
            }
        }

        $this->address_name = "";
        $this->invoice_address_name = "";

        // If order has already been started, use existing data
        if ($this->order_id > 0) {
            $order = Order::find($this->order_id);
            if (auth()->check()) {
                $this->user_id = auth()->user()->id;
                $order->user_id = $this->user_id;
                $order->save();
            } else {
                $this->user_id = $order->user_id;
            }
            $this->info_valid = 1;
            $this->order_first_name = User::find($this->user_id)->first_name;
            $this->order_last_name = User::find($this->user_id)->last_name;
            $this->order_email = User::find($this->user_id)->email;
            if ($order->address_id == 0) {
                $this->delivery_method = 0;
                $this->address_chosen = 0;
            } elseif(!auth()->check() || (auth()->check() && auth()->user()->addresses->contains($order->address->id))) {
                $this->country_code = $order->address->country;
                $this->delivery_address_chosen = 1;
                $this->delivery_method = 1;
                $this->address_valid = 1;
                $this->address_chosen = 1;
                $this->delivery_chosen = 1;
                $this->order_address_id = $order->address_id;
                $this->address_name = $order->address->address_name;
            } else {
                $this->delivery_method = 0;
                $this->address_chosen = 0;
                $order->address_id = 0;
                $order->invoice_address_id = null;
                $order->save();
            }

            if ($order->invoice_address_id !== null && $order->invoice_address_id !== 0) {
                $this->address_valid = 1;
                $this->address_chosen = 1;
                $this->order_invoice_address_id = $order->invoice_address_id;
                $this->delivery_address_chosen = 1;
                $this->invoice_address_chosen = 1;
                $this->invoice_address_name = $order->invoice_address->address_name;
            }
            
            $this->step = 2;
        }
    }

    public function changeStep(int $step)
    {
        if ($step == 1 & $this->step !== 1) {
            if (!auth()->check()) {
                $this->step = $step;
                $this->info_valid = 0;
                $this->emit('goToPaymentStep1');
                // $this->resetOptions();
            }
        }

        if ($step == 2) {
            if ($this->info_valid == 1) {
                $this->step = $step;
                $this->address_valid = 0;
                $this->emit('goToPaymentStep2');
            }
        }

        if ($step == 3) {
            if ($this->info_valid == 1 && $this->address_valid == 1 && $this->delivery_address_chosen && $this->invoice_address_chosen && $this->total_price !== -100) {
                $this->step = $step;
                $this->emit('goToPaymentStep3');
            }
        }
    }

    public function addInfo()
    {
        $this->fill_info = 1;
    }

    public function validateInfoStep($info)
    {
        $this->order_gender = $info['gender'];
        $this->order_first_name = $info['first_name'];
        $this->order_last_name = $info['last_name'];
        $this->order_email = $info['email'];
        $this->order_phone = $info['phone'];

        $this->info_valid = 1;
        $this->step = 2;

        if (Cart::where('cart_id', $this->cart_id)->count() > 0) {
            // Create new user if not auth
            if (!auth()->check()) {
                if (User::where('email', $this->order_email)->count() > 0) {
                    $user = User::where('email', $this->order_email)->first();
                    $user->first_name = $this->order_first_name;
                    $user->last_name = $this->order_last_name;
                    $user->gender = $this->order_gender;
                    $user->phone = $this->order_phone;

                    $user->save();
                    $this->user_id = $user->id;
                } else {
                    // In case of reactivation of deleted email, to be included here
                    // if(User::withTrashed()->where('email', $this->order_email)->count() > 0) {
                        // $user_to_be_restored = User::withTrashed()->where('email', $this->order_email)->first();
                        // $user_to_be_restored->restore();
                        // $user_to_be_restored->role = 'guest_client';
                        // $user_to_be_restored->password = "";
                        // $user_to_be_restored->newsletter = 0;
                        // $user_to_be_restored->origin = "couture";
                        // $user_to_be_restored->save();
                    // }

                    //Client number created randomly  - C#####
                    $client_number = "C".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                    while (User::where('client_number', $client_number)->count() > 0) {
                        $client_number = "C".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                    }

                    $user = User::create([
                        'email' => $this->order_email,
                        'role' => 'guest_client',
                        'first_name' => $this->order_first_name,
                        'last_name' => $this->order_last_name,
                        'gender' => $this->order_gender,
                        'phone' => $this->order_phone,
                        'is_over_18' => '1',
                        'legal_ok' => '1',
                        'newsletter' => '0',
                        'origin' => 'couture',
                        'general_comment' => "",
                        'client_number' => $client_number,
                        'favorite_language' => session('locale'),
                    ]);
                }

                $this->user_id = $user->id;
            } else {
                $this->user_id = auth()->user()->id;
            }

            if (Order::find($this->order_id) && Cart::where('cart_id', $this->cart_id)->first()->order->id == $this->order_id) {
                $new_order = Order::find($this->order_id);
            } else {
                $new_order = new Order();
                $order_number = "T".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                while (Order::where('unique_id', $order_number)->count() > 0) {
                    $order_number = "T".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                }
                $new_order->unique_id = $order_number;
                $new_order->cart_id = Cart::where('cart_id', $this->cart_id)->first()->id;
            }
            $new_order->user_id = $this->user_id;
            $new_order->status = '0';
            $new_order->address_id = $this->order_address_id;
            $new_order->invoice_address_id = $this->order_invoice_address_id;

            if ($new_order->save()) {
                $this->emit('goToPaymentStep2');
                $this->order_id = $new_order->id;
            }
        }
    }

    public function selectDeliveryMethod()
    {
        if (in_array($this->delivery_method, ['0', '1'])) {
            $this->delivery_chosen = 1;
            if ($this->delivery_method == '0') {
                $this->order_address_id = 0;
                $this->delivery_address_chosen = 1;
                $this->emit('addressUpdated', "collect");
                $this->require_invoice_address = 1;
            } else {
                $this->delivery_address_chosen = 0;
                $this->require_invoice_address = 0;
                $this->emit('addressUpdated', "LU");
            }
        }
    }

    public function updateDeliveryMethod()
    {
        $this->delivery_chosen = 0;
        $this->delivery_address_chosen = 0;
        $this->invoice_address_chosen = 0;
        $this->address_chosen = 0;
    }

    public function updateDeliveryAddress()
    {
        $this->delivery_address_chosen = 0;
        $this->invoice_address_chosen = 0;
        $this->address_chosen = 0;
    }

    public function updateInvoiceAddress()
    {
        $this->invoice_address_chosen = 0;
        $this->address_chosen = 0;
    }

    public function addAddress()
    {
        $this->fill_address = 1;
    }

    public function addInvoiceAddress()
    {
        $this->fill_invoice_address = 1;
    }

    public function changeAddress()
    {
        $this->delivery_address_chosen = 0;
        $this->invoice_address_chosen = 0;
        $this->fill_address = 0;
    }

    public function selectAddress($address_id)
    {
        if (Address::find($address_id)) {
            $this->order_address_id = $address_id;
            $this->delivery_address_chosen = 1;
            $this->fill_address = 0;
            $this->country_code = Address::find($address_id)->country;
            $this->emit('addressUpdated', $this->country_code);
        }
    }

    public function useDeliveryAddressForInvoice()
    {
        $this->order_invoice_address_id = $this->order_address_id;
        $this->delivery_address_chosen = 1;
        $this->invoice_address_chosen = 1;
        $this->fill_address = 0;
        $this->address_chosen = 1;
    }

    public function selectNewAddressForInvoice()
    {
        $this->require_invoice_address = 1;
    }

    public function changeInvoiceAddress()
    {
        $this->invoice_address_chosen = 0;
        $this->fill_invoice_address = 0;
    }

    public function selectInvoiceAddress($address_id)
    {
        if (Address::find($address_id)) {
            $this->order_invoice_address_id = $address_id;
            $this->invoice_address_chosen = 1;
            $this->fill_invoice_address = 0;
            $this->address_chosen = 1;
        }
    }

    public function unselectAddress()
    {
        $this->address_chosen = 0;
        $this->fill_address = 0;
    }

    public function unselectInvoiceAddress()
    {
        $this->address_chosen = 0;
        $this->fill_invoice_address = 0;
        $this->fill_address = 0;
    }

    public function validateDeliveryStep()
    {
        if ($this->order_address_id == 0 && Address::find($this->order_invoice_address_id)) {
            $this->country_code = 'collect';
            $this->emit('addressUpdated', $this->country_code);
            $this->address_valid = 1;
            $this->step = 3;
            // $this->emit('goToPaymentStep3');
        } elseif (Address::find($this->order_address_id) && Address::find($this->order_invoice_address_id)) {
            $country = Address::find($this->order_address_id)->country;
            if (strtolower($country) == 'france') {
                $this->country_code = "FR";
            } elseif (strtolower($country) == "luxembourg") {
                $this->country_code = "LU";
            } else {
                $this->country_code = $country;
            }
            $this->emit('addressUpdated', $this->country_code);
            $this->address_valid = 1;
            // $this->emit('goToPaymentStep3');
            $this->step = 3;
            $this->address_name = Address::find($this->order_address_id)->address_name;
        } else {
            $this->address_valid = 0;
        }

        if($this->address_valid == 1) {
            if (Order::find($this->order_id) && Cart::where('cart_id', $this->cart_id)->first()->order->id == $this->order_id) {
                $new_order = Order::find($this->order_id);
            } else {
                $new_order = new Order();
                $order_number = "T".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                while (Order::where('unique_id', $order_number)->count() > 0) {
                    $order_number = "T".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                }
                $new_order->unique_id = $order_number;
                $new_order->cart_id = Cart::where('cart_id', $this->cart_id)->first()->id;
                $new_order->user_id = $this->user_id;
            }
            $new_order->status = '0';
            $new_order->address_id = $this->order_address_id;
            $new_order->invoice_address_id = $this->order_invoice_address_id;

            if ($new_order->save()) {
                $this->emit('goToPaymentStep3');
                if (session('has_kulturpass' !== null)) {
                    $this->total_price = round($this->computeTotal($this->cart_id, $this->country_code) / 2, 2);
                } else {
                    $this->total_price = $this->computeTotal($this->cart_id, $this->country_code);
                }
                $this->order_id = $new_order->id;
            }
        }
    }

    public function resetOptions()
    {
        // $this->fill_info = 0;
    }

    public function validateOrder($payment_type)
    {
        if (Cart::where('cart_id', $this->cart_id)->count() > 0) {
            // Create new user if not auth and does not already exists
            $cart = Cart::where('cart_id', $this->cart_id)->first();
            if ($cart->order()->count() == 0 || $cart->order->user_id == null) {
                if (!auth()->check()) {
                    if (User::where('email', $this->order_email)->count() > 0) {
                        $user = User::where('email', $this->order_email)->first();
                        $user->first_name = $this->order_first_name;
                        $user->last_name = $this->order_last_name;
                        $user->gender = $this->order_gender;
                        $user->phone = $this->order_phone;

                        $user->save();
                    } else {
                        $user_exists = 0;
                        // Case user already existed, and was soft deleted
                        if ($this->order_email !== "" && User::withTrashed()->where('email', $this->order_email)->count() > 0) {
                            $user_exists = 1;
                        }

                        //Client number created randomly  - C#####
                        $client_number = "C".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                        while (User::withTrashed()->where('client_number', $client_number)->count() > 0) {
                            $client_number = "C".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                        }

                        if (!$user_exists) {
                            //Create user in any case, even if no address has been added
                            $user = User::create([
                                'email' => $this->order_email,
                                'role' => 'guest_client',
                                'first_name' => $this->order_first_name,
                                'last_name' => $this->order_last_name,
                                'gender' => $this->order_gender,
                                'phone' => $this->order_phone,
                                'is_over_18' => '1',
                                'legal_ok' => '1',
                                'newsletter' => '0',
                                'origin' => 'couture',
                                'general_comment' => "",
                                'client_number' => $client_number,
                            ]);
                        } else {
                            $user = User::withTrashed()->where('email', $request->email)->first();
                            $user->restore();
                            $user->update([
                                'email' => $this->order_email,
                                'password' => null,
                                'role' => 'guest_client',
                                'first_name' => $this->order_first_name,
                                'last_name' => $this->order_last_name,
                                'gender' => $this->order_gender,
                                'phone' => $this->order_phone,
                                'origin' => 'couture',
                            ]);
                        }
                    }

                    $this->user_id = $user->id;
                } else {
                    $this->user_id = auth()->user()->id;
                }
            }

            if (Order::find($this->order_id) && Cart::where('cart_id', $this->cart_id)->first()->order->id == $this->order_id) {
                $new_order = Order::find($this->order_id);
            } else {
                $new_order = new Order();
                $order_number = "T".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                while (Order::where('unique_id', $order_number)->count() > 0) {
                    $order_number = "T".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                }
                $new_order->unique_id = $order_number;
                $new_order->cart_id = Cart::where('cart_id', $this->cart_id)->first()->id;
                $new_order->user_id = $this->user_id;
                $new_order->address_id = $this->order_address_id;
                $new_order->invoice_address_id = $this->order_invoice_address_id;
            }
            $new_order->total_price = $this->total_price;
            $new_order->status = '0';

            switch ($payment_type) {
                case 'card':
                    $new_order->payment_type = 0;
                    break;

                case 'paypal':
                    $new_order->payment_type = 1;
                    break;

                case 'payconiq':
                    $new_order->payment_type = 2;
                    break;

                case 'transfer':
                    $new_order->payment_type = 3;
                    break;

                case 'voucher':
                    $new_order->payment_type = 4;
                    break;
                
                default:
                    $new_order->payment_type = 3;
                    break;
            }

            if (session('has_kulturpass') !== null) {
                $new_order->with_kulturpass = 1;
            }

            if ($new_order->save()) {
                switch ($payment_type) {
                    case 'card':
                        return redirect()->route('payment-request-'.app()->getLocale(), ['order' => strtolower($new_order->unique_id).Str::random(12)]);
                        break;

                    case 'paypal':
                        return redirect()->route('payment-request-paypal-'.app()->getLocale(), ['order' => strtolower($new_order->unique_id).Str::random(12)]);
                        break;

                    case 'payconiq':
                        return redirect()->route('payment-validate-'.app()->getLocale(), ['order' => strtolower($new_order->unique_id).Str::random(12)]);
                        break;

                    case 'transfer':
                        return redirect()->route('payment-validate-'.app()->getLocale(), ['order' => strtolower($new_order->unique_id).Str::random(12)]);
                        break;

                    case 'voucher':
                        return redirect()->route('payment-validate-'.app()->getLocale(), ['order' => strtolower($new_order->unique_id).Str::random(12)]);
                        break;
                    
                    default:
                        dd('Logic not developed for this payment method.');
                        break;
                }
            }
        }
    }

    public function sellFromShop()
    {
        $this->validate();
        if ($this->inshop_security == "letzbenew") {
            if (Cart::where('cart_id', $this->cart_id)->count() > 0) {
                // Create new user if not auth and does not already exists
                $cart = Cart::where('cart_id', $this->cart_id)->first();
                $add_newsletter = 0;
                if ($this->inshop_newsletter !== null && $this->inshop_newsletter == 1) {
                    $add_newsletter = 1;
                }
                if ($cart->order()->count() == 0 || $cart->order->user_id == null) {
                    if (User::where('email', $this->inshop_email)->count() > 0) {
                        $user = User::where('email', $this->inshop_email)->first();
                        $user->first_name = $this->inshop_first_name;
                        $user->last_name = $this->inshop_last_name;
                        $user->newsletter = $add_newsletter;

                        $user->save();

                        $this->user_id = $user->id;

                    } elseif ($this->inshop_email !== null && $this->inshop_first_name !== null && $this->inshop_last_name !== null) {
                        $user_exists = 0;
                        // Case user already existed, and was soft deleted
                        if ($this->inshop_email !== "" && User::withTrashed()->where('email', $this->inshop_email)->count() > 0) {
                            $user_exists = 1;
                        }

                        //Client number created randomly  - C#####
                        $client_number = "C".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                        while (User::withTrashed()->where('client_number', $client_number)->count() > 0) {
                            $client_number = "C".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                        }

                        if (!$user_exists) {
                            //Create user in any case, even if no address has been added
                            $user = User::create([
                                'email' => $this->inshop_email,
                                'role' => 'guest_client',
                                'first_name' => $this->inshop_first_name,
                                'last_name' => $this->inshop_last_name,
                                'gender' => null,
                                'phone' => null,
                                'is_over_18' => '1',
                                'legal_ok' => '1',
                                'newsletter' => $add_newsletter,
                                'origin' => 'couture',
                                'general_comment' => "",
                                'favorite_language' => strtolower(session('locale')),
                                'client_number' => $client_number,
                            ]);
                        } else {
                            $user = User::withTrashed()->where('email', $request->email)->first();
                            $user->restore();
                            $user->update([
                                'email' => $this->order_email,
                                'password' => null,
                                'role' => 'guest_client',
                                'first_name' => $this->inshop_first_name,
                                'last_name' => $this->inshop_last_name,
                                'newsletter' => $add_newsletter,
                                'origin' => 'couture',
                            ]);
                        }

                        $this->user_id = $user->id;

                    } else {
                        $this->user_id = 0;
                    }
                }

                if (Order::find($this->order_id) && Cart::where('cart_id', $this->cart_id)->first()->order->id == $this->order_id) {
                    $new_order = Order::find($this->order_id);
                } else {
                    $new_order = new Order();
                    $order_number = "T".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                    while (Order::where('unique_id', $order_number)->count() > 0) {
                        $order_number = "T".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                    }
                    $new_order->unique_id = $order_number;
                    $new_order->cart_id = Cart::where('cart_id', $this->cart_id)->first()->id;
                    $new_order->user_id = $this->user_id;
                    $new_order->address_id = $this->order_address_id;
                    $new_order->invoice_address_id = 0;
                }
                if(auth()->check()) {
                    $new_order->seller = auth()->user()->email;
                }

                $new_order->payment_type = 5;
                if ($this->inshop_payment_type == 'card') {
                    $new_order->payment_type = 5;
                } elseif ($this->inshop_payment_type == 'cash') {
                    $new_order->payment_type = 6;
                } elseif ($this->inshop_payment_type == 'payconiq') {
                    $new_order->payment_type = 7;
                }

                $new_order->status = 5;
                $new_order->payment_status = 2;
                $new_order->delivery_status = 10;
                $new_order->delivery_date = date("Y-m-d");
                $new_order->transaction_date = Carbon::now()->toDateTimeString();

                if (session('has_kulturpass') !== null) {
                    $new_order->with_kulturpass = 1;
                }
                $this->total_price = $this->computeTotal($this->cart_id, 'collect');

                $new_order->total_price = $this->total_price;

                if ($new_order->save()) {
                    $new_cart = $new_order->cart;
                    $new_cart->status = 3;
                    $new_cart->is_active = 0;
                    $new_cart->save();
                    return redirect()->route('payment-validate-'.app()->getLocale(), ['order' => strtolower($new_order->unique_id).Str::random(12)]);
                }
            }
        }
    }

    public function render()
    {
        if (Address::find($this->order_address_id)) {
            if (Address::find($this->order_invoice_address_id)) {
                return view('livewire.cart.payment-tunnel', [
                    'delivery_address' => Address::find($this->order_address_id),
                    'invoice_address' => Address::find($this->order_invoice_address_id),
                ]);
            } else {
                return view('livewire.cart.payment-tunnel', [
                    'delivery_address' => Address::find($this->order_address_id),
                    'invoice_address' => collect([]),
                ]);
            }
        } elseif ($this->order_address_id == 0 && Address::find($this->order_invoice_address_id)) {
            return view('livewire.cart.payment-tunnel', [
                'delivery_address' => collect([]),
                'invoice_address' => Address::find($this->order_invoice_address_id),
            ]);
        }

        return view('livewire.cart.payment-tunnel', [
            'delivery_address' => collect([]),
            'invoice_address' => collect([]),
        ]);
    }
}
