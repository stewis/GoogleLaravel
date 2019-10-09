<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public static function findClosest(float $longitude, float $latitude) {
        return static::select('coordinates.*')
            ->selectRaw('ST_distance_sphere(position, POINT(' . $longitude . ', ' . $latitude . ')) / 1000 AS km')
            ->selectRaw('ST_AsText(position) AS lnglat')
            ->orderBy('km')
            ->first();
    }
}
