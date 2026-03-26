<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Observers\PreferenceObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
 
#[ObservedBy([PreferenceObserver::class])]
class Preference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'price_range',
        'food_type',
        'south_east',
        'south_west',
        'north_east',
        'north_west',
        'dine_in',
        'take_out',
        'delivery',
        'drive_thru'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}