<?php
namespace App\Libraries\GeoCoding;

use Illuminate\Support\Facades\Facade;

class GeoCodingFacade extends Facade {
    /**
     * Set up Laravel facade for static access
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'App\Libraries\GeoCoding\GeoCodingClient'; }
}
