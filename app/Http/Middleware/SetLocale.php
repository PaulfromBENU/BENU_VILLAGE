<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SetLocale
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
        if (!$request->isMethod('post')) {
            //Get first segment. Should be locale.
            $segment = $request->segment(1);

            // Prefixes the request with the locale if not present
            if (!in_array($segment, config('app.locales'))) {
                $segments = $request->segments();
                $fallback = session('locale') ?: config('app.fallback_locale');
                $segments = array_merge([$fallback], $segments);

                return redirect()->to(implode('/', $segments));
            }

            //Changes the locale to the prefixed value
            app()->setLocale($segment);

            session(['locale' => app()->getLocale()]);
            
            //Check if current route name is localized. If not, append current localization suffix to redirect to the translated URL. If the localized route name does not exists, keep unlocalized route name (default value).
            if (!in_array(substr(Route::currentRouteName(), -3), ['-en', '-fr', '-de', '-pt', '-lu'])) {
                if (Route::has(Route::currentRouteName().'-'.app()->getLocale())) {
                    return redirect()->route(Route::currentRouteName().'-'.app()->getLocale(), $request->route()->parameters());
                }
            }

            //If the requested route name does not match the correct localization, redirect to the correctly localized route name. If it does not exist, do not apply the localization on route name.
            if (substr(Route::currentRouteName(), -3) != '-'.app()->getLocale()) {
                //Changes the route name to the same with the correct locale suffix
                if (Route::has(substr(Route::currentRouteName(), 0, -2).app()->getLocale())) {
                    return redirect()->route(substr(Route::currentRouteName(), 0, -2).app()->getLocale(), $request->route()->parameters());
                }
            }
        }

        return $next($request);
    }
}
