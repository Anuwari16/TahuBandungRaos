@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Penjualan</h1>
</div>
<hr>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailpenjualan as $detpenj)
                    <tr>
                        <td>{{ $detpenj->no_jual}}</td>
                        <td>{{ $detpenj->qty_jual}}</td>
                        <td>{{ $detpenj->sub_jual}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-md-10">
                <a href="{{ route('datapenjualan.transaksi') }}"><input type="Button" class="btn btn-primary btn-send" value="Kembali"></a>
            </div>
        </div>
    </div>
</div>
@endsection