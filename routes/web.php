<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo '博客首页';
});

//Route::get('/login', function () {
//    return redirect(url('admin/login'));
//});

Route::get('/test',function (){
    echo "<pre>";
//    $route = Route::current();
//    print_r($route).'<br>';
    $name = Route::currentRouteName();
    ($name).'<br>';

    $action = Route::currentRouteAction();
    print_r($action).'<br>';

});

Route::prefix('admin')->namespace('Backend')->group(function () {
    Route::match(['get', 'post'], 'login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');

    // 更改权限后 重新刷新redis
    // admin/user/index post
    // 需要验证身份
    Route::middleware('auth:web')->group(function () {
        Route::get('index', 'IndexController@index');
        // 菜单管理
        Route::match(['get','post'],'/menu/index', 'MenuController@index');
        Route::post('/menu/update', 'MenuController@update');
        Route::post('/menu/delete', 'MenuController@delete');
        // 角色管理
        Route::match(['get','post'],'/role/index', 'RoleController@index');
        Route::post('/role/insert', 'RoleController@insert');
        Route::post('/role/update', 'RoleController@update');
        Route::post('/role/delete', 'RoleController@delete');
        // 权限管理
        Route::match(['get','post'],'/permission/index', 'PermissionController@index');
        Route::post('/permission/insert', 'PermissionController@insert');
        Route::post('/permission/update', 'PermissionController@update');
        Route::post('/permission/delete', 'PermissionController@delete');
        // 用户管理
        Route::match(['get','post'],'/user/index', 'UserController@index');
        Route::post('/user/insert', 'UserController@insert');
        Route::post('/user/update', 'UserController@update');
        Route::post('/user/delete', 'UserController@delete');
    });

});

