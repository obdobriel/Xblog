<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WechatRequest;
use EasyWeChat\Factory;

class WechatsController extends Controller
{
    public function token(WechatRequest $request)
    {
        $config = [
            'app_id'        => env('WX_APPID'),
            'secret'        => env('WX_SECRET'),
            'aes_key'       => env('WX_AES'),
            'response_type' => 'array',
            'log'           => [
                'level' => 'debug',
                'file'  => storage_path('logs/wechat.log'),
            ],
        ];
        
        $app = Factory::officialAccount($config);
        
        $app->server->push(function ($message) {
            return "obdogabriel";
        });
        
        $response = $app->server->serve();
        
        $response->send(); // Laravel 里请使用：return $response;
    }
}
