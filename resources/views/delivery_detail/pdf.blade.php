
<!DOCTYPE html>
<html>

<head>
  <title>D.O</title>
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('/public/adminLTE/bootstrap/css/bootstrap.min.css') }}"> --}}

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style type="text/css">
      table td{font: arial 9px;}
      table.data td,
      table.data th{
         border: 1px solid #ccc;
         padding: 5px;
      }
      table.data th{
         text-align: center;
      }
      table.data{ border-collapse: collapse }
   </style>

   <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
   <script type="text/javascript"  src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

 {{-- <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
	<script type="text/javascript" src="{{ asset('adminLTE/bootstrap/js/bootstrap.min.js')}}"></script> --}}


</head>
<body>
  <h5 class="text-left"><b>PT. ARTI GUNA MAJU MANDIRI</b></h5>
  <h6 class="text-left">Area  : Legok Tangerang</h6>
  <table width="100%" class="table table-bordered">
    <tr>
      <td align=center> Delivery Order</td>
    </tr>

  </table>

  <table width="100%" style='font-family:"monospace"; font-size:80%'>
    <tr>
      <td style='font-family:"monospace"; font-size:80%'>No Do</td>
       <td style='font-family:"monospace"; font-size:80%'>: {{ $iddo }}</td>
       <td style='font-family:"monospace"; font-size:80%'></td>
       <td style='font-family:"monospace"; font-size:80%'> Tanggal Cetak</td>
       <td style='font-family:"monospace"; font-size:80%'>: {{ $dates }}</td>
     </tr>
     <tr>
       <td style='font-family:"monospace"; font-size:80%'>Tanggal Kirim</td>
       <td style='font-family:"monospace"; font-size:80%'>: {{ $datapenerimaan[0]->tanggal }}</td>
       <td style='font-family:"monospace"; font-size:80%'></td>
       <td style='font-family:"monospace"; font-size:80%'> Tujuan</td>
       <td style='font-family:"monospace"; font-size:80%'>: {{ $datapenerimaan[0]->destination  }}</td>
    </tr>
    <tr>
      <td style='font-family:"monospace"; font-size:80%'>No Mobil</td>
       <td style='font-family:"monospace"; font-size:80%'>: {{ $datapenerimaan[0]->nomobil }}</td>
       <td style='font-family:"monospace"; font-size:80%'></td>
       <td style='font-family:"monospace"; font-size:80%'> Nama Supir</td>
       <td style='font-family:"monospace"; font-size:80%'>: {{ $datapenerimaan[0]->namasupir }}</td>
     </tr>


  </table>
  <hr>
  <font size="2" face="Courier New" >
  <table class="table table-bordered" style='font-family:"monospace"; font-size:80%'>
    <thead>
      <tr>
        <th>No</th>
        <th>No Faktur</th>
        <th>No Picking List</th>
        <th>Csu</th>
        <th>Ctn</th>
        <th>Pcs</th>
        <th>Lot</th>
      </tr>

      <tbody>
        <tbody>
          @foreach($detail as $data)
            <tr>

              <td style='font-family:"monospace"; font-size:80%'>{{ ++$no }}</td>
              <td style='font-family:"monospace"; font-size:80%'>{{ $data->id_do }}</td>
              <td style='font-family:"monospace"; font-size:80%'>{{ $data->id_picking }}</td>
              <td style='font-family:"monospace"; font-size:80%'>{{ $data->csu }}</td>
              <td style='font-family:"monospace"; font-size:80%'>{{ $data->jml }}</td>
              <td style='font-family:"monospace"; font-size:80%'>{{ $data->pcs }}</td>
              <td style='font-family:"monospace"; font-size:80%'>{{ $data->lot }}</td>

            </tr>

          @endforeach

        </tbody>
        </tbody>
        <hr>
      <tfoot>


</tfoot>
    </table>
  </font>
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
