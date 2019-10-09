<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function coordinate()
    {
        return $this->hasOne('App\Coordinate');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

}
