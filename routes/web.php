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
    Route::get('/', 'GeneralController@top');
    
    // 日報
    Route::get('report', 'GeneralController@report');
    Route::get('report/edit', 'General\ReportController@edit');
    // 連絡事項
    Route::get('info', 'GeneralController@info');
    Route::get('info/edit', 'General\InfoController@edit');
    // 申請
    Route::get('apply', 'GeneralController@apply');
    Route::get('apply/edit', 'General\ApplyController@edit');
    
});

// 管理者以上
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'can:admin-higher']], function () {
    // 管理者トップページ
    Route::get('/', 'AdminController@top');
    
    // ユーザ一覧
    Route::get('staff', 'Admin\StaffController@index');
    // ユーザ登録
    Route::get('staff/create', 'Admin\StaffController@add');
    Route::post('staff/create', 'Admin\StaffController@create');
    // ユーザ編集
    Route::get('staff/edit', 'Admin\StaffController@edit');
    Route::post('staff/edit', 'Admin\StaffController@update');
    Route::get('staff/delete', 'Admin\StaffController@delete');
    
    // 日報
    Route::get('report', 'AdminController@report');
    // 連絡事項
    Route::get('info', 'AdminController@info');
    // 申請
    Route::get('apply', 'AdminController@apply');
    // 案件
    Route::get('work', 'AdminController@work');
    Route::get('work/create', 'Admin\WorkController@add');
    Route::get('work/edit', 'Admin\WorkController@edit');
    // 人員配置
    Route::get('placement', 'AdminController@placement');
    Route::get('placement/staff', 'Admin\PlacementController@staff');
    Route::get('placement/work', 'Admin\PlacementController@work');
    
});

// システム管理者のみ
    Route::group(['middleware' => ['auth', 'can:system-only']], function () {
    
    });