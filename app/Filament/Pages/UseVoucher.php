<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Illuminate\Contracts\View\View;
use Filament\Pages\Page;

use App\Models\Voucher;
use App\Models\User;

class UseVoucher extends Page
{
    protected static string $view = 'filament.pages.use-voucher';

    protected static ?string $title = 'Use a voucher';
 
    protected static ?string $navigationLabel = 'Use voucher manually';
     
    protected static ?string $slug = 'use-voucher';

    protected static ?string $navigationIcon = 'heroicon-o-receipt-tax';

    protected static ?string $navigationGroup = 'Seller & Sales';

    protected static ?int $navigationSort = 3;

    public $all_codes;
    public $code;
    public $user_id;
    public $remaining_value;
    public $total_to_pay;
    public $yet_to_pay;
    public $code_selected;
    public $voucher_used;

    public $voucher_init_value;
    public $voucher_current_value;
    public $user_first_name;
    public $user_last_name;

    public function mount()
    {
        $this->findAllCodes();
        $this->resetValues();
    }

    public function resetValues()
    {
        $this->user_id = "";
        $this->total_to_pay = 0;
        $this->code_selected = 0;
        $this->voucher_init_value = 0;
        $this->voucher_current_value = 0;
        $this->user_first_name = "";
        $this->user_last_name = "";
        $this->voucher_used = 0;
        $this->code_selected = 0;
    }

    public function findAllCodes()
    {
        $this->all_codes = [];
        foreach (Voucher::where('remaining_value', '>', '0')->get() as $voucher) {
            $this->all_codes[$voucher->unique_code] = $voucher->remaining_value;
        }
    }

    public function selectCode()
    {
        if ($this->code !== 0 && Voucher::where('unique_code', $this->code)->count() > 0) {
            $this->resetValues();
            $this->code_selected = 1;
            $selected_voucher = Voucher::where('unique_code', $this->code)->first();
            $this->voucher_init_value = $selected_voucher->initial_value;
            $this->remaining_value = $selected_voucher->remaining_value;
            if ($selected_voucher->user_id != null && $selected_voucher->user_id != "" && User::find($selected_voucher->user_id)) {
                $this->user_id = $selected_voucher->user_id;
                $this->user_first_name = ucfirst($selected_voucher->user->first_name);
                $this->user_last_name = ucfirst($selected_voucher->user->last_name);
            } else {
                $this->user_id = "";
                $this->user_first_name = "";
                $this->user_last_name = "";
            }
            $this->total_to_pay = 0;
        } else {
            $this->resetValues();
        }
    }

    public function updateVoucherValue()
    {
        $voucher_current_value = Voucher::where('unique_code', $this->code)->first()->remaining_value;

        if (!is_numeric($this->total_to_pay)) {
            $this->total_to_pay = 0;
        }
        if ($this->total_to_pay > $voucher_current_value) {
            $this->remaining_value = 0;
            $this->yet_to_pay = $this->total_to_pay - $voucher_current_value;
        } else {
            $this->remaining_value = $voucher_current_value - $this->total_to_pay;
            $this->yet_to_pay = 0;
        }
    }

    public function confirmVoucherUse()
    {
        if (is_numeric($this->total_to_pay) && Voucher::where('unique_code', $this->code)->count() > 0) {
            $updated_voucher = Voucher::where('unique_code', $this->code)->first();
            $updated_voucher->remaining_value = $this->remaining_value;
            if($updated_voucher->save()) {
                $this->total_to_pay = 0;
                $this->voucher_used = 1;
                $this->updateVoucherValue();
            }
        }
    }
}
