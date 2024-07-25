<?php

namespace App\Exports;

use App\lokasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LokasiExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return lokasi::all();
    // }

    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $lokasi = lokasi::find($this->id);
        $lokasi_barang = \App\lokasi::all();
        return view('exports.inventoryexcelid', [
            'lokasi' => $lokasi, 'lokasi_barang' => $lokasi_barang
        ]);
    }
}
