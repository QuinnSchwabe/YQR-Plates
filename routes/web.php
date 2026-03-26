<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\PreferencesController;
use App\Http\Controllers\UploadRestaurantController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\PromotionsController;

Route::get('/', function () {
    return view('app');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/signin', function () {
    return view('signin');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/resetpassword', function () {
    return view('resetpassword');
});

Route::get('/createpreferences', function () {
    return view('createpreferences');
});

Route::get('/editpreferences', function () {
    return view('editpreferences');
});

Route::get('/suggestion', function () {
    return view('suggestion');
});

Route::get('/createrestaurant', function () {
    return view('createrestaurant');
});

Route::get('/editrestaurant', function () {
    return view('editrestaurant');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/passwordreset', function () {
    return view('passwordreset');
});

Route::get('/promotions', function () {
    return view('promotions');
});

Route::get('/suggestion', function () {
    return view('suggestion');
});

Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/details/{restaurantid}', [RestaurantController::class, 'details'])->name(name: 'restaurants.details');

Route::post('/createpreferences', [PreferencesController::class,'create'])->middleware('auth');
Route::post('/storepreferences', [PreferencesController::class,'store'])->middleware('auth');

Route::post('/editpreferences', [PreferencesController::class, 'index'])->middleware('auth');
Route::post('/updatepreferences', [PreferencesController::class,'update'])->middleware('auth');

Route::post('/createrestaurant', [UploadRestaurantController::class,'create'])->middleware('auth');
Route::post('/storerestaurant', [UploadRestaurantController::class,'store'])->middleware('auth');

Route::post('/editrestaurant', [UploadRestaurantController::class, 'index'])->middleware('auth');
Route::post('/updaterestaurant', [UploadRestaurantController::class,'update'])->middleware('auth');

Route::delete('/promotions', [PromotionsController::class, 'removePromotion'])->middleware('auth');
Route::post('/promotions', [PromotionsController::class, 'addPromotion'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'seeDashboard'])->name('dashboard');
Route::post('/dashboard', [DashboardController::class, 'seeDashboard'])->middleware('auth');
Route::post('/viewMatches', [DashboardController::class,'viewMatches'])->middleware('auth');

Route::post('/suggestion', [SuggestionController::class, 'index'])->middleware('auth')->name('suggestion');
Route::get('/getSuggestion', [SuggestionController::class,'getSuggestion']);
Route::post('/getSuggestion', [SuggestionController::class,'getSuggestion']);

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/signin', [SigninController::class, 'signin']);

Route::post('/logout', [SigninController::class, 'logout']);

Route::post('/profile', [ProfileController::class, 'seeProfile'])->middleware('auth');

Route::post('/resetpassword', [ResetPasswordController::class, 'resetPassword']);