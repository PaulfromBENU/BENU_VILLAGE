<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use App\Models\Article;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Voucher;
use App\Mail\VoucherPdf;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Traits\PDFGenerator;

use App\Jobs\SendOrderReadyConfirmationEmail;

class OrdersInterface extends Page
{
    use PDFGenerator;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-in';

    protected static string $view = 'filament.pages.orders-interface';

    protected static ?string $title = 'Orders - New, pending and sent';
 
    protected static ?string $navigationLabel = 'Handle Orders';
     
    protected static ?string $slug = 'handle-orders';

    protected static ?string $navigationGroup = 'Seller & Sales';

    protected static ?int $navigationSort = 2;

    public $new_orders;
    public $orders_waiting_for_payment;
    public $orders_sent;
    public $orders_ready_for_collect;
    public $orders_collected;
    public $orders_sold_in_shop;

    public $delivery_link;

    public $show_unpaid = [];

    public $show_new_orders = 0;
    public $show_unpaid_orders = 0;
    public $show_sent_orders = 0;
    public $show_orders_ready_for_collect = 0;
    public $show_collected_orders = 0;
    public $show_sold_in_shop_orders = 0;

    public function mount()
    {
        $this->cleanUnsoldArticles();
        $this->initializeOrders();

        // Initialize Content
        $this->delivery_link = [];// Array key: order id, value: link
    }

    public function initializeOrders()
    {
        $this->new_orders = Order::where('status', '2')
                            ->where('payment_status', '2')
                            ->where('delivery_status', '<', '2')
                            ->orderBy('updated_at', 'desc')
                            ->get();

        // Automatically clear unpaid orders after 8 days
        // $unpaid_orders_to_be_deleted = Order::where('status', '2')
        //                                     ->where('payment_status', '<', '2')
        //                                     ->where('delivery_status', '<', '2')
        //                                     ->where('updated_at', '<', Carbon::now()->subDays(9))
        //                                     ->select('id')
        //                                     ->get();
        // foreach ($unpaid_orders_to_be_deleted as $unpaid_order_to_be_deleted) {
        //     $this->cancelCart($unpaid_order_to_be_deleted->id);
        // }

        // Display other unpaid orders, with warning and manual delete option if > 5 days
        $this->orders_waiting_for_payment = Order::where('status', '2')
                                            ->where('payment_status', '<', '2')
                                            ->where('delivery_status', '<', '2')
                                            ->orderBy('updated_at', 'desc')
                                            ->get();
        $this->orders_sent = Order::where('delivery_status', '2')->orWhere('delivery_status', '4')->orderBy('delivery_date', 'desc')->get();
        $this->orders_ready_for_collect = Order::where('delivery_status', '3')->where('address_id', '0')->orderBy('delivery_date', 'desc')->get();
        $this->orders_collected = Order::where('delivery_status', '5')->where('address_id', '0')->orderBy('delivery_date', 'desc')->get();
        $this->orders_sold_in_shop = Order::where('delivery_status', '10')->where('address_id', '0')->orderBy('delivery_date', 'desc')->get();
    }

    public function cleanUnsoldArticles()
    {
        // Automatically delete unfinished orders and carts older than 7 days, and restore items
        $unfinished_carts_to_be_deleted = Cart::where('status', '<', '1')
                                            ->where('is_active', '1')
                                            ->where('price_before_voucher', '0')
                                            ->where('updated_at', '<', Carbon::now()->subDays(7))
                                            ->select('id')
                                            ->get();
        foreach ($unfinished_carts_to_be_deleted as $unfinished_cart_to_be_deleted) {
            $this->deleteUnfinishedCart($unfinished_cart_to_be_deleted->id);
        }

        // Restore articles which are in pending state while cart is no longer used (no deletion)
        foreach (Article::has('pending_shops')->get() as $article) {
            $reinsert_article = 1;
            foreach ($article->carts as $cart) {
                // Keep in cart if at least one cart with this article has been updated in the last 24h, or cart has been ordered and confirmed
                // if ($cart->order !== null && ($cart->updated_at >= Carbon::now()->subDays(1) || $cart->order->status >= 2)) {
                if ($cart->updated_at >= Carbon::now()->subDays(1) || ($cart->order !== null && $cart->order->status >= 2)) {
                    $reinsert_article = 0;
                }
            }

            if ($reinsert_article == 1) {
                $pivot = $article->pending_shops()->first()->pivot;
                $pivot->decrement('stock_in_cart');
                $pivot->increment('stock');
                // foreach ($article->carts as $cart) {
                //     // Delete cart if no order and older than 1 day with status unpaid
                //     if ($cart->updated_at < Carbon::now()->subDays(1) && $cart->order()->count() == 0 && $cart->is_active == 1 && $cart->status < 3) {
                //         $cart->delete();
                //     }
                // }
            }
        }
    }

