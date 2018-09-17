<div class="modal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
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
                        <label for="kode" class="col-md-3 control-label">Code Item</label>
                        <div class="col-md-6">
                            <input id="kode" type="number" class="form-control" name="kode" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama" class="col-md-3 control-label">Description</label>
                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control" name="nama" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="csu" class="col-md-3 control-label">Csu Qty</label>
                        <div class="col-md-6">
                            <input id="csu" type="text" class="form-control" name="csu" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="weigh" class="col-md-3 control-label">Weigh</label>
                        <div class="col-md-3">
                            <input id="weigh" type="text" class="form-control" name="weigh" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="volume" class="col-md-3 control-label">Volume</label>
                        <div class="col-md-2">
                            <input id="volume" type="text" class="form-control" name="volume" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="code_lot" class="col-md-3 control-label">Code Lot</label>
                        <div class="col-md-3">
                            <input id="code_lot" type="text" class="form-control" name="code_lot" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="stok" class="col-md-3 control-label">Stok</label>
                        <div class="col-md-2">
                            <input id="stok" type="text" class="form-control" name="stok" required>
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
