<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller

{
    function __construct()
    {
        $this->middleware(['auth', 'admin'])->except('login');
    }

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
            'address' => 'required|max:255|text',
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

            return redirect('/admin/user')->with('alert', 'Đã thêm thành viên thành công');
        }
    }

    function edit(Request $request)
    {
        $rule = [
            'username' => 'string|min:6|max:32|unique:users,username',
            'address' => 'text|max:255',
            'phone' => 'numeric|max: 15'
        ];

        $message = [
            'username.min' => 'Tên hiển thị không được ít hơn :min ký tự',
            'username.max' => 'Tên hiển thị không được nhiều hơn :max ký tự',
            'address.max' => 'Địa chỉ không được nhiều hơn :max ký tự',
            'phone.max' => 'Số điện thoại không vượt quá :max ký tự'
        ];

        $validation = Validator::make($request->all(), $rule, $message);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        } else {

            $user = new User();
            $user->username = $request->username;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->confirmed = ($request->confirmed == 1) ? true : false;
            $user->is_admin = ($request->Level == 1) ? true : false;
            $user->save();

            return redirect('/admin/user')->with('alert', 'Sửa tài khoản thành công ');
        }
    }

    function editUser(Request $request)
    {
        // sau khi validate thanh cong
        $user = User::findOrFail($request->get('pk'));
        $name = $request->get('name');


        $value = $request->get('value');
        $user->$name = $value;
        $user->save();


        return response()->json([
            'status' => 'success',
            'msg' => 'lit pe Hung nhe'
        ]);

    }

    function showone($id)
    {
        $user = User::find($id);
//        dd($user);
        return view('admin.user.edit', ['user' => $user]);
    }

    function login(Request $request)
    {
        $rule = [
            'email' => 'required|email',
            'password' => 'string|required'
        ];

        $message = [
            'emai.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống'
        ];

        $validation = Validator::make($request->only(['email', 'password']), $rule, $message);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
//                return redirect('/admin/user/list');
                if (Auth::user()->is_admin) {
                    return redirect('/admin/user');
                } else {
                    return abort(403);
                }

            } else {
                return redirect()->back()->withErrors(['login' => 'Tài khoản hoặc mật khẩu không đúng']);
            }
        }
    }

    function logout(Request $request)
    {
        Auth::logout($request->user);
        return redirect('/admin/login');
    }

    function delete($id)
    {
        User::find($id)->delete();
        return redirect('/admin/user')->with('alert', 'Xóa tài khoản thành công ');
    }

    function profile(Request $request, $id)
    {
        if ($request->user()->id == $id) {
            $user = User::find($id);
            return view('admin.edit', ['user' => $user]);
        }
    }

    function editAdmin(Request $request, $id)
    {
        if ($request->user()->id == $id) {
            $user = User::find($id);
            $rule = [
                'username' => 'string|min:6|max:32|unique:users,username',
                'address' => 'text|max:255',
                'phone' => 'numeric|max: 15',
                'avatars' => 'mimes:jpg, jpeg, png,|max:10000'
            ];

            $message = [
                'username.min' => 'Tên hiển thị không được ít hơn :min ký tự',
                'username.max' => 'Tên hiển thị không được nhiều hơn :max ký tự',
                'address.max' => 'Địa chỉ không được nhiều hơn :max ký tự',
                'phone.max' => 'Số điện thoại không vượt quá :max ký tự',
                'avatars.mimes' => 'Ảnh không đúng định dạng',
                'avatars.max' => 'Ảnh không được vượt quá :max'
            ];

            $validation = Validator::make($request->only(['username' => $request->username, 'address' => $request->address, 'phone' => $request->phone]), $rule, $message);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation);
            } else {

                $user->username = $request->username;
                $user->address = $request->address;
                $user->phone = $request->phone;
                if ($request->hasFile('avatars')) {
                    $avatar = $request->file('avatars');
                    $filename = uniqid() . '.' . $avatar->getClientOriginalName();
                    Image::make($avatar)->resize(300, 300)->save(public_path('avatars/' . $filename));

                    $user = Auth::user();
                    $user->avatar = $filename;
                }

                $user->save();

                return redirect('/admin/' . $user->id . '/edit/')->with('alert', 'Sửa tài khoản thành công ');
            }
        }
    }
}
