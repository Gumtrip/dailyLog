<?php

namespace App\Http\Requests\VerificationCode;

use App\Http\Requests\Frontend\FormRequest;

class VerificationCodeRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'mobile' => ['required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/',
            ],
            'captchaKey' => 'required|string',
            'captchaCode' => 'required|string',
        ];
    }
    public function attributes()
    {
        return [
            'captchaKey' => '图片验证码 key',
            'captchaCode' => '图片验证码',
        ];
    }

}
