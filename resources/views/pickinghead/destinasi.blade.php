<div class="modal" id="modal-supplier" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">

   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
      <h3 class="modal-title">Pilih Tujuan</h3>
   </div>

<div class="modal-body">
   <table class="table  tabel-supplier">
      <thead>
         <tr>
            <th>Code Destinasi</th>
            <th>Tujuan</th>

         </tr>
      </thead>
      <tbody>
         @foreach($destinasi as $data)
         <tr>
            <th>{{ $data->code_destination }}</th>
            <th>{{ $data->destination }}</th>
            <th><a href="picking/{{ $data->code_destination }}/tambah" class="btn btn-primary"><i class="fa fa-check-circle"></i> Pilih</a></th>
          </tr>
         @endforeach
      </tbody>
   </table>

</div>

         </div>
      </div>
   </div>
