<?php

namespace App\Observers;

use App\Models\Restaurant;
use App\Models\Preference;
use App\Models\Dashboard;

class RestaurantObserver
{
    /**
     * Handle the Restaurant "created" event.
     */
    public function created(Restaurant $restaurant): void
    {
        $preferences = Preference::all();
        $food_types = 0;
        $restaurant_types = 0;
        $neighborhoods = 0;
        $price_ranges = 0;
        foreach ($preferences as $preference) {
            $dashboard = Dashboard::where('user_id', $preference->user_id)->first();
            if($restaurant->food_type == $preference->food_type){
                $food_types++;
                $dashboard->update(['d_food_type' => $dashboard->d_food_type + 1]);
            }
            if($restaurant->price_range == $preference->price_range){
                $price_ranges++;
                $dashboard->update(['d_price_range' => $dashboard->d_price_range + 1]);
            }
            if($restaurant->south_west && $preference->south_west){
                $neighborhoods++;
                $dashboard->update(['d_neighborhoods' => $dashboard->d_neighborhoods + 1]);
            }
            elseif($restaurant->south_east && $preference->south_east){
                $neighborhoods++;
                $dashboard->update(['d_neighborhoods' => $dashboard->d_neighborhoods + 1]);
            }
            elseif($restaurant->north_west && $preference->north_west){
                $neighborhoods++;
                $dashboard->update(['d_neighborhoods' => $dashboard->d_neighborhoods + 1]);
            }
            elseif($restaurant->north_east && $preference->north_east){
                $neighborhoods++;
                $dashboard->update(['d_neighborhoods' => $dashboard->d_neighborhoods + 1]);
            }
            if ($restaurant->dine_in && $preference->dine_in){
                $restaurant_types++;
               $dashboard->update(['d_restaurant_types' => $dashboard->d_restaurant_types + 1]);
            }
            elseif ($restaurant->drive_thru && $preference->drive_thru){
                $restaurant_types++;
                $dashboard->update(['d_restaurant_types' => $dashboard->d_restaurant_types + 1]);
            }
            elseif ($restaurant->delivery && $preference->delivery){
                $restaurant_types++;
                $dashboard->update(['d_restaurant_types' => $dashboard->d_restaurant_types + 1]);
            }
            elseif ($restaurant->take_out && $preference->take_out){
                $restaurant_types++;
                $dashboard->update(['d_restaurant_types' => $dashboard->d_restaurant_types + 1]);
            $dashboard->save();
        }
    }
    Dashboard::firstOrCreate(
        ['user_id' => $restaurant->user_id],
        [
        'user_id' => $restaurant->user_id,
        'd_food_type' => $food_types,
        'd_neighborhoods' => $neighborhoods,
        'd_restaurant_types' => $restaurant_types,
        'd_price_range' => $price_ranges
]);
}

