@extends('layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h2 mb-0 text-black-800" style="font-weight: 600">Dashboard</h1>
        </div>
        <!-- Content Row -->
        <div class="row">
            <!-- Jumlah ATK Keseluruhan Card -->
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

            <!-- Jumlah Barang Masuk Perbulan Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    ATK Masuk Bulan Ini
                                    ({{ \Carbon\Carbon::create()->month($selectedMonth)->locale('id')->translatedFormat('F') }})
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $jumlah_barang_masuk_perbulan }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-download fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Barang Masuk Perbulan Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    ATK Keluar Bulan Ini
                                    ({{ \Carbon\Carbon::create()->month($selectedMonth)->locale('id')->translatedFormat('F') }})
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $jumlah_barang_keluar_perbulan }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-upload fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Request Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Pending Request ATK</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingRequestCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bell fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Area Chart Keluar Masuk Barang -->
            <div class="col-xl-6 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-black">Chart Keluar-Masuk ATK</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chart-keluar-masuk-barang-perbulan"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barang Keluar Terbanyak per Bulan Pie Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-black">ATK Keluar Terbanyak:
                            {{ \Carbon\Carbon::create()->month($selectedMonth)->locale('id')->translatedFormat('F') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie">
                            <canvas id="topKeluarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!--Pie Chart -->
            {{-- <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-black">Revenue Sources</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('chart-keluar-masuk-barang-perbulan').getContext('2d');
            const monthlyData = @json($monthlyData);

            const labels = monthlyData.map(data => new Date(0, data.month - 1).toLocaleString('default', {
                month: 'long'
            }));
            const barangMasukData = monthlyData.map(data => data.barang_masuk);
            const barangKeluarData = monthlyData.map(data => data.barang_keluar);

            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Barang Masuk',
                        data: barangMasukData,
                        borderColor: 'rgba(246, 194, 62, 1)',
                        backgroundColor: 'rgba(246, 194, 62, 0.2)',
                        fill: true,
                    }, {
                        label: 'Barang Keluar',
                        data: barangKeluarData,
                        borderColor: 'rgba(28, 200, 138, 1)',
                        backgroundColor: 'rgba(28, 200, 138, 0.2)',
                        fill: true,
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
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: false,
                            },
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                drawBorder: true,
                                borderDash: [3],
                            }
                        }]
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                        align: 'start',
                        labels: {
                            boxWidth: 30, 
                            padding: 15, 
                            fontColor: '#333', 
                            usePointStyle: false,
                        }
                    },
                },
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('topKeluarChart').getContext('2d');
            var chartData = @json($chartData);
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        data: chartData.data,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', 'rgba(255, 99, 132, 1)',
                            '#e74a3b'
                        ],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#fd5175',
                            '#c63929'
                        ],
                        borderColor: "rgba(234, 236, 244, 1)",
                        borderWidth: 1,
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
                            display: false,
                            scaleLabel: {
                                display: true,
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: false,
                            },
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                drawBorder: true,
                                borderDash: [3],
                            }
                        }]
                    },
                    legend: {
                        display: false,
                        position: 'bottom',
                        align: 'start',
                        labels: {
                            boxWidth: 50, 
                            padding: 15, 
                            fontColor: '#333', 
                            usePointStyle: true,
                        }
                    },
                },
            });
        });
    </script>
@endsection
