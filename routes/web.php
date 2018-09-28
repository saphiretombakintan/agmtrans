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

Route::get('/faktur/excel', function () {
    return view('faktur.excel');
});
Route::post('importproduk', 'FakturController@importExcel');

      Route::get('penerimaan/data', 'PenerimaanController@listData')->name('penerimaan.data');
      Route::get('penerimaan/{id}/tambah', 'PenerimaanController@create');
      Route::get('penerimaan/{id}/lihat', 'PenerimaanController@show');
      Route::get('penerimaandetail/loadform/{diskon}/{total}', 'PenerimaanDetailController@loadForm');
      Route::post('penerimaan/cetak', 'PenerimaanController@printbtb');
      Route::resource('penerimaan', 'PenerimaanController');

      Route::get('produk/data', 'ProdukController@listData')->name('produk.data');
      Route::post('produk/hapus', 'ProdukController@deleteSelected');
      Route::post('produk/cetak', 'ProdukController@printBarcode');
      Route::resource('produk', 'ProdukController');


      Route::get('penerimaandetail/{id}/data', 'PenerimaanDetailController@listData')->name('penerimaandetail.data');
      Route::resource('penerimaandetail', 'PenerimaanDetailController');
      Route::get('principal/data', 'PrincipalController@listData')->name('principal.data');
      Route::resource('principal', 'PrincipalController');

      Route::get('lot/data', 'LotController@listData')->name('lot.data');
      Route::resource('lot', 'LotController');

      Route::get('transaksi/baru', 'PickingDetailController@newSession')->name('picking.new');
      Route::get('transaksi/{id}/data', 'PickingDetailController@listData')->name('picking.data');
      Route::get('transaksi/cetaknota', 'PickingDetailController@printNota')->name('picking.cetak');
      Route::get('transaksi/notapdf', 'PickingDetailController@notaPDF')->name('picking.pdf');
      Route::post('transaksi/simpan', 'PickingDetailController@saveData');
      Route::get('transaksi/loadform/{diskon}/{total}/{diterima}', 'PickingDetailController@loadForm');
      Route::resource('transaksi', 'PickingDetailController');

      // Route::get('tanggal', function(){
      //   echo tanggal_indonesia(date('Y-m-d'));

     Route::get('faktur', 'FakturController@index')->name('faktur.index');
     Route::post('faktur', 'FakturController@refresh')->name('faktur.refresh');
     Route::get('faktur/data/{awal}/{akhir}', 'FakturController@listData')->name('faktur.data');
