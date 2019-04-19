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




Auth::routes(['verify' => true]);
Route::get('/', 'HomeController@index');
Route::group(['middleware' => ['verified']], function () {
	Route::resource('home/asuransis', 'AsuransisController');
	Route::resource('home/pasiens', 'PasiensController');
	Route::resource('home/users', 'UsersController');
	Route::resource('home/stafs', 'StafsController');
	Route::resource('home/generiks', 'GeneriksController');
	Route::resource('home/obats', 'ObatsController');
	Route::resource('home/coas', 'CoasController');
	Route::resource('home/nurse_stations', 'NurseStationController');
	Route::resource('home/kelompok_coas', 'KelompokCoasController');
	Route::resource('home/aturan_minums', 'AturanMinumsController');
	Route::resource('home/polis', 'PoliController');
	Route::get('home/pasiens/ajax/selectpasien', 'PasiensController@selectPasien');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('home/qrcode', 'QrcodeController@index');
});
Route::get('home/pasiens/image/{id}', 'PasiensController@photoCapture');


