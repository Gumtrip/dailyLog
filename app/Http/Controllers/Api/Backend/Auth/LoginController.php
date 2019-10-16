<?php

namespace App\Http\Controllers\Api\Backend\Auth;

use App\Http\Controllers\Api\Controller;
use Auth;
use App\Http\Requests\Backend\Auth\LoginRequest;
class LoginController extends Controller
{
    const GUARD='admin';
    /** 登陆认证
     * @param LoginRequest $request
     * @return mixed|void
     */
    public function login(LoginRequest $request)
    {
        if (!$token = \Auth::guard(self::GUARD)->attempt($request->all())) {
            return $this->response->errorUnauthorized('用户名或密码错误');
        }
        return $this->respondWithToken($token);
    }

    public function refreshToken()
    {
        $token = Auth::guard(self::GUARD)->refresh();
        return self::respondWithToken($token,200);
    }

    /** 刷新token
     * @param string $token
     * @param int $code
     * @return mixed
     * @throws \ErrorException
     */

    public function respondWithToken($token ='',$code=201)
    {
        $token = $token ? $token : auth(self::GUARD)->user();
        $expiresIn = Auth::guard(self::GUARD)->factory()->getTTL() * env('JWT_TTL',60);
        $expiresDate = now()->addSeconds($expiresIn)->toDateTimeString();
        return $this->response->array([
            'token' => 'Bearer'.' '.$token,
            'expires_in' => $expiresIn,
            'token_expired_at' => $expiresDate
        ])
            ->setStatusCode($code);
    }

    public function logout(){
//        Auth::guard(self::GUARD)->logout();
        return $this->response->noContent();
    }
}
