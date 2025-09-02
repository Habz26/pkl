<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Tindakan;
use Illuminate\Support\Facades\DB;

class ControllerDashboard extends Controller
{
    public function index()
    {
        // Ambil dari DB pendaftaran
        $totalPendaftar = DB::connection('pendaftaran')->table('pendaftaran')->count();

        // Ambil dari DB master
        $totalDokter = DB::connection('mysql')->table('dokter')->count();
        // Semua pasien kecuali yang status = 0
        $totalPasien = DB::table('pasien')->where('status', 1)->count();
        $pasienStatus1 = DB::table('pasien')->where('status', 1)->count();

        $totalRawatJalan = DB::table('tindakan')->where('nama', 'like', 'Rawat Jalan%')->count();
        $totalRawatInap = DB::table('tindakan')->where('nama', 'like', 'Rawat Inap%')->count();
        $totalIGD = DB::table('tindakan')->where('nama', 'like', 'Instalasi Gawat Darurat%')->count();

        return view('dashboard', compact('totalPendaftar', 'totalDokter', 'totalPasien', 'pasienStatus1', 'totalRawatJalan', 'totalRawatInap', 'totalIGD'));
    }
}
