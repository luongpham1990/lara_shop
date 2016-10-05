<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Product;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function show(){
        $product = Product::all();
        return view('admin.product.list')->with([
            'product' => $product]);
    }

    public function showadd()
    {
        return view('admin.product.add');
    }

    public function edit(Request $request, $id)
    {
        $rules = [
            'name' => 'string|required',
            'price' =>'numeric|required',
            'description' => 'string|max:3000|required',
//            'image' => 'required|mimes:jpg,png,jpeg,gif,bmp'
        ];

        $messages = [
            '*.required' =>':attribute không được để trống',
            'name.string'=>':attribute sai định dạng',
            'price.numberic'=>':attribute phải là số',
            'description.string' =>':attribute phải là string',
            'description.max'=>':attribute không được vượt quá 3000 ký tự',
//            'image.mimes' =>'Sai định dạng :attribute'
        ];


        $validation = Validator::make($request->all(),$rules,$messages);
        if ($validation->fails()) {
            return response()->json(array(
                'errors' => $validation->getMessageBag()->toArray()
            ));
        }
        $product= Product::find($request->id);

        $product->product_name= $request->name;
        $product->price= $request->price;
        $product->description= $request->input('description');
        $product->brand= $request->brand;
        $product->status= $request->status;
        $product->save();
        return redirect('/admin/product/list')->with('thongbao', 'Bạn đã sửa sản phẩm thành công');
    }

    public function showOne($id){
        $product=Product::find($id);
        return view('admin.product.edit',['pro'=>$product]);
    }

    public function add(Request $request)
    {
        $rules = [
            'name' => 'string|required',
            'price' =>'numeric|required',
            'description' => 'string|max:3000|required',
//            'image' => 'required|mimes:jpg,png,jpeg,gif,bmp'
        ];

        $messages = [
            '*.required' =>':attribute không được để trống',
            'name.string'=>':attribute sai định dạng',
            'price.numberic'=>':attribute phải là số',
            'description.string' =>':attribute phải là string',
            'description.max'=>':attribute không được vượt quá 3000 ký tự',
//            'image.mimes' =>'Sai định dạng :attribute'
        ];


        $validation = Validator::make($request->all(),$rules,$messages);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $product=new Product();
        $product->product_name= $request->name;
        $product->price= $request->price;
        $product->description= $request->input('description');
        $product->brand= $request->brand;
        $product->status= $request->status;
        $product->save();
        return redirect('/admin/product/list')->with('thongbao', 'Bạn đã thêm sản phẩm thành công');
    }


    public function delete($id)
    {
        Product::find($id)->delete();
        return redirect('/admin/product/list')->with('thongbao', 'Bạn đã xóa sản phẩm thành công');
    }

}
