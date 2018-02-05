<?php
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

$url = 'http://www.tuling123.com/openapi/api';
$params = [
    'key' => '53be621f65af4fca87da2f527da08081',
    'info' => '今天天气怎么样',
    'userid' => '111'
];
$res = curl($url, json_encode($params), 1);
var_dump($res);die;