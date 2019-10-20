<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::combine([
    '/',
    '/goals/create','/goals/{goal}/edit','/goals/{goal}/show'
    ,'/auth/login','/auth/loginViaCode',
    '/user/','/user/edit','/user/passwordReset',
    '/seckill',
], function () {
    return view('index');
});
Route::combine([
    '/backend'
], function () {
    return view('backend.index');
});