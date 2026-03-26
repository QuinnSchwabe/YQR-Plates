<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller 
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => ['required', 'min:1', 'max:12'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'birthday' => 'required|date|before_or_equal:today',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
            'password_confirmation' => 'required',
            'type' => 'required'
        ],
        
        ['password.regex' => 'Must include : uppercase, lowercase, number and symbol']);
        
        $fields['password'] = Hash::make($fields['password']);
        $user = User::create($fields);
        auth()->login($user);

        if ($user->type == 'customer') {
            return redirect('/createpreferences');
        }
        else {
            return redirect('/createrestaurant');
        }
    }
}
