<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

use App\Models\Article;
use App\Models\Cart;
use App\Models\DeliveryCountry;
use App\Models\Order;
use App\Models\Voucher;
use App\Mail\VoucherPdf;

use App\Jobs\SendNewOrderEmails;

use Illuminate\Support\Str;

use App\Traits\PDFGenerator;
use App\Traits\VoucherGenerator;

use Stripe;

class SaleController extends Controller
{
    use PDFGenerator;

    public function showCart()
    {
        if (session('cart_id') !== null && Cart::where('cart_id', session('cart_id'))->count() > 0) {
            $cart = Cart::where('cart_id', session('cart_id'))->first();
            $cart_id = $cart->cart_id;
            $cart_count = $cart->couture_variations()->count();
        } else {
            $cart_id = 0;
            $cart_count = 0;
        }

        return view('checkout.cart', ['cart_id' => $cart_id, 'cart_count' => $cart_count]);
    }

    public function showPayment()
    {
        if (session('cart_id') !== null 
            && Cart::where('cart_id', session('cart_id'))->count() > 0 
            && Cart::where('cart_id', session('cart_id'))->first()->couture_variations()->count() > 0) {
            $cart_id = session('cart_id');
            $cart = Cart::where('cart_id', $cart_id)->first();
            session(['payment-ongoing' => 'active']);

            if (auth()->check() && auth()->user()->last_conditions_agreed) {
                return view('checkout.payment', ['cart_id' => $cart_id, 'cart' => $cart]);
            } elseif (auth()->check()) {
                return redirect()->route('cart-'.app()->getLocale());
            }

            return view('checkout.payment', ['cart_id' => $cart_id, 'cart' => $cart]);
        } else {
            return redirect()->route('cart-'.app()->getLocale());
        }
    }

    public function cardPayment(Request $request)
    {
        if (session('cart_id') == null) {
            return redirect()->route('home', ['locale' => app()->getLocale()]);
        }
        if (is_string($request->order) && Order::where('unique_id', substr($request->order, 0, 6))->count() > 0) {
            $order = Order::where('unique_id', substr($request->order, 0, 6))->first();
            if ($order->status >= 2) {
                return redirect()->route('payment-processed-'.session('locale'), ['order' => $request->order]);
            }
            $order->status = 1;
            $order->save();
            $cart = $order->cart;

            // Cart status update to Paying
            $cart->status = 2;
            $cart->save();

            // This is your test secret API key.
            \Stripe\Stripe::setApiKey(config('stripe.secret'));

            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => intval($order->total_price * 100),
                'currency' => 'eur',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            return view('checkout.process-card-payment', ['order' => $order, 'order_id' => $request->order, 'client_secret' => json_encode($output)]);
        } else {
            return redirect()->route('cart-'.app()->getLocale());
        }
    }

    public function paypalPayment(Request $request)
    {
        if (session('cart_id') == null) {
            return redirect()->route('home', ['locale' => app()->getLocale()]);
        }
        if (is_string($request->order) && Order::where('unique_id', substr($request->order, 0, 6))->count() > 0) {
            $order = Order::where('unique_id', substr($request->order, 0, 6))->first();
            if ($order->status >= 2) {
                return redirect()->route('payment-processed-'.session('locale'), ['order' => $request->order]);
            }
            $order->status = 1;
            $order->save();
            $cart = $order->cart;

            // Cart status update to Paying
            $cart->status = 2;
            $cart->save();

            return view('checkout.process-paypal-payment', ['order' => $order, 'order_id' => $request->order]);
        }
        return redirect()->route('home', ['locale' => app()->getLocale()]);
    }

