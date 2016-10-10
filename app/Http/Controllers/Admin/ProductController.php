<?php

namespace App\Http\Controllers\Admin;

use App\Catalog;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImages;
use Input;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\ProductProductPhoto;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware(['admin', 'auth'])->except('login');
    }

    public function show()
    {
        $product = Product::all();

//    $pr1 = Product::find(14)->product_product_photo()->getAllImages();
//        dd($pr1);
        return view('admin.product.list')->with([//Lương sửa: thừa chữ shop. nhé
                'product' => $product
            ]
        );

    }

    public function showadd()
    {
        $cata = Catalog::all();
        $product = Product::all();
        return view('admin.product.add')->with([
            'cata' => $cata,
            'product' =>$product
        ]);//Lương sửa: thừa chữ shop. nhé
    }

    public function add(Request $request)
    {
        $rules = [
            'name' => 'string|required',
            'price' => 'numeric|required',
            'description' => 'string|max:3000|required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,bmp',
            'brand' =>'required'
        ];

        $messages = [
            '*.required' => ':attribute không được để trống',
            'name.string' => ':attribute sai định dạng',
            'price.numberic' => ':attribute phải là số',
            'description.string' => ':attribute phải là string',
            'description.max' => ':attribute không được vượt quá 3000 ký tự'
        ];

        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $product = new Product();
        $product->product_name = $request->name;
        $product->price = $request->price;
        $product->description = $request->input('description');
        $product->brand = $request->brand;
        $product->status = $request->rdoStatus;
        $product->catalog_id = $request->catalog;
        $product->save();

        $product_id = $product->id;

        if (Input::hasFile('image')) {
            foreach (Input::file('image') as $file) {
                $product_img = new ProductImages();
                if (isset($file)) {
                    $product_img->product_id = $product_id;
                    $product_img->thumbnail_photo_link = $file->getClientOriginalName();
                    $product_img->thumbnail_photo_name = $file->getClientOriginalName();
                    $file->move(public_path('images/'), $file->getClientOriginalName());
                    $product_img->save();
                    
                    $product_link = new ProductProductPhoto();

                    $product_link->product_photo_id = $product_img->id;
                    $product_link->product_id = $product->id;
                    $product_link->save();
                }
            }
        }

        return redirect('/admin/product/list')->with('thongbao', 'Bạn đã thêm sản phẩm thành công');
    }

    public function edit(Request $request, $id)
    {
        $rules = [
            'name' => 'string|required',
            'price' => 'numeric|required',
            'description' => 'string|max:3000|required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,bmp'
        ];

        $messages = [
            '*.required' => ':attribute không được để trống',
            'name.string' => ':attribute sai định dạng',
            'price.numberic' => ':attribute phải là số',
            'description.string' => ':attribute phải là string',
            'description.max' => ':attribute không được vượt quá 3000 ký tự',
//            'image.mimes' =>'Sai định dạng :attribute'
        ];


        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            return response()->json(array(
                'errors' => $validation->getMessageBag()->toArray()
            ));
        }
        $product = Product::find($request->id);

        $product->product_name = $request->name;
        $product->price = $request->price;
        $product->description = $request->input('description');
        $product->brand = $request->brand;
        $product->status = $request->status;

        $product_img = ProductImages::find($request->id);

        if (Input::hasFile('image')) {
            foreach (Input::file('image') as $file) {
                if (isset($file)) {
                    $product_img->thumbnail_photo_link = $file->getClientOriginalName();
                    $product_img->thumbnail_photo_name = $file->getClientOriginalName();
                    $file->move(public_path('images/'), $file->getClientOriginalName());
                    $product_img->save();
                }
            }
        }
        $product->save();
        return redirect('/admin/product/list')->with('thongbao', 'Bạn đã sửa sản phẩm thành công');
    }

    public function showOne($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit', ['pro' => $product]);
    }


    public function delete($id)
    {
        Product::find($id)->delete();
        return redirect('/admin/product/list')->with('thongbao', 'Bạn đã xóa sản phẩm thành công');
    }
}