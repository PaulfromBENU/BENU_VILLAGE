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
