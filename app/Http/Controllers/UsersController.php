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
use Alert;

class UsersController extends Controller
{
    //dang ky
    public function register(Request $request)
    {
        //tạo 1 cái luật để xét dữ liệu đầu vào
        $rule = [
            'rusername' => 'string|required|alpha_num|min:6|max:32|unique:users,username',
            'rpassword' => 'string|required|alpha_num|min:6|max:32|confirmed',
            'remail' => 'email|required|unique:users,email',
        ];
        //các lỗi sẽ xuất ra khi bị sai
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
        //xác nhận dữ liệu gửi lên từ input người dùng nhập vào với rule và message
        $validation = Validator::make($request->all(), $rule, $message);

        if ($validation->fails()) {//nếu xác nhận là sai (dữ liệu nhập vào sai ko khớp với rule)
            //chuyển về trang lúc trước (trang đăng ký)
            return redirect()->back()->withInput()->withErrors($validation);
        } else {//nếu đúng khớp hết các điều kiện
            //create user
            $user = new User;
            $user->username = $request->rusername;//cột username trong csdll = input[name]  user nhập vào
            $user->email = $request->remail;//cột email trong csdll = input[name]  user nhập vào
            $user->password = Hash::make($request->rpassword);//cột password trong csdll = input[name] user nhập vào, password dc mã hóa Hash
            $confirm_code = md5($request->remail);//cột username trong csdll = mã hóa Md5 email user nhập vào
            $user->confirm_code = $confirm_code;
            $user->confirmed = false; //cột confirmed trong csdll mặc định nhập vào là false vì user chưa kích hoạt
            $user->is_admin = false;//cột is_admin trong csdll mặc định là false
            $user->save();//save user vào csdl

            $link = (url('/verify') . "/" . $confirm_code);//tạo ra 1 link để user kích hoạt
            $user->notify(new UserRegister($user, $link));//sử dụng notification để gửi mail kích hoạt
//            Mail::to($user)->send(new RegisterMail($request->rusername, $request->remail, $link));////sử dụng mailble để gửi mail kích hoạt
            alert()->success('Success Message', 'Dang ky thanh cong moi ban kich hoat tai khoan');
            return redirect('/login');
//                ->with('alert', 'Dang ky thanh cong moi ban kich hoat tai khoan');//đăng ký thành công sễ chuyển về trang login
        }
    }

    //kich hoat
    public function active($confirm_code)
    {
        $user = User::where('confirm_code', $confirm_code)->first();//khi user check mail kích hoạt, click vào link kích hoạt đc gửi trong mail, tìm trong csdl user có cái confirm_code trùng với confirm_code đc mã hóa gửi trong link
        $user->confirm_code = null;//chuyển confirm_code thành null
        $user->confirmed = true;//chuyển trạng thái confirmed thành true là đã kích hoạt
        $user->save();//save lại user

        Auth::loginUsingId($user->id);//đăng nhập user có id là id của user đã kích hoạt ở trên
        alert()->message('Message', 'Kich hoat tai khoan thanh cong');
        return redirect('/user/' . $user->id . '/edit/');//đăng nhập xong chuyển đếm tramg profile của user
    }

    //dang nhap
    public function login(Request $request)
    {
        //tạo ra 1 rule xét đầu vào như đăng ký
        $rule = [
            'lemail' => 'required|email',
            'lpassword' => 'string|required'
        ];
        //tạo ra 1 message để xuất ra khi nhập vào ko khớp với rule
        $message = [
            'lemai.required' => 'Email không được để trống',
            'lemail.email' => 'Email không đúng định dạng',
            'lpassword.required' => 'Mật khẩu không được để trống'
        ];
        //xác nhận dữ liệu gửi lên từ input người dùng nhập vào với rule và message
        $validation = Validator::make($request->all(), $rule, $message);
        //nếu nhập vào sai ko khớp với rule
        if ($validation->fails()) {
//            return redirect('/login')->withInput()->withErrors($validation);

        } else {//nếu định dạng dữ liệu đầu vào là đúng
            if (Auth::attempt(['email' => $request->lemail, 'password' => $request->lpassword, 'confirmed' => true])) {//check dữ liệu đầu vào với csdl nếu đúng chuyển về trang home
                alert()->message( 'Đăng nhập thành công');
                return redirect('/home');
            } else {//sai chuyển lại về trang login
                alert()->error('Bạn đăng nhập lỗi rồi');
                return redirect('/login');//['erorrs' => 'Bạn đăng nhập lỗi rồi']
            }
        }
    }

