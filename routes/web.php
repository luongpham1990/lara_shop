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
Route::get('/edit/{id}', 'UsersController@profile');
//Lương sửa
Route::put('/edit/{id}','UsersController@changePass');

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
//Lương sửa
Route::group(['prefix' => 'admin', 'middleware' => ['admin','auth']], function(){
    Route::get('/login', function (){
        return view('admin.login');
    });
    Route::post('/login','Admin\UserController@login');
    Route::post('/logout', 'Admin\UserController@logout');
//Hùng sửa
    Route::group(['prefix' => 'cata'], function(){
        Route::get('list','Admin\CataController@show');

        Route::get('add','Admin\CataController@showadd');
        Route::post('add','admin\CataController@add');

        Route::get('edit/{id}','Admin\CataController@showOne');
        Route::put('edit/{id}','Admin\CataController@edit');

        Route::delete('delete/{id}','Admin\CataController@delete');
    });
//Hùng sửa
    Route::group(['prefix' => 'product'], function () {
        Route::get('list','Admin\ProductController@show');

        Route::get('add','Admin\ProductController@showadd');
        Route::post('add','Admin\ProductController@add');

        Route::get('edit/{id}', 'Admin\ProductController@showOne');
        Route::put('edit/{id}', 'Admin\ProductController@edit');

        Route::delete('delete/{id}', 'Admin\ProductController@delete');
    });
//Lương sửa
    Route::group(['prefix' => 'user'], function () {
        Route::get('list','Admin\UserController@show');

        Route::get('add','Admin\UserController@showadd');
        Route::post('add','Admin\UserController@add');

        Route::get('edit/{id}', 'Admin\UserController@showOne');
        Route::put('edit/{id}', 'Admin\UserController@edit');

        Route::delete('delete/{id}', 'Admin\UserController@delete');
    });
});