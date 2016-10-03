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
//Lương sửa
Route::get('/home', function (){
    return view('shop.home');
});
//Lương sửa
Route::get('/register', function (){
   return view('shop.users.login');
});
//Lương sửa
Route::post('/register', 'UsersController@register');
//Lương sửa
Route::get('/login', function(){
   return view('shop.users.login');
});
//Lương sửa
Route::post('/login', 'UsersController@login');
//Lương sửa
Route::post('/logout', 'UsersController@logout');
//Lương sửa
Route::get('/verify/{confirmation_code}', 'UsersController@active');
//Lương sửa
Route::get('/edit/{id}',function (){
    return view('/shop.users.edit');
});
//Lương sửa
Route::put('/edit{id}','UsersController@edit');

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

Route::group(['prefix' => 'admin'], function(){
    Route::group(['prefix' => 'cata'], function(){
        Route::get('show','Admin\CataController@show');

        Route::get('add','Admin\CataController@showadd');
        Route::post('add','admin\CataController@add');

        Route::get('edit/{id}','Admin\CataController@showOne');
        Route::put('edit/{id}','Admin\CataController@edit');

        Route::delete('delete/{id}','Admin\CataController@delete');
    });
    Route::group(['prefix' => 'product'], function () {
        Route::get('list','Admin\ProductController@show');

        Route::get('add','Admin\ProductController@showadd');
        Route::post('add','Admin\ProductController@add');

        Route::get('edit/{id}', 'Admin\ProductController@showOne');
        Route::put('edit/{id}', 'Admin\ProductController@edit');

        Route::delete('delete/{id}', 'Admin\ProductController@delete');
    });
});