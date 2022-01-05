<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Track extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points()
    {
        return $this->hasMany(Point::class);
    }

    /**
     * @return array
     */
    public function getlatlongsAttribute()
    {
        //more efficient way? MySQL?
        /*foreach($this->points as $point){
            $latlongs[] = [unpack('x4/clat/Llat/dlat/dlon', $point->position)['lon'], unpack('x4/clat/Llat/dlat/dlon', $point->position)['lat']];

        };*/

        //try and do this in a SELECT

        $latlongs = \DB::table('points')
            ->select((\DB::raw('ST_X(position) as lat, ST_Y(position) as lon')))
            ->where('track_id',$this->id)->get();

        //select ST_X(position), ST_Y(position) from points where track_id = 7;
        return $latlongs;

        //https://medium.com/sysf/playing-with-geometry-spatial-data-type-in-mysql-645b83880331
    }


}
