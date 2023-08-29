<?php

namespace App\Providers;

use App\UserMenu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $user_menu = UserMenu::get();
        View::composer('template_backend.sidebar', function ($view) use ($user_menu, ) {
            $view->with('user_menu', $user_menu);
        });
    }
}