    //thoat
    public function logout(Request $request)
    {
        Auth::logout($request->user());//logout user
        return redirect('/');
    }

    //hiện profile của user
    public function profile(Request $request, $id)
    {
        if ($request->user()->id == $id) {//nếu id của user đã đăng nhập khớp với id trong csdl thì xuất ra dữ liệu của user đó
            $user = User::find($id);
            return view('shop.users.edit', ['user' => $user]);
        } else {
            return abort(403);
        }
    }

    //đổi pass
    public function changePass(Request $request, $id)
    {
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
                    return redirect('/user/' . $user->id . '/edit/')->withInput()->withErrors($validation);//chuyển vè trang profile và xuất ra lỗi
                } else {//ko xịt
                    $user->password = Hash::make($request->newpassword);//nhập vào password mới cho user
                    $user->save();//save user
                    alert()->success( 'Đổi mật khẩu thành công');
                    return redirect('/user/' . $user->id . '/edit/');
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

    //edit sửa thông tin profile
    function edit(Request $request, $id)
    {
        if ($request->user()->id == $id) {//nếu id của user đã đăng nhập khớp với id trong csdl thì xuất ra dữ liệu của user đó
           //tìm trong csdl id của user đã nhập vào
            $user = User::find($id);
            //lại tạo 1 rule thôi
            $rule = [
                'username' => 'string|min:6|max:32|unique:users,username',
                'address' => 'text|max:255',
                'phone' => 'numeric|max: 15'
            ];
            //mình thích thì mình tạo message thôi
            $message = [
                'username.min' => 'Tên hiển thị không được ít hơn :min ký tự',
                'username.max' => 'Tên hiển thị không được nhiều hơn :max ký tự',
                'address.max' => 'Địa chỉ không được nhiều hơn :max ký tự',
                'phone.max' => 'Số điện thoại không vượt quá :max ký tự'
            ];
            //check nhé
            $validation = Validator::make($request->only(['username' => $request->username, 'address' => $request->address, 'phone' => $request->phone]), $rule, $message);

            if ($validation->fails()) {//xịt nhé
                return redirect()->back()->withErrors($validation);
            } else {//ko xịt nhé
                $user->username = $request->username;//sửa username
                $user->address = $request->address;//sửa địa chỉ
                $user->phone = $request->phone;//sửa số dt
                if ($request->hasFile('avatars')) {//up avatar, nếu có file img dc up lên
                    $avatar = $request->file('avatars');//cột avatar trong csdl = input file[name]
                    $filename = uniqid() . '.' . $avatar->getClientOriginalName();//đặt tên cho file up lên, hàm uniquid() tương tự như time()

                    Image::make($avatar)->resize(300, 300)->save(public_path('avatars/' . $filename));//luu ảnh vào forder public/avatars, hàm này dùng bằng gói intervation/image laravel

//                    $user = Auth::user();//nói chung là đã có up avatar lên xác nhận cái user
                    $user->avatar = url('avatars/' . $filename);// xuất ra avatar = đường dẫn trên csdl
                }
                $user->save();//chỉnh xong thì save user lại thôi
                alert()->success('Sửa tài khoản thành công ');
                return redirect('/user/' . $user->id . '/edit/');
//                    ->with('alert', 'Sửa tài khoản thành công ');//điều hướng về trang profile user nhé
            }
        }
    }

//    function delete($id)
//    {
//        User::find($id)->delete();
//        return redirect('/admin/user/list')->with('alert', 'Xóa tài khoản thành công');
//    }
}