    public function sendVouchersByEmail($order_id)
    {
        $order = Order::find($order_id);
        $order->status = 3;// Sent or available for collect
        $order->payment_status = 2;// Payment received
        $order->delivery_status = 4;// Delivery not required
        if($order->save()) {
            foreach ($order->pdf_vouchers as $voucher) {
                $voucher_pdf = $this->generateVoucherPdf($voucher->unique_code);
                Mail::mailer('smtp_admin')->to($order->user->email)->send(new VoucherPdf($order->user, $voucher, $voucher_pdf));
            }
            $this->initializeOrders();
        }
    }

    public function markAsReadyForCollect($order_id)
    {
        $order = Order::find($order_id);
        $order->status = 3;// Sent or available for collect
        $order->payment_status = 2;// Payment received
        $order->delivery_status = 3;// Available for collect
        $order->delivery_date = Carbon::now()->format('Y-m-d');
        if($order->save()) {
            $this->initializeOrders();
            SendOrderReadyConfirmationEmail::dispatchAfterResponse($order);
        }
    }

    public function markAsCollected($order_id)
    {
        $order = Order::find($order_id);
        $order->delivery_status = 5;// Collected
        $order->delivery_date = Carbon::now()->format('Y-m-d');
        if($order->save()) {
            $this->initializeOrders();
        }
    }

    public function markAsSentByPost($order_id)
    {
        $order = Order::find($order_id);
        $order->status = 3;// Sent or available for collect
        $order->payment_status = 2;// Payment received
        $order->delivery_status = 2;// Sent by Post
        $order->delivery_date = Carbon::now()->format('Y-m-d');
        if (isset($this->delivery_link[$order_id]) && $this->delivery_link[$order_id] !== "") {
            $order->delivery_link = $this->delivery_link[$order_id];
        }
        if($order->save()) {
            $this->initializeOrders();
            SendOrderReadyConfirmationEmail::dispatchAfterResponse($order);
        }
    }

    public function markAsUndelivered($order_id)
    {
        $order = Order::find($order_id);
        $order->status = 2;// Confirmed order
        $order->payment_status = 2;// Payment received
        $order->delivery_status = 1;// Not available for collect/Not sent
        if($order->save()) {
            $this->initializeOrders();
        }
    }

    public function markAsUnpaid($order_id)
    {
        $order = Order::find($order_id);
        $order->status = 2;// Order confirmed
        $order->payment_status = 1;// Payment not received
        $order->delivery_status = 1;// Not ready for delivery or collect
        $order->transaction_date = null;//Transaction date for accountability
        if($order->save()) {
            $this->initializeOrders();
        }
    }

    public function cancelCart($order_id)
    {
        $order = Order::find($order_id);
        $order->status = 4;
        foreach ($order->cart->couture_variations as $variation) {
            if ($variation->shops()->count() > 0) {
                $pivot = $variation->shops()->orderBy('updated_at', 'desc')->first()->pivot;
                // $pivot->decrement('stock_in_cart');
                $pivot->increment('stock');
            }
        }
        if($order->save()) {
            $this->initializeOrders();
        }
    }

    public function deleteUnfinishedCart($cart_id)
    {
        $cart = Cart::find($cart_id);
        foreach ($cart->couture_variations as $variation) {
            if ($variation->pending_shops()->count() > 0) {
                $pivot = $variation->pending_shops()->first()->pivot;
                $pivot->decrement('stock_in_cart');
                $pivot->increment('stock');
            }
        }
        if ($cart->order !== null) {
            $cart->order->delete();
        }
        $cart->delete();
    }

