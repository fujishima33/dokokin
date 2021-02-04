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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('top');
});

// 全ユーザ
Route::group(['prefix' => 'general', 'middleware' => ['auth', 'can:user-higher']], function () {
  // 一般ユーザトップページ
    Route::get('/', 'General\GeneralController@top');
});

// 管理者以上
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'can:admin-higher']], function () {
    // 管理者トップページ
    Route::get('/', 'Admin\StaffController@top');
    
    // ユーザ一覧
    Route::get('staff', 'Admin\StaffController@index');
    
    // ユーザ登録
    Route::get('staff/create', 'Admin\StaffController@add');
    Route::post('staff/create', 'Admin\StaffController@create');
    
    // ユーザ編集
    Route::get('staff/edit', 'Admin\StaffController@edit');
    Route::post('staff/edit', 'Admin\StaffController@update');
    Route::get('staff/delete', 'Admin\StaffController@delete');
});

// システム管理者のみ
    Route::group(['middleware' => ['auth', 'can:system-only']], function () {
    
    });