<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'SettingController@index')->name('home');
Route::delete('settings/destroy-all', 'SettingController@destroyAll')->name('settings.destroy_all');
Route::get('settings/get-data', 'SettingController@getdata')->name('settings.get_data');
Route::get('settings/create', 'SettingController@create')->name('settings.create');
Route::post('settings/store', 'SettingController@store')->name('settings.store');
