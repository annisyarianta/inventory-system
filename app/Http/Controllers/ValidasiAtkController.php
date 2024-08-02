<?php

namespace App\Http\Controllers;

use App\Requests as requestmodel;
use App\Validation as validationmodel;
use Illuminate\Http\Request;

class ValidasiAtkController extends Controller
{
    public function index()
    {
        $validations = validationmodel::with('requestmodel.barangga', 'requestmodel.unit')->where('status', 'pending')->orderbyDesc('created_at')->paginate(20);
        return view('validations.index', ['validations' => $validations]);
    }

    public function validateRequest($id)
    {
        $validation = validationmodel::findOrFail($id);
        return view('validations.validate', ['validation' => $validation]);
    }

    public function storeValidation(Request $request, $id)
    {
        $validation = validationmodel::findOrFail($id);

        $this->validate($request, [
            'status' => 'required|in:approved,rejected,modified',
            'quantity' => 'required_if:status,modified|integer'
        ]);

        $status = $request->input('status');
        $quantity = $request->input('quantity', $validation->quantity);

        if ($status == 'approved' || $status == 'modified') {
            // Update barangga quantity (reduce the stock)
            $barangga = $validation->requestmodel->barangga;
            $barangga->decrement('stock', $quantity);

            // Update request status
            $validation->requestmodel->update([
                'status' => $status == 'approved' ? 'approved' : 'modified',
                'quantity' => $quantity
            ]);
        } elseif ($status == 'rejected') {
            $validation->request->update([
                'status' => 'rejected'
            ]);
        }

        $validation->update([
            'status' => $status,
            'quantity' => $quantity,
            'tanggal_validasi' => now()
        ]);

        return redirect('/validasiatk')->with('sukses', 'Validasi ATK berhasil diupdate');
    }
}

