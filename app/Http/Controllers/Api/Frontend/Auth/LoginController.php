<?php

namespace App\Http\Controllers\Api\Frontend\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Frontend\Auth\LoginRequest;
use App\Http\Requests\Api\Frontend\Auth\LoginViaCodeRequest;
use App\Http\Requests\Api\Frontend\Auth\WxAuthorizationRequest;
use App\Traits\SMSVerify;
use App\Models\User\User;
use Auth;

class LoginController extends Controller
{

    use SMSVerify;
    const GUARD='api';

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


    /**
     * @return mixed
     */

    public function logout()
    {
        Auth::guard(self::GUARD)->logout();
        return $this->response->noContent();
    }

    /** 通过验证码登陆
     * @param LoginViaCodeRequest $request
     * @return mixed
     * @throws \ErrorException
     */

    public function loginViaCode(LoginViaCodeRequest $request){
        $mobile = $request->mobile;
        $existUser = User::where('mobile', $mobile)->first();
        $verificationKey = $request->verificationKey;
        $user = self::codeLoginHandle($existUser,$mobile,$verificationKey,$request->verificationCode);
        $token = Auth::guard(self::GUARD)->fromUser($user);
        return self::respondWithToken($token);
    }


    /** 根据用户提交的unionId,如果在数据库当中，就直接登陆
     *  如果找不到，就跳转到登陆页面，
     *  用户不存在，则直接可以通过手机验证码注册并登陆
     *  登陆成功，手机号码和wx_unionId绑定
     * @param WxAuthorizationRequest $request
     * @throws \ErrorException
     */
    public function wxAuthorization(WxAuthorizationRequest $request)
    {
        $code = $request->code;
        // 根据 code 获取微信 openid 和 session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);
        // 如果结果错误，说明 code 已过期或不正确，返回 401 错误
        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code 不正确');
        }
        // 找到 openid 对应的用户
        $user = User::where('wx_openid', $data['openid'])->first();
        $attributes['wx_session_key'] = $data['session_key'];

        // 未找到对应用户则需要提交用户名密码进行用户绑定
        if (!$user) {
            $mobile = $request->mobile;
            // 如果未提交用户名密码，403 错误提示
            if (!$mobile) {
                return $this->response->errorForbidden('用户不存在或为用户未进行手机绑定！');
            }
            $existUser = User::where('mobile', $mobile)->first();
            $user = self::codeLoginHandle($existUser,$mobile,$request->verificationKey,$request->verificationCode);
            $attributes['wx_openid'] = $data['openid'];
        }

        $user->update($attributes);
        $token = Auth::guard(self::GUARD)->fromUser($user);
        return self::respondWithToken($token);
    }


    public function codeLoginHandle($existUser,$mobile,$verificationKey,$verificationCode){

        $verifyResult = $this->verifySMSCode($verificationKey, $verificationCode);
        if ($verifyResult) {
            if ($existUser) {
                $user = $existUser;
            } else {
                $user = User::create([
                    'name' => $mobile,
                    'mobile' => $mobile,
                    'password' => \Hash::make($mobile),
                ]);
            }
            \Cache::forget($verificationKey);// 清除验证码缓存
            return $user;
        } else {
            return $this->response->error('验证码错误或者验证码已失效', 422);
        }
    }

    /**
     * @return mixed
     */

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
            'expiresDate' => $expiresDate
        ])
            ->setStatusCode($code);
    }


}
