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
$api = app('Dingo\Api\Routing\Router');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
$api->version('v1',[
    'namespace' => 'App\Http\Controllers\Api',
],function($api){


    $api->post('getCaptcha', 'CaptchaController@create');// 图片验证码
    $api->post('verificationCodes', 'VerificationCodesController@create');// 短信验证码


    $api->group([
        'namespace' => 'Frontend',
        'middleware'=>['serializer:array','bindings']
    ],function($api){

        $api->group(['namespace' => 'Auth', 'prefix' => 'auth'], function ($api) {
            $api->post('login', 'LoginController@login');
            $api->post('loginViaCode', 'LoginController@loginViaCode');
            $api->delete('logout', 'LoginController@logout');
            $api->put('refreshToken', 'LoginController@refreshToken');
        });

        // 当前登录用户信息
        $api->group(['namespace' => 'User','middleware' => 'api.auth'], function ($api) {
            $api->post('user/me', 'UserController@me');
            $api->put('user/update', 'UserController@update');
            $api->put('user/passwordReset', 'UserController@passwordReset');
        });


        $api->group([
            'namespace' => 'Goal',
        ],function($api){
            $api->get('goals','GoalController@index');
            $api->get('goals/{goal}','GoalController@show');
            $api->post('goals','GoalController@store');
            $api->patch('goals/{goal}','GoalController@update');
            $api->delete('goals','GoalController@destroy');

            $api->get('goalLogs','GoalLogController@index');


            $api->get('goalCategories','GoalCategoryController@index');
            $api->get('goalCategories/{goalCategory}','GoalCategoryController@show');
            $api->post('goalCategories','GoalCategoryController@store');
            $api->patch('goalCategories/{goalCategory}','GoalCategoryController@update');
            $api->delete('goalCategories','GoalCategoryController@destroy');

        });
    });
});

