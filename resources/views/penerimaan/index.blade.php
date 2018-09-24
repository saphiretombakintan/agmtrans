@extends('layouts.app')

@section('title')
  Inbound Penerimaan
@endsection

@section('breadcrumb')
   @parent
   <li>Penerimaan</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Penerimaan Baru</a>
        <a onclick="printbtb()" class="btn btn-info"><i class="fa fa-barcode"></i> Cetak BTB</a>
        @if(!empty(session('id_btb')))
        <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info"><i class="fa fa-plus-circle"></i> Transaksi Aktif</a>
        @endif
      </div>
      <div class="box-body">
        <form method="post" id="form-btb">
        {{ csrf_field() }}
<table class="table table-striped tabel-pembelian">
<thead>
   <tr>
      <th width="20"><input type="checkbox" value="1" id="select-all"></th>
      <th width="30">No</th>
      <th>Tanggal</th>
      <th>Principal</th>
      <th>No Surat Jalan</th>
      <th>No Mobil</th>
      <th>Total Ctn</th>
      <th width="100">Aksi</th>
   </tr>
</thead>
<tbody></tbody>
</table>
</form>

      </div>
    </div>
  </div>
</div>

@include('penerimaan.detail')
@include('penerimaan.pricipal')
@endsection

@section('script')
<script type="text/javascript">
var table, save_method, table1;
$(function(){
   table = $('.tabel-pembelian').DataTable({
     "processing" : true,
     "serverside" : true,
     "ajax" : {
       "url" : "{{ route('penerimaan.data') }}",
       "type" : "GET"
     }
   });

   table1 = $('.tabel-detail').DataTable({
     "dom" : 'Brt',
     "bSort" : false,
     "processing" : true
    });

   $('.tabel-supplier').DataTable();
});

function addForm(){
   $('#modal-supplier').modal('show');
}

function showDetail(id){
    $('#modal-detail').modal('show');

    table1.ajax.url("penerimaan/"+id+"/lihat");
    table1.ajax.reload();
}

function deleteData(id){
   if(confirm("Apakah yakin data akan dihapus?")){
     $.ajax({
       url : "penerimaan/"+id,
       type : "POST",
       data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
       success : function(data){
         table.ajax.reload();
       },
       error : function(){
         alert("Tidak dapat menghapus data!");
       }
     });
   }
}
function printbtb(){
  if($('input:checked').length < 1){
    alert('Pilih data yang akan dicetak!');
  }else{
    $('#form-btb').attr('target', '_blank').attr('action', "penerimaan/cetak").submit();
  }
}
</script>
@endsection
