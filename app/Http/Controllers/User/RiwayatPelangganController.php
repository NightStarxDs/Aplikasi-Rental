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

    public function detail($kode_rental)
    {
        $id = Auth::user()->id_user;

        $rental = Rental::with(['detailRentals.barang', 'user'])
            ->where('kode_rental', $kode_rental)
            ->where('id_user', $id)
            ->firstOrFail();

        // Hitung total biaya checkout yang sudah dibayar
        $checkoutPaid = (float) ($rental->total_harga ?? 0);

        // Hitung total denda kerusakan & keterlambatan
        $dendaKerusakan      = $rental->detailRentals->sum(fn($d) => (float) ($d->denda_kerusakan ?? 0));
        $dendaKeterlambatan  = $rental->detailRentals->sum(fn($d) => (float) ($d->denda_keterlambatan ?? 0));
        $totalDenda          = $dendaKerusakan + $dendaKeterlambatan;

        return view('User.Detail_Transaksi', compact(
            'rental',
            'checkoutPaid',
            'dendaKerusakan',
            'dendaKeterlambatan',
            'totalDenda'
        ));
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

            // Kembalikan stok barang & sinkronkan status otomatis
            foreach ($rental->detailRentals as $detail) {
                $barang = $detail->barang;
                if ($barang) {
                    $barang->stok += $detail->jumlah_barang;
                    $barang->syncStatus();
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