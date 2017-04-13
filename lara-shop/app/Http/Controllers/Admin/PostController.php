<?php

namespace App\Http\Controllers\Admin;

use App\Cateblog;
use App\Post;
use Validator;
use Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(['admin', 'auth'])->except('login');
    }

    function show()
    {
//        dd(1);
        $post = Post::all();
//        dd($post);
        return view('admin.posts.list', ['data' => $post]);

    }

    function showadd()
    {
        $cateblog = Cateblog::all();
        return view('admin.posts.add', ['data' => $cateblog]);
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
    function add(Request $request)
    {
//    dd($request);
        $rule = [
            'title' => 'string|required|min:10|unique:posts,title',
            'content' => 'string|required|min:20',
            'category' => 'required'
        ];

        $message = [
            'title.required' => 'Tiêu đề bài viết không được để trống',
            'title.min' => 'Tiêu đề bài viết không được ít hơn 10 ký tự',
            'title.unique' => 'Tiêu đề bài viết đã có xin hãy nhập tiêu đề khác',
            'content.required' => 'Nội dung bài viết không được để trống',
            'content.min' => 'Nội dung bài viết không được ít hơn 20 ký tự',
            'category.required' => 'Category không được để trống'
        ];

        $validation = Validator::make($request->all(), $rule, $message);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        } else {
            $post = new Post();

            $post->title = $request->title;
            $post->slug = str_slug($request->title);
//        $post->body = $request->content;
            $post->body = $request->input('content');
            $post->category_id = $request->category;
            $post->author_id = $request->user()->id;
            $post->active = 1;
            if ($request->hasFile('banner')) {
                $banner = $request->file('banner');
                $filename = uniqid() . '_bannerblog' . $banner->getClientOriginalName();

                Image::make($banner)->resize(500, 500)->save(public_path('/images/blog' . $filename));
                $post->banner = url ('/images/blog' . $filename);
            }
            $post->save();
            alert()->success('Đã thêm bài post thành công');
            return redirect('/admin/post');
//            ->with('alert', 'Đã thêm bài post thành công');
        }
    }

    function showOne($id)
    {
        $cateblog = Cateblog::all();
        $post = Post::find($id);
        return view('admin.posts.edit', [
            'cate' => $cateblog,
            'data' => $post
        ]);
    }

    function edit(Request $request, $id)
    {
        $rule = [
            'title' => 'string|min:10|unique:posts,title,'.$id,
            'content' => 'string|min:20',
            'category' => 'required'
        ];

        $message = [
            'title.min' => 'Tiêu đề bài viết không được ít hơn 10 ký tự',
            'title.unique' => 'Tiêu đề bài viết đã có xin hãy nhập tiêu đề khác',
            'content.min' => 'Nội dung bài viết không được ít hơn 20 ký tự',
            'category.required' => 'Category không được để trống'
        ];

        $validation = Validator::make($request->all(), $rule, $message);

        if ($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }else {
            $post = Post::find($id);

            $post->title = $request->title;
            $post->slug = str_slug($request->title);
            $post->body = $request->input('content');
            $post->category_id = $request->category;
            if ($request->hasFile('banner')){
                $banner = $request->file('banner');
                $filename = uniqid().'_banner'.$banner->getClientOriginalName();

                Image::make($banner)->resize(500,500)->save(public_path('/images/blog'.$filename));
                $post->banner = url('/images/blog' . $filename);
            }
            $post->save();
            alert()->success('Chỉnh sửa bài viết thành công ');
            return redirect('/admin/post');
//            ->with('alert','Chỉnh sửa bài viết thành công ');
        }
    }

    function delete($id)
    {
        Post::find($id)->delete();
        alert()->message('Bạn đã xóa bài post thành công');
        return redirect('/admin/post');
//        ->with('alert', 'Bạn đã xóa bài post thành công');
    }

    public function uploadImage(Request $request)
    {
        $rules = [
            'file' => 'required|image|mimes:jpeg,jpg,png,gif'
        ];


        $data = $request->all();
//        dd($data['file']);
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 'invalid file type']);
        }
//        dd($request->file('file'));
        if ($request->file('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();

            $filename = uniqid() . '_attachment.' . $extension;
            if ($request->file('file')->move('img/post/', $filename)) {
                return response()->json(['data' => url('img/post/' . $filename)]);
            }

        } else {
            return '{"status":"Invalid File type"}';
        }
    }
}
