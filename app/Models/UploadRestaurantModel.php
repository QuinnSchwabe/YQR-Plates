<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadRestaurantModel extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'menu_link',
        'price_range',
        'food_type',
        'south_east',
        'south_west',
        'north_east',
        'north_west',
        'dine_in',
        'take_out',
        'delivery',
        'drive_thru',
    ];
}
