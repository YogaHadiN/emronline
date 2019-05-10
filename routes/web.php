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
	Route::get('home/pasiens/photo_terdeteksi', 'PasienController@photoTerdeteksi');
	Route::resource('home/asuransis', 'AsuransiController');
	Route::resource('home/pasiens', 'PasienController');
	Route::resource('home/users', 'UserController');
	Route::resource('home/stafs', 'StafController');
	Route::resource('home/generiks', 'GenerikController');
	Route::resource('home/obats', 'ObatController');
	Route::resource('home/coas', 'CoaController');
	Route::get('home/transaksi_periksa/{id}/create', 'PeriksaController@transaksiPeriksa');
	Route::get('home/nursestation/{id}/create', 'NurseStationController@create');
	Route::resource('home/nurse_stations', 'NurseStationController');
	Route::resource('home/kelompok_coas', 'KelompokCoaController');
	Route::resource('home/aturan_minums', 'AturanMinumController');
	Route::get('home/terapis/jenis_obat_puyer', 'ObatController@jenisObatPuyer');
	Route::get('home/terapis/jenis_obat_standar', 'ObatController@jenisObatStandar');
	Route::get('home/terapis/jenis_obat_add', 'ObatController@jenisObatAdd');
	Route::resource('home/polis', 'PoliController');
	Route::resource('home/jenis_tarifs', 'JenisTarifController');
	Route::resource('home/icds', 'IcdController');
	Route::resource('home/diagnosas', 'DiagnosaController');
	Route::get('home/transaksi_periksas/{id}/create', 'TransaksiPeriksaController@create');
	Route::resource('home/transaksis', 'TransaksiPeriksaController');
	Route::get('home/nurse_stations/{id}/periksa', 'PeriksaController@create');
	Route::resource('home/periksas', 'PeriksaController');
	Route::get('home/pasiens/{id}/daftar', 'DaftarController@create');
	Route::resource('home/daftars', 'DaftarController');
	Route::get('home/pasiens/ajax/selectpasien', 'PasienController@selectPasien');
	Route::get('home/pasiens/ajax/cekimage', 'PasienController@cekImage');
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('home/qrcode', 'QrcodeController@index');
	Route::get('home/pasiens/pasienimage/{filename}', 'PasienController@userImagePath');
	Route::get('home/nurse_stations/{id}/periksa/terapi', 'TerapiController@create');
});
Route::get('home/pasiens/image/{id}', 'PasienController@photoCapture');
Route::post('home/pasiens/image', 'PasienController@storePhoto');


