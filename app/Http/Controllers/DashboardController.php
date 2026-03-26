<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function seeDashboard() {
        $restaurants = Restaurant::all();
        return view('dashboard', compact( 'restaurants'));
    }

    public function viewMatches(Request $request)  {
        $storedRestaurants = Restaurant::all();
        $restaurants = collect();
        $matches = collect(json_decode($request->input("matches"), true));
        foreach($storedRestaurants as $restaurant){
            foreach ($matches as $match) {
                if ($match['name'] == $restaurant->name){
                    $restaurants->push($restaurant);
                }
        }
    }
        $restaurants = $restaurants->sortBy('name');
        return view('restaurants.index', compact('restaurants'));
    }
}