    public function validatePayment($order, Request $request)
    {
        if (is_string($order) && Order::where('unique_id', substr($order, 0, 6))->count() > 0) {
            $current_order = Order::where('unique_id', substr($order, 0, 6))->first();

            if ($current_order->status >= 2) {
                $request->session()->forget('cart_id');
                return redirect()->route('payment-processed-'.session('locale'), ['order' => $order]);
            } else {
                $request->session()->forget('cart_id');

                // Include here logic to update all stocks
                foreach ($current_order->cart->couture_variations as $variation) {
                    if ($variation->name !== 'voucher') {
                        // What if variation is available in several shops??
                        $pivot = $variation->pending_shops()->first()->pivot;
                        $pivot->decrement('stock_in_cart', $variation->pivot->articles_number);
                    } else {
                        for ($i=1; $i <= $variation->pivot->articles_number; $i++) { 
                            // $increment = rand(0, 9).rand(0, 9);
                            // $value_code = str_pad(intval($variation->pivot->value) / 10, 2, '0', STR_PAD_LEFT);
                            // $unique_code = strtoupper("BC".date('m').substr(date('Y'), 2, 2).$value_code.Str::random(2).rand(10, 99));
                            // while (Voucher::where('unique_code', $unique_code)->count() > 0) {
                            //     // $increment = rand(0, 9).rand(0, 9);
                            //     $value_code = str_pad(intval($variation->pivot->value) / 10, 2, '0', STR_PAD_LEFT);
                            //     $unique_code = strtoupper("BC".date('m').substr(date('Y'), 2, 2).$value_code.Str::random(2).rand(10, 99));
                            // }
                            $unique_code = VoucherGenerator::generateVoucherCode($variation->pivot->value);
                            $new_voucher = new Voucher();
                            $new_voucher->unique_code = $unique_code;
                            $new_voucher->user_id = null;
                            $new_voucher->order_id = $current_order->id;
                            $new_voucher->type = $variation->voucher_type;
                            $new_voucher->initial_value = $variation->pivot->value;
                            $new_voucher->remaining_value = $variation->pivot->value;
                            $new_voucher->save();
                        }
                    }
                }

                // Send new voucher codes in order recap (e-mail ?) for fabric vouchers.

                // Update used voucher value
                if ($current_order->cart->use_voucher == 1 && Voucher::where('unique_code', $current_order->cart->voucher_code)->count() > 0) {
                    $voucher = Voucher::where('unique_code', $current_order->cart->voucher_code)->first();
                    if ($current_order->cart->price_before_voucher > $voucher->remaining_value) {
                        $voucher->remaining_value = 0;
                    } else {
                        $voucher->remaining_value -= $current_order->cart->price_before_voucher;
                    }
                    $voucher->save();
                }

                $current_order->status = '2';

                $pdf = $this->generateInvoicePdf($current_order->unique_id);

                // Send e-mail with purchase confirmation, with pdf invoice
                if ($current_order->user_id > 0) {
                    SendNewOrderEmails::dispatchAfterResponse($current_order->user->email, $current_order, $pdf);
                } elseif (auth()->check() && auth()->user()->role == 'vendor') {
                    SendNewOrderEmails::dispatchAfterResponse(auth()->user()->email, $current_order, $pdf);
                    // Mail::to(auth()->user()->email)->send(new NewOrder($current_order, $pdf));
                }

                if ($current_order->payment_type ==  '0') { //Case payment by card
                    $current_order->payment_status = 2;
                    $current_order->transaction_date = Carbon::now()->toDateTimeString();
                } elseif ($current_order->payment_type == '1') { // Case PayPal
                    $current_order->payment_status = 2;
                    $current_order->transaction_date = Carbon::now()->toDateTimeString();
                } elseif ($current_order->payment_type == '2') { // Case Payconiq
                    $current_order->payment_status = 1;
                } elseif ($current_order->payment_type == '3') { // Case bank transfer
                    $current_order->payment_status = 1;
                } elseif ($current_order->payment_type == '4') { // Case voucher paid all
                    $current_order->payment_status = 2;
                    $current_order->transaction_date = Carbon::now()->toDateTimeString();
                } elseif ($current_order->payment_type >= '5') { // Case Paid in shop
                    $current_order->payment_status = 2;
                    $current_order->transaction_date = Carbon::now()->toDateTimeString();
                }

                // Send e-mails with pdf vouchers (1 e-mail/pdf voucher) if already paid
                if ($current_order->payment_status == 2 && $current_order->user_id > 0) {
                    foreach ($current_order->pdf_vouchers as $voucher) {
                        $voucher_pdf = $this->generateVoucherPdf($voucher->unique_code);
                        if(app('env') == 'prod') {
                            Mail::mailer('smtp_admin')->to($current_order->user->email)->bcc(config('mail.mailers.smtp_admin.sender'))->send(new VoucherPdf($current_order->user, $voucher, $voucher_pdf));
                        } else {
                            Mail::mailer('smtp_admin')->to($current_order->user->email)->send(new VoucherPdf($current_order->user, $voucher, $voucher_pdf));
                        }
                    }
                }

                if($current_order->payment_type >= '5') {
                    $current_order->status = 5; //5 -> sold in shop
                    $current_order->delivery_status = 10; //10 -> bought in shop
                } elseif ($current_order->cart->couture_variations->count() == 1 
                    && $current_order->pdf_vouchers->count() > 0
                    && $current_order->payment_status == 2) {
                    // Case order is paid and only contains pdf vouchers
                    $current_order->delivery_status = 4;
                } else {
                    $current_order->delivery_status = 1;
                }

                if($current_order->save()) {
                    // Update cart status
                    $cart = $current_order->cart;
                    $cart->is_active = 0;
                    $cart->status = 3; // Cart status updated to Order Confirmed
                    $cart->save();

                    return redirect()->route('payment-processed-'.session('locale'), ['order' => $order]);
                }
            }
        }
    }


