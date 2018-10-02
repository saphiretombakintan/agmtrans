@extends('layouts.app')

@section('title')
    Angsuran
@endsection

@section('breadcrumb')
    @parent
    <li>Angsuran</li>
    <li>tambah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <table>
                    {{-- <tr><td width="150">Nama</td><td><b>: {{ $idcustomer->name_customer }}</b></td></tr>
                    <tr><td width="150">Unit</td><td><b>: {{ $idcustomer->code_unit }}</b></td></tr> --}}

                </table>
                <hr>
                <div class="box-body">

                    <form class="form form-horizontal form-produk" method="post">
                        {{ csrf_field() }}
                        {{-- <input type="hidden" name="code_customer" value="{{ $idcustomer->code_customer }}"> --}}
                        <div class="form-group">
                            <label for="kode" class="col-md-2 control-label">Input Angsuran</label>
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
                                <th>No</th>
                                <th>Picking Number</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </form>



                    <div class="col-md-4">
                        <form class="form form-horizontal form-pembelian" method="post" action="{{  route('delivery_detail.savedata') }} ">
                            {{ csrf_field() }}
                            <input type="" name="code_customer" value="{{ $iddo }}">
                            <label for="total" class="col-md-4 control-label">Total</label>
                            <input type="text"  name="sumbaseamount" value="{{ $iddestinasi }}" readonly>
                            <label for="total" class="col-md-4 control-label">Total Item</label>
                            <input type="text"  name="totalitem" value="{{ $sumitem }}" >
                        <button type="submit" class="btn btn-primary pull-right simpan"><i class="fa fa-floppy-o"></i> Simpan Transaksi</button>
                    </form>

                    </div>

                </div>

                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
    @include('delivery_detail.picking')
@endsection

@section('script')
    <script type="text/javascript">
        var table;
        $(function(){

            table = $('.tabel-pembelian').DataTable({
                // "dom" : 'Brt',
                // "bSort" : false,
                "processing" : true,
                "serverside" : true,
                "ajax" : {
                    "url" : "{{ route('delivery_detail.data',$iddo) }}",
                    "type" : "GET"
                }
            })
                .on('draw.dt', function(){
                loadForm($(this).val());



            });


            // $('.form-produk').on('submit', function(e){
            //     return false;
            // });

            // $('#kode').change(function(){
            //     addItem();
            // });

            $('.form-keranjang').submit(function(){
                return false;
            });

            // $('#diskon').change(function(){
            //     if($(this).val() == "") $(this).val(0).select();
            //     loadForm($(this).val());
            // });

            $('.simpan').click(function(){
                $('.form-pembelian').submit();
            });

            $('#modal-produk form').validator().on('submit', function(e){
                if(!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if(save_method == "add") url = "{{ route('delivery_detail.store') }}";
                    else url = "delivery_detail/"+id;

                    $.ajax({
                        url : url,
                        type : "POST",
                        data : $('#modal-produk form').serialize(),
                        success : function(data){
                            $('#modal-produk').modal('hide');
                            table.ajax.reload();
                        },
                        error : function(){
                            alert("Tidak dapat menyimpan data!");
                        }
                    });
                    return false;
                }
            });

        });

        function addItem(){
            $.ajax({
                url : "{{ route('delivery_detail.store') }}",
                type : "POST",
                data : $('.form-produk form').serialize(),
                success : function(data){
                    $('#kode').val('').focus();
                    table.ajax.reload(function(){
                        loadForm($('#diskon').val());
                    });
                },
                error : function(){
                    alert("Tidak dapat menyimpan data!");
                }
            });
        }



        function edit(id){
            save_method = "edit";
            $('#modal-produk').modal('show');
            $('input[name=_method]').val('PATCH');
            $('#modal-produk form')[0].reset();
            $.ajax({
                url : "angsuran_detail/"+id+"/edit",
                type : "GET",
                dataType : "JSON",
                success : function(data){
                    $('#modal-form').modal('show');
                    $('#id').val(data.id);
                    $('#code_customer').val(data.code_customer);
                    $('#payment_schedulle').val(data.payment_schedulle);
                    $('#type').val(data.type);
                    $('#desc').val(data.description);
                    $('#baseamount').val(data.baseamount);

                },
                error : function(){
                    alert("Tidak dapat menampilkan data!");
                }
            });
            $('#saveedit').click( function () {
                window.location.reload()
            })
        }

        function showProduct(){
            $('#modal-produk').modal('show');
        }

        function deleteItem(id){
            if(confirm("Apakah yakin data akan dihapus?")){
                $.ajax({
                    url : "delivery_detail/"+id,
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

        function loadForm(){
            $('#total').val($('.total').text());

        }

    </script>

@endsection
