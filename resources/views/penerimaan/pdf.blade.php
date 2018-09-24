<!DOCTYPE html>
<html>

<head>
  <title>Put Away</title>
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('/public/adminLTE/bootstrap/css/bootstrap.min.css') }}"> --}}

<title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>

  <h3 class="text-center">Put Away</h3>

  <table width="100%">
    <tr>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>No Surat Jalan</td>
       <td>: {{ $penerimaan[0]->no_SJ }}
       </td>
       <td> No BTB</td>
       <td>: {{ $penerimaan[0]->id_btb}}
     </tr>
     <tr>
       <td>No Mobil</td>
       <td>: {{ $penerimaan[0]->no_mobil }}</td>
       <td> Tanggal</td>
       <td>: {{ $penerimaan[0]->tanggal }}</td>
    </tr>
    <tr>
      <td>Terima Dari</td>
      <td>: {{ $penerimaan[0]->nama_principal }}</td>
   </tr>

  </table>
  <hr>
  <table class="table table-striped">
    <thead>
      <tr>
        {{-- <th width="30">No</th> --}}
        <th>Code Item</th>
        <th>Description</th>
        <th>Csu</th>
        <th>Qty Ctn</th>
        <th>Exp_date</th>
        <th>Lot Number</th>
      </tr>

      <tbody>
        <tbody>
          @foreach($datapenerimaan as $list)
            <tr>

              {{-- <td>{{ $row->no }}</td> --}}
              <td>{{ $list->codeitem }}</td>
              <td>{{ $list->desc }}</td>
              <td>{{ $list->csu }}</td>
              <td align="right">{{ $list->qty_ctn }}</td>
              <td>{{ $list->exp_date }}</td>
              <td>{{ $list->lot_number }}</td>

            </tr>

          @endforeach

        </tbody>
        </tbody>
        <hr>
      <tfoot>

   <tr><td colspan="3" align="right"><b>Total Item</b></td><td align="right"><b>{{ $penerimaan[0]->total_item }}</b></td></tr>
</tfoot>
    </table>
    <table width="100%">
  <tr>
    <td>
      <b>Agm Trans Media Coorporate </b>
    </td>
    <td align="center">
      <b> Fauzan </b>
    </td>
  </tr>
</table>

  </body>
  </html>
