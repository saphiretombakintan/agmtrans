<div class="modal" id="modal-supplier" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">

   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
      <h3 class="modal-title">Pilih Principal</h3>
   </div>

   <form class="form-horizontal" data-toggle="validator" method="post">
      {{ csrf_field() }}

      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
         <h3 class="modal-title"></h3>
      </div>

   <div class="modal-body">

     <input type="hidden" id="id" name="id">
     <div class="form-group">
       <label for="kode" class="col-md-3 control-label">No Mobil</label>
       <div class="col-md-6">
         <input id="kode" type="text" class="form-control" name="kode" autofocus required>
         <span class="help-block with-errors"></span>
       </div>
     </div>

     <div class="form-group">
       <label for="nama" class="col-md-3 control-label">Nama Supir</label>
       <div class="col-md-6">
         <input id="nama" type="text" class="form-control" name="nama" required>
         <span class="help-block with-errors"></span>
       </div>
     </div>

     <div class="form-group">
       <label for="kategori" class="col-md-3 control-label">Destinasi</label>
       <div class="col-md-6">
         <select id="codedestinasi" type="text" class="form-control" name="codedestinasi" required>
           <option value=""> -- Pilih Destinasi-- </option>
           @foreach($destinasi as $list)
           <option value="{{ $list->code_destination }}">{{ $list->destination }}</option>
           @endforeach
         </select>
         <span class="help-block with-errors"></span>
       </div>
     </div>

     <div class="form-group">
       <label for="merk" class="col-md-3 control-label">Tanggal</label>
       <div class="col-md-6">
         <input id="tanggal" type="text" class="form-control" name="merk" required>
         <span class="help-block with-errors"></span>
       </div>
     </div>
   </div>

      <div class="modal-footer">
         <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Simpan </button>
         <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
      </div>

      </form>

         </div>
      </div>
   </div>
