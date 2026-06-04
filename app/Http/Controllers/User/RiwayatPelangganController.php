<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPelangganController extends Controller
{
    public function riwayat(Request $request)
    {
        $id = Auth::user()->id_user;
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

        return view('User.Riwayat_Pelanggan', [
            'user' => $user,
            'rentals' => $rentals,
            'totalTransaksi' => $summary->total_transaksi,
            'totalPengeluaran' => $summary->total_pengeluaran,
            'totalDenda' => $summary->total_denda,
        ]);
    }

}