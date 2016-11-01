<?php

namespace App\Http\Controllers\Admin;

use App\Cateblog;
use App\Post;
use Faker\Provider\Image;
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
function add(Request $request){
    dd($request);
    $rule = [
        'title' => 'string|required|min:10',
        'content' => 'string|required|min:20',
        'category' => 'required'
    ];

    $message = [
      'title.required' => 'Tiêu đề bài viết không được để trống',
        'title.min' => 'Tiêu đề bài viết không được ít hơn 10 ký tự',
        'content.required' => 'Nội dung bài viết không được để trống',
        'content.min' => 'Nội dung bài viết không được ít hơn 20 ký tự',
        'category.required' => 'Category không được để trống'
    ];

    $validation = Validator::make($request->all(),$rule,$message);

    if ($validation->fails()) {
        return redirect()->back()->withInput()->withErrors($validation);
    }else{
        $post = new Post();

        $post->title = $request->title;
        $post->slug = str_slug($request->title);
//        $post->body = $request->content;
        $post->body = $request->input('content');
        $post->category = $request->category;
        $post->author_id = $request->user()->id;
        $post->active = 1;
        if ($request->hasFile('banner')){
            $banner = $request->file('banner');
            $filename = uniqid().'_bannerblog'. $banner -> getClientOriginalName();

            Image::make()->resize(500,500)->move(public_path('/images/blog'. $filename));
            $post->banner = url(public_path('/images/blog'. $filename));
        }
        $post->save();
        return redirect('/admin/post')->with('alert', 'Đã thêm bài post thành công');
    }

}

}
