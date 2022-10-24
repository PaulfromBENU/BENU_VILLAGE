<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class LangModal extends Component
{
    public $route_parameters_de;
    public $route_parameters_lu;
    public $route_parameters_fr;
    public $route_parameters_en;
    public $route_parameters_pt;
    public $route_name_de;
    public $route_name_lu;
    public $route_name_fr;
    public $route_name_en;
    public $route_name_pt;

    public function mount(Request $request)
    {
        $this->route_parameters_de = $request->route()->parameters();
        $this->route_parameters_lu = $request->route()->parameters();
        $this->route_parameters_fr = $request->route()->parameters();
        $this->route_parameters_en = $request->route()->parameters();
        $this->route_parameters_pt = $request->route()->parameters();
        $this->computeRoutes();
    }

    protected function computeRoutes()
    {
        //Handles possible cases of non-localized route names
        if (!in_array(substr(Route::currentRouteName(), -3), ['-en', '-fr', '-de', '-pt', '-lu'])) {
            if (Route::has(Route::currentRouteName().'-de')) {
                $this->route_name_de = Route::currentRouteName().'-de';
            } else {
                $this->route_name_de = Route::currentRouteName();
            }
            if (Route::has(Route::currentRouteName().'-lu')) {
                $this->route_name_lu = Route::currentRouteName().'-lu';
            } else {
                $this->route_name_lu = Route::currentRouteName();
            }
            if (Route::has(Route::currentRouteName().'-fr')) {
                $this->route_name_fr = Route::currentRouteName().'-fr';
            } else {
                $this->route_name_fr = Route::currentRouteName();
            }
            if (Route::has(Route::currentRouteName().'-en')) {
                $this->route_name_en = Route::currentRouteName().'-en';
            } else {
                $this->route_name_en = Route::currentRouteName();
            }
            if (Route::has(Route::currentRouteName().'-pt')) {
                $this->route_name_pt = Route::currentRouteName().'-pt';
            } else {
                $this->route_name_pt = Route::currentRouteName();
            }
        } else {
            // Case route name is localized: route name is switched to the new localization
            $this->route_name_de = substr(Route::currentRouteName(), 0, -2).'de';
            $this->route_name_lu = substr(Route::currentRouteName(), 0, -2).'lu';
            $this->route_name_fr = substr(Route::currentRouteName(), 0, -2).'fr';
            $this->route_name_en = substr(Route::currentRouteName(), 0, -2).'en';
            $this->route_name_pt = substr(Route::currentRouteName(), 0, -2).'pt';
        }

        // Add locale as parameter for all routes included in the non-localized route group
        if (in_array(Route::currentRouteName(), ['home', 'dashboard', 'login', 'login-en', 'login-de', 'login-fr', 'login-lu', 'register-fr', 'register-lu', 'register-de', 'register-en', 'password.request', 'password.reset', 'verification.notice', 'verification.verify', 'password.confirm'])) {
            $this->route_parameters_lu = array_merge($this->route_parameters_lu, ['locale' => "lu"]);
            $this->route_parameters_de = array_merge($this->route_parameters_de, ['locale' => "de"]);
            $this->route_parameters_en = array_merge($this->route_parameters_en, ['locale' => "en"]);
            $this->route_parameters_pt = array_merge($this->route_parameters_pt, ['locale' => "pt"]);
            $this->route_parameters_fr = array_merge($this->route_parameters_fr, ['locale' => "fr"]);
        }
    }

    public function render()
    {
        return view('livewire.modals.lang-modal');
    }
}
