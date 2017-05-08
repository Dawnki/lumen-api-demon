<?php
/**
 * Created by PhpStorm.
 * User: Dawnki Chow
 * Date: 2017/5/8 0008
 * Time: 21:06
 */

namespace App\Http\Controllers;

use App\Transformers\UserTransformer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:6|max:15',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return $this->errorBadRequest($validator);
        }

        $Req = $request->only('username', 'password', 'email');

        if (User::isExistByName($Req['username'])) {
            return $this->response->error('用户名已存在!', 400);
        }

        User::create([
            'username' => $Req['username'],
            'password' => $Req['password'],
            'email'    => bcrypt($Req['email'])
        ]);

        return $this->response->created(null,'注册成功!');
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->errorBadRequest($validator);
        }

        $credentials = $request->only('username', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return $this->response->errorUnauthorized('账号或密码错误');
        }

        $user = Auth::user();

        $ext = [
            'token' => $token,
            'expired_at' => Carbon::now()->addMinutes(config('jwt.ttl'))->toDateTimeString(),
            'refresh_expired_at' => Carbon::now()->addMinutes(config('jwt.refresh_ttl'))->toDateTimeString(),
            'last_logined_time' => Carbon::now()->toDateTimeString()
        ];

        return $this->response->item($user, new UserTransformer($ext))->setStatusCode(200);
    }

    public function updateToken()
    {
        $result['data'] = [
            'token' => Auth::refresh(),
            'expired_at' => Carbon::now()->addMinutes(config('jwt.ttl'))->toDateTimeString(),
            'refresh_expired_at' => Carbon::now()->addMinutes(config('jwt.refresh_ttl'))->toDateTimeString()
        ];

        return $this->response->array($result);
    }

    public function logout()
    {
        Auth::logout();

        return $this->response->noContent();
    }
}