<?php

namespace App\Libraries\GeoCoding;

use App\Libraries\GeoCoding\Exceptions\NoResultsFound;
use App\Libraries\GeoCoding\Models\Coordinates;

class GeoCodingClient
{
    protected $apiKey;

    /**
     * Set Google API Key (not using Laravel env as intention is to be platform independent)
     *
     * @param $apiKey
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Send request to google for geocode accepts address string and returns location information
     * @param $address
     * @return mixed
     */
    protected function sendRequest($address)
    {
        $jsonData = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=' .$this->apiKey . '&address=' . urlencode($address));
        return json_decode($jsonData);
    }

    /**
     * Accepts address string and returns coordinates object for external processing
     *
     * @param $address
     * @return Coordinates
     * @throws Exceptions\LatitudeOutSideRange
     * @throws Exceptions\LongitudeOutSideRange
     * @throws NoResultsFound
     */
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
