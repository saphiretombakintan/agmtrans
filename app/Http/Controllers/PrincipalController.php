<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Principal;

class PrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('principal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function listData()
   {

     $principal = Principal::orderBy('id_principal', 'desc')->get();
     $no = 0;
     $data = array();
     foreach($principal as $list){
       $no ++;
       $row = array();
       $row[] = $no;
       $row[] = $list->nama_principal;
       $row[] = $list->alamat;
       $row[] = $list->tlp;
       $row[] = '<div class="btn-group">
               <a onclick="editForm('.$list->id_principal.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
               <a onclick="deleteData('.$list->id_principal.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';
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
      $principal = new Principal;
    $principal->nama_principal   = $request['nama'];
    $principal->alamat = $request['alamat'];
    $principal->tlp = $request['telpon'];
    $principal->save();

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
      $principal = Principal::find($id);
   echo json_encode($principal);
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
      $principal = Principal::find($id);
      $principal->nama_principal = $request['nama'];
      $principal->alamat = $request['alamat'];
      $principal->tlp = $request['telpon'];
      $principal->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $principal = Principal::find($id);
      $principal->delete();
    }
}
