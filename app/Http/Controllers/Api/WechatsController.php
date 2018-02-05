<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WechatRequest;
use EasyWeChat\Factory;
use Log;

class WechatsController extends Controller
{
    public function token(WechatRequest $request)
    {
        $config = [
            'app_id'        => env('WX_APPID'),
            'secret'        => env('WX_SECRET'),
            'aes_key'       => env('WX_AES'),
	    'token' => env('WX_TOKEN'),
            'response_type' => 'array',
            'log'           => [
                'level' => 'debug',
                'file'  => storage_path('logs/wechat.log'),
            ],
        ];
        $app = Factory::officialAccount($config);
    
        $app->server->push(function ($message) {
            return 'obdogabriel';
        });
        
        $response = $app->server->serve();
        
        return $response;
    }
    
    public function index()
    {
        $config = [
            'app_id'        => env('WX_APPID'),
            'secret'        => env('WX_SECRET'),
	    'token' => env('WX_TOKEN'),
            'aes_key'       => env('WX_AES'),
            'response_type' => 'array',
            'log'           => [
                'level' => 'debug',
                'file'  => storage_path('logs/wechat.log'),
            ],
        ];
        $app = Factory::officialAccount($config);
        
        $url = 'http://www.tuling123.com/openapi/api';
        
        $app->server->push(function ($message) use ($url) {
            Log::info('wechat', $message);
            switch ($message['MsgType']) {
                case 'text':
                    $params = [
                        'key' => env('TULIN_KEY'),
                        'info' => $message['Content'],
                        'userid' => $message['FromUserName']
                    ];
                    $res = $this->curl($url, json_encode($params), 1);
		    $data = json_decode($res, true);
		    return $data['text'];
                default :
		    return "我是聊天机器人Gabriel。";
            }
        });
        
        $response = $app->server->serve();
  
	return $response;
    }
    
/**
 * @param $url    请求网址
 * @param bool    $params 请求参数
 * @param integer $isJson [description]
 * @return bool|mixed
 */
function curl($url, $params = false, $isJson = 0)
{
    $httpInfo = [];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($isJson) {
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json; charset=utf-8',
            'Content-Length:'.strlen($params)
        ]);
    };
    
    $response = curl_exec($ch);
    
    if ($response === FALSE) {
        //echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
    curl_close($ch);

    return $response;
}
}
