<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\masukga;
use App\barangga;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class MasukExport implements FromView
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
        $barangmasuk = masukga::all();
        // $lokasi_barang = \App\lokasi::all();
        $barangga = barangga::all();
        return view('exports.masukexcel', ['barangmasuk' => $barangmasuk, 'barangga' => $barangga]);
    }
}
