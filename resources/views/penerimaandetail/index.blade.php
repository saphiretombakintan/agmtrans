@extends('layouts.app')

@section('title')
  Inbound Penerimaan
@endsection

@section('breadcrumb')
   @parent
   <li>Inbound</li>
   <li>tambah</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">

     <div class="box-body">

<table>
  <tr><td width="150">Principal</td><td><b>{{ $principal->nama_principal }}</b></td></tr>
  <tr><td>Alamat</td><td><b>{{ $principal->alamat }}</b></td></tr>
  <tr><td>Telpon</td><td><b>{{ $principal->tlp }}</b></td></tr>
</table>
<hr>

<form class="form form-horizontal form-produk" method="post">
{{ csrf_field() }}
  <input type="hidden" name="idpenerimaan" value="{{ $idpenerimaan }}">
  <div class="form-group">
      <label for="kode" class="col-md-2 control-label">Code Item</label>
      <div class="col-md-5">
        <div class="input-group">
          <input id="kode" type="text" class="form-control" name="kode" autofocus required>
          <span class="input-group-btn">
            <button onclick="showProduct()" type="button" class="btn btn-info">...</button>
          </span>
        </div>
      </div>
  </div>
</form>

<form class="form-keranjang">
{{ csrf_field() }} {{ method_field('PATCH') }}
<table class="table table-striped tabel-pembelian">
<thead>
   <tr>
      <th width="30">No</th>
      <th>Code Item</th>
      <th>Desc</th>
      <th align="right">Csu</th>
      <th>Qty Ctn</th>
      <th align="right">Pcs</th>
      <th align="right">Exp_date</th>
      <th width="100">Aksi</th>
   </tr>
</thead>
<tbody>

</tbody>
</table>
</form>
<div class="col-md-8">
     {{-- <div id="tampil-bayar" style="background: #dd4b39; color: #fff; font-size: 80px; text-align: center; height: 100px"></div>
     <div id="tampil-terbilang" style="background: #3c8dbc; color: #fff; font-weight: bold; padding: 10px"></div> --}}
  </div>

  <div class="col-md-4">
    <form class="form form-horizontal form-pembelian" method="post" action="{{  route('penerimaan.store') }} ">
      {{ csrf_field() }}
      <input type="hidden" name="idpenerimaan" value="{{ $idpenerimaan }}">
      <input type="hidden" name="total" id="total">
      <input type="hidden" name="totalitem" value="{{ $sumqtyctn }}">
      <input type="hidden" name="bayar" id="bayar">

      {{-- <div class="form-group">
        <label for="totalrp" class="col-md-4 control-label">Total ctn</label>
        <div class="col-md-8">
          <input type="text" class="form-control" id="totalitem" readonly>
        </div>
      </div> --}}

      <div class="form-group">
        <label for="diskon" class="col-md-4 control-label">No Surat Jalan</label>
        <div class="col-md-8">
          <input type="text" class="form-control" id="no_SJ" name="no_SJ" autofocus required>
        </div>
      </div>

      <div class="form-group">
        <label for="bayarrp" class="col-md-4 control-label">No Mobil</label>
        <div class="col-md-8">
          <input type="text" class="form-control" id="no_mobil" name="no_mobil" autofocus required>
        </div>
      </div>

    </form>
  </div>

      </div>

      <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right simpan"><i class="fa fa-floppy-o"></i> Simpan Transaksi</button>
      </div>
    </div>
  </div>
</div>

@include('penerimaandetail.produk')
@endsection

@section('script')
<script type="text/javascript">
var table;
$(function(){


  $('.tabel-produk').DataTable();

  table = $('.tabel-pembelian').DataTable({
     // "dom" : 'Brt',
     // "bSort" : false,
     // "processing" : true,
     "ajax" : {
       "url" : "{{ route('penerimaandetail.data', $idpenerimaan) }}",
       "type" : "GET"
     }
  }).on('draw.dt', function(){
    loadForm($('').val());
  });


  $('.form-produk').on('submit', function(){
      return false;
   });

   $('#kode').change(function(){
      addItem();
      loadForm();
   });

   $('.form-keranjang').submit(function(){
     return false;
   });

   $('#diskon').change(function(){
      if($(this).val() == "") $(this).val(0).select();
      loadForm();
   });

   $('.simpan').click(function(){
      $('.form-pembelian').submit();
   });

});


function addItem(kode){
  $.ajax({
    url : "{{ route('penerimaandetail.store') }}",
    type : "POST",
    data : $('.form-produk').serialize(),
    success : function(data){
      $('#kode').val(kode).focus();
      table.ajax.reload(function(){
      loadForm($('#diskon').val());
      location = self.location;
      });
    },
    error : function(){
       alert("Tidak dapat menyimpan data!");
    }
  });
}

function selectItem(kode){
  $('#kode').val(kode);
  alert(kode);
  $('#modal-produk').modal('hide');
  addItem(kode);
}

function changeCount(id){
  var input
     $.ajax({
        url : "penerimaandetail/"+id,
        type : "POST",
        data : $('.form-keranjang').serialize(),
        success : function(data){
          $('#kode').focus();
          table.ajax.reload();
          location = self.location;
        },
        error : function(){
          alert("Tidak dapat menyimpan data!");
        }
     });
}

function showProduct(){
  $('#modal-produk').modal('show');
}

function deleteItem(id){
   if(confirm("Apakah yakin data akan dihapus?")){
     $.ajax({
       url : "penerimaandetail/"+id,
       type : "POST",
       data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
       success : function(data){
         table.ajax.reload(function(){
            loadForm($('#diskon').val());
          });
       },
       error : function(){
         alert("Tidak dapat menghapus data!");
       }
     });
   }
}

function loadForm(diskon=0) {

}

</script>

@endsection
