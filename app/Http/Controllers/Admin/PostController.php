<?php

namespace App\Http\Controllers\Admin;

use App\Cateblog;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(['admin','auth'])->except('login');
    }

    function show(){
        $post = Post::all();
        return view('admin.posts.list', ['data'=>$post]);
    }

    function showadd() {
        $cateblog = Cateblog::all();
        return view('admin.posts.add',['data'=>$cateblog]);
    }

//    function uploadImage(Request $request){
//        $rule = [
//          'file' => 'required|mimes:jpg, jpeg, png, gif'
//        ];
//
//        $message = [
//          'file.required' => 'Ảnh phải nhập vào nhé',
//            'file.mimes' => 'Ảnh không đúng định dạng nhé'
//        ];
//
//        $validation = Validator::make($request->all(),$rule,$message);
//
//        if ($validation->fails()){
//            return response()->json($validation);
//        }else{
//            if ($request->hasFile('image')){
//                $image = $request->file('image');
//                $filename = uniqid().'_attachment'.$image->getClientOriginalName();
//
//               Image::make($image)->resize(300,300)->save(public_path('/images/blog'.$filename));
//
//            }
//        }
//    }


}
