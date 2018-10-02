<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Picking;
use App\Principal;
use App\PickingDetail;
use App\Destinasi;
use App\DeliveryOrder;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $picking = Picking::all();
      $destinasi = Destinasi::all();
    return view('delivery_order.index', compact('picking', 'destinasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function listData()
   {

     $picking = Picking::leftJoin('principal', 'principal.id_principal', '=', 'picking.id_principal')
        ->orderBy('picking.id_picking', 'desc')
        ->get();
     $no = 0;
     $data = array();
     foreach($picking as $list){
       $no ++;
       $row = array();
       $row[] = "<input type='checkbox' name='id[]'' value='".$list->id_picking."'>";
       $row[] = $no;
       $row[] = $list->id_picking;
       $row[] = $list->nama_principal;
       $row[] = $list->code_destination;
       $row[] = $list->total_item;
       $row[] = $list->picker;
        $row[] = $list->tanggal;
       $row[] = '<div class="btn-group">
               <a onclick="showDetail('.$list->id_picking.')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
               <a onclick="deleteData('.$list->id_picking.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
              </div>';
       $data[] = $row;
     }

     $output = array("data" => $data);
     return response()->json($output);
   }
    public function create()
    {
      $delivery = new DeliveryOrder;
      $delivery->id_picking = $id;
      $delivery->id_destination = 0;
      $delivery->total_item = 0;
      $delivery->picker = 0;
      $delivery->tanggal = date('d-m-Y');

      $delivery->save();

      session(['iddo' => $delivery->id_do]);
      session(['id_picking' => $id]);

      return Redirect::route('delivery_order.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $delivery = new DeliveryOrder;
          $delivery->id_picking     = 0;
          $delivery->id_destination    = $request['codedestinasi'];
          $delivery->total_item    = 0;
          $delivery->picker          = 0;
          $delivery->tanggal      = $request['tanggal'];
          $delivery->nomobil       = $request['kode'];
          $delivery->namasupir    = $request['nama'];
          $delivery->save();

          session(['iddo' => $delivery->id_do]);
          session(['iddestinasi' => $delivery->id_destination]);

          return Redirect::route('delivery_detail.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $detail = PickingDetail::where('id_picking', '=', $id)
      ->get();
   $no = 0;
   $data = array();
   foreach($detail as $list){
     $no ++;
     $row = array();
     $row[] = $no;
     $row[] = $list->no_faktur;
     $row[] = $list->codeitem;
     $row[] = $list->desc;
     $row[] = $list->csu;
     $row[] = $list->qty_ctn;
     $row[] = $list->jml;
     $row[] = $list->pcs;
     $row[] = $list->lot;
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
}
