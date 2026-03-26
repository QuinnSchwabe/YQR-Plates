<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Observers\RestaurantObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
 
#[ObservedBy([RestaurantObserver::class])]
class Restaurant extends Model
{
    use HasFactory;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promotions()
   {
    return $this->hasMany(Promotion::class);
   }
}