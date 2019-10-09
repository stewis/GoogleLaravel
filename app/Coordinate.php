<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    /**
     * Address relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    /**
     * Performs spatial search for a given longitude and latitude and returns closest match
     * @param float $longitude
     * @param float $latitude
     * @return mixed
     */
    public static function findClosest(float $longitude, float $latitude) {
        return static::select('coordinates.*')
            ->selectRaw('ST_distance_sphere(position, POINT(' . $longitude . ', ' . $latitude . ')) / 1000 AS km')
            ->selectRaw('ST_AsText(position) AS lnglat')
            ->orderBy('km')
            ->first();
    }
}
