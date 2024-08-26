<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\masteratk;
use App\atkkeluar;

class KeluarExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
    }

    public function view(): View
    {
        $barangkeluar = atkkeluar::all();
        // $lokasi_barang = \App\lokasi::all();
        $masteratk = masteratk::all();
        return view('exports.keluarexcel', ['barangkeluar' => $barangkeluar, 'masteratk' => $masteratk]);
    }
}
