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

            <!-- Info Boxes -->
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format($totalPendaftar, 0, ',', '.') }}</h3>
                <p>Pendaftar</p>
            </div>
            <div class="icon"><i class="fas fa-user-plus"></i></div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6">
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

    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ number_format($totalRawatJalan, 0, ',', '.') }}</h3>
                <p>Total Rawat Jalan</p>
            </div>
            <div class="icon"><i class="fas fa-walking"></i></div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format($totalRawatInap, 0, ',', '.') }}</h3>
                <p>Total Rawat Inap</p>
            </div>
            <div class="icon"><i class="fas fa-bed"></i></div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format($totalIGD, 0, ',', '.') }}</h3>
                <p>Total IGD</p>
            </div>
            <div class="icon"><i class="fas fa-ambulance"></i></div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>


                {{-- <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>-</h3>
                <p>Pembayaran</p>
          </div>
          <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div> --}}

                {{-- <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ number_format($totalDokter, 0, ',', '.') }}</h3>
            <p>Dokter</p>
          </div>
          <div class="icon"><i class="fas fa-user-md"></i></div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div> --}}

            </div>

            <!-- Charts Row -->
            {{-- <div class="row">
      <!-- Pie Chart -->
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Diagram Lingkaran</h3>
          </div>
          <div class="card-body">
            <canvas id="pieChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
          </div>
        </div>
      </div>

      <!-- Bar Chart -->
      <div class="col-md-6">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Diagram Batang</h3>
          </div>
          <div class="card-body">
            <canvas id="barChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
          </div>
        </div>
      </div>
    </div> --}}

        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pie Chart
            const pieCtx = document.getElementById('pieChart').getContext('2d');
            new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: ['Pendaftar', 'Pembayaran', 'Dokter', 'Pasien', 'Pegawai'],
                    datasets: [{
                        data: [120, 85, 15, 300, 50],
                        backgroundColor: ['#17a2b8', '#28a745', '#ffc107', '#dc3545', '#6f42c1']
                    }]
                }
            });

            // Bar Chart
            const barCtx = document.getElementById('barChart').getContext('2d');
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: ['Pendaftar', 'Pembayaran', 'Dokter', 'Pasien', 'Pegawai'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [120, 85, 15, 300, 50],
                        backgroundColor: ['#17a2b8', '#28a745', '#ffc107', '#dc3545', '#6f42c1']
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
