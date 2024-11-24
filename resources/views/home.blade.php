@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Selamat Datang di Aplikasi Penjualan Tahu Bandung Raos') }}
                </div>
                
            </div>
            <img class= "fas fa-spin"  src="{{asset('asset/img/tahu1.png')}}" width="170"> <td> <img    src="{{asset('asset/img/tahu2.png')}}" width="170"> <td> <img   class= "fas fa-spin" src="{{asset('asset/img/tahu3.png')}}" width="170"> <td> <img   src="{{asset('asset/img/tahu4.png')}}" width="170">
        </div>
    </div>
</div>
@endsection
