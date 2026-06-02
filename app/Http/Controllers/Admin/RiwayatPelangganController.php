<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rental;

class RiwayatPelangganController extends Controller
{
    public function riwayat($id)
    {
        // karena PK user = id_user
        $user = User::where('id_user', $id)->firstOrFail();

        $rentals = Rental::with(['detailRentals.barang'])
            ->where('id_user', $id)
            ->orderByDesc('waktu_sewa')
            ->paginate(5);

        $summary = Rental::where('id_user', $id)
            ->selectRaw('
                COUNT(*) as total_transaksi,
                COALESCE(SUM(total_harga), 0) as total_pengeluaran,
                COALESCE(SUM(total_denda), 0) as total_denda
            ')
            ->first();

        return view('Admin.Admin_Riwayat_Pelanggan', [
            'user' => $user,
            'rentals' => $rentals,
            'totalTransaksi' => $summary->total_transaksi,
            'totalPengeluaran' => $summary->total_pengeluaran,
            'totalDenda' => $summary->total_denda,
        ]);
    }
}