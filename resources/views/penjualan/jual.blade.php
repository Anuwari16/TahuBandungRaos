@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Penjualan </h1>
</div>
<hr>
<form action="/penjualan/simpan" method="POST">
    @csrf

    <div class="form-group col-sm-4">
        <label style="color:black" for="exampleFormControlInput1">No penjualan</label>
        @foreach($kas as $ks)
        <input type="hidden" name="akun" value="{{ $ks->no_akun }}" class="form-control" id="exampleFormControlInput1">
        @endforeach
        @foreach($penjualan as $jual)
        <input type="hidden" name="penjualan" value="{{ $jual->no_akun }}" class="form-control" id="exampleFormControlInput1">
        @endforeach
        <input type="hidden" name="no_jurnal" value="{{ $formatj }}" class="form-control" id="exampleFormControlInput1">
        <input type="text" name="no_nota" value="{{ $format }}" class="form-control" id="exampleFormControlInput1">
    </div>
    @foreach($preorder as $order)
    <div class="form-group col-sm-4">
        <label style="color:black" for="exampleFormControlInput1">No Pre Order</label>
        <input type="text" name="no_order" value="{{ $order->no_order }}" class="form-control" id="exampleFormControlInput1">
    </div>

    <div class="form-group col-sm-4">
        <label style="color:black" for="exampleFormControlInput1">Tanggal Jual</label>
        <input type="text" min="1" name="tgl" value="{{ $order->tgl_order }}" id="addnmbrg" class="form-control" id="exampleFormControlInput1" require>
    </div>
    @endforeach
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($total = 0)
                        @foreach($detail as $temp)
                        <tr>
                            <td><input name="no_jual[]" class="form-control" type="hidden" value="{{$temp->no_order}}" readonly>
                            <input name="kd_brg[]" class="form-control" type="hidden" value="{{$temp->kd_brg}}" readonly>{{$temp->kd_brg}}</td>
                            <td>{{$temp->nm_brg}}</td>
                            <td><input name="qty_jual[]" class="form-control" type="hidden" value="{{$temp->qty_order}}" readonly>{{$temp->qty_order}}</td>
                            <td><input name="sub_jual[]" class="form-control" type="hidden" value="{{$temp->subtotal}}" readonly>{{$temp->subtotal}}</td>
                            <td align="center">
                                <a href="/transaksi/hapus/{{$temp->kd_brg}}" onclick="return confirm('Yakin Ingin menghapus data?')" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                    <i class="fas fa-trash-alt fa-sm text-white-50"></i> Hapus</a>
                            </td>
                        </tr>
                        @php($total += $temp->subtotal)
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            <td><input name="total" class="form-control" type="hidden" value="{{$total}}">Total {{number_format($total)}}</a>
                            <td></td>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="submit" class="btn btn-primary btn-send" value="Simpan penjualan">
        </div>
    </div>
</form>
@endsection