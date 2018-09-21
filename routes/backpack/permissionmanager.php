<?php

/*
|--------------------------------------------------------------------------
| Backpack\PermissionManager Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\PermissionManager package.
|
*/

Route::group([
            'namespace'  => 'Backpack\PermissionManager\app\Http\Controllers',
            'prefix'     => config('backpack.base.route_prefix', 'admin'),
            'middleware' => ['web', backpack_middleware()],
    ], function () {
        Route::group(['middleware' => 'permission:管理權限'], function () {
            CRUD::resource('permission', 'PermissionCrudController');
        });
        Route::group(['middleware' => 'permission:管理角色'], function () {
            CRUD::resource('role', 'RoleCrudController');
        });
        Route::group(['middleware' => 'permission:管理帳號'], function () {
            CRUD::resource('user', 'UserCrudController');
        });
    });
