<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Cart;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (session('status') !== null) {
            session()->flash('success', session('status'));
            session()->forget('status');
        } else {
            session()->forget('success');
        }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        if (Auth::user()->role == 'guest_client') {
            $this->destroy($request);
            return redirect('/');
        }

        $request->session()->regenerate();

        Auth::user()->last_login = DB::raw('CURRENT_TIMESTAMP');
        Auth::user()->save();

        if (session('payment-ongoing') == 'active') {
            session()->forget('payment-ongoing');
            return redirect()->route('payment-'.session('locale'));
        }
        return redirect()->intended(RouteServiceProvider::DASHBOARD);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        if (session('cart_id') !== null && Cart::where('cart_id', session('cart_id'))->count() > 0) {
            $cart = Cart::where('cart_id', session('cart_id'))->first();
            foreach ($cart->couture_variations()->where('name', '<>', 'voucher')->get() as $variation) {
                if ($variation->pending_shops()->count() > 0) {
                    $pivot = $variation->pending_shops()->first()->pivot;
                    $pivot->decrement('stock_in_cart');
                    $pivot->increment('stock');
                }
            }
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
