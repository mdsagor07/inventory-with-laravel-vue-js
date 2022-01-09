<?php
//laravel 8 update 
use app\Http\Controllers\AuthController;
use app\Http\Controllers\Api\EmployeeController;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@signup');

    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

});

Route::apiResource('/employee',App\Http\Controllers\Api\EmployeeController::class);
Route::apiResource('/supplier',App\Http\Controllers\Api\SupplierController::class);
Route::apiResource('/category',App\Http\Controllers\Api\CategoryController::class);
Route::apiResource('/product',App\Http\Controllers\Api\ProductController::class);

