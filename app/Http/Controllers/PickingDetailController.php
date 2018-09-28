<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use PDF;
use App\Picking;
use App\Produk;
use App\PickingDetail;
use App\Faktur;

class PickingDetailController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $faktur = Faktur::distinct()->get(['no_faktur', 'need_by_date']);;
    $idpenjualan = session('idpenjualan');
    $sumqtyctn = PickingDetail::where('id_picking', session('idpenjualan'))->sum('jml');
    $tanggal= date('Y-m-d');
    return view('picking.index', compact('faktur', 'idpenjualan', 'sumqtyctn', 'tanggal'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */

  public function listData($id)
  {

    $detail = PickingDetail::leftJoin('produk', 'produk.codeitem', '=', 'pickingdetail.codeitem')
    ->where('id_picking', '=', $id)
    ->get();
    $no = 0;
    $data = array();
    // $total = 0;
    // $total_item = 0;
    foreach($detail as $list){
      $no ++;
      $row = array();
      $row[] = $no;
      $row[] = $list->codeitem;
      $row[] = $list->desc;
      $row[] = $list->csu;
      $row[] = $list->qty_ctn;
      $row[] = "<input type='number' class='form-control' name='jumlah_$list->id_picking_detail' value='$list->jml' onChange='changeCount($list->id_picking_detail)'>";
      $row[] = $list->pcs;
      $row[] = $list->lot;
      $row[] = '<div class="btn-group">
      <a onclick="deleteItem('.$list->id_picking_detail.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
      $data[] = $row;
      //
      // $total += $list->harga_jual * $list->jumlah;
      // $total_item += $list->jumlah;
    }
    //
    // $data[] = array("<span class='hide total'>$total</span><span class='hide totalitem'>$total_item</span>", "", "", "", "", "", "", "");
    //
    $output = array("data" => $data);
    return response()->json($output);
  }
  public function store(Request $request)
  {
    $faktur = Faktur::where('no_faktur', '=', $request['kode'])->get();
    foreach ($faktur as $detail) {
      $fakturd = Faktur::leftJoin('produk', 'produk.codeitem', '=', 'faktur.codeitem')
      ->where('id_faktur', '=', $detail->id_faktur)->first();
      $detail = new PickingDetail;
      $detail->id_picking = $request['idpenjualan'];
      $detail->no_faktur = $request['kode'];
      $detail->codeitem = $fakturd->codeitem;
      $detail->desc = $fakturd->desc;
      $detail->csu = $fakturd->csu;
      $detail->qty_ctn = $fakturd->qty_ctn;
      $detail->jml = $fakturd->qty_ctn;
      $detail->pcs = $fakturd->qty_ctn * $fakturd->csu;
      $detail->lot = $fakturd->codelot;
      $detail->save();
    }

  }


  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */


  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {

      $nama_input = "jumlah_".$id;
      $detail = PickingDetail::find($id);
      $detail->jml = $request[$nama_input];
      $detail->pcs = $detail->csu * $request[$nama_input];
      $detail->update();
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
      $detail = PickingDetail::find($id);
      $detail->delete();
  }

  public function saveData(Request $request)
   {
      $picking = Picking::find($request['idpenjualan']);
      $picking->id_principal = 0;
      $picking->total_item = $request['total'];
      $picking->picker = 0;
      $picking->tanggal = $request['tanggal'];
      $picking->update();

      $detail = PickingDetail::where('id_picking', '=', $request['idpenjualan'])->get();
      foreach($detail as $data){
        $produk = Produk::where('codeitem', '=', $data->codeitem)->first();
        $produk->stok -= $data->jml;
        $produk->update();
      }
      return Redirect::route('picking.pdf');
   }

  public function newSession()
  {
    $picking = new Picking;
    $picking->id_principal = 0;
    $picking->total_item = 0;
    $picking->picker = 0;
    $picking->tanggal = 0;
    $picking->save();

    session(['idpenjualan' => $picking->id_picking]);

    return Redirect::route('transaksi.index');
  }

  public function notaPDF(){
     $detail = PickingDetail::leftJoin('produk', 'produk.codeitem', '=', 'pickingdetail.codeitem')
        ->where('id_picking', '=', session('idpenjualan'))
        ->get();

      $picking= Picking::find(session('idpenjualan'));
      $no = 0;

     $pdf = PDF::loadView('picking.cetak', compact('detail', 'picking', 'no'));
     $pdf->setPaper('a4', 'potrait');
      return $pdf->stream();
   }
}
