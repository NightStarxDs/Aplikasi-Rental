<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Detail_Rental;
use App\Models\Rental;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('Admin.Admin_Transaksi');
    }

    public function editTransaksi()
    {
        return view('Admin.Admin_Edit_Transaksi');
    }

    public function hapusTransaksi()
    {
        return view('Admin.Admin_Transaksi');
    }

    public function pengambilanPengembalian($kode_rental)
    {
        $rental = Rental::with(['user', 'detailRentals.barang'])
            ->findOrFail($kode_rental);

        $subtotal = $rental->detailRentals->sum(fn ($detail) => $detail->subtotal ?? 0);
        $dendaKeterlambatan = $rental->detailRentals->sum(fn ($detail) => $detail->denda_keterlambatan ?? 0);
        $dendaKerusakan = $rental->detailRentals->sum(fn ($detail) => $detail->denda_kerusakan ?? 0);
        $baseTotal = $rental->total_harga ?? $subtotal;
        $totalDenda = $rental->total_denda ?? ($dendaKeterlambatan + $dendaKerusakan);
        $grandTotal = $baseTotal + $totalDenda;

        return view('Admin.Admin_Pengambilan_dan_Pengembalian', compact(
            'rental',
            'subtotal',
            'dendaKeterlambatan',
            'dendaKerusakan',
            'grandTotal'
        ));
    }

    public function Transaksi_Penyewaan(Request $request)
    {
        $status = $request->input('status');
        $search = $request->input('search');

        $query = Rental::with('user');

        if ($status) {
            $query->where('status_rental', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_rental', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%");
                });
            });
        }

        $rentals = $query->orderBy('kode_rental', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('Admin.Admin_Transaksi_Penyewaan', compact('rentals'));
    }

    public function updatePengembalian(Request $request, $kode_rental)
    {
        $rental = Rental::with('detailRentals')->findOrFail($kode_rental);
        $action = $request->input('action');

        if ($action === 'ambil') {
            $rental->status_rental = 'Disewa';
            $rental->waktu_sewa = $rental->waktu_sewa ?? now();
            $rental->save();

            return redirect()->route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental])
                ->with('success', 'Transaksi berhasil diperbarui menjadi Disewa.');
        }

        if ($action === 'kembali') {
            $totalDenda = 0;

            foreach ($rental->detailRentals as $detail) {
                $detailId = $detail->kode_detail;
                $detail->catatan_kondisi = $request->input("catatan_kondisi.$detailId") ?: $detail->catatan_kondisi;
                $detail->denda_kerusakan = $request->input("denda_kerusakan.$detailId", 0);
                $detail->denda_keterlambatan = $request->input("denda_keterlambatan.$detailId", 0);
                $detail->status_detail = 'Lunas';
                $detail->save();

                $totalDenda += floatval($detail->denda_kerusakan ?? 0) + floatval($detail->denda_keterlambatan ?? 0);
            }

            $rental->status_rental = 'Selesai';
            $rental->waktu_kembali_aktual = now();
            $rental->total_denda = $totalDenda;
            $rental->save();

            return redirect()->route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental])
                ->with('success', 'Transaksi berhasil dikembalikan dan biaya telah diperbarui.');
        }

        return redirect()->route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental])
            ->with('error', 'Aksi tidak dikenali.');
    }
}
