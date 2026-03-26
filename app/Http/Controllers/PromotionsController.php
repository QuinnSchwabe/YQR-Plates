<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Validation\Rule;

class PromotionsController extends Controller 
{

    public function index()
    {
        return view('promotions');
    }
    
    public function create() {
        return view('createPromotion');
    }

    public function addPromotion(Request $request)
    {   
        $fields = $request->validate([
            'promotion_entry' => ['required', 'min:5', 'max:255'],
            'promotion_type' => ['required', Rule::in(['happy hour', 'limited time', 'daily deal'])],
        ]);
        
        $promotiontext = '';
        if($request->input('promotion_entry') != NULL) {
            $promotiontext = $request->input('promotion_entry');
        }

        Promotion::create([
            'restaurant_id' => $request->restaurant_id,
            'promotion' => $request->promotion_entry,
            'promotion_type' => $request->promotion_type
        ]);

        return redirect()->back()->with('added', 'Successful action.');
    }

    public function removePromotion(Request $request)
    {
        $request->validate([
            'promotion_id' => 'required|exists:promotions,id',
        ]);

        $promotion = Promotion::find($request->promotion_id);

        $promotion->delete();         
        return redirect()->back()->with('success', 'Promotion removed successfully!');

    }

}  