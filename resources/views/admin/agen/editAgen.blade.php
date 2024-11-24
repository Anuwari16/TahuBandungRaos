@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<form action="{{route('agen.update', [$agen->kd_agen])}}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <fieldset>
        <legend>Ubah Data Agen</legend>
        <div class="form-group row">
            <div class="col-md-5">
                <label for="addkdbrg">Kode Agen</label>
                <input class="form-control" type="text" name="addkdagen" value="{{$agen->kd_agen}}" readonly>
            </div>
            <div class="col-md-5">
                <label for="addnmagen">Nama Agen</label>
                <input id="addnmagen" type="text" name="addnmagen" class="form-control" value="{{$agen->nm_agen}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-5">
                <label for="Telepon">Telepon</label>
                <input id="addtelepon" type="text" name="addtelepon" class="form-control" value="{{$agen->telepon}}">
            </div>
            <div class="col-md-5">
                <label for="Alamat">Alamat</label>
                <input id="addalamat" type="text" name="addalamat" class="form-control" value="{{$agen->alamat}}">
            </div>
        </div>
    </fieldset>
    <div class="col-md-10">
        <input type="submit" class="btn btn-success btn-send" value="Update">
        <a href="{{ route('agen.index') }}"><input type="Button" class="btn btn-primary btn-send" value="Kembali"></a>
    </div>
    <hr>
</form>
@endsection