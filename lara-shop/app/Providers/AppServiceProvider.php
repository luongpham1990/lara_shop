<?php

namespace App\Providers;

use App\Cateblog;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $category = \App\Catalog::all();
//        $prodcuts = \App\Product::all();
        view()->share('categories',$category);
//        view()->share('products',$prodcuts);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
