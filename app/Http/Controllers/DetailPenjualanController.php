<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailPenjualan;
use App\Penjualan;
use DB;
use Alert;
use PDF;

class DetailPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detpenj = \App\DetailPenjualan::All();
        return view('penjualan.detailpenjualan', ['detailpenjualan' => $detpenj]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function simpan(Request $request)
    {

        //Simpan ke table pemesanan
        $tambah_penjualan = new \App\Penjualan();
        $tambah_penjualan->no_jual = $request->no_jual;
        $tambah_penjualan->tgl_jual = $request->tgl;
        $tambah_penjualan->total = $request->total;
        $tambah_penjualan->kd_agen = $request->agen;
        $tambah_penjualan->save();
        //SIMPAN DATA KE TABEL DETAIL
        $kd_brg = $request->kd_brg;
        $qty = $request->qty_jual;
        $sub_total = $request->sub_total;
        foreach ($kd_brg as $key => $no) {
            $input['no_jual'] = $request->no_jual;
            $input['kd_brg'] = $kd_brg[$key];
            $input['qty_jual'] = $qty[$key];
            $input['subtotal'] = $sub_total[$key];
            DetailPenjualan::insert($input);
        }

        
        Alert::success('Pesan ', 'Data berhasil disimpan');
        return redirect('/transaksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypted = Crypt::decryptString($id);
        $detail      = DB::table('tampil_preorder')->where('no_order', $decrypted)->get();
        $agen    = DB::table('agen')->get();
        $preorder   = DB::table('pre_order')->where('no_order', $decrypted)->get();
        $pdf = PDF::loadView('laporan.nota', ['detail' => $detail, 'order' => $preorder, 'agen' => $agen, 'noorder' => $decrypted]);
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
