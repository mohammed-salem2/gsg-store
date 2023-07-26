<?php

namespace App\Providers;

use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CookieRepository;
use App\Repositories\Cart\DatabaseRepository;
use App\Repositories\Cart\SessionRepository;
use Illuminate\Database\Events\DatabaseRefreshed;
use Illuminate\Support\ServiceProvider;

class CartProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CartRepository::class , function($app){
            if(config('cart.driver') === 'cookie'){
                return new CookieRepository();
            }
            else if (config('cart.driver') === 'session'){
                return new SessionRepository();
            }
            else{
                return new DatabaseRepository();
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
