<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function restaurant()
    {
        return $this->hasOne('App\Coordinate');
    }
}
