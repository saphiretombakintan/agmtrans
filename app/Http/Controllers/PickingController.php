<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Picking;
use App\Pricipal;
use App\PickingDetail;
use App\Destinasi;
use PDF;

class PickingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $destinasi = Destinasi::all();
    return view('pickinghead.index', compact('destinasi'));
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
       $row[] = $list->no;
       $row[] = tanggal_indonesia(date($list->tanggal));
       $row[] = $list->id_picking;
        $row[] = $list->total_item;
       
       $data[] = $row;
     }

     $output = array("data" => $data);
     return response()->json($output);
   }
    public function create($id)
    {

    $picking = new Picking;
    $picking->id_principal = 0;
    $picking->code_destination = $id;
    $picking->total_item = 0;
    $picking->picker = 0;
    $picking->tanggal = date('Y-m-d');

    $picking->save();



    session(['idpicking' => $picking->id_picking]);
    session(['id_destinasi' => $id]);

    return Redirect::route('transaksi.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function printnotaPDF(Request $request){
       $picking = Picking::leftJoin('destination', 'destination.code_destination', '=', 'picking.code_destination')
       ->where('id_picking','=', $request['id'])->get();
       $detail = PickingDetail::leftJoin('produk', 'produk.codeitem', '=', 'pickingdetail.codeitem')
          ->where('id_picking', '=', $request['id'])
          ->get();

        $no = 0;

       $pdf = PDF::loadView('pickinghead.cetak', compact('detail', 'no', 'picking'));
       $pdf->setPaper('a4', 'potrait');
        return $pdf->stream();
     }
}
