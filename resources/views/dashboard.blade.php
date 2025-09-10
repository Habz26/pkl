@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            {{-- Baris 1 --}}
            <div class="row flex-nowrap overflow-auto">
                {{-- Pendaftar --}}
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ number_format($totalPendaftar, 0, ',', '.') }}</h3>
                            <p>Pendaftar</p>
                        </div>
                        <div class="icon"><i class="fas fa-user-plus"></i></div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                {{-- Jumlah Pasien --}}
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ number_format($totalPasien, 0, ',', '.') }}</h3>
                            <p>Jumlah Pasien</p>
                        </div>
                        <div class="icon"><i class="fas fa-procedures"></i></div>
                        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modalPasien">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                {{-- Rawat Jalan --}}
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ number_format($totalRawatJalan, 0, ',', '.') }}</h3>
                            <p>Total Rawat Jalan</p>
                        </div>
                        <div class="icon"><i class="fas fa-walking"></i></div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                {{-- Rawat Inap --}}
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ number_format($totalRawatInap, 0, ',', '.') }}</h3>
                            <p>Total Rawat Inap</p>
                        </div>
                        <div class="icon"><i class="fas fa-bed"></i></div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                {{-- IGD --}}
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ number_format($totalIGD, 0, ',', '.') }}</h3>
                            <p>Total IGD</p>
                        </div>
                        <div class="icon"><i class="fas fa-ambulance"></i></div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            {{-- /Baris 1 --}}

            {{-- Baris 2 --}}
            <div class="row flex-nowrap overflow-auto">
                {{-- Dokter --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary shadow-sm">
                            <i class="fas fa-user-doctor"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Dokter</span>
                            <span class="info-box-number">{{ number_format($totalDokter, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Perawat --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary shadow-sm">
                            <i class="fas fa-user-nurse"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Perawat</span>
                            <span class="info-box-number">{{ number_format($totalPerawat, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Bidan --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary shadow-sm">
                            <i class="fa fa-stethoscope"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Bidan</span>
                            <span class="info-box-number">{{ number_format($totalBidan, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Lab --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary shadow-sm">
                            <i class="fas fa-flask"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">LAB</span>
                            <span class="info-box-number">{{ number_format($totalLab, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Radiografer --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary shadow-sm">
                            <i class="fas fa-x-ray"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Radiografer</span>
                             <span class="info-box-number">{{ number_format($totalRadiografer, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Baris 2 --}}

            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Total Pendaftar </h3>
                    <span style="margin-left: 40%; "><b>Periode Tahun 2023</b></span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Chart full width -->
                        <div class="col-12">
                            <div class="position-relative mb-4">
                                <canvas id="revenue-chart" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Recap tetap di bawah -->
                    <div class="row text-center mt-3">
                        <div class="col-md-4 border-right">
                            <span class="text-muted">BPJS</span>
                            <h5 class="font-weight-bold text-success">
                                Rp {{ number_format($totalBpjs, 0, ',', '.') }}
                            </h5>
                        </div>

                        <div class="col-md-4 border-right">
                            <span class="text-muted">Umum</span>
                            <h5 class="font-weight-bold text-primary">
                                Rp {{ number_format($totalUmum, 0, ',', '.') }}
                            </h5>
                        </div>

                        <div class="col-md-4">
                            <span class="text-muted">Lainnya</span>
                            <h5 class="font-weight-bold text-secondary" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Deposit: Rp {{ number_format($totalDeposit, 0, ',', '.') }} 
                                Piutang: Rp {{ number_format($totalPiutang, 0, ',', '.') }}">
                                Rp {{ number_format($totalLainnya, 0, ',', '.') }}
                            </h5>
                        </div>

                    </div>
                </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var chartData = @json($dataChart);

        // ambil canvas
        var ctx = document.getElementById('revenue-chart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.map(item => "Bulan " + item.bulan),
                datasets: [{
                    label: 'Pendaftar',
                    data: chartData.map(item => item.total),
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4,
                    pointBackgroundColor: '#007bff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>

@endsection
