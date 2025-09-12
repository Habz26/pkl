<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ControllerDashboard extends Controller
{
    public function index(Request $request)
    {
        // Ambil input filter
        $filter = $request->input('filter');
        $hari = $request->input('hari');
        $bulan = $request->input('bulan');

        // Ambil input tanggal langsung
        $dateStartInput = $request->input('date_start');
        $dateEndInput = $request->input('date_end');

        // tentukan range tanggal
        if ($dateStartInput && $dateEndInput) {
            $dateStart = Carbon::parse($dateStartInput)->startOfDay();
            $dateEnd = Carbon::parse($dateEndInput)->endOfDay();
        } elseif ($dateStartInput) {
            $dateStart = Carbon::parse($dateStartInput)->startOfDay();
            $dateEnd = now(); // sampai hari ini
        } elseif ($dateEndInput) {
            $dateStart = Carbon::minValue(); // paling awal
            $dateEnd = Carbon::parse($dateEndInput)->endOfDay();
        } else {
            // default: 1 tahun berjalan
            $dateStart = now()->startOfYear();
            $dateEnd = now()->endOfYear();

            // Filter berdasarkan hari
            if ($hari) {
                $dayMap = [
                    'senin' => Carbon::MONDAY,
                    'selasa' => Carbon::TUESDAY,
                    'rabu' => Carbon::WEDNESDAY,
                    'kamis' => Carbon::THURSDAY,
                    'jumat' => Carbon::FRIDAY,
                    'sabtu' => Carbon::SATURDAY,
                    'minggu' => Carbon::SUNDAY,
                ];

                if (isset($dayMap[$hari])) {
                    $dateStart = Carbon::now()
                        ->startOfWeek()
                        ->addDays($dayMap[$hari] - 1)
                        ->startOfDay();
                    $dateEnd = (clone $dateStart)->endOfDay();
                }
            }

            // Filter berdasarkan bulan
            if ($bulan) {
                $dateStart = Carbon::create(now()->year, $bulan, 1)->startOfMonth();
                $dateEnd = Carbon::create(now()->year, $bulan, 1)->endOfMonth();
            }
        }

        // ================= QUERY HARIAN/BULANAN/TAHUNAN =================
        $totalPendaftar = DB::connection('pendaftaran')
            ->table('pendaftaran')
            ->whereBetween('tanggal', [$dateStart, $dateEnd])
            ->count();

        $totalPasien = DB::table('pasien')
            ->where('status', 1)
            ->whereBetween('tanggal', [$dateStart, $dateEnd])
            ->count();

        // Rawat Jalan
        $totalRawatJalan = DB::connection('pendaftaran')
            ->table('tujuan_pasien as tp')
            ->join('pendaftaran as p', 'tp.NOPEN', '=', 'p.NOMOR')
            ->join('master.ruangan as r', 'tp.RUANGAN', '=', 'r.ID')
            ->where('r.jenis_kunjungan', 1)
            ->whereBetween('p.tanggal', [$dateStart, $dateEnd])
            ->count();

        // Rawat Inap
        $totalRawatInap = DB::connection('pendaftaran')
            ->table('tujuan_pasien as tp')
            ->join('pendaftaran as p', 'tp.NOPEN', '=', 'p.NOMOR')
            ->join('master.ruangan as r', 'tp.RUANGAN', '=', 'r.ID')
            ->where('r.jenis_kunjungan', 3)
            ->whereBetween('p.tanggal', [$dateStart, $dateEnd])
            ->count();

        // IGD
        $totalIGD = DB::connection('pendaftaran')
            ->table('tujuan_pasien as tp')
            ->join('pendaftaran as p', 'tp.NOPEN', '=', 'p.NOMOR')
            ->join('master.ruangan as r', 'tp.RUANGAN', '=', 'r.ID')
            ->where('r.jenis_kunjungan', 2)
            ->whereBetween('p.tanggal', [$dateStart, $dateEnd])
            ->count();

        // Data master (tetap, ga perlu filter)
        $totalDokter = DB::connection('mysql')->table('dokter')->count();
        $totalPerawat = DB::connection('mysql')->table('perawat')->count();
        $totalBidan = DB::connection('mysql')->table('pegawai')->join('referensi', 'pegawai.profesi', '=', 'referensi.ref_id')->where('pegawai.profesi', 6)->where('referensi.deskripsi', 'Bidan')->count();
        $totalLab = DB::connection('mysql')->table('pegawai')->join('referensi', 'pegawai.profesi', '=', 'referensi.ref_id')->where('pegawai.profesi', 2)->where('referensi.deskripsi', 'Analis')->count();
        $totalRadiografer = DB::connection('mysql')->table('pegawai')->join('referensi', 'pegawai.profesi', '=', 'referensi.ref_id')->where('pegawai.profesi', 8)->where('referensi.deskripsi', 'Radiografer')->count();

        // ================= QUERY KEUANGAN (SMART GROUPING) =================
        $diffInDays = $dateStart->diffInDays($dateEnd);

        if ($diffInDays <= 31) {
            // Range pendek (≤ 1 bulan) → group by hari
            $dataChart = DB::connection('pembayaran')
                ->table('tagihan')
                ->selectRaw('DAY(tanggal) as hari, SUM(total) as total')
                ->whereBetween('tanggal', [$dateStart, $dateEnd])
                ->groupBy('hari')
                ->orderBy('hari')
                ->get()
                ->map(function ($item) {
                    $item->label = 'Hari ' . $item->hari;
                    return $item;
                });
        } elseif ($diffInDays <= 370) {
            // Range sedang (≤ 1 tahun) → group by bulan
            $namaBulan = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            ];

            $dataChart = DB::connection('pembayaran')
                ->table('tagihan')
                ->selectRaw('MONTH(tanggal) as bulan, SUM(total) as total')
                ->whereBetween('tanggal', [$dateStart, $dateEnd])
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get()
                ->map(function ($item) use ($namaBulan) {
                    $item->label = $namaBulan[$item->bulan] ?? $item->bulan;
                    return $item;
                });
        } else {
            // Range panjang → group by tahun
            $dataChart = DB::connection('pembayaran')
                ->table('tagihan')
                ->selectRaw('YEAR(tanggal) as tahun, SUM(total) as total')
                ->whereBetween('tanggal', [$dateStart, $dateEnd])
                ->groupBy('tahun')
                ->orderBy('tahun')
                ->get()
                ->map(function ($item) {
                    $item->label = 'Tahun ' . $item->tahun;
                    return $item;
                });
        }

        // ================= TOTAL PENDAPATAN =================
        $query = DB::connection('pembayaran')
            ->table('tagihan')
            ->whereBetween('tanggal', [$dateStart, $dateEnd]);

        $totalBpjs = (clone $query)->where('jenis', 2)->sum('total');
        $totalUmum = (clone $query)->where('jenis', 1)->where('status', 2)->sum('total');
        $totalLainnya = (clone $query)->whereNotIn('jenis', [1, 2])->sum('total');

        return view('dashboard', compact('totalPendaftar', 'totalDokter', 'totalPasien', 'totalRawatJalan', 'totalRawatInap', 'totalIGD', 'totalPerawat', 'dataChart', 'totalBpjs', 'totalUmum', 'totalLainnya', 'totalBidan', 'totalLab', 'totalRadiografer', 'filter', 'hari', 'bulan'));
    }
}
