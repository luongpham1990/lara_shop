<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Catalog;
use Validator;

class CataController extends Controller
{
    public function show()
    {

        $cata = Catalog::all();
        return view('shop.admin.cata.show', ['cata' => $cata]);
    }

    public function showadd()
    {
        return view('shop.admin.cata.add');
    }

    public function add(Request $request)
    {
        $rules = [
            'name' => 'string|required'
        ];

        $messages = [
            'name.string' =>'Sai định dạng',
            'name.required' => 'Không thể để trống tên'
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
//        dd("abc");

        $cata = new Catalog();
        $cata->name = $request->name;
        $cata->save();

        return redirect('/admin/cata/show')->with('thongbao', 'Bạn đã thêm thành công');

    }

    public function showOne($id){
        $cata=Catalog::find($id);
        return view('shop.admin.cata.edit',['cata'=>$cata]);
    }

    public function edit(Request $request,$id){
        $rules =[
            'name'=>'string|required'
        ];

        $messages = [
            'name.string' =>'Sai định dạng',
            'name.required' => 'Không thể để trống tên'
        ];

        $validatior = Validator::make($request->all(), $rules, $messages);

        if ($validatior->fails()) {
            return response()->json(array(
                'errors' => $validatior->getMessageBag()->toArray()
            ));

        } else {
            $cata= Catalog::find($request->id);
            $cata->name = ($request->name);
            $cata->save();
            return redirect('/admin/cata/show')->with('thongbao', 'Sửa thành công');

        }
    }

    public function delete($id)
    {
        Catalog::find($id)->delete();
        return redirect('/admin/cata/show')->with('thongbao', 'Bạn đã xóa thành công');
    }
}
