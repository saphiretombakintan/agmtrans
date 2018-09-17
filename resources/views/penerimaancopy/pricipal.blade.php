<div class="modal" id="modal-supplier" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <form class="form-horizontal" data-toggle="validator" method="post">
        {{ csrf_field() }} {{ method_field('POST') }}

        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
           <h3 class="modal-title"></h3>
        </div>

     <div class="modal-body">

       <input type="hidden" id="id" name="id">
       <div class="form-group">
         <label for="kategori" class="col-md-3 control-label">Pricipal</label>
         <div class="col-md-6">
           <select id="kategori" type="text" class="form-control" name="kategori" required>
             <option value=""> -- Pilih Pricipal-- </option>
             @foreach($principal as $list)
             <option value="{{ $list->id_principal }}">{{ $list->nama_principal }}</option>
             @endforeach
           </select>
           <span class="help-block with-errors"></span>
         </div>
       </div>

       <div class="form-group">
         <label for="merk" class="col-md-3 control-label">No Surat Jalan</label>
         <div class="col-md-6">
           <input id="merk" type="text" class="form-control" name="merk" required>
           <span class="help-block with-errors"></span>
         </div>
       </div>

       <div class="form-group">
         <label for="harga_beli" class="col-md-3 control-label">No Mobil</label>
         <div class="col-md-3">
           <input id="harga_beli" type="text" class="form-control" name="harga_beli" required>
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
