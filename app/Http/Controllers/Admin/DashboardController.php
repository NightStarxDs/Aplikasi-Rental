<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
use App\Models\Rental;
use App\Models\Detail_Rental;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (! auth()->check() || ! auth()->user()->isAdmin()) {
            return redirect()->route('penjualan.index')->with('error', 'Anda tidak memiliki akses ke dashboard admin.');
        }

        // 1. Total semua barang
        $totalBarang = Barang::count();

        // 2. Jumlah user (role = 'user', bukan admin)
        $penyewaAktif = User::where('role', 'user')->count();

        // 3. Barang yang sedang disewa saat ini
        $barangDisewa = Detail_Rental::whereHas('rental', function ($q) {
            $q->where('status_rental', 'Disewa');
        })->count();

        // 4. Total seluruh transaksi
        $jumlahTransaksi = Rental::count();

        // 5. Jumlah barang per kategori
        $barangPerKategoriRaw = Barang::select(
                'kategori_barang',
                DB::raw('COUNT(*) as jumlah')
            )
            ->groupBy('kategori_barang')
            ->orderByDesc('jumlah')
            ->get();

        $barangPerSubkategoriRaw = Barang::select(
                'kategori_barang',
                'subkategori_barang',
                DB::raw('COUNT(*) as jumlah')
            )
            ->groupBy('kategori_barang', 'subkategori_barang')
            ->orderBy('kategori_barang')
            ->orderBy('subkategori_barang')
            ->get();

        // Ubah ke associative array
        $barangPerKategori = $barangPerKategoriRaw
            ->pluck('jumlah', 'kategori_barang')
            ->toArray();

        $barangPerSubkategori = [];
        foreach ($barangPerSubkategoriRaw as $item) {
            $barangPerSubkategori[$item->kategori_barang][$item->subkategori_barang] = $item->jumlah;
        }

        // 6. Pendapatan Filter (Bulan Ini by default)
        $jenisRentang = $request->input('jenis_rentang', 'bulan');
        
        $pendapatanQuery = Rental::where('status_rental', 'Selesai');
        
        $labelPendapatan = 'Pendapatan Bulan Ini';

        if ($jenisRentang === 'bulan') {
            $bulan = $request->input('bulan', now()->month);
            $tahun = $request->input('tahun', now()->year);
            $pendapatanQuery->whereMonth('waktu_kembali_aktual', $bulan)
                            ->whereYear('waktu_kembali_aktual', $tahun);
            $labelPendapatan = 'Pendapatan Bulan ' . date('F', mktime(0, 0, 0, $bulan, 1)) . ' ' . $tahun;
        } elseif ($jenisRentang === 'minggu') {
            $bulan = $request->input('bulan', now()->month);
            $tahun = $request->input('tahun', now()->year);
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            $pendapatanQuery->whereMonth('waktu_kembali_aktual', $bulan)
                            ->whereYear('waktu_kembali_aktual', $tahun)
                            ->whereBetween('waktu_kembali_aktual', [$startOfWeek, $endOfWeek]);
            $labelPendapatan = 'Pendapatan Minggu Ini';
        } elseif ($jenisRentang === 'tahun') {
            $tahun = $request->input('tahun', now()->year);
            $pendapatanQuery->whereYear('waktu_kembali_aktual', $tahun);
            $labelPendapatan = 'Pendapatan Tahun ' . $tahun;
        } elseif ($jenisRentang === 'custom') {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            if ($startDate && $endDate) {
                $pendapatanQuery->whereBetween('waktu_kembali_aktual', [$startDate, $endDate]);
                $labelPendapatan = 'Pendapatan (' . $startDate . ' - ' . $endDate . ')';
            }
        } else {
            $pendapatanQuery->whereMonth('waktu_kembali_aktual', now()->month)
                            ->whereYear('waktu_kembali_aktual', now()->year);
        }

        $pendapatanBulanIni = $pendapatanQuery->sum(DB::raw('total_harga + total_denda'));

        // 7. Pendapatan Denda (Sepanjang waktu dari rental yang Selesai)
        $pendapatanTahunIni = Rental::where('status_rental', 'Selesai')
            ->sum('total_denda');

        // 8. User dengan status keterlambatan (Sedang disewa tapi melewati batas waktu_kembali)
        $userTerlambat = Rental::with('user')->where('status_rental', 'Disewa')
            ->where('waktu_kembali', '<', now())
            ->get();

        $stats = [
            'total_barang'          => $totalBarang,
            'penyewa_aktif'         => $penyewaAktif,
            'barang_disewa'         => $barangDisewa,
            'jumlah_transaksi'      => $jumlahTransaksi,
            'barang_per_kategori'   => $barangPerKategori,
            'barang_per_subkategori'=> $barangPerSubkategori,
            'pendapatan_bulan_ini'  => $pendapatanBulanIni,
            'pendapatan_tahun_ini'  => $pendapatanTahunIni,
            'label_pendapatan'      => $labelPendapatan,
            'user_terlambat'        => $userTerlambat,
        ];

        return view('Admin.dashboard', compact('stats'));
    }
}