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
        $this->middleware(['admin', 'auth'])->except('login');   // tạo middleware
    }

    public function show()    // show sp
    {
        $product = Product::all();  // tìm tất cả sản phẩm trong db

//    $pr1 = Product::find(14)->product_product_photo()->getAllImages();
//        dd($pr1);
        return view('admin.product.list')->with([//Lương sửa: thừa chữ shop. nhé   //đẩy trả view
                'product' => $product
            ]
        );
    }

    public function showadd()   // show add
    {
        $cata = Catalog::all();   //show cata
        $product = Product::all();  // show sản phẩm
        return view('admin.product.add')->with([    //đẩy ra view để show
            'cata' => $cata,
            'product' => $product
        ]);//Lương sửa: thừa chữ shop. nhé
    }

    public function add(Request $request)   //add sp
    {

//        dd($request->all());
        $rules = [    // luật
            'name' => 'string|required',
            'price' => 'numeric|required',
            'description' => 'string|max:3000|required',
            'brand' => 'required'
        ];

        $nbr = count($request->input('image')) - 1;  //đếm số ảnh add vào
        foreach (range(0, $nbr) as $index) {
            $rules['image.' . $index] = 'mimes:jpeg,jpg,png,gif|max:10000';  // điều kiện cho mỗi ảnh add vào
        }

        $messages = [
            '*.required' => ':attribute không được để trống',   // luật cho các trường khác
            'name.string' => ':attribute sai định dạng',
            'price.numberic' => ':attribute phải là số',
            'description.string' => ':attribute phải là string',
            'description.max' => ':attribute không được vượt quá 3000 ký tự'
        ];

        $validation = Validator::make($request->all(), $rules, $messages);   //so sánh với luật, nếu sai thì trả lại bước trước với lỗi
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $product = new Product();   // add sản phẩm
        $product->product_name = $request->name;  // add tên
        $product->price = $request->price;  // add giá
        $product->description = $request->input('description');  // add mô tả
        $product->brand = $request->brand;   // add thể loại
        $product->status = $request->rdoStatus;  // add trạng thái
        $product->catalog_id = $request->catalog;  // add cata
        $product->save();   // lưu lại

        if (Input::hasFile('image')) {   // nếu có ảnh ở input
            foreach (Input::file('image') as $file) {   // với mỗi ảnh
                $product_img = new ProductImages(); // add vào ảnh productimg
                if (isset($file)) {
                    $product_img->thumbnail_photo_link = $file->getClientOriginalName();  // add vào db link ảnh
                    $product_img->thumbnail_photo_name = $file->getClientOriginalName();  // add vào db tên ảnh
                    $file->move(public_path('images/'), $file->getClientOriginalName());  // đẩy ảnh vào folder
                    $product_img->save();  // lưu lại

                    $img = Image::make(public_path('/images/' . $file->getClientOriginalName()))->resize(320, 480)->insert(public_path('/images/watermark.png'));  // thêm watermark.png','bottom-left', 10, 10  để edit ảnh , chèn sđt
                    $img->save(); // lưu lại

                    $product_link = new ProductProductPhoto();  // add vào db product product photo
                    $product_link->product_photo_id = $product_img->product_photo_id;  // lưu theo id
                    $product_link->product_id = $product->id;
                    $product_link->save();
                }
            }
        }
        return redirect('/admin/product')->with('thongbao', 'Bạn đã thêm sản phẩm thành công');
    }

    public function showOne($id)
    {
        $cata = Catalog::all();  // show cata
        $product = Product::find($id);  // tìm theo sp
//        $product_product = ProductProductPhoto::find();
//        dd($product_product);
        $img_detail = $product->getAllImageInfo();  // lấy ảnh đại diện
//        dd($img_detail);
        return view('admin.product.edit', [   // đẩy qua view
            'pro' => $product,
            'cata' => $cata,
            'img_detail' => $img_detail,
//            'product_product' =>$product_product
        ]);

    }

    public function DelImg($id)
    {
        $img = ProductImages::find($id);  // tìm ảnh theo id
        $img->delete(); // xóa
        return redirect()->back()->with('thongbao', 'Bạn đã xóa ảnh thành công'); // thông báo xóa thành công
    }

    public function edit(Request $request, $id) // sửa sp
    {
        $rules = [ // luật
            'name' => 'string|required',
            'price' => 'numeric|required',
            'description' => 'string|max:3000|required',
            'brand' => 'required'
        ];

        $nbr = count($request->input('image')) - 1; // đếm số sp ở input
        foreach (range(0, $nbr) as $index) {
            $rules['image.' . $index] = 'mimes:jpeg,jpg,png,gif|max:10000'; // luật cho ảnh upload
        }

        $messages = [  // thông báo nếu phạm luật
            '*.required' => ':attribute không được để trống',
            'name.string' => ':attribute sai định dạng',
            'price.numberic' => ':attribute phải là số',
            'description.string' => ':attribute phải là string',
            'description.max' => ':attribute không được vượt quá 3000 ký tự'
        ];

        $validation = Validator::make($request->all(), $rules, $messages); // so sánh với luật
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();  // nếu lỗi thì back với thông báo lỗi
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
        $img_detail = Product::find($id)->getAllImageinfo();  // tìm ảnh đại diện theo id, xóa ảnh trước

        foreach ($img_detail as $item) {  // với mỗi ảnh
            File::delete(public_path('/images/'.$item->thumbnail_photo_link));  // tìm ảnh trong folder lưu và xóa
            ProductImages::find($item->product_photo_id)->delete();  // xóa ảnh trên db
        };
        Product::find($id)->delete(); // xóa sp
        return redirect('/admin/product')->with('thongbao', 'Bạn đã xóa sản phẩm thành công'); // thông báo
    }
}