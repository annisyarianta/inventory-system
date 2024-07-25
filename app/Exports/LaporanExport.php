<?php

namespace App\Exports;

use App\barangga;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\masukga;
use App\keluarga;

use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
    }

    protected $tanggalawal;
    protected $tanggalakhir;
    protected $jenislaporan;

    function __construct($tanggalawal, $tanggalakhir, $jenislaporan)
    {
        $this->tanggalawal = $tanggalawal;
        $this->tanggalakhir = $tanggalakhir;
        $this->jenislaporan = $jenislaporan;
    }

    public function view(): View
    {
        if ($this->jenislaporan == "barangmasuk") {
            $barangga = barangga::all();
            $tanggalawal = $this->tanggalawal;
            $tanggalakhir = $this->tanggalakhir;
            $barangmasuk = masukga::query()->whereBetween('tanggalmasuk', [$tanggalawal, $tanggalakhir])->get();
            return view('exports.masukexcel', ['barangmasuk' => $barangmasuk, 'barangga' => $barangga]);
            // ->orwhere("gudang", "LIKE", "%" . $request->cari . "%")
        } else if ($this->jenislaporan == "barangkeluar") {
            $barangga = \App\barangga::all();
            $tanggalawal = $this->tanggalawal;
            $tanggalakhir = $this->tanggalakhir;
            $barangkeluar = keluarga::query()->whereBetween('tanggalkeluar', [$tanggalawal, $tanggalakhir])->get();
            return view('exports.keluarexcel', ['barangga' => $barangga, 'barangkeluar' => $barangkeluar]);
        }
    }
}
