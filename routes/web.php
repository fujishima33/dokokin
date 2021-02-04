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

Route::get('/', function () {
    return view('top');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('staff', 'Admin\StaffController@show');
    Route::get('staff/create', 'Admin\StaffController@add');
    Route::get('staff/edit', 'Admin\StaffController@edit');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
