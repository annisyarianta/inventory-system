<?php

namespace App\Http\Controllers;

use App\barangga;
use App\Exports\KeluarExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\keluarga;
use App\unit;

class KeluargaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('tanggalawalkeluar')) {
            $tanggalawal = $request->tanggalawalkeluar;
            $tanggalakhir = $request->tanggalakhirkeluar;
            $barangga = \App\barangga::all();
            $barangkeluar = keluarga::whereBetween('tanggalkeluar', [$tanggalawal, $tanggalakhir])->orderbyDesc('tanggalkeluar')->paginate(20);
        } else {
            $barangkeluar = \App\keluarga::orderbyDesc('tanggalkeluar')->paginate(20);
            // $lokasi_barang = \App\lokasi::all();
            $barangga = barangga::all();
        }
        $unit = unit::all();
        return view('keluarga.index', ['barangkeluar' => $barangkeluar, 'barangga' => $barangga, 'unit' => $unit]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'barangga_id' => 'required',
            'jumlahkeluar' => 'required|integer',
            'tanggalkeluar' => 'required'
        ]);

        \App\keluarga::create($request->all());
        return redirect('/keluarga')->with('sukses', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barangkeluar = \App\keluarga::find($id);
        $barangga = barangga::all();
        $unit = unit::all();
        //$lokasi_barang = \App\lokasi::all();
        return view('keluarga/edit', ['barangkeluar' => $barangkeluar, 'barangga' => $barangga, 'unit' => $unit]);
    }

    public function update(Request $request, $id)
    {
        $barang = \App\keluarga::find($id);
        $this->validate($request, [
            'barangga_id' => 'required',
            'jumlahkeluar' => 'required|integer',
            'tanggalkeluar' => 'required'
        ]);
        $barang->update($request->all());
        return redirect('/keluarga')->with('sukses', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $barang = \App\keluarga::find($id);
        $barang->delete();
        return redirect('/keluarga')->with('sukses', 'Data berhasil dihapus');
    }

    public function exportExcelkeluar()
    {
        return Excel::download(new KeluarExport, 'ATK Keluar.xlsx');
    }

    public function exportPDFkeluar()
    {
        $barangkeluar = keluarga::all();
        // $lokasi_barang = \App\lokasi::all();
        $barangga = barangga::all();
        $pdf = PDF::loadView('exports.keluarpdf', ['barangkeluar' => $barangkeluar, 'barangga' => $barangga]);
        return $pdf->download('ATK keluar.pdf');
    }

    public function exportPDFba(Request $request)
    {
        $tanggalawal = $request->tanggalbaawal;
        $tanggalakhir = $request->tanggalbaakhir;
        $barangkeluar = keluarga::query()->where("unit_id", "LIKE", "%" . $request->unit . "%")->whereBetween('tanggalkeluar', [$tanggalawal, $tanggalawal])->orderby('tanggalkeluar')->get();
        // $lokasi_barang = \App\lokasi::all();
        $barangga = barangga::all();
        $nomorba = $request->nomorba;
        $tanggalba = $request->tanggalba;
        $referensi = $request->referensi;
        $penerima = $request->penerima;
        $unit = $request->unit;
        $namaunit = unit::find($unit);
        $pdf = PDF::loadView('exports.bapdf', ['barangkeluar' => $barangkeluar, 'barangga' => $barangga, 'nomorba' => $nomorba, 'tanggalba' => $tanggalba, 'referensi' => $referensi, 'penerima' => $penerima, 'tanggalawal' => $tanggalawal, 'tanggalakhir' => $tanggalakhir, 'namaunit' => $namaunit]);
        return $pdf->download('Berita Acara.pdf');
    }
}
