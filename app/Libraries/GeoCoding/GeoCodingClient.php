<?php

namespace App\Libraries\GeoCoding;

use App\Libraries\GeoCoding\Exceptions\NoResultsFound;
use App\Libraries\GeoCoding\Models\Coordinates;

class GeoCodingClient
{
    protected $apiKey;

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    protected function sendRequest($address)
    {
        $jsonData = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=' .$this->apiKey . '&address=' . urlencode($address));
        return json_decode($jsonData);
    }

    public function getCoordinates($address)
    {
        $geocodeData = $this->sendRequest($address);
        if (!empty($geocodeData->results[0])) {
            $coordinates = $geocodeData->results[0]
                ->geometry
                ->location;
            $coordinatesModel = new Coordinates();
            $coordinatesModel->setLatitude($coordinates->lat)
                ->setLongitude($coordinates->lng);
        } else {
            throw new NoResultsFound();
        }
        return $coordinatesModel;
    }
}