    public function showValidPayment($order)
    {
        if (strlen($order) < 6 || Order::where('unique_id', substr($order, 0, 6))->count() == 0) {
            return redirect()->route('home', ['locale' => app()->getLocale()]);
        }

        if (auth()->check() && auth()->user()->role == 'vendor') {
            session(['has_kulturpass' => null]);
        }

        return view('checkout.payment-complete', ['order' => Order::where('unique_id', substr($order, 0, 6))->first(), 'url_order' => $order]);
    }


    public function displayInvoice($order_code)
    {
        if (strlen($order_code) == 22 && Order::where('unique_id', substr($order_code, 4, 6))->count() > 0) {
            $clean_order_code = substr($order_code, 4, 6);
            $order = Order::where('unique_id', substr($order_code, 4, 6))->first();
            $pdf = $this->generateInvoicePdf($clean_order_code);
            return $pdf->stream('BENU_Order_'.$order->unique_id.'.pdf');
        }
    }

    public function downloadInvoice($order_code)
    {
        if (strlen($order_code) == 22 && Order::where('unique_id', substr($order_code, 4, 6))->count() > 0) {
            $clean_order_code = substr($order_code, 4, 6);
            $order = Order::where('unique_id', substr($order_code, 4, 6))->first();
            $pdf = $this->downloadInvoicePdf($clean_order_code);
            return $pdf->download('benu-invoice-'.$order->unique_id.'.pdf');
        }
    }

    public function displayReturn($order_code)
    {
        if (strlen($order_code) == 28) {
            if (in_array(substr($order_code, 4, 6), ['nykul3', '7intxw', 'Xnik7b', '12liug', '09baf9', 'kEH76f', 'oiGfz6'])) {
                if (Order::where('unique_id', substr($order_code, 10, 6))->count() > 0) {
                    $clean_order_code = substr($order_code, 10, 6);
                    $order = Order::where('unique_id', $clean_order_code)->first();
                    $pdf = $this->generateReturnPdf($clean_order_code);
                    return $pdf->stream('BENU_Return_'.$order->unique_id.'.pdf');
                }
            }
        } elseif (strlen($order_code) == 22 && Order::where('unique_id', substr($order_code, 4, 6))->count() > 0) {
            $clean_order_code = substr($order_code, 4, 6);
            $order = Order::where('unique_id', $clean_order_code)->first();
            if (auth()->check() && auth()->user()->orders->contains($order->id)) {
                $pdf = $this->generateReturnPdf($clean_order_code);
                return $pdf->stream('BENU_Return_'.$order->unique_id.'.pdf');
            }
        } elseif($order_code == '0') {
            $pdf = $this->generateReturnPdf(0);
            return $pdf->stream('BENU_Return_blank.pdf');
        }
    }
}
