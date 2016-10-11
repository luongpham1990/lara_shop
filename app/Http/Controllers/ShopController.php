<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Catalog;
use App\Product;
use App\ProductProductPhoto;
use App\ProductImages;

use DB;

class ShopController extends Controller //chuyen de viet nhung cai hien thi ngoai front end cua anh hUng
{
    //

    public function index()
    {
        $products = Product::paginate(6);
        $categories = Catalog::all();
        $relate_products = Product::paginate(4);


        $list_recommends = [];


        $calalogs = Catalog::get();

        foreach ($calalogs as $catalog) {
            $recommend_products = $catalog->products()->orderBy('view', 'desc')->take(3)->get();
            array_push($list_recommends, $recommend_products);
        }


//        dd($arr);

        return view('shop.home')->with([
            'products' => $products,
            'categories' => $categories,
            'relate_products' => $relate_products,
            'recommend_products' => $list_recommends
        ]);
    }

    public function showdetail()
    {
        $products = Product::all();
        $categories = Catalog::all();
        $relate_products = Product::all();

        return view('shop.product-detail')->with([
            'products' => $products,
            'categories' => $categories,
            'relate_products' => $relate_products
        ]);

    }
}
