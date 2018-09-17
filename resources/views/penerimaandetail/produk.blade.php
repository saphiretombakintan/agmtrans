<div class="modal" id="modal-produk" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
        <h3 class="modal-title">Cari Produk</h3>
      </div>

      <div class="modal-body">
        <table class="table table-striped tabel-produk">
          <thead>
            <tr>
              <th>Code Item</th>
              <th>Description</th>
              <th>Csu</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($produk as $data)
              <tr>
                <th>{{ $data->codeitem }}</th>
                <th>{{ $data->desc }}</th>
                <th>{{ $data->csu }}</th>
                <th><a onclick="selectItem({{ $data->codeitem }})" class="btn btn-primary"><i class="fa fa-check-circle"></i> Pilih</a></th>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>
  </div>
</div>
