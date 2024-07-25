<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use App\barangga;
use App\keluarga;
use App\masukga;
use illuminate\http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $inventory_barang = \App\barangga::where("namabarang", "LIKE", "%" . $request->cari . "%")->orderBy('namabarang')->paginate();
            $barangmasuk = masukga::all();
            $barangkeluar = keluarga::all();
            return view('daftar.index', ['inventory_barang' => $inventory_barang, 'barangmasuk' => $barangmasuk, 'barangkeluar' => $barangkeluar]);
            // ->orwhere("gudang", "LIKE", "%" . $request->cari . "%")
        } else {
            return view('dashboards.index');
        }
    }
}
