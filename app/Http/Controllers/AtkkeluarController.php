<?php

namespace App\Http\Controllers;

use App\masteratk;
use App\Exports\KeluarExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\atkkeluar;
use App\unit;

class AtkkeluarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('tanggalawalkeluar')) {
            $tanggalawal = $request->tanggalawalkeluar;
            $tanggalakhir = $request->tanggalakhirkeluar;
            $masteratk = \App\masteratk::all();
            $barangkeluar = atkkeluar::whereBetween('tanggalkeluar', [$tanggalawal, $tanggalakhir])->orderbyDesc('created_at')->paginate(20);
        } else {
            $barangkeluar = \App\atkkeluar::orderbyDesc('created_at')->paginate(20);
            // $lokasi_barang = \App\lokasi::all();
            $masteratk = masteratk::all();
        }
        $unit = unit::all();
        return view('atkkeluar.index', ['barangkeluar' => $barangkeluar, 'masteratk' => $masteratk, 'unit' => $unit]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'masteratk_id' => 'required',
            'jumlahkeluar' => 'required|integer',
            'tanggalkeluar' => 'required'
        ]);

        \App\atkkeluar::create($request->all());
        return redirect('/atkkeluar')->with('sukses', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barangkeluar = \App\atkkeluar::find($id);
        $masteratk = masteratk::all();
        $unit = unit::all();
        //$lokasi_barang = \App\lokasi::all();
        return view('atkkeluar/edit', ['barangkeluar' => $barangkeluar, 'masteratk' => $masteratk, 'unit' => $unit]);
    }

    public function update(Request $request, $id)
    {
        $barang = \App\atkkeluar::find($id);
        $this->validate($request, [
            'masteratk_id' => 'required',
            'jumlahkeluar' => 'required|integer',
            'tanggalkeluar' => 'required'
        ]);
        $barang->update($request->all());
        return redirect('/atkkeluar')->with('sukses', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $barang = \App\atkkeluar::find($id);
        $barang->delete();
        return redirect('/atkkeluar')->with('sukses', 'Data berhasil dihapus');
    }

    public function exportExcelkeluar()
    {
        return Excel::download(new KeluarExport, 'ATK Keluar.xlsx');
    }

    public function exportPDFkeluar()
    {
        $barangkeluar = atkkeluar::all();
        // $lokasi_barang = \App\lokasi::all();
        $masteratk = masteratk::all();
        $pdf = PDF::loadView('exports.keluarpdf', ['barangkeluar' => $barangkeluar, 'masteratk' => $masteratk]);
        return $pdf->download('ATK keluar.pdf');
    }

    public function exportPDFba(Request $request)
    {
        $tanggalawal = $request->tanggalbaawal;
        $tanggalakhir = $request->tanggalbaakhir;
        $barangkeluar = atkkeluar::query()->where("unit_id", "LIKE", "%" . $request->unit . "%")->whereBetween('tanggalkeluar', [$tanggalawal, $tanggalawal])->orderby('tanggalkeluar')->get();
        // $lokasi_barang = \App\lokasi::all();
        $masteratk = masteratk::all();
        $nomorba = $request->nomorba;
        $tanggalba = $request->tanggalba;
        $referensi = $request->referensi;
        $diketahui = $request->diketahui;
        $penerima = $request->penerima;
        $jabatanpenerima = $request->jabatanpenerima;
        $unit = $request->unit;
        $namaunit = unit::find($unit);
        $pdf = PDF::loadView('exports.bapdf', ['barangkeluar' => $barangkeluar, 'masteratk' => $masteratk, 'nomorba' => $nomorba, 'tanggalba' => $tanggalba, 'referensi' => $referensi, 'diketahui' => $diketahui, 'penerima' => $penerima, 'jabatanpenerima' => $jabatanpenerima, 'tanggalawal' => $tanggalawal, 'tanggalakhir' => $tanggalakhir, 'namaunit' => $namaunit]);
        return $pdf->download('Berita Acara.pdf');
    }
}
