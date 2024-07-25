<?php

namespace App\Exports;

use App\inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InventoryExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return inventory::all();
    // }

    public function view(): View
    {
        $inventory_barang = \App\inventory::all();
        return view('exports.inventoryexcel', [
            'inventory_barang' => $inventory_barang
        ]);
    }

    // public function headings(): array
    // {
    //     return [
    //         'Nama Barang',
    //         'OK',
    //         'U/S',
    //         'Jumlah',
    //         'Lokasi',
    //         'Keterangan'
    //     ];
    // }

    // public function map($barang): array
    // {
    //     $no = 0;
    //     return [
    //         $barang->nama,
    //         $barang->ok,
    //         $barang->us,
    //         $barang->ok + $barang->us,
    //         $barang->lokasi->NamaLokasi,
    //         $barang->keterangan
    //     ];
    // }
}
