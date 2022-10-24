<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Cart;

class CreateCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('cart_id') == null || Cart::where('cart_id', session('cart_id'))->count() == 0) {
            $random_id = substr(str_shuffle(Str::random(30)."0123456789"), rand(0, 5), 20);
            while (Cart::where('cart_id', $random_id)->count() > 0) {
                $random_id = substr(str_shuffle(Str::random(30)."0123456789"), rand(0, 5), 20);
            }
            session(['cart_id' => $random_id]);
            // $new_cart = new Cart();
            // $new_cart->cart_id = $random_id;
            // if (auth()->check()) {
            //     $new_cart->user_id = auth()->user()->id;
            // } else {
            //     $new_cart->user_id = str_replace(".", "", $request->ip());
            // }
            // $new_cart->is_active = 1;
            return $next($request);
            // if ($new_cart->save()) {
            //     return $next($request);
            // }
        }
        return $next($request);
    }
}
