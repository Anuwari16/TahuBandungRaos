<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LaporanPenjualan;
use App\Lap_jurnal;
use PDF;
use DB;

class LaporanPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bb = \App\LaporanPenjualan::All();
        $pdf = PDF::loadview('laporan.laporanpenjualancetak', ['laporanpenjualan' => $bb])->setPaper('A4', 'landscape');
        return $pdf->stream();
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
    public function show($request)
    {
        $periode = $request->get('periodelaporan');
        if ($periode == 'All') {
            $bb = \App\LaporanPenjualan::All();
            $pdf = PDF::loadview('laporan.laporanpenjualancetak', ['laporanpenjualan' => $bb])->setPaper('A4', 'landscape');
            return $pdf->stream();
        } elseif ($periode == 'periodelaporan') {
            $tglawal = $request->get('tglawal');
            $tglakhir = $request->get('tglakhir');
            $bb = \App\LaporanPenjualan::All();
            $bb = DB::table('laporan_penjualan')
                ->whereBetween('tgl_lap', [$tglawal, $tglakhir])
                ->orderby('tgl_lap', 'ASC')
                ->get();
            $pdf = PDF::loadview('laporan.laporanpenjualancetak', ['laporanpenjualan' => $bb])->setPaper('A4', 'landscape');
            return $pdf->stream();
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
