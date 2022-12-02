<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('about', function () {
    return view('About');
});



Route::get('contact', function () {
    return view('Contact');
});


Route::get('/404', function () {
    return view('404');
});


Route::get('/bmiCalc', function () {
    return view('BmiCalc');
});


Route::get('/cart', function () {
    return view('Cart');
});


Route::get('/checkout', function () {
    return view('CheckOut');
});


Route::get('/single-product', function () {
    return view('Single-product');
});


Route::get('/', function () {
    return view('Index');
});


Route::get('/profile', function () {
    return view('Profile');
});

Route::get('/pt', function () {
    return view('PT');
});

Route::get('/registration', function () {
    return view('Registration');
});

Route::get('/shop', function () {
    return view('Shop');
});
