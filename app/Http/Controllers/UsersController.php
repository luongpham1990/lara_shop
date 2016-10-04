<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    //dang ky
    public function register(Request $request)
    {
        $rule = [
            'rname' => 'string|required|alpha_num|between:6,32|unique:users,name',
//            'username' => 'string|required|alpha_num|between:6,32',
            'rpassword' => 'string|required|between:6,32|confirmed',
            'remail' => 'required|email|unique:users,email',
//            'address' => 'string|required|alpha_num|max:255'
        ];

        $message = [
            '*.required' => ':attribute hien thi không được để trống',
            '*.between' => ':attribute ít nhất là :min ký tự và không được quá :max ký tự',
            'rname' => ':attribute da co xin hay nhap ten khac',
            'rpassword.confirmed' => ':attribute phai giong password',
            'remail.unique' => ':attribute nay đã có xin hãy nhập email khác',
            'remail.email' => ':attribute sai định dạng',
//            'address.max' => ':attribute khong vuot qua :max ky tu'
        ];

        $validation = Validator::make($request->all(), $rule, $message);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $user = new User;
            $user->name = $request->rname;
//            $user->username = $request->username;
            $user->email = $request->remail;
            $user->password = Hash::make($request->rpassword);
            $confirm_code = md5($request->remail);
            $user->confirm_code = $confirm_code;
            $user->confirmed = false;
//            $user->address = $request->address;
            $user->save();

            $link = (url('/verify/') . "/" . $confirm_code);
            Mail::to($user)->send(new RegisterMail($request->rname, $request->remail, $link));
            return view('shop.users.login');
        }
    }
    //kich hoat
    public function active($confirm_code)
    {
        $user = User::where('confirm_code', $confirm_code)->first();
        $user->confirm_code = null;
        $user->confirmed = true;
        $user->save();
        return redirect('/login');
    }
    //dang nhap
    public function login(Request $request)
    {
        $rule = [
            'lemail' => 'required|email',
            'lpassword' => 'string|required'
        ];

        $message = [
            '*.required' => ':attribute khong duoc de trong nhe',
            'lemail.email' => ':attribute sai dinh dang nhe'
        ];

        $validation = Validator::make($request->all(), $rule, $message);


        if ($validation->fails()) {
            return redirect('/login')->withInput()->withErrors($validation);
        } else {
            if (Auth::attempt(['email' => $request->lemail, 'password' => $request->lpassword, 'confirmed' => true])) {
                return redirect('/home');
            } else {
                return redirect('/login')->with('error', 'Ban dang nhap loi roi nhe');
            }
        }
    }
    //thoat
    public function logout(Request $request)
    {
        Auth::logout($request->user());
        return view('shop.users.home');
    }

    public function edit(Request $request)
    {

    }
}
