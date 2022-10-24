<?php

namespace App\Traits;

use App\Models\Voucher;

use Illuminate\Support\Str;

trait VoucherGenerator {
    public static function generateVoucherCode($initial_value)
    {
        $voucher_count = str_pad(Voucher::where('unique_code', 'LIKE', '%'.date('m').substr(date('Y'), 2, 2).'%')->count() + 1, 2, '0', STR_PAD_LEFT);
        $value_code = str_pad(substr($initial_value / 10, 0, 2), 2, '0', STR_PAD_LEFT);
        // $value_code = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
        $new_code = strtoupper("BC".date('m').substr(date('Y'), 2, 2).$voucher_count.$value_code.str_shuffle(Str::random(1).rand(0, 9)));
        while (Voucher::where('unique_code', $new_code)->count() > 0) {
            $increment = rand(0, 9).rand(0, 9);
            $value_code = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
            $new_code = strtoupper("BC".date('m').substr(date('Y'), 2, 2).$voucher_count.$value_code.str_shuffle(Str::random(1).rand(0, 9)));
        }

        return $new_code;
    }
}