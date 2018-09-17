<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Lot;
use Datatables;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $lot = Lot::all();
      return view('produk.index', compact('lot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function listData()
    {

      $produk = Produk::leftJoin('lot', 'lot.code_lot', '=', 'produk.codelot')
      ->orderBy('produk.idproduk', 'desc')
      ->get();
        $no = 0;
        $data = array();
        foreach($produk as $list){
          $no ++;
          $row = array();
           $row[] = "<input type='checkbox' name='id[]'' value='".$list->idproduk."'>";
          $row[] = $no;
           $row[] = $list->codeitem;
          $row[] = $list->desc;
          $row[] = $list->csu;
          $row[] = $list->codelot;
          $row[] = $list->stok;
          $row[] = "<div class='btn-group'>
                   <a onclick='editForm(".$list->idproduk.")' class='btn btn-primary btn-sm'><i class='fa fa-pencil'></i></a>
                  <a onclick='deleteData(".$list->idproduk.")' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a></div>";
          $data[] = $row;
        }

        return Datatables::of($data)->escapeColumns([])->make(true);
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
      $jml = Produk::where('codeitem', '=', $request['kode'])->count();
    if($jml < 1){
        $produk = new Produk;
        $produk->codeitem     = $request['kode'];
        $produk->desc    = $request['nama'];
        $produk->csu          = $request['csu'];
        $produk->weigh      = $request['weigh'];
        $produk->volume       = $request['volume'];
        $produk->codelot    = $request['code_lot'];
        $produk->stok          = $request['stok'];
        $produk->save();
        echo json_encode(array('msg'=>'success'));
    }else{
        echo json_encode(array('msg'=>'error'));
    }
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
