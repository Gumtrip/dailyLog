<?php

namespace App\Http\Controllers\Api;

use Overtrue\EasySms\EasySms;
use App\Http\Requests\VerificationCode\VerificationCodeRequest;

class VerificationCodesController extends Controller
{
    /**
     * @param VerificationCodeRequest $request
     * @param EasySms $easySms
     * @throws \ErrorException
     * @throws \Overtrue\EasySms\Exceptions\InvalidArgumentException
     */
    public function create(VerificationCodeRequest $request, EasySms $easySms)
    {
        $mobile = $request->mobile;

        if($request->isRegister){
            $this->validate($request,[
                'mobile'=>'unique:users,mobile'
            ]);
        }
        $captchaKey = $request->captchaKey;
        $captchaData = $this->getCaptchaData($captchaKey);

        if (!$this->verifyCode($captchaData['code'],$request->captchaCode)) {
            // 验证错误就清除缓存
            \Cache::forget($captchaKey);
            return $this->response->errorUnauthorized('验证码错误');
        }

        // 生成4位随机数，左侧补0
        if (!app()->environment('production')) {
            $code = '1234';
        } else {
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);
            try {
                $easySms->send($mobile, [
                    'content' => '您的验证码是' . $code . '。如非本人操作，请忽略本短信'
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException  $exception) {
                $message = $exception->getException('yunpian')->getMessage();
                return $this->response->errorInternal($message ?? '短信发送异常');

            }
        }

        $key = 'verificationCode_' . str_random(15);
        $expiredAt = now()->addMinutes(config('app.verification_code_ttl'));

        // 缓存验证码 3分钟过期。
        cache([$key=>['code' => $code]], $expiredAt);
        // 清除图片验证码缓存
        \Cache::forget($captchaKey);

        $returnData = [
                'message' => '验证码已经发送，请注意查收，有效期为3分钟！',
                'key' => $key,
                'status_code' => 201,
                'expired_at' => $expiredAt->toDateTimeString(),
        ];
        return $this->response->array($returnData)->setStatusCode(201);
    }

    private function getCaptchaData($captchaKey){
        $captchaData = cache($captchaKey);
        if (!$captchaData) {
            return $this->response->error('图片验证码已失效', 422);
        }
        return $captchaData;
    }

    private function verifyCode($code,$captchaCode){
        return hash_equals($code,$captchaCode);

    }
}
