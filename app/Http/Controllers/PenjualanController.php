<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\DetailPenjualan;
use App\Penjualan;
use App\Jurnal;
use App\PreOrder;
use App\LaporanPenjualan;
use DB;
use Alert;
use PDF;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = \App\PreOrder::All();
        $order = DB::select('SELECT * FROM pre_order where not exists (select* from penjualan where pre_order.no_order=penjualan.no_order)');
        return view('penjualan.penjualan', ['preorder' => $order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AWAL = 'FKT';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = \App\penjualan::max('no_jual');
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
        return view('penjualan.jual', ['detail' => $detail, 'format' => $format, 'no_order' => $decrypted, 'preorder' => $preorder, 'formatj' => $formatj, 'kas' => $akunkas, 'penjualan' => $akunpenjualan]);
    }

    public function pdf($id)
    {
        $decrypted = Crypt::decryptString($id);
        $detail      = DB::table('tampil_preorder')->where('no_order', $decrypted)->get();
        $agen    = DB::table('agen')->get();
        $preorder   = DB::table('pre_order')->where('no_order', $decrypted)->get();
        $pdf = PDF::loadView('laporan.nota', ['detail' => $detail, 'order' => $preorder, 'agen' => $agen, 'noorder' => $decrypted]);
        return $pdf->stream();
    }


    public function simpan(Request $request)
    {
        if (Penjualan::where('no_order', $request->no_order)->exists()) {
            Alert::warning('order ', 'penjualan Telah dilakukan ');

            return redirect('penjualan');
        } else {
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
                DetailPenjualan::insert($input);
            }

            //SIMPAN DATA KE TABEL laporanpenjualan
            $kdbrg  = $request->kd_brg;
            $qtyjual = $request->qty_jual;
            $subjual = $request->sub_jual;
            foreach ($kdbrg as $key => $no) {
                $input['no_jual']   = $request->no_nota;
                $input['tgl_lap']   = $request->tgl;
                $input['kd_brg']    = $kdbrg[$key];
                $input['qty_jual']  = $qtyjual[$key];
                $input['sub_jual']  = $subjual[$key];
                LaporanPenjualan::insert($input);
            } 


           

            //SIMPAN ke table jurnal bagian debet
            $tambah_jurnaldebet = new \App\Jurnal;
            $tambah_jurnaldebet->no_jurnal = $request->no_jurnal;
            $tambah_jurnaldebet->keterangan = ' Kas ';
            $tambah_jurnaldebet->tgl_jurnal = $request->tgl;
            $tambah_jurnaldebet->no_akun = $request->penjualan;
            $tambah_jurnaldebet->debet = $request->total;
            $tambah_jurnaldebet->kredit = '0';
            $tambah_jurnaldebet->save();

            //SIMPAN ke table jurnal bagian kredit
            $tambah_jurnalkredit = new \App\Jurnal;
            $tambah_jurnalkredit->no_jurnal = $request->no_jurnal;
            $tambah_jurnalkredit->keterangan = 'penjualan Barang';
            $tambah_jurnalkredit->tgl_jurnal = $request->tgl;
            $tambah_jurnalkredit->no_akun = $request->akun;
            $tambah_jurnalkredit->debet = '0';
            $tambah_jurnalkredit->kredit = $request->total;
            $tambah_jurnalkredit->save();
            Alert::success('order ', 'Data berhasil disimpan');
            return redirect('/penjualan');
        }
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
