<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SingleController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

|
*/





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');





//kkkkkkkkkkkkkkkkkkkkkkkkkk
Route::get('about', function () {
    return view('About');
});



Route::get('contact', function () {
    return view('Contact');
});


Route::get('/404', function () {
    return view('404');
});


Route::get('/bmicalc', function () {
    return view('BmiCalc');
});


Route::get('/cart', function () {
    return view('Cart');
});


Route::get('/checkout', function () {
    return view('CheckOut');
});


Route::get('/single-product/{id}', [SingleController::class, 'index']);

Route::get('/', function () {
    return view('Index');
});


// Route::get('/profile', function () {
//     return view('Profile');
// });

Route::get('/profile', [CustomAuthController::class, 'profile']);


Route::get('/pt', function () {
    return view('PT');
});

Route::get('/registration', function () {
    return view('Registration');
});

Route::get('/shop', [ProductController::class, 'index']);


// visa

Route::get('/donate',  [DonationController::class, 'show']);

Route::post('/donate/details', [DonationController::class, 'store']);

Route::get('/donateshow',  [DonationController::class, 'showWithGet']);
