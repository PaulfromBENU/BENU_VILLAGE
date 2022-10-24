<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

use App\Models\Voucher;

class Vouchers extends Component
{
    public $voucher_code;
    public $message;

    protected $rules = ['voucher_code' => 'required|string|min:2|max:17'];

    public function mount()
    {
        $this->voucher_code = "";
        $this->message = "";
    }

    public function addVoucher()
    {
        $this->validate();

        if (Voucher::where('unique_code', $this->voucher_code)->count() > 0) {
            $voucher = Voucher::where('unique_code', $this->voucher_code)->first();
            if ($voucher->user_id == null || $voucher->user_id == 0 || $voucher->user_id == "") {
                $voucher->user_id = auth()->user()->id;
                if ($voucher->save()) {
                    $this->voucher_code = "";
                    $this->message = "";
                }
            } else {
                $this->message = __('dashboard.voucher-already-belongs-to-someone');
                $this->voucher_code = "";
            }
        } else {
            $this->message = __('dashboard.voucher-not-found');
            $this->voucher_code = "";
        }
    }

    public function removeVoucher($code)
    {
        if (auth()->user()->vouchers()->where('unique_code', $code)->count() > 0) {
            $deleted_voucher = auth()->user()->vouchers()->where('unique_code', $code)->first();
            $deleted_voucher->user_id = null;
            $deleted_voucher->save();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.vouchers', [
            'vouchers' => auth()->user()->vouchers,
        ]);
    }
}
