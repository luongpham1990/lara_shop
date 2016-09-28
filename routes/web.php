<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('shop.home');
});
Route::get('/login', function(){
   return view('shop.login');
});


Route::get('/checkout', function(){
    return view('shop.checkout');
});

Route::get('/cart',function(){
   return view('shop.cart');
});


Route::get('/contact',function(){
   return view('shop.contact-us');
});


Route::get('/shop',function(){
    return view('shop.shop');
});


Route::get('/product-detail',function(){
    return view('shop.product-detail');
});