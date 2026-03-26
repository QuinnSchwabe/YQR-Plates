<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;
use App\Models\Preference;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Log;
class SuggestionController extends Controller
{
    public function index(){
        return view('suggestion');
    }
    public function getSuggestion(Request $request): RedirectResponse {
        $startTime = microtime(true);
        $user_id = (int)$request->input('user_id');
        $preference = Preference::where('user_id', $user_id)->first();
        $usePreferenece = $request->input("preference", false);
        $restaurants = Restaurant::all();
        $ids = [];
        foreach($restaurants as $restaurant){
            $ids[] = $restaurant->id;
            $food_type = true;
            $price_range = true;
            $neighborhood = false;
            $restaurant_type = false;
            if($user_id != null && $preference && $usePreferenece){
            if($preference->food_type == "None"){
                $food_type = true;
            }
            elseif((ucwords($restaurant->food_type) != ucwords($preference->food_type))){
                $food_type = false;
            }
            if($preference->price_range == "None"){
                $price_range = true;
            }
            elseif((ucwords($restaurant->price_range) != ucwords($preference->price_range))){
                $price_range = false;
            }
            if(!$preference->south_east && !$preference->south_west && !$preference->north_west && !$preference->north_east){
                $neighborhood = true;
            }
            elseif(($restaurant->south_east && $preference->south_east) || 
            ($restaurant->south_west && $preference->south_west) ||
            ($restaurant->north_east && $preference->north_east) || 
            ($restaurant->north_west && $preference->north_west)) {
                $neighborhood = true;
            }
            if(!$preference->dine_in && !$preference->take_out && !$preference->delivery && !$preference->drive_thru){
                $restaurant_type = true;
            }
            elseif(($restaurant->dine_in && $preference->dine_in) ||
            ($restaurant->take_out && $preference->take_out) ||
            ($restaurant->delivery && $preference->delivery) ||
            ($restaurant->drive_thru && $preference->drive_thru)){
                $restaurant_type = true;
            }
            if($food_type && $price_range && $neighborhood && $restaurant_type){
                $userRestaurants[] = $restaurant->id;
            }


            }
              
        }
        if($user_id != null && $preference && !empty($userRestaurants)){
        $userRandom = array_rand($userRestaurants);
        $randomUser = $userRestaurants[$userRandom];
        }
        if(!$preference && $usePreferenece)
        {
            return redirect('/suggestion')->with('error', 'You currently have no preferences, please create prefernces to use them');
        }
        if(empty($userRestaurants) && $user_id != null && $usePreferenece)
        {
            return redirect('/suggestion')->with('error', 'Sorry, no restaurants match your preferences.');
        }

        $randomNum = array_rand($ids);
        $randomRes = $ids[$randomNum];

        $endTime = microtime(true);
        $execTime = $endTime - $startTime;

        Log::info('Time to get suggestion: ' . round($execTime, 4) . ' seconds');


        if(!$usePreferenece)
        return redirect('restaurants/details/' . $randomRes);
        elseif($usePreferenece && !empty($userRestaurants))
        return redirect('restaurants/details/' . $randomUser);
    }
}