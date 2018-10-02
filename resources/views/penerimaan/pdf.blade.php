
  <!DOCTYPE html>
  <html>

  <head>
    <title>BTB</title>
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
        <td align=center> Bukti Terima Barang</td>
      </tr>

    </table>

    <table width="100%" style='font-family:"Sans-serif"; font-size:80%'>
      <tr>
        <td style='font-family:"Sans-serif"; font-size:80%'>No Surat Jalan</td>
        <td style='font-family:"Sans-serif"; font-size:80%'>: {{ $penerimaan[0]->no_SJ }}
        </td>
        <td style='font-family:"Sans-serif"; font-size:80%'> No BTB</td>
        <td style='font-family:"Sans-serif"; font-size:80%'>: {{ $penerimaan[0]->id_btb}}
      </tr>
      <tr>
        <td style='font-family:"Sans-serif"; font-size:80%'>No Mobil</td>
        <td style='font-family:"Sans-serif"; font-size:80%'>: {{ $penerimaan[0]->no_mobil }}</td>
        <td style='font-family:"Sans-serif"; font-size:80%'> Tanggal</td>
        <td style='font-family:"Sans-serif"; font-size:80%'>: {{ $penerimaan[0]->tanggal }}</td>
     </tr>
     <tr>
       <td style='font-family:"Sans-serif"; font-size:80%'>Terima Dari</td>
       <td style='font-family:"Sans-serif"; font-size:80%'>: {{ $penerimaan[0]->nama_principal }}</td>
    </tr>

    </table>
    <hr>
    <font size="2" face="Courier New" >
    <table class="table table-bordered" style='font-family:"Sans-serif"; font-size:80%'>
      <thead>
        <tr>
          <th>No</th>
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

                <td style='font-family:"Sans-serif"; font-size:80%'>{{ ++$no }}</td>
                <td style='font-family:"Sans-serif"; font-size:80%'>{{ $list->codeitem }}</td>
                <td style='font-family:"Sans-serif"; font-size:80%'>{{ $list->desc }}</td>
                <td style='font-family:"Sans-serif"; font-size:80%'>{{ $list->csu }}</td>
                <td style='font-family:"Sans-serif"; font-size:80%' align="center">{{ $list->qty_ctn }}</td>
                <td style='font-family:"Sans-serif"; font-size:80%'>{{ tanggal_indonesia(date( $list->exp_date ))}}</td>
                <td style='font-family:"Sans-serif"; font-size:80%'>{{ $list->lot_number }}</td>

              </tr>

            @endforeach

          </tbody>
          </tbody>
          <tfoot>

          <tr>

            <td  colspan="4" align="center" style='font-family:"Sans-serif"; font-size:80%'><b>Total Carton</b></td>
            <td colspan="3" style='font-family:"Sans-serif"; font-size:80%'> <b>{{ $penerimaan[0]->total_item }}</b></td>


          </tr>


    </tfoot>

      </table>


    </font>

    <h6 class="text-left"><b>BERITA ACARA :</b></h6>
    <h6 class="text-left">Penolakan barang tidak sesuai karena kurang / kadaluarsa / bocor / rusak / salah produk, dengan rincian sebagai berikut </h6>
    <table class="table table-bordered" style='font-family:"Sans-serif"; font-size:80%'>
      <thead>
        <tr>
          <th>No</th>
          <th>Code Item</th>
          <th>Description</th>
          <th>Csu</th>
          <th>Qty Ctn</th>
          <th>Exp_date</th>
          <th>Lot Number</th>
        </tr>

        <tbody>
          <tbody>


          </tbody>
          </tbody>

      </table>

      <table width="100%" style='font-family:"Sans-serif"; font-size:80%'>
        <thead>
          <tr>
            <th width="25%" align="center">Dibuat</th>
            <th width="25%" align="center">Diperiksa</th>
            <th width="25%" align="center">Pengirim</th>
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
            <td  width="25%" valign="bottom" style='font-family:"Sans-serif"; font-size:80%'>Warehouse Admin</td>
            <td  width="25%" valign="bottom" style='font-family:"Sans-serif"; font-size:80%'>Checker</td>
            <td  width="25%" valign="bottom" style='font-family:"Sans-serif"; font-size:80%'>Supir Prinsipal</td>
            <td  width="25%" valign="bottom" style='font-family:"Sans-serif"; font-size:80%'>SPV Warehouse</td>
          </tr>

            </tbody>


        </table>

        <h6 class="text-left">Picker  : Fauzan</h6>
    </body>
    </html>
