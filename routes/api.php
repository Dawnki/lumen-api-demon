<?php
/**
 * Created by PhpStorm.
 * User: Dawnki Chow
 * Date: 2017/5/8 0008
 * Time: 12:13
 */

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix'=>'v1'],function() use($api){

        $api->post('test',['uses'=>'App\Http\Controllers\Controller@test']);

        $api->post('test1',['uses'=>'App\Http\Controllers\Controller@test1','middleware'=>'api.auth']);

    });
});