@extends('layouts.app')

@section('title')
 Picking List
@endsection

@section('breadcrumb')
   @parent
   <li>Delivery Order</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Buat DO</a>
        <a onclick="printbtb()" class="btn btn-info"><i class="fa fa-barcode"></i> Cetak Picking List</a>
        @if(!empty(session('id_btb')))
        <a href="" class="btn btn-info"><i class="fa fa-plus-circle"></i> Transaksi Aktif</a>
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
      <th>No Picking</th>
      <th>Principal</th>
      <th>Destinasi</th>
      <th>Total Ctn</th>
      <th>Picker</th>
      <th>Tanggal</th>
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

@include('delivery_order.detail')
@include('delivery_order.input')
@endsection

@section('script')
<script type="text/javascript">
var table, save_method, table1;
$(function(){
   table = $('.tabel-pembelian').DataTable({
     "processing" : true,
     "serverside" : true,
     "ajax" : {
       "url" : "{{ route('delivery.data') }}",
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

    table1.ajax.url("delivery/"+id+"/lihat");
    table1.ajax.reload();
}

function deleteData(id){
   if(confirm("Apakah yakin data akan dihapus?")){
     $.ajax({
       url : "Delivery/"+id,
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
    $('#form-btb').attr('target', '_blank').attr('action', "delivery/cetak").submit();
  }
}
</script>
@endsection
