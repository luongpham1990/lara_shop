<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Catalog;
use Validator;

class CataController extends Controller
{
    function __construct()
    {
        $this->middleware(['admin','auth'])->except('login');   // middleware
    }

    public function show()
    {

        $cata = Catalog::all();                         // show all catalog
        return view('admin.cata/list', ['cata' => $cata]);   // trả về view với biến $cata
    }

    public function showadd()  // show view để add
    {
        return view('admin.cata.add');   // view add cata
    }

    public function add(Request $request)  // thêm mới cata
    {
        $rules = [
            'name' => 'string|required'   // luật : name:  phải là string, ko đc để trống
        ];

        $messages = [
            'name.string' =>'Sai định dạng',
            'name.required' => 'Không thể để trống tên'
        ];   // thông báo lỗi khi phạm luật

        $validation = Validator::make($request->all(), $rules, $messages);   // check xem có phạm luật ko. nếu sai thì chạy vào dưới

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput(); // sai thì quay lại trang trước với thông báo lỗi
        }  // nếu khớp thì tạo mới catalog
        $cata = new Catalog();
        $cata->catalog_name = $request->name;   // lưu tên trong request vào db
        $cata->save();  // save

        return redirect('/admin/cata')->with('thongbao', 'Bạn đã thêm thành công'); // trả về trang danh sách với thong báo
    }

    public function showOne($id){   // show 1 cata để chuẩn bị sửa
        $cata=Catalog::find($id);   // tìm cata theo id
        return view('admin.cata.edit',['cata'=>$cata]);  // trả về view, đổ dữ liệu với biến cata
    }

    public function edit(Request $request,$id){    // sửa cata
        $rules =[
            'name'=>'string|required'
        ];    // luật

        $messages = [
            'name.string' =>'Sai định dạng',
            'name.required' => 'Không thể để trống tên'
        ];  // tạo thông báo lôi

        $validatior = Validator::make($request->all(), $rules, $messages);  // kiếm tra request gửi lên xem có phạm luật ko

        if ($validatior->fails()) {             // nếu phạm luật
            return response()->json(array(
                'errors' => $validatior->getMessageBag()->toArray()
            ));  // trả lại mảng thông báo lỗi dạng json

        } else { // nếu đúng thì chạy vào đây
            $cata= Catalog::find($request->id);   // tìm cata theo id
            $cata->catalog_name = $request->name;     // tìm đc cata theo id r thì cứ thế mà sửa tên thôi
            $cata->save();            // lưu lại
            return redirect('/admin/cata')->with('thongbao', 'Sửa thành công');   // trả về trang list với thông báo

        }
    }

    public function delete($id)   // xóa cata
    {
        Catalog::find($id)->delete();   // tìm cata theo id r delete
        return redirect('/admin/cata')->with('thongbao', 'Bạn đã xóa thành công'); // thông báo ở trang list
    }
}
