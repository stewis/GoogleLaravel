<?php
namespace App\Libraries\GeoCoding;

use Illuminate\Support\Facades\Facade;

class GeoCodingFacade extends Facade {
    protected static function getFacadeAccessor() { return 'App\Libraries\GeoCoding\GeoCodingClient'; }
}
