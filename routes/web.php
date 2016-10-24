<?php

use App\Product;
use App\ProductImages;
use App\Catalog;

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

Route::get('/', 'ShopController@index');    // route đến trang chủ
//Lương sửa
//Route::get('/home', function () {
//    return view('shop.home');
//});
//Lương sửa
Route::get('/register', function () {
    return view('shop.users.login');
});
//Lương sửa
Route::post('/register', 'UsersController@register');
//Lương sửa
Route::get('/login', function () {
    return view('shop.users.login');
});
//Lương sửa
Route::post('/login', 'UsersController@login');
//Lương sửa
Route::post('/logout', 'UsersController@logout');
//Lương sửa
Route::get('/verify/{confirmation_code}', 'UsersController@active');
//Lương sửa
Route::group(['prefix' => 'user'], function () {
    //Lương sửa
    Route::get('/{id}/edit', 'UsersController@profile');
//Lương sửa
    Route::put('/{id}/changepass', 'UsersController@changePass');
//Lương sửa
    Route::put('/{id}/edit', 'UsersController@edit');
});

Route::get('/checkout', function () {
    return view('shop.checkout');
});                       // route trang check out

Route::get('/cart','ShopController@cart')->name('cart');   // route trang cart

Route::get('/mua-hang/{id}','ShopController@muahang');    // route mua hàng
Route::get('xoa-san-pham/{id}','ShopController@xoasanpham');   // route xóa sản phẩm trong giỏ hàng
Route::get('xoa-cart','ShopController@xoacart');                // route xóa cart
Route::get('/contact', function () {
    return view('shop.contact-us');
});

Route::get('/shop', function () {
    return view('shop.shop');
});

Route::get('catalog/{id}','ShopController@showcatalog');   // route sản phẩm theo cata
Route::get('products/{id}','ShopController@showdetail');   // route chi tiết sản phẩm

//Lương sửa
Route::group(['prefix' => 'admin'], function () {//route group truy cập theo đường dẫn host/admin
    Route::get('/home', function () {
        return view('admin.home');
    })->middleware('admin');
    Route::get('/login', function () {// show ra view đăng nhập vào admin /admin/login

//        Auth::logout();

        if(Auth::guest()){
            return view('admin.login');
        }else{
            return redirect('/admin/home');
        }

    });
    Route::post('/login', 'Admin\AdminController@login');//  đăng nhập vào admin /admin/login
    Route::post('/logout', 'Admin\AdminController@logout');//  view đăng xuất vào admin /admin/logout
    Route::get('/{id}/edit', 'Admin\AdminController@profile');// show ra view profile của admin /admin/{id}/edit
    Route::put('/{id}/edit', 'Admin\AdminController@editAdmin');// sửa profile của admin /admin/{id}/edit
//Hùng sửa
    Route::group(['prefix' => 'cata'], function () {//vào phần cata các sp của website /admin/cata
        Route::get('/', 'Admin\CataController@show'); // show ra view catalog các sp của website  /admin/cata

        Route::get('add', 'Admin\CataController@showadd');// show ra view thêm catalog các sp của website vào admin /admin/cata/add
        Route::post('add', 'admin\CataController@add');// thêm catalog các sp của website vào admin /admin/cata/add

        Route::get('/{id}/edit', 'Admin\CataController@showOne');//Lương sửa đường dẫn show catalog theo chuẩn resful
        Route::put('/{id}/edit', 'Admin\CataController@edit');//Lương sửa đường dẫn edit thông tin catalog theo chuẩn resful

        Route::delete('/{id}/delete', 'Admin\CataController@delete');//xóa sp
    });
//Hùng sửa
    Route::group(['prefix' => 'product'], function () {//vào phần các sp của website /admin/cata
        Route::get('/', 'Admin\ProductController@show');// show ra view list các sp của website v /admin/product/

        Route::get('add', 'Admin\ProductController@showadd');// show ra view add  các sp của website  /admin/product/add
        Route::post('add', 'Admin\ProductController@add');//  add  các sp của website  /admin/product/add

        Route::get('/{id}/edit', 'Admin\ProductController@showOne');//Lương sửa đường dẫn show sp theo chuẩn resful
        Route::put('/{id}/edit', 'Admin\ProductController@edit');//Lương sửa đường dẫn edit thông tin sp theo chuẩn resful

        Route::delete('/{id}/delete', 'Admin\ProductController@delete');//xóa sp
        Route::delete('/{id}/delimg','Admin\ProductController@DelImg');
    });
//Lương sửa
    Route::group(['prefix' => 'user'], function () {//phần admin điều chỉnh liên quan đến user của website đường dẫn /admin/user
        Route::get('/', 'Admin\UserController@show');//show ra danh sách user /admin/user/

        Route::get('/add', 'Admin\UserController@showadd');// show ra view add user của website  /admin/product/user
        Route::post('/add', 'Admin\UserController@add');//  add  các user của website /admin/product/user

        Route::get('/{id}/edit', 'Admin\UserController@showOne');// show ra view edit progile  các user của website  /admin/product/add
        Route::put('/{id}/edit', 'Admin\UserController@edit');// edit profile  các user của website  /admin/product/add
        Route::put('/edituser', 'Admin\UserController@editUser');//x editable edit user
        Route::delete('/{id}/delete', 'Admin\UserController@delete');//xóa user
    });
    //Lương sửa
    Route::group(['prefix' => 'catablog'], function () {//phần admin điều chỉnh liên quan đến user của website đường dẫn /admin/catablog
        Route::get('/', 'Admin\CatablogController@show');//show ra danh sách user /admin/catablog/

        Route::get('/add', 'Admin\CatablogController@showadd');// show ra view add user của website  /admin/user
        Route::post('/add', 'Admin\CatablogController@add');//  add  các user của website /admin/catablog

        Route::get('/{id}/edit', 'Admin\CatablogController@showOne');// show ra view edit profile  các user của website  /admin/product/add
        Route::put('/{id}/edit', 'Admin\CatablogController@edit');// edit profile  các user của website  /admin/catablog/add
//        Route::put('/edituser', 'Admin\CatablogController@editUser');//x editable edit user
        Route::delete('/{id}/delete', 'Admin\CatablogController@delete');//xóa user
    });
    //Lương sửa
    Route::group(['prefix' => 'post'], function () {//vào phần các sp của website /admin/post
        Route::get('/', 'Admin\PostController@show');// show ra view list các sp của website v /admin/post/

        Route::get('add', 'Admin\PostController@showadd');// show ra view add  các sp của website  /admin/post/add
        Route::post('add', 'Admin\PostController@add');//  add  các sp của website  /admin/post/add

        Route::get('/{id}/edit', 'Admin\PostController@showOne');//Lương sửa đường dẫn show sp theo chuẩn resful
        Route::put('/{id}/edit', 'Admin\PostController@edit');//Lương sửa đường dẫn edit thông tin sp theo chuẩn resful

        Route::delete('/{id}/delete', 'Admin\PostController@delete');//xóa sp
        Route::get('/{id}/delimg','Admin\PostController@DelImg');
    });
});

Route::get('/login/google', 'SocialiteController@redirectToGoogle');
Route::get('/google/callback', 'SocialiteController@getGoogleCallback');
Route::get('/login/facebook', 'SocialiteController@redirectToFacebook');
Route::get('/facebook/callback', 'SocialiteController@getFacebookCallback');
Route::get('/login/github', 'SocialiteController@redirectToGithub');
Route::get('/github/callback', 'SocialiteController@getGithubCallback');
