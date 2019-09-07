<?php

namespace App\Http\Controllers\Api\Backend\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Frontend\Auth\LoginRequest;
use App\Http\Requests\Api\Frontend\Auth\LoginViaCodeRequest;
use App\Http\Requests\Api\Frontend\Auth\WxAuthorizationRequest;
use App\Traits\SMSVerify;
use App\Models\User\User;
use Auth;
use Request;

class LoginController extends Controller
{

    /** 登陆认证
     * @param LoginRequest $request
     * @return mixed|void
     */
    public function login(Request $request)
    {

        return $this->response->array([
            'code' => 20000,
            'data'=>['token'=>'admin-token']
        ]);
    }

    public function logout(){
        return $this->response->array([
            'code' => 20000,
            'data'=>'success'
        ]);
    }
}
