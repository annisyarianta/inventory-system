<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\keluarga;
use App\masukga;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DaftarExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Daftar::all();
    // }

    public function view(): View
    {
        $inventory_barang = \App\barangga::all();
        $barangmasuk = masukga::all();
        $barangkeluar = keluarga::all();

        // $lokasi_barang = \App\lokasi::all();
        return view('exports.daftarexcel', ['inventory_barang' => $inventory_barang, 'barangmasuk' => $barangmasuk, 'barangkeluar' => $barangkeluar]);
    }
}
