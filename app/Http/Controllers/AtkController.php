<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\atkmasuk;
use App\atkkeluar;

class AtkController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $inventory_barang = \App\masteratk::where("namabarang", "LIKE", "%" . $request->cari . "%")->orWhere("kodebarang", "LIKE", "%" . $request->cari . "%")->orderBy('namabarang')->paginate();
            $barangmasuk = atkmasuk::all();
            $barangkeluar = atkkeluar::all();
            // ->orwhere("gudang", "LIKE", "%" . $request->cari . "%")
        } else {
            $inventory_barang = \App\masteratk::orderBy('namabarang')->paginate(20);
            $barangmasuk = atkmasuk::all();
            $barangkeluar = atkkeluar::all();
        }
        // $lokasi_barang = \App\lokasi::all();
        return view('atk.index', ['inventory_barang' => $inventory_barang, 'barangmasuk' => $barangmasuk, 'barangkeluar' => $barangkeluar]);
    }
}
