<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use App\Exports\InventoryExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $inventory_barang = \App\inventory::where("nama", "LIKE", "%" . $request->cari . "%")->orderBy('nama')->paginate();
            // ->orwhere("gudang", "LIKE", "%" . $request->cari . "%")
        } else {
            $inventory_barang = \App\inventory::orderBy('nama')->paginate(20);
        }
        $lokasi_barang = \App\lokasi::all();
        return view('inventory.index', ['inventory_barang' => $inventory_barang, 'lokasi_barang' => $lokasi_barang]);
    }

    public function profil($id)
    {
        $barang = \App\inventory::find($id);
        return view('/inventory/profil', ['barang' => $barang]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:barang',
            'ok' => 'required|integer|min:0',
            'us' => 'required|integer|min:0',
            'lokasi_id' => 'required',
            'gambar' => 'mimes:jpg,jpeg,png'
        ]);

        $barang = \App\inventory::create($request->all());
        if ($request->hasFile('gambar')) {
            $namafile = Str::random(12);
            $request->file('gambar')->move('images/', $namafile);
            $barang->gambar = $namafile;
            $barang->save();
        }
        return redirect('/inventory')->with('sukses', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = \App\inventory::find($id);
        $lokasi_barang = \App\lokasi::all();
        return view('inventory/edit', ['barang' => $barang, 'lokasi_barang' => $lokasi_barang]);
    }

    public function update(Request $request, $id)
    {
        $barang = \App\inventory::find($id);
        $this->validate($request, [
            'nama' => 'required',
            'ok' => 'required|integer|min:0',
            'us' => 'required|integer|min:0',
            'lokasi_id' => 'required',
            'gambar' => 'mimes:jpg,jpeg,png'
        ]);
        $barang->update($request->all());
        if ($request->hasFile('gambar')) {
            $namafile = Str::random(12);
            $request->file('gambar')->move('images/', $namafile);
            $barang->gambar = $namafile;
            $barang->save();
        }
        return redirect('/inventory')->with('sukses', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $barang = \App\inventory::find($id);
        $barang->delete();
        return redirect('/inventory')->with('sukses', 'Data berhasil dihapus');
    }

    public function exportPDF()
    {
        $inventory_barang = \App\inventory::all();
        $pdf = PDF::loadView('exports.inventorypdf', ['inventory_barang' => $inventory_barang]);
        return $pdf->download('inventory.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new InventoryExport, 'inventory.xlsx');
    }
}
