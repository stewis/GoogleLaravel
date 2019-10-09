<?php

namespace App\Observers;

use App\Address;
use App\Jobs\GeoCodeJob;

class AddressObserver
{
    /**
     * Trigger geocoding job when new address item is created
     *
     * Todo:  setup Laravel horizon and queuing to allow asynchronous processing of this job
     *
     * @param Address $address
     */
    public function created(Address $address)
    {
        GeoCodeJob::dispatch($address);
    }

    /**
     * Trigger geocoding job when an address model is updated
     *
     * Todo:  setup Laravel horizon and queuing to allow asynchronous processing of this job
     *
     * @param Address $address
     */
    public function updated(Address $address)
    {
        if ($address->postcode != $address->getOriginal('postcode')) {
            GeoCodeJob::dispatch($address);
        }
    }
}
