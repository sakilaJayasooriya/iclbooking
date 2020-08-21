<?php

/**
 * PropertyType Model
 *
 * PropertyType Model manages PropertyType operation.
 *
 * @category   PropertyType
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

class PropertyType extends Model
{
    protected $table   = 'property_type';
    public $timestamps = false;
    public $appends    = ['image_url'];

    public function properties()
    {
        return $this->hasMany('App\Models\Properties', 'property_type', 'id');
    }
    public function getImageUrlAttribute()
    {
        return url('/').'/public/front/images/property_type/'.$this->attributes['image'];
    }
}
