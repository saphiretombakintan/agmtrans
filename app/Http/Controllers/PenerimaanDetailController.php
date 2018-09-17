<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Penerimaan;
use App\Principal;
use App\Produk;
use App\PenerimaanDetail;

class PenerimaanDetailController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $produk = Produk::all();
    $idpenerimaan = session('idbtb');
    $principal = Principal::find(session('id_principal'));
    return view('penerimaandetail.index', compact('produk', 'idpenerimaan', 'principal'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
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
  
  public function listData($id)
  {

    $detail = PenerimaanDetail::where('id_btb', '=', $id)->get();

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
      $row[] = "<input type='number' class='form-control' name='jumlah_$list->id_btb_detail' value='$list->qty_ctn' onChange='changeCount($list->id_btb_detail)'>";
      $row[] = $list->csu * $list->qty_ctn;
      $row[] = "<input type='text' class='form-control' name='date_$list->id_btb_detail' value='$list->exp_date' onChange='changeCount($list->id_btb_detail)'>";
      $row[] = '<a onclick="deleteItem('.$list->id_btb_detail.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
      $data[] = $row;
      //
      // $total += $list->csu * $list->jumlah;
      // $total_item += $list->jumlah;
    }
    $output = array("data" => $data);
    return response()->json($output);
  }
  public function store(Request $request)
  {
    $produk = Produk::where('codeitem', '=', $request['kode'])->first();
    $detail = new PenerimaanDetail;
    $detail->id_btb = $request['idpenerimaan'];
    $detail->codeitem = $request['kode'];
    $detail->desc = $produk->desc;
    $detail->csu = $produk->csu;
    $detail->qty_ctn = 1;
    $detail->pcs = 1;
    $detail->exp_date = '2018-12-11';
    $detail->lot_number = $produk->codelot;
    $detail->save();

  }

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
    $date = "date_".$id;
    $detail = PenerimaanDetail::find($id);
    $detail->qty_ctn = $request[$nama_input];
    $detail->pcs = $detail->csu * $request[$nama_input];
    $detail->exp_date = $request[$date];
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
    //
  }
}
