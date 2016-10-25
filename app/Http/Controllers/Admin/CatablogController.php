<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Cateblog;
//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Requests;
use Image;

class CatablogController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(['admin','auth'])->except('login');
    }

    function show() {
        $Cateblog = Cateblog::all();
        return view('admin.catablog.list', ['blog' => $Cateblog]);
    }

    function showadd() {
        return view('admin.catablog.add');
    }

    function add(Request $request) {
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|min:20'
        ];
        $messages = [
            '*.required' => ':attribute là bắt buộc',
            '*.min' => ':attribute phải ít nhất :min kí tự'
        ];

        $validation = Validator::make($request->all(),$rules,$messages);

        if ($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }else{
            $cateblog = new Cateblog();
            $cateblog->name =$request->name;
            $cateblog->slug = str_slug($request->name);
            $cateblog->description = $request->description;
            if ($request->hasFile('banner')){
                $banner = $request->file('banner');
                $filename = uniqid().'_banner'.$banner->getClientOriginalName();

                Image::make($banner)->resize(500,500)->save(public_path('images/blog/' . $filename));
                $cateblog->image = url('images/blog'. $filename);
            }
            $cateblog->save();
            return redirect('/admin/catablog/add')->with('alert','Tạo mới thành công');
        }
    }

    function showOne ($id) {
        $catablog = Cateblog::find($id);
        return view('admin.catablog.edit',['data' => $catablog]);
    }

    function edit(Request $request, $id){
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|min:20'
        ];
        $messages = [
            '*.required' => ':attribute là bắt buộc',
            '*.min' => ':attribute phải ít nhất :min kí tự'
        ];

        $validation = Validator::make($request->all(),$rules,$messages);

        if ($validation->fails()){
            return redirect()->back()->withErrors($validation->getMessageBag()->all(), 'Oops') ->persistent('Close');
        }else{
            $cateblog = Cateblog::find($id);

            $cateblog->name = $request->name;
            $cateblog->description = $request->description;
            if ($request->hasFile('banner')){
                $banner = $request->file('banner');
                $filename = uniqid().'_banner'.$banner->getClientOriginalName();

                Image::make($banner)->resize(500,500)->save(public_path('/images/blog'.$filename));
                $cateblog->image = url(public_path('/images/blog'.$filename));
            }
            $cateblog->save();
            return redirect('/admin/catablog/{id}/edit')->with('alert','Sửa thành công');
        }
    }

    function delete($id) {
        Cateblog::find($id)->delete();
        return request('/admin/catablog')->with('alert','Xóa thành công');
    }
}
