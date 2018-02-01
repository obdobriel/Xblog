<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function ($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit'      => 1,
        'expires'    => 1,
    ], function ($api) {
        $api->get('/', 'WechatsController@token')->name('wechat.token');
        $api->get('version', function () {
            return response('this is version v1');
        });
    });
});

