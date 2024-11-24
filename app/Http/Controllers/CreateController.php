<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailPenjualan;
use App\Penjualan;
use App\Jurnal;
use App\PreOrder;
use App\Temp_PreOrder;
use DB;
use Alert;
class CreateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akun = \App\Akun::All();
        $barang = \App\Barang::All();
        $agen = \App\Agen::All();
        $temp_order = \App\Temp_Order::All();
        //No otomatis untuk transaksi pemesanan
        $AWAL = 'TRX';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = \App\PreOrder::max('no_order');
        $no = 1;
        $formatnya = sprintf("%03s", abs((int)$noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
        return view(
            'penjualan.penjualancreate',
            [
                'barang' => $barang,
                'akun' => $akun,
                'agen' => $agen,
                'temp_pre_order' => $temp_order,
                'formatnya' => $formatnya,
            ]
        );
    }
    public function tambahOrder()
    {
        return view('penjualan.penjualancreate');
    
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
        if (Temp_PreOrder::where('kd_brg', $request->brg)->exists()) {
            Alert::warning('Pesan ','barang sudah ada.. QTY akan terupdate ?');
            Temp_PreOrder::where('kd_brg', $request->brg)
                            ->update(['qty_order' => $request->qty]);
            return redirect('create');
        }else{
            Temp_PreOrder::create([
                'qty_order' => $request->qty,
                'kd_brg' => $request->brg
            ]);
        return redirect('create');
        }
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
    public function destroy($kd_brg)
    {
        $barang=\App\Temp_PreOrder::findOrFail($kd_brg);
        $barang->delete();
        Alert::success('Pesan ','Data berhasil dihapus');
        return redirect('create');
    }
}
