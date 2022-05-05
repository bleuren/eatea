<?php

namespace App\Providers;

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
        $this->app->bind('App\Contracts\ICartService', 'App\Services\CartService');
        $this->app->bind('App\Contracts\IOrderService', 'App\Services\OrderService');
        $this->app->bind('App\Contracts\IUserService', 'App\Services\UserService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
