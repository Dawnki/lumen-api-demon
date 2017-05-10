<?php
/**
 * Created by PhpStorm.
 * User: Dawnki Chow
 * Date: 2017/5/8 0008
 * Time: 12:13
 */

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix'=>'v1','namespace'=>'App\Http\Controllers'],function() use($api){

        $api->post('test',['uses'=>'Controller@test']);

        //登陆
        $api->post('login',['uses'=>'AuthController@postLogin']);

        //注册
        $api->post('register',['uses'=>'AuthController@register']);

        $api->post('test1',['uses'=>'Controller@test1','middleware'=>'api.auth']);

        // auth中间件
        $api->group(['middleware'=>'api.auth'],function() use($api){
            $api->post('updateToken',['uses'=>'AuthController@updateToken']);
            $api->post('logout',['uses'=>'AuthController@logout']);
        });

    });
});