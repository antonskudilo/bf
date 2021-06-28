<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Api'], function () {
    Route::get('/news/{filter?}', 'NewsController@index')->name('news.index');
    Route::apiResource('news', 'NewsController', [
        'only' => ['show']
    ]);

    Route::group(['middleware' => ['admin'], 'namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/news/{filter?}', 'NewsController@index')->name('news.index');
        Route::put('/news/change-status/{news}', 'NewsController@changeStatus')->name('news.change-status');
        Route::apiResource('news', 'NewsController', [
            'only' => ['show', 'store'],
        ]);
    });
});
