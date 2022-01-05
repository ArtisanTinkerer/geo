<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    /**
     * https://stackoverflow.com/questions/37467050/convert-mysqls-point-to-text-in-php
     *
     * @return string
     */
    public function getlatitudeAttribute()
    {
        return unpack('x4/clat/Llat/dlat/dlon', $this->position)['lat'];
    }

    /**
     * @return string
     */
    public function getlongitudeAttribute()
    {
        return unpack('x4/clat/Llat/dlat/dlon', $this->position)['lon'];
    }


}
