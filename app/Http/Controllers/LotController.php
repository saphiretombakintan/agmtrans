<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lot;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lot.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function listData()
  {

    $lot = Lot::orderBy('id_lot', 'desc')->get();
    $no = 0;
    $data = array();
    foreach($lot as $list){
      $no ++;
      $row = array();
      $row[] = $no;
      $row[] = $list->code_lot;
      $row[] = $list->location;
      $row[] = '<div class="btn-group">
              <a onclick="editForm('.$list->id_lot.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
              <a onclick="deleteData('.$list->id_lot.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';
      $data[] = $row;
    }

    $output = array("data" => $data);
    return response()->json($output);
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
    public function store(Request $request)
    {
      $lot = new Lot;
    $lot->code_lot = $request['nama'];
    $lot->location = $request['lokasi'];
    $lot->capacity = 0;
    $lot->volume = 0;
    $lot->save();
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
}
