<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * Coordinate relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function coordinate()
    {
        return $this->hasOne('App\Coordinate');
    }

    /**
     * Restaurant relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

}
