<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailPesanController extends Controller
{
    public function simpan(Request $request)
    {

        //Simpan ke table pemesanan
        $tambah_preorder = new \App\PreOrder();
        $tambah_preorder->no_order = $request->no_order;
        $tambah_preorder->tgl_order = $request->tgl;
        $tambah_preorder->total = $request->total;
        $tambah_preorder->kd_agen = $request->agen;
        $tambah_preorder->save();
        //SIMPAN DATA KE TABEL DETAIL
        $kd_brg = $request->kd_brg;
        $qty = $request->qty_order;
        $sub_total = $request->sub_total;
        foreach ($kd_brg as $key => $no) {
            $input['no_order'] = $request->no_order;
            $input['kd_brg'] = $kd_brg[$key];
            $input['qty_order'] = $qty[$key];
            $input['subtotal'] = $sub_total[$key];
            DetailOrder::insert($input);
        }
        Alert::success('Pesan ', 'Data berhasil disimpan');
        return redirect('/transaksi');
    }
}
