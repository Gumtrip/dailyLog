<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\PhraseBuilder;

class CaptchaController extends Controller
{
    /** 生成图片验证码，将验证码写入缓存
     * @param CaptchaRequest $request
     * @param CaptchaBuilder $captchaBuilder
     * @return mixed
     */
    public function create(Request $request, CaptchaBuilder $captchaBuilder)
    {

        $key = 'captcha-'.str_random(15);
        $phraseBuilder = new PhraseBuilder(3, '0123456789');
        $captcha = new CaptchaBuilder(null,$phraseBuilder);
        $captcha->setIgnoreAllEffects(true)->build();
        $expiredAt = now()->addMinutes(2);
        cache([$key=>['code' => $captcha->getPhrase()]], $expiredAt);
        $result = [
            'captchaKey' => $key,
            'expiredAt' => $expiredAt->toDateTimeString(),
            'captchaImageContent' => $captcha->inline()
        ];

        return $this->response->array($result)->setStatusCode(201);
    }
}
