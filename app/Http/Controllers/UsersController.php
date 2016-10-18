<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\UserRegister;
use Image;
class UsersController extends Controller
{
    //dang ky
    public function register(Request $request)
    {
        $rule = [
            'rusername' => 'string|required|alpha_num|min:6|max:32|unique:users,username',
            'rpassword' => 'string|required|alpha_num|min:6|max:32|confirmed',
            'remail' => 'email|required|unique:users,email',
        ];
        $message = [
            'rusername.unique' => 'Tên hiển thị đã được sử dụng vui lòng nhập tên khác',
            'rusername.required' => 'Tên hiển thị không được để trống',
            'rusername.min' => 'Tên hiển thị không được ít hơn :min ký tự',
            'rusername.max' => 'Tên hiển thị không được vượt quá :max ký tự',
            'rpassword.required' => 'Mật khẩu không được để trống',
            'rpassword.min' => 'Mật khẩu không được ít hơn :min ký tự',
            'rpassword.max' => 'Mật khẩu không được vượt quá :max ký tự',
            'rpassword.confirmed' => 'Mật khẩu không trùng khớp',
            'remail.email' => 'Email không đúng định dạng',
            'remail.required' => 'Email không được để trống',
            'remail.unique' => 'Email đã được sử dụng vui lòng nhập email khác',
        ];

        $validation = Validator::make($request->all(), $rule, $message);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $user = new User;
            $user->username = $request->rusername;
            $user->email = $request->remail;
            $user->password = Hash::make($request->rpassword);
            $confirm_code = md5($request->remail);
            $user->confirm_code = $confirm_code;
            $user->confirmed = false;
            $user->is_admin = false;
            $user->save();

            $link = (url('/verify') . "/" . $confirm_code);
            $user->notify( new UserRegister($user,$link));
//            Mail::to($user)->send(new RegisterMail($request->rusername, $request->remail, $link));

            return redirect('/login')->with('alert', 'Dang ky thanh cong moi ban kich hoat tai khoan');
        }
    }

    //kich hoat
    public function active($confirm_code)
    {
        $user = User::where('confirm_code', $confirm_code)->first();
        $user->confirm_code = null;
        $user->confirmed = true;
        $user->save();

        Auth::loginUsingId($user->id);
        return redirect('/user/'. $user->id.'/edit/');
    }

    //dang nhap
    public function login(Request $request)
    {
        $rule = [
            'lemail' => 'required|email',
            'lpassword' => 'string|required'
        ];

        $message = [
            'lemai.required' => 'Email không được để trống',
            'lemail.email' => 'Email không đúng định dạng',
            'lpassword.required' => 'Mật khẩu không được để trống'
        ];

        $validation = Validator::make($request->all(), $rule, $message);

        if ($validation->fails()) {
            return redirect('/login')->withInput()->withErrors($validation);
        } else {
            if (Auth::attempt(['email' => $request->lemail, 'password' => $request->lpassword, 'confirmed' => true])) {
                return redirect('/home');
            } else {
                return redirect('/login')->with('error', 'Bạn đăng nhập lỗi rồi');//['erorrs' => 'Bạn đăng nhập lỗi rồi']
            }
        }
    }

    //thoat
    public function logout(Request $request)
    {
        Auth::logout($request->user());
        return redirect('/home');
    }

    public function profile(Request $request, $id)
    {
        if ($request->user()->id == $id) {
            $user = User::find($id);
            return view('shop.users.edit', ['user' => $user]);
        } else {
            return abort(403);
        }
    }

    public function changePass(Request $request, $id)
    {
        if ($request->user()->id == $id) {
            $user = User::find($id);
            if (Hash::check($request->oldpassword, $user->password)) {
                $rule = [
                    'newpassword' => 'string|required|alpha_num|min:6|max:32|confirmed',
//                'oldpassword' => 'required|alpha_num|confirmed'
                ];
                $message = [
                    'newpassword.required' => 'Mật khẩu không được để trống',
                    'newpassword.min' => 'Mật khẩu không được ít hơn :min ký tự',
                    'newpassword.max' => 'Mật khẩu không được vượt quá :max ký tự',
                    'newpassword.confirmed' => 'Mật khẩu không trùng khớp',
                ];

                $validation = Validator::make($request->all(), $rule, $message);

                if ($validation->fails()) {

                    return redirect('/user/'. $user->id.'/edit/')->withInput()->withErrors($validation);
                } else {
                    $user->password = Hash::make($request->newpassword);
                    $user->save();

                    return redirect( '/user/'. $user->id.'/edit/')->with('alert', 'Đổi mật khẩu thành công');
                }
            } else {
                return redirect()->back()->with('oldsida', 'Mật khẩu cũ không đúng');
            }
        } else {
            return abort(403);
        }
    }

    function edit(Request $request, $id)
    {
      if ($request->user()->id == $id){
          $user = User::find($id);
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

          $validation = Validator::make($request->only(['username'=>$request->username,'address' => $request->address,'phone'=>$request->phone]), $rule, $message);

          if ($validation->fails()) {
              return redirect()->back()->withErrors($validation);
          } else {

              $user->username = $request->username;
              $user->address = $request->address;
              $user->phone = $request->phone;
              if ($request->hasFile('avatars')){
                  $avatar = $request->file('avatars');
                  $filename = uniqid() .'.'. $avatar->getClientOriginalName();

                  Image::make($avatar)->resize(300,300)->save(public_path('avatars/'.$filename));

                  $user = Auth::user();
                  $user->avatar = $filename;
              }
              $user->save();

              return redirect('/user/'. $user->id.'/edit/')->with('alert', 'Sửa tài khoản thành công ');
          }
      }
    }

//    function delete($id)
//    {
//        User::find($id)->delete();
//        return redirect('/admin/user/list')->with('alert', 'Xóa tài khoản thành công');
//    }
}
