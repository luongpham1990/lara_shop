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

    public function showdetail($id)
    {
        $products = Product::all();
        $categories = Catalog::all();
        $product_detail = Product::find($id);

        $calalogs = Catalog::get();
        $list_recommends = [];

        foreach ($calalogs as $catalog) {
            $recommend_products = $catalog->products()->orderBy('view', 'desc')->take(3)->get();
            array_push($list_recommends, $recommend_products);
        }
//        dd($product_detail->getAllImage());

        return view('shop.product-detail')->with([
            'products' => $products,
            'categories' => $categories,
            'product_detail' => $product_detail,
            'recommend_products' => $list_recommends

        ]);
    }

    public function showcatalog($id)
    {
        $products = Product::paginate(2);
        $categories = Catalog::all();
        $product = Product::all();

        $all_catalogproducts = DB::table('products')->select('id', 'catalog_id', 'product_name', 'price', 'view', 'review', 'brand', 'status')->where('catalog_id', $id)->orderBy('view', 'DESC')->get();
        foreach ($all_catalogproducts as $all_catalogproducts){
        $img_id=$all_catalogproducts->id;
        $imgs = DB::table('product_photos')
            ->join('product_product_photos', 'product_photos.product_photo_id', '=', 'product_product_photos.product_photo_id')
            ->join('products', 'product_product_photos.product_id', '=', 'products.id')
            ->where('product_id',$img_id)
            ->first();
        }

        dd($imgs->thumbnail_photo_link);
        return view('shop.shop')->with([
            'products' => $products,
            'categories' => $categories,
            'all_catalogproducts' => $all_catalogproducts,
            'imgs' =>$imgs,
        ]);
    }
}
