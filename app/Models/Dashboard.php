<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dashboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'd_food_type',
        'd_neighborhoods',
        'd_restaurant_types',
        'd_price_range'
    ];
}
