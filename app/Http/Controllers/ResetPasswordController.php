<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller 
{
    public function resetPassword(Request $request) {

        $email = $request->input('email');

        $fields = $request->validate([
            'email' => 'required|email',
            'birthday' => 'required|date',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
            'password_confirmation' => 'required'
        ],
        ['password.regex' => 'Must include : uppercase, lowercase, number and symbol']);

        $user = User::where('email', $fields['email'])->first();
                    
        if ($user) {
            if ($user->birthday->format('Y-m-d') == $fields['birthday']) {
                $user->password = Hash::make($fields['password']);
                $user->save();
                
            auth()->login($user);
            return redirect('/passwordreset')->with('password_reset_success', 'Your password has been reset.');
            }
            else {
                return back()->withErrors(['birthday' => 'Birthday does not match our records.']);
            }
        }
        else {
            return back()->withErrors(['email' => 'Email does not match our records.']);
        }
    }
}