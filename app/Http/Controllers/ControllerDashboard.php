<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Tindakan;
use App\Models\Perawat;
use Illuminate\Support\Facades\DB;

class ControllerDashboard extends Controller
{
    public function index()
    {
        // Ambil dari DB pendaftaran
        $totalPendaftar = DB::connection('pendaftaran')->table('pendaftaran')->count();

        // Ambil dari DB master
        $totalDokter = DB::connection('mysql')->table('dokter')->count();
        $totalPerawat = DB::connection('mysql')->table('perawat')->count();
<<<<<<< HEAD
        // Semua pasien kecuali yang status = 0

=======
>>>>>>> d4a786386f91865d97555594dd61e55f3677e272
        $totalBidan = DB::connection('mysql')->table('pegawai')->join('referensi', 'pegawai.profesi', '=', 'referensi.ref_id')->where('pegawai.profesi', 6)->where('referensi.deskripsi', 'Bidan')->count();
        $totalLab = DB::connection('mysql')->table('pegawai')->join('referensi', 'pegawai.profesi', '=', 'referensi.ref_id')->where('pegawai.profesi', 2)->where('referensi.deskripsi', 'Analis') ->count();
        $totalRadiografer = DB::connection('mysql')->table('pegawai')->join('referensi', 'pegawai.profesi', '=', 'referensi.ref_id')->where('pegawai.profesi', 8)->where('referensi.deskripsi', 'Radiografer') ->count();

        $totalPasien = DB::table('pasien')->where('status', 1)->count();

        $totalRawatJalan = DB::table('tindakan')->where('nama', 'like', 'Rawat Jalan%')->count();
        $totalRawatInap = DB::table('tindakan')->where('nama', 'like', 'Rawat Inap%')->count();
        $totalIGD = DB::table('tindakan')->where('nama', 'like', 'Instalasi Gawat Darurat%')->count();

        // Query ke DB pendaftaran
        $dataChart = DB::connection('pembayaran')->table('tagihan')->selectRaw('MONTH(tanggal) as bulan, COUNT(*) as total')->whereDate('tanggal', '>=', '2020-01-01 00:00:00')->groupBy('bulan')->orderBy('bulan')->get();

        $totalBpjs = DB::connection('pembayaran')->table('tagihan')->where('jenis', 2)->sum('total');

        $totalUmum = DB::connection('pembayaran')->table('tagihan')->where('jenis', 1)->where('status', 2)->sum('total');

        // total Lainnya
        $totalLainnya = DB::connection('pembayaran')
            ->table('tagihan')
            ->whereNotIn('jenis', [1, 2])
            ->sum('total');

<<<<<<< HEAD
        return view('dashboard', compact('totalPendaftar', 'totalDokter', 'totalPasien', 'totalRawatJalan', 'totalRawatInap', 'totalIGD', 'totalPerawat', 'dataChart', 'totalBpjs', 'totalUmum', 'totalLainnya', 'totalBidan','totalLab','totalRadiografer'));
=======
        $totalPiutang = DB::connection('pembayaran')->table('piutang_perusahaan')->sum('total'); // ganti nama kolom kalau berbeda

        $totalLainnya = $totalDeposit + $totalPiutang;

        return view('dashboard', compact('totalPendaftar', 'totalDokter', 'totalPasien', 'totalRawatJalan', 'totalRawatInap', 'totalIGD', 'totalPerawat', 'dataChart', 'totalBpjs', 'totalUmum', 'totalLainnya', 'totalDeposit', 'totalPiutang', 'totalBidan','totalLab','totalRadiografer'));
>>>>>>> d4a786386f91865d97555594dd61e55f3677e272
    }
}
