<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function show()
    {
        $user = User::all();
        return view('admin.user.list', ['user' => $user]);
    }

    function showadd()
    {
        return view('admin.user.add');
    }

    function add(Request $request)
    {
        $rule = [
            'username' => 'string|required|alpha_num|min:6|max:32|unique:users,username',
            'password' => 'string|required|alpha_num|min:6|max:32|confirmed',
            'email' => 'email|required|unique:users,email',
            'address' => 'required|max:255|alpha_num',
            'phone' => 'numeric|max:15'
        ];
        $message = [
            'username.unique' => 'Tên hiển thị đã được sử dụng vui lòng nhập tên khác',
            'username.required' => 'Tên hiển thị không được để trống',
            'username.min' => 'Tên hiển thị không được ít hơn :min ký tự',
            'username.max' => 'Tên hiển thị không được vượt quá :max ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu không được ít hơn :min ký tự',
            'password.max' => 'Mật khẩu không được vượt quá :max ký tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'email.email' => 'Email không đúng định dạng',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã được sử dụng vui lòng nhập email khác',
            'address.required' => 'Địa chỉ không được để trống',
            'address.max' => 'Địa chỉ không được vượt quá :max ký tự',
//            'address.regex' => 'Địa chỉ bao gồm :regex',
            'phone.max' => 'Số điện thoại không được vượt quá :max ký tự'
        ];

        $validation = Validator::make($request->all(), $rule, $message);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {

            $user = new User;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->address = $request->address;
            $user->is_admin = ($request->Level == 1) ? true : false;
            $user->confirm_code = null;
            $user->confirmed = true;
            $user->save();

            return redirect('/admin/user/list')->with('alert', 'Đã thêm thành viên thành công');
        }
    }

     function showone($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', ['user' => $user]);
    }

//    function

    function login(Request $request){
        $rule = [
            'email' => 'required|email',
            'password' => 'string|required'
        ];

        $message = [
            'emai.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống'
        ];

        $validation = Validator::make($request->all(),$rule,$message);

        if ($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' == true])){
                return redirect('/admin/user/list');
            }else {
                return redirect('/home')->withErrors('sida', 'Đéo phải admin nhé');
            }
        }
    }
    function logout(Request $request){
        Auth::logout($request->user);
        return view('admin.login');
    }

    function delete($id){
        User::find($id)->delete();
        return redirect('/admin/user/list')->with('alert','Xóa tài khoản thành công ');
    }
}
