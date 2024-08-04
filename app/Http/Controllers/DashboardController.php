<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\barangga;
use App\keluarga;
use App\masukga;
use Carbon\Carbon;

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
            $inventory_barang = barangga::where("namabarang", "LIKE", "%" . $request->cari . "%")
                ->orderBy('namabarang')
                ->paginate();
            $barangmasuk = masukga::all();
            $barangkeluar = keluarga::all();
            return view('daftar.index', [
                'inventory_barang' => $inventory_barang,
                'barangmasuk' => $barangmasuk,
                'barangkeluar' => $barangkeluar
            ]);
        } else {
            $barangmasuk = masukga::all();
            $barangkeluar = keluarga::all();
            $jumlah_atk_keseluruhan = $barangmasuk->sum('jumlahmasuk');

            // Hitung jumlah barang masuk berdasarkan bulan dan tahun yang dipilih
            $jumlah_barang_masuk_perbulan = masukga::whereMonth('tanggalmasuk', $selectedMonth)
                ->whereYear('tanggalmasuk', $selectedYear)
                ->sum('jumlahmasuk');

            // Hitung jumlah barang keluar berdasarkan bulan dan tahun yang dipilih
            $jumlah_barang_keluar_perbulan = keluarga::whereMonth('tanggalkeluar', $selectedMonth)
                ->whereYear('tanggalkeluar', $selectedYear)
                ->sum('jumlahkeluar');

            // Data untuk chart
            $monthlyData = [];

            for ($month = 1; $month <= 12; $month++) {
                $masuk = masukga::whereMonth('tanggalmasuk', $month)
                    ->whereYear('tanggalmasuk', $selectedYear)
                    ->sum('jumlahmasuk');
                $keluar = keluarga::whereMonth('tanggalkeluar', $month)
                    ->whereYear('tanggalkeluar', $selectedYear)
                    ->sum('jumlahkeluar');

                $monthlyData[] = [
                    'month' => $month,
                    'barang_masuk' => $masuk,
                    'barang_keluar' => $keluar,
                ];
            }

            // Filter berdasarkan tanggal
            $topKeluarQuery = keluarga::query();
            if ($tanggalawal && $tanggalakhir) {
                $topKeluarQuery->whereBetween('tanggalkeluar', [$tanggalawal, $tanggalakhir]);
            }

            // Data untuk chart pie
            $topKeluarQuery = keluarga::query();
            if ($tanggalawal && $tanggalakhir) {
                $topKeluarQuery->whereBetween('tanggalkeluar', [$tanggalawal, $tanggalakhir]);
            } else {
                $topKeluarQuery->whereMonth('tanggalkeluar', $selectedMonth)
                    ->whereYear('tanggalkeluar', $selectedYear);
            }

            $topKeluar = $topKeluarQuery->select('barangga_id', \DB::raw('SUM(jumlahkeluar) as total_keluar'))
                ->groupBy('barangga_id')
                ->orderBy('total_keluar', 'DESC')
                ->limit(5) // Menampilkan 5 barang keluar terbanyak
                ->get();

            $barangKeluarIds = $topKeluar->pluck('barangga_id')->toArray();
            $barangGaList = barangga::whereIn('id', $barangKeluarIds)->get()->keyBy('id');

            // Menyusun data untuk chart pie
            $chartData = ['labels' => [], 'data' => []];
            foreach ($topKeluar as $item) {
                if (isset($barangGaList[$item->barangga_id])) {
                    $barang = $barangGaList[$item->barangga_id];
                    $chartData['labels'][] = $barang->namabarang;
                    $chartData['data'][] = $item->total_keluar;
                }
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
                'barangGaList' => $barangGaList,
                'tanggalawal' => $tanggalawal,
                'tanggalakhir' => $tanggalakhir,
            ]);
        }
    }
}
