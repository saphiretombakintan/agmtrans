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
    return view('layouts.app');
});

      Route::get('penerimaan/data', 'PenerimaanController@listData')->name('penerimaan.data');
      Route::get('penerimaan/{id}/tambah', 'PenerimaanController@create');
      Route::get('penerimaan/{id}/lihat', 'PenerimaanController@show');
      Route::resource('penerimaan', 'PenerimaanController');

      Route::get('produk/data', 'ProdukController@listData')->name('produk.data');
      Route::post('produk/hapus', 'ProdukController@deleteSelected');
      Route::post('produk/cetak', 'ProdukController@printBarcode');
      Route::resource('produk', 'ProdukController');


      Route::get('penerimaandetail/{id}/data', 'PenerimaanDetailController@listData')->name('penerimaandetail.data');
      Route::get('penerimaandetail/loadform/{diskon}/{total}', 'PenerimaanDetailController@loadForm');
      Route::resource('penerimaandetail', 'PenerimaanDetailController');
      Route::post('penerimaandetail/post', 'PenerimaanDetailController@store')->name('route.test');

      Route::get('principal/data', 'PrincipalController@listData')->name('principal.data');
      Route::resource('principal', 'PrincipalController');

      Route::get('lot/data', 'LotController@listData')->name('lot.data');
      Route::resource('lot', 'LotController');
