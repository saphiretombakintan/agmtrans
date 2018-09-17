<div class="modal" id="modal-supplier" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">

   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
      <h3 class="modal-title">Pilih Supplier</h3>
   </div>

<div class="modal-body">
   <table class="table table-striped tabel-supplier">
      <thead>
         <tr>
            <th>Nama Principal</th>
            <th>Alamat</th>
            <th>PIC</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
         @foreach($principal as $data)
         <tr>
            <th>{{ $data->nama_principal }}</th>
            <th>{{ $data->alamat }}</th>
            <th>{{ $data->pic }}</th>
            <th><a href="penerimaan/{{ $data->id_principal }}/tambah" class="btn btn-primary"><i class="fa fa-check-circle"></i> Pilih</a></th>
          </tr>
         @endforeach
      </tbody>
   </table>

</div>

         </div>
      </div>
   </div>
