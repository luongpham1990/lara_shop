<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();//điều hướng đến google khi đăng nhập bằng tài khoản google
    }

    public function getGoogleCallback()
    {
        $data = Socialite::driver('google')->user();//lấy thông tin từ tài khoản google làm user
//dd($data);
        $user = User::where('email', $data->email)->first();//tìm user có email = email của tài khoản google lấy dc ở trên

        if (!is_null($user)) {//nếu ko có user nào có email tài khoản google
            $user->username = $data->user['displayName'];//cập nhật tên user = tên của tài khoản google
            $user->avatar = $data->avatar;//cập nhật avatar = avatar sử dụng trên google
            $user->social_id = $data->id;//cập nhật social_id = id của tk google
            $user->save();
            Auth::login($user);//đồng bộ và đăng nhập
            return redirect('/')->with('alert', 'Chào mừng bạn đăng nhập = gg');
        } else {//nếu chưa tồn tại user có email là email tài khoản google
            $user = User::where('social_id', $data->id)->first();// tìm user xem có social_id trùng với id của gg ko và lấy ra kq đầu tiên
            if (is_null($user)) {//nếu ko có user nào
                //create 1 user
                $user = new User();
                $user->username = $data->user['displayName'];//lấy user name = username của tk gg
                $user->email = $data->email;//lấy email = email của tk gg
                $user->password = bcrypt($data->email);//lấy mk = mã hóa email của tk gg
                $user->confirm_code = null;//đặt confirm_code = null luôn
                $user->confirmed = true;//cho kích hoạt luôn
                $user->avatar = $data->avatar;//avatar = avatar sử dụng trên google
                $user->social_id = $data->id;//đặt social_id = id của gg luôn
                $user->save();
                Auth::login($user);
                return redirect('/')->with('alert', 'Bạn lập thành công = tk gg');
            }
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->user();
    }

    public function getFacebookCallback()
    {
        $data = Socialite::driver('facebook')->user();

        $user = User::where('email', $data->email)->first();

        if (!is_null($user)) {
            $user->username = $data->user['displayName'];
            $user->avatar = $data->avatar;
            $user->social_id = $data->id;
            $user->save();
            Auth::login($user);
            return redirect('/')->with('alert', 'Da vao = fb nhe');
        } else {
            $user = User::where('social_id', $data->id)->first();
            if (is_null($user)) {
                $user = new User();
                $user->username = $data->user['displayName'];
                $user->emai = $data->email;
                $user->password = bcrypt($data->email);
                $user->avatar = $data->avatar;
                $user->confirm_code = null;
                $user->confirmed = true;
                $user->social_id = $data->id;
                $user->save();
                Auth::login($user);
                return redirect()->with('alert', 'Bạn lập thành công = tk fb');
            }
        }
    }

    public function redirectToGithub()
    {
        return Socialite::driver('github')->user();
    }

    public function getGithubCallback()
    {
        $data = Socialite::driver('github')->user();

        $user = User::where('email', $data->email)->first();
        if (!is_null($user)) {
            $user->username = $data->user['displayName'];
            $user->avatar = $data->avatar;
            $user->social_id = $data->id;
            $user->save();
            Auth::login($user);
            return redirect('/')->with('alert', 'Ban dang nhap = github');
        } else {
            $user = $user::where('social_id', $data->id)->first();
            if (is_null($user)) {
                $user = new User();
                $user->username = $data->user['displayName'];
                $user->email = $data->email;
                $user->password = bcrypt($data->email);
                $user->confirm_code = null;
                $user->confirmed = true;
                $user->avatar = $data->avatar;
                $user->social_id = $data->id;
                $user->save();
                Auth::login($user);
                return redirect('/')->with('alert', 'Ban dang ky = github');
            }
        }
    }
}
