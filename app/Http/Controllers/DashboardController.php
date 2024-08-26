<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\masteratk;
use App\atkkeluar;
use App\atkmasuk;
use Carbon\Carbon;
use App\requests;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan dan tahun dari request, jika tidak ada gunakan bulan dan tahun sekarang
        $selectedMonth = $request->input('bulan', Carbon::now()->month);
        $selectedYear = $request->input('tahun', Carbon::now()->year);
        $tanggalawal = $request->input('tanggalawalkeluar');
        $tanggalakhir = $request->input('tanggalakhirkeluar');

        if ($request->has('cari')) {
            $inventory_barang = masteratk::where("namabarang", "LIKE", "%" . $request->cari . "%")
                ->orderBy('namabarang')
                ->paginate();
            $barangmasuk = atkmasuk::all();
            $barangkeluar = atkkeluar::all();
            return view('daftar.index', [
                'inventory_barang' => $inventory_barang,
                'barangmasuk' => $barangmasuk,
                'barangkeluar' => $barangkeluar
            ]);
        } else {
            $barangmasuk = atkmasuk::all();
            $barangkeluar = atkkeluar::all();
            $totalBarangMasuk = atkmasuk::sum('jumlahmasuk');
            $totalBarangKeluar = atkkeluar::sum('jumlahkeluar');
            $jumlah_atk_keseluruhan = $totalBarangMasuk - $totalBarangKeluar;

            // Hitung jumlah barang masuk berdasarkan bulan dan tahun yang dipilih
            $jumlah_barang_masuk_perbulan = atkmasuk::whereMonth('tanggalmasuk', $selectedMonth)
                ->whereYear('tanggalmasuk', $selectedYear)
                ->sum('jumlahmasuk');

            // Hitung jumlah barang keluar berdasarkan bulan dan tahun yang dipilih
            $jumlah_barang_keluar_perbulan = atkkeluar::whereMonth('tanggalkeluar', $selectedMonth)
                ->whereYear('tanggalkeluar', $selectedYear)
                ->sum('jumlahkeluar');
            
            //Data jumlah pending request
            $pendingRequestCount = requests::where('status', 'pending')->count();

            // Data untuk chart
            $monthlyData = [];

            for ($month = 1; $month <= 12; $month++) {
                $masuk = atkmasuk::whereMonth('tanggalmasuk', $month)
                    ->whereYear('tanggalmasuk', $selectedYear)
                    ->sum('jumlahmasuk');
                $keluar = atkkeluar::whereMonth('tanggalkeluar', $month)
                    ->whereYear('tanggalkeluar', $selectedYear)
                    ->sum('jumlahkeluar');

                $monthlyData[] = [
                    'month' => $month,
                    'barang_masuk' => $masuk,
                    'barang_keluar' => $keluar,
                ];
            }

            // Filter berdasarkan tanggal
            $topKeluarQuery = atkkeluar::query();
            if ($tanggalawal && $tanggalakhir) {
                $topKeluarQuery->whereBetween('tanggalkeluar', [$tanggalawal, $tanggalakhir]);
            }

            // Data untuk chart pie
            $topKeluarQuery = atkkeluar::query();
            if ($tanggalawal && $tanggalakhir) {
                $topKeluarQuery->whereBetween('tanggalkeluar', [$tanggalawal, $tanggalakhir]);
            } else {
                $topKeluarQuery->whereMonth('tanggalkeluar', $selectedMonth)
                    ->whereYear('tanggalkeluar', $selectedYear);
            }

            $topKeluar = $topKeluarQuery->select('masteratk_id', \DB::raw('SUM(jumlahkeluar) as total_keluar'))
                ->groupBy('masteratk_id')
                ->orderBy('total_keluar', 'DESC')
                ->limit(5) // Menampilkan 5 barang keluar terbanyak
                ->get();

            $barangKeluarIds = $topKeluar->pluck('masteratk_id')->toArray();
            $masterAtkList = masteratk::whereIn('id', $barangKeluarIds)->get()->keyBy('id');

            // Menyusun data untuk chart pie
            $chartData = [];
            foreach ($topKeluar as $item) {
                $barang = $masterAtkList[$item->masteratk_id];
                $chartData['labels'][] = $barang->namabarang;
                $chartData['data'][] = $item->total_keluar;
            }

            return view('dashboards.index', [
                'barangmasuk' => $barangmasuk,
                'barangkeluar' => $barangkeluar,
                'jumlah_atk_keseluruhan' => $jumlah_atk_keseluruhan,
                'jumlah_barang_masuk_perbulan' => $jumlah_barang_masuk_perbulan,
                'jumlah_barang_keluar_perbulan' => $jumlah_barang_keluar_perbulan,
                'chartData' => $chartData,
                'selectedMonth' => $selectedMonth,
                'selectedYear' => $selectedYear,
                'monthlyData' => $monthlyData,
                'topKeluar' => $topKeluar,
                'masterAtkList' => $masterAtkList,
                'tanggalawal' => $tanggalawal,
                'tanggalakhir' => $tanggalakhir,
                'pendingRequestCount' => $pendingRequestCount,
            ]);
        }
    }
}
