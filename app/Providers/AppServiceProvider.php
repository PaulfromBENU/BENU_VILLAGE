<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Blade;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Schema;

use Filament\Facades\Filament;

use App\Models\InstagramPicture;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //View::share('youVarName', [1, 2, 3]);

        // Custom password conditions
        Password::defaults(function () {
            $rule = Password::min(8);

            // return $this->app->isProduction()
            //             ? $rule->mixedCase()->uncompromised()
            //             : $rule;
            return $rule->mixedCase();// ->uncompromised();
        });

        // Filament handling
        Filament::registerStyles([
            asset('css/app.css'),
        ]);

        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'Seller & Sales',
                'Users',
                'Creations & Variations',
                'Data Importation',
                'Site Data',
                'Shops & Partners',
            ]);
        });

        // Custom Blade @inshop
        Blade::directive('inshop', function () {
            return "<?php if(auth()->check() && auth()->user()->role == 'vendor'): ?>";
        });

        Blade::directive('endinshop', function () {
            return "<?php endif ?>";
        });

        // Generate Instagram pictures for footer on all pages
        if (Schema::connection('mysql_common')->hasTable('instagram_pictures')) {
            $insta_links =  InstagramPicture::where('is_village', '1')->orderBy('created_at', 'desc')->limit(15, 0)->get();
            view()->share('insta_links', $insta_links);
        }
    }
}
