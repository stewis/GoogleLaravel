<?php

namespace App\Jobs;

use App\Address;
use App\Coordinate;
use App\Libraries\GeoCoding\GeoCodingFacade;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GeoCodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $address;

    /**
     * GeoCodeJob constructor.
     * Sets address for use in handle method
     * @param Address $address
     */
    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * Execute the job.
     * Will lookup and set the spatial data for the current postcode
     *
     * Todo:  Use full address in lookup (using postcode as seed method in this example generates mock data)
     *
     * @return void
     */
    public function handle()
    {
        $coordinatesModel = GeoCodingFacade::setApiKey(env('GOOGLE_API'))
            ->getCoordinates($this->address->postcode);
        Coordinate::firstOrCreate(
            [
                'address_id' => $this->address->id
            ], [
                'position' => $coordinatesModel->toSQL()
            ]
        );
    }
}
