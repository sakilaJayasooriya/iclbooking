<?php

/**
 * StartingCities Model
 *
 * StartingCities Model manages StartingCities operation.
 *
 * @category   StartingCities
 * @package    vRent
 * @author     Techvillage Dev Team
 * @copyright  2020 Techvillage
 * @license
 * @version    2.7
 * @link       http://techvill.net
 * @since      Version 1.3
 * @deprecated None
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StartingCities extends Model
{
    protected $table   = 'starting_cities';
    public $timestamps = false;
    public $appends    = ['image_url'];

    public function getImageUrlAttribute()
    {
        return url('/').'/public/front/images/starting_cities/'.$this->attributes['image'];
    }
}
