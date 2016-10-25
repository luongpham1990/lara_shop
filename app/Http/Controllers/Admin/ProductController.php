<?php

namespace App\Http\Controllers\Admin;

use App\Catalog;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImages;
use Illuminate\Support\Facades\Storage;
use Input;
use Intervention\Image\Facades\Image;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\ProductProductPhoto;
use File;


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
            'product' => $product
        ]);//Lương sửa: thừa chữ shop. nhé
    }

    public function add(Request $request)
    {

//        dd($request->all());
        $rules = [
            'name' => 'string|required',
            'price' => 'numeric|required',
            'description' => 'string|max:3000|required',
            'brand' => 'required'
        ];

        $nbr = count($request->input('image')) - 1;
        foreach (range(0, $nbr) as $index) {
            $rules['image.' . $index] = 'mimes:jpeg,jpg,png,gif|max:10000';
        }

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

        if (Input::hasFile('image')) {
            foreach (Input::file('image') as $file) {
                $product_img = new ProductImages();
                if (isset($file)) {
                    $product_img->thumbnail_photo_link = $file->getClientOriginalName();
                    $product_img->thumbnail_photo_name = $file->getClientOriginalName();
                    $file->move(public_path('images/'), $file->getClientOriginalName());
                    $product_img->save();

                    $img = Image::make(public_path('/images/' . $file->getClientOriginalName()))->resize(320, 480)->insert(public_path('/images/watermark.png'));  // thêm watermark.png','bottom-left', 10, 10  để edit
                    $img->save();

                    $product_link = new ProductProductPhoto();
                    $product_link->product_photo_id = $product_img->product_photo_id;
                    $product_link->product_id = $product->id;
                    $product_link->save();
                }
            }
        }
        return redirect('/admin/product')->with('thongbao', 'Bạn đã thêm sản phẩm thành công');
    }

    public function showOne($id)
    {
        $cata = Catalog::all();
        $product = Product::find($id);
//        $product_product = ProductProductPhoto::find();
//        dd($product_product);
        $img_detail = $product->getAllImageInfo();
//        dd($img_detail);
        return view('admin.product.edit', [
            'pro' => $product,
            'cata' => $cata,
            'img_detail' => $img_detail,
//            'product_product' =>$product_product
        ]);

    }

    public function DelImg($id)
    {
        $img = ProductImages::find($id);
        $img->delete();
        return redirect()->back()->with('thongbao', 'Bạn đã xóa ảnh thành công');
    }

    public function edit(Request $request, $id)
    {
        $rules = [
            'name' => 'string|required',
            'price' => 'numeric|required',
            'description' => 'string|max:3000|required',
            'brand' => 'required'
        ];

        $nbr = count($request->input('image')) - 1;
        foreach (range(0, $nbr) as $index) {
            $rules['image.' . $index] = 'mimes:jpeg,jpg,png,gif|max:10000';
        }

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

        $product = Product::find($id);
        $product->product_name = $request->name;
        $product->price = $request->price;
        $product->description = $request->input('description');
        $product->brand = $request->brand;
        $product->status = $request->rdoStatus;
        $product->catalog_id = $request->catalog;
        $product->save();

        if (Input::hasFile('image')) {
            foreach (Input::file('image') as $file) {
                $product_img = new ProductImages();
                if (isset($file)) {
                    $product_img->thumbnail_photo_link = $file->getClientOriginalName();
                    $product_img->thumbnail_photo_name = $file->getClientOriginalName();
                    $file->move(public_path('images/'), $file->getClientOriginalName());

                    $product_img->save();
                    $img = Image::make(public_path('/images/' . $file->getClientOriginalName()))->resize(320, 480)->insert(public_path('/images/watermark.png'));  // thêm watermark.png','bottom-left', 10, 10  để edit
                    $img->save();

                    $product_link = new ProductProductPhoto();
                    $product_link->product_photo_id = $product_img->id;
                    $product_link->product_id = $product->id;
                    $product_link->save();
                }
            }
        }
        return redirect('/admin/product')->with('thongbao', 'Bạn đã sửa sản phẩm thành công');
    }


    public function delete($id)
    {
        $img_detail = Product::find($id)->getAllImageinfo();

        foreach ($img_detail as $item) {
            File::delete(public_path('/images/'.$item->thumbnail_photo_link));
            ProductImages::find($item->product_photo_id)->delete();
        };
        Product::find($id)->delete();
        return redirect('/admin/product')->with('thongbao', 'Bạn đã xóa sản phẩm thành công');
    }
}