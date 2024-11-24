<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 10pt;
        }
    </style>
</head>

<body>
    <table class="table table-bordered" width="100%" align="center">
        <tr align="center" >
            <td>
                <h2>Laporan Penjualan<br>Pabrik Tahu Bandung Raos</h2>
                <hr>
            </td>
        </tr>
    </table>
    <table class="table table-bordered" width="100%" align="center">
        <thead class="thead-dark">
            <tr>
                <th width="5%">Tanggal Transaksi</th>
                <th width="15%"> Kode Barang </th>
                <th width="5%">QTY </th>
                <th width="5%">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total1 = 0;
            @endphp
            @php $i=1
            @endphp

            @foreach ($laporanpenjualan as $bb)
            <!-- pembuatan prulangan bersarang -->

            <tr align="midle">

                <td>{{$bb->tgl_lap}}</td>
                <td>{{$bb->kd_brg}}</td>
                <td>{{number_format($bb->qty_jual)}}</td>
                <td>{{number_format($bb->sub_jual)}}</td>
            </tr>
            <!-- hitung total debet dan kredit -->
            {{$total1 += $bb->sub_jual}};
            @endforeach

            <tr>

                <td></td>
                <td></td>
                <td>Total</td>
                <td>Rp. {{ number_format($total1) }}</td>

            </tr>

        </tbody>
    </table>
    <div align="right">
        <h6>Tanda Tangan</h6><br><br>
        <h6>{{ Auth::user()->name }}</h6>
    </div>
</body>

</html>