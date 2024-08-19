<?php

namespace App\Http\Controllers;

use App\Requests as requestmodel;
use App\barangga;
use App\unit;
use App\Validation;
use PDF;
use App\keluarga;
use Illuminate\Http\Request;

class RequestAtkController extends Controller
{
    public function index()
    {
        $requests = requestmodel::with('barangga', 'unit')->orderbyDesc('created_at')->paginate(20);
        $unit = unit::all(); 
        return view('requestatk.index', ['requests' => $requests, 'unit' => $unit]); // Mengirimkan 'unit' ke view
    }

    public function create()
    {
        $barangga = barangga::all();
        $unit = unit::all();
        return view('requestatk.create', ['barangga' => $barangga, 'unit' => $unit]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'barangga_id' => 'required|exists:barangga,id',
            'quantity' => 'required|integer',
            'unit_id' => 'required|exists:unit,id',
            'tanggal_request' => 'required|date'
        ]);

        $requestAtk = requestmodel::create([
            'barangga_id' => $request->barangga_id,
            'quantity' => $request->quantity,
            'unit_id' => $request->unit_id,
            'tanggal_request' => $request->tanggal_request,
            'status' => 'pending'
        ]);

        // Insert into validasiatk for admin validation
        Validation::create([
            'request_id' => $requestAtk->id,
            'barangga_id' => $requestAtk->barangga_id,
            'quantity' => $requestAtk->quantity,
            'unit_id' => $requestAtk->unit_id,
            'status' => 'pending'
        ]);

        return redirect('/requests')->with('sukses', 'Request ATK berhasil ditambahkan');
    }

    public function exportPDFba(Request $request)
    {
        $tanggalawal = $request->tanggalbaawal;
        $tanggalakhir = $request->tanggalbaakhir;
        $barangkeluar = keluarga::query()
            ->where("unit_id", "LIKE", "%" . $request->unit . "%")
            ->whereBetween('tanggalkeluar', [$tanggalawal, $tanggalakhir]) // Mengganti $tanggalawal dengan $tanggalakhir di akhir query
            ->orderby('tanggalkeluar')
            ->get();

        $barangga = barangga::all();
        $nomorba = $request->nomorba;
        $tanggalba = $request->tanggalba;
        $referensi = $request->referensi;
        $diketahui = $request->diketahui;
        $penerima = $request->penerima;
        $jabatanpenerima = $request->jabatanpenerima;
        $unit = $request->unit;
        $namaunit = unit::find($unit);
        
        $pdf = PDF::loadView('exports.bapdf', [
            'barangkeluar' => $barangkeluar, 
            'barangga' => $barangga, 
            'nomorba' => $nomorba, 
            'tanggalba' => $tanggalba, 
            'referensi' => $referensi, 
            'diketahui' => $diketahui,
            'penerima' => $penerima, 
            'jabatanpenerima' => $jabatanpenerima, 
            'tanggalawal' => $tanggalawal, 
            'tanggalakhir' => $tanggalakhir, 
            'namaunit' => $namaunit
        ]);

        return $pdf->download('Berita Acara.pdf');
    }
}
