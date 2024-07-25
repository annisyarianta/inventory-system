<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use App\Exports\DaftarExport;
use App\keluarga;
use App\masukga;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Http\Request;

class DaftarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $inventory_barang = \App\barangga::where("namabarang", "LIKE", "%" . $request->cari . "%")->orWhere("kodebarang", "LIKE", "%" . $request->cari . "%")->orderBy('namabarang')->paginate();
            $barangmasuk = masukga::all();
            $barangkeluar = keluarga::all();
            // ->orwhere("gudang", "LIKE", "%" . $request->cari . "%")
        } else {
            $inventory_barang = \App\barangga::orderBy('namabarang')->paginate(20);
            $barangmasuk = masukga::all();
            $barangkeluar = keluarga::all();
        }
        // $lokasi_barang = \App\lokasi::all();
        return view('daftar.index', ['inventory_barang' => $inventory_barang, 'barangmasuk' => $barangmasuk, 'barangkeluar' => $barangkeluar]);
    }

    public function exportExcel()
    {
        return Excel::download(new DaftarExport, 'ATK.xlsx');
    }

    public function exportPDF()
    {
        $inventory_barang = \App\barangga::all();
        $barangmasuk = masukga::all();
        $barangkeluar = keluarga::all();

        $pdf = PDF::loadView('exports.daftarpdf', ['inventory_barang' => $inventory_barang, 'barangmasuk' => $barangmasuk, 'barangkeluar' => $barangkeluar]);
        return $pdf->download('ATK masuk.pdf');
    }
}
