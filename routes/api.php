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
$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
], function ($api) {


    $api->post('getCaptcha', 'CaptchaController@create');// 图片验证码
    $api->post('verificationCodes', 'VerificationCodesController@create');// 短信验证码


    $api->group([
        'namespace' => 'Frontend',
        'middleware' => ['serializer:array', 'bindings']
    ], function ($api) {

        $api->group(['namespace' => 'Auth', 'prefix' => 'auth'], function ($api) {
            $api->post('login', 'LoginController@login');
            $api->post('loginViaCode', 'LoginController@loginViaCode');
            $api->delete('logout', 'LoginController@logout');
            $api->put('refreshToken', 'LoginController@refreshToken');
        });

// 当前登录用户信息
        $api->group(['namespace' => 'User', 'middleware' => 'api.auth'], function ($api) {
            $api->post('user/me', 'UserController@me');
            $api->put('user/update', 'UserController@update');
            $api->put('user/passwordReset', 'UserController@passwordReset');
        });


//秒杀
        $api->group(['namespace' => 'Seckill'], function ($api) {
            $api->post('seckill/placeOrder', 'SeckillPlaceOrderController@placeOrderHandle');
            $api->patch('seckill/seckillProduct/{seckillProduct}', 'SeckillProductController@update');
            $api->get('seckill/seckillProduct/{seckillProduct}', 'SeckillProductController@show');
        });

//任务
        $api->group([
            'namespace' => 'Goal',
        ], function ($api) {
            $api->get('goals', 'GoalController@index');
            $api->get('goals/{goal}', 'GoalController@show');
            $api->post('goals', 'GoalController@store');
            $api->patch('goals/{goal}', 'GoalController@update');
            $api->delete('goals', 'GoalController@destroy');

            $api->get('goalLogs', 'GoalLogController@index');


            $api->get('goalCategories', 'GoalCategoryController@index');
            $api->get('goalCategories/{goalCategory}', 'GoalCategoryController@show');
            $api->post('goalCategories', 'GoalCategoryController@store');
            $api->patch('goalCategories/{goalCategory}', 'GoalCategoryController@update');
            $api->delete('goalCategories', 'GoalCategoryController@destroy');

        });

//文章
        $api->group([
            'namespace' => 'Article',
        ], function ($api) {
            $api->get('articles', 'ArticleController@index');
            $api->get('articles/{article}', 'ArticleController@show');
            $api->get('articleCategories', 'ArticleCategoryController@index');
            $api->get('articleCategories/{articleCategory}', 'ArticleCategoryController@show');
        });
    });


    $api->group(
        [
            'namespace' => 'Backend',
            'middleware' => ['serializer:array', 'bindings'],
            'prefix' => 'backend'
        ], function ($api) {

        // 图片资源
        $api->post('images', 'Image\ImageController@store');

        $api->group([
            'namespace'=>'Auth',
            'prefix' => 'auth'
        ], function ($api) {
            $api->post('login', 'LoginController@login');
            $api->delete('logout', 'LoginController@logout');
        });
        $api->group([
            'namespace'=>'Admin',
            'prefix' => 'admin'
        ], function ($api) {
            $api->post('info', 'AdminController@info');
        });

        $api->group([
            'namespace' => 'Article',
        ], function ($api) {
            $api->get('articles', 'ArticleController@index');
            $api->get('articles/{article}', 'ArticleController@show');
            $api->post('articles', 'ArticleController@store');
            $api->patch('articles/{article}', 'ArticleController@update');
            $api->delete('articles', 'ArticleController@destroy');

            $api->get('article_categories', 'ArticleCategoryController@index');
            $api->get('article_categories/{articleCategory}', 'ArticleCategoryController@show');
            $api->post('article_categories', 'ArticleCategoryController@store');
            $api->patch('article_categories/{articleCategory}', 'ArticleCategoryController@update');
            $api->delete('article_categories', 'ArticleCategoryController@destroy');
        });
    }
    );
});