    public function markAsPaid($order_id)
    {
        $order = Order::find($order_id);
        $order->status = 2;// Paid
        $order->payment_status = 2;// Payment received
        $order->delivery_status = 1;// Not ready for delivery or collect
        $order->transaction_date = Carbon::now()->toDateTimeString();//Transaction date for accountability
        if($order->save()) {
            if ($order->pdf_vouchers->count() > 0) {
                foreach ($order->pdf_vouchers as $voucher) {
                    $voucher_pdf = $this->generateVoucherPdf($voucher->unique_code);
                    Mail::mailer('smtp_admin')->to($order->user->email)->send(new VoucherPdf($order->user, $voucher, $voucher_pdf));
                }
                if ($order->cart->couture_variations->count() == 1) {
                    $order->delivery_status = 4;
                    $order->save();
                }
            }
            // Add e-mail of payment confirmation and order preparation?
            $this->initializeOrders();
        }
    }

    public function showUnpaidDetails($order_id)
    {
        $this->show_unpaid[$order_id] = 1;
    }

    public function hideUnpaidDetails($order_id)
    {
        $this->show_unpaid[$order_id] = 0;
    }

    public function toggleNewOrders()
    {
        if ($this->show_new_orders == 0) {
            $this->show_new_orders = 1;
        } else {
            $this->show_new_orders = 0;
        }
        $this->show_unpaid_orders = 0;
        $this->show_sent_orders = 0;
        $this->show_orders_ready_for_collect = 0;
        $this->show_collected_orders = 0;
        $this->show_sold_in_shop_orders = 0;
    }

    public function toggleUnpaidOrders()
    {
        if ($this->show_unpaid_orders == 0) {
            $this->show_unpaid_orders = 1;
        } else {
            $this->show_unpaid_orders = 0;
        }
        $this->show_new_orders = 0;
        $this->show_sent_orders = 0;
        $this->show_orders_ready_for_collect = 0;
        $this->show_collected_orders = 0;
        $this->show_sold_in_shop_orders = 0;
    }

    public function toggleSentOrders()
    {
        if ($this->show_sent_orders == 0) {
            $this->show_sent_orders = 1;
        } else {
            $this->show_sent_orders = 0;
        }
        $this->show_new_orders = 0;
        $this->show_unpaid_orders = 0;
        $this->show_orders_ready_for_collect = 0;
        $this->show_collected_orders = 0;
        $this->show_sold_in_shop_orders = 0;
    }

    public function toggleOrdersReadyForCollect()
    {
        if ($this->show_orders_ready_for_collect == 0) {
            $this->show_orders_ready_for_collect = 1;
        } else {
            $this->show_orders_ready_for_collect = 0;
        }
        $this->show_new_orders = 0;
        $this->show_unpaid_orders = 0;
        $this->show_sent_orders = 0;
        $this->show_collected_orders = 0;
        $this->show_sold_in_shop_orders = 0;
    }

    public function toggleCollectedOrders()
    {
        if ($this->show_collected_orders == 0) {
            $this->show_collected_orders = 1;
        } else {
            $this->show_collected_orders = 0;
        }
        $this->show_new_orders = 0;
        $this->show_unpaid_orders = 0;
        $this->show_sent_orders = 0;
        $this->show_orders_ready_for_collect = 0;
        $this->show_sold_in_shop_orders = 0;
    }

    public function toggleSoldInShopOrders()
    {
        if ($this->show_sold_in_shop_orders == 0) {
            $this->show_sold_in_shop_orders = 1;
        } else {
            $this->show_sold_in_shop_orders = 0;
        }
        $this->show_new_orders = 0;
        $this->show_unpaid_orders = 0;
        $this->show_sent_orders = 0;
        $this->show_orders_ready_for_collect = 0;
        $this->show_collected_orders = 0;
    }

    // Display new orders - paid & not handled
    // New orders - Not paid yet
    // Orders paid & sent
}
