<?php

namespace App\Http\Controllers;

use App\Catalog;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductProductPhoto;
use App\ProductImages;

class ShopController extends Controller //chuyen de viet nhung cai hien thi ngoai front end cua anh hUng
{
    //

    public function index()
    {
        $products = Product::paginate(6);
        $categories = Catalog::all();
        $relate_products = Product::paginate(4);

        return view('shop.home')->with([
            'products' => $products,
            'categories' => $categories,
            'relate_products' => $relate_products
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
