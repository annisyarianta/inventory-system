<?php

namespace App\Exports;

use App\masteratk;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\atkmasuk;
use App\atkkeluar;

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
            $masteratk = masteratk::all();
            $tanggalawal = $this->tanggalawal;
            $tanggalakhir = $this->tanggalakhir;
            $barangmasuk = atkmasuk::query()->whereBetween('tanggalmasuk', [$tanggalawal, $tanggalakhir])->get();
            return view('exports.masukexcel', ['barangmasuk' => $barangmasuk, 'masteratk' => $masteratk]);
            // ->orwhere("gudang", "LIKE", "%" . $request->cari . "%")
        } else if ($this->jenislaporan == "barangkeluar") {
            $masteratk = \App\masteratk::all();
            $tanggalawal = $this->tanggalawal;
            $tanggalakhir = $this->tanggalakhir;
            $barangkeluar = atkkeluar::query()->whereBetween('tanggalkeluar', [$tanggalawal, $tanggalakhir])->get();
            return view('exports.keluarexcel', ['masteratk' => $masteratk, 'barangkeluar' => $barangkeluar]);
        }
    }
}
