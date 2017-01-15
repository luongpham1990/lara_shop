<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //kết nối vào middleware admin để phân quyền thôi
    function __construct()
    {
        $this->middleware(['auth', 'admin'])->except('login');//trong này yêu cầu phải đăng nhập và là admin ý mà
    }
    //admin đăng nhập
    function login(Request $request)
    {
        //tạo rule nào
        $rule = [
            'email' => 'required|email',
            'password' => 'string|required'
        ];
        //message nhé
        $message = [
            'emai.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống'
        ];
        //check xác nhận thông tìn điền lên có đúng định dạng ko
        $validation = Validator::make($request->only(['email', 'password']), $rule, $message);

        if ($validation->fails()) {//nếu xịt
            return redirect()->back()->withInput()->withErrors($validation);//điều hướng
        } else {//nếu ko xịt
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {//check email và pass có khớp trong csdl ko
                if (Auth::user()->is_admin) {//email và pass đã khớp thì check xem có phải admin ko
                    return redirect('/admin/user');//chuẩn rồi về trang admin/user
                } else {//xịt
                    return abort(403);//bạn méo có quyền vào khu vực này nhé
                }
            } else {//email và pass ko khớp
                alert()->error('Tài khoản hoặc mật khẩu không đúng');
                return redirect()->back();
//                    ->withErrors(['login' => 'Tài khoản hoặc mật khẩu không đúng']);//diều hướng quay lại đăng nhập lại nhé
            }
        }
    }
    //chỉ là logout thôi mà
    function logout(Request $request)
    {
        Auth::logout($request->user);//cái này laravel có nhé
        return redirect('/admin/login');//điều hướng về đăng nhập
    }
    //profile của ông addmin này
    function profile(Request $request, $id)
    {
        if ($request->user()->id == $id) {//cũng tìm đến id của ông ý
            $user = User::find($id);//tìm đến nhé
            return view('admin.edit', ['user' => $user]);//trả về view thôi
        }
    }
    //sửa thông tin của ông admin
    function editAdmin(Request $request, $id)
    {
        if ($request->user()->id == $id) {//tìm đến id của ông admin
            $user = User::find($id);//tìm đến nhé
            //cũng rule nhé
            $rule = [
                'username' => 'string|min:6|max:32|unique:users,username',
                'address' => 'text|max:255',
                'phone' => 'numeric|max:15',
                'avatars' => 'mimes:jpg, jpeg, png,|max:10000'
            ];
            //message nhé
            $message = [
                'username.min' => 'Tên hiển thị không được ít hơn :min ký tự',
                'username.max' => 'Tên hiển thị không được nhiều hơn :max ký tự',
                'address.max' => 'Địa chỉ không được nhiều hơn :max ký tự',
                'phone.max' => 'Số điện thoại không vượt quá :max ký tự',
                'avatars.mimes' => 'Ảnh không đúng định dạng',
                'avatars.max' => 'Ảnh không được vượt quá :max'
            ];
            //check xác thực này
            $validation = Validator::make($request->only(['username' => $request->username, 'address' => $request->address, 'phone' => $request->phone]), $rule, $message);

            if ($validation->fails()) {//xịt
                return redirect()->back()->withErrors($validation);
            } else {//ko xịt
//                dd($user);
                $user->username = $request->username;//sửa username
                $user->address = $request->address;//sửa địa chỉ
                $user->phone = $request->phone;//sửa số dt
//                      dd(public_path('avatars/' . $filename));
                if ($request->hasFile('avatars')) {//nếu có up ảnh lên
                    $avatar = $request->file('avatars');//avatar = dữ liệu dc gửi = input có tên là avatars
                    $filename = uniqid() . '_avatars' . $avatar->getClientOriginalName();//tạo tên cho ảnh khi chuyển vào csdl
                    Image::make($avatar)->resize(300, 300)->save(public_path('avatars/' . $filename));//up lên và save nó vào foder public/avatar
//                    $user = Auth::user();//đồng bộ thằng user
                    $user->avatar = url('avatars/' . $filename);//xuất ra avatar cố tên đường dẫn
                }
                $user->save();//save ông admin vào
                alert()->success('Sửa tài khoản thành công ');
                return redirect('/admin/' . $user->id . '/edit/');
//                ->with('alert', 'Sửa tài khoản thành công ');//điều hướng
            }
        }
        abort(403);
    }
    //doi pass admin
    function changePass(Request $request, $id){
        if ($request->user()->id == $id) {//nếu id của user đã đăng nhập khớp với id trong csdl thì xuất ra dữ liệu của user đó
            $user = User::find($id);
            if (Hash::check($request->oldpassword, $user->password)) {//nếu password cũ nhập vào là khớp
                //tạo 1 rule để xét định dạng của newpassword
                $rule = [
                    'newpassword' => 'string|required|alpha_num|min:6|max:32|confirmed',
//                'oldpassword' => 'required|alpha_num|confirmed'
                ];
                //tạo 1 message để xuất ra khi dữ liệu đầu vào ko khớp với rule
                $message = [
                    'newpassword.required' => 'Mật khẩu không được để trống',
                    'newpassword.min' => 'Mật khẩu không được ít hơn :min ký tự',
                    'newpassword.max' => 'Mật khẩu không được vượt quá :max ký tự',
                    'newpassword.confirmed' => 'Mật khẩu không trùng khớp',
                ];
                //xét dữ liệu nhập vào có khớp với rule và message ko
                $validation = Validator::make($request->all(), $rule, $message);

                if ($validation->fails()) {//nếu xịt
                    return redirect('/admin/' . $user->id . '/edit/')->withInput()->withErrors($validation);//chuyển vè trang profile và xuất ra lỗi
                } else {//ko xịt
                    $user->password = Hash::make($request->newpassword);//nhập vào password mới cho user
                    $user->save();//save user
                    alert()->success( 'Đổi mật khẩu thành công');
                    return redirect('/admin/' . $user->id . '/edit/');
//                        ->with('alert', 'Đổi mật khẩu thành công');//chuyển về trang profile
                }
            } else {//nếu password cũ nhập vào ko khớp
                alert()->error('Mật khẩu cũ không đúng');
                return redirect()->back();
//                    ->with('oldsida', 'Mật khẩu cũ không đúng');
            }
        } else {
            return abort(403);
        }
    }
}
