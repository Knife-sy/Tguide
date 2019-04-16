<?php

namespace App\Http\Controllers;

use Dingo\Api\Console\Command\Cache;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Requests\CaptchaRequest;

class CaptchasController extends BaseController
{
    public function store(CaptchaRequest $request, CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha-'.str_random(15);
        $email = $request->email;

        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinutes(2);
        \Illuminate\Support\Facades\Cache::put($key, ['email' => $email, 'code' => $captcha->getPhrase()], $expiredAt);

        $result = [
            'captcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            'captcha_image_content' => $captcha->inline()
        ];

        return $this->response->array($result)->setStatusCode(201);
    }
}
