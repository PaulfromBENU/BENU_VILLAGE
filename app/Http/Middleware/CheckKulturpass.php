<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Carbon\Carbon;

class CheckKulturpass
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
        if(auth()->check() && auth()->user()->role == 'vendor') {
            //do nothing, keep status
        } elseif (auth()->check() && auth()->user()->kulturpasses()->where('approved', '1')->count() > 0) {
            $kulturpass = auth()->user()->kulturpasses()->orderBy('updated_at', 'desc')->first();
            if ($kulturpass->approved && $kulturpass->expiry_date >= Carbon::now()) {
                session(['has_kulturpass' => true]);
            } else {
                $request->session()->forget('has_kulturpass');
            }
        } else {
            $request->session()->forget('has_kulturpass');
        }

        return $next($request);
    }
}
