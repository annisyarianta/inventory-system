@extends('layouts.master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h2 mb-0 text-black-800" style="font-weight: 600">Dashboard</h1>
    </div>
    <div class="row">
        
    <!-- Content Row -->
    <div class="row">
    <!-- Jumlah ATK Keseluruhan Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah ATK Keseluruhan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $jumlah_atk_keseluruhan }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Jumlah Barang Masuk Perbulan Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Barang Masuk Bulan {{ \Carbon\Carbon::create()->month($selectedMonth)->format('F') }}
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $jumlah_barang_masuk_perbulan }}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-truck fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jumlah Barang Masuk Perbulan Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Barang Keluar Bulan {{ \Carbon\Carbon::create()->month($selectedMonth)->format('F') }}
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $jumlah_barang_keluar_perbulan }}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-truck fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<!-- Content Row -->

    <!-- Chart Keluar Masuk Barang Perbulan -->


        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Chart Keluar Masuk Barang Perbulan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chart-keluar-masuk-barang-perbulan"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
    <!-- Tabel Barang Keluar Terbanyak Keseluruhan -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Barang Keluar Terbanyak Keseluruhan</h6>
            </div>
            <div class="card-body">
            <!-- Form Filter -->
            <form method="GET" action="{{ url('/dashboard') }}">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="tanggalawalkeluar">Tanggal Awal</label>
                        <input type="date" class="form-control" id="tanggalawalkeluar" name="tanggalawalkeluar" value="{{ $tanggalawal }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tanggalakhirkeluar">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggalakhirkeluar" name="tanggalakhirkeluar" value="{{ $tanggalakhir }}">
                    </div>
                    <div class="form-group col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
                <input type="hidden" name="bulan" value="{{ $selectedMonth }}">
                <input type="hidden" name="tahun" value="{{ $selectedYear }}">
            </form>
                <!-- Pie Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Barang Keluar Terbanyak per Bulan</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="topKeluarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('chart-keluar-masuk-barang-perbulan').getContext('2d');
        const monthlyData = @json($monthlyData);

        const labels = monthlyData.map(data => new Date(0, data.month - 1).toLocaleString('default', { month: 'long' }));
        const barangMasukData = monthlyData.map(data => data.barang_masuk);
        const barangKeluarData = monthlyData.map(data => data.barang_keluar);

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Barang Masuk',
                    data: barangMasukData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: false
                }, {
                    label: 'Barang Keluar',
                    data: barangKeluarData,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Bulan'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Jumlah Barang'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('topKeluarChart').getContext('2d');
    var chartData = @json($chartData);
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: chartData.labels,
            datasets: [{
                data: chartData.data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Top 5 Barang Keluar Terbanyak'
                }
            }
        }
    });
});
</script>

@endsection