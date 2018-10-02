<div class="modal" id="modal-produk" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
                <h3 class="modal-title">Pilih Customer</h3>
            </div>

            <div class="modal-body">
                <table class="table table-striped tabel-customer">
                    <thead>
                    <tr>
                        <th>No Picking</th>
                        <th>Total Item</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($picking as $data)
                        <tr>
                            <th>{{ $data->id_picking }}</th>
                            <th>{{ $data->total_item }}</th>
                            <th><a href="delivery_detail/{{ $data->id_picking }}/tambah" class="btn btn-primary"><i class="fa fa-check-circle"></i> Pilih</a></th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
