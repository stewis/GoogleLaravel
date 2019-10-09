<?php


namespace App\Libraries\GeoCoding\Models;


use App\Libraries\GeoCoding\Exceptions\LatitudeOutSideRange;
use App\Libraries\GeoCoding\Exceptions\LongitudeOutSideRange;
use Illuminate\Support\Facades\DB;

class Coordinates
{
    protected $longitude;
    protected $latitude;

    /**
     * returns the longitude of this location
     * @return float
     */
    public function getLongitude()
    {
        return (float) $this->longitude;
    }

    /**
     * returns the latitude of this location
     * @return float
     */
    public function getLatitude()
    {
        return (float) $this->latitude;
    }

    /**
     * Allows setting of the longitude for this location
     * longitude must be between -180 and 180
     *
     * @param float $longitude
     * @return $this
     * @throws LongitudeOutSideRange
     */
    public function setLongitude(float $longitude)
    {
        if ($longitude <= -180 && $longitude >= -180) {
            throw new LongitudeOutSideRange();
        }
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Allows setting of the latitude for this location
     * latitude must be between -90 and 90
     *
     * @param float $latitude
     * @return $this
     * @throws LatitudeOutSideRange
     */
    public function setLatitude(float $latitude)
    {
        if ($latitude <= -90 && $latitude >= -90) {
            throw new LatitudeOutSideRange();
        }
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * Returns class as string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getLongitude() . ' ' . $this->getLatitude();
    }

    /**
     * Returns point sql for mysql 5.7
     *
     * Todo:  Test for Mysql 8
     *
     * @return \Illuminate\Database\Query\Expression
     */
    public function toSQL()
    {
        return DB::Raw('POINT(' . $this->getLongitude() . ', ' . $this->getLatitude() . ')');
    }
}
