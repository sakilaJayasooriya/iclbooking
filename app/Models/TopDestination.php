<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopDestination extends Model
{
    protected $table   = 'top_destinations';
    public $timestamps = false;
    public $appends    = ['image_url'];

    public function getImageUrlAttribute()
    {
        return url('/').'/public/front/images/top_destinations/'.$this->attributes['image'];
    }
}
