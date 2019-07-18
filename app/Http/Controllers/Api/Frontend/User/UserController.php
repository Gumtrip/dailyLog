<?php

namespace App\Http\Controllers\Api\Frontend\User;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Transformers\Frontend\User\UserTransformer;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Frontend\User\UserPasswordResetRequest;
use App\Traits\SMSVerify;

class UserController extends Controller
{
    use SMSVerify;

    public function me(Request $request)
    {
        return $this->response->item($this->user, new UserTransformer());
    }
    public function update(Request $request){
        $user = $this->user;
        $attributes = $request->only(['name']);
        $user->update($attributes);
        return $this->response->item($user,new UserTransformer())->withHeader('Authorization',$request->header('Authorization'));
    }

    public function passwordReset(UserPasswordResetRequest $request){
        $user = $this->user;
        $verifyResult = $this->verifySMSCode($request->verificationKey, $request->verificationCode);
        if ($verifyResult) {
            $user->update([ 'password' => Hash::make($request->password)]);
            \Cache::forget($request->verificationKey);// 清除验证码缓存
            return $this->response->item($user,new UserTransformer())->withHeader('Authorization',$request->header('Authorization'));
        } else {
            return $this->response->error('验证码错误或者验证码已失效',422);
        }
    }


}
