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
    //kết nối vào middleware admin để phân quyền thôi
    function __construct()
    {
        $this->middleware(['auth', 'admin'])->except('login');//trong này yêu cầu phải đăng nhập và là admin ý mà
    }
    //show hàng tất cả user trong csdl
    function show()
    {
        $user = User::all();//lấy tất cả
        return view('admin.user.list', ['user' => $user]);//trả về view admin.user.list kèm theo biến user (gồm tất cả thông tin của user) lấy dc ở dòng trên
    }
    //show ra cái trang thêm user
    function showadd()
    {
        return view('admin.user.add');//trả về view admin.user.add
    }
    //thêm mới user
    function add(Request $request)
    {
        //tạo rule nhé
        $rule = [
            'username' => 'string|required|alpha_num|min:6|max:32|unique:users,username',
            'password' => 'string|required|alpha_num|min:6|max:32|confirmed',
            'email' => 'email|required|unique:users,email',
            'address' => 'required|max:255|text',
            'phone' => 'numeric|max:15'
        ];
        //tạo message nhé
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
        //check xác nhận khớp ko nhé
        $validation = Validator::make($request->all(), $rule, $message);
        //nếu ko khớp này
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {//nếu khớp này
            //tạo mới user này
            $user = new User;
            $user->username = $request->username;//tên nhập vào
            $user->password = Hash::make($request->password);//password nhập vào
            $user->email = $request->email;//email nhập vào
            $user->address = $request->address;//địa chỉ nhập vào
            $user->is_admin = ($request->Level == 1) ? true : false;//ở đây vì là admin lập user mới trong gd admin nên có thêm nút chọn cho nó là user hay là admin: nếu level cho là 1 thì true còn ko thì false nhé
            $user->confirm_code = null;//confirm_code cho null luôn, mình lập mà
            $user->confirmed = true;//đã kích hoạt luôn nhé
            $user->save();//save user này

            return redirect('/admin/user')->with('alert', 'Đã thêm thành viên thành công');//chirlaf điều hướng thôi
        }
    }
    //sửa thông tin của user nhé
    function edit(Request $request)
    {
        //tạo rule này
        $rule = [
            'username' => 'string|min:6|max:32|unique:users,username',
            'address' => 'text|max:255',
            'phone' => 'numeric|max: 15'
        ];
        //tạo message luôn
        $message = [
            'username.min' => 'Tên hiển thị không được ít hơn :min ký tự',
            'username.max' => 'Tên hiển thị không được nhiều hơn :max ký tự',
            'address.max' => 'Địa chỉ không được nhiều hơn :max ký tự',
            'phone.max' => 'Số điện thoại không vượt quá :max ký tự'
        ];
        //check xác thực
        $validation = Validator::make($request->all(), $rule, $message);

        if ($validation->fails()) {  //ko trùng nhé
            return redirect()->back()->withErrors($validation);//điều hướng luôn
        } else {//nếu trùng nhé
            //tạo user này
            $user = new User();
            $user->username = $request->username;//tên này
            $user->address = $request->address;//địa chỉ này
            $user->phone = $request->phone;//số dt này
            $user->confirmed = ($request->confirmed == 1) ? true : false;//thích kích hoạt chưa
            $user->is_admin = ($request->Level == 1) ? true : false;//thích admin hay người thường nào
            $user->save();//save thôi

            return redirect('/admin/user')->with('alert', 'Sửa tài khoản thành công ');//điều hướng nhé
        }
    }
    //cũng là edit user nhưng mình dùng gói editable của larvel sửa cho đẹp
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
    //show ra thong tin cuar 1 user
    function showone($id)
    {
        $user = User::find($id);//tìm user có id là id đã nhập vào nhé
        return view('admin.user.edit', ['user' => $user]);//trả về view admin.user.edit kèm theo biến user đã lấy dc ở trên
    }
    //xóa 1 user
    function delete($id)
    {
        User::find($id)->delete();//tìm user có id mà mình đã click vào và xóa
        return redirect('/admin/user')->with('alert', 'Xóa tài khoản thành công ');//xóa xong rồi nhé về trang show user
    }

}
