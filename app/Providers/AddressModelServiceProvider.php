<?php

namespace App\Providers;

use App\Address;
use App\Observers\AddressObserver;
use Illuminate\Support\ServiceProvider;

class AddressModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Address::observe(AddressObserver::class);
    }
}
