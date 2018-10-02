<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\DeliveryDetail;
use App\Picking;
use App\DeliveryOrder;
use PDF;

class DeliveryDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iddo = session('iddo');
        $iddestinasi = session('iddestinasi');
        $picking = Picking::all();
        $sumitem = DeliveryDetail::where('id_do', session('iddo'))->sum('total_item');
        return view('delivery_detail.index', compact('iddo', 'iddestinasi', 'picking', 'sumitem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $picking = Picking::where('id_picking', '=', $id)->get();
      foreach ($picking as $list) {
      $detail = new DeliveryDetail;
      $detail->id_do = $iddo = session('iddo'); ;
      $detail->id_picking = $list->id_picking;
      $detail->total_item = $list->total_item;
      $detail->save();
      }
      return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function listData($id)
    {
        $detail = DeliveryDetail::where('id_do', '=', $id)->get();
        $no = 0;
        $data = array();
        foreach ($detail as $list) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $list->id_picking;
            $row[] = $list->total_item;
            $data[] = $row;
        }
        $output = array("data"=> $data);
        return response()->json($output);
      }
    public function store(Request $id)
    {

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
    public function savedata(Request $request)
    {
        $delivery = DeliveryOrder::where('id_do', '=', $request->code_customer);
        $delivery->update([
              'id_picking' => session('iddo'),
            'total_item' => $request->input('totalitem')
        ]);

        return Redirect::route('deliveryorder.pdf');
    }


    public function printdo(){
      $iddo = session('iddo');
      $datapenerimaan = DeliveryOrder::leftJoin('destination', 'destination.code_destination', '=', 'delivery.id_destination')
      ->where('id_do', '=', $iddo)->get();
      	$dates = date('d-m-Y');
      // $penerimaan = Penerimaan::leftJoin('principal', 'principal.id_principal', '=', 'btbheader.id_principal')
      // ->where('id_btb', $request['id'])->get();
      // $destinasi = Destinasi::where('code_destination', '=', $datapenerimaan->)->get();
      $detail = DeliveryDetail::leftJoin('pickingdetail', 'pickingdetail.id_picking', '=', 'deliverydetail.id_picking')
      ->where('id_do', '=', $iddo)->get();
      $no = 0;
       $pdf = PDF::loadView('delivery_detail.pdf', compact('datapenerimaan', 'detail','no', 'iddo','dates'));
       $pdf->setPaper('a4', 'potrait');
       return $pdf->stream();
     }
}
