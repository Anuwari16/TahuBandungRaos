@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transaksi Penjualan </h1>
</div>
<hr>
<div class="card-header py-3" align="right">
    <a href="{{route('penjualan.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah </a>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th width="15%">No Pre Order</th>
                        <th>Tanggal Order</th>
                        <th width="30%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($preorder as $order)
                    <tr>
                        <td width="15%">{{ $order->no_order }}</td>
                        <td>{{ $order->tgl_order }}</td>
                        <td width="30%">
                            <a href="{{url('/penjualan-jual/'.Crypt::encryptString($order->no_order))}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Jual</a>
                            <a href="{{route('cetak.order_pdf',[Crypt::encryptString($order->no_order)])}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                                <i class="fas fa-print fa-sm text-white-50"></i> Cetak Invoice</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</form>
@endsection