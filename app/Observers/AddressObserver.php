<?php

namespace App\Observers;

use App\Address;
use App\Jobs\GeoCodeJob;

class AddressObserver
{
    public function created(Address $address)
    {
        GeoCodeJob::dispatch($address);
    }

    public function updated(Address $address)
    {
        if ($address->postcode != $address->getOriginal('postcode')) {
            GeoCodeJob::dispatch($address);
        }
    }
}
