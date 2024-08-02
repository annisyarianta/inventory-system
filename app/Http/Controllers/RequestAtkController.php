<?php

namespace App\Http\Controllers;

use App\Requests as requestmodel;
use App\barangga;
use App\unit;
use App\Validation;
use Illuminate\Http\Request;

class RequestAtkController extends Controller
{
    public function index()
    {
        $requests = requestmodel::with('barangga', 'unit')->orderbyDesc('tanggal_request')->paginate(20);
        return view('requestatk.index', ['requests' => $requests]);
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
        validation::create([
            'request_id' => $requestAtk->id,
            'barangga_id' => $requestAtk->barangga_id,
            'quantity' => $requestAtk->quantity,
            'unit_id' => $requestAtk->unit_id,
            'status' => 'pending'
        ]);

        return redirect('/requests')->with('sukses', 'Request ATK berhasil ditambahkan');
    }
}

