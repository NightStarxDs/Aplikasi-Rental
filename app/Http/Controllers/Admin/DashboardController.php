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
        // 1. Total semua barang
        $totalBarang = Barang::count();

        // 2. Jumlah user (role = 'user', bukan admin)
        $penyewaAktif = User::where('role', 'user')->count();

        // 3. Barang yang sedang disewa saat ini
        $barangDisewa = Detail_Rental::whereHas('rental', function ($q) {
            $q->where('status', 'Disewa');
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

        // Ubah ke associative array
        $barangPerKategori = $barangPerKategoriRaw
            ->pluck('jumlah', 'kategori_barang')
            ->toArray();

        $stats = [
            'total_barang'        => $totalBarang,
            'penyewa_aktif'       => $penyewaAktif,
            'barang_disewa'       => $barangDisewa,
            'jumlah_transaksi'    => $jumlahTransaksi,
            'barang_per_kategori' => $barangPerKategori,
        ];

        return view('Admin.dashboard', compact('stats'));
    }
}