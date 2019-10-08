<?php

namespace App\Jobs;

use App\Address;
use App\Coordinates;
use App\Libraries\GeoCoding\GeoCodingFacade;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GeoCodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $coordinatesModel = GeoCodingFacade::setApiKey(env('GOOGLE_API'))
            ->getCoordinates($this->address->postcode);
        Coordinates::firstOrCreate(
            [
                'address_id' => $this->address->id
            ], [
                'position' => $coordinatesModel->toSQL()
            ]
        );
    }
}
