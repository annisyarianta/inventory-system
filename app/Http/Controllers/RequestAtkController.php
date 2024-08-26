<?php

namespace App\Http\Controllers;

use App\Requests as requestmodel;
use App\masteratk;
use App\unit;
use App\Validation;
use PDF;
use App\atkkeluar;
use Illuminate\Http\Request;

class RequestAtkController extends Controller
{
    public function index()
    {
        $requests = requestmodel::with('masteratk', 'unit')->orderbyDesc('created_at')->paginate(20);
        $unit = unit::all(); 
        return view('requestatk.index', ['requests' => $requests, 'unit' => $unit]); // Mengirimkan 'unit' ke view
    }

    public function create()
    {
        $masteratk = masteratk::all();
        $unit = unit::all();
        return view('requestatk.create', ['masteratk' => $masteratk, 'unit' => $unit]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'masteratk_id' => 'required|exists:masteratk,id',
            'quantity' => 'required|integer',
            'unit_id' => 'required|exists:unit,id',
            'tanggal_request' => 'required|date'
        ]);

        $requestAtk = requestmodel::create([
            'masteratk_id' => $request->masteratk_id,
            'quantity' => $request->quantity,
            'unit_id' => $request->unit_id,
            'tanggal_request' => $request->tanggal_request,
            'status' => 'pending'
        ]);

        // Insert into validasiatk for admin validation
        Validation::create([
            'request_id' => $requestAtk->id,
            'masteratk_id' => $requestAtk->masteratk_id,
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
        $barangkeluar = atkkeluar::query()
            ->where("unit_id", "LIKE", "%" . $request->unit . "%")
            ->whereBetween('tanggalkeluar', [$tanggalawal, $tanggalakhir]) // Mengganti $tanggalawal dengan $tanggalakhir di akhir query
            ->orderby('tanggalkeluar')
            ->get();

        $masteratk = masteratk::all();
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
            'masteratk' => $masteratk, 
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
