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
        $totalBidan = DB::connection('mysql')->table('pegawai')->join('referensi', 'pegawai.profesi', '=', 'referensi.ref_id')->where('pegawai.profesi', 6)->where('referensi.deskripsi', 'Bidan')->count();
        $totalLab = DB::connection('mysql')->table('pegawai')->join('referensi', 'pegawai.profesi', '=', 'referensi.ref_id')->where('pegawai.profesi', 2)->where('referensi.deskripsi', 'Analis') ->count();
        $totalRadiografer = DB::connection('mysql')->table('pegawai')->join('referensi', 'pegawai.profesi', '=', 'referensi.ref_id')->where('pegawai.profesi', 8)->where('referensi.deskripsi', 'Radiografer') ->count();

        $totalPasien = DB::table('pasien')->where('status', 1)->count();

        $totalRawatJalan = DB::table('tindakan')->where('nama', 'like', 'Rawat Jalan%')->count();
        $totalRawatInap = DB::table('tindakan')->where('nama', 'like', 'Rawat Inap%')->count();
        $totalIGD = DB::table('tindakan')->where('nama', 'like', 'Instalasi Gawat Darurat%')->count();

        // Query ke DB pendaftaran
        $dataChart = DB::connection('pendaftaran')
            ->table('pendaftaran')
            ->selectRaw('MONTH(tanggal) as bulan, COUNT(*) as total')
            ->whereDate('tanggal', '>=', '2023-01-01') // filter dari 2023-01-01
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $totalBpjs = DB::connection('bpjs')->table('klaim')->sum('biaya_bySetujui');

        $totalUmum = DB::connection('pembayaran')->table('pembayaran_tagihan')->sum('total');

        // total Lainnya (deposit + transfer + piutang_perusahaan)
        $totalDeposit = DB::connection('pembayaran')->table('deposit')->sum('total'); // ganti nama kolom kalau berbeda

        $totalPiutang = DB::connection('pembayaran')->table('piutang_perusahaan')->sum('total'); // ganti nama kolom kalau berbeda

        $totalLainnya = $totalDeposit + $totalPiutang;

        return view('dashboard', compact('totalPendaftar', 'totalDokter', 'totalPasien', 'totalRawatJalan', 'totalRawatInap', 'totalIGD', 'totalPerawat', 'dataChart', 'totalBpjs', 'totalUmum', 'totalLainnya', 'totalDeposit', 'totalPiutang', 'totalBidan','totalLab','totalRadiografer'));
    }
}
