<?php

namespace App\Traits;

use App\Models\DeliveryCountry;
use App\Models\Order;
use App\Models\Voucher;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use PDF;

trait PDFGenerator {
    
    public function generateVoucherPdf($voucher_code)
    {
        if (strlen($voucher_code) == 12 && Voucher::where('unique_code', $voucher_code)->count() > 0) {
            $voucher = Voucher::where('unique_code', $voucher_code)->first();

            if (auth()->check()) {
                $current_locale = app()->getLocale();
                app()->setLocale(auth()->user()->favorite_language);
            }

            $pdf = PDF::loadView('pdfs.voucher', compact('voucher'));

            if (auth()->check()) {
                app()->setLocale($current_locale);
            }

            return $pdf;
        }
    }

    public function generateReturnPdf($order_code)
    {
        if (strlen($order_code) == 6 && Order::where('unique_id', $order_code)->count() > 0) {
            $order = Order::where('unique_id', $order_code)->first();

            if (auth()->check()) {
                $current_locale = app()->getLocale();
                app()->setLocale(auth()->user()->favorite_language);
            }

            $pdf = PDF::loadView('pdfs.return', compact('order'));
            $pdf->setPaper('A4', 'landscape');

            if (auth()->check()) {
                app()->setLocale($current_locale);
            }

            return $pdf;
        } elseif ($order_code == '0') {
            $order = null;

            if (auth()->check()) {
                $current_locale = app()->getLocale();
                app()->setLocale(auth()->user()->favorite_language);
            }
            
            $pdf = PDF::loadView('pdfs.return', compact('order'));
            $pdf->setPaper('A4', 'landscape');

            if (auth()->check()) {
                app()->setLocale($current_locale);
            }

            return $pdf;
        }
    }
}