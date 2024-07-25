<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\unit;

class UnitController extends Controller
{
    public function index()
    {
        $unit = unit::all();
        return view('unit.index', ['unit' => $unit]);
    }

    // public function list($id)
    // {
    //     $lokasi = lokasi::find($id);
    //     $lokasi_barang = \App\lokasi::all();
    //     return view('lokasi.list', ['lokasi' => $lokasi, 'lokasi_barang' => $lokasi_barang]);
    // }

    public function create(Request $request)
    {
        unit::create($request->all());
        return redirect('/unit')->with('sukses', 'Unit berhasil ditambahkan');
    }

    public function delete($id)
    {
        $unit = \App\unit::find($id);
        if ($unit->keluarga->all()) {
            return redirect('/unit')->with('gagal', 'Unit gagal dihapus');
        } else {
            $unit->delete();
            return redirect('/unit')->with('sukses', 'Unit berhasil dihapus');
        }
    }

    public function update(Request $request, $id)
    {
        $unit = unit::find($id);
        $unit->update($request->all());
        return redirect('/unit')->with('sukses', 'Unit berhasil diubah');
    }
}
