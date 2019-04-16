<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',[
    'namespace' => 'App\Http\Controllers',
    'middleware' => ['serializer:array', 'bindings']
], function ($api) {
    //用户列表
    $api->get('user_list', 'UserController@index');
    //用户登录
    $api->post('login', 'AuthController@login');
    //用户注册
    $api->post('user_add', 'UserController@store');
    // 图片验证码
    $api->post('captchas', 'CaptchasController@store');

    //删除用户
    $api->delete('users/{user}', 'UserController@destroy');

    $api->group(['middleware' => 'api.auth'], function($api) {
        // 当前登录用户信息
        $api->get('user', 'UserController@me');
        // 图片资源
        $api->post('images', 'ImagesController@store');
        // 编辑登录用户信息
        $api->patch('user', 'UserController@update');
        // 发布攻略
        $api->post('guide_add', 'GuideController@store');
        //修改攻略
        $api->patch('guides/{guide}', 'GuideController@update');
        //删除攻略
        $api->delete('guides/{guide}', 'GuideController@destroy');

        // 发布回复
        $api->post('guides/{guide}/reply', 'ReplyController@store');
        // 删除回复
        $api->delete('guides/{guide}/replies/{reply}', 'ReplyController@destroy');

    });

    //攻略列表
    $api->get('guides', 'GuideController@index');
    //某个用户的发布的攻略
    $api->get('users/{user}/guides', 'GuideController@userIndex');
    //攻略详情
    $api->get('guides/{guide}', 'GuideController@show');
    //评论列表
    $api->get('guides/{guide}/replies', 'ReplyController@index');
    // 某个用户的回复列表
    $api->get('users/{user}/replies', 'ReplyController@userIndex');

});

