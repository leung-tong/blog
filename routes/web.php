<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo '博客首页';
});

Route::get('/login', function () {
    abort(404);
    exit;
    return redirect(url('admin/login'));
});

Route::prefix('admin')->namespace('Backend')->group(function () {
    Route::match(['get', 'post'], 'login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');

    // 需要验证身份
    Route::middleware('auth:web')->group(function (){
        Route::get('index', 'IndexController@index');
    });

});

