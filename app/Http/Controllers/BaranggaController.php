<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class BaranggaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('carimasterdata')) {
            $inventory_barang = \App\barangga::where("namabarang", "LIKE", "%" . $request->carimasterdata . "%")
                ->orWhere("kodebarang", "LIKE", "%" . $request->carimasterdata . "%")
                ->orderBy('namabarang')
                ->paginate();
        } else {
            $inventory_barang = \App\barangga::orderBy('namabarang')->paginate(20);
        }
        return view('barangga.index', ['inventory_barang' => $inventory_barang]);
    }

    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'namabarang' => 'required|unique:barangga',
            'kodebarang' => 'required|unique:barangga',
            'jenisbarang' => 'required',
            'satuan' => 'required',
            'gambar' => 'mimes:jpg,jpeg,png|max:2048', // Maksimal 2MB
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('modal_open', true); // Menandai bahwa modal harus dibuka
        }
    
        // Proses pembuatan barang jika validasi sukses
        $barang = \App\barangga::create($request->all());
        if ($request->hasFile('gambar')) {
            $namafile = Str::random(12) . '.' . $request->file('gambar')->getClientOriginalExtension();
            $request->file('gambar')->move('images/', $namafile);
            $barang->gambar = $namafile;
            $barang->save();
        }
        return redirect('/barangga')->with('sukses', 'Data berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $barang = \App\barangga::find($id);
        return view('barangga/edit', ['barang' => $barang]);
    }

    public function update(Request $request, $id)
    {
        $barang = \App\barangga::find($id);
        $this->validate($request, [
            'namabarang' => 'required',
            'kodebarang' => 'required',
            'jenisbarang' => 'required',
            'satuan' => 'required',
            'gambar' => 'mimes:jpg,jpeg,png|max:2048', // Maksimal 2MB
        ]);

        $barang->update($request->all());
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar && file_exists(public_path('images/' . $barang->gambar))) {
                unlink(public_path('images/' . $barang->gambar));
            }

            $namafile = Str::random(12) . '.' . $request->file('gambar')->getClientOriginalExtension();
            $request->file('gambar')->move('images/', $namafile);
            $barang->gambar = $namafile;
            $barang->save();
        }
        return redirect('/barangga')->with('sukses', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $barang = \App\barangga::find($id);
        if ($barang->masukga->all() & $barang->keluarga->all()) {
            return redirect('/barangga')->with('gagal', 'Data gagal dihapus, data masih digunakan pada barang masuk/keluar!');
        } else {
            if ($barang->gambar && file_exists(public_path('images/' . $barang->gambar))) {
                unlink(public_path('images/' . $barang->gambar));
            }
            $barang->delete();
            return redirect('/barangga')->with('sukses', 'Data berhasil dihapus');
        }
    }

    // public function exportPDF()
    // {
    //     $inventory_barang = \App\inventory::all();
    //     $pdf = PDF::loadView('exports.inventorypdf', ['inventory_barang' => $inventory_barang]);
    //     return $pdf->download('inventory.pdf');
    // }

    // public function exportExcel()
    // {
    //     return Excel::download(new BaranggaExport, 'inventory.xlsx');
    // }
}
