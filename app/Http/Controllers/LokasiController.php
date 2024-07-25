<?php

namespace App\Http\Controllers;

use App\lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Exports\LokasiExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi_barang = \App\lokasi::all();
        return view('lokasi.index', ['lokasi_barang' => $lokasi_barang]);
    }

    public function list($id)
    {
        $lokasi = lokasi::find($id);
        $lokasi_barang = \App\lokasi::all();
        return view('lokasi.list', ['lokasi' => $lokasi, 'lokasi_barang' => $lokasi_barang]);
    }

    public function create(Request $request)
    {
        \App\lokasi::create($request->all());
        return redirect('/lokasi')->with('sukses', 'Lokasi berhasil ditambahkan');
    }

    public function delete($id)
    {
        $lokasi = \App\lokasi::find($id);
        if ($lokasi->inventory->all()) {
            return redirect('/lokasi')->with('gagal', 'Lokasi gagal dihapus, masih ada barang di dalamnya!');
        } else {
            $lokasi->delete();
            return redirect('/lokasi')->with('sukses', 'Lokasi berhasil dihapus');
        }
    }

    public function update(Request $request, $id)
    {
        $lokasi = \App\lokasi::find($id);
        $lokasi->update($request->all());
        return redirect('/lokasi')->with('sukses', 'Lokasi berhasil diubah');
    }

    public function exportPDFid($id)
    {
        $lokasi = lokasi::find($id);
        $lokasi_barang = \App\lokasi::all();
        $pdf = PDF::loadView('exports.inventorypdfid', ['lokasi' => $lokasi, 'lokasi_barang' => $lokasi_barang]);
        return $pdf->download('inventory.pdf');
    }

    public function exportExcelid(Request $request)
    {
        return Excel::download(new LokasiExport($request->id), 'inventory.xlsx');
    }
}
