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
    public function index()
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

        // 6. Pendapatan Bulan Ini
        $pendapatanBulanIni = Rental::where('status_rental', 'Selesai')
            ->whereMonth('waktu_kembali_aktual', now()->month)
            ->whereYear('waktu_kembali_aktual', now()->year)
            ->sum(DB::raw('total_harga + total_denda'));

        // 7. Pendapatan Tahun Ini
        $pendapatanTahunIni = Rental::where('status_rental', 'Selesai')
            ->whereYear('waktu_kembali_aktual', now()->year)
            ->sum(DB::raw('total_harga + total_denda'));

        // 8. User dengan status keterlambatan (Sedang disewa tapi melewati batas waktu_kembali)
        $userTerlambat = Rental::where('status_rental', 'Disewa')
            ->where('waktu_kembali', '<', now())
            ->count();

        $stats = [
            'total_barang'          => $totalBarang,
            'penyewa_aktif'         => $penyewaAktif,
            'barang_disewa'         => $barangDisewa,
            'jumlah_transaksi'      => $jumlahTransaksi,
            'barang_per_kategori'   => $barangPerKategori,
            'barang_per_subkategori'=> $barangPerSubkategori,
            'pendapatan_bulan_ini'  => $pendapatanBulanIni,
            'pendapatan_tahun_ini'  => $pendapatanTahunIni,
            'user_terlambat'        => $userTerlambat,
        ];

        return view('Admin.dashboard', compact('stats'));
    }
}