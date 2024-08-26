<?php

namespace App\Http\Controllers;

use App\request as requestmodel;
use App\validation as validationmodel;
use App\atkkeluar; // Import model BarangKeluar
use Illuminate\Http\Request;

class ValidasiAtkController extends Controller
{
    public function index()
    {
        $validations = validationmodel::with('requestmodel.masteratk', 'requestmodel.unit')
            ->where('status', 'pending')
            ->orderbyDesc('created_at')
            ->paginate(20);

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

    // Validasi input
    $this->validate($request, [
        'status' => 'required|in:approved,rejected,modified,pending',
        'quantity' => 'required_if:status,modified|integer|min:1'
    ]);

    // Ambil data dari request
    $status = $request->input('status');
    $inputQuantity = $request->input('quantity');
    $requestQuantity = $validation->requestmodel->quantity;

    // Untuk status 'modified', perbarui quantity requestmodel terlepas apakah bertambah atau berkurang
    if ($status == 'modified') {
        $finalQuantity = $inputQuantity;

        // Update jumlah di requestmodel
        $validation->requestmodel->update([
            'quantity' => $finalQuantity,
        ]);

        $status = 'pending'; // Tetap pending setelah dimodifikasi
    } elseif ($status == 'rejected') {
        $finalQuantity = 0; // Jika ditolak, tidak ada barang yang keluar
    } else {
        $finalQuantity = $requestQuantity; // Gunakan jumlah asli untuk status selain 'modified' atau 'rejected'
    }

    // Update validation model dengan data baru
    $validation->update([
        'status' => $status,
        'quantity' => $finalQuantity,
        'tanggal_validasi' => now()
    ]);

    // Update status di request model
    $validation->requestmodel->update([
        'status' => $status,
    ]);

    // Jika status adalah approved, masukkan data ke tabel barang keluar
    if ($status == 'approved') {
        atkkeluar::create([
            'masteratk_id' => $validation->requestmodel->masteratk_id,
            'jumlahkeluar' => $finalQuantity,
            'tanggalkeluar' => now(),
            'unit_id' => $validation->requestmodel->unit_id
        ]);
    }

    // Redirect ke halaman validasi dengan pesan sukses
    return redirect()->route('validations.index')->with('sukses', 'Validasi ATK berhasil diupdate');
}

    
    // Metode update untuk memanggil storeValidation
    public function update(Request $request, $id)
    {
        return $this->storeValidation($request, $id);
    }
}
