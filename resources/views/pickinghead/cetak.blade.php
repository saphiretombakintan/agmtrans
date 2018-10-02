
<!DOCTYPE html>
<html>

<head>
  <title>Picking List</title>
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
      <td align=center> PICKING LIST</td>
    </tr>

  </table>

  <table width="100%" style='font-family:"Sans-serif"; font-size:80%'>
    <tr>
      <td style='font-family:"Sans-serif"; font-size:80%'>Tujuan</td>
       <td style='font-family:"Sans-serif"; font-size:80%'>: {{ $picking[0]->destination }} </td>
       <td style='font-family:"Sans-serif"; font-size:80%'></td>
       <td style='font-family:"Sans-serif"; font-size:80%'> No Picking</td>
       <td style='font-family:"Sans-serif"; font-size:80%'>: {{ $picking[0]->id_picking }}</td>
     </tr>
     <tr>
       <td style='font-family:"Sans-serif"; font-size:80%'>Tanggal</td>
       <td style='font-family:"Sans-serif"; font-size:80%'>: {{ tanggal_indonesia(date($picking[0]->tanggal ))}}</td>
       <td style='font-family:"Sans-serif"; font-size:80%'></td>
       <td style='font-family:"Sans-serif"; font-size:80%'> Picker</td>
       <td style='font-family:"Sans-serif"; font-size:80%'>: </td>
    </tr>


  </table>
  <hr>
  <font size="2" face="Courier New" >
  <table class="table table-bordered" style='font-family:"Sans-serif"; font-size:80%'>
    <thead>
      <tr>
        <th>No</th>
        <th>No Faktur</th>
        <th>Code Item</th>
        <th>Description</th>
        <th>Csu</th>
        <th>Ctn</th>
        <th>Pcs</th>
        <th>Lot</th>
      </tr>

      <tbody>
        <tbody>
          @foreach($detail as $data)
            <tr>

              <td style='font-family:"Sans-serif"; font-size:80%'>{{ ++$no }}</td>
              <td style='font-family:"Sans-serif"; font-size:80%'>{{ $data->no_faktur }}</td>
              <td style='font-family:"Sans-serif"; font-size:80%'>{{ $data->codeitem }}</td>
              <td style='font-family:"Sans-serif"; font-size:80%'>{{ $data->desc }}</td>
              <td style='font-family:"Sans-serif"; font-size:80%'>{{ $data->csu }}</td>
              <td style='font-family:"Sans-serif"; font-size:80%'>{{ $data->jml }}</td>
              <td style='font-family:"Sans-serif"; font-size:80%'>{{ $data->pcs }}</td>
              <td style='font-family:"Sans-serif"; font-size:80%'>{{ $data->lot }}</td>

            </tr>

          @endforeach

        </tbody>
        </tbody>
        <hr>
      <tfoot>


</tfoot>
    </table>
    <table width="100%" style='font-family:"Sans-serif"; font-size:80%'>
      <thead>
        <tr>
          <th width="25%" align="center">Dibuat</th>
          <th width="25%" align="center">Disiapkan</th>
          <th width="25%" align="center">Dicheck</th>
          <th width="25%" align="center">Mengetahui</th>
        </tr>

          <tbody>



            <tr>
            <td  height="50"></td>
            <td  height="50"></td>
            <td  height="50"></td>
            <td  height="50"></td>
            <td  height="50"></td>
          </tr>
          <tr>
          <td  width="25%" valign="bottom" style='font-family:"Sans-serif" ; font-size:80%'>Warehouse Admin</td>
          <td  width="25%" valign="bottom" style='font-family:"Sans-serif"; font-size:80%'>Picker</td>
          <td  width="25%" valign="bottom" style='font-family:"Sans-serif"; font-size:80%'>Checker</td>
          <td  width="25%" valign="bottom" style='font-family:"Sans-serif"; font-size:80%'>SPV Warehouse</td>
        </tr>

          </tbody>


      </table>

  </body>
  </html>
