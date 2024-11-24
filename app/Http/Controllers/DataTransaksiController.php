<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\DetailPenjualan;
use App\Penjualan;
use App\PreOrder;
use DB;
use Alert;

class DataTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = \App\Penjualan::All();
        return view('penjualan.datapenjualan', ['penjualan' => $penjualan]);
        $order = \App\PreOrder::All();
        return view('penjualan.datapenjualan', ['preorder' => $order]);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penjualan = \App\Penjualan::All();
        return view('penjualan.datapenjualan', ['penjualan' => $penjualan]);
        $AWAL = 'FKT';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = \App\Penjualan::max('no_jual');
        $no = 1;
        $format = sprintf("%03s", abs((int)$noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
        $AWALJurnal = 'JRU';
        $bulanRomawij = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhirj = \App\Jurnal::max('no_jurnal');
        $noj = 1;
        $formatj = sprintf("%03s", abs((int)$noUrutAkhirj + 1)) . '/' . $AWALJurnal . '/' . $bulanRomawij[date('n')] . '/' . date('Y');

        $decrypted = Crypt::decryptString($id);
        $detail      = DB::table('tampil_preorder')->where('no_order', $decrypted)->get();
        $preorder   = DB::table('pre_order')->where('no_order', $decrypted)->get();
        $akunkas      = DB::table('setting')->where('nama_transaksi', 'Kas')->get();
        $akunpenjualan      = DB::table('setting')->where('nama_transaksi', 'penjualan')->get();
        return view('penjualan.datapenjualan', ['detail' => $detail, 'format' => $format, 'no_order' => $decrypted, 'preorder' => $preorder, 'formatj' => $formatj, 'kas' => $akunkas, 'penjualan' => $akunpenjualan]);
    }

    public function simpan(Request $request)
    {
        //Simpan ke table penjualan
        $tambah_penjualan = new \App\Penjualan;
        $tambah_penjualan->no_jual = $request->no_nota;
        $tambah_penjualan->tgl_jual = $request->tgl;
        $tambah_penjualan->no_nota = $request->no_nota;
        $tambah_penjualan->total_jual = $request->total;
        $tambah_penjualan->no_order = $request->no_order;
        $tambah_penjualan->save();
        //SIMPAN DATA KE TABEL DETAIL penjualan
        $kdbrg  = $request->kd_brg;
        $qtyjual = $request->qty_jual;
        $subjual = $request->sub_jual;
        foreach ($kdbrg as $key => $no) {
            $input['no_jual']   = $request->no_nota;
            $input['kd_brg']    = $kdbrg[$key];
            $input['qty_jual']  = $qtyjual[$key];
            $input['sub_jual']  = $subjual[$key];
            Detailpenjualan::insert($input);
        }
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
