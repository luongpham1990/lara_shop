<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class BlogController extends Controller
{
    public function show() {
        $post = Post::orderBy('created_at','DESC')->paginate(5);
        return view('sites.index',['data' => $post]);
    }

    public function showOne($id) {
        $data = Post::find($id);
//        dd($data->banner);
        return view('sites.detail')->with('data',$data);
    }
}
