<?php

namespace App\Observers;

use App\Models\Preference;
use App\Models\Restaurant;
use App\Models\Dashboard;

class PreferenceObserver
{
    /**
     * Handle the Preference "created" event.
     */
    public function created(Preference $preference): void
    {
        $restaurants = Restaurant::all();
        $food_types = 0;
        $restaurant_types = 0;
        $neighborhoods = 0;
        $price_ranges = 0;
        
        foreach($restaurants as $restaurant){
                $dashboard = Dashboard::where('user_id', $restaurant->user_id)->first();
                if($dashboard){
                if($restaurant->food_type == $preference->food_type || $preference->food_type == "None"){
                        $food_types++;
                        $dashboard->update(['d_food_type' => $dashboard->d_food_type + 1]);
                }
                if($restaurant->price_range == $preference->price_range || $preference->price_range == "None"){
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
                if(!$preference->north_east && !$preference->south_east && !$preference->soutH_west && !$preference->north_west){
                        $neighborhoods++;
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
                }
                if(!$preference->dine_in && !$preference->drive_thru && !$preference->take_out && !$preference->delivery){
                        $restaurant_types++;
                }
                $dashboard->save();
        }
        }

        Dashboard::firstOrCreate(
                ['user_id' => $preference->user_id],
                [
                'user_id' => $preference->user_id,
                'd_food_type' => $food_types,
                'd_neighborhoods' => $neighborhoods,
                'd_restaurant_types' => $restaurant_types,
                'd_price_range' => $price_ranges
        ]);
    }

    /**
     * Handle the Preference "updated" event.
     */
    public function updated(Preference $preference): void
    {
        $oldPreference = $preference->getOriginal();
        $userDashboard = Dashboard::where('user_id', $preference->user_id);
        $restaurants = Restaurant::all();
        $food_types = 0;
        $restaurant_types = 0;
        $neighborhoods = 0;
        $price_ranges = 0;
        $count = 0;
        foreach($restaurants as $restaurant){
        $count++;
        $dashboard = Dashboard::where('user_id', $restaurant->user_id)->first();
        $current = false;
        $increase = false;
        $decrease = false;
        if(($oldPreference['food_type'] == $restaurant->food_type) && ($preference->food_type == $restaurant->food_type)) {
                $current = true;
        }
        elseif(($oldPreference['food_type'] == $restaurant->food_type) && ($preference->food_type != $restaurant->food_type)) {
                $decrease = true;
        }
        elseif(($oldPreference['food_type'] != $restaurant->food_type) && ($preference->food_type == $restaurant->food_type)) {
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
        if(($oldPreference['price_range'] == $restaurant->price_range) && ($preference->price_range == $restaurant->price_range)) {
                $current = true;
                }
                elseif(($oldPreference['price_range'] == $restaurant->price_range) && ($preference->price_range != $restaurant->price_range)) {
                $decrease = true;
                }
                elseif(($oldPreference['price_range'] != $restaurant->price_range) && ($preference->price_range == $restaurant->price_range)) {
                         $increase = true;
                }
        if($current && !$increase) {
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
        
                if($oldPreference['south_west'] && $restaurant->south_west && $preference->south_west)
                        $current = true;
                elseif($oldPreference['south_west'] && $restaurant->south_west && !$preference->south_west)
                        $decrease = true;
                elseif(!$oldPreference['south_west'] && $restaurant->south_west && $preference->south_west)
                        $increase = true;
                if($oldPreference['south_east'] && $restaurant->south_east && $preference->south_east)
                        $current = true;
                elseif($oldPreference['south_east'] && $restaurant->south_east && !$preference->south_east)
                        $decrease = true;
                elseif(!$oldPreference['south_east'] && $restaurant->south_east && $preference->south_east)
                        $increase = true;
                if($oldPreference['north_west'] && $restaurant->north_west && $preference->north_west)
                        $current = true;
                elseif($oldPreference['north_west'] && $restaurant->north_west && !$preference->north_west)
                        $decrease = true;
                elseif(!$oldPreference['north_west'] && $restaurant->north_west && $preference->north_west)
                        $increase = true;
                if($oldPreference['north_east'] && $restaurant->north_east && $preference->north_east)
                        $current = true;
                elseif($oldPreference['north_east'] && $restaurant->north_east && !$preference->north_east)
                        $decrease = true;
                elseif(!$oldPreference['north_east'] && $restaurant->north_east && $preference->north_east)
                        $increase = true;
                
                
                if($current) {
                        $neighborhoods = $neighborhoods + 1;
                }
                elseif($increase) {
                        $dashboard->increment('d_neighborhoods');
                        $neighborhoods = $neighborhoods + 1;
                }
                elseif($decrease){
                        $dashboard->decrement('d_neighborhoods');
                }

        $current = false;
        $increase = false;
        $decrease = false;

        if($oldPreference['drive_thru'] && $restaurant->drive_thru && $preference->drive_thru)
                $current = true;
        elseif($oldPreference['drive_thru'] && $restaurant->drive_thru && !$preference->drive_thru)
                $decrease = true;
        elseif(!$oldPreference['drive_thru'] && $restaurant->drive_thru && $preference->drive_thru)
                $increase = true;
        if($oldPreference['take_out'] && $restaurant->take_out && $preference->take_out)
                $current = true;
        elseif($oldPreference['take_out'] && $restaurant->take_out && !$preference->take_out)
                $decrease = true;
        elseif(!$oldPreference['take_out'] && $restaurant->take_out && $preference->take_out)
                $increase = true;
        if($oldPreference['dine_in'] && $restaurant->dine_in && $preference->dine_in)
                $current = true;
        elseif($oldPreference['dine_in'] && $restaurant->dine_in && !$preference->dine_in)
                $decrease = true;
        elseif(!$oldPreference['dine_in'] && $restaurant->dine_in && $preference->dine_in)
                $increase = true;
        if($oldPreference['delivery'] && $restaurant->delivery && $preference->delivery)
                $current = true;
        elseif($oldPreference['delivery'] && $restaurant->delivery && !$preference->delivery)
                $decrease = true;
        elseif(!$oldPreference['delivery'] && $restaurant->delivery && $preference->delivery)
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
        if($food_types == 0)
                $food_types = $count;
        if($neighborhoods == 0)
                $neighborhoods = $count;
        if($restaurant_types == 0)
                $restaurant_types = $count;
        if($price_ranges == 0)
                $price_ranges = $count;

        $userDashboard->update([
                'd_food_type' => $food_types,
                'd_neighborhoods' => $neighborhoods,
                'd_restaurant_types' => $restaurant_types,
                'd_price_range' => $price_ranges
        ]);
    }
}
