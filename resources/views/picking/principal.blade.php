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
		      <th>No Faktur</th>
		      <th>Need By Date</th>
		      <th>Aksi</th>
		   </tr>
		</thead>
		<tbody>
			@foreach($faktur as $data)
			<tr>
		      
		      <th>{{ $data->no_faktur }}</th>
		      <th>{{ $data->need_by_date }}</th>
		      <th><a onclick="selectItem({{ $data->no_faktur }})" class="btn btn-primary"><i class="fa fa-check-circle"></i> Pilih</a></th>
		    </tr>
			@endforeach
		</tbody>
	</table>

</div>

         </div>
      </div>
   </div>
