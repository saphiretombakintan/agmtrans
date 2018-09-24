@extends('layouts.app')

@section('title')
  Faktur {{ tanggal_indonesia($awal, false) }} s/d {{ tanggal_indonesia($akhir, false) }}
@endsection

@section('breadcrumb')
   @parent
   <li>Faktur</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <a onclick="periodeForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Ubah Periode</a>
        <a href="{{ url('faktur/excel')}}"  class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Tambah Faktur</a>
      </div>
      <div class="box-body">

<table class="table table-striped tabel-laporan">
<thead>
   <tr>
      <th width="30">No</th>
      <th>No_faktur</th>
      <th>Po_number</th>
      <th>Code Item</th>
      <th>Qty Ctn</th>
      <th>Need By Date</th>
      <th>Destinasi</th>
   </tr>
</thead>
<tbody></tbody>
</table>

      </div>
    </div>
  </div>
</div>

@include('faktur.form')
@endsection

@section('script')
<script type="text/javascript">
var table, awal, akhir;
$(function(){
   $('#awal, #akhir').datepicker({
     format: 'yyyy-mm-dd',
     autoclose: true
   });

   table = $('.tabel-laporan').DataTable({
     "dom" : 'Brt',
     "bSort" : false,
     "bPaginate" : false,
     "processing" : true,
     "serverside" : true,
     "ajax" : {
       "url" : "faktur/data/{{ $awal }}/{{ $akhir }}",
       "type" : "GET"
     }
   });

});

function periodeForm(){
   $('#modal-form').modal('show');
}

</script>
@endsection
