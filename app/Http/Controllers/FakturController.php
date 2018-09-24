<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faktur;

use Redirect;
use Input;
use Excel;

class FakturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   // $awal = date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y')));
   $awal = date('Y-m-d');
   $akhir = date('Y-m-d', strtotime("+3 months", strtotime($awal)));
   return view('faktur.index', compact('awal', 'akhir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected function getData($awal, $akhir){
     $no = 0;
     $data = array();
     while(strtotime($awal) <= strtotime($akhir)){
       $tanggal = $awal;
       $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));
       $faktur = Faktur::where('need_by_date', 'LIKE', "$tanggal")->get();

       foreach($faktur as $list){
       $no ++;
       $row = array();
       $row[] = $no;
       $row[] = $list->no_faktur;
       $row[] = $list->po_number;
       $row[] = $list->codeitem;
       $row[] = $list->id_principal;
       $row[] = $list->need_by_date;
       $row[] = $list->code_destinasi;
       $data[] = $row;
     }
     }
     // $data[] = array("", "", "", "", "Total Pendapatan", format_uang($total_pendapatan));
     //
     return $data;
   }
   public function listData($awal, $akhir)
   {
     $data = $this->getData($awal, $akhir);

     $output = array("data" => $data);
     return response()->json($output);
   }

   public function refresh(Request $request)
   {
     $awal = $request['awal'];
     $akhir = $request['akhir'];
     return view('faktur.index', compact('awal', 'akhir'));
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

    public function importExcel(Request $request){
      if($request->hasFile('file')){
         $path = $request->file('file')->getRealPath();
         $data = Excel::load($path, function($reader){})->get();
         if(!empty($data) && $data->count()){
            foreach($data as $key => $val){
               $faktur = new Faktur;
               $faktur->no_faktur = $val->no_faktur;
               $faktur->po_number = $val->po_number;
               $faktur->codeitem = $val->codeitem;
               $faktur->qty_ctn = $val->qty_ctn;
               $faktur->id_principal = $val->id_principal;
               $faktur->need_by_date = $val->need_by_date;
               $faktur->code_destinasi = $val->destinasi;
               $faktur->save();
            }

         }
      }

      return redirect('faktur');
   }
}
