<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function addresses()
    {
        return $this->hasMany('App\Address');
    }
}
