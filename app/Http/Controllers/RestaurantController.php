<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all()->sortBy('name');
        return view('restaurants.index', compact('restaurants'));
    }

    public function details($restaurantid)
    {
        $restaurant = Restaurant::find($restaurantid);
        return view('restaurants.details', compact('restaurant'));
    }
}