<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Track extends Model
{
    use HasFactory;


    public function points()
    {
        return $this->hasMany(Point::class);
    }
}
