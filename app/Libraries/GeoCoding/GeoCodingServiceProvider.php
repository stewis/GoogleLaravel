<?php
namespace App\Libraries\GeoCoding;

use Illuminate\Support\ServiceProvider;

class GeoCodingServiceProvider extends ServiceProvider {

    protected $defer = false;

    /**
     * Register GeoCoding Client for laravel
     */
    public function register() {
        $this->app->singleton('GeoCode', function () {
            return new GeoCodingClient();
        });
    }

    public function provides() {
        return ['GeoCode'];
    }

}
