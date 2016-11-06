<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class BlogController extends Controller
{
    public function index() {
        $post = Post::orderBy('create_at','DESC')->paginate(5);
        return view('site.index',['data' => $post]);
    }
}
