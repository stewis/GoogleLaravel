<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    public function address()
    {
        return $this->belongsTo('App\Address');
    }
}
