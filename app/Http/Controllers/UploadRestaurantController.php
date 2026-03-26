<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Log;

class UploadRestaurantController extends Controller
{
    public function index() {
        return view('editrestaurant');
    }

    public function create() {
        return view('createrestaurant');
    }

    public function store(Request $request){
        $startTime = microtime(true);

        $request->validate([ 
            'restaurant_name' => ['required', Rule::unique('restaurants', 'name')],
            'user_id' => ['required', Rule::unique('restaurants', 'user_id')],
            'menulink' => 'nullable|url|required_without:menuimage',
            'menuimage' => 'nullable|file|mimes:jpeg,png,pdf|max:2048|required_without:menulink',
            'neighborhood' => 'required',
            'restaurant_type' => 'required',
            'price_range' => ['required', Rule::in(['Low', 'Medium', 'Medium High', 'High'])],
            'food_type' => ['required', Rule::in(['Fast Food', 'Canadian', 'Pizza', 'Greek', 'Indian', 'Sushi', 'Italian', 'Asian', 'Chinese','Thai','Vietnamese'])],
        ]);

        $menu_link = '';
        $south_east = in_array("South East", $request->input('neighborhood'));
        $south_west = in_array("South West", $request->input('neighborhood'));
        $north_east = in_array("North East", $request->input('neighborhood'));
        $north_west = in_array("North West", $request->input('neighborhood'));

        $dine_in = in_array("Dine In", $request->input('restaurant_type'));
        $take_out = in_array("Take Out", $request->input('restaurant_type'));
        $delivery = in_array("Delivery", $request->input('restaurant_type'));
        $drive_thru = in_array("Drive Thru", $request->input('restaurant_type'));

        if($request->hasFile('menuimage')){
        $filePath = $request->file('menuimage')->store('menus', 'public');
        $menu_link = 'https://www.yqrplates.com/storage/' . $filePath;
        }
        if($request->input('menulink') != NULL) {
            $menu_link = $request->input('menulink');
        }

        Restaurant::create([
            'user_id' => (int)$request->input('user_id'),
            'name' => $request->input('restaurant_name'),
            'menu_link' => $menu_link,
            'price_range' => $request->input('price_range'),
            'food_type' => $request->input('food_type'),
            'south_east' => $south_east,
            'south_west' => $south_west,
            'north_east' => $north_east,
            'north_west' => $north_west,
            'dine_in' => $dine_in,
            'take_out' => $take_out,
            'delivery' => $delivery,
            'drive_thru' => $drive_thru,
        ]);

        $endTime = microtime(true);
        $execTime = $endTime - $startTime;

        Log::info('Time to create restaurant: ' . round($execTime, 4) . ' seconds');

        return redirect('profile');
    }

    public function update(Request $request) {
        $restaurant = Restaurant::find($request->input('restaurant_id'));
            $request->validate([ 
                'restaurant_name' => ['required', Rule::unique('restaurants', 'name')->ignore($request->input('restaurant_id'))],
                'menulink' => 'nullable|url|required_without:menuimage',
                'menuimage' => 'nullable|file|mimes:jpeg,png,pdf|max:2048|required_without:menulink',
                'neighborhood' => 'required',
                'restaurant_type' => 'required',
                'price_range' => ['required', Rule::in(['Low', 'Medium', 'Medium High', 'High'])],
                'food_type' => ['required', Rule::in(['Fast Food', 'Canadian', 'Pizza', 'Greek', 'Indian', 'Sushi', 'Italian', 'Asian', 'Chinese', 'Thai', 'Vietnamese'])],
        ]); 
        
        $menu_link = '';
        $south_east = in_array("South East", $request->input('neighborhood'));
        $south_west = in_array("South West", $request->input('neighborhood'));
        $north_east = in_array("North East", $request->input('neighborhood'));
        $north_west = in_array("North West", $request->input('neighborhood'));

        $dine_in = in_array("Dine In", $request->input('restaurant_type'));
        $take_out = in_array("Take Out", $request->input('restaurant_type'));
        $delivery = in_array("Delivery", $request->input('restaurant_type'));
        $drive_thru = in_array("Drive Thru", $request->input('restaurant_type'));

        if($request->hasFile('menuimage')){
        $filePath = $request->file('menuimage')->store('menus', 'public');
        $menu_link = 'https://www.yqrplates.com/storage/' . $filePath;
        }
        if($request->input('menulink') != NULL) {
            $menu_link = $request->input('menulink');
        }



        $restaurant->update([
            'name' => $request->input('restaurant_name'),
            'menu_link' => $menu_link,
            'price_range' => $request->input('price_range'),
            'food_type' => $request->input('food_type'),
            'south_east' => $south_east,
            'south_west' => $south_west,
            'north_east' => $north_east,
            'north_west' => $north_west,
            'dine_in' => $dine_in,
            'take_out' => $take_out,
            'delivery' => $delivery,
            'drive_thru' => $drive_thru,
        ]);
    

        
        return redirect('profile');
    }
}
