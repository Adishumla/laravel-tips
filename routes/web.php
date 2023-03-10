<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CreateResturantController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostRestaurantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PriceController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('login');
//login
Route::post('login', LoginController::class);

Route::get('/login', function () {
    return view('index');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/logout', function () {
    auth()->logout();
    return redirect()->intended('/login');
});
/* register */
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', RegisterController::class);

Route::post('/like', LikesController::class)->middleware('auth');

Route::post('/resturant', CreateResturantController::class)->middleware('auth');
