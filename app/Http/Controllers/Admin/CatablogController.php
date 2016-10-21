<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CatablogController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(['admin','auth'])->except('login');
    }

    function show() {
        $blog = Catablog::all();
        return view('admin.catablog/list', ['blog' => $blog]);
    }
}
