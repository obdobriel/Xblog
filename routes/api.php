<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function ($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit'      => 1,
        'expires'    => 1,
    ], function ($api) {
        $api->get('/', function () {
            return response('obdogabriel');
        });
        $api->get('version', function () {
            return response('this is version v1');
        });
    });
});

