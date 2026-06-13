<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function cancel($kode_rental)
    {
        $id = Auth::user()->id_user;
        $rental = Rental::with(['detailRentals.barang'])
            ->where('kode_rental', $kode_rental)
            ->where('id_user', $id)
            ->firstOrFail();

        if ($rental->status_rental !== 'Diajukan') {
            return redirect()->back()->with('error', 'Transaksi ini tidak dapat dibatalkan.');
        }

        DB::beginTransaction();
        try {
            // Update status rental
            $rental->status_rental = 'Dibatalkan';
            $rental->save();

            // Kembalikan stok barang
            foreach ($rental->detailRentals as $detail) {
                $barang = $detail->barang;
                if ($barang) {
                    $barang->stok += $detail->jumlah_barang;
                    $barang->save();
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Transaksi berhasil dibatalkan. Pengajuan refund akan diproses paling lama 3x24 Jam.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membatalkan transaksi: ' . $e->getMessage());
        }
    }
}