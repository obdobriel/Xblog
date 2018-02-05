<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function ($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit'      => 60,
        'expires'    => 1,
    ], function ($api) {
        $api->get('/', 'WechatsController@token')->name('wechat.token');
        $api->post('/', 'WechatsController@index')->name('wechat.index');
    });
});

