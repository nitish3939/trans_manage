<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\AuthorityMenuMapping;
use App\Models\MenuStructure;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        view()->composer('*', function($view) {
            if (Auth::guard("subadmin")->check()) {
                $allowedMenu = AuthorityMenuMapping::where("user_id", Auth::guard("subadmin")->user()->id)->pluck("menu_id")->toArray();
                $menus = MenuStructure::whereIn("id", $allowedMenu)->get();

                $view->with(['allowed_menus'=> $menus]);
            } else {
                $view->with(['allowed_menus'=> null]);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
