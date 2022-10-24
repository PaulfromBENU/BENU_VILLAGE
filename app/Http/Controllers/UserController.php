<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Address;
use App\Models\ContactMessage;
use App\Models\User;
use App\Models\Voucher;

use App\Http\Requests\AddressRequest;

use App\Traits\PDFGenerator;

class UserController extends Controller
{
    use PDFGenerator;

    public function __construct()
    {
        $this->middleware('auth');
        session()->forget('payment-ongoing');
    }

    public function show(string $locale, Request $request)
    {
        if (!isset($request->section) || !in_array($request->section, ['overview', 'addresses', 'orders', 'communications', 'returns', 'wishlist', 'vouchers', 'conditions', 'details', 'delete'])) {
            $section = 'overview';
        } else {
            $section = $request->section;
        }

        return view('dashboard', ['section' => $section]);
    }

    public function addAddress(string $locale, AddressRequest $request)
    {
        if ($request->address_id == 0) {
            $address = new Address();
            $address->user_id = Auth::id();
        } elseif (Auth::user()->addresses->contains($request->address_id)) {
            $address = Address::find($request->address_id);
        } else {
            return redirect()->route('dashboard', ['locale' => $locale, 'section' => 'addresses'])->with('error', "An error occured.");
        }

        $address->address_name = $request->register_address_name;
        $address->first_name = $request->register_address_first_name;
        $address->last_name = $request->register_address_last_name;
        $address->street_number = $request->register_address_number;
        $address->street = $request->register_address_street;
        if (isset($request->register_address_floor)) {
            $address->floor = $request->register_address_floor;
        } else {
            $address->floor = "";
        }
        $address->zip_code = $request->register_address_zip;
        $address->city = $request->register_address_city;
        if (!isset($request->register_address_country) || $request->register_address_country == "") {
            $request->register_address_country = "LU";
        }
        $address->country = $request->register_address_country;
        $address->phone = $request->register_address_phone;
        if (isset($request->register_address_other)) {
            $address->other_infos = $request->register_address_other;
        }

        if ($address->save()) {
            return redirect()->route('dashboard', ['locale' => $locale, 'section' => 'addresses']);
        }
    }

    public function displayVoucher($voucher_code)
    {
        if (strlen($voucher_code) == 28 && Voucher::where('unique_code', substr($voucher_code, 4, 12))->count() > 0) {
            $clean_voucher_code = substr($voucher_code, 4, 12);
            $voucher = Voucher::where('unique_code', $clean_voucher_code)->first();
            $pdf = $this->generateVoucherPdf($clean_voucher_code);
            
            return $pdf->stream('BENU_Voucher_'.$voucher->unique_code.'.pdf');
        }
    }
}
