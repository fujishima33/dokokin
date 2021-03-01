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
    
    // 日報-----------------------------------------------------------------
    // 一覧
    Route::get('report', 'General\ReportController@report');
    // 日報編集
    Route::get('report/edit', 'General\ReportController@edit');
    Route::post('report/edit', 'General\ReportController@update');
    // 打刻
    Route::post('/', 'TimestampsController@punchIn')->name('timestamp/punchin');
    Route::post('report', 'TimestampsController@punchOut')->name('timestamp/punchout');
    // 連絡事項-------------------------------------------------------------
    Route::get('info', 'GeneralController@info');
    Route::get('info/edit', 'General\InfoController@edit');
    // 申請-----------------------------------------------------------------
    Route::get('apply', 'GeneralController@apply');
    Route::get('apply/edit', 'General\ApplyController@edit');
    // 案件-----------------------------------------------------------------
    // 一覧
    Route::get('work', 'General\WorkController@index');
});

// 管理者以上
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'can:admin-higher']], function () {
    // 管理者トップページ
    Route::get('/', 'AdminController@top');
    
    // 日報-----------------------------------------------------------------
    // 社員一覧
    Route::get('report', 'Admin\ReportController@index');
    // 単独表示
    Route::get('report/single', 'Admin\ReportController@single');
    // 連絡事項---------------------------------------------------------------
    Route::get('info', 'AdminController@info');
    // 申請-------------------------------------------------------------------
    Route::get('apply', 'AdminController@apply');
    //社員情報--------------------------------------------------------------
    // ユーザ一覧
    Route::get('staff', 'Admin\StaffController@index');
    // ユーザ登録
    Route::get('staff/create', 'Admin\StaffController@add');
    Route::post('staff/create', 'Admin\StaffController@create');
    // ユーザ編集
    Route::get('staff/edit', 'Admin\StaffController@edit');
    Route::post('staff/edit', 'Admin\StaffController@update');
    Route::get('staff/delete', 'Admin\StaffController@delete');
    // 案件-------------------------------------------------------------------
    // 一覧
    Route::get('work', 'Admin\WorkController@index');
    // 作成
    Route::get('work/create', 'Admin\WorkController@add');
    Route::post('work/create', 'Admin\WorkController@create');
    // 編集
    Route::get('work/edit', 'Admin\WorkController@edit');
    Route::post('work/edit', 'Admin\WorkController@update');
    Route::get('work/delete', 'Admin\WorkController@delete');
    
    
    // 人員配置---------------------------------------------------------------
    Route::get('placement', 'Admin\PlacementController@index');
    Route::get('placement/single', 'Admin\PlacementController@single');
    Route::get('placement/edit', 'Admin\PlacementController@edit');
    Route::post('placement/single', 'Admin\PlacementController@regist');
    
    // 保留
    // Route::get('placement/create', 'Admin\PlacementController@create');
});

// システム管理者のみ
    Route::group(['middleware' => ['auth', 'can:system-only']], function () {
    });
