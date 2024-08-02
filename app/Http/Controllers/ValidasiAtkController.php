<?php

namespace App\Http\Controllers;

use App\request as requestmodel;
use App\validation as validationmodel;
use App\keluarga; // Import model BarangKeluar
use Illuminate\Http\Request;

class ValidasiAtkController extends Controller
{
    public function index()
    {
        $validations = validationmodel::with('requestmodel.barangga', 'requestmodel.unit')
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
            'status' => 'required|in:approved,rejected,modified',
            'quantity' => 'required_if:status,modified|integer|min:1'
        ]);

        // Ambil data dari request
        $status = $request->input('status');
        $inputQuantity = $request->input('quantity');
        $requestQuantity = $validation->requestmodel->quantity;

        // Periksa apakah statusnya 'modified' dan jumlah yang dikurangi valid
        if ($status == 'modified') {
            if ($inputQuantity < $requestQuantity) {
                $finalQuantity = $inputQuantity; // Gunakan jumlah yang dimasukkan di form
                $status = 'approved'; // Ubah status menjadi 'approved'
            } else {
                return redirect()->back()->withErrors('Jumlah yang dimasukkan lebih besar atau sama dengan jumlah request.');
            }
        } else {
            $finalQuantity = $requestQuantity; // Jika status bukan 'modified', gunakan jumlah asli
        }

        // Update validation dan request model dengan data baru
        $validation->update([
            'status' => $status,
            'quantity' => $finalQuantity,
            'tanggal_validasi' => now()
        ]);

        // Update quantity di request model dan masukkan ke tabel barang keluar
        if ($status == 'approved') {
            $validation->requestmodel->update([
                'quantity' => $finalQuantity, // Update quantity di requestmodel
                'status' => $status,
            ]);

            // Masukkan data ke tabel barang keluar
            keluarga::create([
                'barangga_id' => $validation->requestmodel->barangga_id,
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