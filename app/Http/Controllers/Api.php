<?php


namespace App\Http\Controllers;


use App\Coordinate;
use App\Http\Requests\apiSearchRequest;
use App\Libraries\GeoCoding\GeoCodingFacade;

class Api extends Controller
{
    public function getClosest(apiSearchRequest $request)
    {
        $coordinatesModel = GeoCodingFacade::setApiKey(env('GOOGLE_API'))
            ->getCoordinates($request->search);

        $closestLocation = Coordinate::findClosest(
            $coordinatesModel->getLongitude(),
            $coordinatesModel->getLatitude()
        );

        preg_match('/POINT\((.*) (.*)\)/', $closestLocation->lnglat, $latLong);

        $json = new \stdClass();
        $json->restaurant = $closestLocation->address->restaurant->name;
        $json->address = $closestLocation->address->toArray();
        $json->distance = (float) $closestLocation->km;
        $json->longitude = (float) $latLong[1];
        $json->latitude = (float) $latLong[2];
        $json->fromLongitude = (float) $coordinatesModel->getLongitude();
        $json->fromLatitude = (float) $coordinatesModel->getLatitude();

        return response()->json($json);
    }
}
