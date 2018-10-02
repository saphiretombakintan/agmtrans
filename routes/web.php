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

      Route::get('picking/data', 'PickingController@listData')->name('pickinghead.data');
      Route::get('picking/{id}/tambah', 'PickingController@create');
      Route::get('picking/{id}/lihat', 'PickingController@show');
      Route::get('picking/loadform/{diskon}/{total}', 'PickingController@loadForm');
      Route::post('picking/cetak', 'PickingController@printnotaPDF');
      Route::resource('picking', 'PickingController');






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

     Route::get('delivery/data', 'DeliveryOrderController@listData')->name('delivery.data');
     Route::get('delivery/{id}/tambah', 'DeliveryOrderController@create');
     Route::get('delivery/{id}/lihat', 'DeliveryOrderController@show');
     Route::get('delivery/loadform/{diskon}/{total}', 'DeliveryOrderController@loadForm');
     Route::post('delivery/cetak', 'DeliveryOrderController@printbtb');
     Route::resource('delivery', 'DeliveryOrderController');

     Route::get('delivery_detail/{id}/data', 'DeliveryDetailController@listData')->name('delivery_detail.data');
     Route::get('delivery_detail/{id}/tambah', 'DeliveryDetailController@create');
     Route::get('delivery_detail/loadform/{diskon}/{total}', 'DeliveryDetailController@loadForm');
     Route::get('delivery_detail/data','DeliveryDetailController@update');
     Route::post('delivery_detail/savedata','DeliveryDetailController@savedata')->name('delivery_detail.savedata');
     Route::get('delivery_detail/pdf', 'DeliveryDetailController@printdo')->name('deliveryorder.pdf');
     Route::resource('delivery_detail', 'DeliveryDetailController');
