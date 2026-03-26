<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Preference;

class PreferencesController extends Controller{
    public function index() {
        return view('editpreferences');
    }

    public function create() {
        return view('createpreferences');
    }

    public function store(Request $request){

        if(empty($request->input('food_type')))
            $food_type = "None";
        else
            $food_type = $request->input('food_type');
        if(empty($request->input('price_range')))
            $price_range = "None";
        else
            $price_range = $request->input('price_range');
        
        if(!empty($request->input('neighborhood'))){
        $south_east = in_array("South East", $request->input('neighborhood'));
        $south_west = in_array("South West", $request->input('neighborhood'));
        $north_east = in_array("North East", $request->input('neighborhood'));
        $north_west = in_array("North West", $request->input('neighborhood'));
        }
        else{
            $south_east = false;
            $south_west = false;
            $north_east = false;
            $north_west = false;
        }
        if(!empty($request->input('restaurant_type'))){
        $dine_in = in_array("Dine In", $request->input('restaurant_type'));
        $take_out = in_array("Take Out", $request->input('restaurant_type'));
        $delivery = in_array("Delivery", $request->input('restaurant_type'));
        $drive_thru = in_array("Drive Thru", $request->input('restaurant_type'));
        }
        else{
            $dine_in = false;
            $take_out = false;
            $delivery = false;
            $drive_thru = false;
        }

        Preference::create([
            'user_id' => (int)$request->input('user_id'),
            'price_range' => $price_range,
            'food_type' => $food_type,
            'south_east' => $south_east,
            'south_west' => $south_west,
            'north_east' => $north_east,
            'north_west' => $north_west,
            'dine_in' => $dine_in,
            'take_out' => $take_out,
            'delivery' => $delivery,
            'drive_thru' => $drive_thru
        ]);

        return redirect('profile');
    }

    public function update(Request $request) {
        $preference = Preference::find($request->input('id'));
        if(empty($request->input('food_type')))
            $food_type = "None";
        else
            $food_type = $request->input('food_type');
        if(empty($request->input('price_range')))
            $price_range = "None";
        else
            $price_range = $request->input('price_range');
        
        if(!empty($request->input('neighborhood'))){
        $south_east = in_array("South East", $request->input('neighborhood'));
        $south_west = in_array("South West", $request->input('neighborhood'));
        $north_east = in_array("North East", $request->input('neighborhood'));
        $north_west = in_array("North West", $request->input('neighborhood'));
        }
        else{
            $south_east = false;
            $south_west = false;
            $north_east = false;
            $north_west = false;
        }
        if(!empty($request->input('restaurant_type'))){
        $dine_in = in_array("Dine In", $request->input('restaurant_type'));
        $take_out = in_array("Take Out", $request->input('restaurant_type'));
        $delivery = in_array("Delivery", $request->input('restaurant_type'));
        $drive_thru = in_array("Drive Thru", $request->input('restaurant_type'));
        }
        else{
            $dine_in = false;
            $take_out = false;
            $delivery = false;
            $drive_thru = false;
        }

        $preference->update([
            'price_range' => $price_range,
            'food_type' => $food_type,
            'south_east' => $south_east,
            'south_west' => $south_west,
            'north_east' => $north_east,
            'north_west' => $north_west,
            'dine_in' => $dine_in,
            'take_out' => $take_out,
            'delivery' => $delivery,
            'drive_thru' => $drive_thru
        ]);

        return redirect('profile');
    }
}