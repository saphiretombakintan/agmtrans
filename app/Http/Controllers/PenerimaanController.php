<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Principal;
use App\Penerimaan;
use App\PenerimaanDetail;
use App\Produk;
use PDF;

class PenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $principal = Principal::all();
      return view('penerimaan.index', compact('principal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function listData()
   {

     $penerimaan = Penerimaan::leftJoin('principal', 'principal.id_principal', '=', 'btbheader.id_principal')
        ->orderBy('btbheader.id_btb', 'desc')
        ->get();
     $no = 0;
     $data = array();
     foreach($penerimaan as $list){
       $no ++;
       $row = array();
       $row[] = "<input type='checkbox' name='id[]'' value='".$list->id_btb."'>";
       $row[] = $no;
       $row[] = tanggal_indonesia(date($list->tanggal));
       $row[] = $list->nama_principal;
       $row[] = $list->no_SJ;
       $row[] = $list->no_mobil;
        $row[] = $list->total_item;

       $data[] = $row;
     }

     $output = array("data" => $data);
     return response()->json($output);
   }
    public function create($id)
    {
    $penerimaan = new Penerimaan;
    $penerimaan->id_principal = $id;
    $penerimaan->total_item = 0;
    $penerimaan->tanggal = date('d-m-Y');
    $penerimaan->no_SJ = 0;
    $penerimaan->no_mobil = 0;

    $penerimaan->save();

    session(['idbtb' => $penerimaan->id_btb]);
    session(['id_principal' => $id]);

    return Redirect::route('penerimaandetail.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $pnerimaan = Penerimaan::find($request['idpenerimaan']);
    $pnerimaan->total_item = $request['totalitem'];
    $pnerimaan->no_SJ = $request['no_SJ'];
    $pnerimaan->no_mobil = $request['no_mobil'];
    $pnerimaan->update();

    $detail = PenerimaanDetail::where('id_btb', '=', $request['idpenerimaan'])->get();
    foreach($detail as $data){
      $produk = Produk::where('codeitem', '=', $data->codeitem)->first();
      $produk->stok += $data->qty_ctn;
      $produk->update();
    }
    return Redirect::route('penerimaan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $detail = Penerimaandetail::where('id_btb', '=', $id)
      ->get();
   $no = 0;
   $data = array();
   foreach($detail as $list){
     $no ++;
     $row = array();
     $row[] = $no;
     $row[] = $list->codeitem;
     $row[] = $list->desc;
     $row[] = $list->csu;
     $row[] = $list->qty_ctn;
     $row[] = $list->exp_date;
     $row[] = $list->lot_number;
     $data[] = $row;
   }

   $output = array("data" => $data);
   return response()->json($output);
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
        //
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

    public function printbtb(Request $request)
   {
     $datapenerimaan = PenerimaanDetail::where('id_btb', $request['id'])->get();
     $penerimaan = Penerimaan::leftJoin('principal', 'principal.id_principal', '=', 'btbheader.id_principal')
     ->where('id_btb', $request['id'])->get();
     $no = 0;
      $pdf = PDF::loadView('penerimaan.pdf', compact('datapenerimaan', 'penerimaan','no'));
      $pdf->setPaper('a4', 'potrait');
      return $pdf->stream();
   }
}
