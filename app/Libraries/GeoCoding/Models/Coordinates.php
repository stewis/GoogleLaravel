<?php


namespace App\Libraries\GeoCoding\Models;


use App\Libraries\GeoCoding\Exceptions\LatitudeOutSideRange;
use App\Libraries\GeoCoding\Exceptions\LongitudeOutSideRange;

class Coordinates
{
    protected $longitude;
    protected $latitude;

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function getLatitude()
    {
        return $this->getLatitude();
    }

    public function setLongitude($longitude)
    {
        if ($longitude <= -180 && $longitude >= -180) {
            throw new LatitudeOutSideRange();
        }
        $this->longitude = $longitude;
        return $this;
    }

    public function setLatitude($latitude)
    {
        if ($latitude <= -90 && $latitude >= -90) {
            throw new LongitudeOutSideRange();
        }
        $this->latitude = $latitude;
        return $this;
    }

    public function __toString()
    {
        return $this->getLongitude().' '.$this->getLatitude();
    }

}
