<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Agen;

class AgenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agen = \App\Agen::All();
        return view('admin.agen.agen', ['agen' => $agen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agen.input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Agen::where('kd_agen', $request->addkdagen)->exists()) {
            Alert::warning('Warning ', 'Kode Agen Telah Dipakai ');

            return redirect('barang');
        } else {
            $tambah_agen = new \App\Agen;
            $tambah_agen->kd_agen = $request->addkdagen;
            $tambah_agen->nm_agen = $request->addnmagen;
            $tambah_agen->telepon = $request->addtelepon;
            $tambah_agen->alamat = $request->addalamat;
            $tambah_agen->save();
            Alert::success('Pesan ', 'Data berhasil disimpan');
            return redirect('/agen');
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
        $agen_edit = \App\Agen::findOrFail($id);
        return view('admin.agen.editAgen', ['agen' => $agen_edit]);
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
        $agen = \App\Agen::findOrFail($id);
        $agen->kd_agen = $request->get('addkdagen');
        $agen->nm_agen = $request->get('addnmagen');
        $agen->telepon = $request->get('addtelepon');
        $agen->alamat = $request->get('addalamat');
        $agen->save();
        Alert::success('Pesan ', 'Data berhasil diUpdate');
        return redirect()->route('agen.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agen = \App\Agen::findOrFail($id);
        $agen->delete();
        Alert::success('Pesan ', 'Data berhasil dihapus');
        return redirect()->route('agen.index');
    }
}