    /**
     * Handle the Restaurant "updated" event.
     */
    public function updated(Restaurant $restaurant): void
    {
        $preferences = Preference::all();
        $oldRestaurant = $restaurant->getOriginal();
        $userDashboard = Dashboard::where('user_id', $restaurant->user_id);
        $food_types = 0;
        $restaurant_types = 0;
        $neighborhoods = 0;
        $price_ranges = 0;
        foreach($preferences as $preference){
            $dashboard = Dashboard::where('user_id', $preference->user_id)->first();
            $current = false;
            $increase = false;
            $decrease = false;
            if(($oldRestaurant['food_type'] == $preference->food_type) && ($preference->food_type == $restaurant->food_type)) {
                    $current = true;
            }
            elseif(($oldRestaurant['food_type'] == $preference->food_type) && ($preference->food_type != $restaurant->food_type)) {
                    $decrease = true;
            }
            elseif(($oldRestaurant['food_type'] != $preference->food_type) && ($preference->food_type == $restaurant->food_type)) {
                    $increase = true;
            }
            if($current) {
                    $food_types++;
            }
            elseif($increase) {
                    $dashboard->increment('d_food_type');
                    $food_types++;
            }
            elseif($decrease){
                    $dashboard->decrement('d_food_type');
            }
            $current = false;
            $increase = false;
            $decrease = false;
            if(($oldRestaurant['price_range'] == $preference->price_range) && ($preference->price_range == $restaurant->price_range)) {
                    $current = true;
            }
            elseif(($oldRestaurant['price_range'] == $preference->price_range) && ($preference->price_range != $restaurant->price_range)) {
                    $decrease = true;
            }
            elseif(($oldRestaurant['price_range'] != $preference->price_range) && ($preference->price_range == $restaurant->price_range)) {
                    $increase = true;
            }
            if($current) {
                    $price_ranges++;
            }
            elseif($increase) {
                    $dashboard->increment('d_price_range');
                    $price_ranges++;
            }
            elseif($decrease){
                    $dashboard->decrement('d_price_range');
            }
            $current = false;
            $increase = false;
            $decrease = false;

            if($oldRestaurant['south_west'] && $restaurant->south_west && $preference->south_west)
                $current = true;
            elseif($oldRestaurant['south_west'] && $restaurant->south_west && !$preference->south_west)
                $decrease = true;
            elseif(!$oldRestaurant['south_west'] && $restaurant->south_west && $preference->south_west)
                $increase = true;
            if($oldRestaurant['south_east'] && $restaurant->south_east && $preference->south_east)
                $current = true;
            elseif($oldRestaurant['south_east'] && $restaurant->south_east && !$preference->south_east)
                $decrease = true;
            elseif(!$oldRestaurant['south_east'] && $restaurant->south_east && $preference->south_east)
                $increase = true;
            if($oldRestaurant['north_east'] && $restaurant->north_east && $preference->north_east)
                $current = true;
            elseif($oldRestaurant['north_east'] && $restaurant->north_east && !$preference->north_east)
                $decrease = true;
            elseif(!$oldRestaurant['north_east'] && $restaurant->north_east && $preference->north_east)
                $increase = true;
            if($oldRestaurant['north_west'] && $restaurant->north_west && $preference->north_west)
                $current = true;
            elseif($oldRestaurant['north_west'] && $restaurant->north_west && !$preference->north_west)
                $decrease = true;
            elseif(!$oldRestaurant['north_west'] && $restaurant->north_west && $preference->north_west)
                $increase = true;
            if($current) {
                    $neighborhoods++;
            }
            elseif($increase) {
                    $dashboard->increment('d_neighborhoods');
                    $neighborhoods++;
            }
            elseif($decrease){
                    $dashboard->decrement('d_neighborhoods');
            }
            $current = false;
            $increase = false;
            $decrease = false;

            if($oldRestaurant['dine_in'] && $restaurant->dine_in && $preference->dine_in)
                $current = true;
            elseif($oldRestaurant['dine_in'] && $restaurant->dine_in && !$preference->dine_in)
                $decrease = true;
            elseif(!$oldRestaurant['dine_in'] && $restaurant->dine_in && $preference->dine_in)
                $increase = true;
            if($oldRestaurant['drive_thru'] && $restaurant->drive_thru && $preference->drive_thru)
                $current = true;
            elseif($oldRestaurant['drive_thru'] && $restaurant->drive_thru && !$preference->drive_thru)
                $decrease = true;
            elseif(!$oldRestaurant['drive_thru'] && $restaurant->drive_thru && $preference->drive_thru)
                $increase = true;
            if($oldRestaurant['take_out'] && $restaurant->take_out && $preference->take_out)
                $current = true;
            elseif($oldRestaurant['take_out'] && $restaurant->take_out && !$preference->take_out)
                $decrease = true;
            elseif(!$oldRestaurant['take_out'] && $restaurant->take_out && $preference->take_out)
                $increase = true;
            if($oldRestaurant['delivery'] && $restaurant->delivery && $preference->delivery)
                $current = true;
            elseif($oldRestaurant['delivery'] && $restaurant->delivery && !$preference->delivery)
                $decrease = true;
            elseif(!$oldRestaurant['delivery'] && $restaurant->delivery && $preference->delivery)
                $increase = true;
            if($current) {
                    $restaurant_types++;
            }
            elseif($increase) {
                    $dashboard->increment('d_restaurant_types');
                    $restaurant_types++;
            }
            elseif($decrease){
                    $dashboard->decrement('d_restaurant_types');
            }
        }

        $userDashboard->update([
            'd_food_type' => $food_types,
            'd_neighborhoods' => $neighborhoods,
            'd_restaurant_types' => $restaurant_types,
            'd_price_range' => $price_ranges
    ]);
    }
}
