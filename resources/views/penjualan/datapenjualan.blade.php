@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Penjualan </h1>
</div>
<hr>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>No Penjualan</th>
                        <th>Tanggal Jual</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualan as $jual)
                    <tr>
                        <td width="15%">{{ $jual->no_nota }}</td>
                        <td>{{ $jual->tgl_jual }}</td>
                        <td>Rp. {{ number_format($jual->total_jual) }}</td>
                        <td width="30%">
                        <a href="{{route('cetak.order_pdf',[Crypt::encryptString($jual->no_order)])}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                                <i class="fas fa-print fa-sm text-white-50"></i> Lihat Invoice</a>
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

