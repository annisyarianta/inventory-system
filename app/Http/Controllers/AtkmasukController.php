<?php

namespace App\Http\Controllers;

use App\masteratk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use App\Exports\MasukExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\atkmasuk;

class AtkmasukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('tanggalawalmasuk')) {
            $tanggalawal = $request->tanggalawalmasuk;
            $tanggalakhir = $request->tanggalakhirmasuk;
            $masteratk = \App\masteratk::all();
            $barangmasuk = atkmasuk::whereBetween('tanggalmasuk', [$tanggalawal, $tanggalakhir])->orderbyDesc('created_at')->paginate(20);
        } else {
            $barangmasuk = \App\atkmasuk::orderbyDesc('created_at')->paginate(20);
            // $lokasi_barang = \App\lokasi::all();
            $masteratk = masteratk::all();
        }
        return view('atkmasuk.index', ['barangmasuk' => $barangmasuk, 'masteratk' => $masteratk]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'masteratk_id' => 'required',
            'jumlahmasuk' => 'required|integer',
            'tanggalmasuk' => 'required',
            'hargasatuan' => 'required|integer',
        ]);

        $requestData = $request->all();
        $requestData['hargatotal'] = $request->jumlahmasuk * $request->hargasatuan;

        \App\atkmasuk::create($requestData);
        return redirect('/atkmasuk')->with('sukses', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barangmasuk = \App\atkmasuk::find($id);
        $masteratk = masteratk::all();
        //$lokasi_barang = \App\lokasi::all();
        return view('atkmasuk/edit', ['barangmasuk' => $barangmasuk, 'masteratk' => $masteratk]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'masteratk_id' => 'required',
            'jumlahmasuk' => 'required|integer',
            'tanggalmasuk' => 'required',
            'hargasatuan' => 'required|integer',
        ]);
    
        $barang = \App\atkmasuk::find($id);
        $requestData = $request->all();
        $requestData['hargatotal'] = $request->jumlahmasuk * $request->hargasatuan;
    
        $barang->update($requestData);
        return redirect('/atkmasuk')->with('sukses', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $barang = \App\atkmasuk::find($id);
        $barang->delete();
        return redirect('/atkmasuk')->with('sukses', 'Data berhasil dihapus');
    }

    public function exportExcelmasuk()
    {
        return Excel::download(new MasukExport, 'ATK Masuk.xlsx');
    }

    public function exportPDFmasuk()
    {
        $barangmasuk = atkmasuk::all();
        // $lokasi_barang = \App\lokasi::all();
        $masteratk = masteratk::all();
        $pdf = PDF::loadView('exports.masukpdf', ['barangmasuk' => $barangmasuk, 'masteratk' => $masteratk]);
        return $pdf->download('ATK masuk.pdf');
    }
}
