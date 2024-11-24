<html>

<head>
    <meta charset="utf-8">
    <title>Invoice UD. Tahu Bandung Raos</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: normal;
            /* inherit */
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="asset/img/tahu_logo.png" width="80px">
                            </td>
                            <td>
                                Invoice : <strong>#{{ $noorder }}</strong><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                @foreach($order as $order)
                                @foreach($agen as $agn)
                                @if($order->kd_agen==$agn->kd_agen)
                                <strong>PENERIMA</strong><br>
                                {{ $agn->nm_agen }}<br>
                                {{ $agn->alamat }}<br>
                                {{ $agn->telepon }}<br>
                            </td>
                            @endif
                            @endforeach
                            @endforeach
                            <td>
                                <strong>NOTA</strong><br>
                                Tahu Bandung Raos<br>
                                082113065197<br>
                                Jl Pasar Dramaga  <br>
                                Dramaga, Kec. Dramaga<br>
                                Kabupaten Bogor
                            </td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Produk</td>
                <td>Harga</td>
                <td>Total</td>
                <td>Subtotal</td>
            </tr>
            @php($total = 0)
            @foreach ($detail as $row)
            <tr class="item">
                <td>{{$row->nm_brg}}</td>
                <td> Rp {{ number_format($row->subtotal/$row->qty_order) }} </td>
                <td> {{ $row->qty_order }} </td>
                <td>Rp {{ number_format($row->subtotal) }}</td>
            </tr>
            @php($total += $row->subtotal)
            @endforeach

            <tr class="total">
                <td></td>
                <td></td>
                <td></td>
                <td>
                    Total: Rp {{ number_format($total) }}
                </td>
            </tr>
            <tr>
                <td colspan="3">PERHATIAN!!</td>
            </tr>
            <tr>
                <td colspan="3">Barang yang sudah dibeli tidak bisa diretur!!</td>
            </tr>
        </table>
    </div>
</body>

</html>