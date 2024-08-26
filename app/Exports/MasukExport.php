<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\atkmasuk;
use App\masteratk;
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
        $barangmasuk = atkmasuk::all();
        // $lokasi_barang = \App\lokasi::all();
        $masteratk = masteratk::all();
        return view('exports.masukexcel', ['barangmasuk' => $barangmasuk, 'masteratk' => $masteratk]);
    }
}
